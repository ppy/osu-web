<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Http\Controllers\InterOp;

use App\Http\Controllers\Controller;
use Artisan;

class ArtistTracksController extends Controller
{
    public function reindexAll()
    {
        $params = get_params(request()->all(), null, [
            'cleanup:bool',
            'inplace:bool',
        ]);

        Artisan::queue('es:index-documents', [
            '--cleanup' => $params['cleanup'] ?? true,
            '--inplace' => $params['inplace'] ?? true,
            '--types' => 'artist_tracks',
            '--yes' => true,
        ]);

        return response()->noContent();
    }
}
