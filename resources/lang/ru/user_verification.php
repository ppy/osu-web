<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

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
