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

    'email' => [
        'subject' => 'osu! fiók hitelesítés',
    ],

    'errors' => [
        'expired' => 'Érvénytelen ellenőrző kód, új visszaigazoló e-mail lett küldve.',
        'incorrect_key' => 'Helytelen hitelesítő kód.',
        'retries_exceeded' => 'Helytelen hitelesítő kód. Újrapróbálkozási korlát túllépve, új ellenőrző e-mail elküldve.',
        'reissued' => 'Ellenőrző kód kiadva, új visszaigazoló e-mail lett küldve.',
        'unknown' => 'Ismeretlen hiba történt, új visszaigazoló email küldve.',
    ],
];
