<?php

/**
 *    Copyright 2015-2018 ppy Pty. Ltd.
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

namespace App\Models\Wiki;

use App\Exceptions\GitHubNotFoundException;
use App\Libraries\OsuWiki;
use League\CommonMark\CommonMarkConverter;
use League\CommonMark\Environment;
use Symfony\Component\Yaml\Yaml;

class MainPage extends Page
{
    private $env;
    private $converter;

    public function __construct($path, $locale, $esCache = null)
    {
        parent::__construct($path, $locale, $esCache);

        $this->env = Environment::createCommonMarkEnvironment();
        $config = [
            'html_input' => 'strip',
        ];

        $this->converter = new CommonMarkConverter($config, $this->env);
    }

    public function pagePath()
    {
        return $this->path.'/'.$this->locale.'.yaml';
    }

    public function pageContent()
    {
        try {
            $sections = OsuWiki::fetchContent('wiki/'.$this->pagePath());
        } catch (GitHubNotFoundException $e) {
            $sections = null;
        }

        if (present($sections)) {
            $sections = $this->parseArray(Yaml::parse($sections));

            return [
                'output' => view('wiki.generators._main', compact('sections'))->render(),
            ];
        }
    }

    public function isQueryable()
    {
        return false;
    }

    public function pageTemplate()
    {
        return 'wiki.main';
    }

    public function title()
    {
        return 'Main Page';
    }

    private function parseArray($array, $depth = 0)
    {
        if ($depth > 3) {
            return;
        }

        $newArray = [];

        foreach ($array as $key => $val) {
            $key = $this->parseString($key);

            if (is_array($val)) {
                $val = $this->parseArray($val, $depth + 1);
            } else {
                $val = $this->parseString($val);
            }

            // if one of a list elements' is another list, while
            // it also has a key, it gets wrapped in an unnecessary
            // array. we're removing it here.
            if (is_array($val) && count($val) === 1) {
                foreach ($val as $newkey => $newval) {
                    $key = $newkey;
                    $val = $newval;
                }
            }

            $newArray[$key] = $val;
        }

        return $newArray;
    }

    private function parseString($string)
    {
        $string = $this->converter->convertToHtml($string);

        // commonmark wraps every paragraph in <p> tags
        return preg_replace('/<\/?p>/', '', $string);
    }
}
