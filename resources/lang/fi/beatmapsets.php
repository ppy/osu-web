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
    'availability' => [
        'disabled' => 'Beatmap ei ole tällä hetkellä saatavilla.',
        'parts-removed' => 'Joitain osia tästä beatmapista on poistettu joko sen tekijän tai kolmannen osapuolen oikeuksien omaavan pyynnöstä.',
        'more-info' => 'Klikkaa nähdäksesi lisätietoja.',
    ],

    'index' => [
        'title' => 'Beatmapit',
        'guest_title' => 'Beatmapit',
    ],

    'show' => [
        'discussion' => 'Keskustelu',

        'details' => [
            'favourite' => 'Lisää tämä beatmap-setti suosikkeihin',
            'logged-out' => 'Sinun täytyy kirjautua sisään ladataksesi beatmappeja!',
            'mapped_by' => 'luonut: :mapper',
            'unfavourite' => 'Poista tämä beatmapkokoelma suosikeista',
            'updated_timeago' => 'päivitetty viimeksi :timeago',

            'download' => [
                '_' => 'Lataa',
                'direct' => '',
                'no-video' => 'ilman videota',
                'video' => 'videon kanssa',
            ],

            'login_required' => [
                'bottom' => 'lisäomimaisuuksien käyttämiseen',
                'top' => 'Kirjaudu sisään',
            ],
        ],

        'favourites' => [
            'limit_reached' => 'Sinulla on liian monta lempikappaletta! Poista joitain suosikeistasi ennen uudelleenyrittämistä.',
        ],

        'hype' => [
            'action' => 'Jos nautit tästä kartasta, hurraa sitä edistääksesi sen siirtymistä <strong>Hyväksyttyyn</strong> tilaan.',

            'current' => [
                '_' => 'Tämä kartta on :status.',

                'status' => [
                    'pending' => 'vireillä',
                    'qualified' => 'hyväksytty',
                    'wip' => 'keskeneräinen',
                ],
            ],

            'disqualify' => [
                '_' => '',
                'button_title' => '',
            ],

            'report' => [
                '_' => '',
                'button' => '',
                'button_title' => '',
                'link' => '',
            ],
        ],

        'info' => [
            'description' => 'Kuvaus',
            'genre' => 'Tyylilaji',
            'language' => 'Kieli',
            'no_scores' => 'Dataa lasketaan...',
            'points-of-failure' => 'Epäonnistumiskohdat',
            'source' => 'Lähde',
            'success-rate' => 'Läpäisyprosentti',
            'tags' => 'Tunnisteet',
            'unranked' => 'Beatmap ei ole hyväksytyssä tilassa',
        ],

        'scoreboard' => [
            'achieved' => 'saavutettu :when',
            'country' => 'Maakohtaiset sijoitukset',
            'friend' => 'Kavereiden sijoitukset',
            'global' => 'Maailmanlaajuiset sijoitukset',
            'supporter-link' => 'Klikkaa <a href=":link">tästä</a> nähdäksesi kaikki hienot ominaisuudet mitä saat!',
            'supporter-only' => 'Sinun täytyy olla Tukija nähdäksesi maa- ja ystäväkohtaiset sijoitukset!',
            'title' => 'Tulokset',

            'headers' => [
                'accuracy' => 'Tarkkuus',
                'combo' => 'Maksimikombo',
                'miss' => 'Ohi',
                'mods' => 'Modit',
                'player' => 'Pelaaja',
                'pp' => '',
                'rank' => 'Sijoitus',
                'score_total' => 'Kokonaispisteet',
                'score' => 'Pisteet',
            ],

            'no_scores' => [
                'country' => 'Kartasta ei vielä löydy maansisäisiä tuloksia!',
                'friend' => 'Kukaan kavereistasi ei vielä ole saanut tulosta tässä mapissa!',
                'global' => 'Tuloksia ei ole. Voisit hankkia niitä.',
                'loading' => 'Ladataan tuloksia...',
                'unranked' => 'Beatmap ei ole hyväksytyssä tilassa.',
            ],
            'score' => [
                'first' => 'Johdossa',
                'own' => 'Sinun parhaasi',
            ],
        ],

        'stats' => [
            'cs' => 'Ympyräkoko',
            'cs-mania' => 'Näppäinten määrä',
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
            'nominations' => 'Suositukset',
            'playcount' => 'Pelikertojen määrä',
        ],

        'status' => [
            'ranked' => '',
            'approved' => '',
            'loved' => '',
            'qualified' => '',
            'wip' => '',
            'pending' => '',
            'graveyard' => '',
        ],
    ],
];
