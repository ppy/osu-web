<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'cart' => [
        'checkout' => 'Plati',
        'info' => ':count_delimited artikl u košarici
($:subtotal)|:count_delimited artikala u košarici
($:subtotal)',
        'more_goodies' => 'Želim dodati još artikala u košaricu prije dovršetka narudžbe',
        'shipping_fees' => 'troškovi dostave',
        'title' => 'Košarica',
        'total' => 'ukupno',

        'errors_no_checkout' => [
            'line_1' => 'Uh, postoje problemi s vašom košaricom koji sprječavaju naplatu!',
            'line_2' => 'Uklonite ili ažurirajte gore navedene artikle da biste nastavili.',
        ],

        'empty' => [
            'text' => 'Tvoja košarica je prazna.',
            'return_link' => [
                '_' => 'Vrati se na :link kako bi pronašao/la još odličnih artikala!',
                'link_text' => 'trgovina',
            ],
        ],
    ],

    'checkout' => [
        'cart_problems' => 'Uh, postoje problemi s tvojom košaricom!',
        'cart_problems_edit' => 'Klikni ovdje za uređivanje košarice.',
        'declined' => 'Plaćanje je otkazano.',
        'delayed_shipping' => 'Trenutno smo zatrpani narudžbama! Slobodno možeš naručiti, ali očekuj **dodatna kašnjenja od 1-2 tjedna** dok ne sustignemo postojeće narudžbe.',
        'hide_from_activity' => '',
        'old_cart' => 'Čini se da je tvoja košarica zastarjela i ponovno je učitana, pokušaj ponovno.',
        'pay' => 'Plati s Paypalom',
        'title_compact' => 'plati',

        'has_pending' => [
            '_' => 'Imaš nepotpune naplate, klikni :link da ih pogledaš.',
            'link_text' => 'ovdje',
        ],

        'pending_checkout' => [
            'line_1' => 'Prethodna naplata je započeta, ali nije završena.',
            'line_2' => 'Nastavi naplatu odabirom načina plaćanja.',
        ],
    ],

    'discount' => 'uštedi :percent%',

    'invoice' => [
        'echeck_delay' => 'Budući da je tvoje plaćanje bilo eCheck, pricekaj do 10 dodatnih dana da se uplata izvrši putem PayPala!',
        'hide_from_activity' => '',
        'title_compact' => 'račun',

        'status' => [
            'processing' => [
                'title' => 'Tvoja uplata još nije potvrđena!',
                'line_1' => 'Ako si već platio/la, možda još čekamo da primimo potvrdu o tvome plaćanju. Molimo osvježi ovu stranicu za minutu ili dvije!',
                'line_2' => [
                    '_' => 'Ako si naišao/la na problem tijekom naplate, :link',
                    'link_text' => 'klikni ovdje za nastavak uplate',
                ],
            ],
        ],
    ],

    'order' => [
        'cancel' => 'Otkaži narudžbu',
        'cancel_confirm' => 'Ova narudžba će biti poništena i plaćanje za nju neće biti prihvaćeno. Davatelj plaćanja možda neće odmah osloboditi rezervirana sredstva. Jesi li siguran?',
        'cancel_not_allowed' => 'Ova se narudžba trenutno ne može otkazati.',
        'invoice' => 'Prikaz računa',
        'no_orders' => 'Nema narudžbi za pregled.',
        'paid_on' => 'Narudžba postavljena :date',
        'resume' => 'Nastavi uplatu',
        'shopify_expired' => 'Poveznica za naplatu za ovu narudžbu je istekla.',

        'item' => [
            'quantity' => 'Količina',

            'display_name' => [
                'supporter_tag' => ':name za :username (:duration)',
            ],

            'subtext' => [
                'supporter_tag' => '',
            ],
        ],

        'not_modifiable_exception' => [
            'cancelled' => 'Ne možeš mijenjati svoju narudžbu jer je otkazana.',
            'checkout' => 'Ne možeš mijenjati svoju narudžbu dok je u obradi.', // checkout and processing should have the same message.
            'default' => 'Narudžba se ne može mijenjati',
            'delivered' => 'Ne možeš mijenjati svoju narudžbu jer je već isporučena.',
            'paid' => 'Ne možeš mijenjati svoju narudžbu jer je već plaćena.',
            'processing' => 'Ne možeš mijenjati svoju narudžbu dok je u obradi.',
            'shipped' => 'Ne možeš mijenjati svoju narudžbu jer je već poslana.',
        ],

        'status' => [
            'cancelled' => 'Otkazano',
            'checkout' => 'Priprema',
            'delivered' => 'Isporučeno',
            'paid' => 'Plaćeno',
            'processing' => 'Čeka potvrdu',
            'shipped' => 'Poslano',
        ],
    ],

    'product' => [
        'name' => 'Ime',

        'stock' => [
            'out' => 'Ovaj artikal trenutno nije na zalihama. Provjeri kasnije!',
            'out_with_alternative' => 'Nažalost, ovaj artikal nije na zalihama. Koristi padajući izbornik za odabir druge vrste ili se vrati kasnije!',
        ],

        'add_to_cart' => 'Dodaj u košaricu',
        'notify' => 'Obavijesti me kada bude dostupno!',

        'notification_success' => 'bit ćeš obaviješten/a kada budemo imali nove zalihe. kliknite :link za odustajanje',
        'notification_remove_text' => 'ovdje',

        'notification_in_stock' => 'Ovaj proizvod je već na zalihi!',
    ],

    'supporter_tag' => [
        'gift' => 'pokloni igraču',
        'gift_message' => '',

        'require_login' => [
            '_' => 'Moraš biti :link da dobiješ osu!supporter oznaku!',
            'link_text' => 'prijavljen',
        ],
    ],

    'username_change' => [
        'check' => 'Unesi korisničko ime za provjeru dostupnosti!',
        'checking' => 'Provjeravanje dostupnosti od :username...',
        'require_login' => [
            '_' => 'Moraš biti :link kako bi promijenio svoje ime!',
            'link_text' => 'prijavljen',
        ],
    ],

    'xsolla' => [
        'distributor' => '',
    ],
];
