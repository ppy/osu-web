<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

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
        'no_diff_reduction' => [
            '_' => ':link ay hindi maaaring gamitin upang i-klaro ang pack na ito.',
            'link' => 'Ang mga difficulty reduction mods',
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
