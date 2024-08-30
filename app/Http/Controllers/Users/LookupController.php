<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

declare(strict_types=1);

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Transformers\UserCompactTransformer;

class LookupController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('throttle:30,1');
    }

    public function lookup()
    {
        // TODO: referer check?
        $params = get_params(request()->all(), null, ['ids:string[]'], ['null_missing' => true]);
        $ids = array_slice($params['ids'], 0, 50);

        $numericIds = [];
        $stringIds = [];
        foreach ($ids as $id) {
            if (ctype_digit($id)) {
                $numericIds[] = $id;
            } elseif (present($id)) {
                $stringIds[] = $id[0] === '@' ? substr($id, 1) : $id;
            }
        }

        $users = User::where(fn ($q) => $q->whereIn('user_id', $numericIds)->orWhereIn('username', $stringIds))
            ->where('group_id', '<>', app('groups')->byIdentifier('no_profile')->getKey())
            ->default()
            ->with(UserCompactTransformer::CARD_INCLUDES_PRELOAD)
            ->get();

        return [
            'users' => json_collection($users, new UserCompactTransformer(), UserCompactTransformer::CARD_INCLUDES),
        ];
    }
}
