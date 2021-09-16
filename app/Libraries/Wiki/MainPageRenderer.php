<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Libraries\Wiki;

use App\Libraries\Markdown\OsuMarkdown;
use League\CommonMark\Environment\Environment;
use League\CommonMark\Extension\CommonMark\CommonMarkCoreExtension;
use League\CommonMark\Extension\CommonMark\Node\Block\Heading;
use League\CommonMark\Extension\CommonMark\Node\Inline\AbstractWebResource;
use League\CommonMark\Extension\CommonMark\Node\Inline\Link;
use League\CommonMark\Node\Block\Document;
use League\CommonMark\Node\Block\Paragraph;
use League\CommonMark\Node\Node;
use League\CommonMark\Node\NodeWalkerEvent;
use League\CommonMark\Parser\MarkdownParser;
use League\CommonMark\Renderer\HtmlRenderer;

class MainPageRenderer extends Renderer
{
    private MarkdownParser $parser;

    private HtmlRenderer $renderer;

    public function __construct($page, $body)
    {
        parent::__construct($page, $body);

        $config = array_merge(
            OsuMarkdown::DEFAULT_COMMONMARK_CONFIG,
            ['html_input' => 'allow'],
        );

        $env = new Environment($config);
        $env->addExtension(new CommonMarkCoreExtension());

        $this->parser = new MarkdownParser($env);
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
            'output' => $this->renderer->renderDocument($document)->getContent(),
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
    private function addClasses(Document $document)
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
                case Heading::class:
                    $class = "{$blockClass}__heading";
                    break;
                case Paragraph::class:
                    $class = "{$blockClass}__paragraph";
                    break;
                case Link::class:
                    $class = "{$blockClass}__link";
                    break;
            }

            if (present($class)) {
                $node->data->set('attributes/class', $class);
            }
        }
    }

    private function fixLinks(NodeWalkerEvent $event, Node $node)
    {
        if (!$event->isEntering() || !($node instanceof AbstractWebResource)) {
            return;
        }

        // this assumes links are in form /wiki/Path/To/Page
        $relativeUrl = preg_replace('#^/wiki/#', './', $node->getUrl());

        $node->setUrl($relativeUrl);
    }
}
