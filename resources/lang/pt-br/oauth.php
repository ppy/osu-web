<?php

/**
 *    Copyright (c) ppy Pty Ltd <contact@ppy.sh>.
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
        'secret' => 'Client Secret',
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
        'new' => 'Nova Aplicação OAuth',
        'none' => 'Sem Clientes',

        'revoked' => [
            'false' => 'Excluir',
            'true' => 'Excluído',
        ],
    ],
];
