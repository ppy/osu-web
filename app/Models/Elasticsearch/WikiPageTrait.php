<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Models\Elasticsearch;

use App\Traits\EsIndexable;

trait WikiPageTrait
{
    use EsIndexable;

    public static function esIndexName()
    {
        return config('osu.elasticsearch.prefix').'wiki_pages';
    }

    public static function esSchemaFile()
    {
        return config_path('schemas/wiki_page.json');
    }
}
