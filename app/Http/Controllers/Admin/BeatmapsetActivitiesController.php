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

namespace App\Http\Controllers\Admin;

use App\Models\BeatmapDiscussion;
use App\Models\BeatmapDiscussionPost;
use App\Models\BeatmapDiscussionVote;
use App\Models\BeatmapsetEvent;
use App\Models\User;

class BeatmapsetActivitiesController extends Controller
{
    protected $section = 'admin';
    protected $actionPrefix = 'beatmapset_activities-';

    public function index($userId)
    {
        $user = User::findOrFail($userId);
        $params = [
            'limit' => 10,
            'sort' => 'id-desc',
            'user' => $user->getKey(),
        ];

        $discussions = BeatmapDiscussion::search($params);
        $discussions['items'] = $discussions['query']->get();

        $posts = BeatmapDiscussionPost::search($params);
        $posts['items'] = $posts['query']->get();

        $events = BeatmapsetEvent::search($params);
        $events['items'] = $events['query']->get();

        $votes = BeatmapDiscussionVote::search($params);
        $votes['items'] = $votes['query']->get();

        $receivedVotes = BeatmapDiscussionVote::search(array_merge($params, [
            'receiver' => $user->getKey(),
            'user' => null,
        ]));
        $receivedVotes['items'] = $receivedVotes['query']->get();

        return view('admin.beatmapset_activities.index', compact(
            'discussions',
            'events',
            'posts',
            'user',
            'receivedVotes',
            'votes'
        ));
    }
}
