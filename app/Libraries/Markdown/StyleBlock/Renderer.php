<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Libraries\Markdown\StyleBlock;

use InvalidArgumentException;
use League\CommonMark\Block\Element\AbstractBlock;
use League\CommonMark\Block\Renderer\BlockRendererInterface;
use League\CommonMark\ElementRendererInterface;
use League\CommonMark\HtmlElement;

class Renderer implements BlockRendererInterface
{
    public function render(AbstractBlock $block, ElementRendererInterface $htmlRenderer, bool $inTightList = false)
    {
        if (!$block instanceof Element) {
            throw new InvalidArgumentException('Incompatible block type: '.get_class($block));
        }

        $separator = $htmlRenderer->getOption('inner_separator', "\n");

        return new HtmlElement(
            'div',
            $block->getData('attributes', []),
            $separator.$htmlRenderer->renderBlocks($block->children()).$separator,
        );
    }
}
