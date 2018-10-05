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
    'defaults' => [
        'page_description' => 'osu! - Rytmi on vain klikkauksen päässä! Varustettuna Ouendan/EBA ja Taikosta tutuilla sekä alkuperäisillä pelimuodoilla ja täysin toiminnallisella tasoeditorilla.',
    ],

    'menu' => [
        'home' => [
            '_' => 'etusivu',
            'account-edit' => 'asetukset',
            'friends-index' => 'ystävät',
            'changelog-index' => 'päivityshistoria',
            'changelog-build' => 'versio',
            'getDownload' => 'lataa',
            'getIcons' => 'kuvakkeet',
            'groups-show' => 'ryhmät',
            'index' => 'hallinta',
            'legal-show' => 'tiedot',
            'news-index' => 'uutiset',
            'news-show' => 'uutiset',
            'password-reset-index' => 'palauta salasana',
            'search' => 'haku',
            'supportTheGame' => 'tue peliä',
            'team' => 'tiimi',
        ],
        'help' => [
            '_' => 'apua',
            'getFaq' => 'ukk',
            'getRules' => 'säännöt',
            'getSupport' => 'tarvitsen siis oikeasti apua!',
            'getWiki' => 'wiki',
            'wiki-show' => 'wiki',
        ],
        'beatmaps' => [
            '_' => 'beatmapit',
            'artists' => 'suositellut artistit',
            'beatmap_discussion_posts-index' => 'viestit karttakeskusteluissa',
            'beatmap_discussions-index' => 'karttakeskustelut',
            'beatmapset-watches-index' => 'modiseuranta',
            'beatmapset_discussion_votes-index' => 'äänet karttakeskusteluissa',
            'beatmapset_events-index' => 'beatmapin tapahtumat',
            'index' => 'listaus',
            'packs' => 'kokoelmat',
            'show' => 'info',
        ],
        'beatmapsets' => [
            '_' => 'beatmapit',
            'discussion' => 'modaus',
        ],
        'rankings' => [
            '_' => 'tilastot',
            'index' => 'suorituskyky',
            'performance' => 'suorituskyky',
            'charts' => 'valokeilassa',
            'score' => 'pisteet',
            'country' => 'maa',
            'kudosu' => 'kudosu',
        ],
        'community' => [
            '_' => 'yhteisö',
            'dev' => 'kehitystyö',
            'getForum' => 'foorumit',
            'getChat' => 'chat',
            'getLive' => 'livenä',
            'contests' => 'kilpailut',
            'profile' => 'profiili',
            'tournaments' => 'turnaukset',
            'tournaments-index' => 'turnaukset',
            'tournaments-show' => 'turnausinfo',
            'forum-topic-watches-index' => 'seurattuna',
            'forum-topics-create' => 'foorumit',
            'forum-topics-show' => 'foorumit',
            'forum-forums-index' => 'foorumit',
            'forum-forums-show' => 'foorumit',
        ],
        'multiplayer' => [
            '_' => 'moninpeli',
            'show' => 'peli',
        ],
        'error' => [
            '_' => 'virhe',
            '404' => 'puuttuu',
            '403' => 'kielletty',
            '401' => 'ei sallittu',
            '405' => 'puuttuu',
            '500' => 'jotain hajosi',
            '503' => 'huolto',
        ],
        'user' => [
            '_' => 'käyttäjä',
            'getLogin' => 'kirjaudu sisään',
            'disabled' => 'poistettu käytöstä',

            'register' => 'rekisteröidy',
            'reset' => 'palauta',
            'new' => 'uusi',

            'messages' => 'Viestit',
            'settings' => 'Asetukset',
            'logout' => 'Kirjaudu ulos',
            'help' => 'Apua',
            'modding-history-discussions' => 'käyttäjän modauskeskustelut',
            'modding-history-events' => 'käyttäjän modaustapahtumat',
            'modding-history-index' => 'käyttäjän modaushistoria',
            'modding-history-posts' => 'käyttäjän modausviestit',
            'modding-history-votesGiven' => 'käyttäjän antamat modausäänet',
            'modding-history-votesReceived' => 'käyttäjän saamat modausäänet',
        ],
        'store' => [
            '_' => 'kauppa',
            'checkout-show' => 'kassa',
            'getListing' => 'listaus',
            'cart-show' => 'ostoskori',

            'getCheckout' => 'kassa',
            'getInvoice' => 'lasku',
            'products-show' => 'tuote',

            'new' => 'uusi',
            'home' => 'etusivu',
            'index' => 'etusivu',
            'thanks' => 'kiitos',
        ],
        'admin-forum' => [
            '_' => '',
            'forum-covers-index' => '',
        ],
        'admin-store' => [
            '_' => '',
            'orders-index' => '',
            'orders-show' => '',
        ],
        'admin' => [
            '_' => '',
            'beatmapsets-covers' => '',
            'logs-index' => '',
            'root' => '',

            'beatmapsets' => [
                '_' => '',
                'show' => '',
            ],
        ],
    ],

    'footer' => [
        'general' => [
            '_' => 'Yleinen',
            'home' => 'Aloitus',
            'changelog-index' => 'Muutoshistoria',
            'beatmaps' => 'Beatmapit',
            'download' => 'Lataa osu!',
            'wiki' => 'Wiki',
        ],
        'help' => [
            '_' => 'Ohjeet & Yhteisö',
            'faq' => 'Usein kysytyt kysymykset',
            'forum' => 'Keskustelupalsta',
            'livestreams' => 'Live-lähetykset',
            'report' => 'Ilmoita ongelmasta',
        ],
        'legal' => [
            '_' => 'Lakiasiat ja tilanne',
            'copyright' => 'Copyright (DMCA)',
            'privacy' => 'Yksityisyys',
            'server_status' => 'Palvelimen tila',
            'source_code' => 'Lähdekoodi',
            'terms' => 'Käyttöehdot',
        ],
    ],

    'errors' => [
        '404' => [
            'error' => 'Sivu puuttuu',
            'description' => "Pahoittelut, mutta sivu jota hait ei ole täällä!",
        ],
        '403' => [
            'error' => "Sinun ei pitäisi olla täällä.",
            'description' => 'Voit silti yrittää mennä takaisin.',
        ],
        '401' => [
            'error' => "Sinun ei pitäisi olla täällä.",
            'description' => 'Voit silti yrittää mennä takaisin. Tai kirjautua sisään.',
        ],
        '405' => [
            'error' => 'Sivu puuttuu',
            'description' => "Pahoittelut, mutta sivu jota hait ei ole täällä!",
        ],
        '500' => [
            'error' => 'O ou! Jotain hajosi! ;_;',
            'description' => "Meille tulee automaattisesti jokaisesta virheestä ilmoitus.",
        ],
        'fatal' => [
            'error' => 'O ou! Jotain hajosi (pahasti)! ;_;',
            'description' => "Meille tulee automaattisesti jokaisesta virheestä ilmoitus.",
        ],
        '503' => [
            'error' => 'Alhaalla huollon ajaksi!',
            'description' => "Huolto yleensä kestää viidestä sekunnista kymmeneen minuuttiin. Jos me emme toimi vielä sen jälkeen, mene katsomaan :link lisäinformaatiota varten.",
            'link' => [
                'text' => '',
                'href' => '',
            ],
        ],
        // used by sentry if it returns an error
        'reference' => "Kaiken varalta, tässä on koodi jonka voit antaa tukitiimille!",
    ],

    'popup_login' => [
        'login' => [
            'email' => 'sähköpostiosoite',
            'forgot' => "Olen unohtanut tietoni",
            'password' => 'salasana',
            'title' => 'Kirjaudu sisään jatkaaksesi',

            'error' => [
                'email' => "Käyttäjänimeä tai sähköpostia ei ole",
                'password' => 'Väärä salasana',
            ],
        ],

        'register' => [
            'info' => "Tarvitset käyttäjän hyvä mies. Miksei sinulla ole jo sellaista?",
            'title' => "Etkö ole vielä rekisteröitynyt?",
        ],
    ],

    'popup_user' => [
        'links' => [
            'account-edit' => 'Asetukset',
            'friends' => 'Ystävät',
            'logout' => 'Kirjaudu ulos',
            'profile' => 'Profiili',
        ],
    ],

    'popup_search' => [
        'initial' => 'Kirjoita etsiäksesi!',
        'retry' => 'Haku epäonnistui. Yritä uudelleen napsauttamalla.',
    ],
];
