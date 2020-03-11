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
    'header' => [
        'small' => 'Змагайтесь в чомусь крім кліків по кружечках.',
        'large' => 'Конкурси спільноти',
    ],

    'index' => [
        'nav_title' => '',
    ],

    'voting' => [
        'over' => 'Голосування закінчено',
        'login_required' => 'Увійдіть, щоб проголосувати.',

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
        'over' => 'Дякуємо за заявки на участь в цьому конкурсі! Голосування розпочнеться найближчим часом.',
        'limit_reached' => 'Ви вичерпали кількість заявок для цього конкурсу',
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
