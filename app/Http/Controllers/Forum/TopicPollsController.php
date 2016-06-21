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

use App\Models\Forum\PollVote;
use App\Models\Forum\Topic;
use Auth;
use Request;

class TopicPollsController extends Controller
{
    protected $section = 'community';

    public function __construct()
    {
        parent::__construct();

        view()->share('current_action', 'forum-topic-polls-'.current_action());

        $this->middleware('auth', ['only' => [
            'vote',
        ]]);
    }

    public function vote()
    {
        $topic = Topic::findOrFail(Request::get('topic_id'));

        priv_check('ForumTopicVote', $topic)->ensureCan();

        $params = get_params(Request::input(), 'forum_topic_vote', ['option_ids:int[]']);

        if (PollVote::vote($topic, $params['option_ids'], Auth::user(), Request::ip())) {
            return ujs_redirect(route('forum.topics.show', $topic->topic_id));
        } else {
            abort(422);
        }
    }
}
