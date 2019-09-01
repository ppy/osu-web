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
use League\CommonMark\DocParser;
use League\CommonMark\Environment;
use App\Libraries\Markdown\Block\Element\WikiSection;
use App\Libraries\Markdown\Block\Parser\WikiSectionParser;
use App\Libraries\Markdown\Block\Renderer\WikiSectionRenderer;
use League\CommonMark\CommonMarkConverter;

class MainPageRenderer extends Renderer
{
    private $parser;
    private $converter;

    public function __construct($page, $body)
    {
        parent::__construct($page, $body);

        $env = Environment::createCommonMarkEnvironment();

        $env->addBlockParser(new WikiSectionParser);
        $env->addBlockRenderer(WikiSection::class, new WikiSectionRenderer);

        $this->parser = new DocParser($env);
        $this->converter = new CommonMarkConverter(OsuMarkdown::DEFAULT_CONFIG, $env);
    }

    /**
     * {@inheritdoc}
     */
    public function render()
    {
        $body = OsuMarkdown::parseYamlHeader($this->body);

        $page = [
            'header' => $body['header'],
            'output' => $this->converter->convertToHtml($body['document']),
        ];

        return $page;
    }
}
