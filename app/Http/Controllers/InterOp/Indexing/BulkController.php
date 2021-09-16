<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Http\Controllers\InterOp\Indexing;

use App\Http\Controllers\Controller;
use App\Jobs\EsIndexDocumentBulk;
use App\Libraries\MorphMap;

class BulkController extends Controller
{
    public function store()
    {
        // TODO: limited to these for now.
        static $allowedTypes = ['beatmapset', 'user'];

        $params = request()->all();

        foreach ($params as $type => $paramIds) {
            if (!in_array($type, $allowedTypes, true)) {
                continue;
            }

            $ids = get_param_value($paramIds, 'int[]');
            $className = MorphMap::getClass($type);

            dispatch(new EsIndexDocumentBulk($className, $ids));
        }

        return response(null, 204);
    }
}
