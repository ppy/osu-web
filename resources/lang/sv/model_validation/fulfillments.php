<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'username_change' => [
        'only_one' => 'endast 1 ändring av användarnamn är tillåtet per order.',
        'insufficient_paid' => 'Användarnamn ändring överskrider summa betald (:expected > :actual)',
        'reverting_username_mismatch' => 'Nuvarande användarnamn (:current) är inte detsamma som ändring till återkallande (:username)',
    ],
    'supporter_tag' => [
        'insufficient_paid' => 'Donationen är mindre än tillräckligt för supporter tagg gåvan(:actual > :expected)',
    ],
];
