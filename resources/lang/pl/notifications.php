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
    'all_read' => 'Wszystkie powiadomienia przeczytane!',
    'mark_all_read' => 'Wyczyść wszystko',
    'message_multi' => ':count_delimited nowa aktualizacja dla „title”.|:count_delimited nowe aktualizacje dla „title”.|:count_delimited nowych aktualizacji dla „title”.',

    'item' => [
        'beatmapset' => [
            '_' => 'Beatmapa',

            'beatmapset_discussion' => [
                '_' => 'Dyskusja beatmapy',
                'beatmapset_discussion_lock' => 'Tworzenie dyskusji dla beatmapy „:title” zostało zablokowane.',
                'beatmapset_discussion_post_new' => ':username dodał(a) nową wiadomość w dyskusji dla beatmapy „:title”.',
                'beatmapset_discussion_unlock' => 'Tworzenie dyskusji dla beatmapy „:title” zostało odblokowane.',
            ],

            'beatmapset_state' => [
                '_' => 'Status beatmapy został zmieniony',
                'beatmapset_disqualify' => 'Beatmapa „:title” została zdyskwalifikowana przez użytkownika :username.',
                'beatmapset_love' => 'Beatmapa „:title” uzyskała status ulubionej społeczności od użytkownika :username.',
                'beatmapset_nominate' => 'Beatmapa „:title” została nominowana przez użytkownika :username.',
                'beatmapset_qualify' => 'Beatmapa „:title” uzyskała wystarczającą liczbę nominacji i została zakwalifikowana.',
                'beatmapset_reset_nominations' => 'Problem wymieniony przez użytkownika :username zresetował nominację beatmapy „:title”. ',
            ],
        ],

        'forum_topic' => [
            '_' => 'Wątek na forum',

            'forum_topic_reply' => [
                '_' => 'Nowa odpowiedź na forum',
                'forum_topic_reply' => ':username odpowiedział(a) w wątku „:title”.',
            ],
        ],

        'legacy_pm' => [
            '_' => 'Skrzynka odbiorcza starego forum',

            'legacy_pm' => [
                '_' => '',
                'legacy_pm' => ':count_delimited nieprzeczytana wiadomość.|:count_delimited nieprzeczytane wiadomości.|:count_delimited nieprzeczytanych wiadomości.',
            ],
        ],
    ],
];
