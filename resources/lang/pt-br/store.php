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
        'error' => 'Tem um problema com a sua compra :(',
        'pay' => 'Pagar com o Paypal',
        'pending_checkout' => [
            'line_1' => 'Uma compra antiga foi atualizado, mas não foi finalizado.',
            'line_2' => 'Continue a sua compra selecionando um método de pagamento, ou :link para cancelar.',
            'link_text' => 'clique aqui',
        ],
        'delayed_shipping' => 'Nós estamos sobrecarregados com pedidos! Você pode requisitar seu pedido, mas espere um atraso adicional de **1-2 semanas** enquaanto nós tentamos alcançar os pedidos mais recentes.',
    ],

    'discount' => 'economize :percent%',

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
            'out' => 'Esse item está fora de estoque. Volte mais tarde!',
            'out_with_alternative' => 'Infelizmente esse item está fora de estoque. Por favor, selecione outro ou tente novamente mais tarde!',
        ],

        'add_to_cart' => 'Adicionar ao carrinho',
        'notify' => 'Me notifique quando estiver disponível!',

        'notification_success' => 'você será notificado quando tivermos um novo estoque. clique :link para cancelar',
        'notification_remove_text' => 'aqui',

        'notification_in_stock' => 'Esse produto já está no estoque!',
    ],

    'supporter_tag' => [
        'gift' => 'dar de presente',
        'require_login' => [
            '_' => 'Você precisa estar :link para comprar uma supporter tag!',
            'link_text' => 'conectado',
        ],
    ],

    'username_change' => [
        'require_login' => [
            '_' => 'Você precisa estar :link para mudar o seu nome!',
            'link_text' => 'conectado',
        ],
    ],
];
