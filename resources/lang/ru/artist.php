<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'page_description' => 'Избранные исполнители osu!',
    'title' => 'Избранные исполнители',

    'admin' => [
        'hidden' => 'ИСПОЛНИТЕЛЬ СКРЫТ',
    ],

    'beatmaps' => [
        '_' => 'Карты',
        'download' => 'скачать шаблон карты',
        'download-na' => 'шаблон карты пока недоступен',
    ],

    'index' => [
        'description' => 'Избранные исполнители — это артисты, с которыми мы начали сотрудничать, чтобы наполнить игру свежей и оригинальной музыкой. Команда osu! вручную отобрала классные песни и их авторов как наиболее подходящие для создания карт. Некоторые исполнители сочиняют музыку эксклюзивно для osu!.<br><br>Ко всем песням ниже, у которых есть лицензия на использование в osu! и других связанных продуктах, прилагаются шаблоны для маппинга.',
    ],

    'links' => [
        'beatmaps' => 'Карты osu!',
        'osu' => 'Профиль в osu!',
        'site' => 'Официальный сайт',
    ],

    'songs' => [
        '_' => 'Песни',
        'count' => ':count_delimited песня|:count_delimited песни|:count_delimited песен',
        'original' => 'исключительно для osu!',
        'original_badge' => 'ORIGINAL',
    ],

    'tracklist' => [
        'title' => 'название',
        'length' => 'длина',
        'bpm' => 'bpm',
        'genre' => 'жанр',
    ],

    'tracks' => [
        'index' => [
            '_' => 'поиск треков',

            'exclusive_only' => [
                'all' => 'Все',
                'exclusive_only' => 'исключительно для osu!',
            ],

            'form' => [
                'advanced' => 'Расширенный поиск',
                'album' => 'Альбом',
                'artist' => 'Исполнитель',
                'bpm_gte' => 'Минимальный BPM',
                'bpm_lte' => 'Максимальный BPM',
                'empty' => 'Треков, соответствующих критериям поиска, не найдено.',
                'exclusive_only' => 'Тип',
                'genre' => 'Жанр',
                'genre_all' => 'Все',
                'length_gte' => 'Минимальная длина',
                'length_lte' => 'Максимальная длина',
            ],
        ],
    ],
];
