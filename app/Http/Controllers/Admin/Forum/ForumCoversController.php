<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Http\Controllers\Admin\Forum;

use App\Http\Controllers\Admin\Controller;
use App\Models\Forum\Forum;
use App\Models\Forum\ForumCover;
use Auth;
use Request;

class ForumCoversController extends Controller
{
    private $params = [];

    public function index()
    {
        $forums = Forum::with('cover')->get();

        return ext_view('admin.forum.forum_covers.index', compact('forums'));
    }

    public function store()
    {
        if (($this->coverParams()['forum_id'] ?? null) === null) {
            abort(422);
        }

        $cover = ForumCover::firstOrCreate(['forum_id' => $this->coverParams()['forum_id']]);

        $cover->update($this->coverParams());

        return redirect(route('admin.forum.forum-covers.index').'#forum-'.$cover->forum_id);
    }

    public function update($id)
    {
        $cover = ForumCover::findOrFail($id);

        $cover->update($this->coverParams());

        return redirect(route('admin.forum.forum-covers.index').'#forum-'.$cover->forum_id);
    }

    private function coverParams()
    {
        if (isset($this->params['cover']) === false) {
            $this->params['cover'] = get_params(Request::all(), 'forum_cover', [
                'forum_id:int',

                'main_cover.cover_file:file',
                'main_cover._delete:bool',

                'default_topic_cover.cover_file:file',
                'default_topic_cover._delete:bool',
            ]);
            $this->params['cover']['user_id'] = Auth::user()->user_id;
        }

        return $this->params['cover'];
    }
}
