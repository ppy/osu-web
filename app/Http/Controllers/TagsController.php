<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

declare(strict_types=1);

namespace App\Http\Controllers;

use Illuminate\Auth\AuthenticationException;

class TagsController extends Controller
{
    public function __construct()
    {
        parent::__construct();

        $this->middleware('require-scopes:public');
    }

    public function index()
    {
        if (!is_api_request() && \Auth::check() === false) {
            throw new AuthenticationException('User is not logged in.');
        }

        return [
            'tags' => app('tags')->json(),
        ];
    }
}
