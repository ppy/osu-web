<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'cart' => [
        'checkout' => 'Afrekenen',
        'empty_cart' => 'Verwijder alle items uit de winkelwagen',
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
        'hide_from_activity' => 'Verberg alle osu!supporter tags in deze bestelling van mijn activiteit',
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
    'free' => 'gratis!',

    'invoice' => [
        'contact' => 'Contact:',
        'date' => 'Datum:',
        'echeck_delay' => 'Aangezien uw betaling een eCheck was, Wacht maximaal 10 dagen extra om de betaling veilig via PayPal te laten gaan!',
        'echeck_denied' => '',
        'hide_from_activity' => 'osu!supporter tags in deze bestelling worden niet weergegeven in je recente activiteiten.',
        'sent_via' => 'Gestuurd Via:',
        'shipping_to' => 'Verzenden Naar:',
        'title' => 'Factuur',
        'title_compact' => 'factuur',

        'status' => [
            'cancelled' => [
                'title' => 'Je bestelling is geannuleerd',
                'line_1' => [
                    '_' => "Als je geen annulering hebt aangevraagd, neem dan contact op met :link en vermeld je bestelnummer (#:order_number).",
                    'link_text' => 'osu!store support',
                ],
            ],
            'delivered' => [
                'title' => 'Je bestelling is geleverd! We hopen dat je ervan geniet!',
                'line_1' => [
                    '_' => 'Als je problemen hebt met je aankoop, neem dan contact op met de :link.',
                    'link_text' => 'osu!store support',
                ],
            ],
            'prepared' => [
                'title' => 'Je bestelling wordt voorbereid!',
                'line_1' => 'Wacht alsjeblieft iets langer voor de verzending. Tracking-informatie zal hier verschijnen zodra de bestelling is verwerkt en verzonden. Dit kan tot 5 dagen duren (maar vaak minder!) afhankelijk van hoe druk we zijn.',
                'line_2' => 'We verzenden alle bestellingen vanuit Japan d.m.v. een aantal bezorgdiensten afhankelijk van het gewicht en de waarde. Dit gebied zal worden bijgewerkt met details zodra we de bestelling hebben verzonden.',
            ],
            'processing' => [
                'title' => 'Uw betaling is nog niet bevestigd!',
                'line_1' => 'Als u al betaald hebt, wachten we misschien nog steeds op bevestiging van uw betaling. Vernieuw deze pagina over een minuut of twee!',
                'line_2' => [
                    '_' => 'Als u een probleem heeft ondervonden tijdens het afrekenen, :link',
                    'link_text' => 'klik hier om uw afrekenen te hervatten',
                ],
            ],
            'shipped' => [
                'title' => 'Je bestelling is verzonden!',
                'tracking_details' => 'Tracking-details volgen:',
                'no_tracking_details' => [
                    '_' => "We hebben geen tracking-details omdat we jouw pakket via Air Mail verzonden hebben, maar je kunt deze verwachten binnen 1-3 weken. In Europa kan de douane soms vertraging buiten onze controle veroorzaken. Als je vragen hebt, antwoord op de bestelbevestigings-e-mail die je hebt ontvangen (of :link).",
                    'link_text' => 'stuur ons een email',
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
        'shipping_and_handling' => 'Verzending & Verwerking',
        'shopify_expired' => 'De checkout link voor deze bestelling is verlopen.',
        'subtotal' => 'Subtotaal',
        'total' => 'Totaal',

        'details' => [
            'order_number' => 'Bestelling #',
            'payment_terms' => '',
            'salesperson' => 'Verkoper',
            'shipping_method' => 'Verzendmethode',
            'shipping_terms' => 'Verzendvoorwaarden',
            'title' => 'Besteldetails',
        ],

        'item' => [
            'quantity' => 'Aantal',

            'display_name' => [
                'supporter_tag' => ':name voor :username (:duration)',
            ],

            'subtext' => [
                'supporter_tag' => 'Mededeling: :message',
            ],
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
            'title' => 'Bestelstatus',
        ],

        'thanks' => [
            'title' => 'Bedankt voor je bestelling!',
            'line_1' => [
                '_' => 'Je zal binnenkort een bevestigings-e-mail ontvangen. Als je vragen hebt, :link!',
                'link_text' => 'contacteer ons',
            ],
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
        'gift_message' => 'voeg een optioneel bericht toe aan uw geschenk! (maximaal :length tekens)',

        'require_login' => [
            '_' => 'Je moet :link zijn om een osu!supporter tag te krijgen!',
            'link_text' => 'ingelogd',
        ],
    ],

    'username_change' => [
        'check' => 'Voer een gebruikersnaam in om de beschikbaarheid te controleren!',
        'checking' => 'Bezig met beschikbaarheid te controleren van :username...',
        'placeholder' => 'Aangevraagde Gebruikersnaam',
        'label' => 'Nieuwe Gebruikersnaam',
        'current' => 'Je huidige gebruikersnaam is ":username".',

        'require_login' => [
            '_' => 'Je moet :link zijn om je naam te veranderen!',
            'link_text' => 'ingelogd',
        ],
    ],

    'xsolla' => [
        'distributor' => '',
    ],
];
