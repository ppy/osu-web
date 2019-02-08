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

namespace App\Libraries\Markdown\Indexing;

use App\Libraries\Markdown\ParsesHeader;
use League\CommonMark\CommonMarkConverter;
use League\CommonMark\Environment;
use Webuni\CommonMark\TableExtension;

class IndexingProcessor
{
    use ParsesHeader;

    public static function process($rawInput, $config)
    {
        $config = array_merge([
            'html_input' => 'strip',
        ], $config);

        $rawInput = strip_utf8_bom($rawInput);
        $input = static::parseYamlHeader($rawInput);

        $env = Environment::createCommonMarkEnvironment();
        $env->addExtension(new TableExtension\TableExtension);
        $env->addExtension(new RendererExtension);
        $converter = new CommonMarkConverter($config, $env);
        $converted = $converter->convertToHtml($input['document']);

        return $converted;
    }
}
