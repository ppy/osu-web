<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'cart' => [
        'checkout' => 'Pagamento',
        'empty_cart' => 'Remover todos os artigos do carrinho',
        'info' => ':count_delimited artigo no carrinho ($:subtotal)|:count_delimited artigos no carrinho ($:subtotal)',
        'more_goodies' => 'Quero adicionar mais brindes antes de completar a encomenda',
        'shipping_fees' => 'custos de envio',
        'title' => 'Carrinho de Compras',
        'total' => 'total',

        'errors_no_checkout' => [
            'line_1' => 'Ups, há problemas no seu carrinho que estão a impedir a finalização da compra!',
            'line_2' => 'Remova ou atualize os artigos acima para continuar.',
        ],

        'empty' => [
            'text' => 'O seu carrinho está vazio.',
            'return_link' => [
                '_' => 'Regresse ao :link para descobrir alguns brindes!',
                'link_text' => 'catálogo da loja',
            ],
        ],
    ],

    'checkout' => [
        'cart_problems' => 'Ups, há problemas com o seu carrinho!',
        'cart_problems_edit' => 'Clique aqui para editá-lo.',
        'declined' => 'O pagamento foi cancelado.',
        'delayed_shipping' => 'Estamos atualmente sobrecarregados com encomendas! Pode fazer a sua encomenda, mas deverá contar com um **atraso adicional de 1–2 semanas** enquanto tratamos das encomendas já existentes.',
        'hide_from_activity' => 'Ocultar todas as etiquetas de apoiante do osu! nesta ordem da minha atividade',
        'old_cart' => 'O seu carrinho parece estar desatualizado e foi recarregado. Por favor, tente novamente.',
        'pay' => 'Pagar com o Paypal',
        'title_compact' => 'pagamento',

        'has_pending' => [
            '_' => 'Tem pagamentos incompletos, clique :link para os ver.',
            'link_text' => 'aqui',
        ],

        'pending_checkout' => [
            'line_1' => 'Um pagamento anterior foi iniciado, mas não foi concluído.',
            'line_2' => 'Resuma o seu pagamento ao selecionar um método de pagamento.',
        ],
    ],

    'discount' => 'poupe :percent%',
    'free' => 'grátis!',

    'invoice' => [
        'contact' => 'Contacto:',
        'date' => 'Data:',
        'echeck_delay' => 'Como o seu pagamento foi feito por eCheck, deverá aguardar até 10 dias adicionais para que o pagamento seja processado pelo PayPal!',
        'echeck_denied' => 'O pagamento por eCheck foi rejeitado pelo PayPal.',
        'hide_from_activity' => 'As etiquetas de apoiante do osu! nesta ordem não são apresentadas nas suas atividades recentes.',
        'sent_via' => 'Enviado através de:',
        'shipping_to' => 'Enviar para:',
        'title' => 'Fatura',
        'title_compact' => 'fatura',

        'status' => [
            'cancelled' => [
                'title' => 'A sua encomenda foi cancelada',
                'line_1' => [
                    '_' => "Se não pediu o cancelamento, contacte :link indicando o número da sua encomenda (#:order_number).",
                    'link_text' => 'Apoio da osu!store',
                ],
            ],
            'delivered' => [
                'title' => 'A sua encomenda foi entregue! Esperamos que esteja a gostar!',
                'line_1' => [
                    '_' => 'Se tiver algum problema com a sua compra, contacte o :link.',
                    'link_text' => 'Apoio da osu!store',
                ],
            ],
            'prepared' => [
                'title' => 'A sua encomenda está a ser preparada!',
                'line_1' => 'Por favor, aguarde mais um pouco até que a encomenda seja enviada. As informações de rastreio aparecerão aqui assim que a encomenda for processada e expedida. Isto pode demorar até 5 dias (mas normalmente é menos!), dependendo do nosso volume de vendas/trabalho.',
                'line_2' => 'Enviamos todas as encomendas a partir do Japão, utilizando vários serviços de envio consoante o peso e o valor. Esta área será atualizada com detalhes assim que a encomenda for expedida.',
            ],
            'processing' => [
                'title' => 'O seu pagamento ainda não foi confirmado!',
                'line_1' => 'Se já efetuou o pagamento, poderemos ainda estar a aguardar a confirmação. Por favor, atualize esta página dentro de um ou dois minutos!',
                'line_2' => [
                    '_' => 'Se encontrou um problema durante o pagamento, :link',
                    'link_text' => 'clique aqui para resumir o seu pagamento',
                ],
            ],
            'shipped' => [
                'title' => 'A sua encomenda foi enviada!',
                'tracking_details' => 'Detalhes do seguimento:',
                'no_tracking_details' => [
                    '_' => "Não temos detalhes de rastreio porque enviámos a sua encomenda por Air Mail, mas pode esperar recebê‑la dentro de 1 a 3 semanas. Na Europa, por vezes a alfândega pode atrasar a encomenda, algo que está fora do nosso controlo. Se tiver alguma preocupação, por favor, responda ao e-mail de confirmação da encomenda que recebeu (ou :link).",
                    'link_text' => 'envie-nos um e-mail',
                ],
            ],
        ],
    ],

    'order' => [
        'cancel' => 'Cancelar a encomenda',
        'cancel_confirm' => 'Esta encomenda será cancelada e o pagamento não será aceite. O fornecedor de pagamentos poderá não libertar imediatamente quaisquer fundos reservados. Tem a certeza?',
        'cancel_not_allowed' => 'Esta encomenda não pode ser cancelada agora.',
        'invoice' => 'Ver fatura',
        'no_orders' => 'Sem encomendas para ver.',
        'paid_on' => 'Encomenda realizada a :date',
        'resume' => 'Retomar pagamento',
        'shipping_and_handling' => 'Expedição e manuseamento',
        'shopify_expired' => 'O link de pagamento para esta encomenda expirou.',
        'subtotal' => 'Subtotal',
        'total' => 'Total',

        'details' => [
            'order_number' => 'Encomenda #',
            'payment_terms' => 'Condições de pagamento',
            'salesperson' => 'Vendedor',
            'shipping_method' => 'Método de envio',
            'shipping_terms' => 'Condições de envio',
            'title' => 'Detalhes da encomenda',
        ],

        'item' => [
            'quantity' => 'quantidade',

            'display_name' => [
                'supporter_tag' => ':name para :username (:duration)',
            ],

            'subtext' => [
                'supporter_tag' => 'Mensagem: :message',
            ],
        ],

        'not_modifiable_exception' => [
            'cancelled' => 'Não pode alterar a sua encomenda porque foi cancelada.',
            'checkout' => 'Não pode alterar a sua encomenda enquanto estiver a ser processada.', // checkout and processing should have the same message.
            'default' => 'A sua encomenda não é alterável',
            'delivered' => 'Não pode alterar a sua encomenda porque já foi entregue.',
            'paid' => 'Não pode alterar a sua encomenda porque já foi paga.',
            'processing' => 'Não pode alterar a sua encomenda porque já foi processada.',
            'shipped' => 'Não pode alterar a sua encomenda porque já foi enviada.',
        ],

        'status' => [
            'cancelled' => 'Cancelados',
            'checkout' => 'Em preparação',
            'delivered' => 'Entregues',
            'paid' => 'Pagos',
            'processing' => 'Confirmação pendente',
            'shipped' => 'Em curso',
            'title' => 'Estado da encomenda',
        ],

        'thanks' => [
            'title' => 'Obrigado pela sua encomenda!',
            'line_1' => [
                '_' => 'Irá receber um e-mail de confirmação em breve. Se tiver alguma questão, por favor :link!',
                'link_text' => 'contacte-nos',
            ],
        ],
    ],

    'product' => [
        'name' => 'Nome',

        'stock' => [
            'out' => 'Este artigo está esgotado atualmente. Volte mais tarde!',
            'out_with_alternative' => 'Infelizmente este artigo esgotou. Use a opção acima para escolher um tipo diferente ou volte mais tarde!',
        ],

        'add_to_cart' => 'Adicionar ao carrinho',
        'notify' => 'Notifique-me quando estiver disponível!',
        'out_of_stock' => 'Esgotado',

        'notification_success' => 'será notificado quando tivermos novas quantidades. clique em :link para cancelar',
        'notification_remove_text' => 'aqui',

        'notification_in_stock' => 'Este produto já está em stock!',
    ],

    'supporter_tag' => [
        'gift' => 'oferecer ao jogador',
        'gift_message' => 'junte uma mensagem opcional ao seu presente! (até :length caracteres)',

        'require_login' => [
            '_' => 'Precisa de ter :link para obter uma etiqueta de apoiante do osu!',
            'link_text' => 'sessão iniciada',
        ],
    ],

    'username_change' => [
        'check' => 'Introduza um nome de utilizador para confirmar disponibilidade!',
        'checking' => 'A confirmar disponibilidade de :username...',
        'placeholder' => 'Nome de utilizador solicitado',
        'label' => 'Novo nome de utilizador',
        'current' => 'O seu nome de utilizador atual: ":username".',

        'require_login' => [
            '_' => 'Precisa de ter :link para mudar o seu nome!',
            'link_text' => 'sessão iniciada',
        ],
    ],

    'xsolla' => [
        'distributor' => '',
    ],
];
