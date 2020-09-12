<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Http\Controllers;

use App\Exceptions\ValidationException;
use App\Libraries\MorphMap;
use App\Models\Reportable;

class ReportsController extends Controller
{
    public function __construct()
    {
        parent::__construct();

        $this->middleware('auth');
    }

    public function store()
    {
        $params = get_params(request()->all(), null, [
            'comments',
            'reason',
            'reportable_id:int',
            'reportable_type',
        ]);

        $class = MorphMap::getClass($params['reportable_type']);
        if ($class === null) {
            abort(404);
        }

        /** @var Reportable $reportable */
        $reportable = $class::findOrFail($params['reportable_id']);

        try {
            $reportable->reportBy(auth()->user(), [
                'comments' => trim($params['comments']),
                'reason' => $params['reason'],
            ]);
        } catch (ValidationException $e) {
            return error_popup($e->getMessage());
        }

        return response(null, 204);
    }
}
