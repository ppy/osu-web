<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'cart' => [
        'checkout' => 'Plată',
        'empty_cart' => 'Elimină toate articolele din coș',
        'info' => 'un obiect în coș ($:subtotal)|:count_delimited obiecte în coș ($:subtotal)|:count_delimited de obiecte în coș ($:subtotal)',
        'more_goodies' => 'Vreau să-mi verific bunătățile înainte de a completa comanda',
        'shipping_fees' => 'taxe de livrare',
        'title' => 'Coșul de cumpărături',
        'total' => 'total',

        'errors_no_checkout' => [
            'line_1' => 'Uh oh, există niște probleme cu coșul tău care împiedică plata!',
            'line_2' => 'Elimină sau actualizează produsele de mai sus pentru a continua.',
        ],

        'empty' => [
            'text' => 'Coșul tău este gol.',
            'return_link' => [
                '_' => 'Revino la :link pentru a găsi niște bunătăți!',
                'link_text' => 'lista de produse',
            ],
        ],
    ],

    'checkout' => [
        'cart_problems' => 'Uh oh, există niște probleme cu coșul tău!',
        'cart_problems_edit' => 'Dă clic aici pentru a-l edita.',
        'declined' => 'Plata a fost anulată.',
        'delayed_shipping' => 'În prezent suntem copleșiți de comenzi! Ești binevenit să-ți plasezi comanda, dar te rugăm să aștepți **o întârziere de 1-2 săptămâni suplimentară** în timp ce prindem din urmă comenzile existente.',
        'hide_from_activity' => 'Ascunde toate statusurile de suporter osu! din această comandă din activitatea mea',
        'old_cart' => 'Coșul tău pare a fi expirat și a fost reîncărcat, te rugăm să încerci din nou.',
        'pay' => 'Plătește cu Paypal',
        'title_compact' => 'finalizare plată',

        'has_pending' => [
            '_' => 'Aveți achiziții incomplete, faceți clic :link pentru a le vedea.',
            'link_text' => 'aici',
        ],

        'pending_checkout' => [
            'line_1' => 'O plată anterioară a fost începută, dar nu s-a terminat.',
            'line_2' => 'Calculează-ți plata prin selectarea unei metode de plată.',
        ],
    ],

    'discount' => 'economisește :percent%',
    'free' => 'gratuit!',

    'invoice' => [
        'contact' => 'Contact:',
        'date' => 'Dată:',
        'echeck_delay' => 'Pentru că plata ta a fost făcută electronic, te rugăm să aștepți încă 10 zile pentru ca plata să se afișeze prin PayPal!',
        'echeck_denied' => 'Plata eCheck a fost respinsă de către PayPal.',
        'hide_from_activity' => 'Statusul de suporter osu! din această comandă nu sunt afișate în activitățile tale recente.',
        'sent_via' => 'Trimis Prin:',
        'shipping_to' => 'Livrare Către:',
        'title' => 'Factură',
        'title_compact' => 'factură fiscală',

        'status' => [
            'cancelled' => [
                'title' => 'Comanda ta a fost anulată',
                'line_1' => [
                    '_' => "Dacă nu ai solicitat o anulare, te rugăm să contactezi :link precizând numărul comenzii tale (#:order_number).",
                    'link_text' => 'echipa de suport pentru magazinul osu!',
                ],
            ],
            'delivered' => [
                'title' => 'Comanda ta a fost livrată! Sperăm că vă bucurați de ea!',
                'line_1' => [
                    '_' => 'Dacă întâmpini probleme cu achiziția ta, te rugăm să contactați :link.',
                    'link_text' => 'echipa de suport pentru magazinul osu!',
                ],
            ],
            'prepared' => [
                'title' => 'Comanda ta este în curs de pregătire!',
                'line_1' => 'Te rugăm să mai aștepți pentru expediere. Informațiile de urmărire vor apărea aici odată ce comanda a fost procesată și trimisă. Acest lucru poate dura până la 5 zile (dar de obicei mai puțin!) în funcție de cât de ocupați suntem.',
                'line_2' => 'Toate comenzile sunt expediate din Japonia folosind o varietate de servicii de transport în funcție de greutate și valoare. Această zonă se va actualiza cu mai multe informații odată ce comanda este expediată.',
            ],
            'processing' => [
                'title' => 'Plata nu a fost încă confirmată!',
                'line_1' => 'Dacă ai plătit deja, se poate ca noi încă să așteptăm pentru a primi confirmarea plății. Te rugăm să reîmprospătezi această pagină într-un minut sau două!',
                'line_2' => [
                    '_' => 'Dacă ai întâmpinat o problemă în timpul plății, :link',
                    'link_text' => 'apasă aici pentru a-ți calcula plata',
                ],
            ],
            'shipped' => [
                'title' => 'Comanda ta a fost expediată!',
                'tracking_details' => 'Detalii de urmărire:',
                'no_tracking_details' => [
                    '_' => "Nu avem detalii de urmărire fiindca am trimis coletul tău prin Air Mail, dar te poți aștepta să îl primești in 1-3 săptămâni. Pentru Europa, uneori vămile pot întârzia comenzile fapt care nu este sub controlul nostru. Dacă aveți solicitări adiționale, vă rugăm să răspundeți la e-mailul de confirmare al comenzii pe care l-ați primit :link.",
                    'link_text' => 'trimiteți-ne un e-mail',
                ],
            ],
        ],
    ],

    'order' => [
        'cancel' => 'Anulează comanda',
        'cancel_confirm' => 'Această comandă va fi anulată și plata nu va fi acceptată pentru ea. Este posibil ca furnizorul de plăți să nu elibereze imediat niciun fond rezervat. Ești sigur?',
        'cancel_not_allowed' => 'Aceasta comanda nu poate fi anulata in acest moment.',
        'invoice' => 'Vezi factura',
        'no_orders' => 'Nu sunt comenzi pentru vizualizare.',
        'paid_on' => 'Comandă plasată pe :date',
        'resume' => 'Reia finalizarea comenzii',
        'shipping_and_handling' => 'Livrare și Procesare',
        'shopify_expired' => 'Link-ul de finalizare a comenzii a expirat.',
        'subtotal' => 'Subtotal',
        'total' => 'Total',

        'details' => [
            'order_number' => 'Comanda #',
            'payment_terms' => 'Termeni de plată',
            'salesperson' => 'Agent de vânzare',
            'shipping_method' => 'Metoda Livrare',
            'shipping_terms' => 'Termeni de livrare',
            'title' => 'Detaliile Comenzii',
        ],

        'item' => [
            'quantity' => 'Cantitate',

            'display_name' => [
                'supporter_tag' => ':name pentru :username (:duration)',
            ],

            'subtext' => [
                'supporter_tag' => 'Mesaj: :message',
            ],
        ],

        'not_modifiable_exception' => [
            'cancelled' => 'Nu îți poți modifica comanda deoarece aceasta a fost anulată.',
            'checkout' => 'Nu îți poți modifica comanda în timp ce aceasta este în curs de procesare.', // checkout and processing should have the same message.
            'default' => 'Comanda nu poate fi modificată',
            'delivered' => 'Nu îți poți modifica comanda deoarece aceasta a fost deja livrată.',
            'paid' => 'Nu îți poți modifica comanda deoarece aceasta a fost deja plătită.',
            'processing' => 'Nu îți poți modifica comanda în timp ce aceasta este în curs de procesare.',
            'shipped' => 'Nu îți poți modifica comanda deoarece aceasta a fost deja expediată.',
        ],

        'status' => [
            'cancelled' => 'Anulat',
            'checkout' => 'Se pregătește',
            'delivered' => 'Livrat',
            'paid' => 'Plătit',
            'processing' => 'Confirmarea plății',
            'shipped' => 'Expediat',
            'title' => 'Starea Comenzii',
        ],

        'thanks' => [
            'title' => 'Mulțumim pentru comandă!',
            'line_1' => [
                '_' => 'Veți primi în curând un e-mail de confirmare. Dacă aveți solicitări, vă rugăm să :link!',
                'link_text' => 'ne contactați',
            ],
        ],
    ],

    'product' => [
        'name' => 'Nume',

        'stock' => [
            'out' => 'Acest articol nu în afara stocului. Verifică mai târziu!',
            'out_with_alternative' => 'Din păcate, acest articol este în afara stocului. Selectează altul utilizând meniul derulant sau revenio mai târziu!',
        ],

        'add_to_cart' => 'Adaugă în coș',
        'notify' => 'Anunță-mă când este disponibil!',

        'notification_success' => 'vei fi anunțat când vom avea un stoc nou. Dă clic pe :link pentru a anula',
        'notification_remove_text' => 'aici',

        'notification_in_stock' => 'Acest produs este deja în stoc!',
    ],

    'supporter_tag' => [
        'gift' => 'dăruiește unui jucător',
        'gift_message' => 'adaugă un mesaj opțional la cadoul tău! (până la :length caractere)',

        'require_login' => [
            '_' => 'Trebuie să fii :link pentru a obține statusul de suporter osu!',
            'link_text' => 'conectat',
        ],
    ],

    'username_change' => [
        'check' => 'Întrodu un nume de utilizator pentru a verifica disponibilitatea!',
        'checking' => 'Se verifică disponibilitatea lui :username...',
        'placeholder' => 'Nume Utilizator Solicitat',
        'label' => 'Nume Utilizator Nou',
        'current' => 'Numele tău de utilizator actual este ":username".',

        'require_login' => [
            '_' => 'Trebuie să fii :link pentru a îți schimba numele!',
            'link_text' => 'conectat',
        ],
    ],

    'xsolla' => [
        'distributor' => '',
    ],
];
