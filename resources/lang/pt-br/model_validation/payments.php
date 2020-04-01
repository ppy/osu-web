<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'signature' => [
        'not_match' => 'Assinaturas não conferem',
    ],
    'notification_type' => 'notification_type é inválido :type',
    'order' => [
        'invalid' => 'O pedido é inválido',
        'items' => [
            'virtual_only' => 'Pagamento através de `:provider` é inválido para itens físicos.',
        ],
        'status' => [
            'not_checkout' => 'Tentando aceitar pagamento de um pedido no estado errado `:state`.',
            'not_paid' => 'Tentando reembolsar pagamento de um pedido no estado errado `:state`.',
        ],
    ],
    'param' => [
        'invalid' => 'O parâmetro `:param` não confere',
    ],
    'paypal' => [
        'not_echeck' => 'O pagamento pendente não é um pagamento virtual. (:actual)',
    ],
    'purchase' => [
        'checkout' => [
            'amount' => 'Quantia oferecida é inexata: :actual != :expected',
            'currency' => 'O pagamento não é em dólar (USD). (:type)',
        ],
    ],
    'order_number' => [
        'malformed' => 'ID de transação recebido é inválido',
        'user_id_mismatch' => 'external_id contém número de usuário inválido',
    ],
];
