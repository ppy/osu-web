<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Libraries\Markdown\Indexing\Renderers;

use League\CommonMark\ElementRendererInterface;
use League\CommonMark\Inline\Element\AbstractInline;
use League\CommonMark\Inline\Element\AbstractStringContainer;
use League\CommonMark\Inline\Renderer\InlineRendererInterface;

class InlineRenderer implements InlineRendererInterface
{
    /**
     * @param AbstractInline $inline
     * @param ElementRendererInterface $htmlRenderer
     *
     * @return string
     */
    public function render(AbstractInline $inline, ElementRendererInterface $renderer)
    {
        if ($inline instanceof AbstractStringContainer) {
            return $inline->getContent();
        } else {
            return $renderer->renderInlines($inline->children());
        }
    }
}
