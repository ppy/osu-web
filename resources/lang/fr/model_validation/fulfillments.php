<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'username_change' => [
        'only_one' => 'un seul changement de nom d\'utilisateur autorisé par commande.',
        'insufficient_paid' => 'Le montant payé pour changer de nom est insuffisant (:expected > :actual)',
        'reverting_username_mismatch' => 'Le nom d\'utilisateur actuel (:current) n\'est pas le même que celui à révoquer (:username)',
    ],
    'supporter_tag' => [
        'insufficient_paid' => 'Le don est insuffisant pour offrir un supporter tag (:actual > :expected)',
    ],
];
