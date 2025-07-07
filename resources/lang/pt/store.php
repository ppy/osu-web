<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'cart' => [
        'checkout' => 'Pagamento',
        'empty_cart' => 'Remover todos os artigos do carrinho',
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
                '_' => 'Regressa ao :link para descobrires coisas fixolas!',
                'link_text' => 'catálogo da loja',
            ],
        ],
    ],

    'checkout' => [
        'cart_problems' => 'Oh não, há problemas com o teu carrinho!',
        'cart_problems_edit' => 'Clica aqui para editá-lo.',
        'declined' => 'O pagamento foi cancelado.',
        'delayed_shipping' => 'Estamos de momento sobrecarregados com encomendas! Podes realizar o teu pedido, mas espera aguardar **1 a 2 semanas** enquanto nos pomos a par dos pedidos existentes.',
        'hide_from_activity' => 'Ocultar todas as etiquetas osu!supporter nesta ordem da minha atividade',
        'old_cart' => 'O teu carrinho parece que está fora de prazo e foi atualizado. Tenta outra vez.',
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
    'free' => 'grátis!',

    'invoice' => [
        'contact' => 'Contacto:',
        'date' => 'Data:',
        'echeck_delay' => 'Como o teu pagamento era um eCheck, terás de permitir até 10 dias extra para que o pagamento seja autorizado através do PayPal!',
        'echeck_denied' => 'O pagamento por eCheck foi rejeitado pelo PayPal.',
        'hide_from_activity' => 'As etiquetas osu!supporter nesta ordem não estão visíveis nas tuas atividades recentes.',
        'sent_via' => 'Enviado através de:',
        'shipping_to' => 'Enviar para:',
        'title' => 'Fatura',
        'title_compact' => 'fatura',

        'status' => [
            'cancelled' => [
                'title' => 'A tua encomenda foi cancelada',
                'line_1' => [
                    '_' => "Se não pediste o cancelamento, contacta :link indicando o teu número da encomenda (#:order_number).",
                    'link_text' => 'Apoio da osu!store',
                ],
            ],
            'delivered' => [
                'title' => 'A tua encomenda foi entregue. Esperemos que gostes!',
                'line_1' => [
                    '_' => 'Se tiveres algum problema com a tua compra, contacta :link.',
                    'link_text' => 'Apoio da osu!store',
                ],
            ],
            'prepared' => [
                'title' => 'O teu pedido está a ser preparado!',
                'line_1' => 'Aguarda um pouco mais para que a encomenda seja enviada. A informação de seguimento aparecerá aqui assim que ela for processada e enviada. Isto pode demorar até 5 dias (normalmente menos), dependendo do nosso nível de atividade.',
                'line_2' => 'Enviamos todas as encomendas do Japão utilizando uma variedade de serviços de envio, consoante o peso e o valor. Esta área será atualizada com os detalhes específicos assim que a encomenda for enviada.',
            ],
            'processing' => [
                'title' => 'O teu pagamento ainda não foi confirmado!',
                'line_1' => 'Se já pagaste, ainda poderemos estar à espera de receber a confirmação do teu pagamento. Atualiza esta página dentro de um minuto ou dois!',
                'line_2' => [
                    '_' => 'Se encontraste um problema durante o pagamento, :link',
                    'link_text' => 'clica aqui para resumir o teu pagamento',
                ],
            ],
            'shipped' => [
                'title' => 'O teu pedido foi enviado!',
                'tracking_details' => 'Detalhes do seguimento:',
                'no_tracking_details' => [
                    '_' => "Não temos detalhes de seguimento, pois enviamos a tua embalagem por correio aéreo, mas podes esperar recebê-lo dentro de 1 a 3 semanas. Para a Europa, por vezes a alfândega poderá atrasar a encomenda. Este processo está fora do nosso controlo. Se tiveres alguma dúvida, responde ao email de confirmação da encomenda que recebeste :link.",
                    'link_text' => 'envia-nos um email',
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
        'shipping_and_handling' => 'Expedição e manuseamento',
        'shopify_expired' => 'O link de pagamento para este pedido expirou.',
        'subtotal' => 'Subtotal',
        'total' => 'Total',

        'details' => [
            'order_number' => 'Pedido n.º ',
            'payment_terms' => 'Condições de pagamento',
            'salesperson' => 'Vendedor',
            'shipping_method' => 'Método de envío',
            'shipping_terms' => 'Condições de envio',
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
            'title' => 'Estado do pedido',
        ],

        'thanks' => [
            'title' => 'Obrigado pelo teu pedido!',
            'line_1' => [
                '_' => 'Receberás um email de confirmação em breve. Se tiveres alguma dúvida: :link!',
                'link_text' => 'contacta-nos',
            ],
        ],
    ],

    'product' => [
        'name' => 'Nome',

        'stock' => [
            'out' => 'Este artigo está esgotado atualmente. Volta mais tarde!',
            'out_with_alternative' => 'Infelizmente este artigo está fora de stock. Usa a opção acima para escolher um tipo diferente ou volta mais tarde!',
        ],

        'add_to_cart' => 'Adicionar ao carrinho',
        'notify' => 'Notifica-me quando estiver disponível!',
        'out_of_stock' => '',

        'notification_success' => 'serás notificado quando tivermos um novo stock. clica em :link para cancelar',
        'notification_remove_text' => 'aqui',

        'notification_in_stock' => 'Este produto já está em stock!',
    ],

    'supporter_tag' => [
        'gift' => 'oferecer ao jogador',
        'gift_message' => 'junta uma mensagem opcional ao teu presente! (até :length caracteres)',

        'require_login' => [
            '_' => 'Precisas de ter :link para obter uma etiqueta osu!supporter!',
            'link_text' => 'sessão iniciada',
        ],
    ],

    'username_change' => [
        'check' => 'Introduz um nome de utilizador para confirmar disponibilidade!',
        'checking' => 'A confirmar disponibilidade de :username...',
        'placeholder' => 'Nome de utilizador solicitado',
        'label' => 'Novo nome de utilizador',
        'current' => 'O teu nome de utilizador atual: :username.',

        'require_login' => [
            '_' => 'Precisas de ter :link para mudares o teu nome!',
            'link_text' => 'sessão iniciada',
        ],
    ],

    'xsolla' => [
        'distributor' => '',
    ],
];
