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
    'availability' => [
        'disabled' => 'Tätä rytmikarttaa ei voi juuri nyt ladata.',
        'parts-removed' => 'Joitain osia tästä rytmikartasta on poistettu joko sen tekijän tai kolmannen osapuolen oikeuksien omaavan pyynnöstä.',
        'more-info' => 'Klikkaa nähdäksesi lisää tietoa.',
    ],

    'index' => [
        'title' => 'Rytmikarttojen listaus',
        'guest_title' => 'Rytmikartat',
    ],

    'show' => [
        'discussion' => 'Keskustelu',

        'details' => [
            'mapped_by' => 'mapannut :mapper',
            'submitted' => 'Julkaistu ',
            'updated' => 'Viimeisin päivitys ',
            'updated_timeago' => 'viimeeksi päivitetty :timeago',
            'ranked' => 'Rankattu ',
            'approved' => 'hyväksytty ',
            'qualified' => 'hyväksytty ',
            'loved' => 'rakastettu ',
            'logged-out' => 'Sinun täytyy kirjautua sisään ladataksesi rytmikarttoja!',
            'download' => [
                '_' => 'Lataa',
                'video' => 'Videon kanssa',
                'no-video' => 'Ilman videota',
                'direct' => '',
            ],
            'favourite' => 'Lisää tämä rytmikarttasetti suosikkeihin',
            'unfavourite' => 'Poista tämä rytmikarttasetti suosikeista',
            'favourited_count' => '+ 1 muu!|+ :count muuta!',
        ],
        'stats' => [
            'cs' => 'Ympyrän koko',
            'cs-mania' => 'Koskettimien määrä',
            'drain' => 'HP Drain',
            'accuracy' => 'Tarkkuus',
            'ar' => 'Lähestymisnopeus',
            'stars' => 'Vaikeustaso',
            'total_length' => 'Pituus',
            'bpm' => 'BPM',
            'count_circles' => 'Ympyröiden määrä',
            'count_sliders' => 'Slidereiden määrä',
            'user-rating' => 'Käyttäjien arvio',
            'rating-spread' => 'Arvioiden jakauma',
            'nominations' => 'Ehdolle asetukset',
            'playcount' => 'Pelikertojen määrä',
        ],
        'info' => [
            'description' => 'Kuvaus',
            'genre' => 'Lajityyppi',
            'language' => 'Kieli',
            'no_scores' => 'Dataa lasketaan...',
            'points-of-failure' => 'Epäonnistumiskohdat',
            'source' => 'Lähde',
            'success-rate' => 'Läpipääsyprosentti',
            'tags' => 'Tagit',
            'unranked' => 'Rankkaamaton rytmikartta',
        ],
        'scoreboard' => [
            'achieved' => 'Saavutettu',
            'country' => 'Maansisäiset sijoitukset',
            'friend' => 'Ystävien sijoitukset',
            'global' => 'Maailmanlaajuiset sijoitukset',
            'supporter-link' => 'Klikkaa <a href=":link">tästä</a> nähdäksesi kaikki hienot ominaisuudet mitä saat!',
            'supporter-only' => 'Sinun täytyt olla osu! supporter nähdäksesi ystävien ja maansisäiset sijoitukset!',
            'title' => 'Tulostaulukko',

            'headers' => [
                'accuracy' => 'Tarkkuus',
                'combo' => 'Suurin combo',
                'miss' => 'Huti',
                'mods' => 'Modit',
                'player' => 'Pelaaja',
                'pp' => '',
                'rank' => 'Sijoitus',
                'score_total' => 'Kokonaispisteet',
                'score' => 'Pistemäärä',
            ],

            'no_scores' => [
                'country' => 'Kukaan maastasi ei ole vielä saanut pisteitä tässä kartassa!',
                'friend' => 'Kukaan ystävistäsi ei ole vielä saanut pisteitä tässä kartassa!',
                'global' => 'Ei pisteitä vielä. Ehkä voit yrittää saada niitä?',
                'loading' => 'Ladataan tuloksia...',
                'unranked' => 'Rankkaamaton rytmikartta.',
            ],
            'score' => [
                'first' => 'Johdossa',
                'own' => 'Sinun parhaasi',
            ],
        ],
    ],
];
