<?php

/**
 *    Copyright 2015-2017 ppy Pty. Ltd.
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

namespace App\Libraries;

use App\Models\Beatmapset;
use App\Models\Forum\Post as ForumPost;
use App\Models\User;
use App\Models\Wiki\Page as WikiPage;

class Search
{
    const MODES = [
        'all',

        'beatmapset',
        'forum_post',
        'user',
        'wiki_page',
    ];

    private $cache = [];
    public $params;
    public $user;
    public $requestedLocale;

    public function __construct($params)
    {
        $this->mode = array_pull($params, 'mode') ?? static::MODES[0];
        if (!in_array($this->mode, static::MODES, true)) {
            $this->mode = static::MODES[0];
        }

        if ($this->mode === 'all') {
            $params['limit'] = 8;
        }

        $this->user = array_pull($params, 'user');
        $this->params = $params;
    }

    public function all()
    {
        $all = [];

        foreach (static::MODES as $i => $mode) {
            if ($i === 0) {
                continue;
            }

            if ($this->mode === static::MODES[0] || $this->mode === $mode) {
                $all[$mode] = $this->search($mode);

                if ($this->mode !== static::MODES[0] && isset($all[$mode]['params'])) {
                    $this->params = $all[$mode]['params'];
                }
            }
        }

        return $all;
    }

    public function search($mode)
    {
        if ($mode === static::MODES[0]) {
            return;
        }

        if ($this->mode !== static::MODES[0] && $this->mode !== $mode) {
            return;
        }

        $function = 'search'.studly_case($mode);

        return $this->$function();
    }

    public function searchBeatmapset()
    {
        if (!array_key_exists(__FUNCTION__, $this->cache)) {
            $this->cache[__FUNCTION__] = Beatmapset::search($this->params);
        }

        return $this->cache[__FUNCTION__];
    }

    public function searchForumPost()
    {
        if (!array_key_exists(__FUNCTION__, $this->cache)) {
            $this->cache[__FUNCTION__] = ForumPost::search($this->params);
        }

        return $this->cache[__FUNCTION__];
    }

    public function searchUser()
    {
        if (!array_key_exists(__FUNCTION__, $this->cache)) {
            $this->cache[__FUNCTION__] = User::search($this->params);
        }

        return $this->cache[__FUNCTION__];
    }

    public function searchWikiPage()
    {
        if (!array_key_exists(__FUNCTION__, $this->cache)) {
            $this->cache[__FUNCTION__] = WikiPage::search($this->params, $this->requestedLocale);
        }

        return $this->cache[__FUNCTION__];
    }

    public function url($newParams)
    {
        if ($this->mode === static::MODES[0]) {
            $newParams['limit'] = null;
        }

        $newParams['mode'] ?? ($newParams['mode'] = $this->mode);

        if ($newParams['mode'] === static::MODES[0]) {
            $newParams['mode'] = null;
        }

        return route('search', array_merge($this->params, $newParams));
    }
}
