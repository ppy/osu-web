<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'load_failed' => 'Falha ao carregar os dados.',
    'missing_route' => 'URL inválida ou método de requisição incorreto.',
    'no_restricted_access' => 'Você não pode executar esta ação enquanto sua conta estiver restrita.',
    'param_too_large' => 'O parâmetro :name tem um máximo de :count_delimited item|O parâmetro :name tem um máximo de :count_delimited itens',
    'supporter_only' => 'Você precisa ser um osu!supporter para usar esta função.',
    'unknown' => 'Ocorreu um erro desconhecido.',

    'codes' => [
        'http-401' => 'Por favor, inicie a sessão para continuar.',
        'http-403' => 'Acesso negado.',
        'http-404' => 'Não encontrado.',
        'http-429' => 'Muitas tentativas. Tente novamente mais tarde.',
    ],
    'account' => [
        'profile-order' => [
            'generic' => 'Ocorreu um erro. Tente atualizar a página.',
        ],
    ],
    'checkout' => [
        'generic' => 'Ocorreu um erro durante ao preparar o seu pagamento.',
    ],
    'scores' => [
        'invalid_id' => 'Pontuação ID inválida.',
    ],
    'search' => [
        'default' => 'Não foi possível obter nenhum resultado, tente novamente mais tarde.',
        'invalid_cursor_exception' => 'Parâmetro do cursor inválido.',
        'operation_timeout_exception' => 'A busca está mais ocupada que o normal, tente novamente mais tarde.',
    ],
    'user_report' => [
        'recently_reported' => "Você já informou isso recentemente.",
    ],
];
