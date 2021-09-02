<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Libraries\Markdown;

use App\Traits\Memoizes;
use League\CommonMark\Environment\Environment;
use League\CommonMark\Event\DocumentParsedEvent;
use League\CommonMark\Extension\Attributes\AttributesExtension;
use League\CommonMark\Extension\Autolink\AutolinkExtension;
use League\CommonMark\Extension\CommonMark\CommonMarkCoreExtension;
use League\CommonMark\Extension\Table\TableExtension;
use League\CommonMark\MarkdownConverter;
use Symfony\Component\Yaml\Exception\ParseException as YamlParseException;
use Symfony\Component\Yaml\Yaml;

class OsuMarkdown
{
    use Memoizes;

    const VERSION = 12;

    const DEFAULT_CONFIG = [
        // CommonMark options
        'allow_unsafe_links' => false,
        'html_input' => 'strip',
        'max_nesting_level' => 20,
        'renderer' => ['soft_break' => '<br />'],

        // OsuMarkdownProcessor options
        'osu_extension' => [
            'block_name' => 'osu-md',
            'generate_toc' => false,
            'record_first_image' => false,
            'relative_url_root' => null,
            'style_block_allowed_classes' => null,
            'title_from_document' => false,
            'wiki_locale' => null,
        ],

        'osu_markdown' => [
            'block_modifiers' => [],
            'parse_attribute_id' => false,
            'parse_yaml_header' => true,
        ],
    ];

    const PRESETS = [
        'changelog_entry' => [
            'block_name' => 'changelog-md',
            'html_input' => 'allow',
        ],
        'comment' => [
            'osu_markdown' => [
                'block_modifiers' => ['comment'],
            ],
        ],
        'default' => [],
        'group' => [
            'osu_markdown' => [
                'block_modifiers' => ['group'],
            ],
        ],
        'news' => [
            'generate_toc' => true,
            'html_input' => 'allow',
            'record_first_image' => true,
            'osu_markdown' => [
                'block_modifiers' => ['news'],
            ],
        ],
        'store' => [
            'html_input' => 'allow',
            'osu_markdown' => [
                'block_modifiers' => ['store'],
            ],
        ],
        'store-product' => [
            'osu_markdown' => [
                'block_modifiers' => ['store-product'],
            ],
        ],
        'store-product-small' => [
            'osu_markdown' => [
                'block_modifiers' => ['store-product', 'store-product-small'],
            ],
        ],
        'wiki' => [
            'generate_toc' => true,
            'style_block_allowed_classes' => ['infobox'],
            'title_from_document' => true,
            'osu_markdown' => [
                'block_modifiers' => ['wiki'],
                'parse_attribute_id' => true,
            ],
        ],
    ];

    private $config;
    private $document = '';
    private $firstImage;
    private $header;
    private $toc;

    private $htmlConverterAndExtension;
    private $indexableConverter;

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
        $this->config = array_merge_recursive(
            static::DEFAULT_CONFIG,
            static::PRESETS[$preset],
            $config
        );
    }

    public function html(): string
    {
        return $this->memoize(__FUNCTION__, function () {
            [$converter, $osuExtension] = $this->getHtmlConverterAndExtension();

            $blockClass = class_with_modifiers(
                $this->config['osu_extension']['block_name'],
                $this->config['osu_markdown']['block_modifiers'],
            );
            $converted = $converter->convertToHtml($this->document)->getContent();
            $processor = $osuExtension->processor;

            if ($this->config['osu_extension']['title_from_document']) {
                $this->header['title'] = $processor->title;
            }

            $this->firstImage = $processor->firstImage;
            $this->toc = $processor->toc;

            return "<div class='{$blockClass}'>{$converted}</div>";
        });
    }

    public function load($rawInput)
    {
        $this->resetMemoized();

        $rawInput = strip_utf8_bom($rawInput);

        if ($this->config['osu_markdown']['parse_yaml_header']) {
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

    public function toIndexable(): string
    {
        return $this->memoize(__FUNCTION__, function () {
            return $this->getIndexableConverter()->convertToHtml($this->document)->getContent();
        });
    }

    private function getHtmlConverterAndExtension(): array
    {
        if ($this->htmlConverterAndExtension === null) {
            $environment = $this->createBaseEnvironment();
            $osuExtension = new Osu\Extension();
            $environment->addExtension($osuExtension);

            $this->htmlConverterAndExtension = [
                new MarkdownConverter($environment),
                $osuExtension,
            ];
        }

        return $this->htmlConverterAndExtension;
    }

    private function getIndexableConverter(): MarkdownConverter
    {
        if ($this->indexableConverter === null) {
            $environment = $this->createBaseEnvironment();
            $environment->addExtension(new Indexing\Extension());

            $this->indexableConverter = new MarkdownConverter($environment);
        }

        return $this->indexableConverter;
    }

    private function createBaseEnvironment(): Environment
    {
        $config = $this->config;
        unset($config['osu_markdown']);

        $environment = new Environment($config);
        $environment->addExtension(new CommonMarkCoreExtension());
        $environment->addExtension(new AutolinkExtension());
        $environment->addExtension(new TableExtension());

        if ($this->config['osu_markdown']['parse_attribute_id']) {
            $environment->addEventListener(DocumentParsedEvent::class, new Attributes\AttributesOnlyIdListener());
            $environment->addExtension(new AttributesExtension());
        }

        if ($this->config['style_block_allowed_classes'] !== null) {
            $environment->addExtension(new StyleBlock\Extension());
        }

        return $environment;
    }
}
