<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'cart' => [
        'checkout' => 'Zur Kasse',
        'empty_cart' => 'Alle Artikel aus dem Warenkorb entfernen',
        'info' => ':count_delimited Artikel im Warenkorb ($:subtotal)|:count_delimited Artikel im Warenkorb ($:subtotal)',
        'more_goodies' => 'Ich möchte mich vor meiner Bestellung noch etwas umschauen',
        'shipping_fees' => 'Versandkosten',
        'title' => 'Warenkorb',
        'total' => 'insgesamt',

        'errors_no_checkout' => [
            'line_1' => 'Ups, irgendetwas im Warenkorb verhindert die Buchung!',
            'line_2' => 'Entferne oder aktualisiere deine Artikel, bevor du fortfährst.',
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
        'cart_problems' => 'Es gibt Probleme mit deinem Warenkorb!',
        'cart_problems_edit' => 'Klick hier, um ihn zu bearbeiten.',
        'declined' => 'Der Bezahlvorgang wurde abgebrochen.',
        'delayed_shipping' => 'Wir sind momentan etwas mit Bestellungen überfordert! Wir nehmen weiterhin Bestellungen an, allerdings muss mit **zusätzlichen 1-2 Wochen Verzögerung** gerechnet werden, während die aktuellen Bestellungen aufgearbeitet werden.',
        'hide_from_activity' => 'Alle osu!supporter-Tags in dieser Bestellung aus meiner Aktivität ausblenden',
        'old_cart' => 'Dein Warenkorb war nicht aktuell und wurde erneut geladen, bitte versuche es erneut.',
        'pay' => 'Mit PayPal bezahlen',
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

    'discount' => 'Spare :percent%',
    'free' => 'kostenlos!',

    'invoice' => [
        'contact' => 'Kontakt:',
        'date' => 'Datum:',
        'echeck_delay' => 'Da es sich bei deiner Zahlung um einen eCheck handelt, kannst du bis zu 10 zusätzliche Tage einplanen, um die Zahlung über PayPal abzuwickeln!',
        'echeck_denied' => 'Die E-Check-Zahlung wurde von PayPal abgelehnt.',
        'hide_from_activity' => 'osu!supporter-Tags in dieser Bestellung werden nicht in deinen letzten Aktivitäten angezeigt.',
        'sent_via' => 'Versand durch:',
        'shipping_to' => 'Lieferung an:',
        'title' => 'Rechnung',
        'title_compact' => 'Rechnung',

        'status' => [
            'cancelled' => [
                'title' => 'Deine Bestellung wurde storniert',
                'line_1' => [
                    '_' => "Wenn du keine Stornierung angefordert hast, kontaktiere bitte den :link und nenne deine Bestellnummer (#:order_number).",
                    'link_text' => 'osu!store-Support',
                ],
            ],
            'delivered' => [
                'title' => 'Deine Bestellung wurde zugestellt! Wir hoffen, dass du damit Spaß hast!',
                'line_1' => [
                    '_' => 'Wenn du irgendwelche Probleme mit deinem Kauf hast, kontaktiere bitte den :link.',
                    'link_text' => 'osu!store-Support',
                ],
            ],
            'prepared' => [
                'title' => 'Deine Bestellung wird derzeit bearbeitet!',
                'line_1' => 'Bitte warte noch etwas, bis das Paket ausgeliefert wird. Informationen zur Verfolgung erscheinen hier, sobald die Bestellung bearbeitet und versandt wurde. Dies kann bis zu 5 Tage dauern (in der Regel aber weniger!), je nachdem, wie viel wir zu tun haben.',
                'line_2' => 'Wir versenden alle Bestellungen aus Japan je nach Gewicht und Wert mit verschiedenen Versanddiensten. Dieser Bereich wird aktualisiert, sobald wir die Bestellung ausgeliefert haben.',
            ],
            'processing' => [
                'title' => 'Deine Zahlung wurde noch nicht bestätigt!',
                'line_1' => 'Wenn du bereits bezahlt hast, warten wir möglicherweise auf die Bestätigung deiner Zahlung. Bitte lade diese Seite in ein oder zwei Minuten neu!',
                'line_2' => [
                    '_' => 'Wenn du während der Zahlung auf ein Problem stößt: :link',
                    'link_text' => 'Klicke hier, um deine Zahlung fortzusetzen',
                ],
            ],
            'shipped' => [
                'title' => 'Deine Bestellung wurde versandt!',
                'tracking_details' => 'Hier sind Informationen zur Bestellung:',
                'no_tracking_details' => [
                    '_' => "Uns stehen keine Tracking-Daten zur Verfügung, da wir das Paket per Air Mail versandt haben. Das Paket sollte jedoch innerhalb von 1 bis 3 Wochen ankommen. In Europa kann der Zoll manchmal die Bestellung außerhalb unserer Kontrolle verzögern. Wenn du irgendwelche Bedenken hast, antworte bitte auf die Bestätingsmail, die du erhalten hast (oder :link).",
                    'link_text' => 'sende uns eine E-Mail',
                ],
            ],
        ],
    ],

    'order' => [
        'cancel' => 'Bestellung stornieren',
        'cancel_confirm' => 'Diese Bestellung wird storniert und die Zahlung dafür nicht akzeptiert. Der Zahlungsanbieter gibt eventuell reservierte Gelder nicht sofort frei. Bist du sicher?',
        'cancel_not_allowed' => 'Diese Bestellung kann zu diesem Zeitpunkt nicht storniert werden.',
        'invoice' => 'Rechnung anzeigen',
        'no_orders' => 'Keine Bestellungen zum Anzeigen.',
        'paid_on' => 'Bestellung :date aufgegeben',
        'resume' => 'Bezahlung fortsetzen',
        'shipping_and_handling' => 'Lieferung und Verarbeitung',
        'shopify_expired' => 'Der Zahlungslink für diese Bestellung ist abgelaufen.',
        'subtotal' => 'Zwischensumme',
        'total' => 'Summe',

        'details' => [
            'order_number' => 'Bestellung #',
            'payment_terms' => 'Zahlungsbedingungen',
            'salesperson' => 'Verkäufer',
            'shipping_method' => 'Versandmethode',
            'shipping_terms' => 'Versandbedingungen',
            'title' => 'Bestelldetails',
        ],

        'item' => [
            'quantity' => 'Menge',

            'display_name' => [
                'supporter_tag' => ':name für :username (:duration)',
            ],

            'subtext' => [
                'supporter_tag' => 'Nachricht: :message',
            ],
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
            'title' => 'Bestellungsstatus',
        ],

        'thanks' => [
            'title' => 'Vielen Dank für deine Bestellung!',
            'line_1' => [
                '_' => 'Du erhältst bald eine Bestätigungsmail. Wenn du Fragen hast, dann :link bitte!',
                'link_text' => 'kontaktiere uns',
            ],
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
        'gift_message' => 'füge eine optionale Nachricht zu deinem Geschenk hinzu! (bis zu :length Zeichen)',

        'require_login' => [
            '_' => 'Du musst :link sein, um ein osu!supporter-Tag zu erhalten!',
            'link_text' => 'eingeloggt',
        ],
    ],

    'username_change' => [
        'check' => 'Gib einen Nutzernamen ein, um die Verfügbarkeit zu prüfen!',
        'checking' => 'Prüfe Verfügbarkeit von :username...',
        'placeholder' => 'Gewünschter Benutzername',
        'label' => 'Neuer Benutzername',
        'current' => 'Dein aktueller Benutzername ist ":username".',

        'require_login' => [
            '_' => 'Um deinen Namen zu ändern, musst du :link sein!',
            'link_text' => 'eingeloggt',
        ],
    ],

    'xsolla' => [
        'distributor' => '',
    ],
];
