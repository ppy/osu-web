<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\Forum\Topic;
use App\Models\LovedPoll;
use App\Transformers\LovedPollTransformer;

/**
 * @group Loved Polls
 */
class LovedPollsController extends Controller
{
    public function __construct()
    {
        $this->middleware('require-scopes:loved', ['only' => ['destroy', 'store']]);
    }

    /**
     * Delete Loved Poll
     *
     * Delete the Loved poll association from the given [ForumTopic](#forum-topic). The topic and its regular poll data are left unchanged.
     *
     * @urlParam topic integer required ID of the [ForumTopic](#forum-topic).
     * @response 204
     */
    public function destroy(int $topicId)
    {
        LovedPoll::findOrFail($topicId)->delete();

        return response(null, 204);
    }

    /**
     * Create Loved Poll
     *
     * Mark a [ForumTopic](#forum-topic) as a Loved poll, associating it with a [Beatmapset](#beatmapset) and ruleset. The topic must already be in valid Loved poll format:
     *
     * - Topic has a poll
     * - Poll has an end time
     * - Poll has options "Yes" and "No"
     * - First post contains a closing bold tag followed by line feed (`[/b]\n`) to mark the beginning of the description
     *
     * @bodyParam beatmapset_id integer required ID of the [Beatmapset](#beatmapset).
     * @bodyParam description_author_id integer ID of the [User](#user) who wrote the "captain's description".
     * @bodyParam excluded_beatmap_ids integer[] required IDs of [Beatmap](#beatmap)s that won't enter Loved even if the poll passes.
     * @bodyParam pass_threshold float required Portion of "Yes" votes required for the map to enter Loved. Example: 0.85
     * @bodyParam ruleset GameMode required Ruleset of the poll. Example: osu
     * @bodyParam topic_id integer required ID of the [ForumTopic](#forum-topic).
     * @response 204
     */
    public function store()
    {
        $params = get_params(request()->input(), null, [
            'beatmapset_id:int',
            'description_author_id:int',
            'excluded_beatmap_ids:int[]',
            'pass_threshold:float',
            'ruleset:string',
            'topic_id:int',
        ], ['null_missing' => true]);

        foreach ($params as $key => $value) {
            abort_if(
                $key !== 'description_author_id' && $value === null,
                422,
                "Missing required parameter {$key}",
            );
        }

        (new LovedPoll($params))->saveOrExplode();

        return response(null, 204);
    }

    public function vote(int $topicId)
    {
        $pollOptionId = LovedPoll::pollOptionId(request()->input('poll_option'));

        abort_if($pollOptionId === null, 422, 'Invalid poll option');

        $topic = Topic::findOrFail($topicId);

        abort_if($topic->lovedPoll === null, 404);
        priv_check('ForumTopicVote', $topic)->ensureCan();

        $params = [
            'ip' => request()->ip(),
            'option_ids' => [$pollOptionId],
            'user_id' => auth()->id(),
        ];

        if (!$topic->vote()->fill($params)->save()) {
            return error_popup($topic->vote()->validationErrors()->toSentence());
        }

        return json_item($topic->lovedPoll, new LovedPollTransformer());
    }
}
