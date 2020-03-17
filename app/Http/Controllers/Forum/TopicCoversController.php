<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Http\Controllers\Forum;

use App\Exceptions\ImageProcessorException;
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
        if (Request::hasFile('cover_file') !== true) {
            abort(422);
        }

        $topic = null;

        if (presence(Request::input('topic_id')) !== null) {
            $topic = Topic::with('forum')->findOrFail(Request::input('topic_id'));

            priv_check('ForumTopicCoverStore', $topic->forum)->ensureCan();
            if ($topic->cover !== null) {
                abort(422);
            }
        }

        try {
            $cover = TopicCover::upload(
                Request::file('cover_file')->getRealPath(),
                Auth::user(),
                $topic
            );
        } catch (ImageProcessorException $e) {
            return error_popup($e->getMessage());
        }

        return json_item($cover, new TopicCoverTransformer());
    }

    public function destroy($id)
    {
        $cover = TopicCover::find($id);

        if ($cover !== null) {
            priv_check('ForumTopicCoverEdit', $cover)->ensureCan();

            $cover->deleteWithFile();
        }

        return json_item($cover, new TopicCoverTransformer());
    }

    public function update($id)
    {
        $cover = TopicCover::findOrFail($id);

        priv_check('ForumTopicCoverEdit', $cover)->ensureCan();

        if (Request::hasFile('cover_file') === true) {
            try {
                $cover = $cover->updateFile(
                    Request::file('cover_file')->getRealPath(),
                    Auth::user()
                );
            } catch (ImageProcessorException $e) {
                return error_popup($e->getMessage());
            }
        }

        return json_item($cover, new TopicCoverTransformer());
    }
}
