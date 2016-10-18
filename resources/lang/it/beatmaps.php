<?php

/**
 *    Copyright 2015 ppy Pty. Ltd.
 *
 *    This file is part of osu!web. osu!web is distributed in the hopes of
 *    attracting more community contributions to the core ecosystem of osu!
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
    'discussion-posts' => [
        'store' => [
            'error' => 'Errore durante il salvataggio di un post',
        ],
    ],

    'discussion-votes' => [
        'update' => [
            'error' => 'Errore durante l\'aggiornamento del voto',
        ],
    ],

    'discussions' => [
        'collapse' => [
            'all-collapse' => 'Comprimi tutto',
            'all-expand' => 'Espandi tutto',
        ],

        'edit' => 'modifica',
        'edited' => 'Ultima modifica di :editor :update_time',
        'empty' => [
            'empty' => 'Ancora nessuna discussione!',
            'filtered' => 'Nessuna discussione corrisponde ai filtri selezionati.',
        ],

        'message_hint' => [
            'in_general' => 'Questo post andrà nella discussione generale della Beatmap. Per moddare questa Beatmap, inizia il tuo messaggio con un timestamp (es. 00:12:345).',
            'in_timeline' => 'per moddare più timestamp, posta più volte (un post per timestamp).',
        ],

        'message_placeholder' => 'Scrivi qui per postare',

        'message_type' => [
            'praise' => 'Elogio',
            'problem' => 'Problema',
            'suggestion' => 'Suggerimento',
        ],

        'message_type_select' => 'Seleziona il tipo di commento',

        'mode' => [
            'general' => 'Generale',
            'timeline' => 'Linea Temporale',
        ],

        'require-login' => 'Per favore effettua il login per postare o rispondere',
        'resolved' => 'Risolto',

        'show' => [
            'title' => 'Discussione Beatmap',
        ],

        'stats' => [
            'mine' => 'Mio',
            'pending' => 'In attesa',
            'praises' => 'Elogi',
            'resolved' => 'Risolti',
            'total' => 'Totale',
        ],
    ],

    'nominations' => [
        'disqualify' => 'Squalifica',
        'nominate' => 'Nomina',
        'required-text' => 'Nominazioni: :current/:required',
        'disqualifed-at' => 'squalificata :time_ago',
        'disqualification-prompt' => 'Ragioni della squalifica?',
        'qualified' => 'Data stimata essere rankata :date, se non viene trovato alcun problema.',
        'qualified-soon' => 'Previsto il rank a breve, se non viene trovato alcun problema.',
        'incorrect-state' => 'Errore nel eseguire quell\'azione, prova a ricaricare la pagina.',
    ],

    'listing' => [
        'search' => [
            'prompt' => 'scrivi le parole chiave...',
            'options' => 'Più Opzioni di Ricerca',
            'not-found' => 'nessun risultato',
            'not-found-quote' => '... no, non abbiamo trovato nulla.',
        ],
        'mode' => 'Modalità',
        'status' => 'Status del Rank',
        'mapped-by' => 'mappata da :mapper',
        'source' => 'da :source',
        'load-more' => 'Carica altro...',
    ],
    'beatmapset' => [
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
                'title' => 'Classifica',
                'no-scores' => [
                    'global' => 'Nessun punteggio al momento. Perchè non provi a farne uno?',
                    'loading' => 'Caricamento punteggi...',
                    'country' => 'Nessuno dal tuo paese ha fatto un punteggio in questa mappa!',
                    'friend' => 'Nessuno dei tuoi amici ha fatto un punteggio in questa mappa!',
                ],
                'supporter-only' => 'Devi essere un supporter per accedere alle classifiche amici e paese!',
                'supporter-link' => 'Clicca <a href=":link">qui</a> per vedere tutte le fantastiche feature che otterrai!',
                'global' => 'Rank Globale',
                'country' => 'Rank del Paese',
                'friend' => 'Rank degli amici',
                'achieved' => 'raggiunto :when',
                'stats' => [
                    'score' => 'Punteggio',
                    'accuracy' => 'Precisione',
                    'countgeki' => 'MAX',
                    'count300' => '300',
                    'countkatu' => '200',
                    'count100' => '100',
                    'count50' => '50',
                ],
                'list' => [
                    'rank-header' => 'Rank',
                    'player-header' => 'Giocatore',
                    'score' => 'Punteggio',
                    'accuracy' => 'Precisione',
                ],
            ],
        ],
    ],
    'mode' => [
        'any' => 'Qualsiasi',
        'osu' => 'osu!',
        'taiko' => 'osu!taiko',
        'fruits' => 'osu!catch',
        'mania' => 'osu!mania',
    ],
    'status' => [
        'any' => 'Tutto',
        'ranked-approved' => 'Rankate e Approvate',
        'approved' => 'Approvate',
        'faves' => 'Preferiti',
        'modreqs' => 'Richieste di Mod',
        'pending' => 'In Attesa',
        'graveyard' => 'Cimitero', // It litterally means "Cimitero" in italian, but maybe there's a better translation?
        'my-maps' => 'Mie Mappe',
    ],
    'genre' => [
        'any' => 'Qualsiasi',
        'unspecified' => 'Non specificato',
        'video-game' => 'Videogiochi',
        'anime' => 'Anime',
        'rock' => 'Rock',
        'pop' => 'Pop',
        'other' => 'Altro',
        'novelty' => 'Novità',
        'hip-hop' => 'Hip Hop',
        'electronic' => 'Elettronica',
    ],
    'mods' => [
        'NF' => 'No Fail',
        'EZ' => 'Easy Mode',
        'HD' => 'Hidden',
        'HR' => 'Hard Rock',
        'SD' => 'Sudden Death',
        'DT' => 'Double Time',
        'Relax' => 'Relax',
        'HT' => 'Half Time',
        'NC' => 'Nightcore',
        'FL' => 'Flashlight',
        'SO' => 'Spun Out',
        'AP' => 'Auto Pilot',
        'PF' => 'Perfect',
        '4K' => '4K',
        '5K' => '5K',
        '6K' => '6K',
        '7K' => '7K',
        '8K' => '8K',
        'FI' => 'Fade In',
        '9K' => '9K',
        'NM' => 'Senza Mod',
    ],
    'language' => [
    'any' => 'Qualsiasi',
    'english' => 'Inglese',
    'chinese' => 'Cinese',
    'french' => 'Francese',
    'german' => 'Tedesco',
    'italian' => 'Italiano',
    'japanese' => 'Giapponese',
    'korean' => 'Coreano',
    'spanish' => 'Spagnolo',
    'swedish' => 'Svedese',
    'instrumental' => 'Strumentale',
    'other' => 'Altro',
    ],
    'extra' => [
        'video' => 'Ha Video',
        'storyboard' => 'Ha Storyboard',
    ],
    'rank' => [
        'any' => 'Qualsiasi',
        'XH' => 'SS Argentata',
        'X' => 'SS',
        'SH' => 'S Argentata',
        'S' => 'S',
        'A' => 'A',
        'B' => 'B',
        'C' => 'C',
        'D' => 'D',
    ],
];
