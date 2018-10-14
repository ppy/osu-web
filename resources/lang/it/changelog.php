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
    'feed_title' => 'feed',
    'generic' => 'Correzione di bug e piccoli miglioramenti.',

    'build' => [
        'title' => 'modifiche in :version',
    ],

    'builds' => [
        'users_online' => ':count_delimited utente online|:count_delimited utenti online',
    ],

    'entry' => [
        'by' => 'da :user',
    ],

    'index' => [
        'page_title' => [
            '_' => 'registro delle modifiche',
            '_from' => 'modifiche dal :from',
            '_from_to' => 'modifiche da :from a :to',
            '_stream' => 'modifiche in :stream',
            '_stream_from' => 'modiche in :stream dal :from',
            '_stream_from_to' => 'modifiche in :stream da :from a :to',
            '_stream_to' => 'modifiche in :stream fino a :to',
            '_to' => 'modifiche fino a :to',
        ],

        'title' => [
            '_' => 'Registro delle modifiche :info',
            'info' => 'Lista',
        ],
    ],

    'support' => [
        'heading' => 'Adori questo aggiornamento?',
        'text_1' => 'Sostieni gli sviluppi futuri di osu! e :link oggi!',
        'text_1_link' => 'diventa un sostenitore',
        'text_2' => 'Non solo aiuterai a velocizzare lo sviluppo, ma riceverai anche nuove funzionalità e opzioni!',
    ],
];
