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
        'title_compact' => 'configurações de conta',
        'username' => 'nome de usuário',

        'avatar' => [
            'title' => 'Avatar',
            'rules' => 'Por favor tenha certeza que seu avatar respeite :link.<br/>Isso significa que deve ser <strong>adequado para todas as idades</strong>. ou seja, sem nudez, palavrões ou conteúdo sugestivo.',
            'rules_link' => 'as regras da comunidade',
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
                'user_discord' => 'discord',
                'user_from' => 'localização atual',
                'user_interests' => 'interesses',
                'user_msnm' => 'skype',
                'user_occ' => 'ocupação',
                'user_twitter' => 'twitter',
                'user_website' => 'website',
            ],
        ],

        'signature' => [
            'title' => 'Assinatura',
            'update' => 'atualizar',
        ],
    ],

    'notifications' => [
        'title' => 'Notificações',
        'topic_auto_subscribe' => 'automaticamente ativar as notificações em tópicos que você criar no fórum',
        'beatmapset_discussion_qualified_problem' => 'receber notificações para novos problemas em beatmaps qualificados dos seguintes modos',

        'mail' => [
            '_' => 'receber notificações por email para',
            'beatmapset:modding' => 'modding de beatmap',
            'forum_topic_reply' => 'resposta em tópico',
        ],
    ],

    'oauth' => [
        'authorized_clients' => 'clientes autorizados',
        'own_clients' => 'clientes próprios',
        'title' => 'OAuth',
    ],

    'playstyles' => [
        'keyboard' => 'teclado',
        'mouse' => 'mouse',
        'tablet' => 'mesa digitalizadora',
        'title' => 'Estilos de jogo',
        'touch' => 'touch',
    ],

    'privacy' => [
        'friends_only' => 'Bloquear mensagens de pessoas que não estão na sua lista de amigos',
        'hide_online' => 'esconder sua presença online',
        'title' => 'Privacidade',
    ],

    'security' => [
        'current_session' => 'atual',
        'end_session' => 'Finalizar Sessão',
        'end_session_confirmation' => 'Isso vai encerrar imediatamente sua sessão neste dispositivo. Você tem certeza?',
        'last_active' => 'Última atividade:',
        'title' => 'Segurança',
        'web_sessions' => 'web sessão',
    ],

    'update_email' => [
        'update' => 'atualizar',
    ],

    'update_password' => [
        'update' => 'atualizar',
    ],

    'verification_completed' => [
        'text' => 'Você já pode fechar esta aba/janela',
        'title' => 'A Verificação foi concluída',
    ],

    'verification_invalid' => [
        'title' => 'Link de verificação inválido ou expirado',
    ],
];
