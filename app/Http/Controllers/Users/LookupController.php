<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

declare(strict_types=1);

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller as BaseController;
use App\Models\User;
use App\Transformers\UserCompactTransformer;

class LookupController extends BaseController
{
    public function lookup()
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

        $users = User::where(fn ($q) => $q->whereIn('user_id', $numericIds)->orWhereIn('username', $stringIds))
            ->default()
            ->with(UserCompactTransformer::CARD_INCLUDES_PRELOAD)
            ->get();

        return [
            'users' => json_collection($users, new UserCompactTransformer(), UserCompactTransformer::CARD_INCLUDES),
        ];
    }
}
