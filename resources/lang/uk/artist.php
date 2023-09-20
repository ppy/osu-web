<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'page_description' => 'Обрані виконавці osu!',
    'title' => 'Обрані Виконавці',

    'admin' => [
        'hidden' => 'ВИКОНАВЕЦЬ ЗАРАЗ ПРИХОВАНИЙ',
    ],

    'beatmaps' => [
        '_' => 'Бітмапи',
        'download' => 'завантажити шаблон мапи',
        'download-na' => 'шаблон мапи поки що недоступний',
    ],

    'index' => [
        'description' => 'Обрані виконавці - це виконавці з якими ми співпрацюємо, щоб наповнити osu! новою та оригінальною музикою. Ці виконавці та збірки їх треків були ретельно відібрані командою osu!, як неймовірно круті та найбільш відповідні для маппінгу. Деякі з обраних виконавців також створили нові треки виключно для osu!.<br><br>Всі треки в цій секції мають вже затаймлені .osz файли та були офіційно ліцензовані для використання в osu! та контеті пов\'язаним з osu!',
    ],

    'links' => [
        'beatmaps' => 'osu! Бітмапи',
        'osu' => 'osu! Профіль',
        'site' => 'Офіційний веб-сайт',
    ],

    'songs' => [
        '_' => 'Пісні',
        'count' => ':count_delimited пісня|:count_delimited пісні|:count_delimited пісень',
        'original' => 'ексклюзивно для osu! ',
        'original_badge' => 'ОРИГІНАЛ',
    ],

    'tracklist' => [
        'title' => 'назва',
        'length' => 'тривалість',
        'bpm' => 'bpm',
        'genre' => 'жанр',
    ],

    'tracks' => [
        'index' => [
            '_' => 'пошук треків',

            'form' => [
                'advanced' => 'Розширений Пошук ',
                'album' => 'Альбом ',
                'artist' => 'Виконавець',
                'bpm_gte' => 'Мінімальний BPM',
                'bpm_lte' => 'Максимальний BPM',
                'empty' => 'Не знайдено жодного треку, що відповідає критеріям пошуку.',
                'genre' => 'Жанр ',
                'genre_all' => 'Всі ',
                'length_gte' => 'Мінімальна Тривалість',
                'length_lte' => 'Максимальна Тривалість',
            ],
        ],
    ],
];
