<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Http\Controllers\Forum;

use App\Exceptions\ImageProcessorException;
use App\Models\Forum\Forum;
use App\Models\Forum\ForumCover;
use App\Transformers\Forum\ForumCoverTransformer;
use Auth;
use Request;

class ForumCoversController extends Controller
{
    public function __construct()
    {
        parent::__construct();

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
