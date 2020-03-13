<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Libraries;

use Illuminate\Translation\MessageSelector;

class OsuMessageSelector extends MessageSelector
{
    public function getPluralIndex($locale, $number)
    {
        if ($locale === 'pt-br') {
            $locale = 'pt_BR';
        }

        return parent::getPluralIndex($locale, $number);
    }
}
