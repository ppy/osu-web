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
use League\CommonMark\Extension\CommonMark\Node\Block\Heading;
use League\CommonMark\Extension\CommonMark\Node\Block\ListBlock;
use League\CommonMark\Extension\CommonMark\Node\Block\ListItem;
use League\CommonMark\Extension\CommonMark\Node\Inline\Image;
use League\CommonMark\Extension\CommonMark\Node\Inline\Link;
use League\CommonMark\Extension\DefaultAttributes\DefaultAttributesExtension;
use League\CommonMark\Extension\Footnote\FootnoteExtension;
use League\CommonMark\Extension\Table\Table;
use League\CommonMark\Extension\Table\TableCell;
use League\CommonMark\Extension\Table\TableExtension;
use League\CommonMark\MarkdownConverter;
use League\CommonMark\Node\Block\Paragraph;
use Symfony\Component\Yaml\Exception\ParseException as YamlParseException;
use Symfony\Component\Yaml\Yaml;

class OsuMarkdown
{
    use Memoizes;

    const VERSION = 13;

    const DEFAULT_COMMONMARK_CONFIG = [
        'allow_unsafe_links' => false,
        'html_input' => 'strip',
        'max_nesting_level' => 20,
        'renderer' => ['soft_break' => '<br />'],
    ];

    const DEFAULT_OSU_EXTENSION_CONFIG = [
        'block_name' => 'osu-md',
        'generate_toc' => false,
        'record_first_image' => false,
        'relative_url_root' => null,
        'style_block_allowed_classes' => null,
        'title_from_document' => false,
        'wiki_locale' => null,
    ];

    // this config is only used in this class
    const DEFAULT_OSU_MARKDOWN_CONFIG = [
        'block_modifiers' => [],
        'enable_footnote' => false,
        'parse_attribute_id' => false,
        'parse_yaml_header' => true,
    ];

    const PRESETS = [
        'changelog_entry' => [
            'commonmark' => [
                'html_input' => 'allow',
            ],
            'osu_extension' => [
                'block_name' => 'changelog-md',
            ],
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
            'commonmark' => [
                'html_input' => 'allow',
            ],
            'osu_extension' => [
                'generate_toc' => true,
                'record_first_image' => true,
            ],
            'osu_markdown' => [
                'block_modifiers' => ['news'],
            ],
        ],
        'store' => [
            'commonmark' => [
                'html_input' => 'allow',
            ],
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
            'osu_extension' => [
                'generate_toc' => true,
                'style_block_allowed_classes' => ['infobox'],
                'title_from_document' => true,
            ],
            'osu_markdown' => [
                'block_modifiers' => ['wiki'],
                'enable_footnote' => true,
                'parse_attribute_id' => true,
            ],
        ],
    ];

    private array $commonmarkConfig;
    private array $osuExtensionConfig;
    private array $osuMarkdownConfig;

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

    public function __construct(
        $preset,
        $commonmarkConfig = [],
        $osuExtensionConfig = [],
        $osuMarkdownConfig = [],
    ) {
        $presetConfig = static::PRESETS[$preset];

        $this->commonmarkConfig = array_merge(
            static::DEFAULT_COMMONMARK_CONFIG,
            $presetConfig['commonmark'] ?? [],
            $commonmarkConfig,
        );

        $this->osuExtensionConfig = array_merge(
            static::DEFAULT_OSU_EXTENSION_CONFIG,
            $presetConfig['osu_extension'] ?? [],
            $osuExtensionConfig,
        );

        $this->osuMarkdownConfig = array_merge(
            static::DEFAULT_OSU_MARKDOWN_CONFIG,
            $presetConfig['osu_markdown'] ?? [],
            $osuMarkdownConfig,
        );
    }

