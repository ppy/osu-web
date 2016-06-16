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
        'warehouse' => 'Almacén',
    ],
    'checkout' => [
        'pay' => 'Facturar con Paypal',
        'delayed_shipping' => '¡Estamos actualmente sobresaturados con órdenes! Eres bienvenido a solicitar tu orden, pero considera un **retraso adicional de 1-2 semanas** mientras nos ponemos al día con órdenes ya existentes.',
    ],
    'order' => [
        'item' => [
            'quantity' => 'Cantidad',
        ],
    ],
    'product' => [
        'name' => 'Nombre',
        'stock' => [
            'out' => 'Actualmente sin existencias :(. Vuelve a revisar pronto.',
            'out_with_alternative' => 'Este tipo no tiene existencias  :(. Intenta otro tipo o vuelve a revisar pronto.',
        ],
        'add_to_cart' => 'Añadir al carrito',
        'notify' => '¡Notificarme cuando esté disponible!',
        'notification_success' => 'serás notificado cuando tengamos más existencias. clic :link para cancelar',
        'notification_remove_text' => 'aquí',
        'notification_in_stock' => '¡Este producto ya tiene existencias!',
        'notification_exists' => '¡Ya has solicitado una notificación para este producto!',
        'notification_doesnt_exist' => "¡Ni siquiera has solicitado una notificación para este producto!",
    ],
];
