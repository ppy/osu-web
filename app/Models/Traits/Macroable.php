<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Models\Traits;

use App\Scopes\MacroableModelScope;

trait Macroable
{
    public static function bootMacroable()
    {
        static::addGlobalScope(new MacroableModelScope());
    }
}
