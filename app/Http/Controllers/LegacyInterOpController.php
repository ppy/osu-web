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

namespace App\Http\Controllers;

use App\Exceptions\Handler as ExceptionHandler;
use App\Jobs\EsIndexDocument;
use App\Jobs\RegenerateBeatmapsetCover;
use App\Libraries\Chat;
use App\Libraries\Session\Store as SessionStore;
use App\Libraries\UserBestScoresCheck;
use App\Models\Achievement;
use App\Models\Beatmap;
use App\Models\Beatmapset;
use App\Models\Event;
use App\Models\Forum;
use App\Models\NewsPost;
use App\Models\Notification;
use App\Models\Score\Best;
use App\Models\User;
use App\Models\UserStatistics;
use Exception;
use Illuminate\Foundation\Bus\DispatchesJobs;

class LegacyInterOpController extends Controller
{
    use DispatchesJobs;

    public function regenerateBeatmapsetCovers($id)
    {
        $beatmapset = Beatmapset::findOrFail($id);

        $job = (new RegenerateBeatmapsetCover($beatmapset))->onQueue('beatmap_default');
        $this->dispatch($job);

        return ['success' => true];
    }

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

            broadcast_notification($params['name'], $post, $user);

            return response(null, 204);
        }
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
        broadcast_notification(Notification::USER_ACHIEVEMENT_UNLOCK, $achievement, $user);

        return $achievement->getKey();
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

        $message = Chat::sendPrivateMessage(
            $sender,
            get_int($params['target_id'] ?? null),
            presence($params['message'] ?? null),
            get_bool($params['is_action'] ?? null)
        );

        return json_item($message, 'Chat/Message', ['sender']);
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
     * - success (boolean)
     * - data: Either sent [ChatMessage](#chatmessage) or error data (see below)
     *
     * Error data contains:
     * - code: status code (see below)
     * - message: a bit more detailed error message (may be empty)
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
     * @bodyParam messages[<id>][target_id] integer required id of user receiving the message. Must not be restricted
     * @bodyParam messages[<id>][message] string required message to send. Empty string is not allowed
     * @bodyParam messages[<id>][is_action] boolean required set to true (`1`/`on`/`true`) for `/me` message. Default false
     */
    public function userBatchSendMessage()
    {
        $params = request('messages');

        $userIds = [];
        foreach ($params as $messageParams) {
            if (!is_array($messageParams)) {
                continue;
            }

            if (isset($messageParams['sender_id'])) {
                $userIds[$messageParams['sender_id']] = true;
            }
            if (isset($messageParams['target_id'])) {
                $userIds[$messageParams['target_id']] = true;
            }
        }
        $userIds = array_keys($userIds);

        $users = User::whereIn('user_id', $userIds)->get()->keyBy('user_id');

        $results = [];
        foreach ($params as $id => $messageParams) {
            try {
                if (!is_array($messageParams)) {
                    abort(422);
                }

                if (!isset($messageParams['sender_id']) || !isset($messageParams['target_id'])) {
                    abort(422);
                }

                $message = Chat::sendPrivateMessage(
                    optional($users[$messageParams['sender_id']] ?? null)->markSessionVerified(),
                    $users[$messageParams['target_id']] ?? null,
                    presence($messageParams['message'] ?? null),
                    get_bool($messageParams['is_action'] ?? null)
                );

                $result = [
                    'success' => true,
                    'data' => json_item($message, 'Chat/Message', ['sender']),
                ];
            } catch (Exception $e) {
                $result = [
                    'success' => false,
                    'data' => [
                        'code' => ExceptionHandler::statusCode($e),
                        'message' => ExceptionHandler::exceptionMessage($e),
                    ],
                ];
            }

            $results[$id] = $result;
        }

        return $results;
    }

    public function userSessionsDestroy($id)
    {
        SessionStore::destroy($id);

        return ['success' => true];
    }
}
