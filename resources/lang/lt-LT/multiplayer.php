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
    'match' => [
        'beatmap-deleted' => 'beatmapas ištrintas',
        'difference' => ':difference skirtumu',
        'failed' => 'NEPRAĖJO',
        'header' => '',
        'in-progress' => '(vyksta rungtynės)',
        'in_progress_spinner_label' => '',
        'loading-events' => 'Įvykiai keliami...',
        'winner' => ':team laimėjo',

        'events' => [
            'player-left' => ':user išėjo iš rungtynių',
            'player-joined' => ':user prisijungė prie rungtynių',
            'player-kicked' => ':user buvo išmestas iš rungtynių',
            'match-created' => ':user sukūrė rungtynes',
            'match-disbanded' => 'rungtynės buvo sustabdytos',
            'host-changed' => ':user tapo vedėju',

            'player-left-no-user' => 'žaidėjas išėjo iš rungtynių',
            'player-joined-no-user' => 'žaidėjas prisijungė prie rungtynių',
            'player-kicked-no-user' => 'žaidėjas buvo išmestas iš rungtynių',
            'match-created-no-user' => 'rungtynės buvo sukurtos',
            'match-disbanded-no-user' => 'rungtynės buvo sustabdytos',
            'host-changed-no-user' => 'pasikeitė vedėjas',
        ],

        'score' => [
            'stats' => [
                'accuracy' => 'Tikslumas',
                'combo' => 'Kombo',
                'score' => 'Taškai',
            ],
        ],

        'team-types' => [
            'head-to-head' => 'Kiekvienas už save',
            'tag-coop' => '',
            'team-vs' => 'Komandinis',
            'tag-team-vs' => '',
        ],

        'teams' => [
            'blue' => 'Mėlyna Komanda',
            'red' => 'Raudona Komanda',
        ],
    ],
    'game' => [
        'scoring-type' => [
            'score' => 'Daugiausiai Taškų',
            'accuracy' => 'Didžausias Tikslumas',
            'combo' => 'Didžiausias Kombo',
            'scorev2' => 'Taškai V2',
        ],
    ],
];
