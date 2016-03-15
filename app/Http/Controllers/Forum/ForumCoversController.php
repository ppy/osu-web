<?php

/**
 *    Copyright 2015 ppy Pty. Ltd.
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

        view()->share('current_action', 'forum-forum-covers-'.current_action());

        $this->middleware('auth', ['only' => [
            'destroy',
            'store',
            'update',
        ]]);

        if (Auth::check() === true && Auth::user()->isAdmin() !== true) {
            abort(403);
        }
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

        return fractal_item_array($cover, new ForumCoverTransformer());
    }

    public function destroy($id)
    {
        $cover = ForumCover::find($id);

        if ($cover !== null) {
            $cover->deleteWithFile();
        }

        return fractal_item_array($cover, new ForumCoverTransformer());
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

        return fractal_item_array($cover, new ForumCoverTransformer());
    }
}
