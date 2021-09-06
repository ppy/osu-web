<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

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
            'unblock' => 'Sblocca',
        ],
    ],

    'card' => [
        'loading' => 'Caricamento...',
        'send_message' => 'Invia messaggio',
    ],

    'disabled' => [
        'title' => 'Uh-oh! Sembra che il tuo account sia stato disattivato.',
        'warning' => "Nel caso tu abbia violato una regola, è necessario evidenziare che si tratta di un periodo dalla durata di un mese dove non saranno considerate alcune richieste di scuse. Dopo questo periodo, sarai libero di contattarci se lo ritieni opportuno. La creazione di nuovi account dopo la disattivazione di un altro sarà punita con <strong>l'estensione del periodo di un mese</strong>. È necessario sottolineare che <strong>creando un nuovo account ogni volta, violi ancora di più le regole</strong>. Ti suggeriamo caldamente di non prendere questa strada!",

        'if_mistake' => [
            '_' => 'Se pensi che si tratti di un\'errore, sei libero di contattarci (via :email o cliccando su "?" nell\'angolo in basso a destra di questa pagina). Nota che siamo pienamente fiduciosi delle nostre azioni, siccome si basano su prove consolidate. Ci riserviamo il diritto di rifiutare la tua richiesta se riteniamo che tu sia intenzionalmente disonesto.',
            'email' => 'email',
        ],

        'reasons' => [
            'compromised' => 'Il tuo account sembra essere stato compromesso. Potrebbe essere disattivato temporaneamente mentre la sua identità viene confermata.',
            'opening' => 'Ci sono una serie di motivi che possono causare la disabilitazione del tuo account:',

            'tos' => [
                '_' => 'Hai violato una o più delle nostre :community_rules, oppure uno o più :tos.',
                'community_rules' => 'regole della community',
                'tos' => 'termini di servizio',
            ],
        ],
    ],

    'filtering' => [
        'by_game_mode' => 'Membri per modalità di gioco',
    ],

    'force_reactivation' => [
        'reason' => [
            'inactive_different_country' => "Il tuo account non è stato utilizzato per molto tempo.",
        ],
    ],

    'login' => [
        '_' => 'Accedi',
        'button' => 'Accedi',
        'button_posting' => 'Accesso in corso...',
        'email_login_disabled' => 'L\'accesso con email è attualmente disabilitato. Utilizza il nome utente.',
        'failed' => 'Login non corretto',
        'forgot' => 'Hai dimenticato la tua password?',
        'info' => 'Accedi per continuare',
        'invalid_captcha' => 'Troppi tentativi di accesso falliti, completa il captcha e riprova. (Ricarica la pagina se il captcha non è visibile)',
        'locked_ip' => 'il tuo indirizzo IP è bloccato. Aspetta qualche minuto per favore.',
        'password' => 'Password',
        'register' => "Non hai un account di osu!? Fanne uno nuovo",
        'remember' => 'Ricorda questo computer',
        'title' => 'Per favore accedi per procedere',
        'username' => 'Nome Utente',

        'beta' => [
            'main' => 'L\'accesso alla beta è attualmente limitato ad utenti privilegiati.',
            'small' => '(gli osu!supporter lo avranno a breve)',
        ],
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
            'multiple_accounts' => 'Uso di account multipli',
            'insults' => 'Insulti a me / altri',
            'spam' => 'Spamming',
            'unwanted_content' => 'Condivisione di contenuti inappropriati',
            'nonsense' => 'Senza senso',
            'other' => 'Altro (scrivi sotto)',
        ],
    ],
    'restricted_banner' => [
        'title' => 'Il tuo account è stato limitato!',
        'message' => 'Quando sei limitato, non sarai in grado di interagire con gli altri giocatori e i tuoi punteggi saranno visibili solo a te. Solitamente questo è il risultato di un processo automatico e verrà risolto solitamente entro 24 ore. Se desideri fare appello contro la tua restrizione, <a href="mailto:accounts@ppy.sh">contatta il supporto</a>.',
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
        'previous_usernames' => 'conosciuto in precedenza come',
        'plays_with' => 'Gioca con :devices',
        'title' => "Profilo di :username",

        'comments_count' => [
            '_' => 'Ha postato :link',
            'count' => ':count_delimited commento|:count_delimited commenti',
        ],
        'edit' => [
            'cover' => [
                'button' => 'Cambia copertina del profilo',
                'defaults_info' => 'Più opzioni per la copertina saranno disponibili in futuro',
                'upload' => [
                    'broken_file' => 'Elaborazione dell\'immagine non riuscita. Controlla l\'immagine caricata e riprova.',
                    'button' => 'Carica immagine',
                    'dropzone' => 'Trascina qui per caricarla',
                    'dropzone_info' => 'Puoi anche trascinare qui l\'immagine per caricarla',
                    'size_info' => 'L\'immagine di copertina dovrebbe essere 2400x640',
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
                'pending' => [
                    'title' => 'Beatmap In Attesa',
                ],
                'ranked' => [
                    'title' => 'Beatmap Classificate',
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
                'title' => 'Cronologia',

                'monthly_playcounts' => [
                    'title' => 'Cronologia Partite',
                    'count_label' => 'Giocate',
                ],
                'most_played' => [
                    'count' => 'volte giocata',
                    'title' => 'Beatmap Più Giocate',
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
            'multiplayer' => [
                'title' => 'Partite Multigiocatore',
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
                'not_ranked' => 'Solo le mappe classificate danno pp.',
                'pp_weight' => 'valutata :percentage',
                'view_details' => 'Visualizza Dettagli',
                'title' => 'Rank',

                'best' => [
                    'title' => 'Migliore Performance',
                ],
                'first' => [
                    'title' => 'Primi Posti',
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

        'info' => [
            'discord' => '',
            'interests' => 'Interessi',
            'location' => 'Posizione Attuale',
            'occupation' => 'Occupazione',
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
            '_' => 'Ha contribuito con :link',
            'count' => ':count_delimited post nel forum|:count_delimited post nel forum',
        ],
        'rank' => [
            'country' => 'Rank del paese per :mode',
            'country_simple' => 'Classifica Nazionale',
            'global' => 'Posto globale per :mode',
            'global_simple' => 'Classifica Globale',
        ],
        'stats' => [
            'hit_accuracy' => 'Precisione dei Colpi',
            'level' => 'Livello :level',
            'level_progress' => 'Avanzamento al livello successivo',
            'maximum_combo' => 'Combo Massima',
            'medals' => 'Medaglie',
            'play_count' => 'Partite Giocate',
            'play_time' => 'Tempo totale di gioco',
            'ranked_score' => 'Punteggio Classificato',
            'replays_watched_by_others' => 'Replay Guardati da Altri',
            'score_ranks' => 'Rank dei Punteggi',
            'total_hits' => 'Colpi Totali',
            'total_score' => 'Punteggio Totale',
            // modding stats
            'graveyard_beatmapset_count' => 'Beatmap Abbandonate',
            'loved_beatmapset_count' => 'Beatmap Amate',
            'pending_beatmapset_count' => 'Beatmap In Attesa',
            'ranked_beatmapset_count' => 'Beatmap Classificate',
        ],
    ],

    'silenced_banner' => [
        'title' => 'Sei attualmente silenziato.',
        'message' => 'Alcune funzioni non saranno disponibili.',
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
        'brick' => 'Vista a blocchi',
        'card' => 'Vista a schede',
        'list' => 'Vista a elenco',
    ],
];
