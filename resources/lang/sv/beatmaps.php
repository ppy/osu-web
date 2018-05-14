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
            'error' => 'Misslyckades spara inlägg',
        ],
    ],

    'discussion-votes' => [
        'update' => [
            'error' => 'Misslyckades uppdatera röst',
        ],
    ],

    'discussions' => [
        'allow_kudosu' => 'tillåt kudosu',
        'delete' => 'radera',
        'deleted' => 'Raderad av :editor :delete_time.',
        'deny_kudosu' => 'neka kudosu',
        'edit' => 'redigera',
        'edited' => 'Senast redigerad av :editor :update_time.',
        'kudosu_denied' => 'Nekad från att skaffa kudosu.',
        'message_placeholder' => 'Skriv här för att lägga upp inlägg',
        'message_placeholder_deleted_beatmap' => '',
        'message_type_select' => 'Välj Kommentar Typ',
        'reply_notice' => 'Tryck enter för att svara.',
        'reply_placeholder' => 'Skriv ditt svar här',
        'require-login' => 'Var vänlig logga in för att lägga upp inlägg eller svara',
        'resolved' => 'Löst',
        'restore' => 'återställ',
        'title' => 'Diskussioner',

        'collapse' => [
            'all-collapse' => 'Kollapsa allt',
            'all-expand' => 'Expandera allt',
        ],

        'empty' => [
            'empty' => 'Inga diskussioner än!',
            'hidden' => 'Inga diskussioner matchar vald filter.',
        ],

        'message_hint' => [
            'in_general' => 'Detta inlägg kommer läggas upp på allmän beatmapset diskussion. För att modda denna beatmap, börja meddelandet med en tidsstämpel (e.x. 00:12:345).',
            'in_timeline' => 'För att modda flera tidsstämplar, lägg upp flera inlägg (ett inlägg för varje tidsstämpel).',
        ],

        'message_type' => [
            'disqualify' => '',
            'hype' => '',
            'mapper_note' => 'Anteckning',
            'nomination_reset' => '',
            'praise' => 'Beröm',
            'problem' => 'Problem',
            'suggestion' => 'Förslag',
        ],

        'mode' => [
            'events' => 'Historia',
            'general' => '',
            'timeline' => 'Tidslinje',
            'scopes' => [
                'general' => '',
                'generalAll' => '',
            ],
        ],

        'new' => [
            'timestamp' => 'Tidsstämpel',
            'timestamp_missing' => 'ctrl-c i redigerings läge och klistra in ditt meddelande för att lägga till en tidsstämpel!',
            'title' => 'Ny Diskussion',
        ],

        'show' => [
            'title' => ':title mappad av :mapper',
        ],

        'sort' => [
            '_' => '',
            'created_at' => '',
            'timeline' => '',
            'updated_at' => '',
        ],

        'stats' => [
            'deleted' => 'Raderad',
            'mapper_notes' => 'Anteckningar',
            'mine' => 'Min',
            'pending' => 'Avvaktar',
            'praises' => 'Beröm',
            'resolved' => 'Löst',
            'total' => 'Alla',
        ],

        'status-messages' => [
            'approved' => 'This beatmap was approved on :date!',
            'graveyard' => "Denna beatmap har inte blivit uppdaterad sen :date och har mest troligast blivit övergiven av skaparen...",
            'loved' => 'Denna beatmap blev tillagd i älskad :date!',
            'ranked' => 'Denna beatmap blev rankad :date!',
            'wip' => 'Notera: Denna beatmap är markerad som pågående arbete av skaparen.',
        ],

    ],

    'hype' => [
        'button' => 'Hype Beatmap!',
        'button_done' => '',
        'confirm' => "",
        'explanation' => 'Att lägga till beröm ❤ kommer höja denna beatmaps hype, vilket gör den mer synlig för nominering och rankning!',
        'explanation_guest' => '',
        'new_time' => "",
        'remaining' => '',
        'required_text' => '',
        'section_title' => '',
        'title' => 'Hype',
    ],

    'feedback' => [
        'button' => '',
    ],

    'nominations' => [
        'disqualification_prompt' => 'Anledning för diskvalificering?',
        'disqualified_at' => 'Diskvalificerad :time_ago (:reason).',
        'disqualified_no_reason' => 'inget anledning specificerad',
        'disqualify' => 'Diskvalificera',
        'incorrect_state' => '',
        'nominate' => 'Nominera',
        'nominate_confirm' => 'Nominera denna beatmap?',
        'nominated_by' => 'nominerad av :users',
        'qualified' => 'Beräknad tid när den är rankad är :date, om inga fel hittas.',
        'qualified_soon' => 'Beräknat att den rankas snart, om inga fel hittas.',
        'required_text' => 'Nomineringar: :current/:required',
        'reset_message_deleted' => '',
        'title' => 'Nominering Status',
        'unresolved_issues' => '',

        'reset_at' => [
            'nomination_reset' => '',
            'disqualify' => '',
        ],

        'reset_confirm' => [
            'nomination_reset' => 'Är du säker? Lägga upp ett nytt problem kommer återställa nomineringar.',
        ],
    ],

    'listing' => [
        'search' => [
            'prompt' => 'skriv in nyckelord...',
            'options' => 'Mer Sök Alternativ',
            'not-found' => 'inga resultat',
            'not-found-quote' => '... nope, ingenting hittades.',
            'filters' => [
                'general' => '',
                'mode' => 'Läge',
                'status' => 'Rank Status',
                'genre' => 'Genre',
                'language' => 'Språk',
                'extra' => 'extra',
                'rank' => 'Rank Uppnådd',
                'played' => '',
            ],
        ],
        'mode' => 'Läge',
        'status' => 'Rank Status',
        'mapped-by' => 'mappad av :mapper',
        'source' => 'från :source',
        'load-more' => 'Ladda mer...',
    ],
    'general' => [
        'recommended' => '',
        'converts' => '',
    ],
    'mode' => [
        'any' => 'Alla',
        'osu' => 'osu!',
        'taiko' => 'osu!taiko',
        'fruits' => 'osu!catch',
        'mania' => 'osu!mania',
    ],
    'status' => [
        'any' => 'Alla',
        'ranked-approved' => 'Rankad & Godkänd',
        'approved' => 'Godkänd',
        'qualified' => 'Kvalificerad',
        'loved' => 'Älskad',
        'faves' => 'Favoriter',
        'pending' => 'Avvaktar',
        'graveyard' => 'Kyrkogård',
        'my-maps' => 'Mina Maps',
    ],
    'genre' => [
        'any' => 'Alla',
        'unspecified' => 'Ospecificerad',
        'video-game' => 'Spel',
        'anime' => 'Anime',
        'rock' => 'Rock',
        'pop' => 'Pop',
        'other' => 'Annan',
        'novelty' => 'Novelty',
        'hip-hop' => 'Hip Hop',
        'electronic' => 'Elektronisk',
    ],
    'mods' => [
        '4K' => '4K',
        '5K' => '5K',
        '6K' => '6K',
        '7K' => '7K',
        '8K' => '8K',
        '9K' => '9K',
        'AP' => 'Auto Pilot',
        'DT' => 'Dubbel Tid',
        'EZ' => 'Enkelt Läge',
        'FI' => 'Tona In',
        'FL' => 'Ficklampa',
        'HD' => 'Gömd',
        'HR' => 'Hård Rock',
        'HT' => 'Halv Tid',
        'NC' => 'Nightcore',
        'NF' => 'Ingen Fail',
        'NM' => 'Inga mods',
        'PF' => 'Perfekt',
        'Relax' => 'Lugn',
        'SD' => 'Sudden Death',
        'SO' => 'Spinnat Ut',
        'TD' => '',
    ],
    'language' => [
        'any' => 'Alla',
        'english' => 'Engelska',
        'chinese' => 'Kinesiska',
        'french' => 'Franska',
        'german' => 'Tyska',
        'italian' => 'Italienska',
        'japanese' => 'Japanska',
        'korean' => 'Koreanska',
        'spanish' => 'Spanska',
        'swedish' => 'Svenska',
        'instrumental' => 'Instrumental',
        'other' => 'Annat',
    ],
    'played' => [
        'any' => '',
        'played' => '',
        'unplayed' => '',
    ],
    'extra' => [
        'video' => 'Har Video',
        'storyboard' => 'Har Storyboard',
    ],
    'rank' => [
        'any' => 'Alla',
        'XH' => 'Silver SS',
        'X' => 'SS',
        'SH' => 'Silver S',
        'S' => 'S',
        'A' => 'A',
        'B' => 'B',
        'C' => 'C',
        'D' => 'D',
    ],
];
