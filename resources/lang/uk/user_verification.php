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
    'box' => [
        'sent' => 'З метою безпеки, ми відправили на вашу пошту :mail лист з кодом підтвердження. Введіть отриманий код.',
        'title' => 'Підтвердження аккаунта',
        'verifying' => 'Перевірка...',
        'issuing' => 'Відправка іншого листа...',

        'info' => [
            'check_spam' => "Перевірте папку спам, якщо ви не можете знайти лист.",
            'recover' => "Якщо ви втратили доступ до своєї пошти або забули її, пройдіть :link.",
            'recover_link' => 'процес відновлення електронної пошти тут',
            'reissue' => 'Також, ви можете :reissue_link або :logout_link.',
            'reissue_link' => 'запросити інший код',
            'logout_link' => 'вийти',
        ],
    ],

    'errors' => [
        'expired' => 'Даний код застарів, відправлено новий лист.',
        'incorrect_key' => 'Невірний код.',
        'retries_exceeded' => 'Невірний код підтвердження. Ви вичерпали кількість спроб, відправлено новий лист.',
        'reissued' => 'Відправлено лист з іншим кодом.',
        'unknown' => 'Невідома помилка, відправлено новий лист.',
    ],
];
