<?php

/**
 *    Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
 *    See the LICENCE file in the repository root for full licence text.
 */

namespace App\Http\Controllers;

use App\Models\BeatmapDiscussionVote;
use Illuminate\Pagination\LengthAwarePaginator;

class BeatmapsetDiscussionVotesController extends Controller
{
    protected $section = 'beatmaps';
    protected $actionPrefix = 'beatmapset_discussion_votes-';

    public function index()
    {
        $params = request();
        $params['is_moderator'] = priv_check('BeatmapDiscussionModerate')->can();

        $search = BeatmapDiscussionVote::search($params);
        $votes = new LengthAwarePaginator(
            $search['query']->with([
                    'user',
                    'beatmapDiscussion',
                    'beatmapDiscussion.user',
                    'beatmapDiscussion.beatmapset',
                    'beatmapDiscussion.startingPost',
                ])->get(),
            $search['query']->realCount(),
            $search['params']['limit'],
            $search['params']['page'],
            [
                'path' => LengthAwarePaginator::resolveCurrentPath(),
                'query' => $search['params'],
            ]
        );

        return view('beatmapset_discussion_votes.index', compact('votes'));
    }
}
