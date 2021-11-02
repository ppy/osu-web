<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Libraries\Markdown\Osu\Renderers;

use InvalidArgumentException;
use League\CommonMark\Extension\Table\Table;
use League\CommonMark\Extension\Table\TableRenderer as BaseTableRenderer;
use League\CommonMark\Node\Node;
use League\CommonMark\Renderer\ChildNodeRendererInterface;
use League\CommonMark\Renderer\NodeRendererInterface;
use League\CommonMark\Util\HtmlElement;

class TableRenderer implements NodeRendererInterface
{
    private BaseTableRenderer $baseRenderer;

    public function __construct()
    {
        $this->baseRenderer = new BaseTableRenderer();
    }

    public function render(Node $node, ChildNodeRendererInterface $childRenderer)
    {
        Table::assertInstanceOf($node);

        $baseTable = $this->baseRenderer->render($node, $childRenderer);

        if (!($baseTable instanceof HtmlElement)) {
            throw new InvalidArgumentException('Invalid element type: '.get_class($baseTable));
        }

        $table = new HtmlElement('table', [], $baseTable->getContents());

        return new HtmlElement('div', $baseTable->getAllAttributes(), $table);
    }
}
