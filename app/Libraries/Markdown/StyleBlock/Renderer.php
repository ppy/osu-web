<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Libraries\Markdown\StyleBlock;

use Ds\Set;
use InvalidArgumentException;
use League\CommonMark\Block\Element\AbstractBlock;
use League\CommonMark\Block\Renderer\BlockRendererInterface;
use League\CommonMark\ElementRendererInterface;
use League\CommonMark\HtmlElement;
use League\CommonMark\Util\ConfigurationAwareInterface;
use League\CommonMark\Util\ConfigurationInterface;

class Renderer implements BlockRendererInterface, ConfigurationAwareInterface
{
    /**
     * @var Set
     */
    private $allowedClasses;

    public function render(AbstractBlock $block, ElementRendererInterface $htmlRenderer, bool $inTightList = false)
    {
        if (!$block instanceof Element) {
            throw new InvalidArgumentException('Incompatible block type: '.get_class($block));
        }

        $renderedChildren = $htmlRenderer->renderBlocks($block->children());

        if (!$this->allowedClasses->contains($block->getClass())) {
            return $renderedChildren;
        }

        $separator = $htmlRenderer->getOption('inner_separator', "\n");

        return new HtmlElement(
            'div',
            $block->getData('attributes', []),
            $separator.$renderedChildren.$separator,
        );
    }

    public function setConfiguration(ConfigurationInterface $configuration): void
    {
        $this->allowedClasses = new Set($configuration->get('style_block_allowed_classes'));
    }
}
