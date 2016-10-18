<?php

/**
 *    Copyright 2015 ppy Pty. Ltd.
 *
 *    This file is part of osu!web. osu!web is distributed in the hopes of
 *    attracting more community contributions to the core ecosystem of osu!
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
        'pay' => 'Acquista con Paypal',
        'delayed_shipping' => 'Attualmente siamo sommersi dagli ordini! Siete i benvenuti per lasciare i vostri ordini, ma per favore aspettatevi un **ritardo addizionale di 1-2 settimane** mentre completiamo gli ordini già esistenti.',
    ],

    'order' => [
        'item' => [
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

        'notification_exists' => 'Hai già richiesto un avviso per questo prodotto!',
        'notification_doesnt_exist' => "Non hai ancora chiesto un'avviso per questo prodotto!",
    ],
];
