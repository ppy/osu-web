<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'availability' => [
        'disabled' => 'Tätä rytmikarttaa ei voi juuri nyt ladata.',
        'parts-removed' => 'Joitain osia tästä beatmapista on poistettu joko sen tekijän tai kolmannen osapuolen oikeuksien omaavan pyynnöstä.',
        'more-info' => 'Klikkaa nähdäksesi lisätietoja.',
        'rule_violation' => 'Osa tämän rytmikartan sisältämistä resursseista on poistettu, koska on katsottu, että ne eivät sovi osu!ssa käytettäväksi.',
    ],

    'cover' => [
        'deleted' => 'Poistettu rytmikartta',
    ],

    'download' => [
        'limit_exceeded' => 'Hidasta vähän, pelaa enemmän.',
        'no_mirrors' => 'Latauspalvelimia ei saatavilla.',
    ],

    'featured_artist_badge' => [
        'label' => 'Esitelty artisti',
    ],

    'index' => [
        'title' => 'Beatmappien Listaus',
        'guest_title' => 'Beatmapit',
    ],

    'panel' => [
        'empty' => 'ei beatmappeja',

        'download' => [
            'all' => 'lataa',
            'video' => 'lataa videon kanssa',
            'no_video' => 'lataa ilman videota',
            'direct' => 'avaa osu!directissä',
        ],
    ],

    'nominate' => [
        'bng_limited_too_many_rulesets' => 'Koeajalla olevat ehdollepanijat eivät voi asettaa ehdolle useita pelimuotoja.',
        'full_nomination_required' => 'Sinun on oltava täysivaltainen ehdollepanija, jotta voit tehdä pelimuodon viimeisen ehdollepanon.',
        'hybrid_requires_modes' => 'Usean pelimuodon rytmikartta edellyttää, että valitset ainakin yhden pelimuodon, jonka panet ehdolle.',
        'incorrect_mode' => 'Sinulla ei ole lupaa asettaa ehdolle pelimuotoa: :mode',
        'invalid_limited_nomination' => 'Tällä rytmikartalla on virheellisiä ehdollepanoja, eikä sitä voida kelpuuttaa tällä hetkellä.',
        'invalid_ruleset' => 'Tällä ehdollepanolla on virheellisiä pelimuotoja.',
        'too_many' => 'Ehdollepanovaatimus on jo täyttynyt.',
        'too_many_non_main_ruleset' => 'Toissijaisen pelimuodon ehdollepanovaatimus on jo täytetty.',

        'dialog' => [
            'confirmation' => 'Oletko varma, että haluat asettaa tämän rytmikartan ehdolle?',
            'different_nominator_warning' => 'Tämän rytmikartan kelpuuttaminen eri nimittäjillä nollaa sen kelpuuttamisjonon sijainnin.',
            'header' => 'Ehdollepane rytmikartta',
            'hybrid_warning' => 'huomaa: voit tehdä ehdollepanon vain kerran, joten varmista, että asetat todella ehdolle kaikki tarkoittamasi pelimuodot',
            'current_main_ruleset' => 'Ensisijainen pelimuoto on tällä hetkellä: :ruleset',
            'which_modes' => 'Mitkä pelimuodot asetetaan ehdolle?',
        ],
    ],

    'nsfw_badge' => [
        'label' => 'Sopimaton',
    ],

    'show' => [
        'discussion' => 'Keskustelu',

        'admin' => [
            'full_size_cover' => 'Näytä täysikokoinen kansikuva',
            'page' => '',
        ],

        'deleted_banner' => [
            'title' => 'Tämä rytmikartta on poistettu.',
            'message' => '(tämä näkyy vain moderaattoreille)',
        ],

        'details' => [
            'by_artist' => ':artist',
            'favourite' => 'lisää tämä rytmikartta suosikkeihin',
            'favourite_login' => 'kirjaudu sisään, niin voit lisätä tämän rytmikartan suosikkeihin',
            'logged-out' => 'sinun täytyy kirjautua sisään ennen rytmikarttojen lataamista!',
            'mapped_by' => 'kartoittanut: :mapper',
            'mapped_by_guest' => 'vieraileva vaikeustaso, kartoittanut: :mapper',
            'unfavourite' => 'poista tämä rytmikartta suosikeista',
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
            'approved' => 'hyväksytty :timeago',
            'loved' => 'rakastettu :timeago',
            'qualified' => 'kelpuutettu :timeago',
            'ranked' => 'rankattu :timeago',
            'submitted' => 'lähetetty :timeago',
            'updated' => 'päivitetty viimeksi :timeago',
        ],

        'favourites' => [
            'limit_reached' => 'Sinulla on liian monta lempikappaletta! Poista joitain suosikeistasi ja yritä sitten uudelleen.',
        ],

        'hype' => [
            'action' => 'Jos nautit tästä kartasta, hurraa sitä edistääksesi sen siirtymistä <strong>rankatuksi</strong>.',

            'current' => [
                '_' => 'Tämä kartta on :status.',

                'status' => [
                    'pending' => 'vireillä',
                    'qualified' => 'kelpuutettu',
                    'wip' => 'työn alla',
                ],
            ],

            'disqualify' => [
                '_' => 'Jos löydät ongelman tässä rytmikartassa, ole hyvä ja hylkää se :link.',
            ],

            'report' => [
                '_' => 'Jos löydät jonkun ongelman tässä rytmikartassa, ilmoita siitä tiimille :link.',
                'button' => 'Ilmoita Ongelma',
                'link' => 'täällä',
            ],
        ],

        'info' => [
            'description' => 'Kuvaus',
            'genre' => 'Genre',
            'language' => 'Kieli',
            'mapper_tags' => '',
            'no_scores' => 'Dataa lasketaan...',
            'nominators' => 'Ehdollepanijat',
            'nsfw' => 'Sopimaton sisältö',
            'offset' => 'Vastapaino verkossa',
            'points-of-failure' => 'Epäonnistumiskohdat',
            'source' => 'Lähde',
            'storyboard' => 'Tämä rytmikartta sisältää taustaesityksen',
            'success-rate' => 'Läpäisyprosentti',
            'user_tags' => '',
            'video' => 'Tämä rytmikartta sisältää videon',
        ],

        'nsfw_warning' => [
            'details' => 'Tämä rytmikartta sisältää sopimatonta, loukkaavaa tai järkyttävää sisältöä. Haluatko kuitenkin nähdä sen?',
            'title' => 'Sopimatonta sisältöä',

            'buttons' => [
                'disable' => 'Poista varoitus käytöstä',
                'listing' => 'Rytmikarttojen listaukseen',
                'show' => 'Näytä',
            ],
        ],

        'scoreboard' => [
            'achieved' => 'saavutettu :when',
            'country' => 'Maakohtaiset sijoitukset',
            'error' => 'Sijoituksen lataaminen epäonnistui',
            'friend' => 'Kavereiden sijoitukset',
            'global' => 'Maailmanlaajuiset sijoitukset',
            'supporter-link' => 'Klikkaa <a href=":link">tästä</a> nähdäksesi kaikki hienot ominaisuudet mitä saat!',
            'supporter-only' => 'Sinun täytyy olla osu!n tukija nähdäksesi kaveri-, maa- ja muunnelmakohtaiset sijoitukset!',
            'team' => '',
            'title' => 'Tulokset',

            'headers' => [
                'accuracy' => 'Tarkkuus',
                'combo' => 'Suurin iskuputki',
                'miss' => 'Huti',
                'mods' => 'Muunnelmat',
                'pin' => 'Kiinnitä',
                'player' => 'Pelaaja',
                'pp' => '',
                'rank' => 'Sijoitus',
                'score' => 'Pisteet',
                'score_total' => 'Kokonaispisteet',
                'time' => 'Aika',
            ],

            'no_scores' => [
                'country' => 'Kartasta ei vielä löydy maansisäisiä tuloksia!',
                'friend' => 'Kukaan kavereistasi ei vielä ole saanut tulosta tässä kartassa!',
                'global' => 'Tuloksia ei ole. Voisit hankkia niitä.',
                'loading' => 'Ladataan tuloksia...',
                'team' => '',
                'unranked' => 'Rankkaamaton rytmikartta.',
            ],
            'score' => [
                'first' => 'Johdossa',
                'own' => 'Sinun parhaasi',
            ],
            'supporter_link' => [
                '_' => 'Napsauta :here, niin näet kaikki hienot ominaisuudet, jotka saat!',
                'here' => 'tästä',
            ],
        ],

        'stats' => [
            'cs' => 'Ympyräkoko',
            'cs-mania' => 'Näppäinten määrä',
            'drain' => 'Terveyden kuluvuus',
            'accuracy' => 'Tarkkuus',
            'ar' => 'Lähestymisnopeus',
            'stars' => 'Tähtiluokitus',
            'total_length' => 'Pituus',
            'bpm' => 'BPM',
            'count_circles' => 'Ympyröiden määrä',
            'count_sliders' => 'Slidereiden määrä',
            'offset' => 'Vastapaino verkossa: :offset',
            'user-rating' => 'Käyttäjien arvio',
            'rating-spread' => 'Arvioiden jakauma',
            'nominations' => 'Ehdollepanot',
            'playcount' => 'Pelikertojen määrä',
        ],

        'status' => [
            'ranked' => 'Rankattu',
            'approved' => 'Hyväksytty',
            'loved' => 'Rakastettu',
            'qualified' => 'Kelpuutettu',
            'wip' => 'Työn alla',
            'pending' => 'Vireillä',
            'graveyard' => 'Hautausmaa',
        ],
    ],

    'spotlight_badge' => [
        'label' => 'Kohdevalo',
    ],
];
