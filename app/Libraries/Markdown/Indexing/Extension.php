<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Libraries\Markdown\Indexing;

use App\Libraries\Markdown\Indexing\Renderers;
use App\Libraries\Markdown\StyleBlock\Element as StyleBlock;
use League\CommonMark\Block\Element as Block;
use League\CommonMark\ConfigurableEnvironmentInterface;
use League\CommonMark\Extension\ExtensionInterface;
use League\CommonMark\Extension\Table as TableExtension;
use League\CommonMark\Inline\Element as Inline;

class Extension implements ExtensionInterface
{
    public function register(ConfigurableEnvironmentInterface $environment)
    {
        foreach ($this->blockRenderers() as $class => $renderer) {
            $environment->addBlockRenderer($class, $renderer, 10);
        }

        foreach ($this->inlineRenderers() as $class => $renderer) {
            $environment->addInlineRenderer($class, $renderer, 10);
        }
    }

    private function blockRenderers()
    {
        return [
            Block\BlockQuote::class => new Renderers\BlockRenderer(),
            Block\Document::class => new Renderers\BlockRenderer(),
            Block\FencedCode::class => new Renderers\NoopRenderer(),
            Block\Heading::class => new Renderers\NoopRenderer(),
            Block\HtmlBlock::class => new Renderers\NoopRenderer(),
            Block\IndentedCode::class => new Renderers\BlockRenderer(),
            Block\ListBlock::class => new Renderers\ListBlockRenderer(),
            Block\ListItem::class => new Renderers\ListItemRenderer(),
            Block\Paragraph::class => new Renderers\BlockRenderer(),
            Block\ThematicBreak::class => new Renderers\BlockRenderer(),
            StyleBlock::class => new Renderers\BlockRenderer(),
            TableExtension\Table::class => new Renderers\TableRenderer(),
            TableExtension\TableCaption::class => new Renderers\NoopRenderer(),
            TableExtension\TableSection::class => new Renderers\TableRenderer(),
            TableExtension\TableRow::class => new Renderers\TableRenderer(),
            TableExtension\TableCell::class => new Renderers\TableRenderer(),
        ];
    }

    private function inlineRenderers()
    {
        return [
            Inline\Code::class => new Renderers\InlineRenderer(),
            Inline\Emphasis::class => new Renderers\InlineRenderer(),
            Inline\HtmlInline::class => new Renderers\NoopRenderer(),
            Inline\Image::class => new Renderers\NoopRenderer(),
            Inline\Link::class => new Renderers\InlineRenderer(),
            Inline\Newline::class => new Renderers\NewlineRenderer(),
            Inline\Strong::class => new Renderers\InlineRenderer(),
            Inline\Text::class => new Renderers\InlineRenderer(),
        ];
    }
}
