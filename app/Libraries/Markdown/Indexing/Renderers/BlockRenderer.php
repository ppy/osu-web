<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Libraries\Markdown\Indexing\Renderers;

use League\CommonMark\Node\Block\AbstractBlock;
use League\CommonMark\Node\Block\TightBlockInterface;
use League\CommonMark\Node\Node;
use League\CommonMark\Renderer\ChildNodeRendererInterface;
use League\CommonMark\Renderer\NodeRendererInterface;

class BlockRenderer implements NodeRendererInterface
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
     * @param Node $node
     * @param ChildNodeRendererInterface $childRenderer
     *
     * @return string
     */
    public function render(Node $node, ChildNodeRendererInterface $childRenderer): string
    {
        $rendered = [];

        $children = $node->children();
        foreach ($children as $child) {
            $rendered[] = $childRenderer->renderNodes([$child]);
        }

        $text = implode('', $rendered);
        // check if this block will effectively be empty.
        if (!present(trim($text))) {
            return '';
        }

        return static::inTightList($node) ? $text : $text . "\n";
    }

    private static function inTightList(Node $node): bool
    {
        $parent = $node->parent();
        if ($parent instanceof TightBlockInterface) {
            return $parent->isTight();
        }

        return false;
    }
}
