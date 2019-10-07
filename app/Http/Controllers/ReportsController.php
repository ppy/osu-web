<?php

/**
 *    Copyright (c) ppy Pty Ltd <contact@ppy.sh>.
 *
 *    This file is part of osu!web. osu!web is distributed with the hope of
 *    attracting more community contributions to the core ecosystem of osu!.
 *
 *    osu!web is free software: you can redistribute it and/or modify
 *    it under the terms of the Affero GNU General Public License version 3
 *    as published by the Free Software Foundation.
 *
 *    osu!web is distributed WITHOUT ANY WARRANTY; without even the implied
 *    warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
 *    See the GNU Affero General Public License for more details.
 *
 *    You should have received a copy of the GNU Affero General Public License
 *    along with osu!web.  If not, see <http://www.gnu.org/licenses/>.
 */

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
        $params = get_params(request(), null, [
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
