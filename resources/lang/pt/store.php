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
        'checkout' => 'Pagamento',
        'more_goodies' => 'Quero adicionar mais coisas boas antes de completar o pedido',
        'shipping_fees' => 'custos de envio',
        'title' => 'Carrinho de Compras',
        'total' => 'total',

        'errors_no_checkout' => [
            'line_1' => 'Oh não, há problemas com o teu carrinho a impedir o pagamento!',
            'line_2' => 'Remove ou actualiza os itens acima para continuar.',
        ],

        'empty' => [
            'text' => 'O teu carrinho está vazio.',
            'return_link' => [
                '_' => 'Voltar ao :link para encontrar coisinhas boas!',
                'link_text' => 'listagem da loja',
            ],
        ],
    ],

    'checkout' => [
        'cart_problems' => 'Oh não, há problemas com o teu carrinho!',
        'cart_problems_edit' => 'Clica aqui para editá-lo.',
        'declined' => 'O pagamento foi cancelado.',
        'old_cart' => 'O teu carrinho parece que está fora de prazo e foi recarregado, por favor tenta outra vez.',
        'pay' => 'Pagar com Paypal',
        'pending_checkout' => [
            'line_1' => 'Um pagamento prévio foi iniciado mas não foi terminado.',
            'line_2' => 'Resume o teu pagamento ao seleccionar um método de pagamento, ou :link para cancelar.',
            'link_text' => 'clica aqui',
        ],
        'delayed_shipping' => 'Nós estamos actualmente sobrecarregados com encomendas! És bem-vindo em fazeres o teu pedido, mas por favor espera aguardar **1-2 semanas** enquanto alcançamos os pedidos existentes.',
    ],

    'discount' => 'poupa :percent%',

    'mail' => [
        'payment_completed' => [
            'subject' => 'Nós recebemos o teu pedido da osu!store!',
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
            'cancelled' => 'Não podes modificar o teu pedido porque foi cancelado.',
            'checkout' => 'Tu não podes alterar o teu pedido enquanto está a ser processado.', // checkout and processing should have the same message.
            'default' => 'O pedido não é alterável',
            'delivered' => 'Tu não podes alterar o teu pedido porque já foi entregue.',
            'paid' => 'Tu não podes alterar o teu pedido porque já foi pago.',
            'processing' => 'Tu não podes alterar o teu pedido porque já foi processado.',
            'shipped' => 'Tu não podes alterar o teu pedido porque já foi enviado.',
        ],
    ],

    'product' => [
        'name' => 'Nome',

        'stock' => [
            'out' => 'Este item está actualmente fora de stock. Verifica mais tarde!',
            'out_with_alternative' => 'Infelizmente este item está fora de stock. Usa o "dropdown" para escolher um tipo diferente ou verifica mais tarde!',
        ],

        'add_to_cart' => 'Adicionar ao Carrinho',
        'notify' => 'Notificar-me quando estiver disponível!',

        'notification_success' => 'serás notificado quando tivermos um novo stock. clica em :link para cancelar',
        'notification_remove_text' => 'aqui',

        'notification_in_stock' => 'Este produto já está no stock!',
    ],

    'supporter_tag' => [
        'gift' => 'oferecer ao jogador',
        'require_login' => [
            '_' => 'Tu precisas de ser :link para arranjar uma etiqueta osu!supporter!',
            'link_text' => 'sessão iniciada em',
        ],
    ],

    'username_change' => [
        'check' => 'Introduz um nome de utilizador para confirmar disponibilidade!',
        'checking' => 'A confirmar disponibilidade de :username...',
        'require_login' => [
            '_' => 'Tu precisas de ser :link para mudares o teu nome!',
            'link_text' => 'sessão iniciada',
        ],
    ],
];
