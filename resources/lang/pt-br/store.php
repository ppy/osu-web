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
        'warehouse' => 'Armazém',
    ],

    'cart' => [
        'checkout' => 'Pagar',
        'more_goodies' => 'Gostaria de conferir mais coisas antes de finalizar meu pedido',
        'shipping_fees' => 'taxas de envio',
        'title' => 'Carrinho de Compras',
        'total' => 'total',

        'errors_no_checkout' => [
            'line_1' => 'Ops, há um problema em seu carrinho impedindo o pagamento!',
            'line_2' => 'Remova ou atualize os itens acima para continuar.',
        ],

        'empty' => [
            'text' => 'Seu carrinho está vazio.',
            'return_link' => [
                '_' => 'Volte à :link para encontrar coisas legais!',
                'link_text' => 'lista de produtos',
            ],
        ],
    ],

    'checkout' => [
        'cart_problems' => 'Ops, seu carrinho parece ter alguns problemas!',
        'cart_problems_edit' => 'Clique aqui para editá-lo.',
        'declined' => 'O pagamento foi cancelado.',
        'old_cart' => 'Seu carrinho aparenta estar desatualizado e foi recarregado, por favor tente novamente.',
        'pay' => 'Pagar com o Paypal',
        'pending_checkout' => [
            'line_1' => 'Um pagamento prévio foi iniciado mas não foi finalizado.',
            'line_2' => 'Continue a sua compra selecionando um método de pagamento, ou :link para cancelar.',
            'link_text' => 'clique aqui',
        ],
        'delayed_shipping' => 'Nós estamos sobrecarregados com pedidos! Você é bem-vindo para fazer seu pedido, mas por favor espere um **atraso adicional de 1-2 semanas** enquanto nós realizamos os pedidos mais recentes.',
    ],

    'discount' => 'economize :percent%',

    'mail' => [
        'payment_completed' => [
            'subject' => 'Recebemos o seu pedido da osu!store!',
        ],
    ],

    'order' => [
        'item' => [
            'display_name' => [
                'supporter_tag' => ':name para :username (:duration)',
            ],
            'quantity' => 'Quantidade',
        ],

        'not_modifiable_exception' => [
            'cancelled' => 'Você não pode mudar seu pedido, pois ele foi cancelado.',
            'checkout' => 'Você não pode modificar seu pedido enquanto está sendo processado.', // checkout and processing should have the same message.
            'default' => 'A ordem não é modificável',
            'delivered' => 'Você não pode modificar seu pedido, pois ele já foi entregue.',
            'paid' => 'Você não pode modificar seu pedido, pois ele já foi pago.',
            'processing' => 'Você não pode modificar seu pedido enquanto está sendo processado.',
            'shipped' => 'Você não pode modificar seu pedido, pois ele já foi enviado.',
        ],
    ],

    'product' => [
        'name' => 'Nome',

        'stock' => [
            'out' => 'Este item está atualmente fora de estoque. Volte mais tarde!',
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
            '_' => 'Você precisa estar :link para conseguir uma osu!supporter tag!',
            'link_text' => 'conectado',
        ],
    ],

    'username_change' => [
        'check' => 'Insira um nome de usuário para verificar a disponibilidade!',
        'checking' => 'Checando disponibilidade de :username...',
        'require_login' => [
            '_' => 'Você precisa estar :link para mudar o seu nome!',
            'link_text' => 'conectado',
        ],
    ],
];
