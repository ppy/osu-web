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
        ],
    ],

    'nominations' => [
        'disqualification_prompt' => 'Ragioni della squalifica?',
        'disqualified_at' => 'squalificata :time_ago',
        'disqualify' => 'Squalifica',
        'incorrect_state' => 'Errore nel eseguire quell\'azione, prova a ricaricare la pagina.',
        'nominate' => 'Nomina',
        'qualified' => 'Data stimata essere rankata :date, se non viene trovato alcun problema.',
        'qualified_soon' => 'Previsto il rank a breve, se non viene trovato alcun problema.',
        'required_text' => 'Nominazioni: :current/:required',
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
