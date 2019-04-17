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
    'support' => [
        'header' => [
            // size in font-size
            'big_description' => 'Rakastatko osua!?<br/>
                                Tue osun kehittämistä! :D',
            'small_description' => '',
            'support_button' => 'Haluan tukea osu!a',
        ],

        'dev_quote' => 'osu! on täysin ilmainen peli, mutta sen pystyssä pitäminen ei todellakaan ole ilmaista.
        Palvelimien järjestämisen ja korkealaatuisen kansainvälisen kaistan lisäksi järjestelmän -ja yhteisön ylläpito,  
        palkintojen tarjoaminen kilpailuihin, tukipyyntöihin vastaaminen ja yleisesti porukan pitäminen tyytyväisenä kuluttaa huomattavan summan rahaa!
        Äläkä unohda, teemme tämän kaiken ilman mainoksia, työkalupalkkeja tai vastaavia.
            <br/><br/>Minä, joka yleisimmin tunnetaan nimellä "peppy" pitää osun! toiminnassa suurilta osin yksinään.
            Jouduin Lopettamaan päivätyöni pysyäkseni osun! mukana
            ja silti itse asettamieni laatuvaatimusten pitäminen on ajoittain hankalaa.
            Haluaisin henkilökohtaisesti kiittää kaikkia, jotka ovat tukeneet osun! toimintaa tähän mennessä 
            kuten myös heitä, jotka tukevat tätä loistavaa peliä ja yhteisöä tulevaisuudessa :).',

        'supporter_status' => [
            'contribution' => 'Kiitos tuestasi tähän saakka! Olet tukenut kokonaisuudessaan :dollars :tags tukijaostoksella!',
            'gifted' => 'Tagiostoksistasi :giftedTags on lahjoitettu (yhteensä :giftedDollars), kuinka anteliasta!',
            'not_yet' => "Et ole vielä tukija :(",
            'title' => 'Tukemisesi tämänhetkinen tila',
            'valid_until' => 'Nykyinen tukijatagi on voimassa :date asti!',
            'was_valid_until' => 'Tukijatagisi oli voimassa :date asti.',
        ],

        'why_support' => [
            'title' => 'Miksi tukisin osu!a?',
            'blocks' => [
                'dev' => 'Kehitetty ja ylläpidetty yhden australialaisen henkilön voimin',
                'time' => 'Ylläpito vie niin paljon aikaa, että tätä ei voi kutsua enää "harrastukseksi".',
                'ads' => 'Mainoksia ei ole missään. <br/><br/>
 Toisin kuin 99.95% verkosta, me emme tee voittoa tunkemalla asioita naamallesi.',
                'goodies' => 'Saat lisäominaisuuksia käyttöösi!',
            ],
        ],

        'perks' => [
            'title' => 'Aha. No mitä minä sitten saan?!',
            'osu_direct' => [
                'title' => 'osu!direct',
                'description' => 'Nopea ja helppo tapa etsiä beatmappejä ilman tarvetta poistua pelistä.',
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
                'description' => 'Pääsy uusimpiin versioihin, joissa voit kokeilla uusia ominaisuuksia ennen päivitysten julkaisua!',
            ],

            'customisation' => [
                'title' => 'Kustomointi',
                'description' => 'Tee profiilistasi omalaatuinen lisäämällä täysin muokattava käyttäjä-sivu.',
            ],

            'beatmap_filters' => [
                'title' => 'Beatmappien Suodatus',
                'description' => 'Suodata beatmappien hakua pelatun, pelaamattoman sekä kartassa saavutetun luokituksen mukaan.',
            ],

            'yellow_fellow' => [
                'title' => 'Keltainen Kaveri',
                'description' => 'Sinut tunnistaa pelinsisäisissä keskusteluissa kirkkaankeltaisesta käyttäjänimen väristä.',
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

            'feel_special' => [
                'title' => 'Tunne itsesi erityiseksi',
                'description' => 'Lämmin ja mukava tunne tehdessäsi osuuttasi, jotta osu! pysyy pystyssä sulavasti!',
            ],

            'more_to_come' => [
                'title' => 'Lisää tulossa',
                'description' => '',
            ],
        ],

        'convinced' => [
            'title' => 'Vakuutuin! :D',
            'support' => 'tue osua!',
            'gift' => 'tai lahjoita Tukija toiselle pelaajalle',
            'instructions' => 'klikkaa sydäntä jatkaaksesi osu!kauppaan',
        ],
    ],
];
