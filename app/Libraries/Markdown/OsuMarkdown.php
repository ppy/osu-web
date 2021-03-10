<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Libraries\Markdown;

use App\Libraries\Markdown\Indexing\RendererExtension as IndexingRendererExtension;
use League\CommonMark\Block\Element\ListItem;
use League\CommonMark\CommonMarkConverter;
use League\CommonMark\Environment;
use League\CommonMark\Event\DocumentParsedEvent;
use League\CommonMark\Extension\Attributes\AttributesExtension;
use League\CommonMark\Extension\Autolink\AutolinkExtension;
use League\CommonMark\Extension\Table as TableExtension;
use Symfony\Component\Yaml\Exception\ParseException as YamlParseException;
use Symfony\Component\Yaml\Yaml;

class OsuMarkdown
{
    const VERSION = 12;

    const DEFAULT_CONFIG = [
        // CommonMark options
        'allow_unsafe_links' => false,
        'html_input' => 'strip',
        'max_nesting_level' => 20,
        'renderer' => ['soft_break' => '<br />'],

        // OsuMarkdownProcessor options
        'block_modifiers' => [],
        'block_name' => 'osu-md',
        'generate_toc' => false,
        'parse_attribute_id' => false,
        'parse_yaml_header' => true,
        'record_first_image' => false,
        'relative_url_root' => null,
        'title_from_document' => false,
    ];

    const PRESETS = [
        'changelog_entry' => [
            'block_name' => 'changelog-md',
            'html_input' => 'allow',
        ],
        'comment' => [
            'block_modifiers' => ['comment'],
        ],
        'default' => [],
        'news' => [
            'block_modifiers' => ['news'],
            'generate_toc' => true,
            'html_input' => 'allow',
            'record_first_image' => true,
        ],
        'store' => [
            'block_modifiers' => ['store'],
            'html_input' => 'allow',
        ],
        'store-product' => [
            'block_modifiers' => ['store-product'],
        ],
        'store-product-small' => [
            'block_modifiers' => ['store-product', 'store-product-small'],
        ],
        'wiki' => [
            'block_modifiers' => ['wiki'],
            'generate_toc' => true,
            'parse_attribute_id' => true,
            'title_from_document' => true,
        ],
    ];

    private $config;
    private $document = '';
    private $firstImage;
    private $header;
    private $html;
    private $indexable;
    private $processor;
    private $toc;

    public static function parseYamlHeader($input)
    {
        $hasMatch = preg_match('#^(?:---\n(?<header>.+?)\n(?:---|\.\.\.)\n)(?<document>.+)$#s', $input, $matches);

        if ($hasMatch === 1) {
            try {
                $header = Yaml::parse($matches['header']);
            } catch (YamlParseException $_e) {
                $header = [];
            }

            $document = $matches['document'];
        } else {
            $header = [];
            $document = $input;
        }

        return compact('header', 'document');
    }

    public function __construct($preset, $config = [])
    {
        $this->config = array_merge(
            static::DEFAULT_CONFIG,
            static::PRESETS[$preset],
            $config
        );

        $env = Environment::createCommonMarkEnvironment();
        $this->processor = new OsuMarkdownProcessor($env);

        if ($this->config['parse_attribute_id']) {
            $env->addEventListener(DocumentParsedEvent::class, [new AttributesOnlyIdListener(), 'onDocumentParsed']);
            // Manually call register here to make sure the listener for the extension is
            // registered before $this->processor.
            // Adding extension using addExtension doesn't actually register anything
            // until the environment is used.
            (new AttributesExtension())->register($env);
        }

        $env->addEventListener(DocumentParsedEvent::class, [$this->processor, 'onDocumentParsed']);

        $env->addExtension(new TableExtension\TableExtension());
        $env->addBlockRenderer(TableExtension\Table::class, new OsuTableRenderer());
        $env->addBlockRenderer(ListItem::class, new ListItemRenderer());

        $env->addExtension(new AutolinkExtension());

        $this->converter = new CommonMarkConverter($this->config, $env);
    }

    public function html()
    {
        if ($this->html === null) {
            $this->process();
        }

        return $this->html;
    }

    public function load($rawInput)
    {
        $this->reset();

        $rawInput = strip_utf8_bom($rawInput);

        if ($this->config['parse_yaml_header']) {
            $parsed = static::parseYamlHeader($rawInput);
            $this->document = $parsed['document'];
            $this->header = $parsed['header'];
        } else {
            $this->document = $rawInput;
            $this->header = [];
        }

        $this->document = $this->document ?? '';

        return $this;
    }

    public function toArray()
    {
        $html = $this->html();

        return [
            'firstImage' => $this->firstImage,
            'header' => $this->header,
            'output' => $html,
            'toc' => $this->toc,
        ];
    }

    public function toIndexable()
    {
        if ($this->indexable === null) {
            $env = Environment::createCommonMarkEnvironment();
            $env->addExtension(new TableExtension\TableExtension());
            $env->addExtension(new IndexingRendererExtension());
            $converter = new CommonMarkConverter($this->config, $env);
            $this->indexable = $converter->convertToHtml($this->document);
        }

        return $this->indexable;
    }

    private function process()
    {
        $converted = $this->converter->convertToHtml($this->document);

        $blockClass = class_with_modifiers($this->config['block_name'], $this->config['block_modifiers']);

        $this->html = "<div class='{$blockClass}'>{$converted}</div>";

        if ($this->config['title_from_document']) {
            $this->header['title'] = $this->processor->title;
        }

        $this->toc = $this->processor->toc;
        $this->firstImage = $this->processor->firstImage;
    }

    private function reset()
    {
        $this->html = null;
        $this->indexable = null;
    }
}
