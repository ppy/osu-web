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

namespace App\Libraries\Search;

use Illuminate\Http\Request;

class MultiSearch
{
    const MODES = [
        'all' => null,
        'user' => [
            'type' => UserSearch::class,
            'paramsType' => UserSearchParams::class,
            'size' => 6,
        ],
        'beatmapset' => [
            'type' => BeatmapsetSearch::class,
            'paramsType' => BeatmapsetSearchParams::class,
            'size' => 8,
        ],
        'wiki_page' => [
            'type' => WikiSearch::class,
            'paramsType' => WikiSearchParams::class,
            'size' => 8,
        ],
        'forum_post' => [
            'type' => ForumSearch::class,
            'paramsType' => ForumSearchParams::class,
            'size' => 8,
        ],
    ];

    private $options;
    private $query;
    private $searches;
    private $request;


    public function __construct(Request $request, array $options = [])
    {

        $this->query = trim($request['query']);
        $this->options = $options;
        $this->request = $request;
    }

    public function getMode()
    {
        return $this->request['mode'] ?? 'all';
    }

    public function hasQuery()
    {
        return mb_strlen($this->query) >= config('osu.search.minimum_length');
    }

    public function searches()
    {
        if (!isset($this->searches)) {
            $this->searches = [];
            foreach (static::MODES as $mode => $settings) {
                if ($settings === null) {
                    $this->searches[$mode] = null;
                    continue;
                }

                $class = $settings['type'];
                $paramsClass = $settings['paramsType'];

                $params = $paramsClass::fromRequest($this->request, $this->options['user']);
                $params->applyParams($settings['options'] ?? []);
                $search = new $class($params);

                if ($this->getMode() === 'all') {
                    $search->page(1)->size($settings['size']);
                }

                $this->searches[$mode] = $search;
            }
        }

        return $this->searches;
    }
}
