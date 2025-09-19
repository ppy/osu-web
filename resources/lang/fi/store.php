<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'cart' => [
        'checkout' => 'Kassa',
        'empty_cart' => 'Poista kaikki tuotteet ostoskärrystä',
        'info' => ':count_delimited tuote ostoskärryssä ($:subtotal)|:count_delimited tuotetta ostoskärryssä ($:subtotal)',
        'more_goodies' => 'Tarkastelisin vielä muita tuotteita ennen tilauksen tekemistä',
        'shipping_fees' => 'toimituskulut',
        'title' => 'Ostoskärry',
        'total' => 'yhteensä',

        'errors_no_checkout' => [
            'line_1' => 'Jassoo... kassalle ei pääse, sillä ostoskärryssäsi on ongelmia!',
            'line_2' => 'Poista tai päivitä ylläolevat tavarat jatkaaksesi.',
        ],

        'empty' => [
            'text' => 'Ostoskärrysi on tyhjä.',
            'return_link' => [
                '_' => 'Palaa takaisin :link tehdäksesi löytöjä!',
                'link_text' => 'kauppasivulle',
            ],
        ],
    ],

    'checkout' => [
        'cart_problems' => 'Oijoi, ostoskärryssäsi on ongelmia!',
        'cart_problems_edit' => 'Napsauta tästä muokataksesi sitä.',
        'declined' => 'Maksu peruutettiin.',
        'delayed_shipping' => 'Olemme tällä hetkellä hukkumassa tilauksiin! Olet vapaa tilaamaan, mutta ole valmis odottamaan **1-2 viikkoa lisää** kunnes olemme saaneet nykyiset tilaukset lähetettyä.',
        'hide_from_activity' => 'Älä ilmoita osu!supporter tilauksesta profiilissani',
        'old_cart' => 'Ostoskärrysi näyttää olevan vanhentunut ja on ladattu uudestaan, ole hyvä ja yritä uudelleen.',
        'pay' => 'Maksa Paypalilla',
        'title_compact' => 'kassa',

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
    'free' => 'ilmainen!',

    'invoice' => [
        'contact' => 'Ota yhteyttä:',
        'date' => 'Päivämäärä:',
        'echeck_delay' => 'Koska maksusi oli eCheck, anna maksimissaan 10 päivää että maksu pääsee PayPalin läpi!',
        'echeck_denied' => '',
        'hide_from_activity' => 'Tämän tilauksen osu!tukijamerkkejä ei näytetä viimeaikaisessa toiminnassasi.',
        'sent_via' => 'Lähetetty kautta:',
        'shipping_to' => 'Toimitetaan kohteeseen:',
        'title' => 'Lasku',
        'title_compact' => 'lasku',

        'status' => [
            'cancelled' => [
                'title' => 'Tilauksesi on peruutettu',
                'line_1' => [
                    '_' => "Jos et pyytänyt peruutusta, ota yhteyttä :link ja mainitse tilauksesi numero (#:order_number).",
                    'link_text' => 'osu!kaupan tukeen',
                ],
            ],
            'delivered' => [
                'title' => 'Tilauksesi on toimitettu! Toivottavasti pidät siitä!',
                'line_1' => [
                    '_' => 'Jos sinulla on ongelmia ostoksesi kanssa, ota yhteyttä :link.',
                    'link_text' => 'osu!kaupan tukeen',
                ],
            ],
            'prepared' => [
                'title' => 'Tilaustasi valmistellaan!',
                'line_1' => 'Odota sen lähettämistä vähän pidempään. Seurantatiedot tulevat näkyviin tässä, kun tilaus on käsitelty ja lähetetty. Tämä voi kestää jopa viisi päivää (mutta yleensä vähemmän!) riippuen siitä, kuinka kiireisiä olemme.',
                'line_2' => 'Lähetämme kaikki tilaukset Japanista käyttämällä erilaisia kuljetuspalveluja riippuen tilauksen painosta ja arvosta. Tämä alue päivittyy yksityiskohdilla, kun olemme lähettäneet tilauksen.',
            ],
            'processing' => [
                'title' => 'Maksuasi ei ole vielä vahvistettu!',
                'line_1' => 'Jos olet jo maksanut, me saatamme silti odottaa varmistusta maksustasi. Päivitä sivu yhden tai kahden minuutin kuluttua!',
                'line_2' => [
                    '_' => 'Jos sinulla on ongelmia maksun aikana, :link',
                    'link_text' => 'klikkaa tästä jatkaaksesi maksamista',
                ],
            ],
            'shipped' => [
                'title' => 'Tilauksesi on lähetetty!',
                'tracking_details' => 'Seurantatiedot ovat seuraavat:',
                'no_tracking_details' => [
                    '_' => "Meillä ei ole seurantatietoja, koska lähetimme pakettisi lentopostin kautta, mutta voit odottaa saavasi sen 1-3 viikon päästä. Euroopan kohdalla tullit voivat joskus viivyttää tilausta, mille emme voi mitään. Jos sinulla herää huolia, ole hyvä ja vastaa sähköpostiin tilausvahvistuksesta, jonka sait :link.",
                    'link_text' => 'lähetä meille sähköpostia',
                ],
            ],
        ],
    ],

    'order' => [
        'cancel' => 'Peruuta tilaus',
        'cancel_confirm' => 'Tämä tilaus peruutetaan ja maksua ei hyväksytä siitä. Maksupalveluntarjoaja ei ehkä vapauta varattuja varoja välittömästi. Oletko varma?',
        'cancel_not_allowed' => 'Tätä tilausta ei voi peruuttaa tällä hetkellä.',
        'invoice' => 'Näytä lasku',
        'no_orders' => 'Ei tilauksia katsottavissa.',
        'paid_on' => 'Tilaus tehty :date',
        'resume' => 'Jatka kassalle',
        'shipping_and_handling' => 'Toimitus & käsittely',
        'shopify_expired' => 'Tämän tilauksen kassalinkki on vanhentunut.',
        'subtotal' => 'Välisumma',
        'total' => 'Yhteensä',

        'details' => [
            'order_number' => 'Tilaus #',
            'payment_terms' => 'Maksuehdot',
            'salesperson' => 'Myyjä',
            'shipping_method' => 'Toimitustapa',
            'shipping_terms' => 'Toimitusehdot',
            'title' => 'Tilauksen tiedot',
        ],

        'item' => [
            'quantity' => 'Määrä',

            'display_name' => [
                'supporter_tag' => ':name käyttäjälle :username (:duration)',
            ],

            'subtext' => [
                'supporter_tag' => 'Viesti: :message',
            ],
        ],

        'not_modifiable_exception' => [
            'cancelled' => 'Et voi muokata tilaustasi, sillä se on peruuntunut.',
            'checkout' => 'Et voi muokata tilaustasi silloin kun sitä käsitellään.', // checkout and processing should have the same message.
            'default' => 'Tilausta ei voi muokata',
            'delivered' => 'Et voi muokata tilaustasi, sillä se on jo toimitettu.',
            'paid' => 'Et voi muokata tilaustasi, sillä se on jo maksettu.',
            'processing' => 'Et voi muokata tilaustasi silloin kun sitä käsitellään.',
            'shipped' => 'Et voi muokata tilaustasi, sillä se on jo matkalla.',
        ],

        'status' => [
            'cancelled' => 'Peruutettu',
            'checkout' => 'Valmistellaan',
            'delivered' => 'Toimitettu',
            'paid' => 'Maksettu',
            'processing' => 'Odotetaan varmistusta',
            'shipped' => 'Kuljetuksessa',
            'title' => 'Tilauksen tilanne',
        ],

        'thanks' => [
            'title' => 'Kiitos tilauksestasi!',
            'line_1' => [
                '_' => 'Saat pian vahvistusviestin sähköpostilla. Jos sinulla on kysyttävää, ole hyvä ja :link!',
                'link_text' => 'ota yhteyttä meihin',
            ],
        ],
    ],

    'product' => [
        'name' => 'Nimi',

        'stock' => [
            'out' => 'Tätä tavaraa ei ole tällä hetkellä saatavilla. Tarkista myöhemmin uudelleen!',
            'out_with_alternative' => 'Valitettavasti tätä tuotetta ei ole enää saatavilla. Käytä valikkoa valitaksesi toinen vaihtoehto tai tarkista myöhemmin uudelleen!',
        ],

        'add_to_cart' => 'Lisää kärryihin',
        'notify' => 'Ilmoita minulle, kun saatavilla!',
        'out_of_stock' => '',

        'notification_success' => 'saat ilmoituksen, kun meillä on täydennystä. klikkaa :link peruuttaaksesi',
        'notification_remove_text' => 'tässä',

        'notification_in_stock' => 'Tätä tuotetta on jo varastossa!',
    ],

    'supporter_tag' => [
        'gift' => 'lahjoita pelaajalle',
        'gift_message' => 'lisää omavalintainen viesti lahjaasi! (enintään :length merkkiä)',

        'require_login' => [
            '_' => 'Sinun pitää olla :link, jotta voit hankkia osu!tukijamerkin!',
            'link_text' => 'kirjautuneena sisään',
        ],
    ],

    'username_change' => [
        'check' => 'Kirjoita käyttäjänimi saatavuuden tarkistamiseksi!',
        'checking' => 'Tarkistetaan saatavuutta nimelle :username...',
        'placeholder' => 'Pyydetty käyttäjänimi',
        'label' => 'Uusi käyttäjänimi',
        'current' => 'Nykyinen käyttäjänimesi on ":username".',

        'require_login' => [
            '_' => 'Sinun on oltava :link vaihtaaksesi nimesi!',
            'link_text' => 'kirjautuneena sisään',
        ],
    ],

    'xsolla' => [
        'distributor' => '',
    ],
];
