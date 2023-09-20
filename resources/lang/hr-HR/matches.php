<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'match' => [
        'beatmap-deleted' => 'izbrisana beatmapa,',
        'failed' => 'NEUSPJEŠNO',
        'header' => 'Multi utakmice',
        'in-progress' => '(utakmica u tijeku)',
        'in_progress_spinner_label' => 'utakmica u tijeku',
        'loading-events' => 'Učitavanje događaja...',
        'winner' => ':team pobjeđuje',
        'winner_by' => '',

        'events' => [
            'player-left' => ':user je napustio/la utakmicu',
            'player-joined' => ':user se pridružio/la utakmici',
            'player-kicked' => ':user je izbačen/a s utakmice',
            'match-created' => ':user je stvorio utakmicu',
            'match-disbanded' => 'utakmica je prekinuta',
            'host-changed' => ':user je postao/la domaćin',

            'player-left-no-user' => 'igrač je napustio utakmicu',
            'player-joined-no-user' => 'igrač se pridružio utakmici',
            'player-kicked-no-user' => 'igrač je izbačen s utakmice',
            'match-created-no-user' => 'utakmica je stvorena',
            'match-disbanded-no-user' => 'utakmica je prekinuta',
            'host-changed-no-user' => 'domaćin je promijenjen',
        ],

        'score' => [
            'stats' => [
                'accuracy' => 'Preciznost',
                'combo' => 'Combo',
                'score' => 'Bodovi',
            ],
        ],

        'team-types' => [
            'head-to-head' => 'Glava uz glavu',
            'tag-coop' => 'Tag Co-op',
            'team-vs' => 'Team VS',
            'tag-team-vs' => 'Tag Team VS',
        ],

        'teams' => [
            'blue' => 'Plavi tim',
            'red' => 'Crveni tim',
        ],
    ],
    'game' => [
        'scoring-type' => [
            'score' => 'Najviši bodovi',
            'accuracy' => 'Najveća preciznost',
            'combo' => 'Najveći combo',
            'scorev2' => 'Score V2',
        ],
    ],
];
