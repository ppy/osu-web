<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'edit' => [
        'title_compact' => 'definições',
        'username' => 'nome de utilizador',

        'avatar' => [
            'title' => 'Avatar',
            'rules' => 'Por favor assegura-te de que o teu avatar respeita :link.<br/>Isto significa que deve ser <strong>adequado para todas as idades</strong>, ou seja, sem nudez, profanidade ou conteúdo sugestivo.',
            'rules_link' => 'as regras da comunidade',
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
        'beatmapset_discussion_qualified_problem' => 'receber notificações para um novo problema em beatmaps qualificados dos modos seguintes',
        'beatmapset_disqualify' => 'receber notificações para quando os beatmaps dos modos seguintes forem desqualificados',
        'comment_reply' => 'receber notificações para respostas aos teus comentários',
        'title' => 'Notificações',
        'topic_auto_subscribe' => 'ativar automaticamente as notificações em novos tópicos de fórum que tenhas criado',

        'options' => [
            '_' => 'opções de envio',
            'beatmap_owner_change' => '',
            'beatmapset:modding' => 'modificações de beatmaps',
            'channel_message' => 'Mensagens do chat privado',
            'comment_new' => 'Novos comentários ',
            'forum_topic_reply' => 'resposta a um tópico',
            'mail' => 'correio',
            'mapping' => 'mapeador de beatmaps',
            'push' => 'push',
            'user_achievement_unlock' => 'medalha de usuário foi desbloqueada',
        ],
    ],

    'oauth' => [
        'authorized_clients' => 'clientes autorizados',
        'own_clients' => 'os teus clientes',
        'title' => 'OAuth',
    ],

    'options' => [
        'beatmapset_show_nsfw' => 'ocultar avisos para conteúdo explícito em beatmaps',
        'beatmapset_title_show_original' => 'mostrar os metadados do beatmap no idioma original',
        'title' => 'Opções',

        'beatmapset_download' => [
            '_' => 'tipo de download padrão de beatmap',
            'all' => 'com vídeo, se disponível',
            'direct' => 'abrir em osu!direct',
            'no_video' => 'sem vídeo',
        ],
    ],

    'playstyles' => [
        'keyboard' => 'teclado',
        'mouse' => 'rato',
        'tablet' => 'tablet',
        'title' => 'Estilos de jogo',
        'touch' => 'toque',
    ],

    'privacy' => [
        'friends_only' => 'bloquear mensagens privadas de pessoas que não estejam na tua lista de amigos',
        'hide_online' => 'ocultar a tua presença online',
        'title' => 'Privacidade',
    ],

    'security' => [
        'current_session' => 'atual',
        'end_session' => 'Terminar sessão',
        'end_session_confirmation' => 'Isto irá imediatamente terminar a tua sessão nesse dispositivo. Tens a certeza?',
        'last_active' => 'Ativo pela última vez:',
        'title' => 'Segurança',
        'web_sessions' => 'sessões web',
    ],

    'update_email' => [
        'update' => 'atualizar',
    ],

    'update_password' => [
        'update' => 'atualizar',
    ],

    'verification_completed' => [
        'text' => 'Poderás agora fechar este(a) separador/janela',
        'title' => 'A verificação foi concluída',
    ],

    'verification_invalid' => [
        'title' => 'Link de verificação inválido ou expirado',
    ],
];
