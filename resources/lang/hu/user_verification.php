<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'box' => [
        'sent' => ':mail címre e-mailben hitelesítő kódot küldtünk. Írja be a kódot.',
        'title' => 'Fiók hitelesítés',
        'verifying' => 'Hitelesítés...',
        'issuing' => 'Új kód kiadása...',

        'info' => [
            'check_spam' => "Ellenőrizd a spam mappádat is, ha nem találod az e-mailt.",
            'recover' => "Ha nem tudsz hozzáférni az e-mailedhez vagy elfelejtetted melyiket használtad, kérlek kövesd ezt a linket: :link.",
            'recover_link' => 'e-mail helyreállítási folyamat itt',
            'reissue' => 'Valamint tudsz :reissue_link vagy :logout_link.',
            'reissue_link' => 'másik kód kérése',
            'logout_link' => 'kijelentkezés',
        ],
    ],

    'box_totp' => [
        'heading' => 'Adjuk meg a hitelesítő alkalmazás által generált kódot.',

        'info' => [
            'logout' => [
                '_' => 'Ezenkívül a következő lehetőség is rendelkezésre áll: :link.',
                'link' => 'kijelentkezés',
            ],
            'mail_fallback' => [
                '_' => 'Ha nem tudsz belépni az alkalmazásodba, :link.',
                'link' => 'ehelyett e-mailen keresztül is ellenőrizheti',
            ],
        ],
    ],

    'errors' => [
        'expired' => 'Érvénytelen ellenőrző kód, új visszaigazoló e-mail lett küldve.',
        'incorrect_key' => 'Helytelen hitelesítő kód.',
        'retries_exceeded' => 'Helytelen hitelesítő kód. Újrapróbálkozási korlát túllépve, új ellenőrző e-mail elküldve.',
        'reissued' => 'Ellenőrző kód kiadva, új visszaigazoló e-mail lett küldve.',
        'totp_used_key' => 'Verification code has already been used. Please wait and use a new one.',
        'totp_gone' => 'A hitelesítési token törlésre került, e-mailes hitelesítésre váltunk. A hitelesítő e-mail elküldésre került.',
        'unknown' => 'Ismeretlen hiba történt, új visszaigazoló email küldve.',
    ],
];
