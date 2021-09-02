<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Libraries\Markdown\Osu;

use App\Libraries\LocaleMeta;
use App\Libraries\Markdown\StyleBlock\Element as StyleBlock;
use App\Libraries\OsuWiki;
use League\CommonMark\Environment\EnvironmentBuilderInterface;
use League\CommonMark\Event\DocumentParsedEvent;
use League\CommonMark\Extension\CommonMark\Node\Block;
use League\CommonMark\Extension\CommonMark\Node\Inline;
use League\CommonMark\Extension\Table as TableExtension;
use League\CommonMark\Node\Block\Paragraph;
use League\CommonMark\Node\Inline\Text;
use League\Config\ConfigurationInterface;

class DocumentProcessor
{
    public $firstImage;
    public $title;
    public $toc;

    private ConfigurationInterface $config;
    private EnvironmentBuilderInterface $environment;
    private $event;
    private $node;

    private $listLevel;
    private $tocSlugs;

    private $relativeUrlRoot;
    private $wikiLocale;
    private $wikiPathToRoot;
    private $wikiAbsoluteRootPath;

    public function __construct(EnvironmentBuilderInterface $environment)
    {
        $this->environment = $environment;
        $this->config = $this->environment->getConfiguration();
    }

    public function __invoke(DocumentParsedEvent $event): void
    {
        $document = $event->getDocument();
        $walker = $document->walker();

        // The config value should come from route() call which means it's percent encoded
        // but it'll be reused as parameter for another route() call so decode it here.
        $this->relativeUrlRoot = urldecode($this->config->get('osu_extension/relative_url_root'));
        $generateToc = $this->config->get('osu_extension/generate_toc');
        $recordFirstImage = $this->config->get('osu_extension/record_first_image');
        $titleFromDocument = $this->config->get('osu_extension/title_from_document');
        $this->wikiLocale = $this->config->get('osu_extension/wiki_locale');

        $this->setWikiPaths();

        $this->firstImage = null;
        $this->title = null;
        $this->toc = [];
        $this->tocSlugs = [];
        $this->listLevel = 0;

        while (($this->event = $walker->next()) !== null) {
            $this->node = $this->event->getNode();

            $this->updateLocaleLink();
            $this->fixRelativeUrl();
            $this->fixWikiUrl();

            if ($recordFirstImage) {
                $this->recordFirstImage();
            }

            $this->trackListLevel();

            if ($titleFromDocument) {
                $this->setTitle();
            }

            if ($generateToc) {
                $this->loadToc();
            }

            $this->parseFigure();

            $this->proxyImage();

            $this->addListStartAsVariable();

            // last to prevent possible conflict
            $this->addClass();
        }
    }

    private function addClass()
    {
        if ($this->event->isEntering() || isset($this->node->data['attributes']['class'])) {
            return;
        }

        $blockClass = $this->config->get('osu_extension/block_name');

        switch (get_class($this->node)) {
            case Block\ListBlock::class:
                $class = "{$blockClass}__list";
                if ($this->node->getListData()->type === Block\ListBlock::TYPE_ORDERED) {
                    $class .= " {$blockClass}__list--ordered";
                }
                break;
            case Block\ListItem::class:
                $class = "{$blockClass}__list-item";

                if ($this->listLevel > 1) {
                    $class .= " {$blockClass}__list-item--deep";
                }
                break;
            case Block\Heading::class:
                $class = "{$blockClass}__header {$blockClass}__header--".$this->node->getLevel();
                break;
            case Paragraph::class:
                $class = "{$blockClass}__paragraph";
                break;
            case Inline\Image::class:
                $class = "{$blockClass}__image";
                break;
            case Inline\Link::class:
                $class = "{$blockClass}__link";
                break;
            case StyleBlock::class:
                $class = "{$blockClass}__{$this->node->getClass()}";
                break;
            case TableExtension\Table::class:
                $class = "{$blockClass}__table";
                break;
            case TableExtension\TableCell::class:
                $class = "{$blockClass}__table-data";

                if ($this->node->align !== null) {
                    $class .= " {$blockClass}__table-data--{$this->node->align}";
                }

                if ($this->node->type === 'th') {
                    $class .= " {$blockClass}__table-data--header";
                }
                break;
        }

        if (isset($class)) {
            $this->node->data['attributes']['class'] = $class;
        }
    }

    private function addListStartAsVariable()
    {
        if (!$this->node instanceof Block\ListBlock || !$this->event->isEntering()) {
            return;
        }

        if ($this->node->getListData()->type === Block\ListBlock::TYPE_ORDERED) {
            $start = ($this->node->getListData()->start ?? 1) - 1;

            $this->node->data['attributes']['style'] = "--list-start: {$start}";
        }
    }

    private function fixRelativeUrl()
    {
        if ($this->relativeUrlRoot === null) {
            return;
        }

        if (!$this->event->isEntering() || !($this->node instanceof Inline\AbstractWebResource)) {
            return;
        }

        $src = $this->node->getUrl();

        if (preg_match(',^(#|/|https?://|mailto:),', $src) !== 1) {
            if (starts_with($src, './')) {
                $src = substr($src, 2);
            }

            $this->node->setUrl($this->relativeUrlRoot.'/'.$src);
        }
    }

