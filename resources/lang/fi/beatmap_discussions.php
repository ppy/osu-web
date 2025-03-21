<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'authorizations' => [
        'update' => [
            'null_user' => 'Kirjaudu sisään muokataksesi.',
            'system_generated' => 'Automaattisesti luotua viestiä ei voi muokata.',
            'wrong_user' => 'Vain aiheen omistaja pystyy muokkaamaan.',
        ],
    ],

    'events' => [
        'empty' => 'Mitään ei ole tapahtunut... vielä.',
    ],

    'index' => [
        'deleted_beatmap' => 'poistettu',
        'none_found' => 'Hakukriteereihin täsmääviä keskusteluja ei löytynyt.',
        'title' => 'Beatmapkeskustelut',

        'form' => [
            '_' => 'Hae',
            'deleted' => 'Sisällytä poistetut keskustelut',
            'mode' => 'Beatmap-tila',
            'only_unresolved' => 'Näytä vain ratkaisemattomat keskustelut',
            'show_review_embeds' => 'Näytä arvosteluviestit',
            'types' => 'Viestityypit',
            'username' => 'Käyttäjänimi',

            'beatmapset_status' => [
                '_' => 'Rytmikartan tila',
                'all' => 'Kaikki',
                'disqualified' => 'Hylätty',
                'never_qualified' => 'Ei koskaan kelpuutettu',
                'qualified' => 'Kelpuutettu',
                'ranked' => 'Rankattu',
            ],

            'user' => [
                'label' => 'Käyttäjä',
                'overview' => 'Tapahtumakatsaus',
            ],
        ],
    ],

    'item' => [
        'created_at' => 'Lähetetty',
        'deleted_at' => 'Poistettu',
        'message_type' => 'Tyyppi',
        'permalink' => 'Pysyvä linkki',
    ],

    'nearby_posts' => [
        'confirm' => 'Mikään viesteistä ei käsittele aihettani',
        'notice' => 'Aikajanalta :timestamp (:existing_timestamps) löytyy viestejä. Tarkista ne ennen viestin lähettämistä.',
        'unsaved' => ':count tässä arviossa',
    ],

    'owner_editor' => [
        'button' => 'Vaikeustason Omistaja',
        'reset_confirm' => 'Nollaa tämän vaikeustason omistaja?',
        'user' => 'Omistaja',
        'version' => 'Vaikeustaso',
    ],

    'refresh' => [
        'checking' => 'Tarkistetaan päivityksiä...',
        'has_updates' => 'Keskustelussa on päivityksiä, klikkaa päivittääksesi.',
        'no_updates' => 'Ei päivityksiä.',
        'updating' => 'Päivitetään...',
    ],

    'reply' => [
        'open' => [
            'guest' => 'Kirjaudu sisään vastataksesi',
            'user' => 'Vastaa',
        ],
    ],

    'review' => [
        'block_count' => ':used / :max lohkoa käytetty',
        'go_to_parent' => 'Näytä arvostelupostaus',
        'go_to_child' => 'Näytä keskustelu',
        'validation' => [
            'block_too_large' => 'jokainen lohko voi sisältää enintään :limit merkkiä',
            'external_references' => 'arvostelu sisältää viittauksia ongelmiin, jotka eivät kuulu tähän arvosteluun',
            'invalid_block_type' => 'virheellinen lohkotyyppi',
            'invalid_document' => 'virheellinen arvostelu',
            'invalid_discussion_type' => 'virheellinen keskustelutyyppi',
            'minimum_issues' => 'arvostelun täytyy sisältää vähintään :count ongelmaa|arvostelun täytyy sisältää vähintään :count ongelmaa',
            'missing_text' => 'lohkosta puuttuu teksti',
            'too_many_blocks' => 'arvostelut saavat sisältää vain :count kappale/ongelmaa|arvostelut saavat sisältää vain :count kappaletta/ongelmaa',
        ],
    ],

    'system' => [
        'resolved' => [
            'true' => ':user on merkinnyt ratkaistuksi',
            'false' => ':user avasi uudelleen',
        ],
    ],

    'timestamp_display' => [
        'general' => 'yleiset',
        'general_all' => 'yleiset (kaikki)',
    ],

    'user_filter' => [
        'everyone' => 'Jokainen',
        'label' => 'Suodata käyttäjien mukaan',
    ],
];
