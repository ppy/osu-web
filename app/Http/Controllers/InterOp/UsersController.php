<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Http\Controllers\InterOp;

use App\Exceptions\ModelNotSavedException;
use App\Exceptions\ValidationException;
use App\Http\Controllers\Controller;
use App\Libraries\UserRegistration;
use App\Models\Beatmap;
use App\Models\Event;
use App\Models\User;
use App\Models\UserAchievement;
use App\Transformers\CurrentUserTransformer;

class UsersController extends Controller
{
    public function achievement($id, $achievementId, $beatmapId = null)
    {
        $achievement = app('medals')->byIdOrFail($achievementId);
        $unlocked = UserAchievement::unlock(
            User::findOrFail($id),
            $achievement,
            Beatmap::find($beatmapId),
        );

        abort_unless($unlocked, 422, 'user already unlocked the specified achievement');

        datadog_increment('user_achievement_unlock', ['id' => $achievementId]);

        return $achievement->getKey();
    }

    public function rankAchieved($userId, $beatmapId, $rulesetId)
    {
        $params = get_params(
            request()->all(),
            null,
            [
                'position_after:int',
                'rank:string',
                'legacy_score_event:bool',
            ]
        );

        abort_unless(isset($params['position_after']), 422, 'missing position_after parameter');
        abort_unless(isset($params['rank']), 422, 'missing rank parameter');
        abort_unless(isset($params['legacy_score_event']), 422, 'missing legacy_score_event parameter');

        $params['beatmap'] = Beatmap::findOrFail($beatmapId);
        $params['ruleset'] = Beatmap::modeStr($rulesetId);
        $params['user'] = User::findOrFail($userId);

        Event::generate('rank', $params);
        return response([], 204);
    }

    public function firstPlaceLost($userId, $beatmapId, $rulesetId)
    {
        $legacyScoreEvent = get_bool(request('legacy_score_event'));
        abort_unless(isset($legacyScoreEvent), 422, 'missing legacy_score_event parameter');

        Event::generate('rankLost', [
            'legacy_score_event' => $legacyScoreEvent,
            'beatmap' => Beatmap::findOrFail($beatmapId),
            'ruleset' => Beatmap::modeStr($rulesetId),
            'user' => User::findOrFail($userId),
        ]);
        return response([], 204);
    }

    public function store()
    {
        $request = request()->all();
        $params = get_params($request, 'user', ['username', 'user_email', 'group', 'password', 'country_acronym']);
        $params['user_ip'] = '127.0.0.1';
        $params['country_acronym'] = $params['country_acronym'] ?? request_country() ?? '';

        if (isset($request['source_user_id'])) {
            $sourceUser = User::find($request['source_user_id']);

            if ($sourceUser === null) {
                abort(404, "Can't find User specified in source_user_id");
            }

            if (!isset($params['user_email']) && isset($params['username'])) {
                $sourceEmailParts = explode('@', $sourceUser->user_email);
                $params['user_email'] = "{$sourceEmailParts[0]}+{$params['username']}@{$sourceEmailParts[1]}";
            }
            $params['country_acronym'] = $sourceUser->country_acronym ?? '';
            $params['user_ip'] = $sourceUser->user_ip;
            $params['user_password'] = $sourceUser->user_password;
        }

        $registration = new UserRegistration($params);

        try {
            $registration->save();

            return json_item($registration->user()->fresh(), new CurrentUserTransformer());
        } catch (ValidationException $ex) {
            return ModelNotSavedException::makeResponse($ex, [
                'user' => $registration->user(),
            ]);
        }
    }
}
