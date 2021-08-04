<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'audio' => [
        'autoplay' => 'Reproduzir a próxima faixa automaticamente',
    ],

    'defaults' => [
        'page_description' => 'osu! - O ritmo está a um *clique* de distância! Com Ouendan/EBA, Taiko e modos de jogo originais, como também um editor de níveis totalmente funcional.',
    ],

    'header' => [
        'admin' => [
            'beatmapset' => 'conjunto de beatmaps',
            'beatmapset_covers' => 'capas de conjunto de beatmaps',
            'contest' => 'concurso',
            'contests' => 'concursos',
            'root' => 'consola',
            'store_orders' => 'administrador da loja',
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
            'orders' => 'historial de pedidos',
            'products' => 'produtos',
        ],

        'tournaments' => [
            'index' => 'listagem',
        ],

        'users' => [
            'modding' => 'modding',
            'multiplayer' => 'multijogador',
            'show' => 'informação',
        ],
    ],

    'gallery' => [
        'close' => 'Fechar (Esc)',
        'fullscreen' => 'Ativar/Desativar ecrã inteiro',
        'zoom' => 'Aproximar/Afastar',
        'previous' => 'Anterior (seta esquerda)',
        'next' => 'Seguinte (seta direita)',
    ],

    'menu' => [
        'beatmaps' => [
            '_' => 'beatmaps',
            'artists' => 'artistas destacados',
            'index' => 'listagem',
            'packs' => 'pacotes',
        ],
        'community' => [
            '_' => 'comunidade',
            'chat' => 'chat',
            'contests' => 'concursos',
            'dev' => 'desenvolvimento',
            'forum-forums-index' => 'fóruns',
            'getLive' => 'em direto',
            'tournaments' => 'torneios',
        ],
        'help' => [
            '_' => 'ajuda',
            'getAbuse' => 'denunciar abuso',
            'getFaq' => 'perguntas frequentes',
            'getRules' => 'regras',
            'getSupport' => 'a sério, preciso mesmo de ajuda!',
            'getWiki' => 'wiki',
        ],
        'home' => [
            '_' => 'início',
            'changelog-index' => 'lista de mudanças',
            'getDownload' => 'transferir',
            'news-index' => 'notícias',
            'search' => 'pesquisar',
            'team' => 'equipa',
        ],
        'rankings' => [
            '_' => 'classificações',
            'charts' => 'em destaque',
            'country' => 'país',
            'index' => 'desempenho',
            'kudosu' => 'kudosu',
            'multiplayer' => 'multijogador',
            'score' => 'pontuação',
        ],
        'store' => [
            '_' => 'loja',
            'cart-show' => 'carrinho',
            'getListing' => 'listagem',
            'orders-index' => 'histórico de encomendas',
        ],
    ],

    'footer' => [
        'general' => [
            '_' => 'Geral',
            'home' => 'Início',
            'changelog-index' => 'Registo de alterações',
            'beatmaps' => 'Listagem de beatmaps',
            'download' => 'Descarrega o osu!',
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
            'privacy' => 'Privacidade',
            'server_status' => 'Estado do servidor',
            'source_code' => 'Código-fonte',
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
            'description' => "Lamento, mas a página que pediste não está aqui!",
        ],
        '403' => [
            'error' => "Tu não devias estar aqui.",
            'description' => 'Contudo, podias tentar voltar para trás.',
        ],
        '401' => [
            'error' => "Tu não devias estar aqui.",
            'description' => 'Contudo, podias tentar voltar para trás ou talvez iniciares sessão.',
        ],
        '405' => [
            'error' => 'Página em falta',
            'description' => "Lamento, mas a página que pediste não está aqui!",
        ],
        '422' => [
            'error' => 'Parâmetro de pedido inválido',
            'description' => '',
        ],
        '429' => [
            'error' => 'Taxa limite excedida',
            'description' => '',
        ],
        '500' => [
            'error' => 'Oh não! Algo se quebrou! ;_;',
            'description' => "Somos automaticamente notificados de todos os erros.",
        ],
        'fatal' => [
            'error' => 'Oh não! Algo se quebrou (seriamente)! ;_;',
            'description' => "Somos automaticamente notificados de todos os erros.",
        ],
        '503' => [
            'error' => 'Offline para manutenção!',
            'description' => "A manutenção geralmente demora mais ou menos desde 5 segundos até 10 minutos. Se estivermos offline por mais tempo, vê :link para mais informações.",
            'link' => [
                'text' => '',
                'href' => '',
            ],
        ],
        // used by sentry if it returns an error
        'reference' => "Só por acaso, aqui está um código que tu podes dar para ajudar!",
    ],

    'popup_login' => [
        'button' => 'iniciar sessão / registar',

        'login' => [
            'forgot' => "Esqueci-me dos meus detalhes",
            'password' => 'palavra-passe',
            'title' => 'Inicia sessão para procederes',
            'username' => 'nome de utilizador',

            'error' => [
                'email' => "Nome de utilizador ou endereço de email não existente",
                'password' => 'Palavra-passe incorreta',
            ],
        ],

        'register' => [
            'download' => 'Descarregar',
            'info' => 'Transfere o osu! para criar a tua própria conta!',
            'title' => "Não tens uma conta?",
        ],
    ],

    'popup_user' => [
        'links' => [
            'account-edit' => 'Definições',
            'follows' => 'Listas de observação',
            'friends' => 'Amigos',
            'logout' => 'Terminar sessão',
            'profile' => 'O meu perfil',
        ],
    ],

    'popup_search' => [
        'initial' => 'Escreve para pesquisar!',
        'retry' => 'Pesquisa falhada. Clica para tentar outra vez.',
    ],
];
