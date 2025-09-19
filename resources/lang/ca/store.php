<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'cart' => [
        'checkout' => 'Pagament',
        'empty_cart' => 'Eliminar tots els elements del cistell',
        'info' => ':count_delimited elements al cistell ($:subtotal)|:count_delimited elements al cistell ($:subtotal)',
        'more_goodies' => 'Vull veure més productes abans de completar la compra',
        'shipping_fees' => 'despeses d\'enviament',
        'title' => 'Cistella de compra',
        'total' => 'total',

        'errors_no_checkout' => [
            'line_1' => 'Oh, hi ha problemes a la teva cistella que no permeten el pagament!',
            'line_2' => 'Elimina o actualitza els elements de dalt per continuar.',
        ],

        'empty' => [
            'text' => 'La teva cistella està buida.',
            'return_link' => [
                '_' => 'Torna al :link per a trobar bons productes!',
                'link_text' => 'llistat d\'articles',
            ],
        ],
    ],

    'checkout' => [
        'cart_problems' => 'Oh, hi ha problemes amb la teva cistella!',
        'cart_problems_edit' => 'Fes clic aquí per a editar-ho.',
        'declined' => 'El pagament s\'ha cancel·lat.',
        'delayed_shipping' => 'Ara mateix no podem atendre totes les comandes! La teva compra és benvinguda, però considera un **retard addicional d\'1-2 setmanes** mentre ens posem al dia amb les comandes actuals.',
        'hide_from_activity' => 'Amaga totes les etiquetes osu!supporter en aquesta ordre de la meva activitat',
        'old_cart' => 'La teva cistella sembla desactualitzada i s\'ha reiniciat, torna-ho a intentar.',
        'pay' => 'Pagament amb Paypal',
        'title_compact' => 'pagament',

        'has_pending' => [
            '_' => 'Sembla que tens comandes pendents, fes clic :link per veure-les.',
            'link_text' => 'aquí',
        ],

        'pending_checkout' => [
            'line_1' => 'S\'ha iniciat una compra anterior, però no s\'ha acabat.',
            'line_2' => 'Continua la teva comanda seleccionant un mètode de pagament.',
        ],
    ],

    'discount' => 'estalvia :percent%',
    'free' => 'de franc!',

    'invoice' => [
        'contact' => 'Contacte:',
        'date' => 'Data:',
        'echeck_delay' => 'Com que el seu pagament va ser un eCheck, si us plau permeti fins a 10 dies addicionals perquè el pagament es faci a través de PayPal!',
        'echeck_denied' => 'PayPal ha rebutjat el pagament amb eCheck.',
        'hide_from_activity' => 'les etiquetes osu!supporter en aquesta ordre no es mostren a les teves activitats recents.',
        'sent_via' => 'Enviat via:',
        'shipping_to' => 'Enviament a:',
        'title' => 'Factura',
        'title_compact' => 'factura',

        'status' => [
            'cancelled' => [
                'title' => 'La teva comanda s\'ha cancel·lat',
                'line_1' => [
                    '_' => "Si no has sol·licitat una cancel·lació, posa't en contacte amb el :link indicant el teu número de comanda (núm. :order_number).",
                    'link_text' => 'suport de la osu!store',
                ],
            ],
            'delivered' => [
                'title' => 'La teva comanda ha estat lliurada! Esperem que l\'estiguis gaudint!',
                'line_1' => [
                    '_' => 'Si tens algun problema amb la teva compra, posa\'t en contacte amb el :link.',
                    'link_text' => 'suport de la osu!store',
                ],
            ],
            'prepared' => [
                'title' => 'Estem processant la teva comanda!',
                'line_1' => 'Si us plau, espera una mica més perquè s\'enviï. La informació de seguiment apareixerà aquí una vegada que la comanda hagi estat processada i enviada. Això pot trigar fins a 5 dies (però normalment menys!) depenent de tan ocupats estiguem.',
                'line_2' => 'Enviem totes les comandes des del Japó usant una varietat de serveis d\'enviament depenent del pes i el valor. Aquesta àrea s\'actualitzarà amb detalls una vegada hàgim enviat la comanda.',
            ],
            'processing' => [
                'title' => 'El teu pagament encara no s\'ha confirmat!',
                'line_1' => 'Si ja has pagat, potser volem rebre la confirmació del pagament. Si us plau, refresca aquesta pàgina en un parell de minuts!',
                'line_2' => [
                    '_' => 'Si heu trobat un problema durant la compra, :link',
                    'link_text' => 'fes clic aquí per a continuar la comanda',
                ],
            ],
            'shipped' => [
                'title' => 'La vostra comanda ha estat enviada!',
                'tracking_details' => 'Detalls de seguiment:',
                'no_tracking_details' => [
                    '_' => "No tenim detalls de seguiment, ja que enviem el teu paquet a través d'Air Mail, però pots esperar rebre'l en un termini d'1-3 setmanes. Per a Europa, de vegades les duanes poden endarrerir la comanda fora del nostre control. Si tens algun dubte, si us plau respon al correu electrònic de confirmació de la comanda que vas rebre :link.",
                    'link_text' => 'envia\'ns un correu electrònic',
                ],
            ],
        ],
    ],

    'order' => [
        'cancel' => 'Cancel·la la comanda',
        'cancel_confirm' => 'Aquesta comanda es cancel·larà i no s\'acceptarà el pagament. És possible que el proveïdor de pagaments no alliberi cap fons reservat immediatament. Estàs segur?',
        'cancel_not_allowed' => 'Aquesta ordre no es pot cancel·lar en aquest moment.',
        'invoice' => 'Veure factura',
        'no_orders' => 'No hi ha comandes per veure.',
        'paid_on' => 'Comanda realitzada :date',
        'resume' => 'Continuar pagament',
        'shipping_and_handling' => 'Enviament i manipulació',
        'shopify_expired' => 'L\'enllaç de pagament per aquesta comanda ha expirat.',
        'subtotal' => 'Subtotal',
        'total' => 'Total',

        'details' => [
            'order_number' => 'Comanda núm. 4',
            'payment_terms' => 'Condicions de pagament',
            'salesperson' => 'Venedor',
            'shipping_method' => 'Mètode d\'enviament',
            'shipping_terms' => 'Terminis d\'enviament',
            'title' => 'Detalls de la comanda',
        ],

        'item' => [
            'quantity' => 'Quantitat',

            'display_name' => [
                'supporter_tag' => ':name per :username (:duration)',
            ],

            'subtext' => [
                'supporter_tag' => 'Missatge: :message',
            ],
        ],

        'not_modifiable_exception' => [
            'cancelled' => 'No pots modificar la comanda perquè s\'ha cancel·lat.',
            'checkout' => 'No pots modificar la comanda mentre s\'està processant.', // checkout and processing should have the same message.
            'default' => 'La comanda no es pot modificar',
            'delivered' => 'No pots modificar la teva comanda perquè ja s\'ha entregat.',
            'paid' => 'No pots modificar la comanda perquè ja s\'ha pagat.',
            'processing' => 'No pots modificar la comanda mentre s\'està processant.',
            'shipped' => 'No pots modificar la comanda perquè ja s\'ha enviat.',
        ],

        'status' => [
            'cancelled' => 'Cancel·lada',
            'checkout' => 'En preparació',
            'delivered' => 'Entregada',
            'paid' => 'Pagada',
            'processing' => 'Pendent de confirmació',
            'shipped' => 'Enviada',
            'title' => 'Estat de la comanda',
        ],

        'thanks' => [
            'title' => 'Moltes gràcies per la teva comanda!',
            'line_1' => [
                '_' => 'Rebràs un correu electrònic de confirmació aviat. Si tens alguna pregunta, si us plau :link!',
                'link_text' => 'contacta amb nosaltres',
            ],
        ],
    ],

    'product' => [
        'name' => 'Nom',

        'stock' => [
            'out' => 'Aquest element està esgotat. Torna més endavant!',
            'out_with_alternative' => 'Aquest element està esgotat. Utilitza el desplegable per a seleccionar un altre tipus o torna més endavant!',
        ],

        'add_to_cart' => 'Afegeix a la cistella',
        'notify' => 'Avisa\'m quan estigui disponible!',
        'out_of_stock' => 'Exhaurit',

        'notification_success' => 't\'avisarem quan tinguem noves existències. clica :link per cancel·lar',
        'notification_remove_text' => 'aquí',

        'notification_in_stock' => 'Aquest producte ja té existències!',
    ],

    'supporter_tag' => [
        'gift' => 'regalar a un jugador',
        'gift_message' => 'afegeix un missatge opcional al teu regal! (fins a :length caràcters)',

        'require_login' => [
            '_' => 'Has de ser :link per obtenir una etiqueta osu!supporter!',
            'link_text' => 'sessió iniciada',
        ],
    ],

    'username_change' => [
        'check' => 'Escriu un nom d\'usuari per comprovar la disponibilitat!',
        'checking' => 'Comprovant la disponibilitat de :username...',
        'placeholder' => 'Nom d\'usuari sol·licitat',
        'label' => 'Nou nom d\'usuari',
        'current' => 'El teu nom d\'usuari actual és «:username».',

        'require_login' => [
            '_' => 'Has de ser :link per a canviar el teu nom!',
            'link_text' => 'sessió iniciada',
        ],
    ],

    'xsolla' => [
        'distributor' => '',
    ],
];
