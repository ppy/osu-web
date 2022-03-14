<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Libraries;

use App\Exceptions\InvariantException;

class ScoreCheck
{
    public static function assertCompleted($score): void
    {
        $data = $score->data;

        if (!ScoreRank::isValid($data->rank)) {
            throw new InvariantException("'{$data->rank}' is not a valid rank.");
        }

        foreach (['totalScore', 'accuracy', 'maxCombo', 'passed'] as $field) {
            if (!present($data->$field)) {
                throw new InvariantException("field missing: '{$field}'");
            }
        }

        foreach (['mods'] as $field) {
            if (!is_array($data->$field)) {
                throw new InvariantException("field must be an array: '{$field}'");
            }
        }

        if ($data->statistics->isEmpty()) {
            throw new InvariantException("field cannot be empty: 'statistics'");
        }

        // todo: also, all the validationsz:
        // - validate statistics json format
    }
}
