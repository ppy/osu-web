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

    'cart' => [
        'checkout' => 'Pagamento',
        'more_goodies' => 'Voglio dare un\'occhiata ad altri elementi prima di completare l\'ordine',
        'shipping_fees' => 'costi di spedizione',
        'title' => 'Carrello della spesa',
        'total' => 'totale',

        'errors_no_checkout' => [
            'line_1' => 'Uh oh, ci sono problemi con il tuo carrello che stanno impedendo il check-out!',
            'line_2' => 'Rimuovere o aggiornare gli elementi di sopra per continuare.',
        ],

        'empty' => [
            'text' => 'Il tuo carrello è vuoto.',
            'return_link' => [
                '_' => 'Ritorna al :link per trovare alcuni elementi!',
                'link_text' => 'listino',
            ],
        ],
    ],

    'checkout' => [
        'cart_problems' => 'Uh oh, ci sono dei problemi con il carrello!',
        'cart_problems_edit' => 'Clicca qui per modificarlo.',
        'declined' => 'Il pagamento è annullato.',
        'old_cart' => 'Il tuo carrello sembra essere obsoleto ed è stato ricaricato, per favore riprova.',
        'pay' => 'Acquista con Paypal',
        'pending_checkout' => [
            'line_1' => 'Un precedente check-out è stato iniziato ma non è stato portato a termine.',
            'line_2' => 'Riprendi il tuo checkout selezionando un metodo di pagamento, o :link per annullare.',
            'link_text' => 'clicca qui',
        ],
        'delayed_shipping' => 'Attualmente siamo sommersi dagli ordini! Sei libero di effettuare ordini, ma per favore aspettati un **ritardo addizionale di 1-2 settimane** mentre completiamo gli ordini già esistenti.',
    ],

    'discount' => 'risparmi :percent%',

    'mail' => [
        'payment_completed' => [
            'subject' => 'Abbiamo ricevuto il tuo ordine su osu!store!',
        ],
    ],

    'order' => [
        'item' => [
            'display_name' => [
                'supporter_tag' => ':name per :username(:duration)',
            ],
            'quantity' => 'Quantità',
        ],

        'not_modifiable_exception' => [
            'cancelled' => 'Non è possibile modificare il vostro ordine in quanto è stato cancellato.',
            'checkout' => 'Non è possibile modificare il vostro ordine mentre è processato.', // checkout and processing should have the same message.
            'default' => 'L\'ordine non è modificabile',
            'delivered' => 'Non è possibile modificare il vostro ordine in quanto è stato consegnato.',
            'paid' => 'Non è possibile modificare il vostro ordine in quanto è stato già pagato.',
            'processing' => 'Non è possibile modificare il vostro ordine mentre è processato.',
            'shipped' => 'Non è possibile modificare il vostro ordine in quanto è stato inviato.',
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
            '_' => 'Devi avere l\':link per ottenere un tag supporter!',
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
