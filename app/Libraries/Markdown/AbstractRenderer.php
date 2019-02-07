<?php

namespace App\Libraries\Markdown;

use League\CommonMark\Block\Element\AbstractBlock;
use League\CommonMark\ElementRendererInterface;
use League\CommonMark\Inline\Element\AbstractInline;
use League\CommonMark\Node\Node;
use League\CommonMark\Inline\Element\AbstractStringContainer;

abstract class AbstractRenderer
{
    public function renderChildren(Node $node, ElementRendererInterface $renderer)
    {
        $rendered = [];

        // $text = $this->getText($node);
        // if (presence($text)) {
        //     $rendered[] = $text;
        // }

        $children = $node->children();
        // apparently inlines only have children inlines?
        if ($node instanceof AbstractInline) {
            $rendered[] = $renderer->renderInlines($children);
        } else {
            foreach ($children as $child) {
                if ($child instanceof AbstractBlock) {
                    $rendered[] = $renderer->renderBlock($child);
                } elseif ($child instanceof AbstractInline) {
                    $rendered[] = $renderer->renderInlines([$child]);
                }
            }
        }

        return $rendered;
    }

    public function getText(Node $node)
    {
        if ($node instanceof AbstractBlock) {
            // $strings = $node->getStrings();
            // print_r($strings);
            // return get_class($node)."\n";
            // return "\n";
        } elseif ($node instanceof AbstractStringContainer) {
            // return get_class($node).':'.$node->getContent()."\n";
            return "\n  ".$node->getContent()."\n";
        }
    }
}
