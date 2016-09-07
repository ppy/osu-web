<?php

/**
 *    Copyright 2015 ppy Pty. Ltd.
 *
 *    This file is part of osu!web. osu!web is distributed in the hopes of
 *    attracting more community contributions to the core ecosystem of osu!
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
    'defaults' => [
        'page_description' => 'osu! - O Ritmo está a um *clique* de distância!  Com Ouendan/EBA, Taiko e outros modos de gameplay, além de um editor de fases.',
    ],

    'menu' => [
        'home' => [
            '_' => 'home',
            'getChangelog' => 'changelog',
            'getDownload' => 'download',
            'getIcons' => 'ícones',
            'index' => 'notícias',
            'supportTheGame' => 'ajude o jogo',
        ],
        'help' => [
            '_' => 'ajuda',
            'getWiki' => 'wiki',
            'getFaq' => 'faq',
            'getSupport' => 'suporte',
        ],
        'beatmaps' => [
            '_' => 'beatmaps',
            'show' => 'info',
            'index' => 'lista',
            'artists' => 'artistas em destaque',
            // 'getPacks' => 'packs',
            // 'getCharts' => 'charts',
        ],
        'beatmapsets' => [
            '_' => 'beatmapsets',
            'discussion' => 'modding',
        ],
        'ranking' => [
            '_' => 'ranking',
            'getOverall' => 'geral',
            'getCountry' => 'país',
            'getCharts' => 'charts',
            'getMapper' => 'mapper',
            'index' => 'geral',
        ],
        'community' => [
            '_' => 'communidade',
            'getForum' => 'fórum',
            'getChat' => 'chat',
            'getSupport' => 'suporte',
            'getLive' => 'ao vivo',
            'getSlack' => 'osu!dev',
            'contests' => 'disputas',
            'profile' => 'perfil',
            'tournaments' => 'torneios',
            'tournaments-index' => 'torneios',
            'tournaments-show' => 'informações de torneios',
            'forum-topics-create' => 'fórum',
            'forum-topics-show' => 'fórum',
            'forum-forums-index' => 'fórum',
            'forum-forums-show' => 'fórum',
        ],
         'multiplayer' => [ 
             '_' => 'multiplayer', 
             'show' => 'partida',
        ],
        'error' => [
            '_' => 'error',
            '404' => 'não encontrado',
            '403' => 'acesso negado',
            '401' => 'não autorizado',
            '405' => 'não encontrado',
            '500' => 'algo quebrou',
            '503' => 'manutenção',
        ],
        'user' => [
            '_' => 'user',
            'getLogin' => 'login',
            'disabled' => 'desativado',

            'register' => 'registrar',
            'reset' => 'recuperar',
            'new' => 'novo',

            'messages' => 'Mensagens',
            'settings' => 'Configurações',
            'logout' => 'Deslogar',
            'help' => 'Ajuda',
        ],
        'store' => [
            '_' => 'loja',
            'getListing' => 'lista',
            'getCart' => 'carrinho',

            'getCheckout' => 'pagar',
            'getInvoice' => 'fatura',
            'getProduct' => 'produto',

            'new' => 'novo',
            'home' => 'home',
            'index' => 'home',
            'thanks' => 'obrigado',
        ],
        'admin-forum' => [
            '_' => 'admin::forum',
            'forum-covers-index' => 'capas de fórum',
        ],
        'admin-store' => [
            '_' => 'admin::store',
            'orders-index' => 'pedidos',
            'orders-show' => 'pedido',
        ],
        'admin' => [
            '_' => 'admin',
            'logs-index' => 'log',
            'beatmapsets' => [
                '_' => 'beatmapsets',
                'covers' => 'capas',
                'show' => 'detalhes',
            ],
        ],
    ],
    
    'footer' => [
        'general' => [
            '_' => 'Geral',
            'home' => 'Home',
            'changelog' => 'Changelog',
            'beatmaps' => 'Listas de beatmaps',
            'download' => 'Download osu!',
            'wiki' => 'Wiki',
        ],
        'help' => [
            '_' => 'Ajuda & Comunidade',
            'faq' => 'FAQ',
            'forum' => 'Forum da comunidade',
            'livestreams' => 'Live Streams',
            'report' => 'Informe um problema',
        ],
        'support' => [
            '_' => 'Support osu!',
            'tags' => 'Supporter Tags',
            'merchandise' => 'Mercadoria',
        ],
        'legal' => [
            '_' => 'Legal & Status',
            'tos' => 'Termos de serviço',
            'copyright' => 'Copyright (DMCA)',
            'serverStatus' => 'Status do servidor',
            'osuStatus' => '@osustatus',
        ],
    ],

    'errors' => [
        '404' => [
            'error' => 'Página não Encontrada',
            'description' => 'Desculpe, mas a página que você procura não está aqui!',
            'link' => false,
        ],
        '403' => [
            'error' => 'Você não deveria estar aqui.',
            'description' => 'Mas você poderia tentar voltar.',
            'link' => false,
        ],
        '401' => [
            'error' => 'Você não deveria estar aqui.',
            'description' => 'Mas você poderia tentar voltar. Ou fazer login.',
            'link' => false,
        ],
        '405' => [
            'error' => 'Página não Encontrada',
            'description' => 'Desculpe, mas a página que você procura não está aqui!',
            'link' => false,
        ],
        '500' => [
            'error' => 'Ah não! Algo quebrou! ;_;',
            'description' => 'Nós somos notificados automaticamente de todos os erros.',
            'link' => false,
        ],
        'fatal' => [
            'error' => 'Ah não! Algo quebrou (bem sério)! ;_;',
            'description' => 'Nós somos notificados automaticamente de todos os erros.',
            'link' => false,
        ],
        '503' => [
            'error' => 'Em manutenção!',
            'description' => 'Manutenções normalmente demoram de 5 segundos a 10 minutos. Se estivermos fora do ar por mais tempo, acesse :link para mais informações.',
            'link' => [
                'text' => '@osustatus',
                'href' => 'https://twitter.com/osustatus',
            ],
        ],
        // used by sentry if it returns an error
        'reference' => 'Se precisar, aqui está um código que você pode dar para o suporte!',
    ],
];

'popup_login' => [
        'login' => [
            'email' => 'endereço de e-mail',
            'forgot' => "Esqueci meus dados",
            'password' => 'senha',
            'title' => 'Entre para continuar',

            'error' => [
                'email' => "Usuario ou endereço de email não existem",
                'password' => 'Senha incorreta',
            ],
        ],

        'register' => [
            'info' => "Você precisa de uma conta, senhor. Por que você não tem uma?",
            'title' => "Não tem uma conta?",
        ],
    ],

    'popup_user' => [
        'links' => [
            'profile' => 'Meu Perfil',
            'logout' => 'Log Out',
        ],
    ],
];
