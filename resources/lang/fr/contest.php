<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'header' => [
        'small' => 'Faites concurrence à vos adversaires sans vous limiter à simplement cliquer des cercles !',
        'large' => 'Concours communautaires',
    ],

    'index' => [
        'nav_title' => 'liste',
    ],

    'judge' => [
        'comments' => 'commentaires',
        'hide_judged' => 'masquer les entrées jugées',
        'nav_title' => 'juger',
        'no_current_vote' => 'vous n\'avez pas encore voté.',
        'update' => 'enregistrer',
        'validation' => [
            'missing_score' => 'score manquant',
            'contest_vote_judged' => 'vous ne pouvez pas voter dans un concours qui utilise le système de jugement',
        ],
        'voted' => 'Vous avez déjà voté pour cette entrée.',
    ],

    'judge_results' => [
        '_' => 'Résultats du jugement',
        'creator' => 'créateur',
        'score' => 'Score',
        'score_std' => 'Score normalisé',
        'total_score' => 'score total',
        'total_score_std' => 'score total normalisé',
    ],

    'voting' => [
        'judge_link' => 'Vous êtes juge de ce concours. Jugez les entrées ici !',
        'judged_notice' => 'Ce concours utilise le système de jugement, les juges s\'occupent actuellement des entrées.',
        'login_required' => 'Veuillez vous connecter pour voter.',
        'over' => 'Le vote pour ce concours est terminé',
        'show_voted_only' => 'Voir vos votes',

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

        'requirement' => [
            'playlist_beatmapsets' => [
                'incomplete_play' => 'Vous devez jouer toutes les beatmaps dans les playlists spécifiées avant de pouvoir voter',
            ],
        ],
    ],

    'entry' => [
        '_' => 'inscription',
        'login_required' => 'Veuillez vous connecter pour participer au concours.',
        'silenced_or_restricted' => 'Vous ne pouvez pas entrer dans un concours quand vous êtes réduit au silence ou restreint.',
        'preparation' => 'Nous sommes en train de préparer le concours. Merci de patienter !',
        'drop_here' => 'Déposez votre entrée ici',
        'download' => 'Télécharger le .osz',

        'wrong_type' => [
            'art' => 'Seuls les fichiers .jpg et .png sont acceptés pour ce concours.',
            'beatmap' => 'Seuls les fichiers .osu sont acceptés pour ce concours.',
            'music' => 'Seuls les fichiers .mp3 sont acceptés pour ce concours.',
        ],

        'wrong_dimensions' => 'Les dimensions des entrées envoyées à ce concours doivent être de :widthx:height',
        'too_big' => 'Les entrées pour le concours sont limitées à :limit.',
    ],

    'beatmaps' => [
        'download' => 'Télécharger l\'entrée',
    ],

    'vote' => [
        'list' => 'votes',
        'count' => ':count_delimited vote|:count_delimited votes',
        'points' => ':count_delimited point|:count_delimited points',
        'points_float' => ':points points',
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
        'entry' => 'Participations ouvertes',
        'voting' => 'En cours de vote',
        'results' => 'Résultats tombés',
    ],

    'show' => [
        'admin' => [
            'page' => '',
        ],
    ],
];
