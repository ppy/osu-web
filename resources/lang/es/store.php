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
        'warehouse' => 'Almacén',
    ],

    'checkout' => [
        'cart_problems' => '¡Oh oh, hay problemas en tu carrito!',
        'cart_problems_edit' => 'Haz clic aquí para ir a editarlo.',
        'declined' => 'El pago ha sido cancelado.',
        'error' => 'Ocurrió un problema al completar tu factura :(',
        'pay' => 'Facturar con Paypal',
        'pending_checkout' => [
            'line_1' => 'Una factura ha sido iniciada pero no ha sido completada.',
            'line_2' => 'Continúa con tu factura seleccionando un método de pago, o :link para cancelarlo.',
            'link_text' => 'haz clic aquí',
        ],
        'delayed_shipping' => '¡Ahora mismo estamos sobresaturados de pedidos! Eres bienvenido a solicitar tu orden, pero considera un **retraso adicional de 1-2 semanas** mientras nos ponemos al día con órdenes ya existentes.',
    ],

    'discount' => 'ahorra un :percent%',

    'order' => [
        'item' => [
            'display_name' => [
                'supporter_tag' => ':name para :username (:duration)',
            ],
            'quantity' => 'Cantidad',
        ],
    ],

    'product' => [
        'name' => 'Nombre',

        'stock' => [
            'out' => 'Este producto está actualmente agotado. Vuelve a revisar pronto.',
            'out_with_alternative' => 'Desafortunadamente, este producto está actualmente agotado para este tipo. Utiiza la lista desplegable para seleccionar otro tipo o vuelve a revisar pronto.',
        ],

        'add_to_cart' => 'Añadir al carrito',
        'notify' => '¡Notificarme cuando esté disponible!',

        'notification_success' => 'serás notificado cuando tengamos más existencias. Haz clic :link para cancelar',
        'notification_remove_text' => 'aquí',

        'notification_in_stock' => '¡Este producto ya tiene existencias!',
    ],

    'supporter_tag' => [
        'gift' => 'regalar al jugador',
        'require_login' => [
            '_' => '¡Tienes que :link para obtener un título de supporter!',
            'link_text' => 'iniciar sesión',
        ],
    ],

    'username_change' => [
        'require_login' => [
            '_' => '¡Tienes que :link para cambiar tu nombre de usuario!',
            'link_text' => 'iniciar sesión',
        ],
    ],
];
