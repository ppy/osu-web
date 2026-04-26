<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'header' => [
        'small' => 'Kilpaile muillakin tavoilla kuin klikkailemalla ympyröitä.',
        'large' => 'Yhteisön kilpailut',
    ],

    'index' => [
        'nav_title' => 'listaus',
    ],

    'judge' => [
        'comments' => 'kommentit',
        'hide_judged' => 'piilota arvioidut tuotokset',
        'nav_title' => 'arvioi',
        'no_current_vote' => 'et äänestänyt vielä.',
        'update' => 'päivitä',
        'validation' => [
            'missing_score' => 'puuttuva pisteytys',
            'contest_vote_judged' => 'et voi äänestää tuomaroiduissa kilpailuissa',
        ],
        'voted' => 'Olet jo äänestänyt tätä tuotosta.',
    ],

    'judge_results' => [
        '_' => 'Tuomaroinnin tulokset',
        'creator' => 'tekijä',
        'score' => 'Pisteet',
        'score_std' => 'Standardoitu Pistemäärä',
        'total_score' => 'yhteispisteet',
        'total_score_std' => 'standardisoitu kokonaispistemäärä',
    ],

    'voting' => [
        'judge_link' => 'Olet tämän kilpailun tuomari. Arvostele tuotoksia täällä!',
        'judged_notice' => 'Tämä kilpailu käyttää tuomarointijärjestelmää, tuomarit käsittelevät tuotoksia parhaillaan.',
        'login_required' => 'Kirjaudu sisään äänestääksesi.',
        'over' => 'Äänestys tälle kilpailulle on päättynyt',
        'show_voted_only' => 'Näytä äänestetyt',

        'best_of' => [
            'none_played' => "Näyttäisi siltä, ettet ole pelannut tähän kilpailuun kelpuutettuja mappeja!",
        ],

        'button' => [
            'add' => 'Äänestä',
            'remove' => 'Poista ääni',
            'used_up' => 'Olet käyttänyt kaikki äänesi',
        ],

        'progress' => [
            '_' => ':used / :max ääntä käytetty',
        ],

        'requirement' => [
            'playlist_beatmapsets' => [
                'incomplete_play' => 'Pelattava kaikki annettujen soittolistojen beatmapit ennen äänestämistä',
            ],
        ],
    ],

    'entry' => [
        '_' => 'ehdokas',
        'login_required' => 'Kirjaudu sisään osallistuaksesi kilpailuun.',
        'silenced_or_restricted' => 'Et voi osallistua kilpailuun jos olet rajoitetussa -tai mykistetyssä tilassa.',
        'preparation' => 'Valmistelemme tätä kilpailua. Odota rauhassa!',
        'drop_here' => 'Pudota työsi tähän',
        'allowed_extensions' => ':types-tiedostot hyväksytään',
        'max_size' => 'Suurin koko :limit',
        'required_dimensions' => 'Mittojen on oltava :widthx:height',
        'download' => 'Lataa .osz-tiedosto',
        'wrong_file_type' => 'Vain :types tiedostot ovat hyväksyttyjä tähän kilpailuun.',
        'wrong_dimensions' => 'Tämän kilpailun kohteiden on oltava :widthx:height',
        'too_big' => 'Tähän kilpailuun voi lähettää korkeintaan :limit työtä.',
    ],

    'beatmaps' => [
        'download' => 'Lataa tuotos',
    ],

    'vote' => [
        'list' => 'äänet',
        'count' => ':count_delimited ääni|:count_delimited ääntä',
        'points' => ':count piste|:count pistettä',
        'points_float' => ':points pistettä',
    ],

    'dates' => [
        'ended' => 'Loppui :date',
        'ended_no_date' => 'Päättyi',

        'starts' => [
            '_' => 'Alkaa :date',
            'soon' => 'pian™',
        ],
    ],

    'states' => [
        'entry' => 'Avoinna',
        'voting' => 'Äänestys Alkanut',
        'results' => 'Tulokset Julkistettu',
    ],

    'show' => [
        'admin' => [
            'page' => '',
        ],
    ],
];
