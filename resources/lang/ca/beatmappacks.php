<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'index' => [
        'description' => 'Col·leccions preempaquetades de beatmaps basades en un tema comú.',
        'empty' => '',
        'nav_title' => 'llistat',
        'title' => 'Paquets de beatmaps',

        'blurb' => [
            'important' => 'LLEGEIX AIXÒ ABANS DE DESCARREGAR',
            'install_instruction' => 'Instal·lació: Un cop descarregat un paquet, extraieu-ne el contingut al directori Songs d\'osu! i aquest farà la resta.',
            'note' => [
                '_' => 'També tingues en compte que és molt recomanable :scary, ja que els beatmaps més antics són de molta menor qualitat que els beatmaps més recents.',
                'scary' => 'descarregar els paquets dels més recents als més antics',
            ],
        ],
    ],

    'show' => [
        'download' => 'Descarregar',
        'item' => [
            'cleared' => 'completat',
            'not_cleared' => 'no completat',
        ],
        'no_diff_reduction' => [
            '_' => ':link no es poden utilitzar per completar aquest paquet.',
            'link' => 'Els mods de reducció de dificultat',
        ],
    ],

    'mode' => [
        'artist' => 'Artista/Àlbum',
        'chart' => 'Destacats',
        'featured' => '',
        'standard' => 'Standard',
        'theme' => 'Tema',
        'tournament' => 'Torneig',
    ],

    'require_login' => [
        '_' => 'Necessites tenir la :link per descarregar',
        'link_text' => 'sessió iniciada',
    ],
];
