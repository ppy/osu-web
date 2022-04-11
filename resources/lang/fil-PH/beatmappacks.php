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
            'install_instruction' => 'Installation: Kapag ang pack ay na-download, i-extract ang kuntento ng pack sa iyong osu! Songs directory at osu! na ang bahala.',
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
