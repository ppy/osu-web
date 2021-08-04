<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Libraries\Markdown\Osu\Renderers;

use InvalidArgumentException;
use League\CommonMark\Block\Element\AbstractBlock;
use League\CommonMark\Block\Renderer\BlockRendererInterface;
use League\CommonMark\ElementRendererInterface;
use League\CommonMark\Extension\Footnote\Node\FootnoteContainer;
use League\CommonMark\HtmlElement;

class FootnoteContainerRenderer implements BlockRendererInterface
{
    public function render(AbstractBlock $block, ElementRendererInterface $htmlRenderer, bool $inTightList = false)
    {
        if (!($block instanceof FootnoteContainer)) {
            throw new InvalidArgumentException('Incompatible block type: '.\get_class($block));
        }

        $attrs = $block->getData('attributes', []);

        return new HtmlElement('ol', $attrs, $htmlRenderer->renderBlocks($block->children()));
    }
}
