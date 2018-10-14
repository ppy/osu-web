<?php

/**
 *    Copyright 2015-2018 ppy Pty. Ltd.
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
    'deleted' => '[utente eliminato]',

    'beatmapset_activities' => [
        'title' => "Cronologia di Modding dell'utente",

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
        'hide_profile' => 'nascondi profilo',
        'not_blocked' => 'Questo utente non è bloccato.',
        'show_profile' => 'visualizza profilo',
        'too_many' => 'Limite blocchi raggiunto.',
        'button' => [
            'block' => 'blocca',
            'unblock' => 'sblocca',
        ],
    ],

    'card' => [
        'loading' => 'Caricamento...',
        'send_message' => 'invia messaggio',
    ],

    'login' => [
        '_' => 'Accedi',
        'locked_ip' => 'il tuo indirizzo IP è bloccato. Aspetta qualche minuto per favore.',
        'username' => 'Nome utente',
        'password' => 'Password',
        'button' => 'Accedi',
        'button_posting' => 'Accesso in corso...',
        'remember' => 'Ricorda questo computer',
        'title' => 'Per favore accedi per procedere',
        'failed' => 'Login non corretto',
        'register' => "Non hai un account di osu!? Fanne uno nuovo",
        'forgot' => 'Hai dimenticato la tua password?',
        'beta' => [
            'main' => 'L\'accesso alla beta è momentaneamente ristretto ad utenti privilegiati.',
            'small' => '(i supporter lo avranno a breve)',
        ],

        'here' => 'qui', // this is substituted in when generating a link above. change it to suit the language.
    ],

    'posts' => [
        'title' => ':post dell\'utente',
    ],

    'signup' => [
        '_' => 'Registrati',
    ],
    'anonymous' => [
        'login_link' => 'clicca per accedere',
        'login_text' => 'registrati',
        'username' => 'Ospite',
        'error' => 'Devi accedere per poterlo fare.',
    ],
    'logout_confirm' => 'Sei sicuro di volerti disconnettere? :(',
    'report' => [
        'button_text' => 'segnala',
        'comments' => 'Ulteriori Commenti',
        'placeholder' => 'Si prega di fornire qualsiasi informazione che ritieni possa essere utile.',
        'reason' => 'Motivazione',
        'thanks' => 'Grazie per la tua segnalazione!',
        'title' => 'Segnala :username?',

        'actions' => [
            'send' => 'Invia Segnalazione',
            'cancel' => 'Annulla',
        ],

        'options' => [
            'cheating' => 'Gioco sporco / Cheating',
            'insults' => 'Insultarmi / altro',
            'spam' => 'Spamming',
            'unwanted_content' => 'Condivisione di contenuti inappropiati',
            'nonsense' => 'Senza senso',
            'other' => 'Altro (scrivi sotto)',
        ],
    ],
    'restricted_banner' => [
        'title' => 'Il tuo account è stato ristretto!',
        'message' => 'Quando sei ristretto, non sarai in grado di interagire con gli altri giocatori e i tuoi punteggi saranno visibili solo a te. Questo è solitamente il risultato di un processo automatico e verrà risolto preferibilmente entro 24 ore. Se desideri fare appello alla tua restrizione, si prega di <a
href="mailto:accounts@ppy.sh">contattare il supporto</a>.',
    ],
    'show' => [
        'age' => ':age anni',
        'change_avatar' => 'cambia il tuo avatar!',
        'first_members' => 'Qui dall\'inizio',
        'is_developer' => 'sviluppatore di osu!',
        'is_supporter' => 'sostenitore di osu!',
        'joined_at' => 'Registrato :date',
        'lastvisit' => 'Ultimo visto :date',
        'missingtext' => 'Potresti aver fatto un\'errore di battitura! (o l\'utente potrebbe essere stato bannato)',
        'origin_country' => 'da :country',
        'page_description' => 'osu! - Tutto ciò che hai mai voluto sapere su :username!',
        'previous_usernames' => 'precedentemente conosciuto come',
        'plays_with' => 'Gioca con :devices',
        'title' => "Profilo di :username",

        'edit' => [
            'cover' => [
                'button' => 'Cambia copertina del profilo',
                'defaults_info' => 'Più opzioni per la copertina saranno disponibili nel futuro',
                'upload' => [
                    'broken_file' => 'Elaborazione dell\'immagine non riuscito. Controlla l\'immagine caricata e riprova.',
                    'button' => 'Carica immagine',
                    'dropzone' => 'Trascina qui per caricarla',
                    'dropzone_info' => 'Puoi anche trascinare qui l\'immagine per caricarla',
                    'restriction_info' => "Caricamento disponibile solo per gli <a href='".route('store.products.show', 'supporter-tag')."' target='_blank'>osu!supporter</a>",
                    'size_info' => 'L\'immagine di copertina dovrebbe essere 2000x700',
                    'too_large' => 'Il file caricato è troppo grande.',
                    'unsupported_format' => 'Formato non supportato.',
                ],
            ],

            'default_playmode' => [
                'is_default_tooltip' => 'modalità predefinita',
                'set' => 'imposta :mode come modalità predefinita',
            ],
        ],

        'extra' => [
            'followers' => '1 follower|:count followers',
            'unranked' => 'Nessuna partita recente',

            'achievements' => [
                'title' => 'Obiettivi',
                'achieved-on' => 'Raggiunto il :date',
            ],
            'beatmaps' => [
                'none' => 'Nessuna... per ora.',
                'title' => 'Beatmap',

                'favourite' => [
                    'title' => 'Beatmaps Preferite (:count)',
                ],
                'graveyard' => [
                    'title' => 'Beatmap abbandonate (:count)',
                ],
                'loved' => [
                    'title' => 'Beatmap Amate (:count)',
                ],
                'ranked_and_approved' => [
                    'title' => 'Beatmap Classificate e Approvate (:count)',
                ],
                'unranked' => [
                    'title' => 'Beatmaps In Attesa (:count)',
                ],
            ],
            'historical' => [
                'empty' => 'Nessuna registrazione della performance. :(',
                'title' => 'Cronologia',

                'monthly_playcounts' => [
                    'title' => 'Cronologia Partite',
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
                ],
            ],
            'kudosu' => [
                'available' => 'Kudosu Disponibili',
                'available_info' => "I kudosu possono essere scambiati per delle stelle kudosu, che aiuteranno la tua beatmap ad ottenere più attenzione. Questo è il numero di kudosu che non hai ancora scambiato.",
                'recent_entries' => 'Storico dei recenti kudosu',
                'title' => 'Kudosu!',
                'total' => 'Totale Kudosu Guadagnati',
                'total_info' => 'Basandosi su quando ha contribuito l\'utente alla moderazione delle beatmap. Vedi <a href="'.osu_url('user.kudosu').'">questa pagina</a> per ulteriori informazioni.',

                'entry' => [
                    'amount' => ':amount kudosu',
                    'empty' => "Questo utente non ha ricevuto alcun kudosu!",

                    'beatmap_discussion' => [
                        'allow_kudosu' => [
                            'give' => 'Ricevuto :amount dall\'annullamento del rifiuto di kudosu del modding post :post',
                        ],

                        'deny_kudosu' => [
                            'reset' => 'Negato :amount dal modding post :post',
                        ],

                        'delete' => [
                            'reset' => 'Perso :amount dalla rimozione del modding post :post',
                        ],

                        'restore' => [
                            'give' => 'Ricevuto :amount dal ripristino del modding post :post',
                        ],

                        'vote' => [
                            'give' => 'Ricevuto :amount dall\'ottenimento di voti nel post di modding di :post',
                            'reset' => 'Perso :amount dalla perdita di voti nel posto di modding di :post',
                        ],

                        'recalculate' => [
                            'give' => 'Ricevuto :amount dal ricalcolo di voti nel post di modding di :post',
                            'reset' => 'Perso :amount dal ricalcolo di voti nel post di modding di :post',
                        ],
                    ],

                    'forum_post' => [
                        'give' => 'Ricevuto :amount da :giver per il post in :post',
                        'reset' => 'Kudosu resettato da :giver per il post :post',
                        'revoke' => 'Kudosu negato da :giver per il post :post',
                    ],
                ],
            ],
            'me' => [
                'title' => 'io!',
            ],
            'medals' => [
                'empty' => "Questo utente non ne ha ricevuti ancora. ;_;",
                'title' => 'Medaglie',
            ],
            'recent_activity' => [
                'title' => 'Recenti',
            ],
            'top_ranks' => [
                'empty' => 'Ancora nessuna prestazione impressionante. :(',
                'not_ranked' => 'Solo le mappe classificate danno pp.',
                'pp' => ':amountpp',
                'title' => 'Rank',
                'weighted_pp' => 'valutata: :pp (:percentage)',

                'best' => [
                    'title' => 'Migliore Performance',
                ],
                'first' => [
                    'title' => 'Rank Primo Posto',
                ],
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
            'description' => '<strong>io!</strong> è un\'area personale personalizzabile nella tua pagina del profilo.',
            'edit_big' => 'Modificami!',
            'placeholder' => 'Scrivi il contenuto della pagina qui',
            'restriction_info' => "Devi essere un <a href='".route('store.products.show', 'supporter-tag')."' target='_blank'>osu!supporter</a> per sbloccare questa funzione.",
        ],
        'post_count' => [
            '_' => 'Ha contribuito :link',
            'count' => ':count forum post |:count forum post',
        ],
        'rank' => [
            'country' => 'Rank del paese per :mode',
            'global' => 'Rank globale :mode',
        ],
        'stats' => [
            'hit_accuracy' => 'Precisione dei colpi',
            'level' => 'Livello :level',
            'maximum_combo' => 'Combo Massima',
            'play_count' => 'Partite giocate',
            'play_time' => 'Tempo totale di gioco',
            'ranked_score' => 'Punteggio Rankato',
            'replays_watched_by_others' => 'Replay Guardati da Altri',
            'score_ranks' => 'Rank dei Punteggi',
            'total_hits' => 'Colpi Totali',
            'total_score' => 'Punteggio Totale',
        ],
    ],
    'status' => [
        'online' => 'Online',
        'offline' => 'Offline',
    ],
    'store' => [
        'saved' => 'Utente creato',
    ],
    'verify' => [
        'title' => 'Verifica dell\'account',
    ],
];
