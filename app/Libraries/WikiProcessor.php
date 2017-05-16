<?php

/**
 *    Copyright 2015-2017 ppy Pty. Ltd.
 *
 *    This file is part of osu!web. osu!web is distributed with the hope of
 *    attracting more community contributions to the core ecosystem of osu!.
 *
 *    osu!web is free software: you can redistribute it and/or modify
 *    it under the terms of the Affero GNU General Public License version 3
 *    as published by the Free Software Foundation.
 *
 *    osu!web is distributed WITHOUT ANY WARRANTY; without even the implied
 *    warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
 *    See the GNU Affero General Public License for more details.
 *
 *    You should have received a copy of the GNU Affero General Public License
 *    along with osu!web.  If not, see <http://www.gnu.org/licenses/>.
 */

namespace App\Libraries;

use League\CommonMark\Block\Element as Block;
use League\CommonMark\Block\Element\Document;
use League\CommonMark\CommonMarkConverter;
use League\CommonMark\DocumentProcessorInterface;
use League\CommonMark\Environment;
use League\CommonMark\Inline\Element as Inline;
use League\CommonMark\Util\Configuration;
use League\CommonMark\Util\ConfigurationAwareInterface;
use Webuni\CommonMark\TableExtension;

class WikiProcessor implements DocumentProcessorInterface, ConfigurationAwareInterface
{
    const VERSION = 2;

    private $config;
    private $event;
    private $node;
    private $previousNode;
    public $title;
    public $toc = [];
    private $tocSlugs = [];
    private $listLevel = 0;

    public static function process($input, $config)
    {
        $env = Environment::createCommonMarkEnvironment();
        $processor = new static();
        $env->addDocumentProcessor($processor);
        $env->addExtension(new TableExtension\TableExtension());
        $converter = new CommonMarkConverter(array_merge($config, [
            'html_input' => 'strip',
        ]), $env);

        $output = '<div class="wiki-content">'.$converter->convertToHtml($input).'</div>';
        $title = $processor->title;
        $toc = $processor->toc;

        return compact('output', 'title', 'toc');
    }

    public function setConfiguration(Configuration $config)
    {
        $this->config = $config;
    }

    public function processDocument(Document $document)
    {
        $walker = $document->walker();

        while (($this->event = $walker->next()) !== null) {
            $this->previousNode = $this->node;
            $this->node = $this->event->getNode();

            $this->trackListLevel();

            $this->setTitle();
            $this->fixImageSrc();
            $this->updateLocaleLink();
            $this->loadToc();

            // last to prevent possible conflict
            $this->prefixUrl();
            $this->addClass();
        }
    }

    public function addClass()
    {
        if ($this->event->isEntering() || isset($this->node->data['attributes']['class'])) {
            return;
        }

        switch (get_class($this->node)) {
            case Block\ListBlock::class:
                $class = 'wiki-content__list';
                break;
            case Block\ListItem::class:
                $class = 'wiki-content__list-item';

                if ($this->listLevel > 1) {
                    $class .= ' wiki-content__list-item--deep';
                }
                break;
            case Block\Heading::class:
                $class = 'wiki-content__header wiki-content__header--'.$this->node->getLevel();
                break;
            case Block\Paragraph::class:
                $class = 'wiki-content__paragraph';
                break;
            case Inline\Image::class:
                $class = 'wiki-content__image';
                break;
            case Inline\Link::class:
                $class = 'wiki-content__link';
                break;
            case TableExtension\Table::class:
                $class = 'wiki-content__table';
                break;
            case TableExtension\TableCell::class:
                $class = 'wiki-content__table-data';

                if ($this->node->type === 'th') {
                    $class .= ' wiki-content__table-data--header';
                }
                break;
        }

        if (isset($class)) {
            $this->node->data['attributes']['class'] = $class;
        }
    }

    public function fixImageSrc()
    {
        if (!$this->node instanceof Inline\Image || !$this->event->isEntering()) {
            return;
        }

        $src = $this->node->getUrl();

        if (preg_match('#^(/|https?://)#', $src) !== 1) {
            $this->node->setUrl($this->config->getConfig('path').'/'.$src);
        }
    }

    public function loadToc()
    {
        if (
            !$this->node instanceof Block\Heading ||
            !$this->event->isEntering() ||
            $this->title === null
        ) {
            return;
        }

        $title = presence($this->node->getStringContent());
        $slug = presence(str_slug($title)) ?? 'page';

        if (array_key_exists($slug, $this->tocSlugs)) {
            $this->tocSlugs[$slug] += 1;

            $slug .= '.'.$this->tocSlugs[$slug];
        } else {
            $this->tocSlugs[$slug] = 0;
        }

        $this->toc[$slug] = [
            'title' => $title,
            'level' => $this->node->getLevel(),
        ];

        $this->node->data['attributes']['id'] = $slug;
    }

    public function prefixUrl()
    {
        if ($this->event->isEntering() || !method_exists($this->node, 'getUrl')) {
            return;
        }

        $url = $this->node->getUrl();

        if (starts_with($url, '/wiki/')) {
            $this->node->setUrl('/help'.$url);
        }
    }

    public function setTitle()
    {
        // wait until leaving otherwise node->next will be null after detaching.
        if (!$this->node instanceof Block\Heading || $this->event->isEntering() || $this->title !== null) {
            return;
        }

        $this->title = presence($this->node->getStringContent());
        $this->node->detach();
    }

    public function trackListLevel()
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

    public function updateLocaleLink()
    {
        if (!$this->node instanceof Inline\Link || !$this->event->isEntering()) {
            return;
        }

        if (preg_match('#^(\w{2}(?:-\w{2})?):(.+)$#', $this->node->getUrl(), $matches) !== 1) {
            return;
        }

        $this->node->setUrl("{$matches[2]}?locale={$matches[1]}");
    }
}
