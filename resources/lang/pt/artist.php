<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'page_description' => 'Artistas destacados no osu!',
    'title' => 'Artistas destacados',

    'admin' => [
        'hidden' => 'O ARTISTA ESTÁ ATUALMENTE OCULTO',
    ],

    'beatmaps' => [
        '_' => 'Mapas',
        'download' => 'transferir o modelo de mapa',
        'download-na' => 'o modelo de mapa ainda não está disponível',
    ],

    'index' => [
        'description' => 'Os artistas destacados são artistas com quem estamos a colaborar para trazer música nova e original ao osu!. Estes artistas e uma seleção das suas faixas foram escolhidas a dedo pela equipa do osu! por serem incríveis e adequadas para a criação de mapas. Alguns destes artistas destacados também criaram faixas exclusivas para utilização no osu!.<br><br>Todas as faixas nesta secção são fornecidas como ficheiros .osz pré‑temporizados e foram oficialmente licenciadas para uso no osu! e em conteúdo relacionado com o osu!.',
    ],

    'links' => [
        'beatmaps' => 'Mapas do osu!',
        'osu' => 'Perfil do osu!',
        'site' => 'Página oficial',
    ],

    'songs' => [
        '_' => 'Músicas',
        'count' => ':count_delimited música|:count_delimited músicas',
        'original' => 'Original do osu!',
        'original_badge' => 'ORIGINAL',
    ],

    'tracklist' => [
        'title' => 'título',
        'length' => 'duração',
        'bpm' => 'bpm',
        'genre' => 'género',
    ],

    'tracks' => [
        'index' => [
            '_' => 'pesquisa de faixas',

            'exclusive_only' => [
                'all' => 'Todos',
                'exclusive_only' => 'original do osu!',
            ],

            'form' => [
                'advanced' => 'Pesquisa avançada',
                'album' => 'Álbum',
                'artist' => 'Artista',
                'bpm_gte' => 'BPM mínimos',
                'bpm_lte' => 'BPM máximos',
                'empty' => 'Não foram encontradas faixas que correspondam aos critérios de pesquisa.',
                'exclusive_only' => 'Tipo',
                'genre' => 'Género',
                'genre_all' => 'Todas',
                'length_gte' => 'Duração mínima',
                'length_lte' => 'Duração máxima',
            ],
        ],
    ],
];
