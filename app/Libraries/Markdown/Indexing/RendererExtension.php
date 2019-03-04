<?php

/**
 *    Copyright (c) ppy Pty Ltd <contact@ppy.sh>.
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

namespace App\Libraries\Markdown\Indexing;

use League\CommonMark\Block\Element as Block;
use League\CommonMark\Extension\CommonMarkCoreExtension;
use League\CommonMark\Inline\Element as Inline;
use Webuni\CommonMark\TableExtension;

class RendererExtension extends CommonMarkCoreExtension
{
    public function getBlockRenderers()
    {
        return [
            Block\BlockQuote::class => new BlockRenderer,
            Block\Document::class => new BlockRenderer,
            Block\FencedCode::class => new NoopRenderer,
            Block\Heading::class => new NoopRenderer,
            Block\HtmlBlock::class => new BlockRenderer,
            Block\IndentedCode::class => new BlockRenderer,
            Block\ListBlock::class => new ListBlockRenderer,
            Block\ListItem::class => new ListItemRenderer,
            Block\Paragraph::class => new BlockRenderer,
            Block\ThematicBreak::class => new BlockRenderer,
            TableExtension\Table::class => new TableRenderer,
            TableExtension\TableCaption::class => new NoopRenderer,
            TableExtension\TableRows::class => new TableRenderer,
            TableExtension\TableRow::class => new TableRenderer,
            TableExtension\TableCell::class => new TableRenderer,
        ];
    }

    public function getInlineRenderers()
    {
        return [
            Inline\Code::class => new InlineRenderer,
            Inline\Emphasis::class => new InlineRenderer,
            Inline\HtmlInline::class => new InlineRenderer,
            Inline\Image::class => new NoopRenderer,
            Inline\Link::class => new InlineRenderer,
            Inline\Newline::class => new NoopRenderer,
            Inline\Strong::class => new InlineRenderer,
            Inline\Text::class => new InlineRenderer,
        ];
    }
}
