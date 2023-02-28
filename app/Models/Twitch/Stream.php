<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Models\Twitch;

class Stream
{
    public $data = null;

    public function __construct($data)
    {
        $this->data = $data;
    }

    public function url()
    {
        return "https://twitch.tv/{$this->data['user_login']}";
    }

    public function preview($width, $height)
    {
        return strtr($this->data['thumbnail_url'], [
            '{height}' => $height,
            '{width}' => $width,
        ]);
    }
}
