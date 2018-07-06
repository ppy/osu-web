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

namespace App\Models\Twitch;

class Stream
{
    public $data = null;
    private $username = null;

    public function __construct($data)
    {
        $this->data = $data;
    }

    public function username()
    {
        if ($this->username === null) {
            // FIXME: shady method of getting username without fetching user object
            $this->username = preg_replace('/(^.*live_user_|-\{width\}x.*$)/', '', $this->data['thumbnail_url']);
        }

        return $this->username;
    }

    public function url()
    {
        return "https://twitch.tv/{$this->username()}";
    }

    public function preview($width, $height)
    {
        return str_replace(
            '{height}',
            $height,
            str_replace(
                '{width}',
                $width,
                $this->data['thumbnail_url']
            )
        );
    }
}
