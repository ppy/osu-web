<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'header' => [
        'small' => 'Спаборнічайце не толькі ў націсканні па кругах.',
        'large' => 'Конкурсы супольнасці',
    ],

    'index' => [
        'nav_title' => 'пералік',
    ],

    'judge' => [
        'comments' => 'каментарыі',
        'hide_judged' => 'схаваць ацэненыя заяўкі',
        'nav_title' => 'суддзя',
        'no_current_vote' => 'вы яшчэ не прагаласавалі.',
        'update' => 'абнавіць',
        'validation' => [
            'missing_score' => 'адсутны вынік',
            'contest_vote_judged' => 'нельга прагаласаваць у конкурсе, які вы судзілі',
        ],
        'voted' => 'Вы ўжо прагаласавалі за гэтую заяўку.',
    ],

    'judge_results' => [
        '_' => 'Вынікі судзейства',
        'creator' => 'аўтар',
        'score' => 'Вынік',
        'score_std' => '',
        'total_score' => 'агульны рахунак',
        'total_score_std' => '',
    ],

    'voting' => [
        'judge_link' => 'Вы - суддзя гэтага конкурсу. Клікніце тут, каб пачаць ацэньваць заяўкі!',
        'judged_notice' => 'Гэты конкурс выкарыстоўвае сістэму судзейства, на дадзены момант суддзі ацэньваюць заяўкі.',
        'login_required' => 'Увайдзіце, каб прагаласаваць.',
        'over' => 'Галасаванне за гэты конкурс скончылася',
        'show_voted_only' => 'Паказаць прагаласаваўшых',

        'best_of' => [
            'none_played' => "Падобна на тое, што вы не гулялі на бітмапах, якія ўдзельнічаюць у конкурсе!",
        ],

        'button' => [
            'add' => 'Галасаваць',
            'remove' => 'Адрабіць голас',
            'used_up' => 'Вы ўжо скарысталі ўсе вашыя галасы',
        ],

        'progress' => [
            '_' => ':used / :max выкарыстаных галасоў',
        ],

        'requirement' => [
            'playlist_beatmapsets' => [
                'incomplete_play' => 'Неабходна сыграць усе карты з плэйліста перад галасаваннем',
            ],
        ],
    ],

    'entry' => [
        '_' => 'удзельнікі конкурсу',
        'login_required' => 'Увайдзіце, каб удзельнічаць у гэтым конкурсе.',
        'silenced_or_restricted' => 'Вы не можаце удзельнічаць у конкурсах падчас абмежавання або сцішша.',
        'preparation' => 'Падрыхтоўваем гэты конкурс. Калі ласка, пачакайце!',
        'drop_here' => 'Перацягніце файл сюды',
        'allowed_extensions' => '',
        'max_size' => '',
        'required_dimensions' => '',
        'download' => 'Спампаваць .osz',
        'wrong_file_type' => '',
        'wrong_dimensions' => 'Памеры заяўкі для гэтага конкурсу павінны быць :widthx:height',
        'too_big' => 'Памеры файлаў для гэтага конкурсу не могуць быць вышэй за :limit.',
    ],

    'beatmaps' => [
        'download' => 'Спампаваць файлы',
    ],

    'vote' => [
        'list' => 'галасоў',
        'count' => ':count голас|:count галасы|:count галасоў',
        'points' => ':count ачко|:count ачкі|:count ачкоў',
        'points_float' => '',
    ],

    'dates' => [
        'ended' => 'Скончыцца :date',
        'ended_no_date' => 'Скончылася',

        'starts' => [
            '_' => 'Пачнецца :date',
            'soon' => 'хутка™',
        ],
    ],

    'states' => [
        'entry' => 'Адкрытыя ўдзелы',
        'voting' => 'Пачатае галасаванне',
        'results' => 'Апублікаваныя вынікі',
    ],

    'show' => [
        'admin' => [
            'page' => '',
        ],
    ],
];
