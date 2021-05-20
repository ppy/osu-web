<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Libraries\Markdown\CommonMark\Renderers;

use League\CommonMark\Block\Element\AbstractBlock;
use League\CommonMark\Block\Renderer\BlockRendererInterface;
use League\CommonMark\Block\Renderer\ListItemRenderer as BaseListItemRenderer;
use League\CommonMark\ElementRendererInterface;

class ListItemRenderer implements BlockRendererInterface
{
    private $baseRenderer;

    public function __construct()
    {
        $this->baseRenderer = new BaseListItemRenderer();
    }

    public function render(AbstractBlock $block, ElementRendererInterface $htmlRenderer, bool $inTightList = false)
    {
        $li = $this->baseRenderer->render($block, $htmlRenderer, $inTightList);

        $contents = $li->getContents();

        $li->setContents("<div>{$contents}</div>");

        return $li;
    }
}
