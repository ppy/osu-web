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
use Symfony\Component\Yaml\Exception\ParseException as YamlParseException;
use Symfony\Component\Yaml\Yaml;
use Webuni\CommonMark\TableExtension;

class OsuMarkdownProcessor implements DocumentProcessorInterface, ConfigurationAwareInterface
{
    const VERSION = 10;

    public $firstImage;
    public $title;
    public $toc = [];

    private $config;
    private $event;
    private $node;
    private $previousNode;
    private $tocSlugs = [];
    private $listLevel = 0;

    public static function process($rawInput, $config)
    {
        $config = array_merge([
            'html_input' => 'strip',
            'block_name' => 'osu-md',
        ], $config);

        $rawInput = strip_utf8_bom($rawInput);
        $input = static::parseYamlHeader($rawInput);
        $header = $input['header'] ?? [];

        if (!isset($config['fetch_title'])) {
            $config['fetch_title'] = !isset($header['title']);
        }

        $env = Environment::createCommonMarkEnvironment();
        $processor = new static;
        $env->addDocumentProcessor($processor);
        $env->addExtension(new TableExtension\TableExtension);

        $converter = new CommonMarkConverter($config, $env);

        $blockClass = $config['block_name'];

        foreach ($config['block_modifiers'] ?? [] as $blockModifier) {
            $blockClass .= " {$config['block_name']}--{$blockModifier}";
        }

        $output = sprintf(
            '<div class="%s">%s</div>',
            $blockClass,
            $converter->convertToHtml($input['document'])
        );

        if (!isset($header['title'])) {
            $header['title'] = $processor->title;
        }

        $toc = $processor->toc;
        $firstImage = $processor->firstImage;

        return compact('header', 'output', 'toc', 'firstImage');
    }

    public static function parseYamlHeader($input)
    {
        $hasMatch = preg_match('#^(?:---\n(?<header>.+?)\n(?:---|\.\.\.)\n)(?<document>.+)$#s', $input, $matches);

        if ($hasMatch === 1) {
            try {
                $header = Yaml::parse($matches['header']);
            } catch (YamlParseException $_e) {
                $header = null;
            }

            return [
                'header' => $header,
                'document' => $matches['document'],
            ];
        }

        return ['document' => $input];
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

            $this->updateLocaleLink();
            $this->fixRelativeUrl();
            $this->prefixUrl();
            $this->recordFirstImage();

            $this->trackListLevel();

            if ($this->config->getConfig('fetch_title')) {
                $this->setTitle();
            }
            $this->loadToc();
            $this->parseFigure();

            // last to prevent possible conflict
            $this->addClass();
        }
    }

    public function addClass()
    {
        if ($this->event->isEntering() || isset($this->node->data['attributes']['class'])) {
            return;
        }

        $blockClass = $this->config->getConfig('block_name');

        switch (get_class($this->node)) {
            case Block\ListBlock::class:
                $class = "{$blockClass}__list";
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
            case Block\Paragraph::class:
                $class = "{$blockClass}__paragraph";
                break;
            case Inline\Image::class:
                $class = "{$blockClass}__image";
                break;
            case Inline\Link::class:
                $class = "{$blockClass}__link";
                break;
            case TableExtension\Table::class:
                $class = "{$blockClass}__table";
                break;
            case TableExtension\TableCell::class:
                $class = "{$blockClass}__table-data";
                $class .= " {$blockClass}__table-data--{$this->node->align}";

                if ($this->node->type === 'th') {
                    $class .= " {$blockClass}__table-data--header";
                }
                break;
        }

        if (isset($class)) {
            $this->node->data['attributes']['class'] = $class;
        }
    }

    public function fixRelativeUrl()
    {
        if (!$this->event->isEntering() || !method_exists($this->node, 'getUrl')) {
            return;
        }

        $src = $this->node->getUrl();

        if (preg_match('#^(/|https?://|mailto:)#', $src) !== 1) {
            $this->node->setUrl($this->config->getConfig('path').'/'.$src);
        }
    }

    public function getText($node)
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

    public function loadToc()
    {
        if (
            !$this->node instanceof Block\Heading ||
            !$this->event->isEntering() ||
            $this->title === null ||
            $this->node->getLevel() > 3
        ) {
            return;
        }

        $title = $this->getText($this->node);
        $slug = presence(strtolower(str_replace(' ', '-', $title))) ?? 'page';

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

    public function parseFigure()
    {
        if (!$this->node instanceof Block\Paragraph || !$this->event->isEntering()) {
            return;
        }

        if (count($this->node->children()) !== 1 || !$this->node->children()[0] instanceof Inline\Image) {
            return;
        }

        $blockClass = $this->config->getConfig('block_name');

        $image = $this->node->children()[0];
        $this->node->data['attributes']['class'] = "{$blockClass}__figure-container";
        $image->data['attributes']['class'] = "{$blockClass}__figure-image";

        if (present($image->data['title'] ?? null)) {
            $text = new Inline\Text($image->data['title']);
            $textContainer = new Inline\Emphasis();
            $textContainer->data['attributes']['class'] = "{$blockClass}__figure-caption";
            $textContainer->appendChild($text);
            $this->node->appendChild($textContainer);
        }
    }

    public function prefixUrl()
    {
        if (!$this->event->isEntering() || !method_exists($this->node, 'getUrl')) {
            return;
        }

        $url = $this->node->getUrl();

        if (starts_with($url, '/wiki/')) {
            $this->node->setUrl('/help'.$url);
        }
    }

    public function recordFirstImage()
    {
        if ($this->firstImage !== null || !$this->node instanceof Inline\Image || !$this->event->isEntering()) {
            return;
        }

        $this->firstImage = $this->node->getUrl();
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
