<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Libraries\Markdown\Indexing\Renderers;

use League\CommonMark\Node\Inline\AbstractStringContainer;
use League\CommonMark\Node\Node;
use League\CommonMark\Renderer\ChildNodeRendererInterface;
use League\CommonMark\Renderer\NodeRendererInterface;

class InlineRenderer implements NodeRendererInterface
{
    /**
     * @param Node $node
     * @param ChildNodeRendererInterface $childRenderer
     *
     * @return string
     */
    public function render(Node $node, ChildNodeRendererInterface $childRenderer): string
    {
        if ($node instanceof AbstractStringContainer) {
            return $node->getLiteral();
        } else {
            return $childRenderer->renderNodes($node->children());
        }
    }
}
