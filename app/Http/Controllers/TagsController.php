<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Http\Controllers;

use App\Models\Tag;

class TagsController extends Controller
{
    public function __construct()
    {
        parent::__construct();

        $this->middleware('require-scopes:public');
    }

    public function index()
    {
        return [
            'tags' => json_collection(Tag::all(), 'Tag'),
        ];
    }
}
