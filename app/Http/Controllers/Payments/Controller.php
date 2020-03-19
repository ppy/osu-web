<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Http\Controllers\Payments;

use App\Http\Controllers\Controller as BaseController;
use Illuminate\Http\Request;

abstract class Controller extends BaseController
{
    /**
     * Extracts all the parameters from the request to be used a payment processor.
     *
     * @param Request $request
     * @return array
     */
    protected static function extractParams(Request $request)
    {
        $params = $request->input();
        if ($request->isJson()) {
            $params = array_merge($params, $request->json()->all());
        }

        return $params;
    }
}
