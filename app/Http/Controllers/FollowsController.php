<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Http\Controllers;

use App\Exceptions\ModelNotSavedException;
use App\Jobs\UpdateUserMappingFollowerCountCache;
use App\Models\BeatmapDiscussion;
use App\Models\Beatmapset;
use App\Models\Comment;
use App\Models\Follow;
use App\Models\Forum\Topic;
use App\Models\Forum\TopicTrack;
use App\Models\Forum\TopicWatch;
use App\Transformers\FollowCommentTransformer;
use App\Transformers\FollowModdingTransformer;
use DB;
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

            if ($follow->subtype === 'mapping') {
                dispatch(new UpdateUserMappingFollowerCountCache($follow->notifiable_id));
            }
        }

        return response([], 204);
    }

    public function index($subtype = null)
    {
        view()->share('subtype', $subtype);

        switch ($subtype) {
            case 'comment':
                return $this->indexComment();
            case 'forum_topic':
                return $this->indexForumTopic();
            case 'mapping':
                return $this->indexMapping();
            case 'modding':
                return $this->indexModding();
            default:
                return ujs_redirect(route('follows.index', ['subtype' => Follow::DEFAULT_SUBTYPE]));
        }
    }

    public function store()
    {
        $params = $this->getStoreParams();
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

        if ($params['subtype'] === 'mapping') {
            dispatch(new UpdateUserMappingFollowerCountCache($params['notifiable_id']));
        }

        return response([], 204);
    }

    private function getStoreParams()
    {
        $params = get_params(request()->all(), 'follow', ['notifiable_type:string', 'notifiable_id:int', 'subtype:string']);
        $params['user_id'] = auth()->user()->getKey();

        return $params;
    }

    private function indexComment()
    {
        $user = auth()->user();

        $followsQuery = Follow::where(['user_id' => $user->getKey(), 'subtype' => 'comment']);

        $recentCommentIds = Comment
            ::selectRaw('MAX(id) latest_comment_id, commentable_type, commentable_id')
            ->whereIn(
                DB::raw('(commentable_type, commentable_id)'),
                (clone $followsQuery)->selectRaw('notifiable_type, notifiable_id')
            )->groupBy('commentable_type', 'commentable_id')
            ->pluck('latest_comment_id');

        $comments = Comment
            ::whereIn('id', $recentCommentIds)
            ->with('user')
            ->get()
            ->keyBy(function ($comment) {
                return "{$comment->commentable_type}:{$comment->commentable_id}";
            });

        $follows = (clone $followsQuery)
            ->with('notifiable')
            ->get()
            ->sortByDesc(function ($follow) use ($comments) {
                $comment = $comments["{$follow->notifiable_type}:{$follow->notifiable_id}"] ?? null;

                return $comment === null ? null : $comment->getKey();
            });

        $followsTransformer = new FollowCommentTransformer($comments);
        $followsJson = json_collection($follows, $followsTransformer, ['commentable_meta', 'latest_comment.user']);

        return ext_view('follows.comment', compact('followsJson'));
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

    private function indexMapping()
    {
        $user = auth()->user();
        $followsQuery = Follow::where(['user_id' => $user->getKey(), 'subtype' => 'mapping']);

        $recentBeatmapsetIds = Beatmapset
            ::selectRaw('MAX(beatmapset_id) latest_beatmapset_id, user_id')
            ->whereIn(
                'user_id',
                (clone $followsQuery)->select('notifiable_id')
            )->groupBy('user_id')
            ->where('approved', '<>', Beatmapset::STATES['wip'])
            ->pluck('latest_beatmapset_id');

        $beatmapsets = Beatmapset
            ::whereIn('beatmapset_id', $recentBeatmapsetIds)
            ->with('beatmaps')
            ->get()
            ->keyBy('user_id');

        $follows = (clone $followsQuery)
            ->with('notifiable')
            ->get()
            ->sortByDesc(function ($follow) use ($beatmapsets) {
                $beatmapset = $beatmapsets[$follow->notifiable_id] ?? null;

                return $beatmapset === null ? null : $beatmapset->getKey();
            });

        $followsTransformer = new FollowModdingTransformer($beatmapsets);
        $followsJson = json_collection($follows, $followsTransformer, ['latest_beatmapset.beatmaps', 'user']);

        return ext_view('follows.mapping', compact('followsJson'));
    }

    private function indexModding()
    {
        $user = auth()->user();
        $watches = $user
            ->beatmapsetWatches()
            ->visible()
            ->orderBy('last_notified', 'DESC')
            ->with('beatmapset')
            ->paginate(50);
        $totalCount = $watches->total();
        $unreadCount = $user->beatmapsetWatches()->visible()->unread()->count();
        $openIssues = BeatmapDiscussion
            ::whereIn('beatmapset_id', $watches->pluck('beatmapset_id'))
            ->openIssues()
            ->groupBy('beatmapset_id')
            ->selectRaw('beatmapset_id, COUNT(*) AS open_count')
            ->get()
            ->keyBy('beatmapset_id');

        return ext_view('follows.modding', compact('openIssues', 'watches', 'totalCount', 'unreadCount'));
    }
}
