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

    'voting' => [
        'login_required' => 'Kirjaudu sisään äänestääksesi.',
        'over' => 'Äänestys tälle kilpailulle on päättynyt',
        'show_voted_only' => '',

        'best_of' => [
            'none_played' => "Näyttäisi siltä, ettet ole pelannut tähän kilpailuun kelpuutettuja mappeja!",
        ],

        'button' => [
            'add' => 'Äänestä',
            'remove' => 'Poista ääni',
            'used_up' => 'Olet käyttänyt kaikki äänesi',
        ],
    ],
    'entry' => [
        '_' => 'ehdokas',
        'login_required' => 'Kirjaudu sisään osallistuaksesi kilpailuun.',
        'silenced_or_restricted' => 'Et voi osallistua kilpailuun jos olet rajoitetussa -tai mykistetyssä tilassa.',
        'preparation' => 'Valmistelemme tätä kilpailua. Odota rauhassa!',
        'over' => 'Kiitos lähettämistänne töistä! Kilpailuun ei oteta enää ehdokkaita ja äänestys avataan pian.',
        'limit_reached' => 'Olet saavuttanut kilpailuun lähetettävien töiden rajan',
        'drop_here' => 'Pudota työsi tähän',
        'download' => 'Lataa .osz-tiedosto',
        'wrong_type' => [
            'art' => 'Tähän kilpailuun sallitaan ainoastaan .jpg- ja -png-tiedostot.',
            'beatmap' => 'Tähän kilpailuun sallitaan ainoastaan .osu-tiedostot.',
            'music' => 'Tähän kilpailuun sallitaan ainoastaan .mp3-tiedostot.',
        ],
        'too_big' => 'Tähän kilpailuun voi lähettää korkeintaan :limit työtä.',
    ],
    'beatmaps' => [
        'download' => 'Lataa ehdokas',
    ],
    'vote' => [
        'list' => 'äänet',
        'count' => ':count ääni|:count ääntä',
        'points' => ':count piste|:count pistettä',
    ],
    'dates' => [
        'ended' => 'Loppui :date',
        'ended_no_date' => 'Päättyi',

        'starts' => [
            '_' => 'Alkoi :date',
            'soon' => 'pian™',
        ],
    ],
    'states' => [
        'entry' => 'Avoinna',
        'voting' => 'Äänestys Alkanut',
        'results' => 'Tulokset Julkistettu',
    ],
];
