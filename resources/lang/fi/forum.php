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
    'title' => 'osu! foorumit',

    'covers' => [
        'create' => [
            '_' => 'Aseta kansikuva',
            'button' => 'Lataa kuva',
            'info' => 'Kansikuvan koko kuuluisi olla :dimensions. Voit upottaa kuvan myös tähän.',
        ],

        'destroy' => [
            '_' => 'Poista kansikuva',
            'confirm' => 'Oletko varma, että haluat poistaa kansikuvan?',
        ],
    ],

    'email' => [
        'new_reply' => '[osu!] Uusi vastaus aiheessa ":title"',
    ],

    'forums' => [
        'topics' => [
            'empty' => 'Ei aiheita!',
        ],
    ],

    'post' => [
        'confirm_destroy' => 'Haluatko varmasti poistaa viestin?',
        'confirm_restore' => 'Haluatko varmasti palauttaa viestin?',
        'edited' => 'Viimeksi muokannut :user :when, muokattu yhteensä :count kertaa.',
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
        'latest_post' => ':when käyttäjältä :user',
        'latest_reply_by' => 'viimeisimmän vastauksen jätti :user',
        'new_topic' => 'Lähetä uusi aihe',
        'new_topic_login' => 'Kirjaudu sisään lähettääksesi uuden aiheen',
        'post_reply' => 'Vastaa',
        'reply_box_placeholder' => 'Kirjoita vastauksesi tähän',
        'reply_title_prefix' => 'Re',
        'started_by' => 'tehnyt :user',
        'started_by_verbose' => '',

        'create' => [
            'preview' => 'Esikatselu',
            // TL note: this is used in the topic reply preview, when
            // the user goes back from previewing to editing the reply
            'preview_hide' => 'Kirjoita',
            'submit' => 'Lähetä',

            'necropost' => [
                'default' => 'Tämä aihealue on ollut epäaktiivinen lähiaikoina. Postaa tänne vain jos sinulla on hyvä syy siihen.',

                'new_topic' => [
                    '_' => "",
                    'create' => 'luo uusi aihe',
                ],
            ],

            'placeholder' => [
                'body' => 'Kirjoita aiheen sisältö tähän',
                'title' => 'Määritä otsikko napsauttamalla tätä',
            ],
        ],

        'jump' => [
            'enter' => 'paina siirtyäksesi haluamaasi viestin numeroon',
            'first' => 'siirry ensimmäiseen viestiin',
            'last' => 'siirry viimeisimpään viestiin',
            'next' => 'ohita seuraavat 10 viestiä',
            'previous' => 'mene 10 viestiä takaisin',
        ],

        'post_edit' => [
            'cancel' => 'Peruuta',
            'post' => 'Tallenna',
        ],
    ],

    'topic_watches' => [
        'index' => [
            'title' => 'Foorumilla Seuratut',
            'title_compact' => 'foorumilla seuratut',
            'title_main' => 'foorumilla <strong>Seuratut</strong>',

            'box' => [
                'total' => 'Seurattuja aiheita',
                'unread' => 'Aiheita uusilla vastauksilla',
            ],

            'info' => [
                'total' => 'Olet seurannut :total aihetta.',
                'unread' => 'Sinulla on :unread lukematonta vastausta seuratuissa aiheissa.',
            ],
        ],

        'topic_buttons' => [
            'remove' => [
                'confirmation' => 'Lopeta aiheen seuraaminen?',
                'title' => 'Lopeta seuraaminen',
            ],
        ],
    ],

    'topics' => [
        '_' => 'Aiheet',

        'actions' => [
            'login_reply' => 'Kirjaudu sisään Vastataksesi',
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
                'length' => 'Pidä äänestystä auki',
                'length_days_suffix' => 'päivää',
                'length_info' => 'Jätä tyhjä jos haluat loputtoman kyselyn',
                'max_options' => 'Vastauksia per käyttäjä',
                'max_options_info' => 'Määrä vaihtoehtoja, joita käyttäjä voi valita äänestyksen aikana.',
                'options' => 'Asetukset',
                'options_info' => 'Jokaiselle valinnalle tulee uusi rivi. Vaihtoehtoja on korkeintaan 10.',
                'title' => 'Kysymys',
                'vote_change' => 'Salli uudelleenäänestys.',
                'vote_change_info' => 'Vastaajat voivat vaihtaa ääniään, jos tämä on käytössä.',
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
            'to_0' => 'Poista tunniste "lisätty" ',
            'to_0_done' => 'Tunniste "lisätty" poistettu',
            'to_1' => 'Lisää tunniste "lisätty"',
            'to_1_done' => 'Tunniste "lisätty" lisätty',
        ],

        'issue_tag_assigned' => [
            'to_0' => 'Poista tunniste "siirretty"',
            'to_0_done' => 'Tunniste "siirretty" poistettu',
            'to_1' => 'Lisää tunniste "siirretty"',
            'to_1_done' => 'Tunniste "siirretty" lisätty',
        ],

        'issue_tag_confirmed' => [
            'to_0' => 'Poista tunniste "vahvistettu"',
            'to_0_done' => 'Tunniste "vahvistettu" poistettu',
            'to_1' => 'Lisää tunniste "vahvistettu"',
            'to_1_done' => 'Tunniste "vahvistettu" lisätty',
        ],

        'issue_tag_duplicate' => [
            'to_0' => 'Poista tunniste "duplikaatti"',
            'to_0_done' => 'Tunniste "duplikaatti" poistettu',
            'to_1' => 'Lisää tunniste "duplikaatti"',
            'to_1_done' => 'Tunniste "duplikaatti" lisätty',
        ],

        'issue_tag_invalid' => [
            'to_0' => 'Poista tunniste "virheellinen"',
            'to_0_done' => 'Tunniste "virheellinen" poistettu',
            'to_1' => 'Lisää tunniste "virheellinen"',
            'to_1_done' => 'Lisää tunniste "virheellinen"',
        ],

        'issue_tag_resolved' => [
            'to_0' => 'Poista tunniste "selvitetty"',
            'to_0_done' => 'Tunniste "selvitetty" poistettu',
            'to_1' => 'Lisää tunniste "selvitetty"',
            'to_1_done' => 'Lisää tunniste "selvitetty"',
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
            'to_2' => 'Kiinnitä aihe ja merkkaa ilmoitukseksi',
            'to_2_done' => 'Aihe on kiinnitetty ja merkattu ilmoitukseksi',
        ],

        'show' => [
            'deleted-posts' => 'Poistetut aiheet',
            'total_posts' => 'Vastauksia',

            'feature_vote' => [
                'current' => 'Tärkeys tällä hetkellä: +:count',
                'do' => 'Ehdota tätä pyyntöä',

                'user' => [
                    'count' => '{0} ei ääniä |{1}:count ääni|[2,*]:count ääntä',
                    'current' => 'Sinulla on :votes jäljellä.',
                    'not_enough' => "Sinulla ei ole enään ääniä jäljellä",
                ],
            ],

            'poll' => [
                'vote' => 'Äänestä',

                'detail' => [
                    'end_time' => 'Kysely loppuu :time',
                    'ended' => 'Kysely on loppunut :time',
                    'total' => 'Ääniä yhteensä: :count',
                ],
            ],
        ],

        'watch' => [
            'to_not_watching' => 'Lisäämättä kirjanmerkkeihin',
            'to_watching' => 'Kirjanmerkkeihin',
            'to_watching_mail' => 'Kirjanmerkkeihin ilmoituksella',
            'mail_disable' => 'Poista ilmoitukset käytöstä',
        ],
    ],
];
