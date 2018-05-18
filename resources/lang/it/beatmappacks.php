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
    'index' => [
        'blurb' => [
            'important' => 'LEGGI PRIMA DI SCARICARE',
            'instruction' => [
                '_' => "",
                'scary' => 'NON',
            ],
            'note' => [
                '_' => 'Nota inoltre che è altamente consigliabile :scary, visto che le mappe più vecchie sono di qualità nettamente inferiore rispetto alle più recenti.',
                'scary' => 'scarica i pacchetti dal più recente al più vecchio',
            ],
        ],
        'title' => '',
        'description' => '',
    ],

    'show' => [
        'download' => 'Download',
        'item' => [
            'cleared' => '',
            'not_cleared' => '',
        ],
    ],

    'mode' => [
        'artist' => 'Artista/Album',
        'chart' => '',
        'standard' => 'Standard',
        'theme' => 'Tema',
    ],

    'require_login' => [
        '_' => 'Devi essere :link per scaricare',
        'link_text' => '',
    ],
];
