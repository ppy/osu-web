<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Libraries\Markdown\CustomContainerInline;

use Dflydev\DotAccessData\DataInterface;
use League\CommonMark\Node\Node;
use League\CommonMark\Renderer\ChildNodeRendererInterface;
use League\CommonMark\Renderer\NodeRendererInterface;
use League\CommonMark\Util\HtmlElement;

class Renderer implements NodeRendererInterface
{
    private DataInterface $attrs;
    private ChildNodeRendererInterface $childRenderer;
    private Node $node;

    public function render(Node $node, ChildNodeRendererInterface $childRenderer)
    {
        Element::assertInstanceOf($node);

        $this->node = $node;
        $this->childRenderer = $childRenderer;
        $this->attrs = $this->node->data->getData('attributes');

        $code = presence($this->attrs->get('flag', null));
        if ($code !== null) {
            return $this->createFlagElement($code);
        }

        return new HtmlElement(
            'span',
            $this->attrs->export(),
            $this->childRenderer->renderNodes($this->node->children()),
        );
    }

    private function createFlagElement(string $code)
    {
        $this->attrs->remove('flag');
        $this->attrs->set('class', 'flag-country flag-country--flat flag-country--wiki');
        $this->attrs->set('style', "background-image: url('".flag_url($code)."')");

        $country = app('countries')->byCode($code);
        if ($country !== null) {
            $this->attrs->set('title', $country->name);
        }

        return new HtmlElement('span', $this->attrs->export(), '');
    }
}
