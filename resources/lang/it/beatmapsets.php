<?php

/**
 *    Copyright (c) ppy Pty Ltd <contact@ppy.sh>.
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
    'availability' => [
        'disabled' => 'Questa beatmap non è al momento disponibile per il download.',
        'parts-removed' => 'Porzioni di questa beatmap sono stati rimossi su richiesta del creatore o per motivi di copyright di terze parti.',
        'more-info' => 'Clicca qui per maggiori informazioni.',
    ],

    'index' => [
        'title' => 'Lista Beatmap',
        'guest_title' => 'Beatmap',
    ],

    'show' => [
        'discussion' => 'Discussione',

        'details' => [
            'approved' => 'approvata il ',
            'favourite' => 'Mi piace questa lista di mappe',
            'favourited_count' => '+ 1 altro!|+ :count altri!',
            'logged-out' => 'Devi avere effettuato il login prima di scaricare qualsiasi beatmap!',
            'loved' => 'amata il ',
            'mapped_by' => 'mappata da :mapper',
            'qualified' => 'qualificata il ',
            'ranked' => 'classificata il ',
            'submitted' => 'inviata il ',
            'unfavourite' => 'Non mi piace questa lista di mappe',
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
            'limit_reached' => 'Hai troppe beatmaps preferite! Si prega di de-preferirne una prima di continuare.',
        ],

        'hype' => [
            'action' => 'Hype questa mappa se ti sei divertito a giocarla per aiutarla ad avanzare verso lo status di <strong>Ranked</strong>.',

            'current' => [
                '_' => 'Questa mappa è attualmente :status.',

                'status' => [
                    'pending' => 'in attesa',
                    'qualified' => 'qualificata',
                    'wip' => 'lavori in corso',
                ],
            ],
        ],

        'info' => [
            'description' => 'Descrizione',
            'genre' => 'Genere',
            'language' => 'Lingua',
            'no_scores' => 'Dati ancora da calcolare...',
            'points-of-failure' => 'Punti di Fallimento',
            'source' => 'Sorgente',
            'success-rate' => 'Rateo di Successo',
            'tags' => 'Tag',
            'unranked' => 'Beatmap non classificata',
        ],

        'scoreboard' => [
            'achieved' => 'raggiunto :when',
            'country' => 'Rank del Paese',
            'friend' => 'Rank degli amici',
            'global' => 'Rank Globale',
            'supporter-link' => 'Clicca <a href=":link">qui</a> per vedere tutte le fantastiche feature che otterrai!',
            'supporter-only' => 'Devi essere un supporter per accedere alle classifiche amici e paese!',
            'title' => 'Classifica',

            'headers' => [
                'accuracy' => 'Precisione',
                'combo' => 'Max Combo',
                'miss' => 'Errori',
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
                'global' => 'Nessun punteggio al momento. Perchè non provi a farne uno?',
                'loading' => 'Caricamento punteggi...',
                'unranked' => 'Beatmap non classificata.',
            ],
            'score' => [
                'first' => 'In testa',
                'own' => 'Il tuo miglior punteggio',
            ],
        ],

        'stats' => [
            'cs' => 'Dimensione dei Cerchi',
            'cs-mania' => 'Numero di Tasti',
            'drain' => 'Drenaggio HP',
            'accuracy' => 'Precisione',
            'ar' => 'Approach Rate',
            'stars' => 'Stelle di Difficoltà',
            'total_length' => 'Durata',
            'bpm' => 'BPM',
            'count_circles' => 'Numero di Cerchi',
            'count_sliders' => 'Numero di Slider',
            'user-rating' => 'Voto degli Utenti',
            'rating-spread' => 'Diffusione della Valutazione',
            'nominations' => 'Nomine',
            'playcount' => 'Volte giocato',
        ],
    ],
];
