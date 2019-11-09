<?php

/**
 *    Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
 *    See the LICENCE file in the repository root for full licence text.
 */

return [
    'availability' => [
        'disabled' => 'Questa beatmap non è al momento disponibile per il download.',
        'parts-removed' => 'Porzioni di questa beatmap sono state rimosse su richiesta del creatore o di un titolare di copyright di terze parti.',
        'more-info' => 'Controlla qui per maggiori informazioni.',
    ],

    'index' => [
        'title' => 'Lista Beatmap',
        'guest_title' => 'Beatmap',
    ],

    'show' => [
        'discussion' => 'Discussione',

        'details' => [
            'approved' => 'approvata il ',
            'favourite' => 'Mi piace questo beatmapset',
            'logged-out' => 'Devi avere effettuato il login prima di scaricare qualsiasi beatmap!',
            'loved' => 'amata il ',
            'mapped_by' => 'mappata da :mapper',
            'qualified' => 'qualificata il ',
            'ranked' => 'classificata il ',
            'submitted' => 'inviata il ',
            'unfavourite' => 'Non mi piace questo set di beatmap',
            'updated' => 'ultimo aggiornamento il ',
            'updated_timeago' => 'ultimo aggiornamento :timeago',

            'download' => [
                '_' => 'Scarica',
                'direct' => 'osu!direct',
                'no-video' => 'senza Video',
                'video' => 'con Video',
            ],

            'login_required' => [
                'bottom' => 'per accedere a maggiori funzionalità',
                'top' => 'Accedi',
            ],
        ],

        'favourites' => [
            'limit_reached' => 'Hai troppe beatmap preferite! Rimuovine qualcuna prima di riprovare.',
        ],

        'hype' => [
            'action' => 'Lascia Hype a questa mappa se ti sei divertito a giocarla per aiutarla ad avanzare allo stato <strong>Ranked</strong>.',

            'current' => [
                '_' => 'Questa mappa è attualmente :status.',

                'status' => [
                    'pending' => 'in attesa',
                    'qualified' => 'qualificata',
                    'wip' => 'work in progress',
                ],
            ],

            'report' => [
                '_' => '',
                'button' => '',
                'button_title' => '',
                'link' => '',
            ],
        ],

        'info' => [
            'description' => 'Descrizione',
            'genre' => 'Genere',
            'language' => 'Lingua',
            'no_scores' => 'Dati ancora in elaborazione...',
            'points-of-failure' => 'Punti di Fallimento',
            'source' => 'Sorgente',
            'success-rate' => 'Rateo di Successo',
            'tags' => 'Tag',
            'unranked' => 'Beatmap non classificata',
        ],

        'scoreboard' => [
            'achieved' => 'ottenuto :when',
            'country' => 'Rank del Paese',
            'friend' => 'Rank degli Amici',
            'global' => 'Rank Globale',
            'supporter-link' => 'Clicca <a href=":link">qui</a> per vedere tutte le fantastiche funzionalità che otterrai!',
            'supporter-only' => 'Devi essere un osu!supporter per vedere i rank degli amici e del paese!',
            'title' => 'Classifica',

            'headers' => [
                'accuracy' => 'Precisione',
                'combo' => 'Max Combo',
                'miss' => 'Miss',
                'mods' => 'Mod',
                'player' => 'Giocatore',
                'pp' => '',
                'rank' => 'Rank',
                'score_total' => 'Punteggio Totale',
                'score' => 'Punteggio',
            ],

            'no_scores' => [
                'country' => 'Nessuno dal tuo paese ha fatto un punteggio in questa mappa!',
                'friend' => 'Nessuno dei tuoi amici ha fatto un punteggio in questa mappa!',
                'global' => 'Ancora nessun punteggio. Perché non provi a farne uno?',
                'loading' => 'Caricamento punteggi...',
                'unranked' => 'Beatmap non classificata.',
            ],
            'score' => [
                'first' => 'In testa',
                'own' => 'Il tuo miglior punteggio',
            ],
        ],

        'stats' => [
            'cs' => 'Dimensione Cerchi',
            'cs-mania' => 'Numero di Tasti',
            'drain' => 'Drenaggio HP',
            'accuracy' => 'Precisione',
            'ar' => 'Approach Rate',
            'stars' => 'Stelle di Difficoltà',
            'total_length' => 'Durata (Lunghezza drenaggio: :hit_length)',
            'bpm' => 'BPM',
            'count_circles' => 'Numero di Cerchi',
            'count_sliders' => 'Numero di Slider',
            'user-rating' => 'Voto degli Utenti',
            'rating-spread' => 'Diffusione della Valutazione',
            'nominations' => 'Nomine',
            'playcount' => 'Volte giocata',
        ],
    ],
];
