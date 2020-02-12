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
        'request' => 'está a solicitar permissão para aceder à tua conta.',
        'scopes_title' => 'Esta aplicação será capaz de:',
        'title' => 'Pedido de autorização',
    ],

    'authorized_clients' => [
        'confirm_revoke' => 'Tens a certeza de que desejas revogar as permissões deste cliente?',
        'scopes_title' => 'Esta aplicação pode:',
        'owned_by' => 'Proprietário de :user',
        'none' => 'Sem clientes',

        'revoked' => [
            'false' => 'Revogar acesso',
            'true' => 'Acesso revogado',
        ],
    ],

    'client' => [
        'id' => 'ID do cliente',
        'name' => 'Nome da aplicação',
        'redirect' => 'URL da recolha da aplicação',
        'secret' => 'Segredo do cliente',
    ],

    'new_client' => [
        'header' => 'Registar uma nova aplicação OAuth',
        'register' => 'Aplicação de registo',
        'terms_of_use' => [
            '_' => 'Ao usares a API, estás a aceitar o que está neste :link.',
            'link' => 'Termos de uso',
        ],
    ],

    'own_clients' => [
        'confirm_delete' => 'Tens a certeza que queres eliminar este cliente?',
        'new' => 'Nova aplicação OAuth',
        'none' => 'Sem clientes',

        'revoked' => [
            'false' => 'Eliminar',
            'true' => 'Eliminados',
        ],
    ],
];
