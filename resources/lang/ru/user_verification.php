<?php

/**
 *    Copyright 2015-2017 ppy Pty. Ltd.
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
        'sent' => 'Мы отправили Вам электронное письмо на адрес :mail с кодом подтверждения. Введите код.',
        'title' => 'Подтвердите, что это Вы',
        'verifying' => 'Проверка...',
        'issuing' => 'Отправка нового письма...',

        'info' => [
            'check_spam' => 'Убедитесь, что Вы проверили папку спама, если еще не нашли письмо.',
            'recover' => 'Если Вы утратили доступ к своей электронной почте, пройдите :link',
            'recover_link' => 'процедуру восстановления доступа к электронной почте',
            'reissue' => 'Вы также можете :reissue_link или :logout_link.',
            'reissue_link' => 'получить другой код подтверждения',
            'logout_link' => 'выйти',
        ],
    ],

    'email' => [
        'subject' => 'Подтверждение доступа в osu!',
    ],

    'errors' => [
        'expired' => 'Время действия кода истекло, отправлено новое письмо.',
        'incorrect_key' => 'Неверный код подтверждения.',
        'retries_exceeded' => 'Неверный код подтверждения. Вы превысили количество попыток, отправлено новое письмо.',
        'reissued' => 'Письмо успешно отправлено, проверьте свою почту.',
        'unknown' => 'Возникла неизвестная ошибка, отправлено новое письмо.',
    ],
];
