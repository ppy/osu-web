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

namespace App\Models\Forum;

class ForumTrack extends Model
{
    protected $table = 'phpbb_forums_track';

    public $timestamps = false;
    protected $dates = ['mark_time'];
    protected $dateFormat = 'U';

    protected $primaryKeys = ['forum_id', 'user_id'];

    public static function markAsRead(Forum $forum, $user, $time)
    {
        $forums = Forum::whereIn('forum_id', $forum->allSubForums())->get();

        $forumIds = $forums->filter(function ($forum) use ($user) {
            return priv_check_user($user, 'ForumView', $forum)->can();
        })->pluck('forum_id');

        // update existing
        $query = static::where('user_id', $user->getKey())->whereIn('forum_id', $forumIds);
        $query->getConnection()->transaction(function () use ($forumIds, $query, $time, $user) {
            $query->update(['mark_time' => $time->getTimestamp()]);

            // insert any new forums
            $existingIds = $query->pluck('forum_id');
            $missingIds = $forumIds->diff($existingIds);

            foreach ($missingIds as $id) {
                static::create([
                    'forum_id' => $id,
                    'mark_time' => $time,
                    'user_id' => $user->getKey(),
                ]);
            }
        });
    }
}
