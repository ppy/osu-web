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
        'warehouse' => 'Sklad',
    ],

    'cart' => [
        'checkout' => 'Platba',
        'more_goodies' => 'Chcem sa ešte pozrieť na viac dobrôt než dokončím objednávku',
        'shipping_fees' => 'poplatky za dopravu',
        'title' => 'Nákupný Košík',
        'total' => 'spolu',

        'errors_no_checkout' => [
            'line_1' => 'Ups, nastali problémy s vaším košíkom, ktoré zabraňuju platbe!',
            'line_2' => 'Pre pokračovanie odstraňte alebo aktualizujte predmety hore.',
        ],

        'empty' => [
            'text' => 'Váš košík je prázdny.',
            'return_link' => [
                '_' => 'Vrať sa na :link, aby si našiel nejaké dobroty!',
                'link_text' => 'veci v obchode',
            ],
        ],
    ],

    'checkout' => [
        'cart_problems' => 'Ups, s tvojim košíkom sa vyskytli nejaké problémy!',
        'cart_problems_edit' => 'Pre editovanie klikni sem.',
        'declined' => 'Tvoja platba bola zamietnutá.',
        'delayed_shipping' => 'Momentálne sme zaplavení objednávkami! Svoju objednávku môžeš zadať, ale prosím počítaj s **dodatočným 1-2 tyždennym oneskorením** zatial čo dokončíme existujúce objednávky.',
        'old_cart' => 'Obsah tvojho košíka sa zdá byť zastaralý a preto bol znovu načítaný, skus to prosím znovu.',
        'pay' => 'Platba cez PayPal',

        'has_pending' => [
            '_' => 'Nemáte dokončené platby, kliknite :link aby ste si ich mohli pozrieť.',
            'link_text' => 'tu',
        ],

        'pending_checkout' => [
            'line_1' => 'Predchádzajúci nákup nebol dokončený.',
            'line_2' => 'Pokračujte v platbe vybraním platobnej metódy.',
        ],
    ],

    'discount' => 'ušetri :percent%',

    'invoice' => [
        'echeck_delay' => '',
        'status' => [
            'processing' => [
                'title' => 'Vaša platba ešte nebola potvrdená!',
                'line_1' => '',
                'line_2' => [
                    '_' => 'Ak sa vyskytol problém počas platby, :link',
                    'link_text' => 'kliknutím sem obnovíte vašu platbu',
                ],
            ],
        ],
    ],

    'mail' => [
        'payment_completed' => [
            'subject' => 'Obdržali sme tvoju osu!store objednávku!',
        ],
    ],

    'order' => [
        'paid_on' => '',

        'invoice' => 'Zobraziť faktúru',
        'no_orders' => 'Žiadne objednávky na zobrazenie.',

        'item' => [
            'display_name' => [
                'supporter_tag' => ':name pre :username (:duration)',
            ],
            'quantity' => 'Množstvo',
        ],

        'not_modifiable_exception' => [
            'cancelled' => 'Nemôžeš upraviť svoju objednávku, kedže bola zrušená.',
            'checkout' => 'Nemôźeš upraviť svoju objednávku, kedže sa už spracováva.', // checkout and processing should have the same message.
            'default' => 'Objednávka je neupravitelná',
            'delivered' => 'Nemôžeš upraviť svoju objednávku, kedže už bola doručená.',
            'paid' => 'Nemôžeš upraviť svoju objednávku, kedže si za ňu už zaplatil.',
            'processing' => 'Nemôžeš upraviť svoju objednávku, kedže je v stave spracovania.',
            'shipped' => 'Nemôžeš upraviť svoju objednávku, kedže bola dodaná.',
        ],

        'status' => [
            'cancelled' => 'Zrušené',
            'checkout' => 'Pripravuje sa',
            'delivered' => 'Objednávka doručená',
            'paid' => 'Zaplatené',
            'processing' => '',
            'shipped' => '',
        ],
    ],

    'product' => [
        'name' => 'Meno',

        'stock' => [
            'out' => 'Táto položka je momentálne vypredaná. Vráť sa neskôr!',
            'out_with_alternative' => 'Bohužial, táto položka je vypredaná. Použi rozbaľovací zoznam pre výber iného druhu alebo sa pozri neskôr!',
        ],

        'add_to_cart' => 'Pridať do košíka',
        'notify' => 'Informujte ma, ak je k dispozícii!',

        'notification_success' => 'budeš informovaný, keď budeme mať nové zásoby. kliknite :link pre zrušenie',
        'notification_remove_text' => 'tu',

        'notification_in_stock' => 'Tento produkt už je na sklade!',
    ],

    'supporter_tag' => [
        'gift' => 'darovať hráčovi',
        'require_login' => [
            '_' => 'Musíš byť :link aby si dostal osu!supporter tag!',
            'link_text' => 'prihlásený',
        ],
    ],

    'username_change' => [
        'check' => 'Zadaj uživatelské meno pre kontrolu dostupnosti!',
        'checking' => 'Prebieha kontrola dostupnosti uživatelského mena :username...',
        'require_login' => [
            '_' => 'Pre zmenu uživatelského mena sa musíš :link!',
            'link_text' => 'prihlásený',
        ],
    ],
];
