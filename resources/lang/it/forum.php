<?php

/**
 *    Copyright 2015-2017 ppy Pty. Ltd.
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
    'pinned_topics' => 'Topic Fissati',
    'subforums' => 'Subforum',
    'title' => 'comunità osu!',

    'covers' => [
        'create' => [
            '_' => 'Imposta immagine di copertina',
            'button' => 'Carica immagine',
            'info' => 'L\'immagine di copertina dovrebbe essere :dimensions. Puoi anche trascinare la tua immagine qui per caricarla.',
        ],

        'destroy' => [
            '_' => 'Rimuovi immagine di copertina',
            'confirm' => 'Sei sicuro di voler togliere l\'immagine di copertina?',
        ],
    ],

    'email' => [
        'new_reply' => '[osu!] Nuova risposta dal topic ":title"',
    ],

    'forums' => [
        'topics' => [
            'empty' => 'Nessun topic!',
        ],
    ],

    'post' => [
        'confirm_delete' => 'Vuoi veramente eliminare il post?',
        'edited' => 'Ultima modifica di :user di :when, modificato :count volte in totale.',
        'posted_at' => 'postato :when',

        'actions' => [
            'delete' => 'Elimina post',
            'edit' => 'Modifica post',
        ],
    ],

    'search' => [
        'go_to_post' => 'Vai al post',
        'post_number_input' => 'inserisci numero post',
        'total_posts' => ':posts_count post in totale',
    ],

    'topic' => [
        'go_to_latest' => 'guarda gli ultimi post',
        'latest_post' => ':when da :user',
        'latest_reply_by' => 'ultima risposta di :user',
        'new_topic' => 'Scrivi nuovo topic',
        'post_reply' => 'Invia',
        'reply_box_placeholder' => 'Scrivi qui per rispondere',
        'started_by' => 'da :user',

        'create' => [
            'preview' => 'Anteprima',
            'submit' => 'Invia',

            'placeholder' => [
                'body' => 'Scrivi il contenuto del post qui',
                'title' => 'Clicca qui per impostare il titolo',
            ],
        ],

        'jump' => [
            'enter' => 'clicca per inserire un numero del post specifico',
            'first' => 'vai al primo post',
            'last' => 'vai all\'ultimo post',
            'next' => 'salta i prossimi 10 post',
            'previous' => 'vai indietro di 10 post',
        ],

        'post_edit' => [
            'cancel' => 'Cancella',
            'post' => 'Salva',

            'zoom' => [
                'start' => 'Schermo intero',
                'end' => 'Esci da Schermo Intero',
            ],
        ],
    ],

    'topic_watches' => [
        'index' => [
            'title' => 'Iscrizioni ai Topic',
            'title_compact' => 'iscrizioni',

            'box' => [
                'total' => 'Topic a cui sei iscritto',
                'unread' => 'Topic con nuove risposte',
            ],

            'info' => [
                'total' => 'Sei iscritto a :total topic.',
                'unread' => 'Hai :unread risposte non lette nei topic a cui sei iscritto.',
            ],
        ],

        'topic_buttons' => [
            'remove' => [
                'confirmation' => 'Anullare l\'iscrizione dal topic?',
                'title' => 'Disiscriviti',
            ],
        ],
    ],

    'topics' => [
        '_' => 'Topic',

        'actions' => [
            'reply_with_quote' => 'Quota il post per rispondere',
        ],

        'create' => [
            'create_poll' => 'Creazione Sondaggio',

            'create_poll_button' => [
                'add' => 'Crea un sondaggio',
                'remove' => 'Cancella la creazione del sondaggio',
            ],

            'poll' => [
                'length' => 'Durata del sondaggio:',
                'length_days_prefix' => '',
                'length_days_suffix' => 'giorni',
                'length_info' => 'Lascia vuoto per un sondaggio senza fine',
                'max_options' => 'Opzioni per Utente',
                'max_options_info' => 'Questo è il numero di opzioni che ogni utente può selezionare quando vota.',
                'options' => 'Opzioni',
                'options_info' => 'Posiziona ogni opzione su una nuova linea. Puoi inserire fino a 10 opzioni.',
                'title' => 'Domanda',
                'vote_change' => 'Consenti il ri-votaggio.',
                'vote_change_info' => 'Se consentito, gli utenti possono cambiare il loro voto.',
            ],
        ],

        'index' => [
            'views' => 'visualizzazioni',
            'replies' => 'risposte',
        ],

        'lock' => [
            'is_locked' => 'Questo topic è bloccato e non può essere risposto',
            'lock-0' => 'Sblocca topic',
            'lock-1' => 'Blocca topic',
            'state-0' => 'Il topic è stato sbloccato',
            'state-1' => 'Il topic è stato bloccato',
        ],

        'moderate_move' => [
            'title' => 'Muovi in un altro forum',
        ],

        'moderate_pin' => [
            'pin-0' => 'Togli dai topic fissati',
            'pin-1' => 'Fissa topic',
            'state-0' => 'Il topic è stato tolto dai topic fissati',
            'state-1' => 'Il topic è stato fissato',
        ],

        'show' => [
            'feature_vote' => [
                'current' => 'Priorità Attuale: +:count',
                'do' => 'Promuovi questa richiesta',

                'user' => [
                    'count' => '{0} nessun voto|{1} :count voto|[2,*] :count voti',
                    'current' => 'Hai :votes rimanenti.',
                    'not_enough' => 'Non hai altri voti rimanenti',
                ],
            ],

            'poll' => [
                'vote' => 'Vota',

                'detail' => [
                    'end_time' => 'Il sondaggio scade tra :time',
                    'ended' => 'Il sondaggio è finito :time',
                    'total' => 'Voti totali: :count',
                ],
            ],
        ],

        'watch' => [
            'state-0' => 'Disiscritto dal topic',
            'state-1' => 'Iscritto al topic',
            'watch-0' => 'Disiscriviti dal topic',
            'watch-1' => 'Iscriviti al topic',
        ],
    ],
];
