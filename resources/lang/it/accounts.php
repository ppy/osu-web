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
        'title_compact' => 'impostazioni',
        'username' => 'nome utente',

        'avatar' => [
            'title' => 'Avatar',
            'rules' => 'Assicurati che il tuo avatar aderisca alle :link.<br/>Questo significa che deve essere <strong>adatto a tutte le età</strong>. es. nessun contenuto di nudità, profanità o provocante.',
            'rules_link' => 'regole della comunità',
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
                'user_discord' => '',
                'user_from' => 'posizione attuale',
                'user_interests' => 'interessi',
                'user_msnm' => '',
                'user_occ' => 'occupazione',
                'user_twitter' => '',
                'user_website' => 'sito web',
            ],
        ],

        'signature' => [
            'title' => 'Firma',
            'update' => 'aggiorna',
        ],
    ],

    'notifications' => [
        'title' => 'Notifiche',
        'topic_auto_subscribe' => 'attiva automaticamente le notifiche sui nuovi topic del forum che crei',
        'beatmapset_discussion_qualified_problem' => 'ricevi notifiche per nuovi problemi sulle beatmap qualificate per le seguenti modalità',

        'mail' => [
            '_' => 'ricevi notifiche via mail per',
            'beatmapset:modding' => 'modding delle beatmap',
            'forum_topic_reply' => 'risposte ai topic',
        ],
    ],

    'oauth' => [
        'authorized_clients' => 'client autorizzati',
        'own_clients' => 'client personali',
        'title' => 'OAuth',
    ],

    'playstyles' => [
        'keyboard' => 'tastiera',
        'mouse' => 'mouse',
        'tablet' => 'tavoletta grafica',
        'title' => 'Stili di gioco',
        'touch' => 'schermo touch',
    ],

    'privacy' => [
        'friends_only' => 'blocca messaggi privati da chi non è nella tua lista amici',
        'hide_online' => 'nascondi il tuo stato online',
        'title' => 'Privacy',
    ],

    'security' => [
        'current_session' => 'questo dispositivo',
        'end_session' => 'Termina Sessione',
        'end_session_confirmation' => 'Questo terminerà la sessione sul dispositivo selezionato. Vuoi continuare?',
        'last_active' => 'Ultima attività:',
        'title' => 'Sicurezza',
        'web_sessions' => 'sessioni web',
    ],

    'update_email' => [
        'update' => 'aggiorna',
    ],

    'update_password' => [
        'update' => 'aggiorna',
    ],

    'verification_completed' => [
        'text' => 'Ora puoi chiudere questa scheda/finestra',
        'title' => 'La verifica è stata completata',
    ],

    'verification_invalid' => [
        'title' => 'Link di verifica non valido o scaduto',
    ],
];
