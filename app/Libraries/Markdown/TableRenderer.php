<?php

namespace App\Libraries\Markdown;

use League\CommonMark\Block\Element\AbstractBlock;
use League\CommonMark\ElementRendererInterface;
use League\CommonMark\Node\Node;
use Webuni\CommonMark\TableExtension\TableRows;

class TableRenderer extends BlockTextRenderer
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
        if ($block instanceof TableRows) {
            // empty rows;
            if (!$block->hasChildren()) {
                return;
            }

            // skip header
            if ($block->isHead()) {
                return;
            }
        }

        return parent::render($block, $renderer, $inTightList);
    }
}
