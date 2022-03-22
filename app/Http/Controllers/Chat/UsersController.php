<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

declare(strict_types=1);

namespace App\Http\Controllers\Chat;

use App\Http\Controllers\Controller as BaseController;
use App\Models\User;
use App\Transformers\UserCompactTransformer;

class UsersController extends BaseController
{
    public function index()
    {
        priv_check('ChatAnnounce')->ensureCan();

        $params = get_params(request()->all(), null, ['ids:string[]'], ['null_missing' => true]);
        $ids = array_slice($params['ids'], 0, 50);

        $numericIds = [];
        $stringIds = [];
        foreach ($ids as $id) {
            if (ctype_digit($id)) {
                $numericIds[] = $id;
            } elseif (present($id)) {
                $stringIds[] = $id;
            }
        }

        if (!empty($numericIds)) {
            $query = User::whereIn('user_id', $numericIds)
                ->default()
                ->with(UserCompactTransformer::CARD_INCLUDES_PRELOAD);
        }

        if (!empty($stringIds)) {
            $usernameQuery = User::whereIn('username', $stringIds)
                ->default()
                ->with(UserCompactTransformer::CARD_INCLUDES_PRELOAD);


            if (isset($query)) {
                $query->union($usernameQuery);
            } else {
                $query = $usernameQuery;
            }
        }

        if (isset($query)) {
            $users = $query->get();
        }

        return [
            'users' => json_collection($users ?? [], new UserCompactTransformer(), UserCompactTransformer::CARD_INCLUDES),
        ];
    }
}
