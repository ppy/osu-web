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
            'error' => 'Opslaan van post mislukt',
        ],
    ],

    'discussion-votes' => [
        'update' => [
            'error' => 'Stem bijwerken mislukt',
        ],
    ],

    'discussions' => [
        'allow_kudosu' => '',
        'delete' => '',
        'deleted' => '',
        'deny_kudosu' => '',
        'edit' => 'bewerk',
        'edited' => 'Laatst bewerkt door :editor :update_time',
        'kudosu_denied' => '',
        'message_placeholder' => 'Typ hier om te posten',
        'message_placeholder_deleted_beatmap' => '',
        'message_type_select' => 'Selecteer Commentaartype',
        'reply_notice' => '',
        'reply_placeholder' => '',
        'require-login' => 'Log in om te posten of te antwoorden',
        'resolved' => 'Opgelost',
        'restore' => '',
        'title' => '',

        'collapse' => [
            'all-collapse' => 'Sluit alles',
            'all-expand' => 'Open alles',
        ],

        'empty' => [
            'empty' => 'Nog geen bestaande discussie!',
            'hidden' => '',
        ],

        'message_hint' => [
            'in_general' => 'Deze post gaat naar de algemene beatmapset discussie. Om deze map te modden moet je beginnen met een tijdstip (bijv. 00:12:345).',
            'in_timeline' => 'Om meerdere tijdstippen te modden moet je meerdere keren posten (een post per tijdstip).',
        ],

        'message_type' => [
            'disqualify' => '',
            'hype' => '',
            'mapper_note' => '',
            'nomination_reset' => '',
            'praise' => 'Lof',
            'problem' => 'Probleem',
            'suggestion' => 'Suggestie',
        ],

        'mode' => [
            'events' => '',
            'general' => '',
            'timeline' => 'Tijdlijn',
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
            'title' => 'Beatmapdiscussie',
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
            'mine' => 'Van Mij',
            'pending' => 'Afwachtend',
            'praises' => 'Aangeprezen',
            'resolved' => 'Opgelost',
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
        'disqualification_prompt' => '',
        'disqualified_at' => '',
        'disqualified_no_reason' => '',
        'disqualify' => '',
        'incorrect_state' => '',
        'nominate' => '',
        'nominate_confirm' => '',
        'nominated_by' => '',
        'qualified' => '',
        'qualified_soon' => '',
        'required_text' => '',
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
            'prompt' => 'typ sleutelwoorden in...',
            'options' => 'Meer Zoekopties',
            'not-found' => 'geen resultaten',
            'not-found-quote' => '... nope, niets gevonden.',
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
        'mode' => 'Modus',
        'status' => '',
        'mapped-by' => 'gemapped door :mapper',
        'source' => 'van :source',
        'load-more' => 'Laad meer...',
    ],
    'general' => [
        'recommended' => '',
        'converts' => '',
    ],
    'mode' => [
        'any' => 'Alles',
        'osu' => '',
        'taiko' => '',
        'fruits' => '',
        'mania' => '',
    ],
    'status' => [
        'any' => 'Alles',
        'ranked-approved' => 'Gerankt & Goedgekeurd',
        'approved' => 'Goedgekeurd',
        'qualified' => '',
        'loved' => '',
        'faves' => 'Favorieten',
        'pending' => 'Afwachtend',
        'graveyard' => 'Begraafplaats',
        'my-maps' => 'Mijn Mappen',
    ],
    'genre' => [
        'any' => 'Alles',
        'unspecified' => 'Niet Gespecificeerd',
        'video-game' => '',
        'anime' => '',
        'rock' => '',
        'pop' => '',
        'other' => 'Anders',
        'novelty' => '',
        'hip-hop' => '',
        'electronic' => '',
    ],
    'mods' => [
        '4K' => '',
        '5K' => '',
        '6K' => '',
        '7K' => '',
        '8K' => '',
        '9K' => '',
        'AP' => '',
        'DT' => '',
        'EZ' => '',
        'FI' => '',
        'FL' => '',
        'HD' => '',
        'HR' => '',
        'HT' => '',
        'NC' => '',
        'NF' => '',
        'NM' => '',
        'PF' => '',
        'Relax' => '',
        'SD' => '',
        'SO' => '',
        'TD' => '',
    ],
    'language' => [
        'any' => 'Alles',
        'english' => 'Engels',
        'chinese' => 'Chinees',
        'french' => 'Frans',
        'german' => 'Duits',
        'italian' => 'Italiaans',
        'japanese' => 'Japans',
        'korean' => 'Koreaans',
        'spanish' => 'Spaans',
        'swedish' => 'Zweeds',
        'instrumental' => 'Instrumentaal',
        'other' => 'Anders',
    ],
    'played' => [
        'any' => '',
        'played' => '',
        'unplayed' => '',
    ],
    'extra' => [
        'video' => 'Heeft Video',
        'storyboard' => 'Heeft Storyboard',
    ],
    'rank' => [
        'any' => 'Alles',
        'XH' => 'Zilveren SS',
        'X' => '',
        'SH' => 'Zilveren S',
        'S' => '',
        'A' => '',
        'B' => '',
        'C' => '',
        'D' => '',
    ],
];
