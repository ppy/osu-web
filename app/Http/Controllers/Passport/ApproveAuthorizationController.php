<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Http\Controllers\Passport;

use Illuminate\Http\Request;
use Laravel\Passport\Http\Controllers\ApproveAuthorizationController as PassportApproveAuthorizationController;

class ApproveAuthorizationController extends PassportApproveAuthorizationController
{
    /**
     * {@inheritdoc}
     */
    public function approve(Request $request)
    {
        abort_if(!present(trim($request['redirect_uri'])), 400, trans('model_validation.required', ['attribute' => 'redirect_uri']));

        return parent::approve($request);
    }
}
