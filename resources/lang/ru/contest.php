<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'header' => [
        'small' => 'Соревнуйтесь в чём-то, помимо нажатий по кружкам.',
        'large' => 'Конкурсы сообщества',
    ],

    'index' => [
        'nav_title' => 'библиотека',
    ],

    'voting' => [
        'login_required' => 'Пожалуйста, войдите в аккаунт, чтобы проголосовать.',
        'over' => 'Голосование окончено',
        'show_voted_only' => 'Показать проголосованные ',

        'best_of' => [
            'none_played' => "Не похоже, что Вы играли в какие-либо из карт, что квалифицированы для этого конкурса!",
        ],

        'button' => [
            'add' => 'Голосовать',
            'remove' => 'Отменить голос',
            'used_up' => 'Вы уже использовали все свои голоса',
        ],

        'progress' => [
            '_' => ':used / :max голосов использовано',
        ],

        'requirement' => [
            'playlist_beatmapsets' => [
                'incomplete_play' => 'Необходимо сыграть все карты из плейлиста перед голосованием',
            ],
        ],
    ],
    'entry' => [
        '_' => 'заявка',
        'login_required' => 'Войдите, чтобы участвовать в этом конкурсе.',
        'silenced_or_restricted' => 'Вы не можете участвовать в конкурсе пока ваши права ограничены.',
        'preparation' => 'В настоящее время мы готовимся к этому конкурсу! Пожалуйста, немного потерпите.',
        'drop_here' => 'Оставь свою заявку здесь',
        'download' => 'Скачать .osz',
        'wrong_type' => [
            'art' => 'Только файлы формата .jpg и .png разрешены для этого конкурса.',
            'beatmap' => 'Только файлы формата .osu разрешены для этого конкурса.',
            'music' => 'Только файлы формата .mp3 разрешены для этого конкурса.',
        ],
        'too_big' => 'Размеры файлов для этого конкурса не могут превышать :limit.',
    ],
    'beatmaps' => [
        'download' => 'Скачать файлы',
    ],
    'vote' => [
        'list' => 'голосов',
        'count' => ':count_delimited голос|:count_delimited голоса|:count_delimited голосов',
        'points' => ':count_delimited очко|:count_delimited очка|:count_delimited очков',
    ],
    'dates' => [
        'ended' => 'Окончен :date',
        'ended_no_date' => 'Окончен',

        'starts' => [
            '_' => 'Начнётся :date',
            'soon' => 'скоро™',
        ],
    ],
    'states' => [
        'entry' => 'Заявки открыты',
        'voting' => 'Голосование началось',
        'results' => 'Результаты опубликованы',
    ],
];
