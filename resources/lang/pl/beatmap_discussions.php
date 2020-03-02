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
    'authorizations' => [
        'update' => [
            'null_user' => 'Musisz się zalogować, aby zedytować post.',
            'system_generated' => 'Nie możesz edytować automatycznie wygenerowanych postów.',
            'wrong_user' => 'Tylko autor posta może go zedytować.',
        ],
    ],

    'events' => [
        'empty' => 'Nic się nie wydarzyło... jeszcze.',
    ],

    'index' => [
        'deleted_beatmap' => 'usunięta',
        'title' => 'dyskusje',

        'form' => [
            '_' => 'Szukaj',
            'deleted' => 'Uwzględnij usunięte dyskusje',
            'only_unresolved' => 'Pokaż tylko nierozwiązane dyskusje',
            'types' => 'Rodzaj wiadomości',
            'username' => 'Nazwa użytkownika',

            'beatmapset_status' => [
                '_' => 'Status beatmapy',
                'all' => 'Wszystkie',
                'disqualified' => 'Zdyskwalifikowana',
                'never_qualified' => 'Nigdy nie zakwalifikowana',
                'qualified' => 'Zakwalifikowana',
                'ranked' => 'Rankingowa',
            ],

            'user' => [
                'label' => 'Użytkownik',
                'overview' => 'Całokształt aktywności',
            ],
        ],
    ],

    'item' => [
        'created_at' => 'Data utworzenia',
        'deleted_at' => 'Data usunięcia',
        'message_type' => 'Typ',
        'permalink' => 'Odnośnik bezpośredni',
    ],

    'nearby_posts' => [
        'confirm' => 'Żaden z tych postów nie jest istotny',
        'notice' => 'Istnieją posty dotyczące :timestamp (:existing_timestamps). Sprawdź je przed opublikowaniem posta.',
    ],

    'reply' => [
        'open' => [
            'guest' => 'Zaloguj się, aby odpowiedzieć',
            'user' => 'Odpowiedz',
        ],
    ],

    'review' => [
        'go_to_parent' => 'Zobacz recenzję',
        'go_to_child' => 'Zobacz dyskusję',
        'validation' => [
            'invalid_block_type' => '',
            'invalid_document' => '',
            'minimum_issues' => '',
            'missing_text' => '',
            'too_many_blocks' => '',
        ],
    ],

    'system' => [
        'resolved' => [
            'true' => 'Oznaczone jako gotowe przez :user',
            'false' => 'Otworzone ponownie przez :user',
        ],
    ],

    'timestamp_display' => [
        'general' => 'główne',
        'general_all' => 'główne (wszystkie)',
    ],

    'user_filter' => [
        'everyone' => 'Wszyscy',
        'label' => 'Filtruj według użytkownika',
    ],
];
