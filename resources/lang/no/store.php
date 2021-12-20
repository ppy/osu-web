<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'cart' => [
        'checkout' => 'Gå til kassen',
        'info' => ':count_delimited ting i kurven ($:subtotal)|:count_delimited items i vogn ($:subtotal)',
        'more_goodies' => 'Jeg vil se på flere produkter før jeg fullfører bestillingen',
        'shipping_fees' => 'fraktkostnader',
        'title' => 'Handlevogn',
        'total' => 'total sum',

        'errors_no_checkout' => [
            'line_1' => 'Åh nei, det er problemer med handlevognen som forhindrer deg i å gå til kassen!',
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
        'cart_problems' => 'Åh nei, det er et problem med handlevognen din!',
        'cart_problems_edit' => 'Trykk her for å endre den.',
        'declined' => 'Betalingen ble avbrutt.',
        'delayed_shipping' => 'Vi er for tiden overveldet av bestillinger! Du er velkommen til å bestille, men vennligst ta hensyn til at bestillingen kan ta **ytterlige 1-2 uke lenger** mens vi fullfører de eksisterende bestillingene.',
        'old_cart' => 'Det ser ut til at handlevognen din er utdatert og har blitt oppdatert, prøv igjen.',
        'pay' => 'Betal med Paypal',
        'title_compact' => 'gå til kassen',

        'has_pending' => [
            '_' => 'Du har ufullstendige utsjekkinger, klikk :link for å vise dem.',
            'link_text' => 'her',
        ],

        'pending_checkout' => [
            'line_1' => 'En tidligere utsjekking ble startet, men ble ikke fullført.',
            'line_2' => 'Fortsett utsjekkingen ved å velge en betalingsmåte.',
        ],
    ],

    'discount' => 'spar :percent%',

    'invoice' => [
        'echeck_delay' => 'Ettersom betalingen din var en eCheck, vennligst tillatt opp til 10 ekstra dager for at betalingen skal kunne komme gjennom PayPal!',
        'title_compact' => 'faktura',

        'status' => [
            'processing' => [
                'title' => 'Din betaling har enda ikke blitt bekreftet!',
                'line_1' => 'Hvis du allerede har betalt, kan det fortsatt hende at vi venter på en bekreftelse på betalingen din. Vennligst oppdater denne siden om et minutt eller to!',
                'line_2' => [
                    '_' => 'Hvis du støtte på et problem under utsjekking, :link',
                    'link_text' => 'klikk her for å fortsette utsjekkingen',
                ],
            ],
        ],
    ],

    'order' => [
        'cancel' => '',
        'cancel_confirm' => '',
        'cancel_not_allowed' => '',
        'invoice' => 'Vis faktura',
        'no_orders' => 'Ingen bestillinger å vise.',
        'paid_on' => 'Bestilling plassert den :date',
        'resume' => 'Tilbake til kassen',
        'shopify_expired' => '',

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
            'shipped' => 'På vei',
        ],
    ],

    'product' => [
        'name' => 'Navn',

        'stock' => [
            'out' => 'Denne varen er for øyeblikket utsolgt. Sjekk tilbake senere!',
            'out_with_alternative' => 'Dessverre er denne varen utsolgt. Bruk rullegardinlisten for å velge en annen type vare eller sjekk tilbake senere!',
        ],

        'add_to_cart' => 'Legg til i Handlekurv',
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

    'xsolla' => [
        'distributor' => '',
    ],
];
