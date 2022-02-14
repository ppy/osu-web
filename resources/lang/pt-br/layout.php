<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'audio' => [
        'autoplay' => 'Reproduzir a próxima faixa automaticamente',
    ],

    'defaults' => [
        'page_description' => 'osu! — O ritmo está a um *clique* de distância! Com Ouendan/EBA, Taiko e modos de jogo originais, além de um editor de níveis totalmente funcional.',
    ],

    'header' => [
        'admin' => [
            'beatmapset' => 'beatmapset',
            'beatmapset_covers' => 'capas de beatmapset',
            'contest' => 'concurso',
            'contests' => 'concursos',
            'root' => 'console',
        ],

        'artists' => [
            'index' => 'listagem',
        ],

        'changelog' => [
            'index' => 'listagem',
        ],

        'help' => [
            'index' => 'índice',
            'sitemap' => 'Mapa do site',
        ],

        'store' => [
            'cart' => 'carrinho',
            'orders' => 'histórico de pedidos',
            'products' => 'produtos',
        ],

        'tournaments' => [
            'index' => 'listagem',
        ],

        'users' => [
            'modding' => 'modding',
            'playlists' => 'seleções de música',
            'realtime' => 'multiplayer',
            'show' => 'info',
        ],
    ],

    'gallery' => [
        'close' => 'Fechar (Esc)',
        'fullscreen' => 'Alternar tela cheia',
        'zoom' => 'Ampliar/Reduzir',
        'previous' => 'Anterior (seta esquerda)',
        'next' => 'Seguinte (seta direita)',
    ],

    'menu' => [
        'beatmaps' => [
            '_' => 'beatmaps',
        ],
        'community' => [
            '_' => 'comunidade',
            'dev' => 'desenvolvimento',
        ],
        'help' => [
            '_' => 'ajuda',
            'getAbuse' => 'denunciar abuso',
            'getFaq' => 'perguntas frequentes',
            'getRules' => 'regras',
            'getSupport' => 'não, sério, preciso de ajuda!',
        ],
        'home' => [
            '_' => 'início',
            'team' => 'equipe',
        ],
        'rankings' => [
            '_' => 'colocações',
            'kudosu' => 'kudosu',
        ],
        'store' => [
            '_' => 'loja',
        ],
    ],

    'footer' => [
        'general' => [
            '_' => 'Geral',
            'home' => 'Início',
            'changelog-index' => 'Registro de Alterações',
            'beatmaps' => 'Lista de Beatmaps',
            'download' => 'Baixar osu!',
        ],
        'help' => [
            '_' => 'Ajuda & Comunidade',
            'faq' => 'Perguntas Frequentes',
            'forum' => 'Fóruns da comunidade',
            'livestreams' => 'Transmissões Ao Vivo',
            'report' => 'Relatar um problema',
            'wiki' => 'Wiki',
        ],
        'legal' => [
            '_' => 'Informações Legais & Estado',
            'copyright' => 'Copyright (DMCA)',
            'privacy' => 'Privacidade',
            'server_status' => 'Estado dos Servidores',
            'source_code' => 'Código-fonte',
            'terms' => 'Termos de Serviço',
        ],
    ],

    'errors' => [
        '400' => [
            'error' => 'Parâmetro de solicitação inválido',
            'description' => '',
        ],
        '404' => [
            'error' => 'Página Não Encontrada',
            'description' => "Lamentamos, mas a página que você procura não está aqui!",
        ],
        '403' => [
            'error' => "Você não deveria estar aqui.",
            'description' => 'Mas você poderia tentar voltar.',
        ],
        '401' => [
            'error' => "Você não deveria estar aqui.",
            'description' => 'Mas você pode tentar voltar. Ou iniciar a sessão.',
        ],
        '405' => [
            'error' => 'Página não encontrada',
            'description' => "Lamentamos, mas a página que você procura não está aqui!",
        ],
        '422' => [
            'error' => 'Parâmetro de solicitação inválido',
            'description' => '',
        ],
        '429' => [
            'error' => 'Limite de taxa excedido',
            'description' => '',
        ],
        '500' => [
            'error' => 'Ah não! Algo quebrou! ;_;',
            'description' => "Nós somos notificados automaticamente de todos os erros.",
        ],
        'fatal' => [
            'error' => 'Ah não! Algo quebrou (bem sério)! ;_;',
            'description' => "Nós somos notificados automaticamente de todos os erros.",
        ],
        '503' => [
            'error' => 'Em manutenção!',
            'description' => "Manutenções geralmente levam de 5 segundos a 10 minutos. Se estivermos fora do ar por mais tempo, acesse :link para mais informações.",
            'link' => [
                'text' => '',
                'href' => '',
            ],
        ],
        // used by sentry if it returns an error
        'reference' => "Se precisar, aqui está um código que você pode dar para o suporte!",
    ],

    'popup_login' => [
        'button' => 'entrar / registrar',

        'login' => [
            'forgot' => "Esqueci as minhas credenciais",
            'password' => 'senha',
            'title' => 'Conecte-se para continuar',
            'username' => 'nome de usuário',

            'error' => [
                'email' => "O nome de usuário ou o endereço de e-mail não existe",
                'password' => 'Senha incorreta',
            ],
        ],

        'register' => [
            'download' => 'Download',
            'info' => 'Baixe o osu! para criar própria conta!',
            'title' => "Não tem uma conta?",
        ],
    ],

    'popup_user' => [
        'links' => [
            'account-edit' => 'Configurações',
            'follows' => 'Observações',
            'friends' => 'Amigos',
            'logout' => 'Desconectar',
            'profile' => 'Meu Perfil',
        ],
    ],

    'popup_search' => [
        'initial' => 'Digite para buscar!',
        'retry' => 'Falha na busca. Clique para tentar novamente.',
    ],
];
