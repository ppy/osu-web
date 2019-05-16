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

namespace App\Http\Controllers\Forum;

use App\Exceptions\ImageProcessorException;
use App\Models\Forum\Topic;
use App\Models\Forum\TopicCover;
use App\Transformers\Forum\TopicCoverTransformer;
use Auth;
use Request;

class TopicCoversController extends Controller
{
    protected $section = 'community';

    public function __construct()
    {
        parent::__construct();

        view()->share('currentAction', 'forum-topic-covers-'.current_action());

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
