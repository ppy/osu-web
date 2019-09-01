<?php

/**
 * yoinked from commonmark code fence element
 */
namespace App\Libraries\Markdown\Block\Renderer;

use League\CommonMark\Block\Element\AbstractBlock;
use League\CommonMark\Block\Renderer\BlockRendererInterface;
use League\CommonMark\ElementRendererInterface;
use League\CommonMark\HtmlElement;
use App\Libraries\Markdown\Block\Element\WikiSection;

class WikiSectionRenderer implements BlockRendererInterface
{
    /**
     * @param WikiSection              $block
     * @param ElementRendererInterface $htmlRenderer
     * @param bool                     $inTightList
     *
     * @return HtmlElement
     */
    public function render(AbstractBlock $block, ElementRendererInterface $htmlRenderer, $inTightList = false)
    {
        if (!($block instanceof WikiSection)) {
            throw new \InvalidArgumentException('Incompatible block type: ' . get_class($block));
        }

        return new HtmlElement(
            'div',
            ['class' => 'wiki-main-page-panel'],
            $htmlRenderer->renderBlocks($block->children())
        );
    }
}
