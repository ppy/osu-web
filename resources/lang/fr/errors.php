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
    'codes' => [
        'http-401' => 'Veuillez vous connecter pour continuer.',
        'http-403' => 'Accès refusé.',
        'http-404' => 'Introuvable.',
        'http-429' => 'Trop de tentatives ! Réessayez plus tard.',
    ],
    'account' => [
        'profile-order' => [
            'generic' => 'Une erreur est survenue. Essayez de rafraîchir la page.',
        ],
    ],
    'beatmaps' => [
        'invalid_mode' => 'Mode spécifié invalide.',
        'standard_converts_only' => 'Aucun score n\'est disponible pour le mode sélectionné sur cette difficulté de beatmap.',
    ],
    'checkout' => [
        'generic' => 'Une erreur s’est produite lors de la préparation de votre commande.',
    ],
    'search' => [
        'default' => 'Impossible d\'obtenir des résultats, réessayez plus tard.',
        'operation_timeout_exception' => 'La recherche est actuellement plus active que d\'habitude, réessayez plus tard.',
    ],

    'logged_out' => 'Vous avez été déconnecté. Merci de vous connecter et de réessayer.',
    'supporter_only' => 'Vous devez être un osu!supporter pour utiliser cette fonctionnalité.',
    'no_restricted_access' => 'Vous ne pouvez pas effectuer cette action avec un compte restreint.',
    'unknown' => 'Une erreur inconnue est survenue.',
];
