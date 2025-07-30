<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'header' => [
        'small' => 'Соревнуйтесь в чём-то, помимо нажатий по кружкам.',
        'large' => 'Конкурсы сообщества',
    ],

    'index' => [
        'nav_title' => 'список',
    ],

    'judge' => [
        'comments' => 'комментарии',
        'hide_judged' => 'скрыть оценённые заявки',
        'nav_title' => 'судья',
        'no_current_vote' => 'вы пока ещё не проголосовали.',
        'update' => 'сохранить',
        'validation' => [
            'missing_score' => 'балл отсутствует',
            'contest_vote_judged' => 'нельзя проголосовать в конкурсе, который вы судили',
        ],
        'voted' => 'Вы уже проголосовали за эту заявку.',
    ],

    'judge_results' => [
        '_' => 'Результаты судейства',
        'creator' => 'создатель',
        'score' => 'Баллы',
        'score_std' => 'Стандартизированные очки',
        'total_score' => 'суммарный балл',
        'total_score_std' => 'всего стандартизированных очков',
    ],

    'voting' => [
        'judge_link' => 'Вы — судья этого конкурса. Нажмите сюда, чтобы начать оценивать заявки!',
        'judged_notice' => 'Этот конкурс использует систему судейства, на данный момент судьи оценивают заявки.',
        'login_required' => 'Пожалуйста, войдите в аккаунт, чтобы проголосовать.',
        'over' => 'Голосование окончено',
        'show_voted_only' => 'Показать проголосованные',

        'best_of' => [
            'none_played' => "Не похоже, что вы сыграли карты, что квалифицированы для этого конкурса!",
        ],

        'button' => [
            'add' => 'Отдать голос',
            'remove' => 'Забрать голос',
            'used_up' => 'Вы уже использовали все свои голоса',
        ],

        'progress' => [
            '_' => ':used / :max голосов отдано',
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

        'wrong_dimensions' => 'Размеры заявки для этого конкурса должны быть :widthx:height',
        'too_big' => 'Размеры файлов для этого конкурса не могут превышать :limit.',
    ],

    'beatmaps' => [
        'download' => 'Скачать файлы',
    ],

    'vote' => [
        'list' => 'голоса',
        'count' => ':count_delimited голос|:count_delimited голоса|:count_delimited голосов',
        'points' => ':count_delimited очко|:count_delimited очка|:count_delimited очков',
        'points_float' => ':points очков',
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

    'show' => [
        'admin' => [
            'page' => '',
        ],
    ],
];
