<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'admin' => [
        'warehouse' => 'Sklad',
    ],

    'cart' => [
        'checkout' => 'Zaplatit',
        'info' => ':count_delimited položka v košíku ($:subtotal)|:count_delimited položkek v košíku ($:subtotal)',
        'more_goodies' => 'Chci se ještě podívat na nějaké dobroty než dokončím objednávku',
        'shipping_fees' => 'poplatky za dopravu',
        'title' => 'Nákupní košík',
        'total' => 'celkem',

        'errors_no_checkout' => [
            'line_1' => 'Ale né! Nastaly problémy s vaším košíkem, které zabraňují zaplacení!',
            'line_2' => 'Pro pokračování odstraňte nebo aktualizujte předměty nahoře.',
        ],

        'empty' => [
            'text' => 'Váš košík je prázdný.',
            'return_link' => [
                '_' => 'Vrať se na :link, abys našel nějaké skvělé věci!',
                'link_text' => 'věci v obchodě',
            ],
        ],
    ],

    'checkout' => [
        'cart_problems' => 'Ale né, s tvým košíkem se vyskytly nějaké potíže!',
        'cart_problems_edit' => 'Pro editaci klikni sem.',
        'declined' => 'Tvá platba byla zrušena.',
        'delayed_shipping' => 'V tuto chvíli jsme zahlceni objednávkami! Svou objednávku můžeš umístit, ale počítej prosím s **dalšími 1-2 týdny zpoždění** zatímco dokončíme už existující objednávky.',
        'old_cart' => 'Obsah tvého košíku se zdá být zastaralý a proto byl znovu načten, zkus to prosím znovu.',
        'pay' => 'Zaplatit přes PayPal',
        'title_compact' => 'zaplatit',

        'has_pending' => [
            '_' => 'Máte nedokončené platby, klikněte na :link pro zobrazení.',
            'link_text' => 'zde',
        ],

        'pending_checkout' => [
            'line_1' => 'Předchozí nákup nebyl dokončen.',
            'line_2' => 'Pokračujte v platbě vybráním platební metody.',
        ],
    ],

    'discount' => 'ušetři :percent%',

    'invoice' => [
        'echeck_delay' => 'Jelikož vaše platba byla prováděna službou eCheck, prosím, dejte nám až 10 dní na to, aby platba úspěšně prošla přes PayPal!',
        'title_compact' => 'faktura',

        'status' => [
            'processing' => [
                'title' => 'Vaše platba nebyla ještě potvrzena!',
                'line_1' => 'Pokud jste už zaplatil, možná stále čekáme na potvrzení vaší platby. Prosím, dejte nám pár minut a pak zkuste znovu načíst tuto stránku!',
                'line_2' => [
                    '_' => 'Pokud se vyskytl problém při placení, :link',
                    'link_text' => 'klikněte zde pro pokračování v placení',
                ],
            ],
        ],
    ],

    'order' => [
        'cancel' => '',
        'cancel_confirm' => '',
        'cancel_not_allowed' => '',
        'invoice' => 'Zobrazit fakturu',
        'no_orders' => 'Nejsou zde žádné objednávky k zobrazení.',
        'paid_on' => 'Objednávka vystavena dne :date',
        'resume' => 'Obnovit objednávku',
        'shopify_expired' => '',

        'item' => [
            'display_name' => [
                'supporter_tag' => ':name pro :username (:duration)',
            ],
            'quantity' => 'Množství',
        ],

        'not_modifiable_exception' => [
            'cancelled' => 'Nemůžeš upravit svou objednávku, jelikož byla stornována.',
            'checkout' => 'Nemůžeš upravit svou objednávku, jelikož se již zpracovává.', // checkout and processing should have the same message.
            'default' => 'Objednávka je neupravitelná',
            'delivered' => 'Nemůžeš upravit svou objednávku, jelikož již byla doručena.',
            'paid' => 'Nemůžeš upravit svou objednávku, jelikož jsi za ni již zaplatil.',
            'processing' => 'Nemůžeš upravit svou objednávku, jelikož se již zpracovává.',
            'shipped' => 'Nemůžeš upravit svou objednávku, jelikož již byla odeslána.',
        ],

        'status' => [
            'cancelled' => 'Zrušeno',
            'checkout' => 'V přípravě',
            'delivered' => 'Doručeno',
            'paid' => 'Zaplaceno',
            'processing' => 'Očekávající potvrzení',
            'shipped' => 'Na cestě',
        ],
    ],

    'product' => [
        'name' => 'Název',

        'stock' => [
            'out' => 'Tato položka je momentálně vyprodána. Vrať se prosím později!',
            'out_with_alternative' => 'Tohle zboží bohužel není na skladě. Můžeš použít rozevírací seznam pro výběr jiného druhu nebo to zkusit později!',
        ],

        'add_to_cart' => 'Přidat do košíku',
        'notify' => 'Informujte mě, až bude k dispozici!',

        'notification_success' => 'dáme ti vědět, až produkt znovu naskladníme. klikněte :link pro zrušení',
        'notification_remove_text' => 'zde',

        'notification_in_stock' => 'Tento produkt je už na skladě!',
    ],

    'supporter_tag' => [
        'gift' => 'darovat hráči',
        'require_login' => [
            '_' => 'Pro obdržení štítku podporovatele se musíš :link!',
            'link_text' => 'přihlášený',
        ],
    ],

    'username_change' => [
        'check' => 'Zadej uživatelské jméno pro kontrolu dostupnosti!',
        'checking' => 'Probíhá kontrola dostupnosti uživatelského jména :username...',
        'require_login' => [
            '_' => 'Pro změnu uživatelského jména se musíš :link!',
            'link_text' => 'přihlášený',
        ],
    ],

    'xsolla' => [
        'distributor' => '',
    ],
];
