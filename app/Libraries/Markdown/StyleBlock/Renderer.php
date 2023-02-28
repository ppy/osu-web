<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Libraries\Markdown\StyleBlock;

use League\CommonMark\Node\Node;
use League\CommonMark\Renderer\ChildNodeRendererInterface;
use League\CommonMark\Renderer\NodeRendererInterface;
use League\CommonMark\Util\HtmlElement;
use League\Config\ConfigurationAwareInterface;
use League\Config\ConfigurationInterface;

class Renderer implements NodeRendererInterface, ConfigurationAwareInterface
{
    private ConfigurationInterface $config;

    public function setConfiguration(ConfigurationInterface $configuration): void
    {
        $this->config = $configuration;
    }

    public function render(Node $node, ChildNodeRendererInterface $childRenderer)
    {
        Element::assertInstanceOf($node);

        $attrs = $node->data->getData('attributes');
        $className = $node->getClassName();

        $allowedClasses = $this->config->get('osu_extension/style_block_allowed_classes') ?? [];
        $separator = $this->config->get('renderer/inner_separator') ?? "\n";

        $renderedChildren = $childRenderer->renderNodes($node->children());

        if (!present($className) || !\in_array($className, $allowedClasses, true)) {
            return $renderedChildren;
        }

        return new HtmlElement(
            'div',
            $attrs->export(),
            $separator.$renderedChildren.$separator,
        );
    }
}
