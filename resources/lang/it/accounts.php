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
        'title' => '<strong>Account</strong> Impostazioni',
        'title_compact' => 'impostazioni',
        'username' => 'nome utente',

        'avatar' => [
            'title' => 'Avatar',
        ],

        'email' => [
            'current' => 'email attuale',
            'new' => 'nuova e-mail',
            'new_confirmation' => 'conferma email',
            'title' => 'Email',
        ],

        'password' => [
            'current' => 'password attuale',
            'new' => 'nuova password',
            'new_confirmation' => 'conferma password',
            'title' => 'Password',
        ],

        'profile' => [
            'title' => 'Profilo',

            'user' => [
                'user_from' => 'posizione attuale',
                'user_interests' => 'interessi',
                'user_msnm' => '',
                'user_occ' => 'occupazione',
                'user_twitter' => '',
                'user_website' => 'sito web',
                'user_discord' => '',
            ],
        ],

        'signature' => [
            'title' => 'Firma',
            'update' => 'aggiorna',
        ],
    ],

    'update_email' => [
        'email_subject' => 'conferma il cambio della email di osu!',
        'update' => 'aggiorna',
    ],

    'update_password' => [
        'email_subject' => 'conferma il cambio della password di osu!',
        'update' => 'aggiorna',
    ],

    'playstyles' => [
        'title' => 'Stili di gioco',
        'mouse' => 'mouse',
        'keyboard' => 'tastiera',
        'tablet' => 'tavoletta grafica',
        'touch' => 'schermo touch',
    ],

    'privacy' => [
        'title' => 'Privacy',
        'friends_only' => 'blocca messaggi privati dei non-amici',
        'hide_online' => 'nascondi il tuo stato online',
    ],

    'security' => [
        'current_session' => 'questo dispositivo',
        'end_session' => 'Termina Sessione',
        'end_session_confirmation' => 'Questo terminerà la sessione sul dispositivo selezionato. Vuoi continuare?',
        'last_active' => 'Ultimo visto:',
        'title' => 'Sicurezza',
        'web_sessions' => 'sessioni web',
    ],
];
