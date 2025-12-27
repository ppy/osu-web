<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Http\Controllers;

use App\Models\User;
use App\Transformers\UserCompactTransformer;

class WrappedController extends Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function show($userId)
    {
        $user = User::findOrFail($userId);

        // TODO: stuff actually needs to go in here from https://github.com/ppy/osu-web/pull/12614
        $json = [
            'pages' => (object) [],
            'user' => json_item($user, new UserCompactTransformer()),
        ];

        return ext_view('wrapped.show', compact('json'));
    }
}
