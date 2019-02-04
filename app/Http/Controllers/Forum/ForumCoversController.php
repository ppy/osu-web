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
use App\Models\Forum\Forum;
use App\Models\Forum\ForumCover;
use App\Transformers\Forum\ForumCoverTransformer;
use Auth;
use Request;

class ForumCoversController extends Controller
{
    protected $section = 'community';

    public function __construct()
    {
        parent::__construct();

        view()->share('currentAction', 'forum-forum-covers-'.current_action());

        $this->middleware('auth', ['only' => [
            'destroy',
            'store',
            'update',
        ]]);

        $this->middleware(function ($request, $next) {
            if (Auth::check() && !Auth::user()->isAdmin()) {
                abort(403);
            }

            return $next($request);
        });
    }

    public function store()
    {
        if (Request::hasFile('cover_file') !== true) {
            abort(422);
        }

        $forum = Forum::findOrFail(Request::input('forum_id'));

        if ($forum->cover !== null) {
            abort(422);
        }

        try {
            $cover = ForumCover::upload(
                Request::file('cover_file')->getRealPath(),
                Auth::user(),
                $forum
            );
        } catch (ImageProcessorException $e) {
            return error_popup($e->getMessage());
        }

        return json_item($cover, new ForumCoverTransformer());
    }

    public function destroy($id)
    {
        $cover = ForumCover::find($id);

        if ($cover !== null) {
            $cover->deleteWithFile();
        }

        return json_item($cover, new ForumCoverTransformer());
    }

    public function update($id)
    {
        $cover = ForumCover::findOrFail($id);

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

        return json_item($cover, new ForumCoverTransformer());
    }
}
