<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Libraries\Markdown\Indexing\Renderers;

use League\CommonMark\Extension\Table\TableCell;
use League\CommonMark\Extension\Table\TableRow;
use League\CommonMark\Extension\Table\TableSection;
use League\CommonMark\Node\Node;
use League\CommonMark\Renderer\ChildNodeRendererInterface;

class TableRenderer extends BlockRenderer
{
    const INLINE_CLASSES = [TableCell::class, TableRow::class];

    /**
     * @param Node $node
     * @param ChildNodeRendererInterface $childRenderer
     *
     * @return string
     */
    public function render(Node $node, ChildNodeRendererInterface $childRenderer): string
    {
        if (!$node->hasChildren()) {
            return '';
        }

        // skip header
        if ($node instanceof TableSection && $node->isHead()) {
            return '';
        }

        return parent::render($node, $childRenderer);
    }
}
