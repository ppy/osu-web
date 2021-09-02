<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Libraries\Markdown\Osu\Renderers;

use League\CommonMark\Extension\CommonMark\Renderer\Block\ListItemRenderer as BaseListItemRenderer;
use League\CommonMark\Node\Node;
use League\CommonMark\Renderer\ChildNodeRendererInterface;
use League\CommonMark\Renderer\NodeRendererInterface;
use League\CommonMark\Util\HtmlElement;

class ListItemRenderer implements NodeRendererInterface
{
    private BaseListItemRenderer $baseRenderer;

    public function __construct()
    {
        $this->baseRenderer = new BaseListItemRenderer();
    }

    public function render(Node $node, ChildNodeRendererInterface $childRenderer)
    {
        $li = $this->baseRenderer->render($node, $childRenderer);

        if ($li instanceof HtmlElement) {
            $contents = $li->getContents();
            $li->setContents("<div>{$contents}</div>");
        }

        return $li;
    }
}
