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
        'beatmap-deleted' => 'gelöschte beatmap',
        'difference' => 'um :difference punkte',
        'failed' => 'FAILED',
        'header' => 'Mehrspieler-Matches',
        'in-progress' => '(match läuft)',
        'in_progress_spinner_label' => 'Match im Gange',
        'loading-events' => 'Lade Events...',
        'winner' => ':team gewinnt',

        'events' => [
            'player-left' => ':user hat das match verlassen',
            'player-joined' => ':user ist dem match beigetreten',
            'player-kicked' => ':user wurde aus dem match entfernt',
            'match-created' => ':user hat das match erstellt',
            'match-disbanded' => 'das match wurde aufgelöst',
            'host-changed' => ':user wurde zum host',

            'player-left-no-user' => 'ein spieler hat das match verlassen',
            'player-joined-no-user' => 'ein spieler ist dem match beigetreten',
            'player-kicked-no-user' => 'ein spieler wurde aus dem match entfernt',
            'match-created-no-user' => 'das match wurde erstellt',
            'match-disbanded-no-user' => 'das match wurde aufgelöst',
            'host-changed-no-user' => 'der host wurde gewechselt',
        ],

        'score' => [
            'stats' => [
                'accuracy' => 'Genauigkeit',
                'combo' => 'Combo',
                'score' => 'Punktzahl',
            ],
        ],

        'team-types' => [
            'head-to-head' => 'Head-to-head',
            'tag-coop' => 'Tag Co-op',
            'team-vs' => 'Team VS',
            'tag-team-vs' => 'Tag Team VS',
        ],

        'teams' => [
            'blue' => 'Blaues Team',
            'red' => 'Rotes Team',
        ],
    ],
    'game' => [
        'scoring-type' => [
            'score' => 'Höchste Punktzahl',
            'accuracy' => 'Höchste Genauigkeit',
            'combo' => 'Höchste Combo',
            'scorev2' => 'Score V2',
        ],
    ],
];
