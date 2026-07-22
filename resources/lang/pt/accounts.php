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
            'rules' => 'Certifique‑se de que o avatar cumpre :link.<br/>Isto significa que deve ser <strong>adequado para todas as idades</strong>, i.e., sem nudez, conteúdo ofensivo ou sugestivo.',
            'rules_link' => 'as regras do conteúdo visual',
        ],

        'email' => [
            'new' => 'novo e-mail',
            'new_confirmation' => 'confirmação do e-mail',
            'title' => 'E-mail',
            'locked' => [
                '_' => 'Por favor, entre em contacto com :accounts caso seja necessária a atualização do endereço de e-mail.',
                'accounts' => 'equipa de suporte de contas',
            ],
        ],

        'legacy_api' => [
            'api' => 'api',
            'irc' => 'irc',
            'title' => 'API antiga',
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
                '_' => "Detetou‑se que o país definido na conta não coincide com o país de residência. :update_link.",
                'update_link' => 'Atualizar para :country',
            ],

            'user' => [
                'user_discord' => '',
                'user_from' => 'localização atual',
                'user_interests' => 'interesses',
                'user_occ' => 'ocupação',
                'user_twitter' => '',
                'user_website' => 'página',
            ],
        ],

        'signature' => [
            'title' => 'Assinatura',
            'update' => 'atualizar',
        ],
    ],

    'github_user' => [
        'info' => "Se for um colaborador dos repositórios de código aberto do osu!, associar a sua conta GitHub aqui permitirá que as suas entradas de mudanças fiquem ligadas ao seu perfil do osu!. Contas GitHub sem histórico de contribuições para o osu! não podem ser associadas.",
        'link' => 'Associar conta do GitHub',
        'title' => 'GitHub',
        'unlink' => 'Desassociar conta do GitHub',

        'error' => [
            'already_linked' => 'Esta conta do GitHub já está associada a um utilizador diferente.',
            'no_contribution' => 'Não é possível associar a conta GitHub sem qualquer histórico de contribuições nos repositórios do osu!.',
            'unverified_email' => 'Por favor, confirme o seu e-mail principal no GitHub e volte a tentar efetuar a associação de conta.',
        ],
    ],

    'notifications' => [
        'beatmapset_discussion_reply' => '',
        'beatmapset_discussion_qualified_problem' => 'receber notificações sobre novos problemas em mapas qualificados dos seguintes modos',
        'beatmapset_disqualify' => 'receber notificações sempre que mapas dos seguintes modos sejam desqualificados',
        'comment_reply' => 'receber notificações quando houver respostas aos seus comentários',
        'news_post' => 'receber notificações quando forem publicadas novidades',
        'title' => 'Notificações',
        'topic_auto_subscribe' => 'ativar automaticamente as notificações em novos tópicos de fórum que tenha criado ou respondido',

        'options' => [
            '_' => 'opções de envio',
            'beatmap_owner_change' => 'dificuldade de convidado',
            'beatmapset:modding' => 'modificações de mapas',
            'channel_mention' => 'menções na conversa',
            'channel_message' => 'mensagens da conversa privada',
            'channel_team' => 'mensagens da conversa da equipa',
            'comment_new' => 'novos comentários',
            'forum_topic_reply' => 'resposta num tópico',
            'mail' => 'correio',
            'mapping' => 'criador de mapas',
            'news_post' => 'publicações de notícias',
            'push' => 'alerta',
        ],

        'tooltips' => [
            'beatmap_owner_change' => 'quando for adicionado como um criador de mapas convidado numa dificuldade de um mapa',
            'beatmapset:modding' => 'quando uma discussão sobre um mapa que está a observar recebe atualizações, ou quando surge um problema ou uma sugestão no seu próprio mapa',
            'channel_mention' => 'quando for mencionado num canal público',
            'channel_message' => 'quando receber uma nova mensagem privada',
            'channel_team' => 'quando o canal de conversa da sua equipa tiver uma nova mensagem',
            'comment_new' => 'quando houver um novo comentário num artigo que está a seguir',
            'forum_topic_reply' => 'quando os tópicos do fórum que está a seguir receberem novas respostas',
            'mapping' => 'quando um criador de mapas que está a seguir enviar um mapa',
            'news_post' => 'quando houver novas publicações de notícias',
        ],
    ],

    'oauth' => [
        'authorized_clients' => 'clientes autorizados',
        'own_clients' => 'os seus clientes',
        'title' => 'OAuth',
    ],

    'options' => [
        'beatmapset_show_anime_cover' => 'mostrar capas de mapas no estilo anime',
        'beatmapset_show_nsfw' => 'ocultar avisos para conteúdo explícito em mapas',
        'beatmapset_title_show_original' => 'mostrar os metadados do mapa no idioma original',
        'title' => 'Opções',

        'beatmapset_download' => [
            '_' => 'tipo de download predefinido do mapa',
            'all' => 'com vídeo, se disponível',
            'direct' => 'abrir no osu!direct',
            'no_video' => 'sem vídeo',
        ],
    ],

    'playstyles' => [
        'default_ruleset' => '',
        'keyboard' => 'teclado',
        'mouse' => 'rato',
        'tablet' => 'tablet',
        'title' => 'Estilos de jogo',
        'touch' => 'toque',
    ],

    'privacy' => [
        'friends_only' => 'bloquear mensagens privadas de pessoas que não estejam na sua lista de amigos',
        'hide_online' => 'ocultar a sua presença online',
        'hide_online_info' => 'corresponde ao modo "aparecer offline" no osu!lazer',
        'title' => 'Privacidade',
    ],

    'security' => [
        'current_session' => 'atual',
        'end_session' => 'Terminar sessão',
        'end_session_confirmation' => 'Isto irá imediatamente terminar a sua sessão nesse dispositivo. Tem a certeza que pretende continuar?',
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
        'title' => 'Autenticador',
        'usage_note' => 'Utilize o autenticador em vez do e-mail. A verificação por e-mail continuará disponível como alternativa.',

        'button' => [
            'remove' => 'Remover',
            'setup' => 'Adicionar autenticador',
        ],
        'status' => [
            'label' => 'estado',
            'not_set' => 'Não configurado',
            'set' => 'Configurado',
        ],
    ],

    'verification_completed' => [
        'text' => 'Poderá agora fechar este(a) separador/janela',
        'title' => 'A verificação foi concluída',
    ],

    'verification_invalid' => [
        'title' => 'Link de verificação inválido ou expirado',
    ],
];
