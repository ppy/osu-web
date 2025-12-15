<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'edit' => [
        'title_compact' => 'configurações da conta',
        'username' => 'nome de usuário',

        'avatar' => [
            'title' => 'Avatar',
            'reset' => 'redefinir',
            'rules' => 'Por favor, tenha certeza que seu avatar respeite :link.<br/>Isso significa que deve ser <strong>adequado para todas as idades</strong>, ou seja, sem nudez e sem conteúdo ofensivo ou sugestivo.',
            'rules_link' => 'as Considerações de conteúdo visual',
        ],

        'email' => [
            'new' => 'novo email',
            'new_confirmation' => 'confirmar email',
            'title' => 'Email',
            'locked' => [
                '_' => 'Por favor, contate a :accounts se precisar atualizar o seu email.',
                'accounts' => 'equipe de suporte de contas',
            ],
        ],

        'legacy_api' => [
            'api' => 'api',
            'irc' => 'irc',
            'title' => 'API Legada',
        ],

        'password' => [
            'current' => 'senha atual',
            'new' => 'nova senha',
            'new_confirmation' => 'confirmar senha',
            'title' => 'Senha',
        ],

        'profile' => [
            'country' => 'país',
            'title' => 'Perfil',

            'country_change' => [
                '_' => "Parece que o país da sua conta não corresponde ao país em que você reside atualmente. :update_link.",
                'update_link' => 'Atualizar para :country',
            ],

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

    'github_user' => [
        'info' => "Se você é um contribuidor dos repositórios de código aberto do osu!, vincular sua conta do GitHub aqui associará suas entradas ao registro de alterações com seu perfil do osu!. Contas do GitHub sem histórico de contribuições para o osu! não podem ser vinculadas.",
        'link' => 'Conectar conta do GitHub',
        'title' => 'GitHub',
        'unlink' => 'Desconectar conta do GitHub',

        'error' => [
            'already_linked' => 'Esta conta do GitHub já está vinculada a um usuário diferente.',
            'no_contribution' => 'Não é possível vincular a conta GitHub sem qualquer histórico de contribuição nos repositórios do osu!.',
            'unverified_email' => 'Por favor, verifique seu e-mail principal no GitHub e, após isso, tente vincular sua conta novamente.',
        ],
    ],

    'notifications' => [
        'beatmapset_discussion_qualified_problem' => 'receber notificações para novos problemas em beatmaps qualificados dos seguintes modos',
        'beatmapset_disqualify' => 'receber notificações quando os beatmaps dos seguintes modos forem desqualificados',
        'comment_reply' => 'receber notificações das respostas aos seus comentários',
        'news_post' => '',
        'title' => 'Notificações',
        'topic_auto_subscribe' => 'automaticamente ativar as notificações em tópicos que você criar no fórum',

        'options' => [
            '_' => 'opções de entrega',
            'beatmap_owner_change' => 'dificuldade do convidado',
            'beatmapset:modding' => 'modding em beatmap',
            'channel_message' => 'mensagens privadas',
            'channel_team' => 'mensagens do bate-papo do time',
            'comment_new' => 'novos comentários',
            'forum_topic_reply' => 'resposta em tópico',
            'mail' => 'Caixa de Entrada',
            'mapping' => 'mapper do beatmap',
            'news_post' => '',
            'push' => 'push',
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
        'hide_online_info' => 'isso corresponde ao modo "aparecer offline" no osu!lazer',
        'title' => 'Privacidade',
    ],

    'security' => [
        'current_session' => 'atual',
        'end_session' => 'Finalizar Sessão',
        'end_session_confirmation' => 'Isso vai encerrar imediatamente sua sessão neste dispositivo. Você tem certeza?',
        'last_active' => 'Última atividade:',
        'title' => 'Segurança',
        'web_sessions' => 'sessões web',
    ],

    'update_email' => [
        'update' => 'atualizar',
    ],

    'update_password' => [
        'update' => 'atualizar',
    ],

    'user_totp' => [
        'title' => 'Autenticador',
        'usage_note' => 'Use um app de autenticação no lugar de seu email para verificação. A verificação por email estará disponível como uma segunda opção.',

        'button' => [
            'remove' => 'Remover',
            'setup' => 'Adicionar autenticador',
        ],
        'status' => [
            'label' => 'status',
            'not_set' => 'Não configurado',
            'set' => 'Configurado',
        ],
    ],

    'verification_completed' => [
        'text' => 'Você já pode fechar esta aba/janela',
        'title' => 'A Verificação foi concluída',
    ],

    'verification_invalid' => [
        'title' => 'Link de verificação inválido ou expirado',
    ],
];
