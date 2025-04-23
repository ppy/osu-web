<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Libraries\Search;

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
        'artist_track' => [
            'type' => ArtistTrackSearch::class,
            'paramsType' => ArtistTrackSearchRequestParams::class,
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

    public function __construct(private array $request, array $options = [])
    {
        if (isset($this->request['mode'])) {
            $this->request['mode'] = presence(get_string($this->request['mode']));
        }
        if (isset($this->request['query'])) {
            $this->request['query'] = get_string($this->request['query']);
        }
        if (isset($this->request['username'])) {
            $this->request['username'] = presence(get_string($this->request['username']));
        }
        $this->query = trim($this->request['query'] ?? '');
        $this->options = $options;
    }

    public function getMode()
    {
        return $this->request['mode'] ?? 'all';
    }

    public function getRawQuery(): ?string
    {
        return $this->request['query'] ?? null;
    }

    public function hasQuery()
    {
        return present($this->query)
            || ($this->getMode() === 'forum_post' && isset($this->request['username']));
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

                $params = new $paramsClass($this->request, $this->options['user']);
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
