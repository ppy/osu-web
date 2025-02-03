<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'cart' => [
        'checkout' => 'Paga',
        'empty_cart' => 'Rimuovi tutti gli articoli dal carrello',
        'info' => ':count_delimited articolo nel carrello ($:subtotal)|:count_delimited articoli nel carrello ($:subtotal)',
        'more_goodies' => 'Voglio controllare altri articoli prima di completare l\'ordine',
        'shipping_fees' => 'costi di spedizione',
        'title' => 'Carrello',
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
        'delayed_shipping' => 'Attualmente siamo sommersi dagli ordini! Sei libero di effettuare ordini, ma ci si aspetta un **ritardo aggiuntivo di 1-2 settimane** mentre completiamo gli ordini già esistenti.',
        'hide_from_activity' => 'Nascondi tutti i tag osu!supporter in questo ordine dalla mia attività',
        'old_cart' => 'Il tuo carrello sembra essere obsoleto ed è stato ricaricato, per favore riprova.',
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
    'free' => 'gratis!',

    'invoice' => [
        'contact' => 'Referente:',
        'date' => 'Data:',
        'echeck_delay' => 'Visto che il tuo pagamento era un eCheck, dovrai attendere altri 10 giorni per far passare il pagamento attraverso PayPal!',
        'hide_from_activity' => 'I tag osu!supporter in questo ordine non verranno mostrati nella tua attività recente.',
        'sent_via' => 'Inviato con:',
        'shipping_to' => 'Indirizzo di spedizione:',
        'title' => 'Ricevuta',
        'title_compact' => 'ricevuta',

        'status' => [
            'cancelled' => [
                'title' => 'Il tuo ordine è stato annullato',
                'line_1' => [
                    '_' => "Se non hai richiesto la cancellazione contatta il :link menzionando il tuo numero d'ordine (#:order_number).",
                    'link_text' => 'supporto di osu!store',
                ],
            ],
            'delivered' => [
                'title' => 'Il tuo ordine è stato consegnato! Speriamo ti piaccia!',
                'line_1' => [
                    '_' => 'Se hai problemi con il tuo acquisto, contatta il :link.',
                    'link_text' => 'supporto di osu!store',
                ],
            ],
            'prepared' => [
                'title' => 'Il tuo ordine è in preparazione!',
                'line_1' => 'Si prega di attendere ancora un po\' prima che venga spedito. Le informazioni di tracciamento verranno visualizzate qui una volta che l\'ordine è stato elaborato e inviato. Questo può richiedere fino a cinque giorni (ma di solito meno!) a seconda di quanto siamo occupati.',
                'line_2' => 'Inviamo tutti gli ordini dal Giappone utilizzando una varietà di servizi di spedizione a seconda del peso e del valore. Questa area verrà aggiornata con le specifiche una volta spedito l\'ordine.',
            ],
            'processing' => [
                'title' => 'Il tuo pagamento non è ancora stato confermato!',
                'line_1' => 'Se hai già pagato, potremmo ancora essere in attesa di una conferma del tuo pagamento. Ricarica la pagina in un minuto o due!',
                'line_2' => [
                    '_' => 'Sei hai avuto un problema durante il pagamento, :link',
                    'link_text' => 'clicca qui per riprendere con il pagamento',
                ],
            ],
            'shipped' => [
                'title' => 'Il tuo ordine è stato spedito!',
                'tracking_details' => 'Dettagli di tracciamento:',
                'no_tracking_details' => [
                    '_' => "Non disponiamo dei dettagli di tracciabilità poiché abbiamo inviato il tuo pacco tramite posta aerea, ma puoi aspettarti di riceverlo entro 1-3 settimane. Per l'Europa, a volte la dogana può ritardare l'ordine senza il nostro controllo. Se hai qualche dubbio, rispondi all'e-mail di conferma dell'ordine che hai ricevuto (o :link).",
                    'link_text' => 'inviaci un\'email',
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
        'shipping_and_handling' => 'Spedizione e Trasporto',
        'shopify_expired' => 'Il link del pagamento per quest\'ordine è scaduto.',
        'subtotal' => 'Subtotale',
        'total' => 'Totale',

        'details' => [
            'order_number' => 'Ordine #',
            'payment_terms' => 'Termini di Pagamento',
            'salesperson' => '',
            'shipping_method' => 'Metodo di Spedizione',
            'shipping_terms' => 'Termini di Spedizione',
            'title' => 'Dettagli Ordine',
        ],

        'item' => [
            'quantity' => 'quantità',

            'display_name' => [
                'supporter_tag' => ':name per :username (:duration)',
            ],

            'subtext' => [
                'supporter_tag' => 'Messaggio: :message',
            ],
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
            'title' => 'Stato Ordine',
        ],

        'thanks' => [
            'title' => 'Grazie per il tuo ordine!',
            'line_1' => [
                '_' => 'Riceverai presto un\'email di conferma. Per qualsiasi richiesta, :link!',
                'link_text' => 'contattaci',
            ],
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

        'notification_success' => 'verrai avvisato quando sarà disponibile. clicca :link per annullare',
        'notification_remove_text' => 'qui',

        'notification_in_stock' => 'Questo prodotto è già disponibile!',
    ],

    'supporter_tag' => [
        'gift' => 'regala ad un giocatore',
        'gift_message' => 'aggiungi un messaggio opzionale al tuo regalo (fino a :length caratteri)',

        'require_login' => [
            '_' => 'Devi :link per poter ottenere un tag supporter!',
            'link_text' => 'eseguire l\'accesso',
        ],
    ],

    'username_change' => [
        'check' => 'Inserisci un nome utente per controllare la disponibilità!',
        'checking' => 'Controllando la disponibilità di :username...',
        'placeholder' => 'Nome Utente Richiesto',
        'label' => 'Nuovo Nome Utente',
        'current' => 'Il tuo nome utente attuale è ":username".',

        'require_login' => [
            '_' => 'Devi :link per poter cambiare il tuo nome!',
            'link_text' => 'eseguire l\'accesso',
        ],
    ],

    'xsolla' => [
        'distributor' => '',
    ],
];
