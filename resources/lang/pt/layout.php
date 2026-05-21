<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'audio' => [
        'autoplay' => 'Reproduzir automaticamente a faixa seguinte',
    ],

    'defaults' => [
        'page_description' => 'osu! — O ritmo está apenas a um *clique* de distância! Com os modos de jogo Ouendan/EBA, Taiko e original, além de um editor de níveis totalmente funcional.',
    ],

    'header' => [
        'admin' => [
            'beatmapset' => 'conjunto de mapas',
            'beatmapset_covers' => 'capas de conjunto de mapas',
            'contest' => 'concurso',
            'contests' => 'concursos',
            'root' => 'terminal',
        ],

        'artists' => [
            'index' => 'listagem',
        ],

        'beatmapsets' => [
            'show' => 'informação',
            'discussions' => 'discussão',
            'versions' => 'histórico de versões',
        ],

        'changelog' => [
            'index' => 'listagem',
        ],

        'help' => [
            'index' => 'índice',
            'sitemap' => 'Mapa da página',
        ],

        'store' => [
            'cart' => 'carrinho',
            'orders' => 'histórico de encomendas',
            'products' => 'produtos',
        ],

        'tournaments' => [
            'index' => 'listagem',
        ],

        'users' => [
            'modding' => 'modificação',
            'playlists' => 'listas de reprodução',
            'ranked-play' => 'partida classificada',
            'realtime' => 'multijogador',
            'show' => 'informação',
        ],
    ],

    'gallery' => [
        'close' => 'Fechar (Esc)',
        'fullscreen' => 'Alternar o modo de ecrã completo',
        'zoom' => 'Aproximar/Afastar',
        'previous' => 'Anterior (seta esquerda)',
        'next' => 'Seguinte (seta direita)',
    ],

    'menu' => [
        'beatmaps' => [
            '_' => 'mapas',
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
            'getSupport' => 'não, a sério, preciso de ajuda!',
        ],
        'home' => [
            '_' => 'início',
            'team' => 'equipa',
        ],
        'rankings' => [
            '_' => 'classificações',
        ],
        'store' => [
            '_' => 'loja',
        ],
    ],

    'footer' => [
        'general' => [
            '_' => 'Geral',
            'home' => 'Início',
            'changelog-index' => 'Registo de alterações',
            'beatmaps' => 'Listagem de mapas',
            'download' => 'Transfira o osu!',
        ],
        'help' => [
            '_' => 'Ajuda e Comunidade',
            'faq' => 'Perguntas frequentes',
            'forum' => 'Fóruns da comunidade',
            'livestreams' => 'Transmissões em direto',
            'report' => 'Comunicar um problema',
            'wiki' => 'Wiki',
        ],
        'legal' => [
            '_' => 'Legalidade e Situação Jurídica',
            'copyright' => 'Direitos de autor (DMCA)',
            'jp_sctl' => '',
            'privacy' => 'Privacidade',
            'rules' => 'Regras',
            'server_status' => 'Estado do servidor',
            'source_code' => 'Código fonte',
            'terms' => 'Termos de serviço',
        ],
    ],

    'errors' => [
        '400' => [
            'error' => 'Parâmetro de pedido inválido',
            'description' => '',
        ],
        '404' => [
            'error' => 'Página em falta',
            'description' => "Lamentamos, mas a página que procurou não se encontra disponível!",
        ],
        '403' => [
            'error' => "Não devia estar aqui.",
            'description' => 'Ainda assim, podia tentar retroceder.',
        ],
        '401' => [
            'error' => "Não devia estar aqui.",
            'description' => 'Ainda assim, podia tentar retroceder. Ou talvez iniciar a sessão.',
        ],
        '405' => [
            'error' => 'Página em falta',
            'description' => "Lamentamos, mas a página que procurou não se encontra disponível!",
        ],
        '422' => [
            'error' => 'Parâmetro de pedido inválido',
            'description' => '',
        ],
        '429' => [
            'error' => 'Limite de taxa excedido',
            'description' => '',
        ],
        '500' => [
            'error' => 'Ó não! Algo avariou! ;_;',
            'description' => "Somos automaticamente notificados de cada erro.",
        ],
        'fatal' => [
            'error' => 'Ó não! Algo avariou (mesmo a sério)! ;_;',
            'description' => "Somos automaticamente notificados de cada erro.",
        ],
        '503' => [
            'error' => 'Em manutenção!',
            'description' => "A manutenção costuma demorar entre 5 segundos e 10 minutos. Se estivermos indisponíveis por mais tempo, consulte :link para mais informações.",
            'link' => [
                'text' => '',
                'href' => '',
            ],
        ],
        // used by sentry if it returns an error
        'reference' => "Só por precaução, aqui está um código que pode fornecer ao suporte!",
    ],

    'popup_login' => [
        'button' => 'iniciar a sessão / registar',

        'login' => [
            'forgot' => "Esqueci‑me dos meus dados",
            'password' => 'palavra-passe',
            'title' => 'Inicie a sessão para proceder',
            'username' => 'nome de utilizador',

            'error' => [
                'email' => "O nome de utilizador ou o endereço de e-mail não existe",
                'password' => 'Palavra‑passe incorreta',
            ],
        ],

        'register' => [
            'download' => 'Transferir',
            'info' => 'Transfira o osu! para criar a sua própria conta!',
            'title' => "Não tem uma conta?",
        ],
    ],

    'popup_user' => [
        'links' => [
            'account-edit' => 'Definições',
            'follows' => 'Listas de observação',
            'friends' => 'Amigos',
            'legacy_score_only_toggle' => 'Modo lazer',
            'legacy_score_only_toggle_tooltip' => 'O modo lazer mostra pontuações definidas a partir do lazer com um novo algoritmo de pontuação',
            'logout' => 'Terminar a sessão',
            'profile' => 'O meu perfil',
            'scoring_mode_toggle' => 'Pontuação clássica',
            'scoring_mode_toggle_tooltip' => 'Ajuste os valores da pontuação para se aproximarem mais da pontuação clássica sem limite',
            'team' => 'A minha equipa',
        ],
    ],

    'popup_search' => [
        'initial' => 'Escreva para pesquisar!',
        'retry' => 'A pesquisa falhou. Clique para tentar novamente.',
    ],
];
