<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'pinned_topics' => 'Kiinnitetyt Aiheet',
    'slogan' => "on vaarallista pelata yksin.",
    'subforums' => 'Alafoorumit',
    'title' => 'osu!-foorumit',

    'covers' => [
        'edit' => 'Muokkaa kantta',

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
        'forums' => 'Foorumit',
        'latest_post' => 'Viimeisin viesti',

        'index' => [
            'title' => 'Foorumien listaus',
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
        'posted_by_in' => 'lähettänyt :username foorumille :forum',

        'actions' => [
            'destroy' => 'Poista viesti',
            'edit' => 'Muokkaa viestiä',
            'report' => 'Ilmoita viesti',
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
        'go_to_unread' => '',
        'has_replied' => 'Olet vastannut tähän aiheeseen',
        'in_forum' => ':forum -foorumissa',
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

        'logs' => [
            '_' => 'Aiheen lokit',
            'button' => 'Selaa aiheen lokeja',

            'columns' => [
                'action' => 'Toiminto',
                'date' => 'Päivämäärä',
                'user' => 'Käyttäjä',
            ],

            'data' => [
                'add_tag' => 'lisätty tunniste ":tag"',
                'announcement' => 'aihe kiinnitetty ja merkitty tiedotteeksi',
                'edit_topic' => 'otsikoksi :title',
                'fork' => 'aiheesta :topic',
                'pin' => 'aihe kiinnitetty',
                'post_operation' => 'lähettänyt :username',
                'remove_tag' => 'poistettu tunniste ":tag"',
                'source_forum_operation' => 'foorumista :forum',
                'unpin' => 'aihe irrotettu',
            ],

            'no_results' => 'lokeja ei löytynyt...',

            'operations' => [
                'delete_post' => 'Poistettu viesti',
                'delete_topic' => 'Poistettu aihe',
                'edit_topic' => 'Vaihdettu aiheen otsikkoa',
                'edit_poll' => 'Muokattu aiheen kyselyä',
                'fork' => 'Aihe kopioitu',
                'issue_tag' => 'Tunniste myönnetty',
                'lock' => 'Lukittu aihe',
                'merge' => 'Yhdistetty viestejä tähän aiheeseen',
                'move' => 'Aihe siirretty',
                'pin' => 'Kiinnitetty aihe',
                'post_edited' => 'Muokattu viestiä',
                'restore_post' => 'Viesti palautettu',
                'restore_topic' => 'Aihe palautettu',
                'split_destination' => 'Siirretty jaetut viestit',
                'split_source' => 'Jaettu viestit',
                'topic_type' => 'Asetettu aiheen tyyppi',
                'topic_type_changed' => 'Vaihdettu aiheen tyyppiä',
                'unlock' => 'Avattu aihe',
                'unpin' => 'Irrotettu aihe',
                'user_lock' => 'Lukittu oma aihe',
                'user_unlock' => 'Avattu oma aihe',
            ],
        ],

        'post_edit' => [
            'cancel' => 'Peruuta',
            'post' => 'Tallenna',
        ],
    ],

    'topic_watches' => [
        'index' => [
            'title_compact' => 'foorumiaiheiden seurantalista',

            'box' => [
                'total' => 'Seurattuja aiheita',
                'unread' => 'Aiheita, joissa on uusia vastauksia',
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
                'hide_results_info' => 'Ne näytetään vasta sen jälkeen, kun keyselyaika on päättynyt.',
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

        'lock' => [
            'is_locked' => 'Tämä aihe on lukittu, eikä siihen voida vastata',
            'to_0' => 'Avaa aihe',
            'to_0_confirm' => 'Poista foorumiaiheen lukitus?',
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
            'to_2' => 'Kiinnitä aihe ja merkitse tiedotteeksi',
            'to_2_confirm' => 'Kiinnitetäänkö aihe ja merkitään tiedotteeksi?',
            'to_2_done' => 'Aihe on kiinnitetty ja merkitty tiedotteeksi',
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
                'do' => 'Ehdota tätä pyyntöä',

                'info' => [
                    '_' => 'Tämä on :feature_request. :supporters voivat äänestää ominaisuuspyyntöjä.',
                    'feature_request' => 'ominaisuuspyyntö',
                    'supporters' => 'Tukijat',
                ],

                'user' => [
                    'count' => '{0} ei ääniä |{1}:count ääni|[2,*]:count ääntä',
                    'current' => 'Sinulla on :votes jäljellä.',
                    'not_enough' => "Sinulla ei ole enää ääniä jäljellä",
                ],
            ],

            'poll' => [
                'edit' => 'Kyselyn muokkaus',
                'edit_warning' => 'Kyselyn muokkaaminen poistaa nykyiset tulokset!',
                'vote' => 'Äänestä',

                'button' => [
                    'change_vote' => 'Muuta valikoima',
                    'edit' => 'Muokkaa kyselyä',
                    'view_results' => 'Siirry tuloksiin',
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
            'tooltip_mail_enable' => 'Ilmoitus on poissa käytöstä. Klikkaa laittaaksesi päälle',
        ],
    ],
];
