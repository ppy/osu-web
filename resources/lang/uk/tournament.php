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
        'none_running' => 'На даний момент немає турнірів, будь ласка, спробуйте пізніше!',
        'registration_period' => 'Реєстрація: з :start до :end',

        'header' => [
            'title' => 'Турніри спільноти',
        ],

        'item' => [
            'registered' => 'Зареєстровані гравці',
        ],

        'state' => [
            'current' => 'Активні турніри',
            'previous' => 'Минулі турніри',
        ],
    ],

    'show' => [
        'banner' => 'Підтримайте свою команду',
        'entered' => 'Ви зареєстровані на цей турнір. <br> <br> Зверніть увагу: це <b>не означає</b> що вас призначили в команду. <br> <br> Подальші інструкції будуть відправлені на вашу пошту, ближче до дати турніру, тому будь ласка, перевірте, чи дійсна пошта, до якої прив\'язаний ваш osu! аккаунт!',
        'info_page' => 'Інформаційна сторінка',
        'login_to_register' => 'Будь ласка :login щоб бачити більше інформації про турнір!',
        'not_yet_entered' => 'Ви не зареєстровані на цьому турнірі.',
        'rank_too_low' => 'Вибачте, але ви не відповідаєте вимогам, необхідним на даний турнір!',
        'registration_ends' => 'Реєстрація закрита до :date',

        'button' => [
            'cancel' => 'Скасувати реєстрацію',
            'register' => 'Запишіть мене!',
        ],

        'period' => [
            'end' => '',
            'start' => '',
        ],

        'state' => [
            'before_registration' => 'Реєстрація на цей турнір поки не відкрита.',
            'ended' => 'Цей турнір завершений. Перевірте сторінку з інформацією для перегляду результатів.',
            'registration_closed' => 'Реєстрація на цей турнір закрита. Відкрийте інформаційну сторінку для перегляду останніх змін.',
            'running' => 'Цей турнір вже проводиться. Відкрийте інформаційну сторінку для перегляду останніх змін.',
        ],
    ],
    'tournament_period' => ':start до :end',
];
