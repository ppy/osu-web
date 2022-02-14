<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Http\Controllers;

use App\Exceptions\ModelNotSavedException;
use App\Libraries\BeatmapsetDiscussionPostNew;
use App\Libraries\BeatmapsetDiscussionPostsBundle;
use App\Libraries\BeatmapsetDiscussionReview;
use App\Models\BeatmapDiscussion;
use App\Models\BeatmapDiscussionPost;
use App\Models\Beatmapset;
use App\Models\BeatmapsetWatch;
use App\Models\User;

/**
 @group Beatmapset Discussions
 */
class BeatmapDiscussionPostsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth', ['except' => ['index', 'show']]);
        $this->middleware('require-scopes:public', ['only' => ['index']]);

        return parent::__construct();
    }

    public function destroy($id)
    {
        $post = BeatmapDiscussionPost::whereNull('deleted_at')->findOrFail($id);
        priv_check('BeatmapDiscussionPostDestroy', $post)->ensureCan();

        try {
            $post->softDeleteOrExplode(auth()->user());
        } catch (ModelNotSavedException $e) {
            return error_popup($e->getMessage());
        }

        return $post->beatmapset->defaultDiscussionJson();
    }

    /**
     * Get Beatmapset Discussion Posts
     *
     * Returns the posts of beatmapset discussions.
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
     * beatmapsets   | [BeatmapsetCompact](#beatmapsetcompact)                 | |
     * cursor_string | [CursorString](#cursorstring)                           | |
     * posts         | [BeatmapsetDiscussionPost](#beatmapsetdiscussionpost)[] | |
     * users         | [UserCompact](#usercompact)                             | |
     *
     * @queryParam beatmapset_discussion_id `id` of the [BeatmapsetDiscussion](#beatmapsetdiscussion).
     * @queryParam limit Maximum number of results.
     * @queryParam page Search result page.
     * @queryParam sort `id_desc` for newest first; `id_asc` for oldest first. Defaults to `id_desc`.
     * @queryParam types[] `first`, `reply`, `system` are the valid values. Defaults to `reply`.
     * @queryParam user The `id` of the [User](#user).
     * @queryParam with_deleted This param has no effect as api calls do not currently receive group permissions.
     */
    public function index()
    {
        $bundle = new BeatmapsetDiscussionPostsBundle(request()->all());

        if (is_api_request()) {
            return $bundle->toArray();
        }

        $posts = $bundle->getPaginator();

        return ext_view('beatmap_discussion_posts.index', compact('posts'));
    }

    public function restore($id)
    {
        $post = BeatmapDiscussionPost::whereNotNull('deleted_at')->findOrFail($id);
        priv_check('BeatmapDiscussionPostRestore', $post)->ensureCan();

        $post->restore(auth()->user());

        return $post->beatmapset->defaultDiscussionJson();
    }

    public function show($id)
    {
        $post = BeatmapDiscussionPost::findOrFail($id);
        $discussion = $post->beatmapDiscussion;
        $beatmapset = $discussion->beatmapset;

        if ($beatmapset === null) {
            abort(404);
        }

        return ujs_redirect(route('beatmapsets.discussion', $beatmapset).'#/'.$discussion->getKey().'/'.$post->getKey());
    }

    public function store()
    {
        /** @var User $user */
        $user = auth()->user();
        $params = request()->all();

        [$discussion, $posts] = BeatmapsetDiscussionPostNew::create($user, $params);

        BeatmapsetWatch::markRead($discussion->beatmapset, $user);

        return [
            'beatmapset' => $discussion->beatmapset->defaultDiscussionJson(),
            'beatmap_discussion_post_ids' => array_pluck($posts, 'id'),
            'beatmap_discussion_id' => $discussion->getKey(),
        ];
    }

    public function update($id)
    {
        $post = BeatmapDiscussionPost::findOrFail($id);

        priv_check('BeatmapDiscussionPostEdit', $post)->ensureCan();

        $params = get_params(request()->all(), 'beatmap_discussion_post', ['message']);
        $params['last_editor_id'] = auth()->user()->user_id;

        if ($post->beatmapDiscussion->message_type === 'review' && $post->isFirstPost()) {
            // handle reviews (but not replies to the reviews)
            try {
                $document = json_decode($params['message'], true);
                BeatmapsetDiscussionReview::update($post->beatmapDiscussion, $document, auth()->user());
            } catch (\Exception $e) {
                throw new ModelNotSavedException($e->getMessage());
            }
        } else {
            $post->fill($params)->saveOrExplode();
        }

        return $post->beatmapset->defaultDiscussionJson();
    }
}
