<?php

/**
 *    Copyright (c) ppy Pty Ltd <contact@ppy.sh>.
 *
 *    This file is part of osu!web. osu!web is distributed with the hope of
 *    attracting more community contributions to the core ecosystem of osu!.
 *
 *    osu!web is free software: you can redistribute it and/or modify
 *    it under the terms of the Affero GNU General Public License version 3
 *    as published by the Free Software Foundation.
 *
 *    osu!web is distributed WITHOUT ANY WARRANTY; without even the implied
 *    warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
 *    See the GNU Affero General Public License for more details.
 *
 *    You should have received a copy of the GNU Affero General Public License
 *    along with osu!web.  If not, see <http://www.gnu.org/licenses/>.
 */

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
     * @param \League\CommonMark\Block\Element\Document $document
     * @return void
     */
    private function addClasses($document)
    {
        $walker = $document->walker();

        while ($event = $walker->next()) {
            $node = $event->getNode();

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
}
