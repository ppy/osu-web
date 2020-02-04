<?php

/**
 *    Copyright (c) ppy Pty Ltd <contact@ppy.sh>.
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
    'header' => [
        'small' => 'Kilpaile muillakin tavoilla kuin klikkailemalla ympyröitä.',
        'large' => 'Yhteisön kilpailut',
    ],

    'index' => [
        'nav_title' => '',
    ],

    'voting' => [
        'over' => 'Äänestys tälle kilpailulle on päättynyt',
        'login_required' => 'Kirjaudu sisään äänestääksesi.',

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
