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
    'feed_title' => 'lista',
    'generic' => 'Naprawiono błędy i dodano mniejsze poprawki.',

    'build' => [
        'title' => 'zmiany w :version',
    ],

    'builds' => [
        'users_online' => ':count_delimited użytkownik online|:count_delimited użytkownicy online|:count_delimited użytkowników online',
    ],

    'entry' => [
        'by' => ':user',
    ],

    'index' => [
        'page_title' => [
            '_' => 'lista zmian',
            '_from' => 'zmiany od :from',
            '_from_to' => 'zmiany w okresie :from - :to',
            '_stream' => 'zmiany w :stream',
            '_stream_from' => 'zmiany w :stream od :from',
            '_stream_from_to' => 'zmiany w :stream w okresie :from - :to',
            '_stream_to' => 'zmiany w :stream do :to',
            '_to' => 'zmiany do :to',
        ],

        'title' => [
            '_' => 'Zmiany (:info)',
            'info' => 'Lista',
        ],
    ],

    'support' => [
        'heading' => 'Podoba ci się ta aktualizacja?',
        'text_1' => 'Wspomóż dalszy rozwój osu! i już dzisiaj :link!',
        'text_1_link' => 'zostań donatorem',
        'text_2' => 'Nie tylko przyspieszy to rozwój gry, ale otrzymasz także wiele dodatkowych funkcji i korzyści!',
    ],
];
