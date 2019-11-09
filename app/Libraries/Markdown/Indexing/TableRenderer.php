<?php

/**
 *    Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
 *    See the LICENCE file in the repository root for full licence text.
 */

namespace App\Libraries\Markdown\Indexing;

use League\CommonMark\Block\Element\AbstractBlock;
use League\CommonMark\ElementRendererInterface;
use Webuni\CommonMark\TableExtension\TableRows;

class TableRenderer extends BlockRenderer
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
