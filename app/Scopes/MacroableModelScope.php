<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Scopes;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;

class MacroableModelScope implements Scope
{
    public function apply(Builder $builder, Model $model)
    {
        // heh
    }

    public function extend($builder)
    {
        $model = $builder->getModel();

        foreach ($model->getMacros() as $macro) {
            $fname = 'macro'.ucfirst($macro);
            $builder->macro($macro, $model->$fname());
        }
    }
}
