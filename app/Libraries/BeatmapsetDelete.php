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

namespace App\Libraries;

use App\Models\Beatmapset;
use App\Models\Event;
use App\Models\User;

class BeatmapsetDelete
{
    /** @var Beatmapset */
    private $beatmapset;

    /** @var User */
    private $user;

    public function __construct(Beatmapset $beatmapset, User $user)
    {
        $this->user = $user;
        $this->beatmapset = $beatmapset;
    }

    public function run()
    {
        $this->beatmapset->getConnection()->transaction(function () {
            Event::generate(
                'beatmapsetDelete',
                ['beatmapset' => $this->beatmapset, 'user' => $this->user]
            );

            $post = $this->beatmapset->getPost();
            if ($post !== null) {
                $post->post_text = 'This map has been deleted on the request of its creator. It is no longer available.';
                $post->skipBeatmapPostRestrictions()->saveOrExplode();
            }

            $this->beatmapset->delete();
            // TODO:
            // delete file?
        });
    }
}
