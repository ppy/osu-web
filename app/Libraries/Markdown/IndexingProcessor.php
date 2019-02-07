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

namespace App\Libraries\Markdown;

use App\Libraries\OsuWiki;
use League\CommonMark\Block\Element as Block;
use League\CommonMark\Block\Element\Document;
use League\CommonMark\CommonMarkConverter;
use League\CommonMark\DocumentProcessorInterface;
use League\CommonMark\Environment;
use League\CommonMark\Inline\Element as Inline;
use League\CommonMark\Util\Configuration;
use League\CommonMark\Util\ConfigurationAwareInterface;
use Symfony\Component\Yaml\Exception\ParseException as YamlParseException;
use Symfony\Component\Yaml\Yaml;
use Webuni\CommonMark\TableExtension;

class IndexingProcessor
{
    public static function process($rawInput, $config)
    {
        $config = array_merge([
            'html_input' => 'strip',
        ], $config);

        $rawInput = strip_utf8_bom($rawInput);
        $input = static::parseYamlHeader($rawInput);
        $header = $input['header'] ?? [];

        if (!isset($config['fetch_title'])) {
            $config['fetch_title'] = !isset($header['title']);
        }

        $env = Environment::createCommonMarkEnvironment();
        $env->addExtension(new TableExtension\TableExtension);
        $env->addExtension(new IndexingTextRendererExtension);
        $converter = new CommonMarkConverter($config, $env);
        $converted = $converter->convertToHtml($input['document']);

        return $converted;
    }

    public static function test($name)
    {
        $body = OsuWiki::fetchContent($name);

        return static::process($body, []);
    }

    public static function parseYamlHeader($input)
    {
        $hasMatch = preg_match('#^(?:---\n(?<header>.+?)\n(?:---|\.\.\.)\n)(?<document>.+)$#s', $input, $matches);

        if ($hasMatch === 1) {
            try {
                $header = Yaml::parse($matches['header']);
            } catch (YamlParseException $_e) {
                $header = null;
            }

            return [
                'header' => $header,
                'document' => $matches['document'],
            ];
        }

        return ['document' => $input];
    }
}
