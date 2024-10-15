<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'box' => [
        'sent' => 'В целях безопасности мы отправили на вашу почту :mail письмо с кодом подтверждения. Введите его ниже.',
        'title' => 'Подтверждение аккаунта',
        'verifying' => 'Проверка кода...',
        'issuing' => 'Отправка нового кода...',

        'info' => [
            'check_spam' => "Проверьте папку «Спам», если вы не можете найти письмо.",
            'recover' => "Если вы потеряли доступ к своей почте или забыли, какую использовали, пройдите :link.",
            'recover_link' => 'процедуру восстановления',
            'reissue' => 'Также, вы можете :reissue_link или :logout_link.',
            'reissue_link' => 'запросить другой код',
            'logout_link' => 'выйти',
        ],
    ],

    'errors' => [
        'expired' => 'Код подтверждения устарел, отправлено новое письмо.',
        'incorrect_key' => 'Неверный код.',
        'retries_exceeded' => 'Неверный код. Вы превысили лимит попыток, поэтому вам отправлено новое письмо.',
        'reissued' => 'Код подтверждения устарел, отправлено новое письмо.',
        'unknown' => 'Произошла неизвестная ошибка, отправлено новое письмо.',
    ],
];
