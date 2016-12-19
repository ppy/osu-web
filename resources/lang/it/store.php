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
        'delayed_shipping' => 'Attualmente siamo sommersi dagli ordini! Siete i benvenuti per lasciare i vostri ordini, ma per favore aspettatevi un **ritardo addizionale di 1-2 settimane** mentre completiamo gli ordini gi� esistenti.',
    ],

    'order' => [
        'item' => [
            'quantity' => 'Quantit�',
        ],
    ],

    'product' => [
        'name' => 'Nome',

        'stock' => [
            'out' => 'Attualmente non disponibile :(. Controlla pi� tardi.',
            'out_with_alternative' => 'Questo tipo non � attualmente disponibile :(. Prova con un altro tipo o controlla pi� tardi.',
        ],

        'add_to_cart' => 'Aggiungi al carrello',
        'notify' => 'Avvisami quando � disponibile!',

        'notification_success' => 'sarai avvisato quando sar� disponibile. clicca :link per annullare',
        'notification_remove_text' => 'qui',

        'notification_in_stock' => 'Questo prodotto � gi� disponibile!',

        'notification_exists' => 'Hai gi� richiesto un avviso per questo prodotto!',
        'notification_doesnt_exist' => "Non hai ancora chiesto un'avviso per questo prodotto!",
    ],
];
