<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Libraries\Markdown\Osu\Renderers;

use League\CommonMark\Extension\Table\Table;
use League\CommonMark\Node\Node;
use League\CommonMark\Renderer\ChildNodeRendererInterface;
use League\CommonMark\Renderer\NodeRendererInterface;
use League\CommonMark\Util\HtmlElement;

class TableRenderer implements NodeRendererInterface
{
    public function render(Node $node, ChildNodeRendererInterface $childRenderer)
    {
        Table::assertInstanceOf($node);

        $attrs = $node->data->getData('attributes');

        $separator = $childRenderer->getInnerSeparator();

        $table = new HtmlElement('table', [], $separator.$childRenderer->renderNodes($node->children()).$separator);

        return new HtmlElement('div', $attrs->export(), $separator.$table.$separator);
    }
}
