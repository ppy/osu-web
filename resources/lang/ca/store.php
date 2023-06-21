<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'cart' => [
        'checkout' => 'Realitza la compra',
        'info' => ':count_delimited producte al cistell ($:subtotal)|:count_delimited productes al cistell ($:subtotal)',
        'more_goodies' => 'Vull veure més productes abans de completar la compra',
        'shipping_fees' => 'despeses d\'enviament',
        'title' => 'Cistella de compra',
        'total' => 'total',

        'errors_no_checkout' => [
            'line_1' => 'Oh, hi ha problemes a la teva cistella que no permeten el pagament!',
            'line_2' => 'Elimina o canvia els productes de sobre per a continuar. ',
        ],

        'empty' => [
            'text' => 'La teva cistella està buida.',
            'return_link' => [
                '_' => 'Torna a :link per a trobar bons productes!',
                'link_text' => 'articles',
            ],
        ],
    ],

    'checkout' => [
        'cart_problems' => 'Oh, hi ha problemes amb la teva cistella!',
        'cart_problems_edit' => 'Fes clic aquí per a editar-ho.',
        'declined' => 'El pagament s\'ha cancel·lat.',
        'delayed_shipping' => 'Ara mateix no podem atendre totes les comandes! La teva compra és benvinguda, però considera un **retard addicional de 1-2 setmanes** mentre ens posem al dia amb les comandes actuals.',
        'hide_from_activity' => 'Amaga totes les etiquetes osu!supporter en aquesta ordre de la meva activitat',
        'old_cart' => 'La vostra cistella sembla desactualitzada i s\'ha reiniciat, torna-ho a intentar.',
        'pay' => 'Pagament amb Paypal',
        'title_compact' => 'pagament',

        'has_pending' => [
            '_' => 'Sembla que tens comandes pendents, fes clic :link per veure-les.',
            'link_text' => 'aquí',
        ],

        'pending_checkout' => [
            'line_1' => 'S\'ha iniciat una compra anterior però no s\'ha acabat.',
            'line_2' => 'Continua la teva comanda seleccionant un mètode de pagament.',
        ],
    ],

    'discount' => 'estalvia :percent%',

    'invoice' => [
        'echeck_delay' => 'Com que el seu pagament va ser un eCheck, si us plau permeti fins a 10 dies addicionals perquè el pagament es faci a través de PayPal!',
        'hide_from_activity' => 'Les etiquetes d\'osu!supporter en aquesta ordre no es mostren a les vostres activitats recents.',
        'title_compact' => 'factura',

        'status' => [
            'processing' => [
                'title' => 'El vostre pagament encara no s\'ha confirmat!',
                'line_1' => 'Si ja has pagat, potser volem rebre la confirmació del pagament. Sisplau, refresca aquesta pàgina en un parell de minuts!',
                'line_2' => [
                    '_' => 'Si heu trobat un problema durant la compra, :link',
                    'link_text' => 'fes clic aquí per a continuar la comanda',
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
        'shopify_expired' => 'L\'enllaç de pagament per aquesta comanda ha expirat.',

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
        ],
    ],

    'product' => [
        'name' => 'Nom',

        'stock' => [
            'out' => 'Aquest producte està esgotat. Torna més endavant!',
            'out_with_alternative' => 'Aquest producte està esgotat. Utilitza el desplegable per a seleccionar un altre tipus o torna més endavant!',
        ],

        'add_to_cart' => 'Afegeix a la cistella',
        'notify' => 'Avisa\'m quan estigui disponible!',

        'notification_success' => 't\'avisarem quan tinguem noves existències. clica :link per cancel·lar',
        'notification_remove_text' => 'aquí',

        'notification_in_stock' => 'Aquest producte ja té existències!',
    ],

    'supporter_tag' => [
        'gift' => 'regalar a un jugador',
        'gift_message' => 'afegeix un missatge opcional al teu regal! (fins a :length caràcters)',

        'require_login' => [
            '_' => 'Has de ser :link per obtenir una etiqueta d\'osu!supporter!',
            'link_text' => 'sessió iniciada',
        ],
    ],

    'username_change' => [
        'check' => 'Escriu un nom d\'usuari per comprovar la disponibilitat!',
        'checking' => 'Comprovant la disponibilitat de :username...',
        'require_login' => [
            '_' => 'Has de ser :link per a canviar el teu nom!',
            'link_text' => 'sessió iniciada',
        ],
    ],

    'xsolla' => [
        'distributor' => '',
    ],
];
