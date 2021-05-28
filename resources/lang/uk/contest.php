<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'header' => [
        'small' => 'Змагайтесь в чомусь крім кліків по кружечках.',
        'large' => 'Конкурси спільноти',
    ],

    'index' => [
        'nav_title' => 'бібліотека',
    ],

    'voting' => [
        'login_required' => 'Увійдіть, щоб проголосувати.',
        'over' => 'Голосування закінчено',
        'show_voted_only' => 'Показати голоси',

        'best_of' => [
            'none_played' => "Схоже ви ще не грали в карти, які беруть участь конкурсі!",
        ],

        'button' => [
            'add' => 'Голосувати',
            'remove' => 'Скасувати голос',
            'used_up' => 'Ви використовували всі свої голоси',
        ],
    ],
    'entry' => [
        '_' => 'реєстрація',
        'login_required' => 'Увійдіть, щоб брати участь в цьому конкурсі.',
        'silenced_or_restricted' => 'Ви не можете брати участь у конкурсі поки ваші права обмежені.',
        'preparation' => 'В даний час ми готуємо цей конкурс! Будь ласка, потерпи трохи!',
        'drop_here' => 'Кинь свою заявку сюди',
        'download' => 'Завантажити .osz',
        'wrong_type' => [
            'art' => 'Тільки файли формату .jpg і .png дозволені для цього конкурсу.',
            'beatmap' => 'Тільки файли формату .osu дозволені для цього конкурсу.',
            'music' => 'Тільки файли формату .mp3 дозволені для цього конкурсу.',
        ],
        'too_big' => 'Розміри файлів для цього конкурсу не можуть перевищувати :limit.',
    ],
    'beatmaps' => [
        'download' => 'Завантажити файли',
    ],
    'vote' => [
        'list' => 'голосів',
        'count' => ':count_delimited голос|:count_delimited голосів',
        'points' => ':count_delimited очок|:count_delimited очків',
    ],
    'dates' => [
        'ended' => 'Завершено :date',
        'ended_no_date' => 'Закінчено',

        'starts' => [
            '_' => 'Розпочнеться :date',
            'soon' => 'скоро™',
        ],
    ],
    'states' => [
        'entry' => 'Відкриті заявки',
        'voting' => 'Голосування почалося',
        'results' => 'Результати опубліковані',
    ],
];
