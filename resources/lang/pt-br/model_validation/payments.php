<?php

/**
 *    Copyright 2015-2017 ppy Pty. Ltd.
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
        'not_match' => 'Assinaturas não conferem',
    ],
    'notification_type' => 'notification_type invalida :type',
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
        'malformed' => 'Não obteve êxito na criação do número de transação',
        'user_id_mismatch' => 'external_id contêm número de usuário inválido',
    ],
];
