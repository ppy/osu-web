<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'cart' => [
        'checkout' => 'Pagamento',
        'info' => ':count_delimited artigo no carrinho ($:subtotal)|:count_delimited artigos no carrinho ($:subtotal)',
        'more_goodies' => 'Quero adicionar mais brindes antes de completar o pedido',
        'shipping_fees' => 'custos de envio',
        'title' => 'Carrinho de compras',
        'total' => 'total',

        'errors_no_checkout' => [
            'line_1' => 'Oh não, há problemas com o teu carrinho a impedir o pagamento!',
            'line_2' => 'Remove ou atualiza os artigos acima para continuar.',
        ],

        'empty' => [
            'text' => 'O teu carrinho está vazio.',
            'return_link' => [
                '_' => 'Volta ao :link para encontrar brindes!',
                'link_text' => 'listagem da loja',
            ],
        ],
    ],

    'checkout' => [
        'cart_problems' => 'Oh não, há problemas com o teu carrinho!',
        'cart_problems_edit' => 'Clica aqui para editá-lo.',
        'declined' => 'O pagamento foi cancelado.',
        'delayed_shipping' => 'Nós estamos atualmente sobrecarregados com encomendas! Podes realizar o teu pedido, mas por favor espera aguardar **1-2 semanas** enquanto nos pomos a par dos pedidos existentes.',
        'old_cart' => 'O teu carrinho parece que está fora de prazo e foi recarregado, por favor tenta outra vez.',
        'pay' => 'Pagar com Paypal',
        'title_compact' => 'pagamento',

        'has_pending' => [
            '_' => 'Tens pagamentos incompletos, clica :link para os veres.',
            'link_text' => 'aqui',
        ],

        'pending_checkout' => [
            'line_1' => 'Um pagamento prévio foi iniciado mas não foi terminado.',
            'line_2' => 'Resume o teu pagamento ao selecionar um método de pagamento.',
        ],
    ],

    'discount' => 'poupa :percent%',

    'invoice' => [
        'echeck_delay' => 'Como o teu pagamento era um eCheck, por favor permite até 10 dias extras para o pagamento ser autorizado através do PayPal!',
        'title_compact' => 'fatura',

        'status' => [
            'processing' => [
                'title' => 'O teu pagamento ainda não foi confirmado!',
                'line_1' => 'Se já pagaste, ainda poderemos estar à espera de receber a confirmação do teu pagamento. Por favor atualiza esta página dentro de um minuto ou dois!',
                'line_2' => [
                    '_' => 'Se encontraste um problema durante o pagamento, :link',
                    'link_text' => 'clica aqui para resumir o teu pagamento',
                ],
            ],
        ],
    ],

    'order' => [
        'cancel' => 'Cancelar o pedido',
        'cancel_confirm' => 'Este pedido será cancelado e o seu pagamento não será aceite. O fornecedor de pagamento poderá não reembolsar imediatamente. Tens a certeza?',
        'cancel_not_allowed' => 'Este pedido não pode ser cancelado de momento.',
        'invoice' => 'Ver fatura',
        'no_orders' => 'Sem pedidos para ver.',
        'paid_on' => 'Pedido colocado em :date',
        'resume' => 'Retomar pagamento',
        'shopify_expired' => 'O link de pagamento para este pedido expirou.',

        'item' => [
            'display_name' => [
                'supporter_tag' => ':name para :username (:duration)',
            ],
            'quantity' => 'Quantidade',
        ],

        'not_modifiable_exception' => [
            'cancelled' => 'Não podes modificar o teu pedido porque foi cancelado.',
            'checkout' => 'Não podes alterar o teu pedido enquanto estiver a ser processado.', // checkout and processing should have the same message.
            'default' => 'O pedido não é alterável',
            'delivered' => 'Não podes alterar o teu pedido porque já foi entregue.',
            'paid' => 'Não podes alterar o teu pedido porque já foi pago.',
            'processing' => 'Não podes alterar o teu pedido porque já foi processado.',
            'shipped' => 'Não podes alterar o teu pedido porque já foi enviado.',
        ],

        'status' => [
            'cancelled' => 'Cancelados',
            'checkout' => 'Em preparação',
            'delivered' => 'Entregues',
            'paid' => 'Pagos',
            'processing' => 'Confirmação pendente',
            'shipped' => 'Em curso',
        ],
    ],

    'product' => [
        'name' => 'Nome',

        'stock' => [
            'out' => 'Este artigo está esgotado atualmente. Volta mais tarde!',
            'out_with_alternative' => 'Infelizmente este artigo está fora de stock. Usa a opção de colapsar para escolher um tipo diferente ou volta mais tarde!',
        ],

        'add_to_cart' => 'Adicionar ao carrinho',
        'notify' => 'Notifica-me quando estiver disponível!',

        'notification_success' => 'serás notificado quando tivermos um novo stock. clica em :link para cancelar',
        'notification_remove_text' => 'aqui',

        'notification_in_stock' => 'Este produto já está em stock!',
    ],

    'supporter_tag' => [
        'gift' => 'oferecer ao jogador',
        'require_login' => [
            '_' => 'Precisas de ser :link para arranjar uma etiqueta osu!supporter!',
            'link_text' => 'sessão iniciada',
        ],
    ],

    'username_change' => [
        'check' => 'Introduz um nome de utilizador para confirmar disponibilidade!',
        'checking' => 'A confirmar disponibilidade de :username...',
        'require_login' => [
            '_' => 'Precisas de ser :link para mudares o teu nome!',
            'link_text' => 'sessão iniciada',
        ],
    ],

    'xsolla' => [
        'distributor' => '',
    ],
];
