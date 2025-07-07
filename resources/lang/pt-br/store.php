<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'cart' => [
        'checkout' => 'Pagar',
        'empty_cart' => 'Remover todos os itens do carrinho',
        'info' => ':count_delimited item no carrinho ($:subtotal)|:count_delimited itens no carrinho ($:subtotal)',
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
        'delayed_shipping' => 'Nós estamos sobrecarregados com pedidos! Você é bem-vindo para fazer seu pedido, mas por favor espere um **atraso adicional de 1-2 semanas** enquanto nós realizamos os pedidos mais recentes.',
        'hide_from_activity' => 'Ocultar todas as tags de osu!supporter nesta ordem da minha atividade',
        'old_cart' => 'Seu carrinho aparenta estar desatualizado e foi recarregado, por favor tente novamente.',
        'pay' => 'Pagar com o Paypal',
        'title_compact' => 'pagar',

        'has_pending' => [
            '_' => 'Você possui pedidos incompletos. Clique :link para visualizá-los.',
            'link_text' => 'aqui',
        ],

        'pending_checkout' => [
            'line_1' => 'Um pagamento prévio foi iniciado mas não foi finalizado.',
            'line_2' => 'Continue sua compra selecionando um método de pagamento.',
        ],
    ],

    'discount' => 'economize :percent%',
    'free' => 'gratuito! ',

    'invoice' => [
        'contact' => 'Contato:',
        'date' => 'Data:',
        'echeck_delay' => 'Como seu pagamento foi um eCheck, por favor aguarde por até 10 dias para se concluir o pagamento via PayPal!',
        'echeck_denied' => 'O pagamento eCheck foi rejeitado pelo PayPal.',
        'hide_from_activity' => 'As tags de osu!supporter nesta ordem não são exibidas nas suas atividades recentes.',
        'sent_via' => 'Enviado via:',
        'shipping_to' => 'Envio para:',
        'title' => 'Fatura',
        'title_compact' => 'fatura',

        'status' => [
            'cancelled' => [
                'title' => 'O seu pedido foi cancelado',
                'line_1' => [
                    '_' => "Se você não solicitou um cancelamento, entre em contato com :link com o número do seu pedido (#:order_number).",
                    'link_text' => 'suporte da osu!store',
                ],
            ],
            'delivered' => [
                'title' => 'Seu pedido foi entregue! Esperamos que esteja gostando!',
                'line_1' => [
                    '_' => 'Se você tiver algum problema com a sua compra, por favor, entre em contato com :link.',
                    'link_text' => 'suporte da osu!store',
                ],
            ],
            'prepared' => [
                'title' => 'Seu pedido está sendo preparado!',
                'line_1' => 'Por favor, aguarde um pouco mais para que seu produto seja enviado. As informações de rastreamento aparecerão aqui assim que o pedido for processado e enviado. Isso pode levar até 5 dias (mas geralmente menos!) dependendo da demanda.',
                'line_2' => 'Enviamos todas as encomendas do Japão usando uma variedade de serviços de transporte, dependendo do peso e do valor. Esta área será atualizada com mais detalhes após enviarmos a encomenda.',
            ],
            'processing' => [
                'title' => 'Seu pagamento ainda não foi confirmado!',
                'line_1' => 'Se você já pagou, nós ainda estamos esperando pela confirmação. Por favor atualize a página daqui um minuto ou dois!',
                'line_2' => [
                    '_' => 'Se você encontrou algum problema, :link',
                    'link_text' => 'clique aqui para continuar com a compra',
                ],
            ],
            'shipped' => [
                'title' => 'Seu pedido foi enviado!',
                'tracking_details' => 'Detalhes do rastreamento:',
                'no_tracking_details' => [
                    '_' => "Não temos detalhes de rastreio já que enviamos o seu pacote via Air Mail, mas você pode esperar recebê-lo dentro de 1-3 semanas. Para a Europa, as alfândegas podem atrasar a ordem e isso está fora do nosso controle. Se você tiver algum problema, por favor, responda o e-mail de confirmação de pedido que você recebeu :link.",
                    'link_text' => 'envie-nos um e-mail',
                ],
            ],
        ],
    ],

    'order' => [
        'cancel' => 'Cancelar Ordem',
        'cancel_confirm' => 'Este pedido será cancelado e o pagamento dele não será aceito. O provedor de pagamento pode não reembolsar imediatamente. Você tem certeza?',
        'cancel_not_allowed' => 'O pedido não pode ser cancelado no momento.',
        'invoice' => 'Ver Fatura',
        'no_orders' => 'Sem pedidos para ver.',
        'paid_on' => 'Ordem colocara :date',
        'resume' => 'Continuar Compra',
        'shipping_and_handling' => 'Envio e Manuseio',
        'shopify_expired' => 'O link de verificação deste pedido expirou.',
        'subtotal' => 'Subtotal',
        'total' => 'Total',

        'details' => [
            'order_number' => 'Pedido #',
            'payment_terms' => 'Condições de pagamento',
            'salesperson' => 'Vendedor(a)',
            'shipping_method' => 'Método de Envio',
            'shipping_terms' => 'Termos de envio',
            'title' => 'Detalhes do pedido',
        ],

        'item' => [
            'quantity' => 'Quantidade',

            'display_name' => [
                'supporter_tag' => ':name para :username (:duration)',
            ],

            'subtext' => [
                'supporter_tag' => 'Mensagem: :message',
            ],
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

        'status' => [
            'cancelled' => 'Cancelado',
            'checkout' => 'Preparando',
            'delivered' => 'Entregue',
            'paid' => 'Pago',
            'processing' => 'Aguardando confirmação',
            'shipped' => 'Em Trânsito',
            'title' => 'Status do pedido',
        ],

        'thanks' => [
            'title' => 'Obrigado pela sua compra!',
            'line_1' => [
                '_' => 'Você receberá um e-mail de confirmação em breve. Se você tiver alguma dúvida, por favor, :link!',
                'link_text' => 'fale conosco',
            ],
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
        'out_of_stock' => '',

        'notification_success' => 'você será notificado quando tivermos o produto em estoque. clique :link para cancelar',
        'notification_remove_text' => 'aqui',

        'notification_in_stock' => 'Este produto já está no estoque!',
    ],

    'supporter_tag' => [
        'gift' => 'dar de presente',
        'gift_message' => 'adicione uma mensagem opcional ao seu presente! (até :length caracteres)',

        'require_login' => [
            '_' => 'Você precisa estar :link para conseguir uma osu!supporter tag!',
            'link_text' => 'conectado',
        ],
    ],

    'username_change' => [
        'check' => 'Insira um nome de usuário para verificar a disponibilidade!',
        'checking' => 'Checando disponibilidade de :username...',
        'placeholder' => 'Nome de usuário solicitado',
        'label' => 'Novo nome de usuário',
        'current' => 'Seu nome de usuário atual é ":username".',

        'require_login' => [
            '_' => 'Você precisa estar :link para mudar o seu nome!',
            'link_text' => 'conectado',
        ],
    ],

    'xsolla' => [
        'distributor' => '',
    ],
];
