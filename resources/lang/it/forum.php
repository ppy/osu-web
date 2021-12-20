<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'pinned_topics' => 'Topic Fissati',
    'slogan' => "è pericoloso giocare da soli.",
    'subforums' => 'Subforum',
    'title' => 'forum osu!',

    'covers' => [
        'edit' => 'Modifica la copertina',

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

    'forums' => [
        'latest_post' => 'Post più recente',

        'index' => [
            'title' => 'Indice Forum',
        ],

        'topics' => [
            'empty' => 'Nessun topic!',
        ],
    ],

    'mark_as_read' => [
        'forum' => 'Segna il forum come già letto',
        'forums' => 'Segna i forum come già letti',
        'busy' => 'Segnando come già letto...',
    ],

    'post' => [
        'confirm_destroy' => 'Vuoi veramente eliminare il post?',
        'confirm_restore' => 'Vuoi veramente ripristinare il post?',
        'edited' => 'Ultima modifica di :user :when, modificato :count_delimited volta in totale.|Ultima modifica di :user :when, modificato :count_delimited volte in totale.',
        'posted_at' => 'postato :when',
        'posted_by' => 'postato da :username',

        'actions' => [
            'destroy' => 'Elimina post',
            'edit' => 'Modifica post',
            'report' => 'Segnala post',
            'restore' => 'Ripristina post',
        ],

        'create' => [
            'title' => [
                'reply' => 'Nuova risposta',
            ],
        ],

        'info' => [
            'post_count' => ':count_delimited post|:count_delimited post',
            'topic_starter' => 'Creatore del topic',
        ],
    ],

    'search' => [
        'go_to_post' => 'Vai al post',
        'post_number_input' => 'inserisci numero post',
        'total_posts' => ':posts_count post totali',
    ],

    'topic' => [
        'confirm_destroy' => 'Vuoi veramente eliminare il topic?',
        'confirm_restore' => 'Vuoi veramente ripristinare il topic?',
        'deleted' => 'discussione eliminata',
        'go_to_latest' => 'guarda l\'ultimo post',
        'has_replied' => 'Hai risposto a questo topic',
        'in_forum' => 'in :forum',
        'latest_post' => ':when da :user',
        'latest_reply_by' => 'ultima risposta di :user',
        'new_topic' => 'Nuovo topic',
        'new_topic_login' => 'Effettua l\'accesso per postare un nuovo topic',
        'post_reply' => 'Posta',
        'reply_box_placeholder' => 'Scrivi qui per rispondere',
        'reply_title_prefix' => 'Re',
        'started_by' => 'di :user',
        'started_by_verbose' => 'postato da :user',

        'actions' => [
            'destroy' => 'Elimina topic',
            'restore' => 'Ripristina topic',
        ],

        'create' => [
            'close' => 'Chiudi',
            'preview' => 'Anteprima',
            // TL note: this is used in the topic reply preview, when
            // the user goes back from previewing to editing the reply
            'preview_hide' => 'Scrivi',
            'submit' => 'Posta',

            'necropost' => [
                'default' => 'Questa discussione è inattiva da un bel po\' di tempo. Posta solo se hai una motivazione in particolare.',

                'new_topic' => [
                    '_' => "Questa discussione è inattiva da un bel po' di tempo. Se non hai un motivo in particolare per postare qui, per favore :create.",
                    'create' => 'crea una nuova discussione',
                ],
            ],

            'placeholder' => [
                'body' => 'Scrivi il contenuto del post qui',
                'title' => 'Clicca qui per impostare il titolo',
            ],
        ],

        'jump' => [
            'enter' => 'clicca per inserire un numero specifico del post',
            'first' => 'vai al primo post',
            'last' => 'vai all\'ultimo post',
            'next' => 'salta i prossimi 10 post',
            'previous' => 'vai indietro di 10 post',
        ],

        'logs' => [
            '_' => '',
            'button' => '',

            'columns' => [
                'action' => '',
                'date' => '',
                'user' => '',
            ],

            'data' => [
                'add_tag' => '',
                'announcement' => '',
                'edit_topic' => '',
                'fork' => 'da :topic',
                'pin' => 'argomento fissato',
                'post_operation' => 'postato da :username',
                'remove_tag' => 'rimosso il tag ":tag"',
                'source_forum_operation' => '',
                'unpin' => '',
            ],

            'no_results' => '',

            'operations' => [
                'delete_post' => '',
                'delete_topic' => '',
                'edit_topic' => 'Titolo dell\'argomento modificato',
                'edit_poll' => '',
                'fork' => 'Argomento copiato',
                'issue_tag' => '',
                'lock' => '',
                'merge' => '',
                'move' => 'Argomento spostato',
                'pin' => 'Argomento fissato ',
                'post_edited' => 'Post modificato',
                'restore_post' => 'Post ripristinato',
                'restore_topic' => 'Argomento ripristinato',
                'split_destination' => '',
                'split_source' => '',
                'topic_type' => '',
                'topic_type_changed' => '',
                'unlock' => 'Argomento sbloccato',
                'unpin' => 'Argomento fissato rimosso',
                'user_lock' => 'Argomento personale chiuso',
                'user_unlock' => '',
            ],
        ],

        'post_edit' => [
            'cancel' => 'Cancella',
            'post' => 'Salva',
        ],
    ],

    'topic_watches' => [
        'index' => [
            'title_compact' => 'topic del forum seguiti',

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
                'confirmation' => 'Annullare l\'iscrizione dal topic?',
                'title' => 'Annulla iscrizione',
            ],
        ],
    ],

    'topics' => [
        '_' => 'Topic',

        'actions' => [
            'login_reply' => 'Accedi per rispondere',
            'reply' => 'Rispondi',
            'reply_with_quote' => 'Quota il post per rispondere',
            'search' => 'Cerca',
        ],

        'create' => [
            'create_poll' => 'Creazione Sondaggio',

            'preview' => 'Anteprima Post',

            'create_poll_button' => [
                'add' => 'Crea un sondaggio',
                'remove' => 'Cancella la creazione del sondaggio',
            ],

            'poll' => [
                'hide_results' => 'Nascondi i risultati del sondaggio.',
                'hide_results_info' => 'Saranno mostrati solo dopo la conclusione del sondaggio.',
                'length' => 'Esegui sondaggio per',
                'length_days_suffix' => 'giorni',
                'length_info' => 'Lascia vuoto per un sondaggio senza fine',
                'max_options' => 'Opzioni per utente',
                'max_options_info' => 'Questo è il numero di opzioni che ogni utente può selezionare quando vota.',
                'options' => 'Opzioni',
                'options_info' => 'Posiziona ogni opzione su una nuova linea. Puoi inserire fino a 10 opzioni.',
                'title' => 'Domanda',
                'vote_change' => 'Consenti di rivotare.',
                'vote_change_info' => 'Se abilitato, gli utenti possono cambiare il loro voto.',
            ],
        ],

        'edit_title' => [
            'start' => 'Modifica titolo',
        ],

        'index' => [
            'feature_votes' => 'priorità stella',
            'replies' => 'risposte',
            'views' => 'visualizzazioni',
        ],

        'issue_tag_added' => [
            'to_0' => 'Rimuovi tag "aggiunto"',
            'to_0_done' => 'Rimosso tag "aggiunto"',
            'to_1' => 'Aggiungi tag "aggiunto"',
            'to_1_done' => 'Aggiunto tag "aggiunto"',
        ],

        'issue_tag_assigned' => [
            'to_0' => 'Rimuovi tag "assegnato"',
            'to_0_done' => 'Rimosso tag "assegnato"',
            'to_1' => 'Aggiungi tag "assegnato"',
            'to_1_done' => 'Aggiunto tag "assegnato"',
        ],

        'issue_tag_confirmed' => [
            'to_0' => 'Rimuovi tag "confermato"',
            'to_0_done' => 'Rimosso tag "confermato"',
            'to_1' => 'Aggiungi tag "confermato"',
            'to_1_done' => 'Aggiunto tag "confermato"',
        ],

        'issue_tag_duplicate' => [
            'to_0' => 'Rimuovi tag "duplicato"',
            'to_0_done' => 'Rimosso tag "duplicato"',
            'to_1' => 'Aggiungi tag "duplicato"',
            'to_1_done' => 'Aggiunto tag "duplicato"',
        ],

        'issue_tag_invalid' => [
            'to_0' => 'Rimuovi tag "invalido"',
            'to_0_done' => 'Rimosso tag "invalido"',
            'to_1' => 'Aggiungi tag "invalido"',
            'to_1_done' => 'Aggiunto tag "invalido"',
        ],

        'issue_tag_resolved' => [
            'to_0' => 'Rimuovi tag "risolto"',
            'to_0_done' => 'Rimosso tag "risolto"',
            'to_1' => 'Aggiungi tag "risolto"',
            'to_1_done' => 'Aggiunto tag "risolto"',
        ],

        'lock' => [
            'is_locked' => 'Questo topic è bloccato e non si può più rispondere',
            'to_0' => 'Sblocca topic',
            'to_0_confirm' => 'Sbloccare il topic?',
            'to_0_done' => 'Il topic è stato sbloccato',
            'to_1' => 'Blocca topic',
            'to_1_confirm' => 'Bloccare il topic?',
            'to_1_done' => 'Il topic è stato bloccato',
        ],

        'moderate_move' => [
            'title' => 'Muovi in un altro forum',
        ],

        'moderate_pin' => [
            'to_0' => 'Togli dai topic fissati',
            'to_0_confirm' => 'Togliere dai topic fissati?',
            'to_0_done' => 'Il topic è stato tolto dai topic fissati',
            'to_1' => 'Fissa topic',
            'to_1_confirm' => 'Fissare il topic?',
            'to_1_done' => 'Il topic è stato fissato',
            'to_2' => 'Fissa il topic e segna come annuncio',
            'to_2_confirm' => 'Fissare il topic e segnarlo come annuncio?',
            'to_2_done' => 'Il topic è stato fissato e segnato come annuncio',
        ],

        'moderate_toggle_deleted' => [
            'show' => 'Mostra post eliminati',
            'hide' => 'Nascondi post eliminati',
        ],

        'show' => [
            'deleted-posts' => 'Post cancellati',
            'total_posts' => 'Post totali',

            'feature_vote' => [
                'current' => 'Priorità Attuale: +:count',
                'do' => 'Promuovi questa richiesta',

                'info' => [
                    '_' => 'Questa è una :feature_request. Le richieste di nuove funzionalità possono essere votate dai :supporters.',
                    'feature_request' => 'funzionalità proposta',
                    'supporters' => 'supporter',
                ],

                'user' => [
                    'count' => '{0} nessun voto|{1} :count_delimited voto|[2,*] :count_delimited voti',
                    'current' => 'Hai :votes rimanenti.',
                    'not_enough' => "Non hai altri voti rimanenti",
                ],
            ],

            'poll' => [
                'edit' => 'Modifica Sondaggio',
                'edit_warning' => 'Modificare un sondaggio rimuoverà i risultati attuali!',
                'vote' => 'Vota',

                'button' => [
                    'change_vote' => 'Cambia voto',
                    'edit' => 'Modifica il sondaggio',
                    'view_results' => 'Salta ai risultati',
                    'vote' => 'Vota',
                ],

                'detail' => [
                    'end_time' => 'Il sondaggio scade tra :time',
                    'ended' => 'Il sondaggio è finito :time',
                    'results_hidden' => 'I risultati saranno mostrati dopo il termine della votazione.',
                    'total' => 'Voti totali: :count',
                ],
            ],
        ],

        'watch' => [
            'to_not_watching' => 'Non preferito',
            'to_watching' => 'Preferito',
            'to_watching_mail' => 'Preferito con notifica',
            'tooltip_mail_disable' => 'Notifica abilitata. Clicca per disattivarla',
            'tooltip_mail_enable' => 'Notifica disabilitata. Clicca per attivarla',
        ],
    ],
];
