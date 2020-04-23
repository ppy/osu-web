<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Libraries\Search;

use Illuminate\Http\Request;

class MultiSearch
{
    const MODES = [
        'all' => null,
        'user' => [
            'type' => UserSearch::class,
            'paramsType' => UserSearchRequestParams::class,
            'size' => 6,
        ],
        'beatmapset' => [
            'type' => BeatmapsetSearch::class,
            'paramsType' => BeatmapsetSearchRequestParams::class,
            'size' => 8,
        ],
        'wiki_page' => [
            'type' => WikiSearch::class,
            'paramsType' => WikiSearchRequestParams::class,
            'size' => 8,
        ],
        'forum_post' => [
            'type' => ForumSearch::class,
            'paramsType' => ForumSearchRequestParams::class,
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
        return presence($this->request['mode']) ?? 'all';
    }

    public function hasQuery()
    {
        return present($this->query);
    }

    public function searches()
    {
        if (!isset($this->searches)) {
            $this->searches = [];
            $error = null;

            foreach (static::MODES as $mode => $settings) {
                if ($settings === null) {
                    $this->searches[$mode] = null;
                    continue;
                }

                $class = $settings['type'];
                $paramsClass = $settings['paramsType'];

                $params = new $paramsClass($this->request->all(), $this->options['user']);
                $search = new $class($params);
                if ($search instanceof BeatmapsetSearch) {
                    $search->source(false);
                }

                if ($error !== null) {
                    $search->fail($error);
                } else {
                    if ($this->getMode() === 'all') {
                        $search->from(0)->size($settings['size']);
                        if ($this->hasQuery()) {
                            $search->response(); // FIXME: run query before counts for tab; need better way to do this.
                        }
                    } elseif ($this->getMode() === $mode) {
                        if ($this->hasQuery()) {
                            $search->response(); // FIXME: run query before counts for tab; need better way to do this.
                        }
                    }

                    $error = $search->getError();
                }

                $this->searches[$mode] = $search;
            }
        }

        return $this->searches;
    }
}
