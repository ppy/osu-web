<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'availability' => [
        'disabled' => 'Beatmap ei ole tällä hetkellä saatavilla.',
        'parts-removed' => 'Joitain osia tästä beatmapista on poistettu joko sen tekijän tai kolmannen osapuolen oikeuksien omaavan pyynnöstä.',
        'more-info' => 'Klikkaa nähdäksesi lisätietoja.',
        'rule_violation' => '',
    ],

    'download' => [
        'limit_exceeded' => 'Hidasta vähän, pelaa enemmän.',
    ],

    'featured_artist_badge' => [
        'label' => '',
    ],

    'index' => [
        'title' => 'Beatmapit',
        'guest_title' => 'Beatmapit',
    ],

    'panel' => [
        'empty' => '',

        'download' => [
            'all' => 'lataa',
            'video' => 'lataa videon kanssa',
            'no_video' => 'lataa ilman videota',
            'direct' => 'avaa osu!directissä',
        ],
    ],

    'nominate' => [
        'hybrid_requires_modes' => '',
        'incorrect_mode' => '',
        'full_bn_required' => '',
        'too_many' => '',

        'dialog' => [
            'confirmation' => '',
            'header' => '',
            'hybrid_warning' => '',
            'which_modes' => '',
        ],
    ],

    'nsfw_badge' => [
        'label' => '',
    ],

    'show' => [
        'discussion' => 'Keskustelu',

        'details' => [
            'by_artist' => '',
            'favourite' => 'Lisää tämä beatmap-setti suosikkeihin',
            'favourite_login' => '',
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

        'details_date' => [
            'approved' => '',
            'loved' => '',
            'qualified' => '',
            'ranked' => '',
            'submitted' => '',
            'updated' => '',
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
            ],

            'report' => [
                '_' => 'Jos löydät jonkun ongelman tämän beatmapin kanssa, olmoita siitä :link hälyttääksesi tiimiä.',
                'button' => 'Ilmoita Ongelma',
                'link' => 'täällä',
            ],
        ],

        'info' => [
            'description' => 'Kuvaus',
            'genre' => 'Tyylilaji',
            'language' => 'Kieli',
            'no_scores' => 'Dataa lasketaan...',
            'nsfw' => '',
            'points-of-failure' => 'Epäonnistumiskohdat',
            'source' => 'Lähde',
            'storyboard' => '',
            'success-rate' => 'Läpäisyprosentti',
            'tags' => 'Tunnisteet',
            'video' => '',
        ],

        'nsfw_warning' => [
            'details' => '',
            'title' => '',

            'buttons' => [
                'disable' => '',
                'listing' => '',
                'show' => 'Näytä',
            ],
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
                'time' => 'Aika',
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
            'qualified' => 'Esihyväksytty',
            'wip' => 'Työn alla',
            'pending' => '',
            'graveyard' => 'Hautausmaa',
        ],
    ],
];
