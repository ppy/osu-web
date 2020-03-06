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

namespace App\Http\Controllers\Admin\Forum;

use App\Http\Controllers\Admin\Controller;
use App\Models\Forum\Forum;
use App\Models\Forum\ForumCover;
use Auth;
use Request;

class ForumCoversController extends Controller
{
    protected $section = 'admin-forum';
    protected $actionPrefix = 'forum-covers-';
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
