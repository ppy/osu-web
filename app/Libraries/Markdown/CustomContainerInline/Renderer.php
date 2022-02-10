<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Libraries\Markdown\CustomContainerInline;

use League\CommonMark\Node\Node;
use League\CommonMark\Renderer\ChildNodeRendererInterface;
use League\CommonMark\Renderer\NodeRendererInterface;
use League\CommonMark\Util\HtmlElement;

class Renderer implements NodeRendererInterface
{
    public function render(Node $node, ChildNodeRendererInterface $childRenderer)
    {
        Element::assertInstanceOf($node);

        $attrs = $node->data->getData('attributes');

        $code = presence($attrs->get('flag', null));
        if ($code !== null) {
            $attrs->remove('flag');
            $attrs->set('class', 'flag-country flag-country--flat flag-country--wiki');
            $attrs->set('style', "background-image: url('".flag_url($code)."')");
        }

        return new HtmlElement(
            'span',
            $attrs->export(),
            $childRenderer->renderNodes($node->children()),
        );
    }
}
