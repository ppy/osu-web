<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Http\Controllers\Forum;

use App\Models\Forum\Forum;
use App\Models\Forum\Topic;
use App\Models\Forum\TopicCover;
use App\Transformers\Forum\TopicCoverTransformer;
use Auth;
use Request;

class TopicCoversController extends Controller
{
    public function __construct()
    {
        parent::__construct();

        $this->middleware('auth', ['only' => [
            'destroy',
            'store',
            'update',
        ]]);
    }

    public function store()
    {
        $params = get_params(Request::all(), null, [
            'cover_file:file',
            'forum_id:int',
            'topic_id:int',
        ], ['null_missing' => true]);

        if ($params['cover_file'] === null) {
            abort(422);
        }

        if ($params['topic_id'] === null) {
            if ($params['forum_id'] !== null) {
                $forum = Forum::findOrFail($params['forum_id']);
            }
        } else {
            $topic = Topic::with('forum')->findOrFail($params['topic_id']);

            if ($topic->cover !== null) {
                abort(422);
            }

            $forum = $topic->forum;
        }

        if (!isset($forum)) {
            abort(422, 'no forum specified');
        }

        priv_check('ForumTopicCoverStore', $forum)->ensureCan();

        $cover = TopicCover::upload(
            $params['cover_file'],
            Auth::user(),
            $topic ?? null,
        );

        return json_item($cover, new TopicCoverTransformer());
    }

    public function destroy($id)
    {
        $cover = TopicCover::find($id);

        if ($cover !== null) {
            priv_check('ForumTopicCoverEdit', $cover)->ensureCan();

            $cover->delete();
        }

        return json_item($cover, new TopicCoverTransformer());
    }

    public function update($id)
    {
        $cover = TopicCover::findOrFail($id);

        priv_check('ForumTopicCoverEdit', $cover)->ensureCan();

        if (Request::hasFile('cover_file') === true) {
            $cover = $cover->updateFile(
                Request::file('cover_file')->getRealPath(),
                Auth::user()
            );
        }

        return json_item($cover, new TopicCoverTransformer());
    }
}
