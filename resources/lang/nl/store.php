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
        'warehouse' => 'Warenhuis',
    ],

    'cart' => [
        'checkout' => 'Afrekenen',
        'more_goodies' => 'Ik wil meer goodies bekijken voordat ik de bestelling voltooi',
        'shipping_fees' => 'verzendkosten',
        'title' => 'Winkewagen',
        'total' => 'totaal',

        'errors_no_checkout' => [
            'line_1' => 'Uh oh, er zijn problemen met je winkelwagen die het afrekenen verhinderen!',
            'line_2' => 'Verwijder of update bovenstaande voorwerpen om verder te gaan.',
        ],

        'empty' => [
            'text' => 'Je winkelwagen is leeg.',
            'return_link' => [
                '_' => 'Keer terug naar de :link om meer goodies te vinden!',
                'link_text' => 'aanbiedingen',
            ],
        ],
    ],

    'checkout' => [
        'cart_problems' => 'Uh oh, er zijn problemen met je winkelwagen!',
        'cart_problems_edit' => 'Klik hier om het te wijzigen.',
        'declined' => 'De betaling is geannuleerd.',
        'old_cart' => 'Je winkelwagen lijkt verouderd te zijn en wordt herladen, probeer het opnieuw.',
        'pay' => 'Afrekenen met Paypal',
        'pending_checkout' => [
            'line_1' => 'Een vorige checkout is gestart, maar niet geëindigd.',
            'line_2' => 'Hervat uw checkout door het selecteren van een betaalmethode, of :link om te annuleren.',
            'link_text' => 'klik hier',
        ],
        'delayed_shipping' => 'We zijn momenteel overweldigd met bestellingen! Je kunt nog steeds bestellingen plaatsen maar verwacht dan **een vertraging van 1-2 weken** terwijl wij de bestaande bestellingen verwerken.',
    ],

    'discount' => 'bespaar :percent%',

    'mail' => [
        'payment_completed' => [
            'subject' => 'We hebben uw osu!store bestelling ontvangen!',
        ],
    ],

    'order' => [
        'item' => [
            'display_name' => [
                'supporter_tag' => ':name voor :username (:duration)',
            ],
            'quantity' => 'Aantal',
        ],

        'not_modifiable_exception' => [
            'cancelled' => 'Je kan je bestelling niet wijzigen omdat hij geannuleerd is.',
            'checkout' => 'Je kan je bestelling niet wijzigen omdat hij geannuleerd is.', // checkout and processing should have the same message.
            'default' => 'Bestelling kan niet gewijzigd worden',
            'delivered' => 'Je kan je bestelling niet wijzigen omdat hij al afgeleverd is.',
            'paid' => 'Je kan je bestelling niet wijzigen omdat hij al betaald is.',
            'processing' => 'Je kan je bestelling niet wijzigen omdat hij verwerkt wordt.',
            'shipped' => 'Je kan je bestelling niet wijzigen omdat hij al verzonden is.',
        ],
    ],

    'product' => [
        'name' => 'Naam',

        'stock' => [
            'out' => 'Momenteel niet op voorraad :(. Probeer het later opnieuw.',
            'out_with_alternative' => 'Dit type is momenteel niet op voorraad :(. Probeer een ander type of probeer het later opnieuw.',
        ],

        'add_to_cart' => 'Voeg toe aan winkelwagen',
        'notify' => 'Laat me weten wanneer het beschikbaar is!',

        'notification_success' => 'we zullen het je laten weten wanneer het weer op voorraad is. klik :link om te annuleren',
        'notification_remove_text' => 'hier',

        'notification_in_stock' => 'Dit product is al op voorraad!',
    ],

    'supporter_tag' => [
        'gift' => 'schenk aan speler',
        'require_login' => [
            '_' => 'Je moet :link zijn om een osu!supporter tag te krijgen!',
            'link_text' => 'ingelogd',
        ],
    ],

    'username_change' => [
        'check' => 'Voer een gebruikersnaam in om de beschikbaarheid te controleren!',
        'checking' => 'Bezig met beschikbaarheid te controleren van :username...',
        'require_login' => [
            '_' => 'Je moet :link zijn om je naam te veranderen!',
            'link_text' => 'ingelogd',
        ],
    ],
];
