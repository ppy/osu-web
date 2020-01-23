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
    'cancel' => 'Mégse',

    'authorise' => [
        'request' => 'engedélyt kér a fiókodhoz.',
        'scopes_title' => 'Ez az alkalmazás képes lesz a:',
        'title' => 'Hitelesítési Kérelem',
    ],

    'authorized_clients' => [
        'confirm_revoke' => 'Biztosan vissza akarod vonni ezen kliens jogait?',
        'scopes_title' => '',
        'owned_by' => '',
        'none' => '',

        'revoked' => [
            'false' => '',
            'true' => '',
        ],
    ],

    'client' => [
        'id' => '',
        'name' => 'Alkalmazás neve',
        'redirect' => '',
        'secret' => 'Ügyfél titkos kódja',
    ],

    'new_client' => [
        'header' => '',
        'register' => 'Regisztráld az alkalmazásodat',
        'terms_of_use' => [
            '_' => '',
            'link' => 'Felhasználási feltételek',
        ],
    ],

    'own_clients' => [
        'confirm_delete' => '',
        'new' => 'Új OAuth alkalmazás',
        'none' => 'Nincs Kliens',

        'revoked' => [
            'false' => 'Törlés',
            'true' => 'Törölve',
        ],
    ],
];
