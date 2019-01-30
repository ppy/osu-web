<?php

/**
 *    Copyright (c) ppy Pty Ltd <contact@ppy.sh>.
 *
 *    This file is part of osu!web. osu!web is distributed with the hope of
 *    attracting more community contributions to the core ecosystem of osu!.
 *
 *    osu!web is free software: you can redistribute it and/or modify
 *    it under the terms of the Affero GNU General Public License version 3
 *    as published by the Free Software Foundation.
 *
 *    osu!web is distributed WITHOUT ANY WARRANTY; without even the implied
 *    warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
 *    See the GNU Affero General Public License for more details.
 *
 *    You should have received a copy of the GNU Affero General Public License
 *    along with osu!web.  If not, see <http://www.gnu.org/licenses/>.
 */

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
