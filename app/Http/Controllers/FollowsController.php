<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Http\Controllers;

use App\Exceptions\ModelNotSavedException;
use App\Models\Follow;
use App\Models\Forum\Topic;
use App\Models\Forum\TopicTrack;
use App\Models\Forum\TopicWatch;
use Exception;

class FollowsController extends Controller
{
    public function __construct()
    {
        parent::__construct();

        $this->middleware('auth');
    }

    public function destroy()
    {
        $params = $this->getParams();
        $follow = Follow::where($params)->first();

        if ($follow !== null) {
            $follow->delete();
        }

        return response([], 204);
    }

    public function index($subtype = null)
    {
        view()->share('subtype', $subtype);

        switch ($subtype) {
            case 'forum_topic':
                return $this->indexForumTopic();
            case 'beatmapset_modding':
                return $this->indexBeatmapsetModding();
            default:
                return ujs_redirect(route('follows.index', ['subtype' => Follow::DEFAULT_SUBTYPE]));
        }
    }

    public function store()
    {
        $params = $this->getParams();
        $follow = new Follow($params);

        try {
            $follow->saveOrExplode();
        } catch (Exception $e) {
            if ($e instanceof ModelNotSavedException) {
                return error_popup($e->getMessage());
            }

            if (!is_sql_unique_exception($e)) {
                throw $e;
            }
        }

        return response([], 204);
    }

    private function getParams()
    {
        $params = get_params(request()->all(), 'follow', ['notifiable_type:string', 'notifiable_id:int', 'subtype:string']);
        $params['user_id'] = auth()->user()->getKey();

        return $params;
    }

    private function indexBeatmapsetModding()
    {
        $user = auth()->user();
        $watches = $user->beatmapsetWatches()->visible()->paginate(50);
        $totalCount = $watches->total();
        $unreadCount = $user->beatmapsetWatches()->visible()->unread()->count();

        return ext_view('follows.beatmapset_modding', compact('watches', 'totalCount', 'unreadCount'));
    }

    private function indexForumTopic()
    {
        $user = auth()->user();
        $topics = Topic::watchedByUser($user)->paginate(50);
        $topicReadStatus = TopicTrack::readStatus($user, $topics);
        $topicWatchStatus = TopicWatch::watchStatus($user, $topics);

        $counts = [
            'total' => $topics->total(),
            'unread' => TopicWatch::unreadCount($user),
        ];

        return ext_view(
            'follows.forum_topic',
            compact('topics', 'topicReadStatus', 'topicWatchStatus', 'counts')
        );
    }
}
