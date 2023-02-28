<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'page_description' => 'Обрані виконавці osu!',
    'title' => 'Обрані виконавці',

    'admin' => [
        'hidden' => 'ВИКОНАВЕЦЬ ЗАРАЗ ПРИХОВАНИЙ',
    ],

    'beatmaps' => [
        '_' => 'Карти',
        'download' => 'Завантажити шаблон карти',
        'download-na' => 'Шаблон мапи поки що недоступний',
    ],

    'index' => [
        'description' => 'Обрані виконавці - це виконавці з якими ми працюємо спільно, щоб привнести нову та оригінальну музику в osu!. Ці артисти і їх підбірка треків були підібрані командою osu! чудовими й придатними для маппінгу. Деякі з обраних виконавців присвятили нові екслюзивні треки  для використання в osu!.<br><br>До всіх треків в цій секії прикладується вже налаштований .osz файл. Всі треки є офіційно ліцензіованими для використання в osu! й в пов\'язаних з нею проєктах.',
    ],

    'links' => [
        'beatmaps' => 'osu! бітмапи',
        'osu' => 'osu! профіль',
        'site' => 'Офіційний веб-сайт',
    ],

    'songs' => [
        '_' => 'Пісні',
        'count' => ':count_delimited пісня|:count_delimited пісні|:count_delimited пісень',
        'original' => 'виключно для osu! ',
        'original_badge' => 'ОРИГІНАЛ',
    ],

    'tracklist' => [
        'title' => 'назва',
        'length' => 'довжина',
        'bpm' => 'bpm',
        'genre' => 'жанр',
    ],

    'tracks' => [
        'index' => [
            '_' => 'пошук треків',

            'form' => [
                'advanced' => 'Розширений пошук ',
                'album' => 'Альбом ',
                'artist' => 'Виконавець',
                'bpm_gte' => 'Мінімальний BPM',
                'bpm_lte' => 'Максимальний BPM',
                'empty' => 'Не знайдено жодного треку, що відповідає критеріям пошуку.',
                'genre' => 'Жанр ',
                'genre_all' => 'Всі ',
                'length_gte' => 'Мінімальна довжина ',
                'length_lte' => 'Максимальна довжина ',
            ],
        ],
    ],
];
