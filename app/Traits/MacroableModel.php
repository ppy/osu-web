<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Traits;

use App\Scopes\MacroableModelScope;

trait MacroableModel
{
    public static function bootMacroableModel()
    {
        static::addGlobalScope(new MacroableModelScope());
    }
}
