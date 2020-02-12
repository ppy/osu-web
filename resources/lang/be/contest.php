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
        'small' => 'Спаборнічайце не толькі ў націсканні па кругах.',
        'large' => 'Конкурсы супольнасці',
    ],

    'index' => [
        'nav_title' => '',
    ],

    'voting' => [
        'over' => 'Галасаванне за гэты конкурс скончылася',
        'login_required' => 'Увайдзіце, каб прагаласаваць.',

        'best_of' => [
            'none_played' => "Падобна на тое, што вы не гулялі на бітмапах, якія ўдзельнічаюць у конкурсе!",
        ],

        'button' => [
            'add' => 'Галасаваць',
            'remove' => 'Адрабіць голас',
            'used_up' => 'Вы ўжо скарысталі ўсе вашыя галасы',
        ],
    ],
    'entry' => [
        '_' => 'удзельнікі конкурсу',
        'login_required' => 'Увайдзіце, каб удзельнічаць у гэтым конкурсе.',
        'silenced_or_restricted' => 'Вы не можаце удзельнічаць у конкурсах падчас абмежавання або сцішша.',
        'preparation' => 'Падрыхтоўваем гэты конкурс. Калі ласка, пачакайце!',
        'over' => 'Дзякуем за ўдзел у гэтым конкурсе! Галасаванне ў хуткім часе пачнецца.',
        'limit_reached' => 'Вы дасягнулі ліміту ўдзелаў у гэтым конкурсе',
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
