<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Libraries\Markdown\CustomContainerInline;

use Dflydev\DotAccessData\DataInterface;
use League\CommonMark\Node\Node;
use League\CommonMark\Renderer\ChildNodeRendererInterface;
use League\CommonMark\Renderer\NodeRendererInterface;
use League\CommonMark\Util\HtmlElement;
use League\Config\ConfigurationAwareInterface;
use League\Config\ConfigurationInterface;

class Renderer implements NodeRendererInterface, ConfigurationAwareInterface
{
    private DataInterface $attrs;
    private ChildNodeRendererInterface $childRenderer;
    private ConfigurationInterface $config;
    private Node $node;

    public function setConfiguration(ConfigurationInterface $configuration): void
    {
        $this->config = $configuration;
    }

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

        $userId = presence($this->attrs->get('user-id', null));
        if ($userId !== null) {
            return $this->createProfileElement($userId);
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

    private function createProfileElement(string $userId)
    {
        $this->attrs->remove('user-id');

        $blockClass = $this->config->get('osu_extension/block_name');
        $this->attrs->set('class', "{$blockClass}__link js-usercard");

        $this->attrs->set('data-user-id', $userId);

        $url = route('users.show', $userId);
        $this->attrs->set('href', $url);

        return new HtmlElement(
            'a',
            $this->attrs->export(),
            $this->childRenderer->renderNodes($this->node->children()),
        );
    }
}
