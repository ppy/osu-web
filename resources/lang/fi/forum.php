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
    'pinned_topics' => 'Kiinnitetyt Aiheet',
    'slogan' => "on vaarallista pelata yksin.",
    'subforums' => 'Alaforumit',
    'title' => 'osu!yhteisö',

    'covers' => [
        'create' => [
            '_' => 'Aseta kansikuva',
            'button' => 'Lataa kuva',
            'info' => '',
        ],

        'destroy' => [
            '_' => 'Poista kansikuva',
            'confirm' => 'Oletko varma, että haluat poistaa kansikuvan?',
        ],
    ],

    'email' => [
        'new_reply' => '',
    ],

    'forums' => [
        'topics' => [
            'empty' => 'Ei aiheita!',
        ],
    ],

    'post' => [
        'confirm_destroy' => 'Haluatko varmasti poistaa viestin?',
        'confirm_restore' => 'Haluatko varmasti palauttaa viestin?',
        'edited' => '',
        'posted_at' => 'lähetetty :when',

        'actions' => [
            'destroy' => 'Poista viesti',
            'restore' => 'Palauta viesti',
            'edit' => 'Muokkaa viestiä',
        ],
    ],

    'search' => [
        'go_to_post' => 'Siirry viestiin',
        'post_number_input' => 'anna viestin numero',
        'total_posts' => ':posts_count viestiä',
    ],

    'topic' => [
        'deleted' => 'poistettu aihe',
        'go_to_latest' => 'katso viimeisin viesti',
        'latest_post' => '',
        'latest_reply_by' => 'viimeisimmän vastauksen jätti :user',
        'new_topic' => 'Lähetä uusi aihe',
        'new_topic_login' => '',
        'post_reply' => 'Viesti',
        'reply_box_placeholder' => 'Kirjoita vastauksesi tähän',
        'started_by' => 'tehnyt :user',

        'create' => [
            'preview' => 'Esikatselu',
            // TL note: this is used in the topic reply preview, when
            // the user goes back from previewing to editing the reply
            'preview_hide' => 'Kirjoita',
            'submit' => 'Lähetä',

            'placeholder' => [
                'body' => 'Kirjoita viestin sisältö tähän',
                'title' => 'Määritä otsikko napsauttamalla tätä',
            ],
        ],

        'jump' => [
            'enter' => '',
            'first' => 'siirry ensimmäiseen viestiin',
            'last' => 'siirry viimeisimpään viestiin',
            'next' => '',
            'previous' => '',
        ],

        'post_edit' => [
            'cancel' => 'Peruuta',
            'post' => 'Tallenna',
        ],
    ],

    'topic_watches' => [
        'index' => [
            'title' => 'Forumin tilaukset',
            'title_compact' => '',
            'title_main' => '',

            'box' => [
                'total' => '',
                'unread' => '',
            ],

            'info' => [
                'total' => '',
                'unread' => '',
            ],
        ],

        'topic_buttons' => [
            'remove' => [
                'confirmation' => '',
                'title' => 'Peru tilaus',
            ],
        ],
    ],

    'topics' => [
        '_' => 'Aiheet',

        'actions' => [
            'reply' => 'Vastaa',
            'reply_with_quote' => 'Lainaa viestiä vastaukseen',
            'search' => 'Hae',
        ],

        'create' => [
            'create_poll' => 'Äänestyksen Luonti',

            'create_poll_button' => [
                'add' => 'Luo äänestys',
                'remove' => 'Keskeytä äänestyksen luonti',
            ],

            'poll' => [
                'length' => '',
                'length_days_suffix' => 'päivää',
                'length_info' => '',
                'max_options' => '',
                'max_options_info' => '',
                'options' => 'Asetukset',
                'options_info' => '',
                'title' => 'Kysymys',
                'vote_change' => 'Salli uudelleen äänestäminen.',
                'vote_change_info' => '',
            ],
        ],

        'edit_title' => [
            'start' => 'Muokkaa otsikkoa',
        ],

        'index' => [
            'views' => 'katsomiskertaa',
            'replies' => 'vastausta',
        ],

        'issue_tag_added' => [
            'to_0' => '',
            'to_0_done' => '',
            'to_1' => '',
            'to_1_done' => '',
        ],

        'issue_tag_assigned' => [
            'to_0' => '',
            'to_0_done' => '',
            'to_1' => '',
            'to_1_done' => '',
        ],

        'issue_tag_confirmed' => [
            'to_0' => '',
            'to_0_done' => '',
            'to_1' => '',
            'to_1_done' => '',
        ],

        'issue_tag_duplicate' => [
            'to_0' => '',
            'to_0_done' => '',
            'to_1' => '',
            'to_1_done' => '',
        ],

        'issue_tag_invalid' => [
            'to_0' => '',
            'to_0_done' => '',
            'to_1' => '',
            'to_1_done' => '',
        ],

        'issue_tag_resolved' => [
            'to_0' => '',
            'to_0_done' => '',
            'to_1' => '',
            'to_1_done' => '',
        ],

        'lock' => [
            'is_locked' => 'Tämä aihe on lukittu, eikä ole voidaan vastata',
            'to_0' => 'Avaa aihe',
            'to_0_done' => 'Aihe on avattu',
            'to_1' => 'Lukitse aihe',
            'to_1_done' => 'Aihe on lukittu',
        ],

        'moderate_move' => [
            'title' => 'Siirrä toiselle foorumille',
        ],

        'moderate_pin' => [
            'to_0' => 'Irrota aihe',
            'to_0_done' => 'Aihe on irrotettu',
            'to_1' => 'Kiinnitä aihe',
            'to_1_done' => 'Aihe on kiinnitetty',
            'to_2' => '',
            'to_2_done' => '',
        ],

        'show' => [
            'deleted-posts' => 'Poistetut viestit',
            'total_posts' => '',

            'feature_vote' => [
                'current' => '',
                'do' => '',

                'user' => [
                    'count' => '',
                    'current' => 'Sinulla on :votes jäljellä.',
                    'not_enough' => "Sinulla ei ole enään ääniä jäljellä",
                ],
            ],

            'poll' => [
                'vote' => 'Äänestä',

                'detail' => [
                    'end_time' => '',
                    'ended' => '',
                    'total' => '',
                ],
            ],
        ],

        'watch' => [
            'to_not_watching' => '',
            'to_watching' => '',
            'to_watching_mail' => '',
            'mail_disable' => '',
        ],
    ],
];
