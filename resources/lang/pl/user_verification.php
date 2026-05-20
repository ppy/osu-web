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
                '_' => 'Możesz również :link.',
                'link' => 'wyloguj się',
            ],
            'mail_fallback' => [
                '_' => 'Jeżeli nie możesz uzyskać dostępu do aplikacji, :link.',
                'link' => 'zamiast tego, możesz się zweryfikować używając e-maila ',
            ],
        ],
    ],

    'errors' => [
        'expired' => 'Ten kod wygasł. Wysłano nowy kod weryfikacyjny.',
        'incorrect_key' => 'Wprowadzono nieprawidłowy kod weryfikacyjny.',
        'retries_exceeded' => 'Wprowadzono nieprawidłowy kod weryfikacyjny. Liczba prób została przekroczona, w związku z czym wysłaliśmy nowy kod weryfikacyjny.',
        'reissued' => 'Wygenerowano nowy kod weryfikacyjny. Sprawdź swoją skrzynkę odbiorczą.',
        'totp_used_key' => 'Kod weryfikacyjny został już użyty. Proszę poczekać i użyć nowego.',
        'totp_gone' => 'Token uwierzytelniania został usunięty, zmieniam na weryfikację e-mailem. E-mail weryfikacyjny został wysłany.',
        'unknown' => 'Wystąpił nieoczekiwany błąd. Wysłano nowy kod weryfikacyjny.',
    ],
];
