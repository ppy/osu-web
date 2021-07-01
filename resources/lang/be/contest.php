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

    'voting' => [
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
            '_' => '',
        ],
    ],
    'entry' => [
        '_' => 'удзельнікі конкурсу',
        'login_required' => 'Увайдзіце, каб удзельнічаць у гэтым конкурсе.',
        'silenced_or_restricted' => 'Вы не можаце удзельнічаць у конкурсах падчас абмежавання або сцішша.',
        'preparation' => 'Падрыхтоўваем гэты конкурс. Калі ласка, пачакайце!',
        'drop_here' => 'Перацягніце файл сюды',
        'download' => 'Спампаваць .osz',
        'wrong_type' => [
            'art' => 'Толькі .jpg і .png файлы дазволены для гэтага конкурсу.',
            'beatmap' => 'Толькі .osu файлы дазволены для гэтага конкурсу.',
            'music' => 'Толькі .mp3 файлы дазволены для гэтага конкурсу.',
        ],
        'too_big' => 'Памеры файлаў для гэтага конкурсу не могуць быць вышэй за :limit.',
    ],
    'beatmaps' => [
        'download' => 'Спампаваць файлы',
    ],
    'vote' => [
        'list' => 'галасоў',
        'count' => ':count голас|:count галасы|:count галасоў',
        'points' => ':count ачко|:count ачкі|:count ачкоў',
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
];