    public function html(): string
    {
        return $this->memoize(__FUNCTION__, function () {
            [$converter, $osuExtension] = $this->getHtmlConverterAndExtension();

            $blockClass = class_with_modifiers(
                $this->osuExtensionConfig['block_name'],
                $this->osuMarkdownConfig['block_modifiers'],
            );
            $converted = $converter->convertToHtml($this->document)->getContent();
            $processor = $osuExtension->processor;

            if ($this->osuExtensionConfig['title_from_document']) {
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

        if ($this->osuMarkdownConfig['parse_yaml_header']) {
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
            $extraConfig = [
                'osu_extension' => $this->osuExtensionConfig,
                'default_attributes' => $this->createDefaultAttributesConfig(),
            ];

            if ($this->osuMarkdownConfig['enable_footnote']) {
                $extraConfig['footnote'] = $this->createFootnoteConfig();
            }

            $environment = $this->createEnvironment($extraConfig);
            $environment->addExtension(new DefaultAttributesExtension());

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
            $environment = $this->createEnvironment();
            $environment->addExtension(new Indexing\Extension());

            $this->indexableConverter = new MarkdownConverter($environment);
        }

        return $this->indexableConverter;
    }

    private function createEnvironment(array $extraConfig = []): Environment
    {
        $config = array_merge($this->commonmarkConfig, $extraConfig);

        $environment = new Environment($config);
        $environment->addExtension(new CommonMarkCoreExtension());
        $environment->addExtension(new AutolinkExtension());
        $environment->addExtension(new TableExtension());

        if ($this->osuMarkdownConfig['parse_attribute_id']) {
            $environment->addEventListener(DocumentParsedEvent::class, new Attributes\AttributesOnlyIdListener());
            $environment->addExtension(new AttributesExtension());
        }

        if ($this->osuExtensionConfig['style_block_allowed_classes'] !== null) {
            $environment->addExtension(new StyleBlock\Extension());
        }

        if ($this->osuMarkdownConfig['enable_footnote']) {
            $environment->addExtension(new FootnoteExtension());
        }

        return $environment;
    }

    private function createDefaultAttributesConfig(): array
    {
        $blockClass = $this->osuExtensionConfig['block_name'];

        return [
            Heading::class => [
                'class' => static fn (Heading $node) => class_with_modifiers(
                    "{$blockClass}__header",
                    [$node->getLevel()],
                ),
            ],
            Image::class => [
                'class' => "{$blockClass}__image",
            ],
            Link::class => [
                'class' => "{$blockClass}__link",
            ],
            ListBlock::class => [
                'class' => static fn (ListBlock $node) => class_with_modifiers(
                    "{$blockClass}__list",
                    ['ordered' => $node->getListData()->type === ListBlock::TYPE_ORDERED]
                ),
                'style' => static function (ListBlock $node) {
                    if ($node->getListData()->type === ListBlock::TYPE_ORDERED) {
                        $start = ($node->getListData()->start ?? 1) - 1;
                        return "--list-start: {$start}";
                    }
                    return null;
                },
            ],
            ListItem::class => [
                'class' => "{$blockClass}__list-item",
            ],
            Paragraph::class => [
                'class' => "{$blockClass}__paragraph",
            ],
            StyleBlock\Element::class => [
                'class' => static fn (StyleBlock\Element $node) => "{$blockClass}__{$node->getClassName()}",
            ],
            Table::class => [
                'class' => "{$blockClass}__table",
            ],
            TableCell::class => [
                'class' => static fn (TableCell $node) => class_with_modifiers(
                    "{$blockClass}__table-data",
                    [
                        $node->getAlign() => $node->getAlign() !== null,
                        'header' => $node->getType() === TableCell::TYPE_HEADER,
                    ]
                ),
            ],
        ];
    }

    private function createFootnoteConfig()
    {
        $blockClass = $this->osuExtensionConfig['block_name'];

        return [
            'backref_class' => "{$blockClass}__link",
            'backref_symbol' => '↑',
            'container_add_hr' => false,
            'container_class' => "{$blockClass}__footnote-container",
            'footnote_class' => "{$blockClass}__list-item {$blockClass}__list-item--footnote",
            'footnote_id_prefix' => 'osu-fn-',
            'ref_class' => "{$blockClass}__link {$blockClass}__link--footnote-ref",
            'ref_id_prefix' => 'osu-fnref-',
        ];
    }
}
