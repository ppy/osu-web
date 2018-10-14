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
            'error' => 'Kunde ej spara inlägg',
        ],
    ],

    'discussion-votes' => [
        'update' => [
            'error' => 'Kunde ej uppdatera röst',
        ],
    ],

    'discussions' => [
        'allow_kudosu' => 'tillåt kudosu',
        'delete' => 'radera',
        'deleted' => 'Raderad av :editor :delete_time.',
        'deny_kudosu' => 'neka kudosu',
        'edit' => 'redigera',
        'edited' => 'Senast redigerad av :editor :update_time.',
        'kudosu_denied' => 'Kudosu nekad.',
        'message_placeholder_deleted_beatmap' => 'Denna svårighetsgrad har blivit borttagen så den kan inte längre diskuteras.',
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
            'hidden' => 'Inga diskussioner matchar valt filter.',
        ],

        'message_hint' => [
            'in_general' => 'Detta inlägg kommer läggas upp på allmän beatmapset diskussion. För att modda denna beatmap, börja meddelandet med en tidsstämpel (e.x. 00:12:345).',
            'in_timeline' => 'För att modda flera tidsstämplar, lägg upp flera inlägg (ett inlägg för varje tidsstämpel).',
        ],

        'message_placeholder' => [
            'general' => 'Skriv här för att posta till General (:version)',
            'generalAll' => 'Skriv här för att posta till General (Alla svårighetsgrader)',
            'timeline' => 'Skriv här för att posta till Tidslinjen (:version)',
        ],

        'message_type' => [
            'disqualify' => 'Diskvalificera',
            'hype' => 'Hype!',
            'mapper_note' => 'Anteckning',
            'nomination_reset' => 'Återställ Nominering',
            'praise' => 'Beröm',
            'problem' => 'Problem',
            'suggestion' => 'Förslag',
        ],

        'mode' => [
            'events' => 'Historik',
            'general' => 'Allmänt :scope',
            'timeline' => 'Tidslinje',
            'scopes' => [
                'general' => 'Denna svårighetsgrad',
                'generalAll' => 'Alla svårighetsgrader',
            ],
        ],

        'new' => [
            'timestamp' => 'Tidsstämpel',
            'timestamp_missing' => 'Tryck ctrl-c i redigeringsläget och klistra in ditt meddelande för att lägga till en tidsstämpel!',
            'title' => 'Ny Diskussion',
        ],

        'show' => [
            'title' => ':title mappad av :mapper',
        ],

        'sort' => [
            '_' => 'Sorterade efter:',
            'created_at' => 'skapelsedatum',
            'timeline' => 'tidslinje',
            'updated_at' => 'senaste uppdatering',
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
        'button_done' => 'Redan hypad!',
        'confirm' => "Är du säker? Detta kommer att använda en av dina återstånde :n hypes och kan inte tas tillbaka.",
        'explanation' => 'Att lägga till beröm ❤ kommer höja denna beatmaps hype, vilket gör den mer synlig för nominering och rankning!',
        'explanation_guest' => 'Logga in och hypa denna beatmap för att göra den mer synlig för nomineringar och rankning!',
        'new_time' => "Du kommer att få en till hype :new_time.",
        'remaining' => 'Du har :remaining hypes kvar.',
        'required_text' => 'Hype: :current/:required',
        'section_title' => 'Hype Tåg',
        'title' => 'Hype',
    ],

    'feedback' => [
        'button' => 'Lämna Feedback',
    ],

    'nominations' => [
        'disqualification_prompt' => 'Anledning för diskvalificering?',
        'disqualified_at' => 'Diskvalificerad :time_ago (:reason).',
        'disqualified_no_reason' => 'inget anledning specificerad',
        'disqualify' => 'Diskvalificera',
        'incorrect_state' => 'Ett fel uppstod, pröva att uppdatera sidan.',
        'love' => 'Kärlek',
        'love_confirm' => 'Älskar du denna beatmap?',
        'nominate' => 'Nominera',
        'nominate_confirm' => 'Nominera denna beatmap?',
        'nominated_by' => 'nominerad av :users',
        'qualified' => 'Beräknad tid när den är rankad är :date, om inga fel hittas.',
        'qualified_soon' => 'Beräknat att den rankas snart, om inga fel hittas.',
        'required_text' => 'Nomineringar: :current/:required',
        'reset_message_deleted' => 'raderad',
        'title' => 'Nominering Status',
        'unresolved_issues' => 'Det finns fortfarande olösta problem som måste tas hand om först.',

        'reset_at' => [
            'nomination_reset' => 'Nomineringsprocessen återställdes :time_ago av :user med ett nytt problem :discussion (:message).',
            'disqualify' => 'Diskvalificerad :time_ago av :user med ett nytt problem :discussion (:message).',
        ],

        'reset_confirm' => [
            'nomination_reset' => 'Är du säker? Lägga upp ett nytt problem kommer återställa nomineringar.',
        ],
    ],

    'listing' => [
        'search' => [
            'prompt' => 'skriv in nyckelord...',
            'login_required' => 'Logga in för att söka.',
            'options' => 'Mer Sök Alternativ',
            'supporter_filter' => 'Filtrering av :filters kräver en aktiv osu!supporter tagg',
            'not-found' => 'inga resultat',
            'not-found-quote' => '... nope, ingenting hittades.',
            'filters' => [
                'general' => 'Allmänt',
                'mode' => 'Läge',
                'status' => 'Kategorier',
                'genre' => 'Genre',
                'language' => 'Språk',
                'extra' => 'extra',
                'rank' => 'Rank Uppnådd',
                'played' => 'Spelade',
            ],
            'sorting' => [
                'title' => 'titel',
                'artist' => 'artist',
                'difficulty' => 'svårighetsgrad',
                'updated' => 'uppdaterad',
                'ranked' => 'rankad',
                'rating' => 'omdöme',
                'plays' => 'spelad',
                'relevance' => 'relevans',
                'nominations' => 'nomineringar',
            ],
            'supporter_filter_quote' => [
                '_' => 'Filtrering av :filters kräver en aktiv :link',
                'link_text' => 'osu!supporter tagg',
            ],
        ],
    ],
    'general' => [
        'recommended' => 'Rekommenderad svårighetsgrad',
        'converts' => 'Inkludera konverterade beatmaps',
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
        'pending' => 'Pågående & WIP',
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
        'any' => 'Alla',
        'played' => 'Spelade',
        'unplayed' => 'Ej spelade',
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
