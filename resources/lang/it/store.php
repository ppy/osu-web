<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'cart' => [
        'checkout' => 'Paga',
        'info' => ':count_delimited articolo nel carrello ($:subtotal)|:count_delimited articoli nel carrello ($:subtotal)',
        'more_goodies' => 'Voglio dare un\'occhiata ad altri elementi prima di completare l\'ordine',
        'shipping_fees' => 'costi di spedizione',
        'title' => 'Carrello della spesa',
        'total' => 'totale',

        'errors_no_checkout' => [
            'line_1' => 'Uh oh, ci sono problemi con il tuo carrello che stanno impedendo il pagamento!',
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
        'cart_problems' => 'Uh oh, ci sono problemi con il carrello!',
        'cart_problems_edit' => 'Clicca qui per modificarlo.',
        'declined' => 'Il pagamento è stato annullato.',
        'delayed_shipping' => 'Attualmente siamo sommersi dagli ordini! Sei libero di effettuare ordini, ma per favore aspettati un **ritardo addizionale di 1-2 settimane** mentre completiamo gli ordini già esistenti.',
        'old_cart' => 'Il tuo carrello sembra essere obsoleto ed è stato ricaricato; per favore riprova.',
        'pay' => 'Acquista con Paypal',
        'title_compact' => 'pagamento',

        'has_pending' => [
            '_' => 'Hai dei pagamenti incompleti, clicca :link per vederli.',
            'link_text' => 'qui',
        ],

        'pending_checkout' => [
            'line_1' => 'Un pagamento precedente è stato iniziato ma non è stato portato a termine.',
            'line_2' => 'Completa il tuo pagamento selezionando un metodo di pagamento.',
        ],
    ],

    'discount' => 'risparmi :percent%',

    'invoice' => [
        'echeck_delay' => 'Visto che il tuo pagamento era un eCheck, dovrai attendere altri 10 giorni per far passare il pagamento attraverso PayPal!',
        'title_compact' => 'ricevuta',

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
        'cancel' => 'Annulla Ordine',
        'cancel_confirm' => 'Quest\'ordine verrà annullato insieme al suo pagamento. Il provider del pagamento potrebbe non rilasciare immediatamente i fondi riservati. Sei sicuro?',
        'cancel_not_allowed' => 'Quest\'ordine non può essere annullato al momento.',
        'invoice' => 'Mostra Ricevuta',
        'no_orders' => 'Nessun ordine da visualizzare.',
        'paid_on' => 'Ordine effettuato :date',
        'resume' => 'Riprendi Pagamento',
        'shopify_expired' => 'Il link del pagamento per quest\'ordine è scaduto.',

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
            'out' => 'Questo elemento è attualmente esaurito. Controlla più tardi!',
            'out_with_alternative' => 'Sfortunatamente questo elemento è esaurito. Usa il menu a discesa per sceglierne un altro tipo oppure controlla più tardi!',
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
            '_' => 'Devi :link per poter ottenere un tag supporter!',
            'link_text' => 'eseguire l\'accesso',
        ],
    ],

    'username_change' => [
        'check' => 'Inserisci un nome utente per controllare la disponibilità!',
        'checking' => 'Controllando la disponibilità di :username...',
        'require_login' => [
            '_' => 'Devi :link per poter cambiare il tuo nome!',
            'link_text' => 'eseguire l\'accesso',
        ],
    ],

    'xsolla' => [
        'distributor' => '',
    ],
];