    /**
     * @param \League\CommonMark\Node\Node $node
     * @return string
     */
    private function getText($node)
    {
        $text = '';

        foreach ($node->children() as $child) {
            if ($child instanceof Inline\Image) {
                // avoid using image title as text
                continue;
            } elseif (method_exists($child, 'getContent')) {
                $text .= $child->getContent();
            } elseif (method_exists($child, 'children')) {
                $text .= $this->getText($child);
            }
        }

        return presence($text);
    }

    private function loadToc()
    {
        if (
            !$this->node instanceof Block\Heading ||
            !$this->event->isEntering() ||
            ($level = $this->node->getLevel()) === 1
        ) {
            return;
        }

        $title = $this->getText($this->node);
        $slug = $this->node->data['attributes']['id'] ?? presence(mb_strtolower(str_replace(' ', '-', $title))) ?? 'page';

        if (array_key_exists($slug, $this->tocSlugs)) {
            $this->tocSlugs[$slug] += 1;

            $slug .= '.'.$this->tocSlugs[$slug];
        } else {
            $this->tocSlugs[$slug] = 0;
        }

        if ($level <= 3) {
            $this->toc[$slug] = compact('title', 'level');
        }

        $this->node->data['attributes']['id'] = $slug;
    }

    private function parseFigure()
    {
        if (!$this->node instanceof Paragraph || !$this->event->isEntering()) {
            return;
        }

        if (count($this->node->children()) !== 1 || !$this->node->children()[0] instanceof Inline\Image) {
            return;
        }

        $blockClass = $this->config->get('osu_extension/block_name');

        $image = $this->node->children()[0];
        $this->node->data['attributes']['class'] = "{$blockClass}__figure-container";
        $image->data['attributes']['class'] = "{$blockClass}__figure-image";

        if (present($image->data['title'] ?? null)) {
            $text = new Text($image->data['title']);
            $textContainer = new Inline\Emphasis();
            $textContainer->data['attributes']['class'] = "{$blockClass}__figure-caption";
            $textContainer->appendChild($text);
            $this->node->appendChild($textContainer);
        }
    }

    private function fixWikiUrl()
    {
        if (!$this->event->isEntering() || !($this->node instanceof Inline\AbstractWebResource)) {
            return;
        }

        $url = $this->node->getUrl();

        $url = preg_replace_callback(',^(?:/help)?/wiki/(?<locale>[^/?#]+)(?:/(?<path>[^?#]+))?(?<query>\?.*)?(?<hash>#.*)?$,', function ($matches) {
            $matches['path'] = $matches['path'] ?? '';
            $matches['query'] = $matches['query'] ?? '';
            $matches['hash'] = $matches['hash'] ?? '';

            if (LocaleMeta::isValid($matches['locale'])) {
                $locale = $matches['locale'];
                $path = $matches['path'];
            } else {
                $path = concat_path([$matches['locale'], $matches['path']]);
            }

            if (OsuWiki::isImage($path)) {
                $url = route('wiki.image', compact('path'), false);
            } else {
                $locale ??= $this->wikiLocale ?? config('app.fallback_locale');
                $url = wiki_url($path, $locale, false, false);

                if (starts_with($url, $this->wikiAbsoluteRootPath)) {
                    $url = $this->wikiPathToRoot.substr($url, strlen($this->wikiAbsoluteRootPath));
                }
            }

            return "{$url}{$matches['query']}{$matches['hash']}";
        }, $url);

        $this->node->setUrl($url);
    }

    private function proxyImage()
    {
        if (!$this->node instanceof Inline\Image || !$this->event->isEntering()) {
            return;
        }

        $url = $this->node->getUrl();

        if (present($url)) {
            $this->node->setUrl(proxy_media($url));
        }
    }

    private function recordFirstImage()
    {
        if ($this->firstImage !== null || !$this->node instanceof Inline\Image || !$this->event->isEntering()) {
            return;
        }

        $this->firstImage = proxy_media($this->node->getUrl());
    }

    private function setTitle()
    {
        // wait until leaving otherwise node->next will be null after detaching.
        if (!$this->node instanceof Block\Heading || $this->event->isEntering() || $this->title !== null) {
            return;
        }

        $this->title = presence($this->node->getStringContent());
    }

    private function trackListLevel()
    {
        if (!$this->node instanceof Block\ListBlock) {
            return;
        }

        if ($this->event->isEntering()) {
            $this->listLevel += 1;
        } else {
            $this->listLevel -= 1;
        }
    }

    private function updateLocaleLink()
    {
        if (!$this->node instanceof Inline\Link || !$this->event->isEntering()) {
            return;
        }

        if (preg_match('#^(\w{2}(?:-\w{2})?):(.+)$#', $this->node->getUrl(), $matches) !== 1) {
            return;
        }

        $this->node->setUrl("{$matches[2]}?locale={$matches[1]}");
    }

    private function setWikiPaths()
    {
        if ($this->relativeUrlRoot === null || $this->wikiLocale === null) {
            return;
        }

        $this->wikiAbsoluteRootPath = route('wiki.show', ['locale' => $this->wikiLocale], false).'/';

        if (starts_with($this->relativeUrlRoot, $this->wikiAbsoluteRootPath)) {
            $relativeFromBase = substr($this->relativeUrlRoot, strlen($this->wikiAbsoluteRootPath));
            $slashes = substr_count($relativeFromBase, '/');

            if ($slashes === 0) {
                $this->wikiPathToRoot = './';
            } else {
                $this->wikiPathToRoot = implode('/', array_fill(0, $slashes, '..')).'/';
            }
        } else {
            $this->wikiPathToRoot = $this->wikiAbsoluteRootPath;
        }
    }
}
