<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Http\Controllers;

use App\Libraries\BeatmapsetDiscussionVotesBundle;

/**
 @group Beatmapset Discussions
 */
class BeatmapsetDiscussionVotesController extends Controller
{
    public function __construct()
    {
        $this->middleware('require-scopes:public');

        return parent::__construct();
    }

    /**
     * Get Beatmapset Discussion Votes
     *
     * Returns the votes given to beatmapset discussions.
     *
     * ---
     *
     * ### Response Format
     *
     * <aside class="warning">
     *   The response of this endpoint is likely to change soon!
     * </aside>
     *
     * Field         | Type                                                    | Description
     * ------------- | ------------------------------------------------------- | -----------
     * cursor_string | [CursorString](#cursorstring)                           | |
     * discussions   | [BeatmapsetDiscussion](#beatmapsetdiscussion)           | |
     * users         | [UserCompact](#usercompact)                             | |
     * votes         | [BeatmapsetDiscussionVote](#beatmapsetdiscussionvote)[] | |
     *
     * @queryParam beatmapset_discussion_id `id` of the [BeatmapsetDiscussion](#beatmapsetdiscussion).
     * @queryParam limit Maximum number of results.
     * @queryParam page Search result page.
     * @queryParam receiver The `id` of the [User](#user) receiving the votes.
     * @queryParam score `1` for up vote, `-1` for down vote.
     * @queryParam sort `id_desc` for newest first; `id_asc` for oldest first. Defaults to `id_desc`.
     * @queryParam user The `id` of the [User](#user) giving the votes.
     * @queryParam with_deleted This param has no effect as api calls do not currently receive group permissions.
     */
    public function index()
    {
        $bundle = new BeatmapsetDiscussionVotesBundle(request()->all());

        if (is_api_request()) {
            return $bundle->toArray();
        }

        $votes = $bundle->getPaginator();

        return ext_view('beatmapset_discussion_votes.index', compact('votes'));
    }
}
