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
        'authorise' => 'Autorizar',
        'request' => 'está a solicitar permissão para aceder à tua conta.',
        'scopes_title' => 'Esta aplicação será capaz de:',
        'title' => 'Pedido de Autorização',

        'wrong_user' => [
            '_' => 'Estás autenticado como :user. :logout_link.',
            'logout_link' => 'Clica aqui para iniciar sessão como um diferente utilizador',
        ],
    ],

    'authorized_clients' => [
        'confirm_revoke' => 'Tens a certeza de que desejas revogar as permissões deste cliente?',
        'scopes_title' => 'Esta aplicação pode:',
        'owned_by' => 'Proprietário de :user',
        'none' => 'Sem Clientes',

        'revoked' => [
            'false' => 'Revogar Acesso',
            'true' => 'Acesso Revogado',
        ],
    ],

    'client' => [
        'id' => 'ID do Cliente',
        'name' => 'Nome da Aplicação',
        'redirect' => 'URL da Rechamada da Aplicação',
        'secret' => 'Segredo do Cliente',
    ],

    'login' => [
        'download' => 'Clica aqui para transferir o jogo e criar uma conta',
        'label' => 'Primeiro, vamos entrar na tua conta!',
        'title' => 'Login da Conta',
    ],

    'new_client' => [
        'header' => 'Registar uma nova aplicação OAuth',
        'register' => 'Aplicação de registo',
        'terms_of_use' => [
            '_' => 'Ao usares a API, estás a aceitar o que está neste :link.',
            'link' => 'Termos de Uso',
        ],
    ],

    'own_clients' => [
        'confirm_delete' => 'Tens a certeza que queres eliminar este cliente?',
        'new' => 'Nova Aplicação OAuth',
        'none' => 'Sem Clientes',

        'revoked' => [
            'false' => 'Eliminar',
            'true' => 'Eliminados',
        ],
    ],
];
