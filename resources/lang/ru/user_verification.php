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
        'sent' => 'В целях безопасности, мы отправили на вашу почту :mail письмо с кодом подтверждения. Введите полученный код.',
        'title' => 'Подтверждение аккаунта',
        'verifying' => 'Код проверяется...',
        'issuing' => 'Отправка другого письма...',

        'info' => [
            'check_spam' => "Проверьте папку «Спам», если Вы не можете найти письмо.",
            'recover' => "Если вы потеряли доступ к своей почте или забыли его, пройдите :link.",
            'recover_link' => 'процедуру восстановления',
            'reissue' => 'Также, вы можете :reissue_link или :logout_link.',
            'reissue_link' => 'запросить другой код',
            'logout_link' => 'выйти',
        ],
    ],

    'errors' => [
        'expired' => 'Код устарел, отправлено новое письмо.',
        'incorrect_key' => 'Неверный код.',
        'retries_exceeded' => 'Неверный код. Вы исчерпали количество попыток, отправлено новое письмо.',
        'reissued' => 'Отправлено письмо с другим кодом.',
        'unknown' => 'Неизвестная ошибка, отправлено новое письмо.',
    ],
];
