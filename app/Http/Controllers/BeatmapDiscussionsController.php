<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

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

    public function review($beatmapsetId)
    {
        // TODO: remove this when reviews are released
        if (!config('osu.beatmapset.discussion_review_enabled')) {
            abort(404);
        }

        $beatmapset = Beatmapset
            ::where('discussion_enabled', true)
            ->findOrFail($beatmapsetId);

        priv_check('BeatmapsetDiscussionReviewStore', $beatmapset)->ensureCan();

        try {
            $document = json_decode(request()->all()['document'] ?? '[]', true);
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
