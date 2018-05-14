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
        'allow_kudosu' => 'allow kudosu',
        'delete' => 'delete',
        'deleted' => 'Deleted by :editor :delete_time.',
        'deny_kudosu' => 'deny kudosu',
        'edit' => 'modifica',
        'edited' => 'Ultima modifica di :editor :update_time',
        'kudosu_denied' => 'Denied from obtaining kudosu.',
        'message_placeholder' => 'Scrivi qui per postare',
        'message_placeholder_deleted_beatmap' => 'This difficulty has been deleted so it may no longer be discussed.',
        'message_type_select' => 'Seleziona il tipo di commento',
        'reply_notice' => 'Press enter to reply.',
        'reply_placeholder' => 'Type your response here',
        'require-login' => 'Per favore effettua il login per postare o rispondere',
        'resolved' => 'Risolto',
        'restore' => 'restore',
        'title' => 'Discussions',

        'collapse' => [
            'all-collapse' => 'Comprimi tutto',
            'all-expand' => 'Espandi tutto',
        ],

        'empty' => [
            'empty' => 'Ancora nessuna discussione!',
            'hidden' => 'No discussion matches selected filter.',
        ],

        'message_hint' => [
            'in_general' => 'Questo post andrà nella discussione generale della Beatmap. Per moddare questa Beatmap, inizia il tuo messaggio con un timestamp (es. 00:12:345).',
            'in_timeline' => 'per moddare più timestamp, posta più volte (un post per timestamp).',
        ],

        'message_type' => [
            'disqualify' => 'Disqualify',
            'hype' => 'Hype!',
            'mapper_note' => 'Note',
            'nomination_reset' => 'Reset Nomination',
            'praise' => 'Elogio',
            'problem' => 'Problema',
            'suggestion' => 'Suggerimento',
        ],

        'mode' => [
            'events' => 'History',
            'general' => 'General :scope',
            'timeline' => 'Linea Temporale',
            'scopes' => [
                'general' => 'This difficulty',
                'generalAll' => 'All difficulties',
            ],
        ],

        'new' => [
            'timestamp' => 'Timestamp',
            'timestamp_missing' => 'ctrl-c in edit mode and paste in your message to add a timestamp!',
            'title' => 'New Discussion',
        ],

        'show' => [
            'title' => 'Discussione Beatmap',
        ],

        'sort' => [
            '_' => 'Sorted by:',
            'created_at' => 'creation time',
            'timeline' => 'timeline',
            'updated_at' => 'last update',
        ],

        'stats' => [
            'deleted' => 'Deleted',
            'mapper_notes' => 'Notes',
            'mine' => 'Mio',
            'pending' => 'In attesa',
            'praises' => 'Elogi',
            'resolved' => 'Risolti',
            'total' => 'All',
        ],

        'status-messages' => [
            'approved' => 'This beatmap was approved on :date!',
            'graveyard' => "This beatmap hasn't been updated since :date and has most likely been abandoned by the creator...",
            'loved' => 'This beatmap was added to loved on :date!',
            'ranked' => 'This beatmap was ranked on :date!',
            'wip' => 'Note: This beatmap is marked as a work-in-progress by the creator.',
        ],

    ],

    'hype' => [
        'button' => 'Hype Beatmap!',
        'button_done' => 'Already Hyped!',
        'confirm' => "Are you sure? This will use one out of your remaining :n hype and can't be undone.",
        'explanation' => 'Hype this beatmap to make it more visible for nomination and ranking!',
        'explanation_guest' => 'Sign in and hype this beatmap to make it more visible for nomination and ranking!',
        'new_time' => "You'll get another hype :new_time.",
        'remaining' => 'You have :remaining hype left.',
        'required_text' => 'Hype: :current/:required',
        'section_title' => 'Hype Train',
        'title' => 'Hype',
    ],

    'feedback' => [
        'button' => 'Leave Feedback',
    ],

    'nominations' => [
        'disqualification_prompt' => 'Ragioni della squalifica?',
        'disqualified_at' => 'squalificata :time_ago',
        'disqualified_no_reason' => 'no reason specified',
        'disqualify' => 'Squalifica',
        'incorrect_state' => 'Errore nel eseguire quell\'azione, prova a ricaricare la pagina.',
        'nominate' => 'Nomina',
        'nominate_confirm' => 'Nominate this beatmap?',
        'nominated_by' => 'nominated by :users',
        'qualified' => 'Data stimata essere rankata :date, se non viene trovato alcun problema.',
        'qualified_soon' => 'Previsto il rank a breve, se non viene trovato alcun problema.',
        'required_text' => 'Nominazioni: :current/:required',
        'reset_message_deleted' => 'deleted',
        'title' => 'Nomination Status',
        'unresolved_issues' => 'There are still unresolved issues that must be addressed first.',

        'reset_at' => [
            'nomination_reset' => 'Nomination process reset :time_ago by :user with new problem :discussion (:message).',
            'disqualify' => 'Disqualified :time_ago by :user with new problem :discussion (:message).',
        ],

        'reset_confirm' => [
            'nomination_reset' => 'Are you sure? Posting a new problem will reset nomination process.',
        ],
    ],

    'listing' => [
        'search' => [
            'prompt' => 'scrivi le parole chiave...',
            'options' => 'Più Opzioni di Ricerca',
            'not-found' => 'nessun risultato',
            'not-found-quote' => '... no, non abbiamo trovato nulla.',
            'filters' => [
                'general' => 'General',
                'mode' => 'Mode',
                'status' => 'Rank Status',
                'genre' => 'Genre',
                'language' => 'Language',
                'extra' => 'extra',
                'rank' => 'Rank Achieved',
                'played' => 'Played',
            ],
        ],
        'mode' => 'Modalità',
        'status' => 'Status del Rank',
        'mapped-by' => 'mappata da :mapper',
        'source' => 'da :source',
        'load-more' => 'Carica altro...',
    ],
    'general' => [
        'recommended' => 'Recommended difficulty',
        'converts' => 'Include converted beatmaps',
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
        'qualified' => 'Qualified',
        'loved' => 'Loved',
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
        'TD' => 'Touch Device',
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
        'any' => 'Any',
        'played' => 'Played',
        'unplayed' => 'Unplayed',
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
