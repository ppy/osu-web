<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'cart' => [
        'checkout' => 'Afrekenen',
        'info' => ':count_delimited artikel in winkelwagen ($:subtotal)|:count_delimited artikels in winkelwagen ($:subtotal)',
        'more_goodies' => 'Ik wil meer goodies bekijken voordat ik de bestelling voltooi',
        'shipping_fees' => 'verzendkosten',
        'title' => 'Winkelwagen',
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
        'delayed_shipping' => 'We zijn momenteel overweldigd met bestellingen! Je kunt nog steeds bestellingen plaatsen maar verwacht dan **een vertraging van 1-2 weken** terwijl wij de bestaande bestellingen verwerken.',
        'old_cart' => 'Je winkelwagen lijkt verouderd te zijn en wordt herladen, probeer het opnieuw.',
        'pay' => 'Afrekenen met Paypal',
        'title_compact' => 'afrekenen',

        'has_pending' => [
            '_' => 'U heeft onvolledig afgerekend, klik op :link om ze te bekijken.',
            'link_text' => 'hier',
        ],

        'pending_checkout' => [
            'line_1' => 'Een vorige checkout is gestart, maar niet geëindigd.',
            'line_2' => 'Hervat uw afrekenen door een betaalmethode te selecteren.',
        ],
    ],

    'discount' => 'bespaar :percent%',

    'invoice' => [
        'echeck_delay' => 'Aangezien uw betaling een eCheck was, Wacht maximaal 10 dagen extra om de betaling veilig via PayPal te laten gaan!',
        'title_compact' => 'factuur',

        'status' => [
            'processing' => [
                'title' => 'Uw betaling is nog niet bevestigd!',
                'line_1' => 'Als u al betaald hebt, wachten we misschien nog steeds op bevestiging van uw betaling. Vernieuw deze pagina over een minuut of twee!',
                'line_2' => [
                    '_' => 'Als u een probleem heeft ondervonden tijdens het afrekenen, :link',
                    'link_text' => 'klik hier om uw afrekenen te hervatten',
                ],
            ],
        ],
    ],

    'order' => [
        'cancel' => 'Annuleer bestelling',
        'cancel_confirm' => 'Deze bestelling wordt geannuleerd en de betaling wordt niet geaccepteerd. Het kan zijn dat je niet direct een refund krijgt & dat dit even duurt. Weet je het zeker?',
        'cancel_not_allowed' => 'Deze bestelling kan op dit moment niet geannuleerd worden.',
        'invoice' => 'Factuur weergeven',
        'no_orders' => 'Geen bestellingen om te bekijken.',
        'paid_on' => 'Bestelling geplaatst :date',
        'resume' => 'Hervat afrekenen',
        'shopify_expired' => 'De checkout link voor deze bestelling is verlopen.',

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

        'status' => [
            'cancelled' => 'Geannuleerd',
            'checkout' => 'Aan het voorbereiden',
            'delivered' => 'Geleverd',
            'paid' => 'Betaald',
            'processing' => 'Wachten op bevestiging',
            'shipped' => 'Verzonden',
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

    'xsolla' => [
        'distributor' => '',
    ],
];
