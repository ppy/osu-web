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
