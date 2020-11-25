<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Libraries\Wiki;

use App\Libraries\Markdown\OsuMarkdown;
use League\CommonMark\Block\Element as Block;
use League\CommonMark\DocParser;
use League\CommonMark\Environment;
use League\CommonMark\HtmlRenderer;
use League\CommonMark\Inline\Element as Inline;

class MainPageRenderer extends Renderer
{
    /** @var DocParser */
    private $parser;

    /** @var HtmlRenderer */
    private $renderer;

    public function __construct($page, $body)
    {
        parent::__construct($page, $body);

        $env = Environment::createCommonMarkEnvironment(OsuMarkdown::DEFAULT_CONFIG);

        $this->parser = new DocParser($env);
        $this->renderer = new HtmlRenderer($env);
    }

    /**
     * {@inheritdoc}
     */
    public function render()
    {
        $body = OsuMarkdown::parseYamlHeader($this->body);
        $document = $this->parser->parse($body['document']);

        $this->addClasses($document);

        $page = [
            'header' => $body['header'],
            'output' => $this->renderer->renderBlock($document),
        ];

        return $page;
    }

    /**
     * {@inheritdoc}
     */
    public function renderIndexable()
    {
        // returning nothing since the main page isn't searchable anyway
        return '';
    }

    /**
     * @param \League\CommonMark\Block\Element\Document $document
     * @return void
     */
    private function addClasses($document)
    {
        $walker = $document->walker();

        while ($event = $walker->next()) {
            $node = $event->getNode();

            $this->fixLinks($event, $node);

            if ($event->isEntering() || isset($node->data['attributes']['class'])) {
                continue;
            }

            $blockClass = 'wiki-main-page';
            $class = '';

            switch (get_class($node)) {
                case Block\Heading::class:
                    $class = "{$blockClass}__heading";
                    break;
                case Block\Paragraph::class:
                    $class = "{$blockClass}__paragraph";
                    break;
                case Inline\Link::class:
                    $class = "{$blockClass}__link";
                    break;
            }

            if (present($class)) {
                $node->data['attributes']['class'] = $class;
            }
        }
    }

    private function fixLinks($event, $node)
    {
        if (!$event->isEntering() || !($node instanceof Inline\AbstractWebResource)) {
            return;
        }

        // this assumes links are in form /wiki/Path/To/Page
        $relativeUrl = preg_replace('#^/wiki/#', './', $node->getUrl());

        $node->setUrl($relativeUrl);
    }
}
