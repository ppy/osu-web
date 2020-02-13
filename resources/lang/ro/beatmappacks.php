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
    'index' => [
        'description' => 'Colecțiile pre-ambalate de beatmaps sunt bazate în jurul unei teme comune.',
        'nav_title' => 'listare',
        'title' => 'Pachete beatmap',

        'blurb' => [
            'important' => 'CITEȘTE ASTA ÎNAINTE DE A DESCĂRCA',
            'instruction' => [
                '_' => "Instalare: Odată ce un pachet a fost instalat, extrage fișierul .rar în folderul de melodii osu!.
                    Toate melodiile încă sunt de formă .zip și/sau .osz înăuntrul pachetului, deci osu! va trebui să extragă beatmap-urile de unul singur data viitoare când joci.
                    :scary extragi fișierele zip/osz de unul singur,
                    sau beatmap-urile vor fi afișate incorect în osu! și nu vor funcționa bine.",
                'scary' => 'Să NU',
            ],
            'note' => [
                '_' => 'De asemenea, reține că este foarte recomandat să :scary, din moment ce cele mai vechi mape sunt mult mai scăzute calitativ decât cele mai noi.',
                'scary' => 'descarci pachetele de la cele mai noi la cele mai vechi',
            ],
        ],
    ],

    'show' => [
        'download' => 'Descarcă',
        'item' => [
            'cleared' => 'eliminat',
            'not_cleared' => 'neeliminat',
        ],
    ],

    'mode' => [
        'artist' => 'Artist/Album',
        'chart' => 'În lumina reflectoarelor',
        'standard' => 'Standard',
        'theme' => 'Temă',
    ],

    'require_login' => [
        '_' => 'Trebuie să fii :link pentru a descărca',
        'link_text' => 'conectat',
    ],
];
