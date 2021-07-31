<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'pinned_topics' => 'Kiinnitetyt Aiheet',
    'slogan' => "on vaarallista pelata yksin.",
    'subforums' => 'Alafoorumit',
    'title' => 'osu!-foorumit',

    'covers' => [
        'edit' => '',

        'create' => [
            '_' => 'Aseta kansikuva',
            'button' => 'Lataa kuva',
            'info' => 'Kansikuvan koon kuuluisi olla :dimensions. Voit upottaa kuvan myös tähän.',
        ],

        'destroy' => [
            '_' => 'Poista kansikuva',
            'confirm' => 'Haluatko varmasti poistaa kansikuvan?',
        ],
    ],

    'forums' => [
        'latest_post' => '',

        'index' => [
            'title' => '',
        ],

        'topics' => [
            'empty' => 'Ei aiheita!',
        ],
    ],

    'mark_as_read' => [
        'forum' => 'Merkitse luetuksi',
        'forums' => 'Merkitse luetuksi',
        'busy' => 'Merkitään luetuksi...',
    ],

    'post' => [
        'confirm_destroy' => 'Haluatko varmasti poistaa viestin?',
        'confirm_restore' => 'Haluatko varmasti palauttaa viestin?',
        'edited' => 'Viimeksi muokannut :user :when, muokattu yhteensä :count kertaa.',
        'posted_at' => 'lähetetty :when',
        'posted_by' => '',

        'actions' => [
            'destroy' => 'Poista viesti',
            'edit' => 'Muokkaa viestiä',
            'report' => '',
            'restore' => 'Palauta viesti',
        ],

        'create' => [
            'title' => [
                'reply' => 'Uusi vastaus',
            ],
        ],

        'info' => [
            'post_count' => ':count_delimited viesti|:count_delimited viestiä',
            'topic_starter' => 'Aiheen Aloittaja',
        ],
    ],

    'search' => [
        'go_to_post' => 'Siirry viestiin',
        'post_number_input' => 'anna viestin numero',
        'total_posts' => ':posts_count viestiä',
    ],

    'topic' => [
        'confirm_destroy' => 'Haluatko varmasti poistaa aiheen?',
        'confirm_restore' => 'Haluatko varmasti palauttaa aiheen?',
        'deleted' => 'poistettu aihe',
        'go_to_latest' => 'näytä viimeisin viesti',
        'has_replied' => 'Olet vastannut tähän aiheeseen',
        'in_forum' => '',
        'latest_post' => ':when käyttäjältä :user',
        'latest_reply_by' => 'viimeisimmän vastauksen jätti :user',
        'new_topic' => 'Lähetä uusi aihe',
        'new_topic_login' => 'Kirjaudu sisään lähettääksesi uuden aiheen',
        'post_reply' => 'Vastaa',
        'reply_box_placeholder' => 'Kirjoita vastauksesi tähän',
        'reply_title_prefix' => 'Re',
        'started_by' => 'tehnyt :user',
        'started_by_verbose' => 'aloittanut :user',

        'actions' => [
            'destroy' => 'Poista aihe',
            'restore' => 'Palauta aihe',
        ],

        'create' => [
            'close' => 'Sulje',
            'preview' => 'Esikatselu',
            // TL note: this is used in the topic reply preview, when
            // the user goes back from previewing to editing the reply
            'preview_hide' => 'Kirjoita',
            'submit' => 'Lähetä',

            'necropost' => [
                'default' => 'Tämä aihealue on ollut epäaktiivinen lähiaikoina. Postaa tänne vain jos sinulla on hyvä syy siihen.',

                'new_topic' => [
                    '_' => "Tämä aihe on ollut epäaktiivisena jo pidemmän aikaa. :create jos sinulla ei ole hyvää syytä lähettää viestiä.",
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
            'title_compact' => 'foorumilla seuratut',

            'box' => [
                'total' => 'Seurattuja aiheita',
                'unread' => 'Aiheita joissa uusia vastauksia',
            ],

            'info' => [
                'total' => ':total aihetta seurattavana.',
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
            'login_reply' => 'Kirjaudu sisään vastataksesi',
            'reply' => 'Vastaa',
            'reply_with_quote' => 'Lainaa viestiä vastaukseen',
            'search' => 'Hae',
        ],

        'create' => [
            'create_poll' => 'Äänestyksen Luonti',

            'preview' => 'Viestin esikatselu',

            'create_poll_button' => [
                'add' => 'Luo äänestys',
                'remove' => 'Keskeytä äänestyksen luonti',
            ],

            'poll' => [
                'hide_results' => 'Piilota äänestyksen tulokset.',
                'hide_results_info' => '',
                'length' => 'Pidä äänestystä auki',
                'length_days_suffix' => 'päivää',
                'length_info' => 'Jätä tyhjäksi jos haluat kyselyn kestävän ikuisesti',
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
            'feature_votes' => 'tähtitaso',
            'replies' => 'vastausta',
            'views' => 'katsomiskertaa',
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
            'is_locked' => 'Tämä aihe on lukittu, eikä siihen voida vastata',
            'to_0' => 'Avaa aihe',
            'to_0_confirm' => '',
            'to_0_done' => 'Aihe on avattu',
            'to_1' => 'Lukitse aihe',
            'to_1_confirm' => 'Lukitse aihe?',
            'to_1_done' => 'Aihe lukittu',
        ],

        'moderate_move' => [
            'title' => 'Siirrä toiselle foorumille',
        ],

        'moderate_pin' => [
            'to_0' => 'Irrota aihe',
            'to_0_confirm' => 'Irrota aihe?',
            'to_0_done' => 'Aihe irrotettu',
            'to_1' => 'Kiinnitä aihe',
            'to_1_confirm' => 'Kiinnitä aihe?',
            'to_1_done' => 'Aihe kiinnitetty',
            'to_2' => 'Kiinnitä aihe ja merkkaa ilmoitukseksi',
            'to_2_confirm' => 'Kiinnitä aihe ja merkkaa ilmoitukseksi?',
            'to_2_done' => 'Aihe on kiinnitetty ja merkattu ilmoitukseksi',
        ],

        'moderate_toggle_deleted' => [
            'show' => 'Näytä poistetut viestit',
            'hide' => 'Piilota poistetut viestit',
        ],

        'show' => [
            'deleted-posts' => 'Poistetut viestit',
            'total_posts' => 'Vastauksia',

            'feature_vote' => [
                'current' => 'Tärkeys tällä hetkellä: +:count',
                'do' => 'Ehdota tätä',

                'info' => [
                    '_' => 'Tämä on :feature_request. :supporters voivat äänestää ominaisuuspyyntöjä.',
                    'feature_request' => 'ominaisuuspyyntö',
                    'supporters' => 'tukijat',
                ],

                'user' => [
                    'count' => '{0} ei ääniä |{1}:count ääni|[2,*]:count ääntä',
                    'current' => 'Sinulla on :votes jäljellä.',
                    'not_enough' => "Sinulla ei ole enää ääniä jäljellä",
                ],
            ],

            'poll' => [
                'edit' => '',
                'edit_warning' => '',
                'vote' => 'Äänestä',

                'button' => [
                    'change_vote' => '',
                    'edit' => '',
                    'view_results' => '',
                    'vote' => 'Äänestä',
                ],

                'detail' => [
                    'end_time' => 'Kysely loppuu :time',
                    'ended' => 'Kysely on loppunut :time',
                    'results_hidden' => 'Tulokset näytetään äänestyksen jälkeen.',
                    'total' => 'Ääniä yhteensä: :count',
                ],
            ],
        ],

        'watch' => [
            'to_not_watching' => 'Lisäämättä kirjanmerkkeihin',
            'to_watching' => 'Kirjanmerkkeihin',
            'to_watching_mail' => 'Kirjanmerkkeihin ilmoituksella',
            'tooltip_mail_disable' => 'Ilmoitus on päällä. Klikkaa poistaaksesi käytöstä',
            'tooltip_mail_enable' => 'Ilmoitus on pois käytöstä. Klikkaa laittaaksesi päälle',
        ],
    ],
];
