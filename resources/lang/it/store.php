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
        'warehouse' => 'Magazzino',
    ],

    'cart' => [
        'checkout' => 'Pagamento',
        'info' => ':count_delimited articolo nel carrello ($:subtotal)|:count_delimited articoli nel carrello ($:subtotal)',
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
                '_' => 'Ritorna alla :link per trovare alcuni elementi!',
                'link_text' => 'lista',
            ],
        ],
    ],

    'checkout' => [
        'cart_problems' => 'Uh oh, ci sono dei problemi con il carrello!',
        'cart_problems_edit' => 'Clicca qui per modificarlo.',
        'declined' => 'Il pagamento è annullato.',
        'delayed_shipping' => 'Attualmente siamo sommersi dagli ordini! Sei libero di effettuare ordini, ma per favore aspettati un **ritardo addizionale di 1-2 settimane** mentre completiamo gli ordini già esistenti.',
        'old_cart' => 'Il tuo carrello sembra essere obsoleto ed è stato ricaricato; per favore riprova.',
        'pay' => 'Acquista con Paypal',

        'has_pending' => [
            '_' => 'Hai pagamenti incompleti, click :link per vederli.',
            'link_text' => 'qui',
        ],

        'pending_checkout' => [
            'line_1' => 'Un precedente check-out è stato iniziato ma non è stato portato a termine.',
            'line_2' => 'Completa il tuo pagamento selezionando un metodo di pagamento.',
        ],
    ],

    'discount' => 'risparmi :percent%',

    'invoice' => [
        'echeck_delay' => 'Visto che il tuo pagamento era un eCheck, dovrai attendere altri 10 giorni per far passare il pagamento attraverso PayPal!',
        'status' => [
            'processing' => [
                'title' => 'Il tuo pagamento non è ancora stato confermato!',
                'line_1' => 'Se hai già pagato, potremmo ancora essere in attesa di una conferma del tuo pagamento. Per favore ricarica la pagina in un minuto o due!',
                'line_2' => [
                    '_' => 'Sei hai avuto un problema durante il pagamento, :link',
                    'link_text' => 'clicca qui per riprendere con il pagamento',
                ],
            ],
        ],
    ],

    'order' => [
        'paid_on' => 'Ordine effettuato :date',

        'invoice' => 'Mostra Ricevuta',
        'no_orders' => 'Nessun ordine da visualizzare.',
        'resume' => 'Riprendi il checkout',

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

        'status' => [
            'cancelled' => 'Cancellato',
            'checkout' => 'In Preparazione',
            'delivered' => 'Consegnato',
            'paid' => 'Pagato',
            'processing' => 'In attesa di conferma',
            'shipped' => 'In Transito',
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

    'xsolla' => [
        'distributor' => '',
    ],
];
