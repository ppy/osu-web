<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'box' => [
        'sent' => 'E-mail z kodem weryfikacyjnym został wysłany na adres :mail. Wprowadź otrzymany kod.',
        'title' => 'Weryfikacja konta',
        'verifying' => 'Weryfikowanie...',
        'issuing' => 'Tworzenie nowego kodu...',

        'info' => [
            'check_spam' => "Sprawdź folder spam, jeżeli nie możesz znaleźć e-maila.",
            'recover' => "Jeżeli nie masz dostępu do e-maila lub nie pamiętasz, który jest przypisany do konta, spróbuj :link.",
            'recover_link' => 'odzyskać go tutaj',
            'reissue' => 'Możesz także :reissue_link lub :logout_link.',
            'reissue_link' => 'poprosić o inny kod',
            'logout_link' => 'wylogować się',
        ],
    ],

    'box_totp' => [
        'heading' => 'Wprowadź kod z aplikacji uwierzytelniającej.',

        'info' => [
            'logout' => [
                '_' => 'Możesz się także :link.',
                'link' => 'wylogować',
            ],
            'mail_fallback' => [
                '_' => 'Jeżeli nie masz dostępu do aplikacji, :link.',
                'link' => 'możesz zweryfikować się poprzez wiadomość e-mail',
            ],
        ],
    ],

    'errors' => [
        'expired' => 'Ten kod wygasł. Wysłano nowy kod weryfikacyjny.',
        'incorrect_key' => 'Wprowadzono nieprawidłowy kod weryfikacyjny.',
        'retries_exceeded' => 'Wprowadzono nieprawidłowy kod weryfikacyjny. Liczba prób została przekroczona, w związku z czym wysłaliśmy nowy kod weryfikacyjny.',
        'reissued' => 'Wygenerowano nowy kod weryfikacyjny. Sprawdź swoją skrzynkę odbiorczą.',
        'totp_used_key' => 'Kod weryfikacyjny został już użyty. Poczekaj chwilę i użyj nowego kodu.',
        'totp_gone' => 'Token uwierzytelniający został usunięty - zmieniam na weryfikację poprzez wiadomość e-mail. Wiadomość z kodem weryfikacyjnym została wysłana na adres e-mail.',
        'unknown' => 'Wystąpił nieoczekiwany błąd. Wysłano nowy kod weryfikacyjny.',
    ],
];
