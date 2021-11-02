<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'cart' => [
        'checkout' => 'Zur Kasse',
        'info' => ':count_delimited Artikel im Warenkorb ($:subtotal)|:count_delimited Artikel im Warenkorb ($:subtotal)',
        'more_goodies' => 'Ich möchte mich vor meiner Bestellung noch etwas umschauen',
        'shipping_fees' => 'Versandkosten',
        'title' => 'Warenkorb',
        'total' => 'insgesamt',

        'errors_no_checkout' => [
            'line_1' => 'Ups, irgendetwas im Warenkorb verhindert die Buchung!',
            'line_2' => 'Entfernen oder aktualisieren Sie Ihre Artikel, bevor Sie fortfahren.',
        ],

        'empty' => [
            'text' => 'Dein Warenkorb ist leer.',
            'return_link' => [
                '_' => 'Geh\' doch zurück zum :link und such\' dir ein paar Goodies aus!',
                'link_text' => 'Shop',
            ],
        ],
    ],

    'checkout' => [
        'cart_problems' => 'Es gibt Probleme in deinem Warenkorb!',
        'cart_problems_edit' => 'Klick hier, um ihn zu bearbeiten.',
        'declined' => 'Der Bezahlvorgang wurde abgebrochen.',
        'delayed_shipping' => 'Wir sind momentan etwas mit Bestellungen überfordert! Wir nehmen weiterhin Bestellungen an, allerdings muss mit **zusätzlichen 1-2 Wochen Verzögerung** gerechnet werden, während die aktuellen Bestellungen aufgearbeitet werden.',
        'old_cart' => 'Dein Warenkorb war nicht aktuell und wurde erneut geladen, bitte versuche es erneut.',
        'pay' => 'Mit Paypal bezahlen',
        'title_compact' => 'zur Kasse',

        'has_pending' => [
            '_' => 'Du hast unvollständige Zahlungen, klicke :link , um sie anzuzeigen.',
            'link_text' => 'hier',
        ],

        'pending_checkout' => [
            'line_1' => 'Der vorherige Bezahlvorgang wurde gestartet, aber nicht beendet.',
            'line_2' => 'Setze deine Zahlung fort, indem du eine Zahlungsmethode auswählst.',
        ],
    ],

    'discount' => 'spare :percent%',

    'invoice' => [
        'echeck_delay' => 'Da es sich bei deiner Zahlung um einen eCheck handelt, kannst du bis zu 10 zusätzliche Tage einplanen, um die Zahlung über PayPal abzuwickeln!',
        'title_compact' => 'rechnung',

        'status' => [
            'processing' => [
                'title' => 'Deine Zahlung wurde noch nicht bestätigt!',
                'line_1' => 'Wenn du bereits bezahlt hast, warten wir möglicherweise auf die Bestätigung deiner Zahlung. Bitte lade diese Seite in ein oder zwei Minuten neu!',
                'line_2' => [
                    '_' => 'Wenn du auf Problem während der Zahlung stößt: :link',
                    'link_text' => 'Klicke hier, um deine Zahlung fortzusetzen',
                ],
            ],
        ],
    ],

    'order' => [
        'cancel' => 'Bestellung stornieren',
        'cancel_confirm' => 'Diese Bestellung wird storniert und die Zahlung dafür nicht akzeptiert. Der Zahlungsanbieter gibt eventuell reservierte Gelder nicht sofort frei. Bist du sicher?',
        'cancel_not_allowed' => 'Diese Bestellung kann zu diesem Zeitpunkt nicht storniert werden.',
        'invoice' => 'Rechnung anzeigen',
        'no_orders' => 'Keine Bestellungen zum anzeigen.',
        'paid_on' => 'Bestellung aufgegeben am :date',
        'resume' => 'Bezahlung fortsetzen',
        'shopify_expired' => 'Der Zahlungslink für diese Bestellung ist abgelaufen.',

        'item' => [
            'display_name' => [
                'supporter_tag' => ':name für :username (:duration)',
            ],
            'quantity' => 'Menge',
        ],

        'not_modifiable_exception' => [
            'cancelled' => 'Du kannst deine Bestellung nicht ändern, da diese storniert wurde.',
            'checkout' => 'Du kannst deine Bestellung nicht ändern, während diese bearbeitet wird.', // checkout and processing should have the same message.
            'default' => 'Bestellung kann nicht bearbeitet werden',
            'delivered' => 'Du kannst deine Bestellung nicht ändern, da diese bereits zugestellt wurde.',
            'paid' => 'Du kannst deine Bestellung nicht ändern, da diese bereits bezahlt wurde.',
            'processing' => 'Du kannst deine Bestellung nicht ändern, während diese bearbeitet wird.',
            'shipped' => 'Du kannst deine Bestellung nicht ändern, da diese bereits versandt wurde.',
        ],

        'status' => [
            'cancelled' => 'Abgebrochen',
            'checkout' => 'Vorbereiten',
            'delivered' => 'Zugestellt',
            'paid' => 'Bezahlt',
            'processing' => 'Bestätigung ausstehend',
            'shipped' => 'In Bearbeitung',
        ],
    ],

    'product' => [
        'name' => 'Name',

        'stock' => [
            'out' => 'Leider ist dieser Artikel momentan ausverkauft. Schau doch später noch mal vorbei!',
            'out_with_alternative' => 'Leider ist dieser Artikel momentan ausverkauft. Du kannst dir in der Dropdown-Liste eine Alternative aussuchen oder später noch mal vorbeischauen!',
        ],

        'add_to_cart' => 'Zum Warenkorb hinzufügen',
        'notify' => 'Benachrichtige mich, sobald der Artikel wieder verfügbar ist!',

        'notification_success' => 'du erhältst eine benachrichtigung, sobald neuer bestand vorhanden ist. klick :link zum abbrechen',
        'notification_remove_text' => 'hier',

        'notification_in_stock' => 'Dieser Artikel ist bereits verfügbar!',
    ],

    'supporter_tag' => [
        'gift' => 'an jemanden verschenken',
        'require_login' => [
            '_' => 'Du musst :link sein, um ein osu!supporter-Tag zu erhalten!',
            'link_text' => 'eingeloggt',
        ],
    ],

    'username_change' => [
        'check' => 'Gib einen Nutzernamen ein, um die Verfügbarkeit zu prüfen!',
        'checking' => 'Prüfe Verfügbarkeit von :username...',
        'require_login' => [
            '_' => 'Um deinen Namen zu ändern, musst du :link sein!',
            'link_text' => 'eingeloggt',
        ],
    ],

    'xsolla' => [
        'distributor' => '',
    ],
];
