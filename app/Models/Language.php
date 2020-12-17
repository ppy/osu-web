<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Models;

use App\Transformers\LanguageTransformer;

/**
 * @property int $display_order
 * @property int $language_id
 * @property string $name
 */
class Language extends Model
{
    protected $table = 'osu_languages';
    protected $primaryKey = 'language_id';
    public $timestamps = false;

    const UNSPECIFIED = 1;

    public function newQuery($excludeDeleted = true)
    {
        return parent::newQuery()->orderBy('display_order', 'asc');
    }

    public static function listing()
    {
        return json_collection(static::all(), new LanguageTransformer());
    }
}
