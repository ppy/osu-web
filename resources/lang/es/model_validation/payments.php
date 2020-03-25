<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

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
        'not_echeck' => 'El pago pendiente no es un cheque electrónico. (:actual)',
    ],
    'purchase' => [
        'checkout' => [
            'amount' => 'La cantidad a pagar no coincide: :actual != :expected',
            'currency' => 'El pago no se ha realizado en USD. (:type)',
        ],
    ],
    'order_number' => [
        'malformed' => 'El ID recibido de la transacción de la orden está malformado',
        'user_id_mismatch' => 'external_id contiene un ID de usuario equivocado',
    ],
];
