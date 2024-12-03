<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\Team;
use App\Transformers\UserCompactTransformer;
use Symfony\Component\HttpFoundation\Response;

class TeamsController extends Controller
{
    public function show(string $id): Response
    {
        $team = Team
            ::with(array_map(
                fn (string $preload): string => "members.user.{$preload}",
                UserCompactTransformer::CARD_INCLUDES_PRELOAD,
            ))->findOrFail($id);

        return ext_view('teams.show', compact('team'));
    }
}
