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
    'pinned_topics' => 'Gepinde Onderwerpen',
    'subforums' => 'Subfora',
    'title' => 'osu!community',

    'covers' => [
        'create' => [
            '_' => 'Stel cover afbeelding in',
            'button' => 'Afbeelding uploaden',
            'info' => 'Cover groote moet :dimensions zijn. Je kunt ook een afbeelding hier loslaten om hem te uploaden.',
        ],

        'destroy' => [
            '_' => 'Verwijder cover afbeelding',
            'confirm' => 'Weet je zeker dat je de cover afbeelding wilt verwijderen?',
        ],
    ],

    'post' => [
        'confirm_delete' => 'Echt deze post verwijderen?',
        'edited' => 'Laatst bewerkt door :user op :when. :count keer bewerkt.',
        'posted_at' => 'gepost op :when',

        'actions' => [
            'delete' => 'Verwijder post',
            'edit' => 'Bewerk post',
        ],
    ],

    'search' => [
        'go_to_post' => 'Ga naar post',
        'post_number_input' => 'geef post nummer',
        'total_posts' => ':posts_count posts',
    ],

    'topic' => [
        'go_to_latest' => 'bekijk nieuwste post',
        'latest_post' => ':when door :user',
        'latest_reply_by' => 'laatste bericht door :user',
        'new_topic' => 'Maak nieuw onderwerp',
        'post_reply' => 'Post',
        'reply_box_placeholder' => 'Typ hier om te antwoorden',
        'started_by' => 'door :user',

        'create' => [
            'preview' => 'Voorbeeld',
            'submit' => 'Post',

            'placeholder' => [
                'body' => 'Typ post inhoud hier',
                'title' => 'Klik hier om een titel in te stellen',
            ],
        ],

        'jump' => [
            'enter' => 'klik hier om een specifiek postnummer op te geven',
            'first' => 'ga naar eerste post',
            'last' => 'ga naar laatste post',
            'next' => 'sla 10 posts over',
            'previous' => 'ga 10 posts terug',
        ],

        'post_edit' => [
            'cancel' => 'Annuleren',
            'post' => 'Opslaan',
            'zoom' => [
                'start' => 'Volledig Scherm',
                'end' => 'Volledig Scherm Afsluiten',
            ],
        ],
    ],

    'topics' => [
        '_' => 'Onderwerpen',

        'actions' => [
            'reply_with_quote' => 'Citeer post voor antwoord',
        ],

        'index' => [
            'views' => 'keer bekeken',
            'replies' => 'keer beantwoordt',
        ],

        'lock' => [
            'locked-0' => 'Onderwerp is ontgrendeld',
            'locked-1' => 'Onderwerp is gesloten',
            'is_locked' => 'Dit onderwerp is gesloten en kan niet meer op beantwoord worden',
        ],

        'moderate_move' => [
            'title' => 'Verplaats naar een ander forum',
        ],

        'show' => [
            'feature_vote' => [
                'current' => 'Prioriteit: +:count',
                'do' => 'Promoot dit verzoek',

                'user' => [
                    'count' => '{0} geen stemmen|{1} :count stem|[2,*] :count stemmen',
                    'current' => 'Je hebt :votes stemmen over.',
                    'not_enough' => 'Je hebt geen stemmen meer over',
                ],
            ],
        ],
    ],
];
