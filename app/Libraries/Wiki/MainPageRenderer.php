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
use App\Libraries\Markdown\OsuMarkdownProcessor;
use League\CommonMark\Block\Element\Heading;
use League\CommonMark\DocParser;
use League\CommonMark\Environment;
use League\CommonMark\Inline\Element\Link;

class MainPageRenderer extends Renderer
{
    private $parser;

    public function __construct($page, $body)
    {
        parent::__construct($page, $body);

        $env = Environment::createCommonMarkEnvironment();
        $this->parser = new DocParser($env);
    }

    /**
     * @param \League\CommonMark\Block\Element\Document $document
     * @return array[]
     */
    private function getElements($document)
    {
        $walker = $document->walker();

        $sections = [];
        $heading = [];

        while ($event = $walker->next()) {
            $node = $event->getNode();

            if (!$event->isEntering() && !($node instanceof Heading)) {
                continue;
            }

            if ($node instanceof Heading) {
                if ($event->isEntering()) {
                    $heading = [
                        'level' => $node->getLevel(),
                        'text' => OsuMarkdownProcessor::getText($node),
                    ];
                } else {
                    array_push($sections, $heading);
                }
            } elseif ($node instanceof Link) {
                $heading['url'] = $node->getUrl();
            }
        }

        return $sections;
    }

    /**
     * {@inheritdoc}
     */
    public function render()
    {
        $body = OsuMarkdown::parseYamlHeader($this->body);

        $document = $this->parser->parse($body['document']);
        $elements = $this->getElements($document);

        $page = [
            'header' => $body['header'],
            'output' => view('wiki.generators.main', ['elements' => array_slice($elements, 1)])->render(),
        ];

        $page['header']['title'] = $elements[0]['text'];

        return $page;
    }
}
