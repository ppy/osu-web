<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'applications' => [
        'accept' => [
            'ok' => 'Käyttäjä lisätty joukkueeseen.',
        ],
        'destroy' => [
            'ok' => 'Liittymiskutsu peruttu.',
        ],
        'reject' => [
            'ok' => 'Liittymiskutsu kielletty.',
        ],
        'store' => [
            'ok' => 'Pyydetty tiimiin liittymistä.',
        ],
    ],

    'card' => [
        'members' => ':count_delimited jäsen|:count_delimited jäsentä',
    ],

    'create' => [
        'submit' => 'Luo Tiimi',

        'form' => [
            'name_help' => 'Sinun tiimisi nimi. Nimi on pysyvä tällä hetkellä.',
            'short_name_help' => 'Enintään 4 merkkiä.',
            'title' => "Perustetaan uusi tiimi",
        ],

        'intro' => [
            'description' => "Pelaa yhdessä kavereidesi kanssa; entisten tai uusien. Et ole tällä hetkellä tiimissä. Liity olemassa olevaan tiimiin vierailemalla heidän tiimisivullaan tai luo oma tiimisi tältä sivulta.",
            'title' => 'Tiimi!',
        ],
    ],

    'destroy' => [
        'ok' => 'Tiimi poistettu.',
    ],

    'edit' => [
        'ok' => 'Asetukset tallennettu onnistuneesti.',
        'title' => 'Tiimin Asetukset',

        'description' => [
            'label' => 'Kuvaus',
            'title' => 'Tiimin Kuvaus',
        ],

        'flag' => [
            'label' => 'Tiimin lippu',
            'title' => 'Aseta Tiimin Lippu',
        ],

        'header' => [
            'label' => 'Otsikon Kuva',
            'title' => 'Aseta Otsikkokuva',
        ],

        'settings' => [
            'application_help' => 'Sallitaanko pelaajien hakea tiimiin',
            'default_ruleset_help' => '',
            'flag_help' => 'Enimmäiskoko :width×:height',
            'header_help' => 'Enimmäiskoko :width×:height',
            'title' => 'Tiimin Asetukset',

            'application_state' => [
                'state_0' => 'Suljettu',
                'state_1' => 'Avaa',
            ],
        ],
    ],

    'header_links' => [
        'edit' => 'asetukset',
        'leaderboard' => 'tulostaulukko',
        'show' => 'info',

        'members' => [
            'index' => 'hallinoi jäseniä',
        ],
    ],

    'leaderboard' => [
        'global_rank' => 'Kansainvälinen sijoitus',
    ],

    'members' => [
        'destroy' => [
            'success' => 'Joukkueen jäsen poistettu',
        ],

        'index' => [
            'title' => 'Hallinoi Jäseniä',

            'applications' => [
                'accept_confirm' => 'Lisätäänkö käyttäjä :user tiimiin?',
                'created_at' => 'Pyydetty ',
                'empty' => 'Ei liittymispyyntöjä tällä hetkellä.',
                'empty_slots' => 'Vapaita paikkoja',
                'empty_slots_overflow' => '',
                'reject_confirm' => 'Hylätäänkö liittymispyynto käyttäjältä :user?',
                'title' => 'Liittymispyynnöt',
            ],

            'table' => [
                'joined_at' => 'Liittymispäivämäärä',
                'remove' => 'Poista',
                'remove_confirm' => 'Haluatko poistaa käyttäjän :user joukkueestasi?',
                'set_leader' => 'Siirrä tiimin johtajuus',
                'set_leader_confirm' => 'Siirretäänkö tiimin johtajuus käyttäjälle :user?',
                'status' => 'Tila',
                'title' => 'Nykyiset Jäsenet',
            ],

            'status' => [
                'status_0' => 'Epäaktiivinen',
                'status_1' => 'Aktiivinen',
            ],
        ],

        'set_leader' => [
            'success' => 'Käyttäjä :user on nyt tiiminjohtaja.',
        ],
    ],

    'part' => [
        'ok' => 'Lähti tiimistä ;_;',
    ],

    'show' => [
        'bar' => [
            'chat' => 'Tiimikeskustelu',
            'destroy' => 'Hajota joukkue',
            'join' => 'Pyydä Liittymistä',
            'join_cancel' => 'Peruuta Liittyminen',
            'part' => 'Lähde Tiimistä',
        ],

        'info' => [
            'created' => 'Muodostettu',
        ],

        'members' => [
            'members' => 'Tiimin Jäsenet',
            'owner' => 'Tiimin Johtaja',
        ],

        'sections' => [
            'about' => 'Tietoa meistä!',
            'info' => 'Info',
            'members' => 'Jäsenet',
        ],

        'statistics' => [
            'empty_slots' => ':count_delimited paikka jäljellä|:count_delimited paikkaa jäljellä',
            'leader' => 'Joukkuejohtaja',
            'rank' => 'Sijoitus',
        ],
    ],

    'store' => [
        'ok' => 'Tiimi luotu.',
    ],
];
