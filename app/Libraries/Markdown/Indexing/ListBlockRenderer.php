<?php

namespace App\Libraries\Markdown\Indexing;

use League\CommonMark\Block\Element\AbstractBlock;
use League\CommonMark\Block\Renderer\BlockRendererInterface;
use League\CommonMark\ElementRendererInterface;

class ListBlockRenderer implements BlockRendererInterface
{
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
            $rendered[] = $renderer->renderBlock($child, true);
        }

        return implode('', $rendered);
    }
}
