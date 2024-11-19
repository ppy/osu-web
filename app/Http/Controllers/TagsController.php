<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\Tag;
use App\Transformers\TagTransformer;

class TagsController extends Controller
{
    public function __construct()
    {
        parent::__construct();

        $this->middleware('require-scopes:public');
    }

    public function index()
    {
        $tags = cache_remember_mutexed(
            'tags',
            $GLOBALS['cfg']['osu']['tags']['tags_cache_interval'],
            [],
            fn () => Tag::all(),
        );

        return [
            'tags' => json_collection($tags, new TagTransformer()),
        ];
    }
}
