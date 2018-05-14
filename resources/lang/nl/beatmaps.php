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
            'error' => 'Opslaan van post mislukt',
        ],
    ],

    'discussion-votes' => [
        'update' => [
            'error' => 'Stem bijwerken mislukt',
        ],
    ],

    'discussions' => [
        'allow_kudosu' => 'allow kudosu',
        'delete' => 'delete',
        'deleted' => 'Deleted by :editor :delete_time.',
        'deny_kudosu' => 'deny kudosu',
        'edit' => 'bewerk',
        'edited' => 'Laatst bewerkt door :editor :update_time',
        'kudosu_denied' => 'Denied from obtaining kudosu.',
        'message_placeholder' => 'Typ hier om te posten',
        'message_placeholder_deleted_beatmap' => 'This difficulty has been deleted so it may no longer be discussed.',
        'message_type_select' => 'Selecteer Commentaartype',
        'reply_notice' => 'Press enter to reply.',
        'reply_placeholder' => 'Type your response here',
        'require-login' => 'Log in om te posten of te antwoorden',
        'resolved' => 'Opgelost',
        'restore' => 'restore',
        'title' => 'Discussions',

        'collapse' => [
            'all-collapse' => 'Sluit alles',
            'all-expand' => 'Open alles',
        ],

        'empty' => [
            'empty' => 'Nog geen bestaande discussie!',
            'hidden' => 'No discussion matches selected filter.',
        ],

        'message_hint' => [
            'in_general' => 'Deze post gaat naar de algemene beatmapset discussie. Om deze map te modden moet je beginnen met een tijdstip (bijv. 00:12:345).',
            'in_timeline' => 'Om meerdere tijdstippen te modden moet je meerdere keren posten (een post per tijdstip).',
        ],

        'message_type' => [
            'disqualify' => 'Disqualify',
            'hype' => 'Hype!',
            'mapper_note' => 'Note',
            'nomination_reset' => 'Reset Nomination',
            'praise' => 'Lof',
            'problem' => 'Probleem',
            'suggestion' => 'Suggestie',
        ],

        'mode' => [
            'events' => 'History',
            'general' => 'General :scope',
            'timeline' => 'Tijdlijn',
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
            'title' => 'Beatmapdiscussie',
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
            'mine' => 'Van Mij',
            'pending' => 'Afwachtend',
            'praises' => 'Aangeprezen',
            'resolved' => 'Opgelost',
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
        'disqualification_prompt' => 'Reason for disqualification?',
        'disqualified_at' => 'Disqualified :time_ago (:reason).',
        'disqualified_no_reason' => 'no reason specified',
        'disqualify' => 'Disqualify',
        'incorrect_state' => 'Error performing that action, try refreshing the page.',
        'nominate' => 'Nominate',
        'nominate_confirm' => 'Nominate this beatmap?',
        'nominated_by' => 'nominated by :users',
        'qualified' => 'Estimated to be ranked :date, if no issues are found.',
        'qualified_soon' => 'Estimated to be ranked soon, if no issues are found.',
        'required_text' => 'Nominations: :current/:required',
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
            'prompt' => 'typ sleutelwoorden in...',
            'options' => 'Meer Zoekopties',
            'not-found' => 'geen resultaten',
            'not-found-quote' => '... nope, niets gevonden.',
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
        'mode' => 'Modus',
        'status' => 'Rank Status',
        'mapped-by' => 'gemapped door :mapper',
        'source' => 'van :source',
        'load-more' => 'Laad meer...',
    ],
    'general' => [
        'recommended' => 'Recommended difficulty',
        'converts' => 'Include converted beatmaps',
    ],
    'mode' => [
        'any' => 'Alles',
        'osu' => 'osu!',
        'taiko' => 'osu!taiko',
        'fruits' => 'osu!catch',
        'mania' => 'osu!mania',
    ],
    'status' => [
        'any' => 'Alles',
        'ranked-approved' => 'Gerankt & Goedgekeurd',
        'approved' => 'Goedgekeurd',
        'qualified' => 'Qualified',
        'loved' => 'Loved',
        'faves' => 'Favorieten',
        'pending' => 'Afwachtend',
        'graveyard' => 'Begraafplaats',
        'my-maps' => 'Mijn Mappen',
    ],
    'genre' => [
        'any' => 'Alles',
        'unspecified' => 'Niet Gespecificeerd',
        'video-game' => 'Video Game',
        'anime' => 'Anime',
        'rock' => 'Rock',
        'pop' => 'Pop',
        'other' => 'Anders',
        'novelty' => 'Novelty',
        'hip-hop' => 'Hip Hop',
        'electronic' => 'Electronic',
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
        'any' => 'Any',
        'played' => 'Played',
        'unplayed' => 'Unplayed',
    ],
    'extra' => [
        'video' => 'Heeft Video',
        'storyboard' => 'Heeft Storyboard',
    ],
    'rank' => [
        'any' => 'Alles',
        'XH' => 'Zilveren SS',
        'X' => 'SS',
        'SH' => 'Zilveren S',
        'S' => 'S',
        'A' => 'A',
        'B' => 'B',
        'C' => 'C',
        'D' => 'D',
    ],
];
