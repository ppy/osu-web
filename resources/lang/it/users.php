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
    'login' => [
        '_' => 'Accedi',
        'username' => 'Nome Utente',
        'password' => 'Password',
        'button' => 'Accedi',
        'remember' => 'Ricorda questo computer',
        'title' => 'Per favore accedi per procedere',
        'failed' => 'Login non corretto',
        'register' => 'Non hai un account di osu! ? Fanne uno nuovo',
        'forgot' => 'Hai dimenticato la tua password?',
        'beta' => [
            'main' => 'L\'accesso alla beta è momentaneamente ristretto agli utenti privilegiati.',
            'small' => '(i supporter lo avranno a breve)',
        ],

        'here' => 'qui', // this is substituted in when generating a link above. change it to suit the language.
    ],
    'signup' => [
        '_' => 'Registrati',
    ],
    'anonymous' => [
        'login_link' => 'clicca per accedere',
        'username' => 'Ospite',
        'error' => 'Devi accedere per poterlo fare.',
    ],
    'logout_confirm' => 'Sei sicuro di volerti disconnettere? :(',
    'show' => [
        '404' => 'Utente non trovato! ;_;',
        'age' => ':age anni',
        'first_members' => "Qui dall'inizio",
        'is_developer' => 'sviluppatore di osu!',
        'is_supporter' => 'sostenitore di osu!',
        'joined_at' => 'Registrato :date',
        'lastvisit' => 'Ultima volta visto :date',
        'missingtext' => 'Potresti aver fatto un\'errore di battitura! (o l\'utente potrebbe essere stato bannato)',
        'origin_age' => ':age',
        'origin_country' => 'da :country', // It changes from county to country "Dall'italia", "Dalla Spagna" ecc...
        'origin_country_age' => ':age fa da :country',
        'page_description' => 'osu! - Tutto ciò che vuoi sapere su :username!',
        'title' => 'Profilo di :username',

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
        ],
        'extra' => [
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
                'ranked_and_approved' => [
                    'title' => 'Beatmap Rankate e Approvate (:count)',
                ],
            ],
            'historical' => [
                'empty' => 'Nessuna registrazione della performance. :(', // record as "registrazione", like "we have no performance data to show you"
                'title' => 'Storico',

                'most_played' => [
                    'count' => 'volte giocata',
                    'title' => 'Beatmap più Giocate',
                ],
                'recent_plays' => [
                    'accuracy' => 'precisione: :percentage',
                    'title' => 'Partite recenti',
                ],
            ],
            'kudosu' => [
                'available' => 'Kudosu Disponibili',
                'available_info' => 'I kudosu possono essere scambiati per delle stelle kudosu, che aiuteranno la tua beatmap ad ottenere più attenzione. Questo è il numero di kudosu che non hai ancora scambiato.',
                'recent_entries' => 'Storico dei recenti kudosu',
                'title' => 'Kudosu!',
                'total' => 'Totale Kudosu Guadagnati',
                'total_info' => 'Basandosi su quando ha contribuito l\'utente alla moderazione delle beatmap. Vedi <a href="'.osu_url('user.kudosu').'">questa pagina</a> per ulteriori informazioni.',

                'entry' => [
                    'amount' => ':amount kudosu',
                    'empty' => 'Questo utente non ha ricevuto alcun kudosu!',

                    'forum_post' => [
                        'give' => 'Ricevuto :amount da :giver per il post in :post',
                        'revoke' => 'Kudosu negato da :giver per il post :post',
                    ],
                ],
            ],
            'me' => [
                'title' => 'io!',
            ],
            'medals' => [
                'title' => 'Medaglie',
            ],
            'recent_activity' => [
                'title' => 'Recenti',
            ],
            'top_ranks' => [
                'best' => [
                    'title' => 'Migliore Performance',
                ],
                'empty' => 'Ancora nessuna prestazione impressionante. :(',
                'first' => [
                    'title' => 'Rank Primo Posto',
                ],
                'pp' => ':amountpp',
                'title' => 'Rank',
                'weighted_pp' => 'valutata: :pp (:percentage)', // "ponderata" - "pesata" - "valutata", i think "valutata" as "evalutated" is better
            ],
        ],
        'page' => [
            'description' => '<strong>io!</strong> è un\'area personale personalizzabile nella tua pagina del profilo.',
            'edit_big' => 'Modificami!',
            'placeholder' => 'Scrivi il contenuto della pagina qui',
            'restriction_info' => "Devi essere un <a href='".route('store.products.show', 'supporter-tag')."' target='_blank'>osu!supporter</a> per sbloccare questa funzione.",
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
            'ranked_score' => 'Punteggio Rankato',
            'replays_watched_by_others' => 'Replay Guardati da Altri',
            'score_ranks' => 'Rank dei Punteggi',
            'total_hits' => 'Colpi Totali',
            'total_score' => 'Punteggio Totale',
        ],
    ],

    'verify' => [
        'title' => 'Verifica dell\'account',
    ],
];
