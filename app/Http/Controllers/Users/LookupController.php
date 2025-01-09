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
        $this->middleware('throttle:1200,1');
        $this->middleware('require-scopes:public');
    }

    public function index()
    {
        // TODO: referer check?
        $ids = array_slice(array_reject_null(get_arr(request('ids'), presence(...)) ?? []), 0, 50);

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
            ->defaultForLookup()
            ->with(UserCompactTransformer::CARD_INCLUDES_PRELOAD)
            ->get();

        return [
            'users' => json_collection($users, new UserCompactTransformer(), UserCompactTransformer::CARD_INCLUDES),
        ];
    }
}
