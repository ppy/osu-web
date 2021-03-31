<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Libraries;

use App\Exceptions\InvariantException;

class ScoreCheck
{
    public static function assertCompleted($score): void
    {
        if (!ScoreRank::isValid($score->rank)) {
            throw new InvariantException("'{$score->rank}' is not a valid rank.");
        }

        foreach (['total_score', 'accuracy', 'max_combo', 'passed'] as $field) {
            if (!present($score->$field)) {
                throw new InvariantException("field missing: '{$field}'");
            }
        }

        foreach (['mods', 'statistics'] as $field) {
            if (!is_array($score->$field)) {
                throw new InvariantException("field must be an array: '{$field}'");
            }
        }

        if (empty($score->statistics)) {
            throw new InvariantException("field cannot be empty: 'statistics'");
        }

        // todo: also, all the validationsz:
        // - validate statistics json format
    }
}
