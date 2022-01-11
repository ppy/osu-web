<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Http\Controllers;

use App\Exceptions\ModelNotSavedException;
use App\Libraries\BeatmapsetDiscussionReview;
use App\Libraries\BeatmapsetDiscussionsBundle;
use App\Models\BeatmapDiscussion;
use App\Models\Beatmapset;
use Auth;
use Request;

/**
 @group Beatmapset Discussions
 */
class BeatmapDiscussionsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth', ['except' => ['index', 'show']]);
        $this->middleware('require-scopes:public', ['only' => ['index']]);

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

    /**
     * Get Beatmapset Discussions
     *
     * Returns a list of beatmapset discussions.
     *
     * ---
     *
     * ### Response Format
     *
     * <aside class="warning">
     *   The response of this endpoint is likely to change soon!
     * </aside>
     *
     * Field                     | Type                                            | Description
     * ------------------------- | ----------------------------------------------- | -----------------------------------------------------------------------
     * beatmaps                  | [Beatmap](#beatmap)[]                           | List of beatmaps associated with the discussions returned.
     * cursor_string             | string?                                         | |
     * discussions               | [BeatmapsetDiscussion](#beatmapsetdiscussion)[] | List of discussions according to `sort` order.
     * included_discussions      | [BeatmapsetDiscussion](#beatmapsetdiscussion)[] | Additional discussions related to `discussions`.
     * reviews_config.max_blocks | number                                          | Maximum number of blocks allowed in a review.
     * users                     | [UserCompact](#usercompact)[]                   | List of users associated with the discussions returned.
     *
     * @queryParam beatmap_id `id` of the [Beatmap](#beatmap).
     * @queryParam beatmapset_id `id` of the [Beatmapset](#beatmapset).
     * @queryParam beatmapset_status One of `all`, `ranked`, `qualified`, `disqualified`, `never_qualified`. Defaults to `all`. TODO: better descriptions.
     * @queryParam limit Maximum number of results.
     * @queryParam message_types[] `suggestion`, `problem`, `mapper_note`, `praise`, `hype`, `review`. Blank defaults to all types. TODO: better descriptions.
     * @queryParam only_unresolved `true` to show only unresolved issues; `false`, otherwise. Defaults to `false`.
     * @queryParam page Search result page.
     * @queryParam sort `id_desc` for newest first; `id_asc` for oldest first. Defaults to `id_desc`.
     * @queryParam user The `id` of the [User](#user).
     * @queryParam with_deleted This param has no effect as api calls do not currently receive group permissions.
     */
    public function index()
    {
        $bundle = new BeatmapsetDiscussionsBundle(request()->all());

        $json = $bundle->toArray();

        if (is_api_request()) {
            return $json;
        }

        $paginator = $bundle->getPaginator();
        $search = $bundle->getSearchParams();

        return ext_view('beatmap_discussions.index', compact('json', 'search', 'paginator'));
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

        return ujs_redirect(route('beatmapsets.discussion', $discussion->beatmapset).'#/'.$discussion->getKey());
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
            return error_popup(osu_trans('beatmaps.discussion-votes.update.error'));
        }
    }
}
