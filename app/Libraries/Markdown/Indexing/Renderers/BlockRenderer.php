<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Libraries\Markdown\Indexing\Renderers;

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
