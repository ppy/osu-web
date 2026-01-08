<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'edit' => [
        'title_compact' => 'impostazioni',
        'username' => 'nome utente',

        'avatar' => [
            'title' => 'Avatar',
            'reset' => 'resetta',
            'rules' => 'Assicurati che la tua immagine di profilo aderisca alle :link.<br/>Questo significa che dev\'essere <strong>adatta a tutte le età</strong> (quindi niente nudità, profanità o contenuti provocanti).',
            'rules_link' => 'considerazioni sui contenuti visivi',
        ],

        'email' => [
            'new' => 'nuova email',
            'new_confirmation' => 'conferma email',
            'title' => 'Email',
            'locked' => [
                '_' => 'Per favore contatta il :accounts se devi aggiornare il tuo indirizzo email.',
                'accounts' => 'team di supporto account',
            ],
        ],

        'legacy_api' => [
            'api' => 'api',
            'irc' => 'irc',
            'title' => 'API Legacy',
        ],

        'password' => [
            'current' => 'password attuale',
            'new' => 'nuova password',
            'new_confirmation' => 'conferma password',
            'title' => 'Password',
        ],

        'profile' => [
            'country' => 'paese',
            'title' => 'Profilo',

            'country_change' => [
                '_' => "Sembra che il paese del tuo account non corrisponda al tuo paese di residenza. :update_link.",
                'update_link' => 'Aggiorna a :country',
            ],

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

    'github_user' => [
        'info' => "Se contribuisci nei repository open-source di osu!, puoi collegare qui il tuo account GitHub per associare le tue modifiche nel changelog al tuo profilo osu!. Gli account di GitHub che non hanno ancora contribuito con osu! non possono essere collegati.",
        'link' => 'Collega account GitHub',
        'title' => 'GitHub',
        'unlink' => 'Scollega account GitHub',

        'error' => [
            'already_linked' => 'Questo account GitHub è già associato a un altro utente.',
            'no_contribution' => 'Non puoi collegare un account GitHub senza aver contribuito nei repository di osu!.',
            'unverified_email' => 'Verifica la tua email principale su GitHub, poi riprova a collegare il tuo account.',
        ],
    ],

    'notifications' => [
        'beatmapset_discussion_qualified_problem' => 'ricevi notifiche per nuovi problemi sulle beatmap qualificate delle seguenti modalità',
        'beatmapset_disqualify' => 'ricevi notifiche quando le beatmap delle seguenti modalità vengono squalificate',
        'comment_reply' => 'ricevi notifiche per le risposte ai tuoi commenti',
        'news_post' => 'ricevi notifiche dei post di nuove notizie',
        'title' => 'Notifiche',
        'topic_auto_subscribe' => 'attiva automaticamente le notifiche sui nuovi topic che crei nel forum',

        'options' => [
            '_' => 'opzioni di notifica',
            'beatmap_owner_change' => 'difficoltà ospite',
            'beatmapset:modding' => 'modding delle beatmap',
            'channel_message' => 'messaggi privati',
            'channel_team' => 'messaggi chat di squadra',
            'comment_new' => 'nuovi commenti',
            'forum_topic_reply' => 'risposta al topic',
            'mail' => 'mail',
            'mapping' => 'mapper di beatmap',
            'news_post' => 'nuove notizie',
            'push' => 'push',
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
        'hide_online_info' => 'su osu!lazer, funziona come l\'opzione "Mostrati offline"',
        'title' => 'Privacy',
    ],

    'security' => [
        'current_session' => 'questo dispositivo',
        'end_session' => 'Termina sessione',
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

    'user_totp' => [
        'title' => 'Autenticatore',
        'usage_note' => 'Utilizza un\'app di autenticazione invece dell\'email per verificare l\'accesso. La verifica con email rimarrà comunque come opzione di riserva.',

        'button' => [
            'remove' => 'Rimuovi',
            'setup' => 'Inserisci app di autenticazione',
        ],
        'status' => [
            'label' => 'stato',
            'not_set' => 'Non configurato',
            'set' => 'Configurato',
        ],
    ],

    'verification_completed' => [
        'text' => 'Ora puoi chiudere questa scheda/finestra',
        'title' => 'La verifica è stata completata',
    ],

    'verification_invalid' => [
        'title' => 'Link di verifica non valido o scaduto',
    ],
];
