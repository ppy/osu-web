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
    'signature' => [
        'not_match' => 'Las firmas no coinciden',
    ],
    'notification_type' => 'notification_type no es un :type válido',
    'order' => [
        'invalid' => 'La órden no es válida',
        'items' => [
            'virtual_only' => 'El pago con `:provider` no es válido para productos físicos',
        ],
        'status' => [
            'not_checkout' => 'Intentando aceptar el pago para una orden en mal estado `:state`.',
            'not_paid' => 'Intentando reembolsar el pago para una orden en mal estado `:state`.',
        ],
    ],
    'param' => [
        'invalid' => 'El parámetro `:param` no coincide',
    ],
    'paypal' => [
        'not_echeck' => 'El pago pendiente no es un chequeo electrónico. (:actual)',
    ],
    'purchase' => [
        'checkout' => [
            'amount' => 'La cantidad a pagar no coincide: :actual != :expected',
            'currency' => 'El pago no es en USD. (:type)',
        ],
    ],
    'order_number' => [
        'malformed' => 'La ID de la transacción de la orden recibida está malformada',
        'user_id_mismatch' => 'external_id contiene un ID de usuario equivocado',
    ],
];
