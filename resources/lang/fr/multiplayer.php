<?php

/**
 *    Copyright 2015-2018 ppy Pty. Ltd.
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
