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
    'index' => [
        'none_running' => 'На дадзены момант няма турніраў, калі ласка, паспрабуйце пазней!',
        'registration_period' => 'Рэгістрацыя: з :start да :end',

        'header' => [
            'title' => 'Турніры супольнасці',
        ],

        'item' => [
            'registered' => 'Зарэгістравананыя гульцы',
        ],

        'state' => [
            'current' => 'Актыўныя турніры',
            'previous' => 'Мінулыя турніры',
        ],
    ],

    'show' => [
        'banner' => 'Падтрымай сваю каманду',
        'entered' => 'Вы зарэгістраваліся на гэты турнір.<br><br>Заўвага: гэта не азначае, што вас прынялі ў каманду.<br><br>Далейшыя інструкцыі будуць адпраўлены на вашу эл. пошту бліжэй да даты турніру, таму ўпэўнецеся, што ваша эл. пошта osu! правільная.',
        'info_page' => 'Інфармацыйная старонка',
        'login_to_register' => 'Калі ласка :login каб бачыць больш звестак пра турнір!',
        'not_yet_entered' => 'Вы не зарэгістраваны на гэтым турніры.',
        'rank_too_low' => 'Прабачце, але вы не падыходзіць па патрабаванням, неабходным на дадзены турнір!',
        'registration_ends' => 'Рэгістрацыя закрыта да :date',

        'button' => [
            'cancel' => 'Скасаваць рэгістрацыю',
            'register' => 'Зарэгістравацца!',
        ],

        'period' => [
            'end' => '',
            'start' => '',
        ],

        'state' => [
            'before_registration' => 'Рэгістрацыя на гэты турніру яшчэ не адкрылася.',
            'ended' => 'Гэты турнір завершаны. Праверце інфармацыйную старонку, каб даведацца вынік.',
            'registration_closed' => 'Рэгістрацыя на гэты турнір закрылася. Праверце інфармацыйную старонку, каб праглядзець апошнія абнаўленні.',
            'running' => 'Гэты турнір ужо праводзіцца. Праверце інфармацыйную старонку, каб даведацца больш дэталяў.',
        ],
    ],
    'tournament_period' => ':start да :end',
];
