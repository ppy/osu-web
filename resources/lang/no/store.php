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
        'warehouse' => 'Lager',
    ],

    'cart' => [
        'checkout' => 'Gå til kassen',
        'more_goodies' => 'Fortsett å handle',
        'shipping_fees' => 'estimert frakt',
        'title' => 'Handlevogn',
        'total' => 'total sum',

        'errors_no_checkout' => [
            'line_1' => 'Det er et problem med handlevognen som forhindrer deg i å gå til kassen!',
            'line_2' => 'Fjern eller oppdater produktene ovenfor for å fortsette.',
        ],

        'empty' => [
            'text' => 'Handlevognen din er tom.',
            'return_link' => [
                '_' => 'Gå tilbake til :link for å finne flere produkter!',
                'link_text' => 'butikkoppføring',
            ],
        ],
    ],

    'checkout' => [
        'cart_problems' => 'Det er et problem med handlevognen din!',
        'cart_problems_edit' => 'Trykk her for å endre den.',
        'declined' => 'Betalingen ble avbrutt.',
        'delayed_shipping' => 'Vi er for tiden overveldet av ordre! Du er velkommen til å bestille, men vennligst ta til hensyn at bestillingen kan ta **ytterlige 1-2 uke lenger** mens vi fanger opp til de eksisterende ordrene.',
        'old_cart' => 'Det ser ut til at handlevognen din er utdatert og har blitt oppdatert, prøv igjen.',
        'pay' => 'Betal med Paypal',

        'has_pending' => [
            '_' => 'Du har ufullstendige utsjekkinger, klikk :link for å vise dem.',
            'link_text' => 'her',
        ],

        'pending_checkout' => [
            'line_1' => 'En tidligere utsjekking ble startet, men ble ikke fullført.',
            'line_2' => 'Fortsett utsjekkingen ved å velge en betalingsmåte.',
        ],
    ],

    'discount' => 'lagre :percent%',

    'invoice' => [
        'echeck_delay' => 'Ettersom betalingen din var en eCheck, vennligst tillat opp til 10 ekstra dager for at betalingen skal kunne komme gjennom PayPal!',
        'status' => [
            'processing' => [
                'title' => 'Din betaling har enda ikke blitt bekreftet!',
                'line_1' => 'Hvis du allerede har betalt, kan det fortsatt hende at vi venter på en bekreftelse av betalingen din. Vennligst oppdater denne siden om et minutt eller to!',
                'line_2' => [
                    '_' => 'Hvis du støtte på et problem under utsjekking, :link',
                    'link_text' => 'klikk her for å fortsette utsjekkingen',
                ],
            ],
        ],
    ],

    'mail' => [
        'payment_completed' => [
            'subject' => 'We har mottatt din osu!butikk ordre!',
        ],
    ],

    'order' => [
        'paid_on' => 'Bestilling plassert den :date',

        'invoice' => 'Vis faktura',
        'no_orders' => 'Ingen ordre å vise.',

        'item' => [
            'display_name' => [
                'supporter_tag' => ':name til :username (:duration)',
            ],
            'quantity' => 'Mengde',
        ],

        'not_modifiable_exception' => [
            'cancelled' => 'Du kan ikke endre på bestillingen, ettersom den har blitt kansellert.',
            'checkout' => 'Du kan ikke endre på bestillingen mens den behandles.', // checkout and processing should have the same message.
            'default' => 'Bestillingen kan ikke endres',
            'delivered' => 'Du kan ikke endre på bestillingen, ettersom den allerede har blitt levert.',
            'paid' => 'Du kan ikke endre på bestillingen, ettersom den allerede har blitt betalt for.',
            'processing' => 'Du kan ikke endre på bestillingen mens den behandles.',
            'shipped' => 'Du kan ikke endre på bestillingen, ettersom den allerede har blitt sendt.',
        ],

        'status' => [
            'cancelled' => 'Kansellert',
            'checkout' => 'Forbereder',
            'delivered' => 'Levert',
            'paid' => 'Betalt',
            'processing' => 'Avventer bekreftelse',
            'shipped' => '',
        ],
    ],

    'product' => [
        'name' => 'Navn',

        'stock' => [
            'out' => 'Denne varen er for øyeblikket utsolgt. Sjekk tilbake senere!',
            'out_with_alternative' => 'Dessverre er denne varen utsolgt. Bruk rullegardinlisten til å velge en annen type vare eller sjekk tilbake senere!',
        ],

        'add_to_cart' => 'Legg i Handlekurv',
        'notify' => 'Varsle meg når det blir tilgjengelig!',

        'notification_success' => 'du vil bli varslet når vi får mer på lager. klikk :link for å avbryte',
        'notification_remove_text' => 'her',

        'notification_in_stock' => 'Dette produktet er allerede på lager!',
    ],

    'supporter_tag' => [
        'gift' => 'gi som gave',
        'require_login' => [
            '_' => 'Du må være :link for å få tak i en osu!supporter tag!',
            'link_text' => 'logget inn',
        ],
    ],

    'username_change' => [
        'check' => 'Oppgi et brukernavn for å sjekke om det er tilgjengelig!',
        'checking' => 'Sjekker om :username er tilgjengelig...',
        'require_login' => [
            '_' => 'For å endre navnet ditt, må du være :link!',
            'link_text' => 'logget inn',
        ],
    ],
];
