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
        'page_description' => 'Osu! - Rytmi on vain klikkauksen päässä! Quendan/EBA:n kanssa , Taiko ja alkuperäiset modit joilla voit pelata, mukaan ottaen täysin toimiva tason editori.',
    ],

    'menu' => [
        'home' => [
            '_' => 'aloitus',
            'account-edit' => 'asetukset',
            'friends-index' => 'ystävät',
            'changelog-index' => 'päivityshistoria',
            'changelog-show' => 'versio',
            'getDownload' => 'lataa',
            'getIcons' => 'kuvakkeet',
            'groups-show' => 'ryhmät',
            'index' => 'hallintapaneeli',
            'legal-show' => 'tiedot',
            'news-index' => 'uutiset',
            'news-show' => 'uutiset',
            'password-reset-index' => 'palauta salasana',
            'search' => 'hae',
            'supportTheGame' => 'tue peliä',
            'team' => 'tiimi',
        ],
        'help' => [
            '_' => 'ohje',
            'getFaq' => 'ukk',
            'getRules' => 'säännöt',
            'getSupport' => 'ei, oikeasti, tarvitsen apua!',
            'getWiki' => 'wiki',
            'wiki-show' => 'wiki',
        ],
        'beatmaps' => [
            '_' => 'rytmikartat',
            'artists' => 'suositellut artistit',
            'beatmap_discussion_posts-index' => 'rytmikarttojen keskustelujen viestit',
            'beatmap_discussions-index' => 'rytmikarttojen keskustelut',
            'beatmapset-watches-index' => 'modauslista',
            'beatmapset_discussion_votes-index' => 'rytmikarttojen keskustelujen äänet',
            'beatmapset_events-index' => 'rytmikarttasetin tapahtumat',
            'index' => 'listaus',
            'packs' => 'paketit',
            'show' => 'info',
        ],
        'beatmapsets' => [
            '_' => 'rytmikartat',
            'discussion' => 'modaus',
        ],
        'rankings' => [
            '_' => 'sijoitukset',
            'index' => 'tulokset',
            'performance' => 'tulokset',
            'charts' => 'parrasvalo',
            'score' => 'pistemäärä',
            'country' => 'maa',
            'kudosu' => 'kudosu',
        ],
        'community' => [
            '_' => 'yhteisö',
            'dev' => 'keihtys',
            'getForum' => 'foorumit',
            'getChat' => 'chat',
            'getLive' => 'suora',
            'contests' => 'kilpailut',
            'profile' => 'profiili',
            'tournaments' => 'turnaukset',
            'tournaments-index' => 'turnaukset',
            'tournaments-show' => 'turnausinfo',
            'forum-topic-watches-index' => 'tilaukset',
            'forum-topics-create' => 'foorumit',
            'forum-topics-show' => 'foorumit',
            'forum-forums-index' => 'foorumit',
            'forum-forums-show' => 'foorumit',
        ],
        'multiplayer' => [
            '_' => 'moninpeli',
            'show' => 'ottelu',
        ],
        'error' => [
            '_' => 'virhe',
            '404' => 'puuttuva',
            '403' => 'kielletty',
            '401' => 'ei sallittu',
            '405' => 'puuttuva',
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
            'help' => 'Ohje',
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
            'home' => 'aloitus',
            'index' => 'aloitus',
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
            'changelog-index' => 'Päivityshistoria',
            'beatmaps' => 'Rytmikarttojen listaus',
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
        'support' => [
            '_' => 'Tue osua!',
            'tags' => 'Kannattajatagit',
            'merchandise' => 'Myytävät tuotteet',
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
            'description' => "Anteeksi, mutta sivu jota hait ei ole täällä!",
        ],
        '403' => [
            'error' => "Sinun ei pitäisi olla täällä.",
            'description' => 'Voit yrittää mennä takaisin silti.',
        ],
        '401' => [
            'error' => "Sinun ei pitäisi olla täällä.",
            'description' => 'Voit yrittää mennä takaisin silti. Tai yrittää kirjautua sisään.',
        ],
        '405' => [
            'error' => 'Sivu puuttuu',
            'description' => "Anteeksi, mutta sivu jota hait ei ole täällä!",
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
        'reference' => "Kaiken varalta, tässä sinulle koodia jonka voit antaa tukeaksesi!",
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
            'info' => "Sinä tarvitset käyttäjän, herra. Miksei sinulle ole sellaista jo?",
            'title' => "Etkö ole vielä rekisteröitynyt?",
        ],
    ],

    'popup_user' => [
        'links' => [
            'account-edit' => 'Asetukset',
            'friends' => 'Ystävät',
            'logout' => 'Kirjaudu ulos',
            'profile' => 'Oma profiili',
        ],
    ],

    'popup_search' => [
        'initial' => 'Kirjoita etsiäksesi!',
        'retry' => 'Haku epäonnistui. Yritä uudelleen napsauttamalla.',
    ],
];
