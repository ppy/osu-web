<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'header' => [
        'small' => 'Rivalisez avec d\'autres moyens que juste cliquer sur des cercles',
        'large' => 'Concours Communautaires',
    ],

    'index' => [
        'nav_title' => 'liste',
    ],

    'voting' => [
        'over' => 'Le vote pour ce concours est terminé',
        'login_required' => 'Veuillez vous connecter pour voter.',

        'best_of' => [
            'none_played' => "Il semble que vous n'ayez joué aucune beatmap qualifiée pour ce concours !",
        ],

        'button' => [
            'add' => 'Voter',
            'remove' => 'Supprimer le vote',
            'used_up' => 'Vous avez utilisé tous vos votes',
        ],
    ],
    'entry' => [
        '_' => 'inscription',
        'login_required' => 'Merci de vous connecter pour participer.',
        'silenced_or_restricted' => 'Vous ne pouvez pas entrer dans un concours quand vous êtes réduit au silence ou restreint.',
        'preparation' => 'Nous sommes en train de préparer le concours. Merci de patienter !',
        'over' => 'Merci pour vos inscriptions ! Les soumissions sont fermées pour ce concours et le vote va bientôt ouvrir.',
        'limit_reached' => 'Vous avez atteint la limite d\'entrée pour ce concours',
        'drop_here' => '"Droppez" votre entrée ici',
        'download' => 'Télécharger .osz',
        'wrong_type' => [
            'art' => 'Seuls les fichiers .jpg et .png sont acceptés pour ce concours.',
            'beatmap' => 'Seuls les fichiers .osu sont acceptés pour ce concours.',
            'music' => 'Seuls les fichiers .mp3 sont acceptés pour ce concours.',
        ],
        'too_big' => 'Les entrées pour le concours sont limitées à :limit.',
    ],
    'beatmaps' => [
        'download' => 'Télécharger l\'entrée',
    ],
    'vote' => [
        'list' => 'votes',
        'count' => ':count vote | :count: votes',
        'points' => ':count point|:count points',
    ],
    'dates' => [
        'ended' => 'Terminé le :date',
        'ended_no_date' => 'Terminé',

        'starts' => [
            '_' => 'Démarre le :date',
            'soon' => 'soon™',
        ],
    ],
    'states' => [
        'entry' => 'Entrée ouverte',
        'voting' => 'Vote démarré',
        'results' => 'Résultats tombés',
    ],
];
