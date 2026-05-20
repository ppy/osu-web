<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'page_description' => 'Artistes destacats a osu!',
    'title' => 'Artistes destacats',

    'admin' => [
        'hidden' => 'L\'ARTISTA ESTÀ ACTUALMENT OCULT',
    ],

    'beatmaps' => [
        '_' => 'Mapes',
        'download' => 'descarrega la plantilla del mapa',
        'download-na' => 'La plantilla del mapa encara no està disponible',
    ],

    'index' => [
        'description' => 'Els artistes destacats són artistes amb els quals col·laborem per a brindar-li música nova i original a osu!. Aquests artistes i una selecció dels seus treballs han estat triats per l\'equip de osu! per ser genials i adequats per al mapeig. Alguns d\'aquests artistes destacats també van crear noves cançons exclusives per al seu ús en osu!.<br><br>Totes les cançons en aquesta secció són proporcionades com a arxius .osz amb ritme prèviament calculat i han estat llicenciades oficialment per al seu ús en osu! i contingut relacionat amb osu!.',
    ],

    'links' => [
        'beatmaps' => 'Mapes d\'osu!',
        'osu' => 'Perfil d\'osu!',
        'site' => 'Lloc web oficial',
    ],

    'songs' => [
        '_' => 'Cançons',
        'count' => ':count_delimited cançó|:count_delimited cançons',
        'original' => 'original d\'osu!',
        'original_badge' => 'ORIGINAL',
    ],

    'tracklist' => [
        'title' => 'títol',
        'length' => 'durada',
        'bpm' => 'ppm',
        'genre' => 'gènere',
    ],

    'tracks' => [
        'index' => [
            '_' => 'cerca de pistes',

            'exclusive_only' => [
                'all' => 'Totes',
                'exclusive_only' => 'osu! original',
            ],

            'form' => [
                'advanced' => 'Cerca avançada',
                'album' => 'Àlbum',
                'artist' => 'Artista',
                'bpm_gte' => 'PPM mínim',
                'bpm_lte' => 'PPM màxim',
                'empty' => 'No s\'ha trobat cap pista que coincideixi amb els criteris de cerca.',
                'exclusive_only' => 'Tipus',
                'genre' => 'Gènere',
                'genre_all' => 'Tots',
                'length_gte' => 'Durada mínima',
                'length_lte' => 'Durada màxima',
            ],
        ],
    ],
];
