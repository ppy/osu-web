<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Transformers;

use App\Models\Language;

class LanguageTransformer extends TransformerAbstract
{
    public function transform(Language $language)
    {
        $id = $language->getKey();

        return [
            'id' => $id === 0 ? null : $id,
            'name' => osu_trans('beatmaps.language.'.strtr(strtolower($language->name), ' ', '-')),
        ];
    }
}
