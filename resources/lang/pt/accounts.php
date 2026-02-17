<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'edit' => [
        'title_compact' => 'definições da conta',
        'username' => 'nome de utilizador',

        'avatar' => [
            'title' => 'Avatar',
            'reset' => 'reiniciar',
            'rules' => 'Assegura-te de que o teu avatar respeita :link.<br/>Significa que deve estar<strong>adequado para todas as idades</strong>, ou seja, sem nudez, profanidade ou conteúdo sugestivo.',
            'rules_link' => 'as regras da comunidade',
        ],

        'email' => [
            'new' => 'novo email',
            'new_confirmation' => 'confirmação do email',
            'title' => 'Email',
            'locked' => [
                '_' => 'Entra em contacto com :accounts se precisares de atualizar o teu email.',
                'accounts' => 'equipa de apoio à conta',
            ],
        ],

        'legacy_api' => [
            'api' => 'API',
            'irc' => 'IRC',
            'title' => 'API legada',
        ],

        'password' => [
            'current' => 'palavra-passe atual',
            'new' => 'nova palavra-passe',
            'new_confirmation' => 'confirmação da palavra-passe',
            'title' => 'Palavra-passe',
        ],

        'profile' => [
            'country' => 'país',
            'title' => 'Perfil',

            'country_change' => [
                '_' => "Parece que o país da tua conta não corresponde ao teu país de residência. :update_link",
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
        'info' => "Se fores um contribuidor dos repositórios de fonte aberta do osu!, ao associar a tua conta do GitHub, irá associar os teus acessos ao registo de alterações com o teu perfil no osu! As contas do GitHub sem histórico de contribuições ao osu!, não podem ser vinculadas.",
        'link' => 'Associar conta do GitHub',
        'title' => 'GitHub',
        'unlink' => 'Desassociar conta do GitHub',

        'error' => [
            'already_linked' => 'Esta conta do GitHub já está associada a um utilizador diferente.',
            'no_contribution' => 'Não é possível associar uma conta GitHub sem qualquer histórico de contribuições nos repositórios osu!',
            'unverified_email' => 'Verifica o teu email principal no GitHub e, em seguida, tenta associar a tua conta novamente.',
        ],
    ],

    'notifications' => [
        'beatmapset_discussion_qualified_problem' => 'receber notificações para um novo problema em beatmaps qualificados dos modos seguintes',
        'beatmapset_disqualify' => 'receber notificações para quando os beatmaps dos modos seguintes forem desqualificados',
        'comment_reply' => 'receber notificações para respostas aos teus comentários',
        'news_post' => '',
        'title' => 'Notificações',
        'topic_auto_subscribe' => 'ativar automaticamente as notificações em novos tópicos de fórum que tenhas criado',

        'options' => [
            '_' => 'opções de envio',
            'beatmap_owner_change' => 'dificuldade de convidado',
            'beatmapset:modding' => 'modificações de beatmaps',
            'channel_message' => 'Mensagens do chat privado',
            'channel_team' => 'mensagens da equipa',
            'comment_new' => 'Novos comentários ',
            'forum_topic_reply' => 'resposta a um tópico',
            'mail' => 'correio',
            'mapping' => 'mapeador de beatmaps',
            'news_post' => '',
            'push' => 'push',
        ],
    ],

    'oauth' => [
        'authorized_clients' => 'clientes autorizados',
        'own_clients' => 'os teus clientes',
        'title' => 'OAuth',
    ],

    'options' => [
        'beatmapset_show_anime_cover' => '',
        'beatmapset_show_nsfw' => 'ocultar avisos para conteúdo explícito em beatmaps',
        'beatmapset_title_show_original' => 'mostrar os metadados do beatmap no idioma original',
        'title' => 'Opções',

        'beatmapset_download' => [
            '_' => 'tipo de download predefinido do beatmap',
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
        'hide_online_info' => '',
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

    'user_totp' => [
        'title' => '',
        'usage_note' => '',

        'button' => [
            'remove' => '',
            'setup' => '',
        ],
        'status' => [
            'label' => '',
            'not_set' => '',
            'set' => '',
        ],
    ],

    'verification_completed' => [
        'text' => 'Poderás agora fechar este(a) separador/janela',
        'title' => 'A verificação foi concluída',
    ],

    'verification_invalid' => [
        'title' => 'Link de verificação inválido ou expirado',
    ],
];
