<?php

/**
 *    Copyright 2015-2017 ppy Pty. Ltd.
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
        'warehouse' => 'Lager',
    ],

    'checkout' => [
        'cart_problems' => 'Uh oh, det finns problem med din varukorg!',
        'cart_problems_edit' => 'Klicka här för att redigera det.',
        'declined' => 'Betalningen blev avbruten.',
        'error' => 'Det var ett problem med att slutföra din betalning :(',
        'pay' => 'Betala med Paypal',
        'delayed_shipping' => 'Vi är för nuvarande överväldigad med orders! Du får gärna placera din order, men du kanske kommer få en **extra 1-2 veckors försening** medans vi kommer ikapp alla ordrar.',
    ],

    'discount' => 'spara :percent%',

    'order' => [
        'item' => [
            'display_name' => [
                'supporter_tag' => ':name för :username (:duration)',
            ],
            'quantity' => 'Antal',
        ],
    ],

    'product' => [
        'name' => 'Namn',

        'stock' => [
            'out' => 'Slut i lager :(. Kolla igen snart.',
            'out_with_alternative' => 'Denna typ är för närvarande slut i lager :(. Testa andra typer eller kolla igen snart.',
        ],

        'add_to_cart' => 'Lägg till i Varukorgen',
        'notify' => 'Notifiera mig när den är tillgänglig!',

        'notification_success' => 'du kommer bli notifierad när vi har nytt i lager. klicka :link för att avbryta',
        'notification_remove_text' => 'här',

        'notification_in_stock' => 'Denna produkt är redan i lager!',
    ],

    'supporter_tag' => [
        'gift' => 'present till spelare',
        'require_login' => [
            '_' => 'Du behöver vara :link för att få en supporter tagg!',
            'link_text' => 'inloggad',
        ],
    ],

    'username_change' => [
        'require_login' => [
            '_' => 'Du behöver var :link för att ändra ditt namn!',
            'link_text' => 'inloggad',
        ],
    ],
];
