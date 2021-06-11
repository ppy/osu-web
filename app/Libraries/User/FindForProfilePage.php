<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Libraries\User;

use App\Exceptions\UserProfilePageLookupException;
use App\Models\User;

class FindForProfilePage
{
    public static function find($id, ?string $type = null)
    {
        $user = User::lookupWithHistory($id, $type, true);
        $request = request();

        if ($user === null || $user->isBot() || !priv_check('UserShow', $user)->can()) {
            if (is_api_request()) {
                abort(404);
            }

            throw new UserProfilePageLookupException(fn () => ext_view('users.show_not_found', null, null, 404));
        }

        if (!is_json_request() && (string) $user->getKey() !== (string) $id) {
            $redirectTarget = route(
                $request->route()->getName(),
                array_merge($request->query(), $request->route()->parameters(), compact('user'))
            );

            throw new UserProfilePageLookupException(fn () => ujs_redirect($redirectTarget));
        }

        return $user;
    }
}
