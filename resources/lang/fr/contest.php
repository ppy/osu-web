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
    'header' => [
        'small' => "Rivalisez avec d'autres moyens que juste cliquer sur des cercles",
        'large' => 'Concours communautaires osu!',
    ],
    'voting' => [
        'over' => 'Le vote pour ce concours est terminé',
        'login_required' => 'Veuillez vous connecter pour voter.',
        'best_of' => [
            'none_played' => "Il semble que vous n'ayez joué aucune beatmap qualifiée pour ce concours !",
        ],
    ],
    'entry' => [
        '_' => 'inscription',
        'login_required' => 'Merci de vous connecter pour participer.',
        'silenced_or_restricted' => 'Vous ne pouvez pas entrer dans un concours quand vous êtes réduit au silence ou restreint.',
        'preparation' => 'Nous sommes en train de préparer le concours. Merci de patienter !',
        'over' => 'Merci pour vos inscriptions ! Les soumissions sont fermées pour ce concours et le vote va bientôt ouvrir.',
        'limit_reached' => "Vous avez atteint la limite d'entrée pour ce concours",
        'drop_here' => '"Droppez" votre entrée ici',
        'wrong_type' => [
            'art' => 'Uniquement les fichiers .jpg et .png sont admis pour ce concours.',
            'beatmap' => 'Uniquement les fichiers .osu sont admis pour ce concours.',
            'music' => 'Uniquement les fichiers .mp3 sont admis pour ce concours.',
        ],
        'too_big' => 'Les entrées pour le concours sont limitées à :limit.',
    ],
    'beatmaps' => [
        'download' => "Télécharger l'inscription",
    ],
    'vote' => [
        'list' => 'votes',
        'count' => ':count vote|:count votes',
    ],
    'dates' => [
        'ended' => 'Terminé le :date',

        'starts' => [
            '_' => 'Démarre le :date',
            'soon' => 'bientôt™',
        ],
    ],
    'states' => [
        'entry' => 'Entrée ouverte',
        'voting' => 'Vote démarré',
        'results' => 'Résultats tombés',
    ],
];
