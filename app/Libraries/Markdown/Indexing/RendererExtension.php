<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Libraries\Markdown\Indexing;

use App\Libraries\Markdown\StyleBlock\Element as StyleBlock;
use League\CommonMark\Block\Element as Block;
use League\CommonMark\ConfigurableEnvironmentInterface;
use League\CommonMark\Extension\ExtensionInterface;
use League\CommonMark\Extension\Table as TableExtension;
use League\CommonMark\Inline\Element as Inline;

class RendererExtension implements ExtensionInterface
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
            Block\BlockQuote::class => new BlockRenderer(),
            Block\Document::class => new BlockRenderer(),
            Block\FencedCode::class => new NoopRenderer(),
            Block\Heading::class => new NoopRenderer(),
            Block\HtmlBlock::class => new NoopRenderer(),
            Block\IndentedCode::class => new BlockRenderer(),
            Block\ListBlock::class => new ListBlockRenderer(),
            Block\ListItem::class => new ListItemRenderer(),
            Block\Paragraph::class => new BlockRenderer(),
            Block\ThematicBreak::class => new BlockRenderer(),
            StyleBlock::class => new BlockRenderer(),
            TableExtension\Table::class => new TableRenderer(),
            TableExtension\TableCaption::class => new NoopRenderer(),
            TableExtension\TableSection::class => new TableRenderer(),
            TableExtension\TableRow::class => new TableRenderer(),
            TableExtension\TableCell::class => new TableRenderer(),
        ];
    }

    private function inlineRenderers()
    {
        return [
            Inline\Code::class => new InlineRenderer(),
            Inline\Emphasis::class => new InlineRenderer(),
            Inline\HtmlInline::class => new NoopRenderer(),
            Inline\Image::class => new NoopRenderer(),
            Inline\Link::class => new InlineRenderer(),
            Inline\Newline::class => new NewlineRenderer(),
            Inline\Strong::class => new InlineRenderer(),
            Inline\Text::class => new InlineRenderer(),
        ];
    }
}
