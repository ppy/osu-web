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
        'description' => 'Nakaimpakeng koleksyon ng mga beatmaps base sa magkatulad na tema.',
        'nav_title' => 'listahan',
        'title' => 'Beatmap Packs',

        'blurb' => [
            'important' => 'BASAHIN MO ITO BAGO MAGDOWNLOAD',
            'instruction' => [
                '_' => "Pagkatapos ang isang pack ay nadownload, iextract ang .rar sa directory ng iyong osu! Songs. 
Lahat ng mga kanta ay naka .zip'd at/o .osz'd parin sa loob ng pack, kaya ang osu! mismo ay kailangan na iextract ang mga beatmap sa susunod na beses na ikaw ay pupunta sa Play Mode.
:scary Iextract ang mga zip's/osz's sa iyong sarili
o ang mga beatmap ay lalabas ng hindi tama sa osu! at hindi ito gagana ng maayos.",
                'scary' => 'Huwag',
            ],
            'note' => [
                '_' => 'Isaalang-alang rin na lubos na nirerekomenda sa :scary, dahil ang mga lumang maps ay mas mababang kalidad kaysa sa mga bagong maps.',
                'scary' => 'idownload ang packs mula pinakabago hanggang pinakaluma',
            ],
        ],
    ],

    'show' => [
        'download' => 'Idownload',
        'item' => [
            'cleared' => 'natapos',
            'not_cleared' => 'hindi pa natatapos',
        ],
    ],

    'mode' => [
        'artist' => 'Artista/Album',
        'chart' => 'Spotlights',
        'standard' => 'Standard',
        'theme' => 'Tema',
    ],

    'require_login' => [
        '_' => 'Kailangan mong maging :link para madownload',
        'link_text' => 'naka-sign in',
    ],
];
