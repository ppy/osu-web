<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Http\Controllers\InterOp;

use App\Exceptions\ModelNotSavedException;
use App\Exceptions\ValidationException;
use App\Http\Controllers\Controller;
use App\Libraries\UserRegistration;
use App\Models\Beatmap;
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

        return $achievement->getKey();
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
