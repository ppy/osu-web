<?php

namespace App\Libraries\Markdown\Indexing;

use League\CommonMark\Block\Element\AbstractBlock;
use League\CommonMark\Block\Element\ListItem;
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
    public static function getEnclosingBlock(Node $node) : ?AbstractBlock
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

        // collapse paragraph in list into single block.
        if (static::getEnclosingBlock($block) instanceof ListItem) {
            return $text;
        }

        return $text."\n";
    }
}
