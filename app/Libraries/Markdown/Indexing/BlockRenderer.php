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

use League\CommonMark\Block\Element\AbstractBlock;
use League\CommonMark\Block\Renderer\BlockRendererInterface;
use League\CommonMark\ElementRendererInterface;
use League\CommonMark\Inline\Element\AbstractInline;
use League\CommonMark\Node\Node;

class BlockRenderer implements BlockRendererInterface
{
    /**
     * Finds the enclosing parent level block element for a given node.
     *
     * @param Node $node
     * @return AbstractBlock|null
     */
    public static function getEnclosingBlock(Node $node): ?AbstractBlock
    {
        $parent = $node->parent();
        if ($parent instanceof AbstractBlock) {
            return $parent;
        } elseif ($parent instanceof Node) {
            return static::getEnclosingBlock($parent);
        }

        return null;
    }

    /**
     * @param AbstractBlock $block
     * @param ElementRendererInterface $htmlRenderer
     * @param bool $inTightList
     *
     * @return string
     */
    public function render(AbstractBlock $block, ElementRendererInterface $renderer, $inTightList = false)
    {
        $rendered = [];

        $children = $block->children();
        foreach ($children as $child) {
            if ($child instanceof AbstractBlock) {
                $rendered[] = $renderer->renderBlock($child, $inTightList);
            } elseif ($child instanceof AbstractInline) {
                $rendered[] = $renderer->renderInlines([$child]);
            }
        }

        $text = implode('', $rendered);
        // check if this block will effectively be empty.
        if (!present(trim($text))) {
            return '';
        }

        return $inTightList ? $text : $text."\n";
    }
}
