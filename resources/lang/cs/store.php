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
    'admin' => [
        'warehouse' => 'Sklad',
    ],

    'cart' => [
        'checkout' => 'Zaplatit',
        'more_goodies' => 'Chci se ještě na něco podívat než dokončím objednávku',
        'shipping_fees' => 'poplatky za dopravu',
        'title' => 'Nákupní košík',
        'total' => 'celkem',

        'errors_no_checkout' => [
            'line_1' => 'Ale ne! Nastaly problémy s vaším košíkem, které zabraňují zaplacení.',
            'line_2' => 'Pro pokračování odstraňte nebo aktualizujte předměty nahoře.',
        ],

        'empty' => [
            'text' => 'Váš košík je prázdný.',
            'return_link' => [
                '_' => 'Vrať se :link, abys našel další skvělé věci!',
                'link_text' => 'věci v obchodě',
            ],
        ],
    ],

    'checkout' => [
        'cart_problems' => 'Ale ne, s Vaším košíkem se vyskytly nějaké potíže!',
        'cart_problems_edit' => 'Pro editaci klikněte sem.',
        'declined' => 'Vaše platba byla zrušena.',
        'old_cart' => 'Obsah Vašeho košíku se zdá být zastaralý a proto byl znovu načten, zkuste to prosím znovu.',
        'pay' => 'Zaplatit přes Paypal',
        'pending_checkout' => [
            'line_1' => 'Předchozí nákup nebyl dokončen.',
            'line_2' => 'Pokračujte v platbě vybráním platební metody, nebo :link ke zrušení.',
            'link_text' => 'klikněte zde',
        ],
        'delayed_shipping' => 'V tuto chvíli jsme zahlceni objednávkami! Svou objednávku můžete umístit, ale počítejte prosím s **dalšími 1-2 týdny zpoždění** zatímco dokončíme už existující objednávky.',
    ],

    'discount' => 'ušetřete :percent%',

    'mail' => [
        'payment_completed' => [
            'subject' => 'Obdrželi jsme Vaši osu!store objednávku!',
        ],
    ],

    'order' => [
        'item' => [
            'display_name' => [
                'supporter_tag' => ':name pro :username (:duration)',
            ],
            'quantity' => 'Množství',
        ],

        'not_modifiable_exception' => [
            'cancelled' => 'Nemůžeš upravit svou objednávku, jelikož byla stornována.',
            'checkout' => 'Nemůžeš upravit svou objednávku, jelikož se již zpracovává.', // checkout and processing should have the same message.
            'default' => 'Objednávka se nedá upravit',
            'delivered' => 'Nemůžeš upravit svou objednávku, jelikož již byla doručena.',
            'paid' => 'Nemůžeš upravit svou objednávku, jelikož jsi za ni již zaplatil.',
            'processing' => 'Nemůžeš upravit svou objednávku, jelikož se již zpracovává.',
            'shipped' => 'Nemůžeš upravit svou objednávku, jelikož již byla odeslána.',
        ],
    ],

    'product' => [
        'name' => 'Název',

        'stock' => [
            'out' => 'Tato položka je momentálně vyprodána. Vraťte se prosím později!',
            'out_with_alternative' => 'Tohle zboží bohužel není na skladě. Můžete použít rozevírací seznam pro výběr jiného druhu nebo to zkusit později!',
        ],

        'add_to_cart' => 'Přidat do košíku',
        'notify' => 'Informujte mě, až bude k dispozici!',

        'notification_success' => 'dáme Vám vědět až produkt znovu naskladníme. klikněte :link pro zrušení',
        'notification_remove_text' => 'zde',

        'notification_in_stock' => 'Tento produkt je už na skladě!',
    ],

    'supporter_tag' => [
        'gift' => 'darovat hráči',
        'require_login' => [
            '_' => 'Pro obdržení supporter tagu se musíte :link!',
            'link_text' => 'přihlásit',
        ],
    ],

    'username_change' => [
        'check' => 'Zadejte uživatelské jméno pro kontrolu dostupnosti!',
        'checking' => 'Probíha kontrola dostupnosti jména :username...',
        'require_login' => [
            '_' => 'Pro změnu uživatelského jména se musíte :link!',
            'link_text' => 'přihlásit',
        ],
    ],
];
