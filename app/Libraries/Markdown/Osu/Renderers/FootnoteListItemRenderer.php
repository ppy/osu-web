<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Libraries\Markdown\Osu\Renderers;

use InvalidArgumentException;
use League\CommonMark\Block\Element\AbstractBlock;
use League\CommonMark\Block\Renderer\BlockRendererInterface;
use League\CommonMark\ElementRendererInterface;
use League\CommonMark\Extension\Footnote\Node\Footnote;
use League\CommonMark\HtmlElement;

class FootnoteListItemRenderer implements BlockRendererInterface
{
    public function render(AbstractBlock $block, ElementRendererInterface $htmlRenderer, bool $inTightList = false)
    {
        if (!($block instanceof Footnote)) {
            throw new InvalidArgumentException('Incompatible block type: '.\get_class($block));
        }

        $attrs = $block->getData('attributes', []);
        $attrs['id'] = 'fn:'.\mb_strtolower($block->getReference()->getLabel());

        foreach ($block->getBackrefs() as $backref) {
            $block->lastChild()->appendChild($backref);
        }

        $content = new HtmlElement('div', [], $htmlRenderer->renderInlines($block->firstChild()->children()));

        return new HtmlElement('li', $attrs, $content, true);
    }
}
