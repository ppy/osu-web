<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Http\Controllers;

use App\Exceptions\Handler as ExceptionHandler;
use App\Jobs\EsIndexDocument;
use App\Jobs\Notifications\ForumTopicReply;
use App\Jobs\Notifications\UserAchievementUnlock;
use App\Jobs\RegenerateBeatmapsetCover;
use App\Libraries\Chat;
use App\Libraries\UserBestScoresCheck;
use App\Models\Achievement;
use App\Models\Beatmap;
use App\Models\Beatmapset;
use App\Models\Chat\Channel;
use App\Models\Chat\Message;
use App\Models\Chat\UserChannel;
use App\Models\Event;
use App\Models\Forum;
use App\Models\NewsPost;
use App\Models\Notification;
use App\Models\Score\Best;
use App\Models\User;
use App\Models\UserStatistics;
use App\Transformers\Chat\MessageTransformer;
use Datadog;
use Ds\Set;
use Exception;
use Illuminate\Foundation\Bus\DispatchesJobs;
use stdClass;

class LegacyInterOpController extends Controller
{
    use DispatchesJobs;

    public function generateNotification()
    {
        $params = request()->all();

        if (!isset($params['name'])) {
            abort(422, 'missing notification name');
        }

        if ($params['name'] === Notification::FORUM_TOPIC_REPLY) {
            $post = Forum\Post::find($params['post_id'] ?? null);
            $user = optional($post)->user;

            if ($post === null || $user === null) {
                abort(422, 'post is missing or it contains invalid user');
            }

            (new ForumTopicReply($post, $user))->dispatch();

            return response(null, 204);
        }
    }

    public function indexBeatmapset($id)
    {
        $beatmapset = Beatmapset::withTrashed()->findOrFail($id);

        if (!$beatmapset->trashed()) {
            $job = (new RegenerateBeatmapsetCover($beatmapset))->onQueue('beatmap_default');
            $this->dispatch($job);
        }

        dispatch(new EsIndexDocument($beatmapset));

        return response(null, 204);
    }

    public function news()
    {
        $newsPosts = NewsPost::default()->limit(5)->get();
        $posts = [];

        foreach ($newsPosts as $post) {
            $posts[] = [
                'timestamp' => $post->published_at->timestamp,
                'permalink' => route('news.show', $post->slug),
                'title' => $post->title(),
                'body' => $post->previewText(),
            ];
        }

        return $posts;
    }

    public function refreshBeatmapsetCache($id)
    {
        Beatmapset::findOrFail($id)->refreshCache();

        return ['success' => true];
    }

    public function userAchievement($id, $achievementId, $beatmapId = null)
    {
        $user = User::findOrFail($id);
        $achievement = Achievement::findOrFail($achievementId);

        try {
            $userAchievement = $user->userAchievements()->create([
                'achievement_id' => $achievement->getKey(),
                'beatmap_id' => $beatmapId,
            ]);
        } catch (Exception $e) {
            if (is_sql_unique_exception($e)) {
                return error_popup('user already unlocked the specified achievement');
            }

            throw $e;
        }

        Event::generate('achievement', compact('achievement', 'user'));

        (new UserAchievementUnlock($achievement, $user))->dispatch();

        return $achievement->getKey();
    }

    /**
     * User Batch Mark-As-Read (for Chat Channels)
     *
     * This endpoint allows you to mark channels as read for users in bulk
     *
     * ---
     *
     * ### Response Format
     * empty
     *
     * @bodyParam pairs[<id>][user_id] integer required id of user to mark as read for
     * @bodyParam pairs[<id>][channel_id] integer required id of channel to mark as read
     */
    public function userBatchMarkChannelAsRead()
    {
        $pairs = request('pairs');

        if (!is_array($pairs)) {
            abort(422, '"pairs" parameter must be a list');
        }

        $channelMax = [];

        foreach ($pairs as $pair) {
            if (!is_array($pair) || !isset($pair['user_id']) || !isset($pair['channel_id'])) {
                continue;
            }

            $channelId = get_int($pair['channel_id']);
            $userId = get_int($pair['user_id']);

            // cache the max message_id of each channel for the duration of this batch
            $channelMax[$channelId] = $channelMax[$channelId] ??
                Message::where('channel_id', $channelId)->max('message_id');

            optional(
                UserChannel::where([
                    'user_id' => $userId,
                    'channel_id' => $channelId,
                ])->first()
            )->markAsRead($channelMax[$channelId]);
        }
    }

