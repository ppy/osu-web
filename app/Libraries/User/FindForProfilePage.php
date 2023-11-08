<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Libraries\User;

use App\Exceptions\UserProfilePageLookupException;
use App\Models\User;

class FindForProfilePage
{
    public static function find($id, ?string $type = null, ?bool $assertCanonicalId = null)
    {
        $user = static::fromAuth($id, $type) ?? User::lookupWithHistory($id, $type, true);

        if ($user === null || !priv_check('UserShow', $user)->can()) {
            throw new UserProfilePageLookupException(function () {
                if (is_json_request()) {
                    abort(404);
                }

                return ext_view('users.show_not_found', null, null, 404);
            });
        }

        if (($assertCanonicalId ?? !is_json_request()) && (string) $user->getKey() !== (string) $id) {
            $route = \Request::route();
            $redirectTarget = route(
                $route->getName(),
                [
                    ...\Request::query(),
                    ...$route->parameters(),
                    'key' => null,
                    'user' => $user,
                ],
            );

            throw new UserProfilePageLookupException(fn () => ujs_redirect($redirectTarget));
        }

        return $user;
    }

    private static function fromAuth($requestId, ?string $type): ?User
    {
        $user = \Auth::user();

        if ($user === null) {
            return null;
        }

        $userId = (string) $user->getKey();
        $username = $user->username;
        $isSelf = match ($type) {
            'id' => $requestId === $userId,
            'username' => $requestId === $username || $requestId === "@{$username}",
            default => $requestId === $userId || $requestId === "@{$username}" || (!ctype_digit($username) && $requestId === $username),
        };

        return $isSelf ? $user : null;
    }
}
