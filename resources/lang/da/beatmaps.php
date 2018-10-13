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
            'error' => 'Kunne ikke gemme opslag',
        ],
    ],

    'discussion-votes' => [
        'update' => [
            'error' => 'Kunne ikke afgive stemme',
        ],
    ],

    'discussions' => [
        'allow_kudosu' => 'tillad kudosu',
        'delete' => 'slet',
        'deleted' => 'Slettet af :editor :delete_time.',
        'deny_kudosu' => 'nægt kudosu',
        'edit' => 'ændr',
        'edited' => 'Sidst redigeret af :editor :update_time.',
        'kudosu_denied' => 'Nægtet fra at kunne modtage kudosu.',
        'message_placeholder_deleted_beatmap' => 'Den her sværhedsgrad er blevet slettet så den må ikke blive diskuteret.',
        'message_type_select' => 'Vælg kommentar-type',
        'reply_notice' => 'Tryk enter for at svare.',
        'reply_placeholder' => 'Skriv dit svar her',
        'require-login' => 'Log ind for at slå op eller svare',
        'resolved' => 'Løst',
        'restore' => 'gendan',
        'title' => 'Diskussioner',

        'collapse' => [
            'all-collapse' => 'Kollaps alle',
            'all-expand' => 'Udvid alle',
        ],

        'empty' => [
            'empty' => 'Ingen diskussioner endnu!',
            'hidden' => 'Ingen diskussioner matchede det valgte filter.',
        ],

        'message_hint' => [
            'in_general' => 'Dette opslag vil lande i general beatmapset diskussionen. For at modde dette beatmap, start beskeden med et tidsstempel (f.eks. 00:12:345).',
            'in_timeline' => 'For at modde flere tidsstempler, slå flere tidsstempler op (kun et opslag pr. tidsstempel).',
        ],

        'message_placeholder' => [
            'general' => '',
            'generalAll' => '',
            'timeline' => '',
        ],

        'message_type' => [
            'disqualify' => 'Diskvalificer',
            'hype' => 'Hype!',
            'mapper_note' => 'Notat',
            'nomination_reset' => 'nulstil Nominering',
            'praise' => 'Hyldest',
            'problem' => 'Problem',
            'suggestion' => 'Forslag',
        ],

        'mode' => [
            'events' => 'Historie',
            'general' => 'Generalt :scope',
            'timeline' => 'Tidslinje',
            'scopes' => [
                'general' => 'Den her sværhedgrad',
                'generalAll' => 'Alle sværhedgrader',
            ],
        ],

        'new' => [
            'timestamp' => 'Tidsstempel',
            'timestamp_missing' => 'Tryk ctrl-c i edit mode og indsæt i din besked for at tilføje tidsstempel!',
            'title' => 'Ny diskussion',
        ],

        'show' => [
            'title' => ':title mappet af :mapper',
        ],

        'sort' => [
            '_' => 'Sorteret efter:',
            'created_at' => 'Dato for upload',
            'timeline' => 'tidslinje',
            'updated_at' => 'sidst opdateret',
        ],

        'stats' => [
            'deleted' => 'Slettet',
            'mapper_notes' => 'Notater',
            'mine' => 'Mine',
            'pending' => 'Afventende',
            'praises' => 'Hyldester',
            'resolved' => 'Løste',
            'total' => 'Alle',
        ],

        'status-messages' => [
            'approved' => 'Dette beatmap blev godkendt på :date!',
            'graveyard' => "Dette beatmap er ikke blevet opdateret siden :date og er højst sandsynligt blevet droppet af skaberen...",
            'loved' => 'Dette beatmap blev tilføjet til "Loved" på :date!',
            'ranked' => 'Dette beatmap blev ranked på :date!',
            'wip' => 'Notat: Dette beatmap er blevet markeret som "Under konstruktion" af skaberen.',
        ],

    ],

    'hype' => [
        'button' => 'Hype Beatmap!',
        'button_done' => 'Allerede Hypet!',
        'confirm' => "Er du sikker? Dette vil benytte 1 af dine resterende :n hypes og kan ikke fortrydes.",
        'explanation' => 'Hype denne beatmap for at gøre det mere synligt for nominering og ranking!',
        'explanation_guest' => 'Log ind og hype denne beatmap for at gøre det mere synligt for nominering og ranking!',
        'new_time' => "Du får en ny hype ved :new_time.",
        'remaining' => 'Du har :remaining hypes tilbage.',
        'required_text' => 'Hype: :current/:required',
        'section_title' => 'Hype Tog',
        'title' => 'Hype',
    ],

    'feedback' => [
        'button' => 'Efterlad Feedback',
    ],

    'nominations' => [
        'disqualification_prompt' => 'Årsag for diskvalifikation?',
        'disqualified_at' => 'Diskvalificeret :time_ago (:reason).',
        'disqualified_no_reason' => 'ingen årsag specificeret',
        'disqualify' => 'Diskvalificér',
        'incorrect_state' => 'Fejl under udførelse, try prøv at genindlæse siden.',
        'love' => '',
        'love_confirm' => '',
        'nominate' => 'Nominér',
        'nominate_confirm' => 'Nominér dette beatmap?',
        'nominated_by' => 'nomineret af :users',
        'qualified' => 'Forventet at blive ranked på :date, hvis ingen problemer bliver fundet.',
        'qualified_soon' => 'Forventet at blive ranked snart, hvis ingen problemer bliver fundet.',
        'required_text' => 'Nomineringer: :current/:required',
        'reset_message_deleted' => 'sletted',
        'title' => 'Nomineringstatus',
        'unresolved_issues' => 'Der er stadig uløste problemer der skal tages af først.',

        'reset_at' => [
            'nomination_reset' => 'Nominerings processen nulstillet :time_ago af :user med et nyt problem :discussion (:message).',
            'disqualify' => 'Diskvalificeret :time_ago af :user med et nyt problem :discussion (:message).',
        ],

        'reset_confirm' => [
            'nomination_reset' => 'Er du sikker? At slå et nyt problem op nulstiller nominations processen.',
        ],
    ],

    'listing' => [
        'search' => [
            'prompt' => 'skriv nøgleord...',
            'login_required' => '',
            'options' => 'Flere søgefunktioner',
            'supporter_filter' => '',
            'not-found' => 'ingen resultater',
            'not-found-quote' => '... desværre, intet fundet.',
            'filters' => [
                'general' => 'Generalt',
                'mode' => 'Mode',
                'status' => '',
                'genre' => 'Genre',
                'language' => 'Sprog',
                'extra' => 'extra',
                'rank' => 'Rank Opnået',
                'played' => '',
            ],
            'sorting' => [
                'title' => '',
                'artist' => '',
                'difficulty' => '',
                'updated' => '',
                'ranked' => '',
                'rating' => '',
                'plays' => '',
                'relevance' => '',
                'nominations' => '',
            ],
            'supporter_filter_quote' => [
                '_' => '',
                'link_text' => '',
            ],
        ],
    ],
    'general' => [
        'recommended' => 'Rekommenderat sværhedsgrad',
        'converts' => 'Inkluder konvertert beatmeaps',
    ],
    'mode' => [
        'any' => 'Alle',
        'osu' => 'osu!',
        'taiko' => 'osu!taiko',
        'fruits' => 'osu!catch',
        'mania' => 'osu!mania',
    ],
    'status' => [
        'any' => 'Vilkårlig',
        'ranked-approved' => 'Ranked & Godkendt',
        'approved' => 'Godkendt',
        'qualified' => 'Kvalificeret',
        'loved' => 'Loved',
        'faves' => 'Favoritter',
        'pending' => '',
        'graveyard' => 'Kirkegård',
        'my-maps' => 'Mine Maps',
    ],
    'genre' => [
        'any' => 'Vilkårlig',
        'unspecified' => 'Uspecificeret',
        'video-game' => 'Computerspil',
        'anime' => 'Anime',
        'rock' => 'Rock',
        'pop' => 'Pop',
        'other' => 'Andre',
        'novelty' => 'Novelty',
        'hip-hop' => 'Hip Hop',
        'electronic' => 'Electronisk',
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
        'NM' => 'No mods',
        'PF' => 'Perfect',
        'Relax' => 'Relax',
        'SD' => 'Sudden Death',
        'SO' => 'Spun Out',
        'TD' => 'Touch Device',
    ],
    'language' => [
        'any' => 'Vilkårlig',
        'english' => 'Engelsk',
        'chinese' => 'Kinesisk',
        'french' => 'Fransk',
        'german' => 'Tysk',
        'italian' => 'Italiensk',
        'japanese' => 'Japansk',
        'korean' => 'Koreansk',
        'spanish' => 'Spansk',
        'swedish' => 'Svensk',
        'instrumental' => 'Instrumentalt',
        'other' => 'Andet',
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
        'any' => 'Vilkårlig',
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
