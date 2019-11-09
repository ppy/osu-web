<?php

/**
 *    Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
 *    See the LICENCE file in the repository root for full licence text.
 */

return [
    'deleted' => '[utente eliminato]',

    'beatmapset_activities' => [
        'title' => "Cronologia Modding di :user",
        'title_compact' => 'Modding',

        'discussions' => [
            'title_recent' => 'Discussioni aperte di recente',
        ],

        'events' => [
            'title_recent' => 'Eventi recenti',
        ],

        'posts' => [
            'title_recent' => 'Post recenti',
        ],

        'votes_received' => [
            'title_most' => 'Più votate da (ultimi 3 mesi)',
        ],

        'votes_made' => [
            'title_most' => 'Più votati (ultimi 3 mesi)',
        ],
    ],

    'blocks' => [
        'banner_text' => 'Hai bloccato questo utente.',
        'blocked_count' => 'utenti bloccati (:count)',
        'hide_profile' => 'Nascondi profilo',
        'not_blocked' => 'Questo utente non è bloccato.',
        'show_profile' => 'Visualizza profilo',
        'too_many' => 'Limite blocchi raggiunto.',
        'button' => [
            'block' => 'Blocca',
            'unblock' => 'sblocca',
        ],
    ],

    'card' => [
        'loading' => 'Caricamento...',
        'send_message' => 'Invia messaggio',
    ],

    'login' => [
        '_' => 'Accedi',
        'locked_ip' => 'il tuo indirizzo IP è bloccato. Aspetta qualche minuto per favore.',
        'username' => 'Nome Utente',
        'password' => 'Password',
        'button' => 'Accedi',
        'button_posting' => 'Accesso in corso...',
        'remember' => 'Ricorda questo computer',
        'title' => 'Per favore accedi per procedere',
        'failed' => 'Login non corretto',
        'register' => "Non hai un account di osu!? Fanne uno nuovo",
        'forgot' => 'Hai dimenticato la tua password?',
        'beta' => [
            'main' => 'L\'accesso alla beta è attualmente limitato ad utenti privilegiati.',
            'small' => '(i supporter lo avranno a breve)',
        ],

        'here' => 'qui', // this is substituted in when generating a link above. change it to suit the language.
    ],

    'posts' => [
        'title' => 'Post di :username',
    ],

    'anonymous' => [
        'login_link' => 'clicca per accedere',
        'login_text' => 'registrati',
        'username' => 'Ospite',
        'error' => 'Devi accedere per poterlo fare.',
    ],
    'logout_confirm' => 'Sei sicuro di volerti disconnettere? :(',
    'report' => [
        'button_text' => 'Segnala',
        'comments' => 'Ulteriori Commenti',
        'placeholder' => 'Fornisci qualsiasi informazione che ritieni possa essere utile.',
        'reason' => 'Motivazione',
        'thanks' => 'Grazie per la tua segnalazione!',
        'title' => 'Segnalare :username?',

        'actions' => [
            'send' => 'Invia Segnalazione',
            'cancel' => 'Annulla',
        ],

        'options' => [
            'cheating' => 'Gioco scorretto / Cheating',
            'insults' => 'Insulti a me / altri',
            'spam' => 'Spamming',
            'unwanted_content' => 'Condivisione di contenuti inappropriati',
            'nonsense' => 'Senza senso',
            'other' => 'Altro (scrivi sotto)',
        ],
    ],
    'restricted_banner' => [
        'title' => 'Il tuo account è stato limitato!',
        'message' => 'Quando sei limitato, non sarai in grado di interagire con gli altri giocatori e i tuoi punteggi saranno visibili solo a te. Solitamente questo è il risultato di un processo automatico e verrà risolto preferibilmente entro 24 ore. Se desideri fare appello alla tua restrizione, <a
href="mailto:accounts@ppy.sh">contatta il supporto</a>.',
    ],
    'show' => [
        'age' => ':age anni',
        'change_avatar' => 'cambia il tuo avatar!',
        'first_members' => 'Qui dall\'inizio',
        'is_developer' => 'sviluppatore di osu!',
        'is_supporter' => 'osu!supporter',
        'joined_at' => 'Registrato da :date',
        'lastvisit' => 'Ultimo accesso :date',
        'lastvisit_online' => 'Attualmente online',
        'missingtext' => 'Potresti aver fatto un errore di battitura! (o l\'utente potrebbe essere stato bannato)',
        'origin_country' => 'da :country',
        'page_description' => 'osu! - Tutto ciò che hai mai voluto sapere su :username!',
        'previous_usernames' => 'precedentemente conosciuto come',
        'plays_with' => 'Gioca con :devices',
        'title' => "Profilo di :username",

        'edit' => [
            'cover' => [
                'button' => 'Cambia copertina del profilo',
                'defaults_info' => 'Più opzioni per la copertina saranno disponibili in futuro',
                'upload' => [
                    'broken_file' => 'Elaborazione dell\'immagine non riuscita. Controlla l\'immagine caricata e riprova.',
                    'button' => 'Carica immagine',
                    'dropzone' => 'Trascina qui per caricarla',
                    'dropzone_info' => 'Puoi anche trascinare qui l\'immagine per caricarla',
                    'size_info' => 'L\'immagine di copertina dovrebbe essere 2800x620',
                    'too_large' => 'Il file caricato è troppo grande.',
                    'unsupported_format' => 'Formato non supportato.',

                    'restriction_info' => [
                        '_' => 'Caricamento disponibile solo per gli :link',
                        'link' => 'osu!supporter',
                    ],
                ],
            ],

            'default_playmode' => [
                'is_default_tooltip' => 'modalità predefinita',
                'set' => 'imposta :mode come modalità predefinita',
            ],
        ],

        'extra' => [
            'none' => 'nessuno',
            'unranked' => 'Nessuna partita recente',

            'achievements' => [
                'achieved-on' => 'Ottenuto il :date',
                'locked' => 'Bloccato',
                'title' => 'Obiettivi',
            ],
            'beatmaps' => [
                'by_artist' => 'di :artist',
                'none' => 'Nessuna... per ora.',
                'title' => 'Beatmap',

                'favourite' => [
                    'title' => 'Beatmap Preferite',
                ],
                'graveyard' => [
                    'title' => 'Beatmap Abbandonate',
                ],
                'loved' => [
                    'title' => 'Beatmap Amate',
                ],
                'ranked_and_approved' => [
                    'title' => 'Beatmap Classificate & Approvate',
                ],
                'unranked' => [
                    'title' => 'Beatmap in Attesa',
                ],
            ],
            'discussions' => [
                'title' => 'Discussioni',
                'title_longer' => 'Discussioni Recenti',
                'show_more' => 'guarda più discussioni',
            ],
            'events' => [
                'title' => 'Eventi',
                'title_longer' => 'Eventi Recenti',
                'show_more' => 'guarda più eventi',
            ],
            'historical' => [
                'empty' => 'Nessuna performance recente :(',
                'title' => 'Cronologia',

                'monthly_playcounts' => [
                    'title' => 'Cronologia Partite',
                    'count_label' => 'Giocate',
                ],
                'most_played' => [
                    'count' => 'volte giocata',
                    'title' => 'Beatmap più Giocate',
                ],
                'recent_plays' => [
                    'accuracy' => 'precisione: :percentage',
                    'title' => 'Partite Recenti (nelle ultime 24 ore)',
                ],
                'replays_watched_counts' => [
                    'title' => 'Cronologia Replay Guardati',
                    'count_label' => 'Replay guardati',
                ],
            ],
            'kudosu' => [
                'available' => 'Kudosu Disponibili',
                'available_info' => "I kudosu possono essere scambiati per delle stelle kudosu, che aiuteranno la tua beatmap ad ottenere più attenzione. Questo è il numero di kudosu che non hai ancora scambiato.",
                'recent_entries' => 'Cronologia Kudosu Recenti',
                'title' => 'Kudosu!',
                'total' => 'Totale Kudosu Guadagnati',

                'entry' => [
                    'amount' => ':amount kudosu',
                    'empty' => "Questo utente non ha ricevuto alcun kudosu!",

                    'beatmap_discussion' => [
                        'allow_kudosu' => [
                            'give' => 'Ricevuto :amount dall\'annullamento del rifiuto di kudosu del post di modding :post',
                        ],

                        'deny_kudosu' => [
                            'reset' => 'Negato :amount dal post di modding :post',
                        ],

                        'delete' => [
                            'reset' => 'Perso :amount dalla rimozione del post di modding di :post',
                        ],

                        'restore' => [
                            'give' => 'Ricevuto :amount dal ripristino del post di modding di :post',
                        ],

                        'vote' => [
                            'give' => 'Ricevuto :amount dall\'ottenimento di voti nel post di modding di :post',
                            'reset' => 'Perso :amount dalla perdita di voti nel post di modding di :post',
                        ],

                        'recalculate' => [
                            'give' => 'Ricevuto :amount dal ricalcolo di voti nel post di modding di :post',
                            'reset' => 'Perso :amount dal ricalcolo di voti nel post di modding di :post',
                        ],
                    ],

                    'forum_post' => [
                        'give' => 'Ricevuto :amount da :giver per il post in :post',
                        'reset' => 'Kudosu resettati da :giver per il post :post',
                        'revoke' => 'Kudosu negati da :giver per il post :post',
                    ],
                ],

                'total_info' => [
                    '_' => 'Basato sul contributo che l\'utente ha dato nella moderazione delle beatmap. Visita :link per più informazioni.',
                    'link' => 'questa pagina',
                ],
            ],
            'me' => [
                'title' => 'io!',
            ],
            'medals' => [
                'empty' => "Questo utente non ne ha ricevuti ancora. ;_;",
                'recent' => 'Più recenti',
                'title' => 'Medaglie',
            ],
            'posts' => [
                'title' => 'Post',
                'title_longer' => 'Post Recenti',
                'show_more' => 'guarda più post',
            ],
            'recent_activity' => [
                'title' => 'Recenti',
            ],
            'top_ranks' => [
                'download_replay' => 'Scarica Replay',
                'empty' => 'Ancora nessuna prestazione impressionante. :(',
                'not_ranked' => 'Solo le mappe classificate danno pp.',
                'pp_weight' => 'valutata :percentage',
                'title' => 'Rank',

                'best' => [
                    'title' => 'Migliore Performance',
                ],
                'first' => [
                    'title' => 'Rank Primo Posto',
                ],
            ],
            'votes' => [
                'given' => 'Voti Assegnati (negli ultimi 3 mesi)',
                'received' => 'Voti Ricevuti (negli ultimi 3 mesi)',
                'title' => 'Voti',
                'title_longer' => 'Voti Recenti',
                'vote_count' => ':count_delimited voto|:count_delimited voti',
            ],
            'account_standing' => [
                'title' => 'Stato dell\'account',
                'bad_standing' => "L'account di <strong>:username</strong> non ha una buona reputazione :(",
                'remaining_silence' => '<strong>:username</strong> potrà parlare di nuovo tra :duration.',

                'recent_infringements' => [
                    'title' => 'Infrazioni recenti',
                    'date' => 'data',
                    'action' => 'azione',
                    'length' => 'durata',
                    'length_permanent' => 'Permanente',
                    'description' => 'descrizione',
                    'actor' => 'da :username',

                    'actions' => [
                        'restriction' => 'Ban',
                        'silence' => 'Silenziato',
                        'note' => 'Nota',
                    ],
                ],
            ],
        ],

        'header_title' => [
            '_' => ':info Giocatore',
            'info' => 'Informazioni',
        ],

        'info' => [
            'discord' => '',
            'interests' => 'Interessi',
            'lastfm' => 'Last.fm',
            'location' => 'Posizione Attuale',
            'occupation' => 'Occupazione',
            'skype' => '',
            'twitter' => '',
            'website' => 'Sito',
        ],
        'not_found' => [
            'reason_1' => 'Potrebbero aver cambiato il loro nome utente.',
            'reason_2' => 'L\'account potrebbe essere temporaneamente non disponibile a causa di problemi di sicurezza o abuso.',
            'reason_3' => 'Potresti aver commesso un errore di battitura!',
            'reason_header' => 'Ci sono alcuni possibili motivi per questo:',
            'title' => 'Utente non trovato! ;_;',
        ],
        'page' => [
            'button' => 'Modifica pagina del profilo',
            'description' => '<strong>io!</strong> è un\'area personale personalizzabile nella tua pagina del profilo.',
            'edit_big' => 'Modificami!',
            'placeholder' => 'Scrivi il contenuto della pagina qui',

            'restriction_info' => [
                '_' => 'Devi essere un :link per sbloccare questa funzionalità.',
                'link' => 'osu!supporter',
            ],
        ],
        'post_count' => [
            '_' => 'Ha contribuito :link',
            'count' => ':count forum post |:count forum post',
        ],
        'rank' => [
            'country' => 'Rank del paese per :mode',
            'country_simple' => 'Classifica del Paese',
            'global' => 'Rank globale :mode',
            'global_simple' => 'Classifica globale',
        ],
        'stats' => [
            'hit_accuracy' => 'Precisione dei colpi',
            'level' => 'Livello :level',
            'level_progress' => 'Avanzamento al livello successivo',
            'maximum_combo' => 'Combo Massima',
            'medals' => 'Medaglie',
            'play_count' => 'Partite giocate',
            'play_time' => 'Tempo totale di gioco',
            'ranked_score' => 'Punteggio Rankato',
            'replays_watched_by_others' => 'Replay Guardati da Altri',
            'score_ranks' => 'Rank dei Punteggi',
            'total_hits' => 'Colpi Totali',
            'total_score' => 'Punteggio Totale',
            // modding stats
            'ranked_and_approved_beatmapset_count' => 'Beatmap Classificate & Approvate',
            'loved_beatmapset_count' => 'Beatmap Amate',
            'unranked_beatmapset_count' => 'Beatmap in Attesa',
            'graveyard_beatmapset_count' => 'Beatmap Abbandonate',
        ],
    ],

    'status' => [
        'all' => 'Tutti',
        'online' => 'Online',
        'offline' => 'Offline',
    ],
    'store' => [
        'saved' => 'Utente creato',
    ],
    'verify' => [
        'title' => 'Verifica dell\'account',
    ],

    'view_mode' => [
        'card' => 'Vista a schede',
        'list' => 'Vista ad elenco',
    ],
];
