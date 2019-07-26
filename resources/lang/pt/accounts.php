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
    'edit' => [
        'title' => 'Definições de <strong>Conta</strong>',
        'title_compact' => 'definições',
        'username' => 'nome de utilizador',

        'avatar' => [
            'title' => 'Avatar',
        ],

        'email' => [
            'current' => 'email atual',
            'new' => 'novo email',
            'new_confirmation' => 'confirmação do email',
            'title' => 'Email',
        ],

        'password' => [
            'current' => 'palavra-passe atual',
            'new' => 'nova palavra-passe',
            'new_confirmation' => 'confirmação da palavra-passe',
            'title' => 'Palavra-passe',
        ],

        'profile' => [
            'title' => 'Perfil',

            'user' => [
                'user_from' => 'localização atual',
                'user_interests' => 'interesses',
                'user_msnm' => '',
                'user_occ' => 'ocupação',
                'user_twitter' => '',
                'user_website' => 'website',
                'user_discord' => '',
            ],
        ],

        'signature' => [
            'title' => 'Assinatura',
            'update' => 'atualizar',
        ],
    ],

    'oauth' => [
        'title' => '',
        'authorized_clients' => '',
    ],

    'update_email' => [
        'email_subject' => 'Confirmação da alteração de email do osu!',
        'update' => 'atualizar',
    ],

    'update_password' => [
        'email_subject' => 'Confirmação da alteração da palavra-passe do osu!',
        'update' => 'atualizar',
    ],

    'playstyles' => [
        'title' => 'Estilos de jogo',
        'mouse' => 'rato',
        'keyboard' => 'teclado',
        'tablet' => 'tablet',
        'touch' => 'toque',
    ],

    'privacy' => [
        'title' => 'Privacidade',
        'friends_only' => 'bloquear mensagens privadas de pessoas que não estejam na tua lista de amigos',
        'hide_online' => 'ocultar a tua presença online',
    ],

    'notifications' => [
        'title' => 'Notificações',
        'topic_auto_subscribe' => 'ativar automaticamente as notificações em novos tópicos de fórum que tenhas criado',
    ],

    'security' => [
        'current_session' => 'atual',
        'end_session' => 'Terminar Sessão',
        'end_session_confirmation' => 'Isto irá imediatamente terminar a tua sessão nesse dispositivo. Tens a certeza?',
        'last_active' => 'Ativo pela última vez:',
        'title' => 'Segurança',
        'web_sessions' => 'sessões web',
    ],
];
