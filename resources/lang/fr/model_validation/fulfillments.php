<?php

/**
 *    Copyright 2015-2017 ppy Pty. Ltd.
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
        'only_one' => "Seulement 1 changement de nom d'utilisateur par commande autorisé.",
        'insufficient_paid' => "Le changement de nom d'utilisateur dépasse le montant payé (:expected > :actual)",
        'reverting_username_mismatch' => "Le nom d'utilisateur actuel (:current) n'est pas le même que le changement à annuler (:username)",
    ],
    'supporter_tag' => [
        'insufficient_paid' => 'La donation est inférieure à ce qui est requis pour un tag supporter (:actual > :expected)',
    ],
];
