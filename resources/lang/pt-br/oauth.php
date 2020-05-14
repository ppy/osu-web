<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'cancel' => 'Cancelar',

    'authorise' => [
        'request' => 'está pedindo permissão para acessar sua conta.',
        'scopes_title' => 'Essa aplicação será capaz de:',
        'title' => 'Pedido de Autorização',
    ],

    'authorized_clients' => [
        'confirm_revoke' => 'Tem certeza que deseja revogar as permissões deste cliente?',
        'scopes_title' => 'A aplicação pode:',
        'owned_by' => 'Possuído por :user',
        'none' => 'Sem Clientes',

        'revoked' => [
            'false' => 'Revogar Acesso',
            'true' => 'Acesso Revogado',
        ],
    ],

    'client' => [
        'id' => 'ID do Cliente',
        'name' => 'Nome da Aplicação',
        'redirect' => 'URL de Callback da Aplicação',
        'reset' => 'Redefinir segredo do cliente',
        'reset_failed' => 'Falha ao redefinir segredo do cliente',
        'secret' => 'Segredo do Cliente',

        'secret_visible' => [
            'false' => 'Mostrar segredo do cliente',
            'true' => 'Ocultar segredo do cliente',
        ],
    ],

    'new_client' => [
        'header' => 'Registrar uma nova aplicação OAuth',
        'register' => 'Registrar aplicação',
        'terms_of_use' => [
            '_' => 'Ao utilizar a API você concorda com os :link.',
            'link' => 'Termos de Uso',
        ],
    ],

    'own_clients' => [
        'confirm_delete' => 'Realmente deseja deletar esse cliente?',
        'confirm_reset' => 'Tem certeza que deseja redefinir o segredo do cliente? Isso irá revogar todos os tokens existentes.',
        'new' => 'Nova Aplicação OAuth',
        'none' => 'Sem Clientes',

        'revoked' => [
            'false' => 'Excluir',
            'true' => 'Excluído',
        ],
    ],
];
