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
            'made-by' => 'creata da ',
            'submitted' => 'inviata il ',
            'updated' => 'ultimo aggiornamento il ',
            'ranked' => 'rankata il ',
            'approved' => 'approvato il ',
            'qualified' => 'qualificato il ',
            'loved' => 'loved il ',
            'logged-out' => 'Devi avere effettuato il login prima di scaricare qualsiasi beatmap!',
            'download' => [
                '_' => 'Scarica',
                'video' => 'con Video',
                'no-video' => 'senza Video',
                'direct' => 'osu!direct',
            ],
            'favourite' => '',
            'unfavourite' => '',
            'favourited_count' => '',
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
            'user-rating' => 'Voto degli Utenti',
            'rating-spread' => 'Diffusione della Valutazione',
            'nominations' => 'Nomine',
            'playcount' => 'Volte giocato',
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
                'accuracy' => 'Accuratezza',
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
                'own' => '',
            ],
        ],
    ],
];
