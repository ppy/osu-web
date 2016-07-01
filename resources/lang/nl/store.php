<?php

/**
 *    Copyright 2016 ppy Pty. Ltd.
 *
 *    This file is part of osu!web. osu!web is distributed in the hopes of
 *    attracting more community contributions to the core ecosystem of osu!
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
        'warehouse' => 'Warenhuis',
    ],

    'checkout' => [
        'pay' => 'Afrekenen met Paypal',
        'delayed_shipping' => 'We zijn momenteel overstelpt met bestellingen! Je kunt nog steeds bestellingen maken maar verwacht **een vertagen van 1-2 weken** terwijl we de bestaande bestellingen verwerken.',
    ],

    'order' => [
        'item' => [
            'quantity' => 'Aantal',
        ],
    ],

    'product' => [
        'name' => 'Naam',

        'stock' => [
            'out' => 'Momenteel niet op voorraad :(. Probeer later opnieuw.',
            'out_with_alternative' => 'Dit type is momenteel niet op voorraad :(. Probeer een ander type of probeer later opnieuw.',
        ],

        'add_to_cart' => 'Voeg toe aan winkelmand',
        'notify' => 'Laat me weten wanneer het beschikbaar is!',

        'notification_success' => 'we zullen het je laten weten wanneer dit weer op voorraad is. klik :link om te annuleren',
        'notification_remove_text' => 'hier',

        'notification_in_stock' => 'Dit product is al op voorraad!',

        'notification_exists' => 'Je hebt een notificatie aangevraagd voor wanneer dit beschikbaar is!',
        'notification_doesnt_exist' => 'Je hebt niet eens notificatie aangevraagd voor wanneer dit beschikbaar is!',
    ],
];
