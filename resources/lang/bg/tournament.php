<?php

/**
 *    Copyright 2015-2018 ppy Pty. Ltd.
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
        'none_running' => 'Вмомента няма активни турнири. Моля проверете отново по-късно!',
        'registration_period' => 'Регистрация: от :start до :end',

        'header' => [
            'subtitle' => 'Списък на текущи официално одобрени турнири',
            'title' => 'Обществени турнири',
        ],

        'item' => [
            'registered' => 'Регистрирани играчи',
        ],

        'state' => [
            'current' => 'Текущи турнири',
            'previous' => 'Предишни турнири',
        ],
    ],

    'show' => [
        'banner' => 'Подкрепи отбора си',
        'entered' => 'Вие сте вече регистрирани за този турнир.<br><br>Имайте в предвид, че вмомента не сте назначени към отбор.<br><br>По-нататъшни инструкции ще бъдат изпратени до вас по електронна поща близо до началната дата на турнира, така че проверете дали имейла ви е правилно изписан!',
        'info_page' => 'Информационна страница',
        'login_to_register' => 'Моля :login, за да имате достъп до регистрационните подробности!',
        'not_yet_entered' => 'Вие не сте регистриран за този турнир.',
        'rank_too_low' => 'Не отговяряте на необходимите изисквания за този турнир!',
        'registration_ends' => 'Регистрацията затваря на :date',

        'button' => [
            'cancel' => 'Отмени регистрацията',
            'register' => 'Запиши ме!',
        ],

        'state' => [
            'before_registration' => 'Регистрацията за този турнир още не е започнала.',
            'ended' => 'Този турнир приключи. Проверете информационната страниза за резултати.',
            'registration_closed' => 'Регистрацията за този турнир затвори. Проверете информационната страница за последните новини.',
            'running' => 'Този турнир вмомента се провежда. Проверете информационната страница за повече детайли.',
        ],
    ],
    'tournament_period' => 'от :start до :end',
];
