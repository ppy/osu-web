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
    'show' => [
        'details' => [
            'made-by' => 'creata da ',
            'submitted' => 'inviata il ',
            'ranked' => 'rankata il ',
            'logged-out' => 'Devi avere effettuato il login prima di scaricare qualsiasi beatmap!',
            'download' => [
                '_' => 'Scarica',
                'video' => 'con Video',
                'no-video' => 'senza Video',
                'direct' => 'osu!direct',
            ],
        ],
        'stats' => [
            'cs' => 'Dimensione dei Cerchi',
            'cs-mania' => 'Numero di Tasti',
            'drain' => 'Drenaggio HP',
            'accuracy' => 'Precisione',
            'ar' => 'Tempo di approccio',
            'stars' => 'Stelle di Difficoltà',
            'total_length' => 'Durata',
            'bpm' => 'BPM',
            'count_circles' => 'Numero di Cerchi',
            'count_sliders' => 'Numero di Slider',

            'chart' => [
                'cs' => 'CS',
                'hp' => 'HP',
                'od' => 'OD',
                'ar' => 'AR',
                'sd' => 'SD',
            ],

            'user-rating' => 'Voto degli Utenti',
            'rating-spread' => 'Diffusione della Valutazione',
        ],
        'info' => [
            'success-rate' => 'Rateo di Successo',
            'points-of-failure' => 'Punti di Fallimento',

            'description' => 'Descrizione',

            'source' => 'Sorgente',
            'tags' => 'Tag',
        ],
        'scoreboard' => [
            'achieved' => 'raggiunto :when',
            'country' => 'Rank del Paese',
            'friend' => 'Rank degli amici',
            'global' => 'Rank Globale',
            'supporter-link' => 'Clicca <a href=":link">qui</a> per vedere tutte le fantastiche feature che otterrai!',
            'supporter-only' => 'Devi essere un supporter per accedere alle classifiche amici e paese!',
            'title' => 'Classifica',

            'list' => [
                'accuracy' => 'Precisione',
                'player-header' => 'Giocatore',
                'rank-header' => 'Rank',
                'score' => 'Punteggio',
            ],
            'no_scores' => [
                'country' => 'Nessuno dal tuo paese ha fatto un punteggio in questa mappa!',
                'friend' => 'Nessuno dei tuoi amici ha fatto un punteggio in questa mappa!',
                'global' => 'Nessun punteggio al momento. Perchè non provi a farne uno?',
                'loading' => 'Caricamento punteggi...',
            ],
        ],
    ],
];
