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
    'admin' => [
        'warehouse' => 'Armazém',
    ],

    'checkout' => [
        'cart_problems' => 'Ops, seu carrinho parece ter alguns problemas!',
        'cart_problems_edit' => 'Clique aqui para editá-lo.',
        'declined' => 'O pagamento foi cancelado.',
        'error' => 'Houve um problema com a sua compra :(',
        'old_cart' => 'Your cart appears to be out of date and has been reloaded, please try again.',
        'pay' => 'Pagar com o Paypal',
        'pending_checkout' => [
            'line_1' => 'Uma compra antiga foi atualizada mas não foi finalizada.',
            'line_2' => 'Continue a sua compra selecionando um método de pagamento, ou :link para cancelar.',
            'link_text' => 'clique aqui',
        ],
        'delayed_shipping' => 'Nós estamos sobrecarregados com pedidos! Você pode fazer seu pedido, mas por favor espere um **atraso adicional de 1-2 semanas** enquaanto nós realizamos os pedidos mais recentes.',
    ],

    'discount' => 'economize :percent%',

    'mail' => [
        'payment_completed' => [
            'subject' => 'We received your osu!store order!',
        ],
    ],

    'order' => [
        'item' => [
            'display_name' => [
                'supporter_tag' => ':name para :username (:duration)',
            ],
            'quantity' => 'Quantidade',
        ],
    ],

    'product' => [
        'name' => 'Nome',

        'stock' => [
            'out' => 'Este item está fora de estoque. Volte mais tarde!',
            'out_with_alternative' => 'Infelizmente este item está fora de estoque. Por favor, selecione outro ou tente novamente mais tarde!',
        ],

        'add_to_cart' => 'Adicionar ao Carrinho',
        'notify' => 'Me notifique quando estiver disponível!',

        'notification_success' => 'você será notificado quando tivermos o produto em estoque. clique :link para cancelar',
        'notification_remove_text' => 'aqui',

        'notification_in_stock' => 'Este produto já está no estoque!',
    ],

    'supporter_tag' => [
        'gift' => 'dar de presente',
        'require_login' => [
            '_' => 'Você precisa estar :link para comprar uma supporter tag!',
            'link_text' => 'conectado',
        ],
    ],

    'username_change' => [
        'check' => 'Entre com um username para checar disponibilidade!',
        'checking' => 'Checando disponibilidade de :username...',
        'require_login' => [
            '_' => 'Você precisa estar :link para mudar o seu nome!',
            'link_text' => 'conectado',
        ],
    ],
];
