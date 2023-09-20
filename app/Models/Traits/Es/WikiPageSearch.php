<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Models\Traits\Es;

trait WikiPageSearch
{
    use BaseIndexable;

    public static function esIndexName()
    {
        return config('osu.elasticsearch.prefix').'wiki_pages';
    }

    public static function esSchemaFile()
    {
        return config_path('schemas/wiki_page.json');
    }
}
