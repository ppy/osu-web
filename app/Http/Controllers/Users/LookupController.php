<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

declare(strict_types=1);

namespace App\Http\Controllers\Users;

use App\Exceptions\RequestTooLargeException;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Transformers\UserCompactTransformer;

class LookupController extends Controller
{
    private const LIMIT = 50;

    public function __construct()
    {
        $this->middleware('throttle:1200,1');
        $this->middleware('require-scopes:public');
    }

    public function index()
    {
        // TODO: referer check?
        $params = get_params(\Request::all(), null, [
            'exclude_bots:bool',
            'ids:string[]',
        ]);

        $ids = array_reject_null(get_arr($params['ids'] ?? [], presence(...)));
        if (count($ids) > self::LIMIT) {
            throw new RequestTooLargeException('ids', self::LIMIT);
        }

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
            ->default()
            ->withoutNoProfile()
            ->with(UserCompactTransformer::CARD_INCLUDES_PRELOAD);

        if ($params['exclude_bots'] ?? false) {
            $users = $users->withoutBots();
        }

        return [
            'users' => json_collection($users->get(), new UserCompactTransformer(), UserCompactTransformer::CARD_INCLUDES),
        ];
    }
}
