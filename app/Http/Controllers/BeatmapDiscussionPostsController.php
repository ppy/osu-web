<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Http\Controllers;

use App\Exceptions\ModelNotSavedException;
use App\Libraries\BeatmapsetDiscussion\Discussion;
use App\Libraries\BeatmapsetDiscussion\Reply;
use App\Libraries\BeatmapsetDiscussion\Review;
use App\Libraries\BeatmapsetDiscussionPostsBundle;
use App\Models\BeatmapDiscussion;
use App\Models\BeatmapDiscussionPost;
use App\Models\Beatmapset;
use App\Models\BeatmapsetWatch;
use App\Models\User;

/**
 * @group Beatmapset Discussions
 */
class BeatmapDiscussionPostsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth', ['except' => ['index', 'show']]);
        $this->middleware('require-scopes:public', ['only' => ['index']]);
        $this->middleware('require-scopes:beatmap_discussion.write', ['only' => [
            'store',
            'update'
        ]]);

        parent::__construct();
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
     * beatmapsets   | [Beatmapset](#beatmapset)                               | |
     * cursor_string | [CursorString](#cursorstring)                           | |
     * posts         | [BeatmapsetDiscussionPost](#beatmapsetdiscussionpost)[] | |
     * users         | [User](#user)                                           | |
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

    /**
     * Create a new Beatmapset Discussion Post. 
     * 
     * Replies to a Beatmapset Discussion or creates a new one.
     * 
     * ---
     *
     * ### Response Format
     *
     * Field                             | Type                                                    | Description
     * --------------------------------- | ------------------------------------------------------- | -----------
     * beatmapset                        | [Beatmapset](#beatmapset)                               |                                                    |
     * beatmap_discussion_post_ids       | integer[]                                               | id of Beatmapset Discussion Posts that are created |
     * beatmap_discussion_id             | integer                                                 | id of the Beatmapset Discussion                    |
     *
     * @bodyParam beatmap_discussion_id integer `id` of the [BeatmapsetDiscussion](#beatmapsetdiscussion) to reply to. Example: 1
     * @bodyParam beatmapset_id integer `id` of the [Beatmapset](#beatmapset) to create a new discussion for. Required if no `beatmap_discussion_id` is provided. No-example
     * @bodyParam beatmap_discussion_post[message] string required Message content as plain text. Example: hello 
     * @bodyParam beatmap_discussion[message_type] [MessageType](#messagetype), required when creating a new discussion No-example
     * @bodyParam beatmap_discussion[timestamp] integer Will place the post in the timeline tab at the given timestamp when creating a new discussion. No-example
     * @bodyParam beatmap_discussion[beatmap_id] integer `id` of the [Beatmap](#beatmap) the discussion addresses. Required when `timestamp` is being used. No-example
     * @bodyParam beatmap_discussion[resolved] boolean Changes resolved status of a discussion. Example: true 
     */
    public function store()
    {
        /** @var User $user */
        $user = auth()->user();
        $request = request()->all();

        $discussionId = get_int($request['beatmap_discussion_id'] ?? null);
        $beatmapsetId = get_int($request['beatmapset_id'] ?? null);

        $message = presence(get_string($request['beatmap_discussion_post']['message'] ?? null));

        if ($discussionId !== null) {
            $discussion = BeatmapDiscussion::findOrFail($discussionId);
            $resolve = get_bool($request['beatmap_discussion']['resolved'] ?? null);
            $posts = (new Reply($user, $discussion, $message, $resolve))->handle();

            $beatmapset = $discussion->beatmapset;
        } elseif ($beatmapsetId !== null) {
            $beatmapset = Beatmapset::findOrFail($beatmapsetId);
            $discussionParams = get_params($request, 'beatmap_discussion', [
                'beatmap_id:int',
                'message_type',
                'timestamp:int',
            ], ['null_missing' => true]);

            [$discussion, $posts] = (new Discussion($user, $beatmapset, $discussionParams, $message))->handle();
        } else {
            abort(404);
        }

        BeatmapsetWatch::markRead($beatmapset, $user);

        return [
            'beatmapset' => $beatmapset->defaultDiscussionJson(),
            'beatmap_discussion_post_ids' => array_pluck($posts, 'id'),
            'beatmap_discussion_id' => $discussion->getKey(),
        ];
    }

    /**
     * Edit Beatmapset Discussion Post
     * 
     * Edit specified beatmapset discussion post.
     * 
     * ---
     * 
     * ### Response Format
     *
     * [Beatmapset](#beatmapset)
     *
     * @urlParam post integer required Id of the post. Example: 1
     *
     * @bodyParam beatmap_discussion_post[message] string required New post content in plaintext. Example: hello
     */
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
                Review::update($post->beatmapDiscussion, $document, auth()->user());
            } catch (\Exception $e) {
                throw new ModelNotSavedException($e->getMessage());
            }
        } else {
            $post->fill($params)->saveOrExplode();
        }

        return $post->beatmapset->defaultDiscussionJson();
    }
}
