<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Http\Controllers\InterOp;

use App\Http\Controllers\Controller;
use App\Models\Team;
use Illuminate\Http\Response;

class TeamsController extends Controller
{
    public function destroy(string $id): Response
    {
        Team::findOrFail($id)->delete();

        return response()->noContent();
    }
}
