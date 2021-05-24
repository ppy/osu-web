<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

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
                'user_discord' => '',
                'user_from' => 'localização atual',
                'user_interests' => 'interesses',
                'user_occ' => 'ocupação',
                'user_twitter' => '',
                'user_website' => 'website',
            ],
        ],

        'signature' => [
            'title' => 'Assinatura',
            'update' => 'atualizar',
        ],
    ],

    'notifications' => [
        'beatmapset_discussion_qualified_problem' => 'receber notificações para novos problemas em beatmaps qualificados dos seguintes modos',
        'beatmapset_disqualify' => 'receber notificações quando os beatmaps dos seguintes modos forem desqualificados',
        'comment_reply' => 'receber notificações das respostas aos seus comentários',
        'title' => 'Notificações',
        'topic_auto_subscribe' => 'automaticamente ativar as notificações em tópicos que você criar no fórum',

        'options' => [
            '_' => 'opções de entrega',
            'beatmap_owner_change' => '',
            'beatmapset:modding' => 'modding em beatmap',
            'channel_message' => 'mensagens privadas',
            'comment_new' => 'novos comentários',
            'forum_topic_reply' => 'resposta em tópico',
            'mail' => 'email',
            'mapping' => 'mapper do beatmap',
            'push' => 'push',
            'user_achievement_unlock' => 'medalha de usuário desbloqueada',
        ],
    ],

    'oauth' => [
        'authorized_clients' => 'clientes autorizados',
        'own_clients' => 'clientes próprios',
        'title' => 'OAuth',
    ],

    'options' => [
        'beatmapset_show_nsfw' => 'ocultar avisos para conteúdo explícito em beatmaps',
        'beatmapset_title_show_original' => 'mostrar metadados do beatmap no idioma original',
        'title' => 'Opções',

        'beatmapset_download' => [
            '_' => 'tipo de download padrão de beatmap',
            'all' => 'com vídeo se disponível',
            'direct' => 'abrir no osu!direct',
            'no_video' => 'sem vídeo',
        ],
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
