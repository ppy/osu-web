<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

declare(strict_types=1);

namespace App\Http\Controllers;

class TagsController extends Controller
{
    public function __construct()
    {
        parent::__construct();

        $this->middleware(['auth', 'require-scopes:public']);
    }

    public function index()
    {
        return [
            'tags' => app('tags')->json(),
        ];
    }
}
