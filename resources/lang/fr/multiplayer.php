<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'match' => [
        'beatmap-deleted' => 'beatmap supprimée',
        'difference' => 'de :difference points',
        'failed' => 'Échec',
        'header' => 'Match multijoueur',
        'in-progress' => '(match en cours)',
        'in_progress_spinner_label' => 'match en cours',
        'loading-events' => 'Chargement des évènements...',
        'winner' => ':team gagne',

        'events' => [
            'player-left' => ':user a quitté le match',
            'player-joined' => ':user a rejoint le match',
            'player-kicked' => ':user a été exclu du match',
            'match-created' => ':user a créé le match',
            'match-disbanded' => ':user a dissous le match',
            'host-changed' => ':user a pris le contrôle de la salle',

            'player-left-no-user' => 'un joueur a quitté le match',
            'player-joined-no-user' => 'un joueur a rejoint le match',
            'player-kicked-no-user' => 'un joueur a été exclu du match',
            'match-created-no-user' => 'le match a été créé',
            'match-disbanded-no-user' => 'le match a été dissous',
            'host-changed-no-user' => 'l\'hôte a changé',
        ],

        'score' => [
            'stats' => [
                'accuracy' => 'Précision',
                'combo' => 'Combo',
                'score' => 'Score',
            ],
        ],

        'team-types' => [
            'head-to-head' => 'Chacun pour soi',
            'tag-coop' => 'Tag en coopération',
            'team-vs' => 'Équipes en versus',
            'tag-team-vs' => 'Tag en versus (2 équipes)',
        ],

        'teams' => [
            'blue' => 'Équipe bleue',
            'red' => 'Équipe rouge',
        ],
    ],
    'game' => [
        'scoring-type' => [
            'score' => 'Score le plus haut',
            'accuracy' => 'Précision la plus haute',
            'combo' => 'Combo le plus haut',
            'scorev2' => 'Score V2',
        ],
    ],
];
