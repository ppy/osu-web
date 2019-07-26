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
        'title' => 'Configurações de <strong>Conta</strong>',
        'title_compact' => 'configurações',
        'username' => 'nome de usuário',

        'avatar' => [
            'title' => 'Avatar',
        ],

        'email' => [
            'current' => 'email atual',
            'new' => 'novo email',
            'new_confirmation' => 'confirmar email',
            'title' => 'Email',
        ],

        'password' => [
            'current' => 'senha atual',
            'new' => 'nova senha',
            'new_confirmation' => 'confirmar senha',
            'title' => 'Senha',
        ],

        'profile' => [
            'title' => 'Perfil',

            'user' => [
                'user_from' => 'localização atual',
                'user_interests' => 'interesses',
                'user_msnm' => 'skype',
                'user_occ' => 'ocupação',
                'user_twitter' => 'twitter',
                'user_website' => 'website',
                'user_discord' => 'discord',
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
        'email_subject' => 'Confirmação de mudança de email do osu!',
        'update' => 'atualizar',
    ],

    'update_password' => [
        'email_subject' => 'Confirmação de mudança de senha do osu!',
        'update' => 'atualizar',
    ],

    'playstyles' => [
        'title' => 'Estilos de jogo',
        'mouse' => 'mouse',
        'keyboard' => 'teclado',
        'tablet' => 'mesa digitalizadora',
        'touch' => 'touch',
    ],

    'privacy' => [
        'title' => 'Privacidade',
        'friends_only' => 'Bloquear mensagens de pessoas que não estão na sua lista de amigos',
        'hide_online' => 'esconder sua presença online',
    ],

    'notifications' => [
        'title' => 'Notificações',
        'topic_auto_subscribe' => 'automaticamente ativar as notificações em tópicos que você criar no fórum',
    ],

    'security' => [
        'current_session' => 'atual',
        'end_session' => 'Finalizar Sessão',
        'end_session_confirmation' => 'Isso vai encerrar imediatamente sua sessão neste dispositivo. Você tem certeza?',
        'last_active' => 'Última atividade:',
        'title' => 'Segurança',
        'web_sessions' => 'web sessão',
    ],
];
