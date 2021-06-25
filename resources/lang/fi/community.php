<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'support' => [
        'convinced' => [
            'title' => 'Vakuutuin! :D',
            'support' => 'tue osua!',
            'gift' => 'tai lahjoita Tukija toiselle pelaajalle',
            'instructions' => 'klikkaa sydäntä jatkaaksesi osu!kauppaan',
        ],
        'why-support' => [
            'title' => 'Miksi minun pitäisi tukea osu!:a? Mihin rahat menevät?',

            'team' => [
                'title' => 'Tue Tiimiä',
                'description' => 'Pieni tiimi huolehtii osu!\'n kehittämistä ja ylläpitoa. Tukesi auttaa heitä pysymään, siis... elossa.',
            ],
            'infra' => [
                'title' => 'Palvelininfrastruktuuri',
                'description' => 'Avustukset menevät palvelimiin, joilla ylläpidetään verkkosivustoa, moninpelipalveluita, online-pistetaulukoita jne.',
            ],
            'featured-artists' => [
                'title' => 'Esittelyssä olevat Artistit',
                'description' => 'Sinun tuella voimme lähestyä mahtavia artisteja vielä enemmän ja lisensoida lisää hienoa musiikkia käytettäväksi osu!:ssa',
                'link_text' => 'Näytä nykyinen lista &raquo;',
            ],
            'ads' => [
                'title' => 'Pidä osu! itsekestävänä',
                'description' => 'Lahjoituksesi auttavat pitämään pelin itsenäisenä ja täysin vapaana mainoksista ja ulkopuolisista sponsoreista.',
            ],
            'tournaments' => [
                'title' => 'Viralliset Turnaukset',
                'description' => 'Auta osu! World Cup -turnausten ylläpidon (sekä palkintojen) rahoittamista.',
                'link_text' => '',
            ],
            'bounty-program' => [
                'title' => '',
                'description' => '',
                'link_text' => 'Lue lisää &raquo;',
            ],
        ],
        'perks' => [
            'title' => 'Aha. No mitä minä sitten saan?!',
            'osu_direct' => [
                'title' => 'osu!direct',
                'description' => 'Nopea ja helppo tapa etsiä beatmappejä ilman tarvetta poistua pelistä.',
            ],

            'friend_ranking' => [
                'title' => 'Kavereiden sijoituksia',
                'description' => "",
            ],

            'country_ranking' => [
                'title' => 'Maakohtaiset sijoitukset',
                'description' => 'Valloita maasi ennen kuin valloitat maailman.',
            ],

            'mod_filtering' => [
                'title' => '',
                'description' => 'Viihdytkö vain HDHR-pelaajien kanssa? Ei hätää!',
            ],

            'auto_downloads' => [
                'title' => 'Automaattilataukset',
                'description' => 'Automaattilataus moninpelissä, katsoessa muita pelaajia tai klikatessa linkkejä keskusteluissa!',
            ],

            'upload_more' => [
                'title' => 'Lataa enemmän',
                'description' => 'Lisäpaikkoja vireillä oleville beatmapeille jokaista hyväksyttyä beatmappiä vastaan. (Max. 10)',
            ],

            'early_access' => [
                'title' => 'Ennakkojulkaisut',
                'description' => 'Pääsy uusimpiin versioihin, joissa voit kokeilla uusia ominaisuuksia ennen niiden julkaisua!',
            ],

            'customisation' => [
                'title' => 'Mukauttaminen',
                'description' => "Tee profiilistasi omalaatuinen lisäämällä täysin muokattava käyttäjä-sivu.",
            ],

            'beatmap_filters' => [
                'title' => 'Beatmap Suodattimet',
                'description' => 'Suodata beatmappien hakua pelatun, pelaamattoman sekä kartassa saavutetun luokituksen mukaan.',
            ],

            'yellow_fellow' => [
                'title' => 'Keltainen Kaveri',
                'description' => 'Saat pelinsisäisiin keskusteluihin keltaisen käyttäjänimen, jolla sinut otetaan varmasti huomioon.',
            ],

            'speedy_downloads' => [
                'title' => 'Nopeat lataukset',
                'description' => 'Suvaitsevaisemmat latausrajoitukset, erityisesti käyttäessä osu!directiä.',
            ],

            'change_username' => [
                'title' => 'Vaihda käyttäjänimeä',
                'description' => 'Voit vaihtaa käyttäjänimesi ilman ylimääräisiä kuluja. (vain kerran)',
            ],

            'skinnables' => [
                'title' => 'Ulkonäöllisyyksiä',
                'description' => 'Lisää muokattavia pelinsisäisiä kohteita, kuten esimerkiksi päävalikon taustakuva.',
            ],

            'feature_votes' => [
                'title' => 'Äänestä ominaisuuksista',
                'description' => 'Äänestä kahdesti kuukaudessa uusista ominaisuuksista.',
            ],

            'sort_options' => [
                'title' => 'Lajitteluasetuksia',
                'description' => 'Näet beatmapin maa-, kaveri- ja modikohtaiset sijoitukset pelissä.',
            ],

            'more_favourites' => [
                'title' => 'Lisää suosikkeja',
                'description' => 'Voit lisätä suosikkilistaan :normally beatmappeja, verrattuna :supporter beatmappeihin normaalitapauksessa',
            ],
            'more_friends' => [
                'title' => 'Lisää kavereita',
                'description' => 'Voit lisätä kaverilistaan :normally kavereita, verrattuna :supporter kavereihin normaalitapauksessa',
            ],
            'more_beatmaps' => [
                'title' => '',
                'description' => '',
            ],
            'friend_filtering' => [
                'title' => '',
                'description' => 'Kilpaile kavereitasi kanssa ja katso, miten sijoittaudut heitä vastaan!',
            ],

        ],
        'supporter_status' => [
            'contribution' => 'Kiitos tuestasi tähän saakka! Olet tukenut kokonaisuudessaan :dollars :tags tukijaostoksella!',
            'gifted' => "Tagiostoksistasi :giftedTags on lahjoitettu (yhteensä :giftedDollars), kuinka anteliasta!",
            'not_yet' => "Et ole vielä tukija :(",
            'valid_until' => 'Nykyinen tukijatagi on voimassa :date asti!',
            'was_valid_until' => 'Tukijatagisi oli voimassa :date asti.',
        ],
    ],
];
