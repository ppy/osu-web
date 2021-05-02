<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Libraries\Markdown;

use League\CommonMark\Block\Element\AbstractBlock;
use League\CommonMark\Block\Renderer\BlockRendererInterface;
use League\CommonMark\Block\Renderer\HtmlBlockRenderer as BaseHtmlBlockRenderer;
use League\CommonMark\ElementRendererInterface;
use League\CommonMark\Util\ConfigurationAwareInterface;
use League\CommonMark\Util\ConfigurationInterface;

class HtmlBlockRenderer implements BlockRendererInterface, ConfigurationAwareInterface
{
    private const HTML_CLASS_REGEX = '#^(?<before><[^/](?:[^c]|(?!class=")c)*class=")(?<class>[^"]+)(?<after>.+)#';

    private $baseRenderer;
    private $config;

    public function __construct()
    {
        $this->baseRenderer = new BaseHtmlBlockRenderer();
    }

    public function render(AbstractBlock $block, ElementRendererInterface $htmlRenderer, bool $inTightList = false)
    {
        $blockPrefix = $this->config->get('html_block_prefix');
        $htmlString = $this->baseRenderer->render($block, $htmlRenderer, $inTightList);

        if ($blockPrefix === null || !preg_match(static::HTML_CLASS_REGEX, $htmlString, $match)) {
            return $htmlString;
        }

        $classes = array_map(function ($class) use ($blockPrefix) {
            return $blockPrefix.$class;
        }, explode(' ', $match['class']));

        return $match['before'].implode(' ', $classes).$match['after'];
    }

    public function setConfiguration(ConfigurationInterface $configuration)
    {
        $this->baseRenderer->setConfiguration($configuration);
        $this->config = $configuration;
    }
}
