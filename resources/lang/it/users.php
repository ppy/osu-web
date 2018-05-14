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
    'deleted' => '[deleted user]',

    'beatmapset_activities' => [
        'title' => ":user's Modding History",

        'discussions' => [
            'title_recent' => 'Recently started discussions',
        ],

        'events' => [
            'title_recent' => 'Recent events',
        ],

        'posts' => [
            'title_recent' => 'Recent posts',
        ],

        'votes_received' => [
            'title_most' => 'Most upvoted by (last 3 months)',
        ],

        'votes_made' => [
            'title_most' => 'Most upvoted (last 3 months)',
        ],
    ],

    'card' => [
        'loading' => 'Loading...',
        'send_message' => 'send message',
    ],

    'login' => [
        '_' => 'Accedi',
        'locked_ip' => 'your IP address is locked. Please wait a few minutes.',
        'username' => 'Nome Utente',
        'password' => 'Password',
        'button' => 'Accedi',
        'button_posting' => 'Signing in...',
        'remember' => 'Ricorda questo computer',
        'title' => 'Per favore accedi per procedere',
        'failed' => 'Login non corretto',
        'register' => "Non hai un account di osu! ? Fanne uno nuovo",
        'forgot' => 'Hai dimenticato la tua password?',
        'beta' => [
            'main' => 'L\'accesso alla beta è momentaneamente ristretto agli utenti privilegiati.',
            'small' => '(i supporter lo avranno a breve)',
        ],

        'here' => 'qui', // this is substituted in when generating a link above. change it to suit the language.
    ],

    'posts' => [
        'title' => ':username\'s posts',
    ],

    'signup' => [
        '_' => 'Registrati',
    ],
    'anonymous' => [
        'login_link' => 'clicca per accedere',
        'login_text' => 'sign in',
        'username' => 'Ospite',
        'error' => 'Devi accedere per poterlo fare.',
    ],
    'logout_confirm' => 'Sei sicuro di volerti disconnettere? :(',
    'restricted_banner' => [
        'title' => 'Your account has been restricted!',
        'message' => 'While restricted, you will be unable to interact with other players and your scores will only be visible to you. This is usually the result of an automated process and will usually be lifted within 24 hours. If you wish to appeal your restriction, please <a href="mailto:accounts@ppy.sh">contact support</a>.',
    ],
    'show' => [
        'age' => ':age anni',
        'change_avatar' => 'change your avatar!',
        'first_members' => 'Qui dall\'inizio',
        'is_developer' => 'sviluppatore di osu!',
        'is_supporter' => 'sostenitore di osu!',
        'joined_at' => 'Registrato :date',
        'lastvisit' => 'Ultima volta visto :date',
        'missingtext' => 'Potresti aver fatto un\'errore di battitura! (o l\'utente potrebbe essere stato bannato)',
        'origin_age' => ':age',
        'origin_country_age' => ':age fa da :country',
        'origin_country' => 'da :country',
        'page_description' => 'osu! - Tutto ciò che vuoi sapere su :username!',
        'previous_usernames' => 'formerly known as',
        'plays_with' => 'Plays with :devices',
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
                    'size_info' => 'L\'immaigne di copertina dovrebbe essere 2000x700',
                    'too_large' => 'Il file caricato è troppo grande.',
                    'unsupported_format' => 'Formato non supportato.',
                ],
            ],

            'default_playmode' => [
                'is_default_tooltip' => 'default game mode',
                'set' => 'set :mode as profile default game mode',
            ],
        ],

        'extra' => [
            'followers' => '1 follower|:count followers',
            'unranked' => 'No recent plays',

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
                    'title' => 'Graveyarded Beatmaps (:count)',
                ],
                'ranked_and_approved' => [
                    'title' => 'Beatmap Rankate e Approvate (:count)',
                ],
                'unranked' => [
                    'title' => 'Pending Beatmaps (:count)',
                ],
            ],
            'historical' => [
                'empty' => 'Nessuna registrazione della performance. :(',
                'title' => 'Storico',

                'monthly_playcounts' => [
                    'title' => 'Play History',
                ],
                'most_played' => [
                    'count' => 'volte giocata',
                    'title' => 'Beatmap più Giocate',
                ],
                'recent_plays' => [
                    'accuracy' => 'precisione: :percentage',
                    'title' => 'Partite recenti',
                ],
                'replays_watched_counts' => [
                    'title' => 'Replays Watched History',
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
                            'give' => 'Received :amount from kudosu deny repeal of modding post :post',
                        ],

                        'deny_kudosu' => [
                            'reset' => 'Denied :amount from modding post :post',
                        ],

                        'delete' => [
                            'reset' => 'Lost :amount from modding post deletion of :post',
                        ],

                        'restore' => [
                            'give' => 'Received :amount from modding post restoration of :post',
                        ],

                        'vote' => [
                            'give' => 'Received :amount from obtaining votes in modding post of :post',
                            'reset' => 'Lost :amount from losing votes in modding post of :post',
                        ],

                        'recalculate' => [
                            'give' => 'Received :amount from votes recalculation in modding post of :post',
                            'reset' => 'Lost :amount from votes recalculation in modding post of :post',
                        ],
                    ],

                    'forum_post' => [
                        'give' => 'Ricevuto :amount da :giver per il post in :post',
                        'reset' => 'Kudosu reset by :giver for the post :post',
                        'revoke' => 'Kudosu negato da :giver per il post :post',
                    ],
                ],
            ],
            'me' => [
                'title' => 'io!',
            ],
            'medals' => [
                'empty' => "This user hasn't gotten any yet. ;_;",
                'title' => 'Medaglie',
            ],
            'recent_activity' => [
                'title' => 'Recenti',
            ],
            'top_ranks' => [
                'empty' => 'Ancora nessuna prestazione impressionante. :(',
                'not_ranked' => 'Only ranked beatmaps give out pp.',
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
                'title' => 'Account Standing',
                'bad_standing' => "<strong>:username's</strong> account is not in a good standing :(",
                'remaining_silence' => '<strong>:username</strong> will be able to speak again in :duration.',

                'recent_infringements' => [
                    'title' => 'Recent Infringements',
                    'date' => 'date',
                    'action' => 'action',
                    'length' => 'length',
                    'length_permanent' => 'Permanent',
                    'description' => 'description',
                    'actor' => 'by :username',

                    'actions' => [
                        'restriction' => 'Ban',
                        'silence' => 'Silence',
                        'note' => 'Note',
                    ],
                ],
            ],
        ],
        'info' => [
            'discord' => 'Discord',
            'interests' => 'Interests',
            'lastfm' => 'Last.fm',
            'location' => 'Current Location',
            'occupation' => 'Occupation',
            'skype' => 'Skype',
            'twitter' => 'Twitter',
            'website' => 'Website',
        ],
        'not_found' => [
            'reason_1' => 'They may have changed their username.',
            'reason_2' => 'The account may be temporarily unavailable due to security or abuse issues.',
            'reason_3' => 'You may have made a typo!',
            'reason_header' => 'There are a few possible reasons for this:',
            'title' => 'Utente non trovato! ;_;',
        ],
        'page' => [
            'description' => '<strong>io!</strong> è un\'area personale personalizzabile nella tua pagina del profilo.',
            'edit_big' => 'Modificami!',
            'placeholder' => 'Scrivi il contenuto della pagina qui',
            'restriction_info' => "Devi essere un <a href='".route('store.products.show', 'supporter-tag')."' target='_blank'>osu!supporter</a> per sbloccare questa funzione.",
        ],
        'post_count' => [
            '_' => 'Contributed :link',
            'count' => ':count forum post|:count forum posts',
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
            'play_time' => 'Total Play Time',
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
        'saved' => 'User created',
    ],
    'verify' => [
        'title' => 'Verifica dell\'account',
    ],
];
