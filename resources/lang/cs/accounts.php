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
    'edit' => [
        'title' => 'Nastavení<strong>účtu</strong>',
        'title_compact' => 'nastavení',
        'username' => 'uživatelské jméno',

        'avatar' => [
            'title' => 'Avatar',
        ],

        'email' => [
            'current' => 'aktuální e-mail',
            'new' => 'nový e-mail',
            'new_confirmation' => 'ověření e-mailu',
            'title' => 'E-mail',
        ],

        'password' => [
            'current' => 'současné heslo',
            'new' => 'nové heslo',
            'new_confirmation' => 'potvrzení hesla',
            'title' => 'Heslo',
        ],

        'profile' => [
            'title' => 'Profil',

            'user' => [
                'user_from' => 'současná poloha',
                'user_interests' => 'zájmy',
                'user_msnm' => '',
                'user_occ' => 'zaměstnání',
                'user_twitter' => '',
                'user_website' => 'webové stránky',
                'user_discord' => '',
            ],
        ],

        'signature' => [
            'title' => 'Podpis',
            'update' => 'aktualizovat',
        ],
    ],

    'update_email' => [
        'email_subject' => 'potvrzení změny osu! e-mailu',
        'update' => 'aktualizovat',
    ],

    'update_password' => [
        'email_subject' => 'potvrzení změny osu! hesla',
        'update' => 'aktualizovat',
    ],

    'playstyles' => [
        'title' => 'Styly hraní',
        'mouse' => 'myš',
        'keyboard' => 'klávesnice',
        'tablet' => 'tablet',
        'touch' => 'dotyk',
    ],

    'privacy' => [
        'title' => 'Soukromí',
        'friends_only' => 'blokovat soukromé zprávy od lidí, kteří nejsou v tvém seznamu přátel',
        'hide_online' => 'skrýt váš online status',
    ],

    'security' => [
        'current_session' => 'současná',
        'end_session' => 'Ukončit relaci',
        'end_session_confirmation' => 'Toto okamžitě ukončí vaši relaci na tom zařízení. Jste si jistý?',
        'last_active' => 'Naposledy aktivní:',
        'title' => 'Zabezpečení',
        'web_sessions' => 'webové relace',
    ],
];
