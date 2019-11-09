<?php

/**
 *    Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
 *    See the LICENCE file in the repository root for full licence text.
 */

namespace App\Transformers;

use App\Models\Language;
use League\Fractal;

class LanguageTransformer extends Fractal\TransformerAbstract
{
    public function transform(Language $language)
    {
        return [
            'id' => $language->language_id === 0 ? null : $language->language_id,
            'name' => trans('beatmaps.language.'.str_replace(' ', '-', strtolower($language->name))),
        ];
    }
}