    /**
     * User Batch Send Message
     *
     * This endpoint allows you to send Message as a user to another user.
     *
     * ---
     *
     * ### Response Format
     *
     * Map of <id> and its result.
     *
     * Result contains:
     * - status: status code. 200 if success. See below for list of error codes
     * - id: id of message being sent
     * - error: Message of the error (if any)
     *
     * Error status codes:
     * - 403:
     *   - sender not allowed to send message to target
     * - 404:
     *   - invalid sender/target id
     *   - target is restricted
     * - 422:
     *   - missing parameter
     *   - message is empty
     *   - message is too long
     *   - target and sender are the same
     * - 429:
     *   - too many messages has been sent by the sender
     *
     * @bodyParam messages[<id>][sender_id] integer required id of user sending the message
     * @bodyParam messages[<id>][target_id] integer required id of user receiving the message if `type` is `pm`; channel, otherwise. Must not be restricted
     * @bodyParam messages[<id>][type] string required type of the target of the message, `pm` or `public`
     * @bodyParam messages[<id>][message] string required message to send. Empty string is not allowed
     * @bodyParam messages[<id>][is_action] boolean required set to true (`1`/`on`/`true`) for `/me` message. Default false
     */
    public function userBatchSendMessage()
    {
        $params = request('messages');

        $results = new stdClass();

        if (!isset($params)) {
            return response()->json($results);
        }

        if (!is_array($params)) {
            abort(422, '"messages" parameter must be a list');
        }

        $channelIds = new Set();
        $userIds = new Set();

        foreach ($params as $key => $messageParams) {
            if (!is_array($messageParams)) {
                continue;
            }

            $messageParams = get_params($messageParams, null, [
                'sender_id:int',
                'target_id:int',
                'type:string',
                'message:string',
                'is_action:bool',
            ]);

            // TODO: default to null later
            $messageType = $messageParams['type'] ?? 'pm';
            // ignore if type missing (and return error?)
            if (in_array($messageType, ['pm', 'public'], true)) {
                if (isset($messageParams['sender_id'])) {
                    $userIds->add($messageParams['sender_id']);
                }

                if (isset($messageParams['target_id'])) {
                    if ($messageType === 'pm') {
                        $userIds->add([$messageParams['target_id']]);
                    } else {
                        $channelIds->add([$messageParams['target_id']]);
                    }
                }
            }

            $params[$key] = $messageParams;
        }

        $users = User
            ::whereIn('user_id', $userIds->toArray())
            ->with(['userGroups', 'blocks'])
            ->get()
            ->keyBy('user_id');

        $channels = Channel
            ::public()
            ->whereIn('channel_id', $channelIds->toArray())
            ->get()
            ->keyBy('channel_id');

        foreach ($params as $id => $messageParams) {
            try {
                if (!is_array($messageParams)) {
                    abort(422);
                }

                if (!isset($messageParams['type']) || !isset($messageParams['sender_id']) || !isset($messageParams['target_id'])) {
                    abort(422);
                }

                $sender = optional($users[$messageParams['sender_id']] ?? null)->markSessionVerified();
                if ($sender === null) {
                    abort(422, 'sender not found');
                }

                if ($messageParams['type'] === 'pm') {
                    $pmTarget = $users[$messageParams['target_id']] ?? null;
                    if ($pmTarget === null) {
                        abort(422, 'target user not found');
                    }

                    $message = Chat::sendPrivateMessage(
                        $sender,
                        $pmTarget,
                        presence($messageParams['message'] ?? null),
                        $messageParams['is_action'] ?? null
                    );
                } else {
                    $channel = $channels[$messageParams['target_id']] ?? null;
                    if ($channel === null) {
                        abort(422, 'channel not found');
                    }

                    $message = $channel->receiveMessage(
                        $sender,
                        presence($messageParams['message'] ?? null),
                        $messageParams['is_action'] ?? false
                    );
                }

                $result = [
                    'status' => 200,
                    'id' => $message->getKey(),
                    'error' => null,
                ];
            } catch (Exception $e) {
                $result = [
                    'status' => ExceptionHandler::statusCode($e),
                    'id' => null,
                    'error' => ExceptionHandler::exceptionMessage($e),
                ];
            }

            Datadog::increment(config('datadog-helper.prefix_web').'.chat.batch', 1, [
                'status' => $result['status'],
            ]);

            $results->$id = $result;
        }

        return response()->json($results);
    }

    public function userBestScoresCheck($id)
    {
        $user = User::findOrFail($id);

        foreach (Beatmap::MODES as $mode => $_v) {
            (new UserBestScoresCheck($user))->run($mode);
        }

        return ['success' => true];
    }

    public function userIndex($id)
    {
        $user = User::findOrFail($id);

        dispatch(new EsIndexDocument($user));

        foreach (Beatmap::MODES as $modeStr => $modeId) {
            $class = Best\Model::getClassByString($modeStr);
            $class::queueIndexingForUser($user);
        }

        return response(null, 204);
    }

    public function userRecalculateRankedScores($id)
    {
        $user = User::findOrFail($id);

        foreach (Beatmap::MODES as $modeStr => $_modeId) {
            $class = UserStatistics\Model::getClass($modeStr);
            $class::recalculateRankedScoreForUser($user);
        }

        return response(null, 204);
    }

    /**
     * User Send Message
     *
     * This endpoint allows you to send Message as a user to another user.
     *
     * ---
     *
     * ### Response Format
     *
     * The sent [ChatMessage](#chatmessage) on success.
     *
     * - 403 on:
     *   - sender not allowed to send message to target
     * - 404 on:
     *   - invalid sender/target id
     *   - target is restricted
     * - 422 on:
     *   - missing parameter
     *   - message is empty
     *   - message is too long
     *   - target and sender are the same
     * - 429 on:
     *   - too many messages has been sent by the sender
     *
     * @bodyParam sender_id integer required id of user sending the message
     * @bodyParam target_id integer required id of user receiving the message. Must not be restricted
     * @bodyParam message string required message to send. Empty string is not allowed
     * @bodyParam is_action boolean required set to true (`1`/`on`/`true`) for `/me` message. Default false
     */
    public function userSendMessage()
    {
        $params = request()->all();

        $sender = User::findOrFail($params['sender_id'] ?? null)->markSessionVerified();
        $target = User::lookup($params['target_id'] ?? null, 'id');
        if ($target === null) {
            abort(422, 'target user not found');
        }

        $message = Chat::sendPrivateMessage(
            $sender,
            $target,
            presence($params['message'] ?? null),
            get_bool($params['is_action'] ?? null)
        );

        return json_item($message, new MessageTransformer(), ['sender']);
    }

    public function userSessionsDestroy($userId)
    {
        User::find($userId)?->resetSessions();

        return ['success' => true];
    }
}
