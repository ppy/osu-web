<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Libraries\Markdown;

use League\CommonMark\ConfigurableEnvironmentInterface;
use League\CommonMark\Environment;
use League\CommonMark\Event\DocumentParsedEvent;
use League\CommonMark\Extension\Attributes\AttributesExtension;
use League\CommonMark\Extension\Autolink\AutolinkExtension;
use League\CommonMark\Extension\Table\TableExtension;
use League\CommonMark\MarkdownConverter;
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
        'style_block_allowed_classes' => null,
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
            'style_block_allowed_classes' => ['infobox'],
            'title_from_document' => true,
        ],
    ];

    private $config;
    private $converter;
    private $document = '';
    private $firstImage;
    private $header;
    private $html;
    private $indexable;
    private $indexableConverter;
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

        $environment = $this->createBaseEnvironment();
        $this->processor = new Osu\DocumentProcessor($environment);
        $environment->addExtension(new Osu\Extension($this->processor));
        $this->converter = new MarkdownConverter($environment);

        $indexableEnvironment = $this->createBaseEnvironment();
        $indexableEnvironment->addExtension(new Indexing\Extension());
        $this->indexableConverter = new MarkdownConverter($indexableEnvironment);
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
            $this->indexable = $this->indexableConverter->convertToHtml($this->document);
        }

        return $this->indexable;
    }

    private function createBaseEnvironment(): ConfigurableEnvironmentInterface
    {
        $environment = Environment::createCommonMarkEnvironment()
            ->addExtension(new AutolinkExtension())
            ->addExtension(new TableExtension());

        if ($this->config['parse_attribute_id']) {
            $environment->addEventListener(DocumentParsedEvent::class, new Attributes\AttributesOnlyIdListener());
            $environment->addExtension(new AttributesExtension());
        }

        if ($this->config['style_block_allowed_classes'] !== null) {
            $environment->addExtension(new StyleBlock\Extension());
        }

        $environment->mergeConfig($this->config);

        return $environment;
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
