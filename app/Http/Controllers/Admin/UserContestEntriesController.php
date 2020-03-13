<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Http\Controllers\Admin;

use App\Models\UserContestEntry;

class UserContestEntriesController extends Controller
{
    public function destroy($id)
    {
        $entry = UserContestEntry::findOrFail($id);
        $entry->delete();

        return response([], 204);
    }

    public function restore($id)
    {
        $entry = UserContestEntry::withTrashed()->findOrFail($id);
        $entry->restore();

        return response([], 204);
    }
}
