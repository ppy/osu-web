<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'edit' => [
        'title_compact' => 'impostazioni',
        'username' => 'nome utente',

        'avatar' => [
            'title' => 'Avatar',
            'rules' => 'Assicurati che la tua immagine di profilo aderisca alle :link.<br/>Questo significa che deve essere <strong>adatta a tutte le età</strong> (ad esempio: niente nudità, profanità o contenuti provocanti).',
            'rules_link' => 'regole della comunità',
        ],

        'email' => [
            'current' => 'email attuale',
            'new' => 'nuova email',
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
        'beatmapset_discussion_qualified_problem' => 'ricevi notifiche per nuovi problemi sulle beatmap qualificate delle seguenti modalità',
        'beatmapset_disqualify' => 'ricevi notifiche quando le beatmap delle seguenti modalità vengono squalificate',
        'comment_reply' => 'ricevi notifiche per le risposte ai tuoi commenti',
        'title' => 'Notifiche',
        'topic_auto_subscribe' => 'attiva automaticamente le notifiche sui nuovi topic che crei nel forum',

        'options' => [
            '_' => 'opzioni di notifica',
            'beatmap_owner_change' => 'guest difficulty',
            'beatmapset:modding' => 'modding delle beatmap',
            'channel_message' => 'messaggi privati',
            'comment_new' => 'nuovi commenti',
            'forum_topic_reply' => 'risposta al topic',
            'mail' => 'mail',
            'mapping' => 'mapper di beatmap',
            'push' => 'push',
            'user_achievement_unlock' => 'medaglie sbloccate',
        ],
    ],

    'oauth' => [
        'authorized_clients' => 'client autorizzati',
        'own_clients' => 'client personali',
        'title' => 'OAuth',
    ],

    'options' => [
        'beatmapset_show_nsfw' => 'nascondi avvisi per i contenuti espliciti nelle beatmap',
        'beatmapset_title_show_original' => 'mostra i metadati della beatmap in lingua originale',
        'title' => 'Opzioni',

        'beatmapset_download' => [
            '_' => 'tipo di download predefinito per le beatmap',
            'all' => 'con video, se disponibile',
            'direct' => 'apri in osu!direct',
            'no_video' => 'senza video',
        ],
    ],

    'playstyles' => [
        'keyboard' => 'tastiera',
        'mouse' => 'mouse',
        'tablet' => 'tavoletta grafica',
        'title' => 'Stili di gioco',
        'touch' => 'touchscreen',
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
