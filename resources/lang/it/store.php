<?php

/**
 *    Copyright 2015-2018 ppy Pty. Ltd.
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
        'warehouse' => 'Magazzino',
    ],

    'checkout' => [
        'cart_problems' => 'Uh oh, ci sono dei problemi con il carrello!',
        'cart_problems_edit' => 'Clicca qui per modificarlo.',
        'declined' => 'Il pagamento è annullato.',
        'error' => 'Si è verificato un errore durante il checkout :(',
        'old_cart' => 'Il tuo carrello sembra essere obsoleto ed è stato ricaricato, si prega di riprovare.',
        'pay' => 'Acquista con Paypal',
        'pending_checkout' => [
            'line_1' => 'Un precedente check-out è stato iniziato ma non è stato portato a termine.',
            'line_2' => 'Riprendi il tuo checkout selezionando un metodo di pagamento, o :link to annullare.',
            'link_text' => 'clicca qui',
        ],
        'delayed_shipping' => 'Attualmente siamo sommersi dagli ordini! Siete i benvenuti per lasciare i vostri ordini, ma per favore aspettatevi un **ritardo addizionale di 1-2 settimane** mentre completiamo gli ordini già esistenti.',
    ],

    'discount' => 'risparmi :percent%',

    'mail' => [
        'payment_completed' => [
            'subject' => 'Abbiamo ricevuto il tuo ordine di osu!store!',
        ],
    ],

    'order' => [
        'item' => [
            'display_name' => [
                'supporter_tag' => ':name per :username(:duration)',
            ],
            'quantity' => 'Quantità',
        ],
    ],

    'product' => [
        'name' => 'Nome',

        'stock' => [
            'out' => 'Attualmente non disponibile :(. Controlla più tardi.',
            'out_with_alternative' => 'Questo tipo non è attualmente disponibile :(. Prova con un altro tipo o controlla più tardi.',
        ],

        'add_to_cart' => 'Aggiungi al carrello',
        'notify' => 'Avvisami quando è disponibile!',

        'notification_success' => 'sarai avvisato quando sarà disponibile. clicca :link per annullare',
        'notification_remove_text' => 'qui',

        'notification_in_stock' => 'Questo prodotto è già disponibile!',
    ],

    'supporter_tag' => [
        'gift' => 'regalo ad un giocatore',
        'require_login' => [
            '_' => 'Devi essere :link per ottenere un tag sostenitore!',
            'link_text' => 'accesso effettuato',
        ],
    ],

    'username_change' => [
        'check' => 'Inserisci un nome utente per controllare la disponibilità!',
        'checking' => 'Controllando la disponibilità di :username...',
        'require_login' => [
            '_' => 'Devi essere :link per cambiare il tuo nome!',
            'link_text' => 'accesso effettuato',
        ],
    ],
];
