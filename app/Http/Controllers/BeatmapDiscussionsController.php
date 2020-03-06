<?php

/**
 *    Copyright (c) ppy Pty Ltd <contact@ppy.sh>.
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
use App\Libraries\BeatmapsetDiscussionReview;
use App\Models\BeatmapDiscussion;
use App\Models\Beatmapset;
use App\Models\User;
use Auth;
use Illuminate\Pagination\Paginator;
use Request;

class BeatmapDiscussionsController extends Controller
{
    protected $section = 'beatmaps';

    public function __construct()
    {
        $this->middleware('auth', ['except' => ['index', 'show']]);

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
        $isModerator = priv_check('BeatmapDiscussionModerate')->can();
        $params = request();
        $params['is_moderator'] = $isModerator;

        if (!$isModerator) {
            $params['with_deleted'] = false;
        }

        $search = BeatmapDiscussion::search($params);

        $query = $search['query']->with([
            'beatmap',
            'beatmapDiscussionVotes',
            'beatmapset',
            'startingPost',
        ])->limit($search['params']['limit'] + 1);

        $paginator = new Paginator(
            $query->get(),
            $search['params']['limit'],
            $search['params']['page'],
            [
                'path' => Paginator::resolveCurrentPath(),
                'query' => $search['params'],
            ]
        );

        $discussions = $paginator->getCollection();

        // TODO: remove this when reviews are released
        $relatedDiscussions = [];
        if (config('osu.beatmapset.discussion_review_enabled')) {
            $children = BeatmapDiscussion::whereIn('parent_id', $discussions->pluck('id'))
                ->with([
                    'beatmap',
                    'beatmapDiscussionVotes',
                    'beatmapset',
                    'startingPost',
                ]);

            if ($isModerator) {
                $children->visibleWithTrashed();
            } else {
                $children->visible();
            }

            $relatedDiscussions = $children->get();
        }

        $userIds = [];
        foreach ($discussions->merge($relatedDiscussions) as $discussion) {
            $userIds[$discussion->user_id] = true;
            $userIds[$discussion->startingPost->last_editor_id] = true;
        }

        $users = User::whereIn('user_id', array_keys($userIds))
            ->with('userGroups')
            ->default()
            ->get();

        $jsonChunks = [
            'discussions' => json_collection(
                $discussions,
                'BeatmapDiscussion',
                ['starting_post', 'beatmap', 'beatmapset', 'current_user_attributes']
            ),
            'related-discussions' => json_collection(
                $relatedDiscussions,
                'BeatmapDiscussion',
                ['starting_post', 'beatmap', 'beatmapset', 'current_user_attributes']
            ),
            'users' => json_collection(
                $users,
                'UserCompact',
                ['group_badge']
            ),
        ];

        return ext_view('beatmap_discussions.index', compact('jsonChunks', 'search', 'paginator'));
    }

    public function restore($id)
    {
        $discussion = BeatmapDiscussion::whereNotNull('deleted_at')->findOrFail($id);
        priv_check('BeatmapDiscussionRestore', $discussion)->ensureCan();

        $discussion->restore(Auth::user());

        return $discussion->beatmapset->defaultDiscussionJson();
    }

    public function review()
    {
        // TODO: remove this when reviews are released
        if (!config('osu.beatmapset.discussion_review_enabled')) {
            abort(404);
        }

        priv_check('BeatmapsetDiscussionReviewStore')->ensureCan();

        $request = request()->all();
        $beatmapsetId = $request['beatmapset_id'] ?? null;
        $document = $request['document'] ?? [];

        $beatmapset = Beatmapset
            ::where('discussion_enabled', true)
            ->findOrFail($beatmapsetId);

        try {
            BeatmapsetDiscussionReview::create($beatmapset, $document, Auth::user());
        } catch (\Exception $e) {
            return error_popup($e->getMessage(), 422);
        }

        return $beatmapset->defaultDiscussionJson();
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
