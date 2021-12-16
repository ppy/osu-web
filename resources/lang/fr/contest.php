<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'header' => [
        'small' => 'Rivalisez avec d\'autres moyens que juste cliquer sur des cercles.',
        'large' => 'Concours Communautaires',
    ],

    'index' => [
        'nav_title' => 'liste',
    ],

    'voting' => [
        'login_required' => 'Veuillez vous connecter pour voter.',
        'over' => 'Le vote pour ce concours est terminé',
        'show_voted_only' => 'Voir les votes',

        'best_of' => [
            'none_played' => "Il semble que vous n'ayez joué aucune beatmap qualifiée pour ce concours !",
        ],

        'button' => [
            'add' => 'Voter',
            'remove' => 'Supprimer le vote',
            'used_up' => 'Vous avez utilisé tous vos votes',
        ],

        'progress' => [
            '_' => ':used / :max votes utilisés',
        ],
    ],
    'entry' => [
        '_' => 'inscription',
        'login_required' => 'Veuillez vous connecter pour participer au concours.',
        'silenced_or_restricted' => 'Vous ne pouvez pas entrer dans un concours quand vous êtes réduit au silence ou restreint.',
        'preparation' => 'Nous sommes en train de préparer le concours. Merci de patienter !',
        'drop_here' => 'Déposez votre entrée ici',
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
        'count' => ':count_delimited vote|:count_delimited votes',
        'points' => ':count_delimited point|:count_delimited points',
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
        'voting' => 'En cours de vote',
        'results' => 'Résultats tombés',
    ],
];
