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
        'allow_kudosu' => 'permetti kudosu',
        'delete' => 'elimina',
        'deleted' => 'Eliminato da :editor :delete_time.',
        'deny_kudosu' => 'nega kudosu',
        'edit' => 'modifica',
        'edited' => 'Ultima modifica di :editor :update_time',
        'kudosu_denied' => '',
        'message_placeholder' => 'Scrivi qui per postare',
        'message_placeholder_deleted_beatmap' => '',
        'message_type_select' => 'Seleziona il tipo di commento',
        'reply_notice' => '',
        'reply_placeholder' => '',
        'require-login' => 'Per favore effettua il login per postare o rispondere',
        'resolved' => 'Risolto',
        'restore' => '',
        'title' => '',

        'collapse' => [
            'all-collapse' => 'Comprimi tutto',
            'all-expand' => 'Espandi tutto',
        ],

        'empty' => [
            'empty' => 'Ancora nessuna discussione!',
            'hidden' => '',
        ],

        'message_hint' => [
            'in_general' => 'Questo post andrà nella discussione generale della Beatmap. Per moddare questa Beatmap, inizia il tuo messaggio con un timestamp (es. 00:12:345).',
            'in_timeline' => 'per moddare più timestamp, posta più volte (un post per timestamp).',
        ],

        'message_type' => [
            'disqualify' => '',
            'hype' => '',
            'mapper_note' => '',
            'nomination_reset' => '',
            'praise' => 'Elogio',
            'problem' => 'Problema',
            'suggestion' => 'Suggerimento',
        ],

        'mode' => [
            'events' => '',
            'general' => '',
            'timeline' => 'Linea Temporale',
            'scopes' => [
                'general' => '',
                'generalAll' => '',
            ],
        ],

        'new' => [
            'timestamp' => '',
            'timestamp_missing' => '',
            'title' => '',
        ],

        'show' => [
            'title' => 'Discussione Beatmap',
        ],

        'sort' => [
            '_' => '',
            'created_at' => '',
            'timeline' => '',
            'updated_at' => '',
        ],

        'stats' => [
            'deleted' => '',
            'mapper_notes' => '',
            'mine' => 'Mio',
            'pending' => 'In attesa',
            'praises' => 'Elogi',
            'resolved' => 'Risolti',
            'total' => '',
        ],

        'status-messages' => [
            'approved' => '',
            'graveyard' => "",
            'loved' => '',
            'ranked' => '',
            'wip' => '',
        ],

    ],

    'hype' => [
        'button' => '',
        'button_done' => '',
        'confirm' => "",
        'explanation' => '',
        'explanation_guest' => '',
        'new_time' => "",
        'remaining' => '',
        'required_text' => '',
        'section_title' => '',
        'title' => '',
    ],

    'feedback' => [
        'button' => '',
    ],

    'nominations' => [
        'disqualification_prompt' => 'Ragioni della squalifica?',
        'disqualified_at' => 'squalificata :time_ago',
        'disqualified_no_reason' => '',
        'disqualify' => 'Squalifica',
        'incorrect_state' => 'Errore nel eseguire quell\'azione, prova a ricaricare la pagina.',
        'nominate' => 'Nomina',
        'nominate_confirm' => '',
        'nominated_by' => '',
        'qualified' => 'Data stimata essere rankata :date, se non viene trovato alcun problema.',
        'qualified_soon' => 'Previsto il rank a breve, se non viene trovato alcun problema.',
        'required_text' => 'Nominazioni: :current/:required',
        'reset_message_deleted' => '',
        'title' => '',
        'unresolved_issues' => '',

        'reset_at' => [
            'nomination_reset' => '',
            'disqualify' => '',
        ],

        'reset_confirm' => [
            'nomination_reset' => '',
        ],
    ],

    'listing' => [
        'search' => [
            'prompt' => 'scrivi le parole chiave...',
            'options' => 'Più Opzioni di Ricerca',
            'not-found' => 'nessun risultato',
            'not-found-quote' => '... no, non abbiamo trovato nulla.',
            'filters' => [
                'general' => '',
                'mode' => '',
                'status' => '',
                'genre' => '',
                'language' => '',
                'extra' => '',
                'rank' => '',
                'played' => '',
            ],
        ],
        'mode' => 'Modalità',
        'status' => 'Status del Rank',
        'mapped-by' => 'mappata da :mapper',
        'source' => 'da :source',
        'load-more' => 'Carica altro...',
    ],
    'general' => [
        'recommended' => '',
        'converts' => '',
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
        'qualified' => '',
        'loved' => '',
        'faves' => 'Preferiti',
        'pending' => 'In Attesa',
        'graveyard' => 'Cimitero',
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
        '4K' => '4K',
        '5K' => '5K',
        '6K' => '6K',
        '7K' => '7K',
        '8K' => '8K',
        '9K' => '9K',
        'AP' => 'Auto Pilot',
        'DT' => 'Double Time',
        'EZ' => 'Easy Mode',
        'FI' => 'Fade In',
        'FL' => 'Flashlight',
        'HD' => 'Hidden',
        'HR' => 'Hard Rock',
        'HT' => 'Half Time',
        'NC' => 'Nightcore',
        'NF' => 'No Fail',
        'NM' => 'Senza Mod',
        'PF' => 'Perfect',
        'Relax' => 'Relax',
        'SD' => 'Sudden Death',
        'SO' => 'Spun Out',
        'TD' => '',
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
    'played' => [
        'any' => '',
        'played' => '',
        'unplayed' => '',
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
