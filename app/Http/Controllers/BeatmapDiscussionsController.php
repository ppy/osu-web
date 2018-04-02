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

namespace App\Http\Controllers;

use App\Exceptions\ModelNotSavedException;
use App\Models\BeatmapDiscussion;
use Auth;
use Illuminate\Pagination\LengthAwarePaginator;
use Request;

class BeatmapDiscussionsController extends Controller
{
    protected $section = 'beatmaps';

    public function __construct()
    {
        $this->middleware('auth', ['except' => 'show']);

        return parent::__construct();
    }

    public function allowKudosu($id)
    {
        $discussion = BeatmapDiscussion::findOrFail($id);
        priv_check('BeatmapDiscussionAllowOrDenyKudosu', $discussion)->ensureCan();

        try {
            $discussion->allowKudosu(Auth::user());
        } catch (ModelNotSavedException $e) {
            return error_popup($e->getMessage());
        }

        return $discussion->beatmapset->defaultDiscussionJson();
    }

    public function denyKudosu($id)
    {
        $discussion = BeatmapDiscussion::findOrFail($id);
        priv_check('BeatmapDiscussionAllowOrDenyKudosu', $discussion)->ensureCan();

        try {
            $discussion->denyKudosu(Auth::user());
        } catch (ModelNotSavedException $e) {
            return error_popup($e->getMessage());
        }

        return $discussion->beatmapset->defaultDiscussionJson();
    }

    public function destroy($id)
    {
        $discussion = BeatmapDiscussion::whereNull('deleted_at')->findOrFail($id);
        priv_check('BeatmapDiscussionDestroy', $discussion)->ensureCan();

        try {
            $discussion->softDeleteOrExplode(Auth::user());
        } catch (ModelNotSavedException $e) {
            return error_popup($e->getMessage());
        }

        return $discussion->beatmapset->defaultDiscussionJson();
    }

    public function index()
    {
        priv_check('BeatmapDiscussionModerate')->ensureCan();

        $params = request();

        // for when the priv_check lock above is removed
        if (!priv_check('BeatmapDiscussionModerate')->can()) {
            $params['with_deleted'] = false;
        }

        $search = BeatmapDiscussion::search($params);
        $discussions = new LengthAwarePaginator(
            $search['query']->with([
                    'user',
                    'beatmapset',
                    'startingPost',
                ])->get(),
            $search['query']->realCount(),
            $search['params']['limit'],
            $search['params']['page'],
            [
                'path' => route('beatmap-discussions.index'),
                'query' => $search['params'],
            ]
        );

        return view('beatmap_discussions.index', compact('discussions', 'search'));
    }

    public function restore($id)
    {
        $discussion = BeatmapDiscussion::whereNotNull('deleted_at')->findOrFail($id);
        priv_check('BeatmapDiscussionRestore', $discussion)->ensureCan();

        $discussion->restore(Auth::user());

        return $discussion->beatmapset->defaultDiscussionJson();
    }

    public function show($id)
    {
        $discussion = BeatmapDiscussion::findOrFail($id);

        if ($discussion->beatmapset === null) {
            abort(404);
        }

        return ujs_redirect(route('beatmapsets.discussion', $discussion->beatmapset).'#/'.$id);
    }

    public function vote($id)
    {
        $discussion = BeatmapDiscussion::findOrFail($id);

        priv_check('BeatmapDiscussionVote', $discussion)->ensureCan();

        $params = get_params(Request::all(), 'beatmap_discussion_vote', ['score:int']);
        $params['user_id'] = Auth::user()->user_id;

        if ($params['score'] < 0) {
            priv_check('BeatmapDiscussionVoteDown', $discussion)->ensureCan();
        }

        if ($discussion->vote($params)) {
            return $discussion->beatmapset->defaultDiscussionJson();
        } else {
            return error_popup(trans('beatmaps.discussion-votes.update.error'));
        }
    }
}
