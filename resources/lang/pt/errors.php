<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'load_failed' => 'Falha ao carregar os dados.',
    'missing_route' => 'URL inválido ou método de pedido incorreto.',
    'no_restricted_access' => 'Não pode realizar esta ação enquanto a sua conta estiver em estado restrito.',
    'param_too_large' => 'O parâmetro :name tem um máximo de :count_delimited artigo|O parâmetro :name tem um máximo de :count_delimited artigos',
    'supporter_only' => 'Tem de ser um osu!supporter para usar esta funcionalidade.',
    'unknown' => 'Ocorreu um erro desconhecido.',

    'codes' => [
        'http-401' => 'Por favor, inicie a sessão para proceder.',
        'http-403' => 'Acesso negado.',
        'http-404' => 'Não encontrado.',
        'http-429' => 'Demasiadas tentativas. Tente novamente mais tarde.',
    ],
    'account' => [
        'profile-order' => [
            'generic' => 'Ocorreu um erro. Tente recarregar a página.',
        ],
    ],
    'checkout' => [
        'generic' => 'Ocorreu um erro ao preparar o seu pagamento.',
    ],
    'scores' => [
        'invalid_id' => 'ID de pontuação inválida.',
    ],
    'search' => [
        'default' => 'Não foi possível obter resultados, tente novamente mais tarde.',
        'invalid_cursor_exception' => 'Foi especificado um parâmetro de cursor inválido.',
        'operation_timeout_exception' => 'A pesquisa está atualmente mais ocupada do que o habitual, tente novamente mais tarde.',
    ],
    'user_report' => [
        'recently_reported' => "Já reportou isto recentemente.",
    ],
];
