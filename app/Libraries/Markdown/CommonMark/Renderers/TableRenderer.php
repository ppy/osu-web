<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Libraries\Markdown\CommonMark\Renderers;

use InvalidArgumentException;
use League\CommonMark\Block\Element\AbstractBlock;
use League\CommonMark\Block\Renderer\BlockRendererInterface;
use League\CommonMark\ElementRendererInterface;
use League\CommonMark\Extension\Table\Table;
use League\CommonMark\HtmlElement;

class TableRenderer implements BlockRendererInterface
{
    public function render(AbstractBlock $block, ElementRendererInterface $htmlRenderer, bool $inTightList = false)
    {
        if (!$block instanceof Table) {
            throw new InvalidArgumentException('Incompatible block type: '.get_class($block));
        }

        $attrs = $block->getData('attributes', []);

        $separator = $htmlRenderer->getOption('inner_separator', "\n");

        $table = new HtmlElement('table', [], $separator.$htmlRenderer->renderBlocks($block->children()).$separator);

        return new HtmlElement('div', $attrs, $separator.$table.$separator);
    }
}
