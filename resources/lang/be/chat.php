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
    'limitation_notice' => 'Заўвага: толькі людзі, якія выкарыстоўваюць <a href=":lazer_link">osu!lazer</a> або новы вэб-сайт будуць атрымоўваць асабістыя паведамленні праз гэту сістэму.<br/>Калі вы не ўпэўнены, адпраўце ім паведамленне праз <a href=":oldpm_link">старую старонку асабістых паведамленняў форуму</a>.',
    'talking_in' => 'размаўляе ў :channel',
    'talking_with' => 'размаўляе з :name',
    'title_compact' => 'чат',

    'cannot_send' => [
        'channel' => 'Зараз вы не можаце адпраўляць паведамленні ў гэты канал. Магчыма гэта выклікана адной з наступных прычын:',
        'user' => 'Зараз вы не можаце адпраўляць паведамленні гэтаму карыстальніку. Магчыма гэта выклікана адной з наступных прычын:',
        'reasons' => [
            'blocked' => 'Вы былі заблакаваны атрымальнікам',
            'channel_moderated' => 'Гэты канал на мадэрацыі',
            'friends_only' => 'Атрымальнік дазволіў адпраўляць паведамленні толькі людзям з яго спісу сяброў',
            'restricted' => 'Зараз вы абмежаваны',
            'target_restricted' => 'Зараз атрымальнік абмежаваны',
        ],
    ],
    'input' => [
        'disabled' => 'не атрымалася адправіць паведамленне...',
        'placeholder' => 'пішыце паведамленне...',
        'send' => 'Адправіць',
    ],
    'no-conversations' => [
        'howto' => "Пачаць размову з профілю або ўсплывальнай карткі карыстальніка.",
        'lazer' => 'Публічныя каналы, да якіх вы далучыліся праз <a href=":link">osu!lazer</a> будуць бачныя тут.',
        'pm_limitations' => 'Толькі людзі, якія выкарыстоўваюць <a href=":link">osu!lazer</a> або новы вэб-сайт будуць атрымоўваць асабістыя паведамленні.',
        'title' => 'яшчэ няма размоў',
    ],
];
