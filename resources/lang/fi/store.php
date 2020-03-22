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
    'admin' => [
        'warehouse' => 'Varasto',
    ],

    'cart' => [
        'checkout' => 'Kassa',
        'info' => '',
        'more_goodies' => 'Tarkastelisin vielä muita tuotteita ennen tilauksen tekemistä',
        'shipping_fees' => 'toimituskulut',
        'title' => 'Ostoskori',
        'total' => 'yhteensä',

        'errors_no_checkout' => [
            'line_1' => 'Jassoo... kassalle ei pääse, sillä ostoskorissasi on ongelmia!',
            'line_2' => 'Poista tai päivitä ylläolevat tavarat jatkaaksesi.',
        ],

        'empty' => [
            'text' => 'Ostoskorisi on tyhjä.',
            'return_link' => [
                '_' => 'Palaa takaisin :link tehdäksesi löytöjä!',
                'link_text' => 'kauppasivulle',
            ],
        ],
    ],

    'checkout' => [
        'cart_problems' => 'Oijoi, korisi kanssa on ongelmia!',
        'cart_problems_edit' => 'Napsauta tästä muokataksesi sitä.',
        'declined' => 'Maksu peruutettiin.',
        'delayed_shipping' => 'Olemme tällä hetkellä hukkumassa tilauksiin! Olet vapaa tilaamaan, mutta ole valmis odottamaan **1-2 viikkoa lisää** kunnes olemme saaneet nykyiset tilaukset lähetettyä.',
        'old_cart' => 'Korisi näyttää olevan vanhentunut ja on ladattu uudestaan, yritä uudelleen.',
        'pay' => 'Maksa Paypalilla',

        'has_pending' => [
            '_' => 'Sinulla on keskeneräisiä ostoksia, klikkaa :link nähdäksesi ne.',
            'link_text' => 'tästä',
        ],

        'pending_checkout' => [
            'line_1' => 'Edellinen kassalla olo aloitettiin mutta ei hoidettu loppuun.',
            'line_2' => 'Jatka maksamista valitsemalla maksutapa.',
        ],
    ],

    'discount' => 'säästä :percent%',

    'invoice' => [
        'echeck_delay' => 'Koska maksusi oli eCheck, anna maksimissaan 10 päivää että maksu pääsee PayPalin läpi!',
        'status' => [
            'processing' => [
                'title' => 'Maksuasi ei ole vielä vahvistettu!',
                'line_1' => 'Jos olet jo maksanut, me saatamme silti odottaa varmistusta maksustasi. Päivitä sivu yhden tai kahden minuutin kuluttua!',
                'line_2' => [
                    '_' => 'Jos sinulla on ongelmia maksun aikana, :link',
                    'link_text' => 'klikkaa tästä jatkaaksesi maksamista',
                ],
            ],
        ],
    ],

    'order' => [
        'paid_on' => 'Tilaus laitettu :date',

        'invoice' => 'Näytä lasku',
        'no_orders' => 'Ei tilauksia katsottavissa.',
        'resume' => 'Jatka Kassalle',

        'item' => [
            'display_name' => [
                'supporter_tag' => ':name käyttäjälle :username (:duration)',
            ],
            'quantity' => 'Määrä',
        ],

        'not_modifiable_exception' => [
            'cancelled' => 'Et voi muokata tilaustasi, sillä se on peruuntunut.',
            'checkout' => 'Et voi muokata tilaustasi, koska sitä käsitellään vielä.', // checkout and processing should have the same message.
            'default' => 'Tilaus ei ole muokattavissa',
            'delivered' => 'Et voi muokata tilaustasi, sillä se on jo toimitettu.',
            'paid' => 'Et voi muokata tilaustasi, sillä se on jo maksettu.',
            'processing' => 'Et voi muokata tilaustasi, koska sitä käsitellään vielä.',
            'shipped' => 'Et voi muokata tilaustasi, sillä se on jo matkalla.',
        ],

        'status' => [
            'cancelled' => 'Peruutettu',
            'checkout' => 'Valmistellaan',
            'delivered' => 'Toimitettu',
            'paid' => 'Maksettu',
            'processing' => 'Odotetaan varmistusta',
            'shipped' => 'Kuljetuksessa',
        ],
    ],

    'product' => [
        'name' => 'Nimi',

        'stock' => [
            'out' => 'Tätä tavaraa ei ole tällä hetkellä saatavilla. Tarkista myöhemmin uudelleen!',
            'out_with_alternative' => 'Valitettavasti tätä tuotetta ei ole enää saatavilla. Käytä valikkoa valitaksesi toinen vaihtoehto tai tarkista myöhemmin uudelleen!',
        ],

        'add_to_cart' => 'Lisää koriin',
        'notify' => 'Ilmoita minulle, kun saatavilla!',

        'notification_success' => 'saat ilmoituksen, kun meillä on täydennystä. klikkaa :link peruuttaaksesi',
        'notification_remove_text' => 'tässä',

        'notification_in_stock' => 'Tätä tuotetta on jo varastossa!',
    ],

    'supporter_tag' => [
        'gift' => 'lahjoita pelaajalle',
        'require_login' => [
            '_' => 'Sinun pitää olla :link saadaksesi osu!tukijan!',
            'link_text' => 'kirjautunut sisään',
        ],
    ],

    'username_change' => [
        'check' => 'Kirjoita käyttäjänimi saatavuuden tarkistamiseksi!',
        'checking' => 'Tarkistetaan saatavuutta nimelle :username...',
        'require_login' => [
            '_' => 'Sinun on oltava :link vaihtaaksesi nimesi!',
            'link_text' => 'kirjautuneena sisään',
        ],
    ],

    'xsolla' => [
        'distributor' => '',
    ],
];
