<?php

/**
 *    Copyright 2016 ppy Pty. Ltd.
 *
 *    This file is part of osu!web. osu!web is distributed in the hopes of
 *    attracting more community contributions to the core ecosystem of osu!
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
        'header' => 'Match multijoueur',
        'team-types' => [
            'head-to-head' => 'Chacun pour soi',
            'tag-coop' => 'Tag en coopération',
            'team-vs' => 'Équipes en versus',
            'tag-team-vs' => 'Tag en versus d\'équipe',
        ],
        'events' => [
            'player-left' => ':user a quitté le match',
            'player-joined' => ':user a rejoint le match',
            'player-kicked' => ':user a été exclu du match',
            'match-created' => ':user a créé le match',
            // the ":the" var ?
            // Original : ':the match was disbanded'
            'match-disbanded' => ':user a dissous le match',
            'host-changed' => ':user a pris le contrôle de la salle',

            'player-left-no-user' => 'un joueur a quitté le match',
            'player-joined-no-user' => 'un joueur a rejoint le match',
            'player-kicked-no-user' => 'un joueur a été exclu du match',
            'match-created-no-user' => 'le match a été créé',
            'match-disbanded-no-user' => 'le match a été dissous',
            'host-changed-no-user' => 'l\'hôte a été changé',
        ],
        'in-progress' => '(match en cours)',
        'score' => [
            'stats' => [
                'combo' => 'Combo',
                'accuracy' => 'Précision',
                'score' => 'Score',
                'countgeki' => 'MAX',
                'count300' => '300s',
                'countkatu' => '200s',
                'count100' => '100s',
                'count50' => '50s',
                'countmiss' => 'Raté',
            ],
        ],
        'failed' => 'Échec',
        'teams' => [
            'blue' => 'Équipe bleue',
            'red' => 'Équipe rouge',
        ],
        'winner' => ':team gagne',
        'difference' => 'par :difference',
        'loading-events' => 'Chargement des évènements...',
        'more-events' => 'voir tout...',
        'beatmap-deleted' => 'beatmap supprimée',
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
