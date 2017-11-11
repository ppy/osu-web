<?php

/**
 *    Copyright 2015-2017 ppy Pty. Ltd.
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
    'defaults' => [
        'page_description' => 'osu! — O ritmo está a um *clique* de distância! Com Ouendan/EBA, Taiko e modos de jogo originais, além de um editor de níveis totalmente funcional.',
    ],

    'menu' => [
        'home' => [
            '_' => 'início',
            'account-edit' => 'configurações',
            'getChangelog' => 'registro de alterações',
            'getDownload' => 'download',
            'getIcons' => 'ícones',
            'getNews' => 'notícias',
            'index' => 'osu!',
            'supportTheGame' => 'apoie o jogo',
            'password-reset-index' => 'redefinir senha',
        ],
        'help' => [
            '_' => 'ajuda',
            'getFaq' => 'perguntas frequentes',
            'getSupport' => 'suporte',
            'getWiki' => 'wiki',
            'wiki-show' => 'wiki',
        ],
        'beatmaps' => [
            '_' => 'beatmaps',
            'show' => 'info',
            'index' => 'lista',
            'artists' => 'artistas em destaque',
            // 'getPacks' => 'pacotes',
            // 'getCharts' => 'gráficos',
        ],
        'beatmapsets' => [
            '_' => 'beatmaps',
            'discussion' => 'modding',
        ],
        'rankings' => [
            '_' => 'colocações',
            'index' => 'desempenho',
            'performance' => 'desempenho',
            'charts' => 'gráficos',
            'country' => 'país',
            'kudosu' => 'kudosu',
        ],
        'community' => [
            '_' => 'comunidade',
            'dev' => 'osu!dev',
            'getForum' => 'fórum',
            'getChat' => 'conversa',
            'getSupport' => 'suporte',
            'getLive' => 'transmissões',
            'contests' => 'concursos',
            'profile' => 'perfil',
            'tournaments' => 'torneios',
            'tournaments-index' => 'torneios',
            'tournaments-show' => 'informações de torneios',
            'forum-topic-watches-index' => 'inscrições de tópico',
            'forum-topics-create' => 'fórum',
            'forum-topics-show' => 'fórum',
            'forum-forums-index' => 'fórum',
            'forum-forums-show' => 'fórum',
        ],
        'multiplayer' => [
            '_' => 'multijogador',
            'show' => 'partida',
        ],
        'error' => [
            '_' => 'erro',
            '404' => 'não encontrado',
            '403' => 'acesso negado',
            '401' => 'não autorizado',
            '405' => 'não encontrado',
            '500' => 'algo quebrou',
            '503' => 'manutenção',
        ],
        'user' => [
            '_' => 'usuário',
            'getLogin' => 'iniciar sessão',
            'disabled' => 'desativado',

            'register' => 'registrar',
            'reset' => 'recuperar',
            'new' => 'novo',

            'messages' => 'Mensagens',
            'settings' => 'Configurações',
            'logout' => 'Finalizar sessão',
            'help' => 'Ajuda',
        ],
        'store' => [
            '_' => 'loja',
            'getListing' => 'catálogo',
            'getCart' => 'carrinho',

            'getCheckout' => 'pagar',
            'getInvoice' => 'fatura',
            'products-show' => 'produto',

            'new' => 'novo',
            'home' => 'início',
            'index' => 'início',
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
            'root' => 'índice',
            'logs-index' => 'registro',
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
            'home' => 'Início',
            'changelog' => 'Registro de alterações',
            'beatmaps' => 'Listas de beatmaps',
            'download' => 'Baixar osu!',
            'wiki' => 'Wiki',
        ],
        'help' => [
            '_' => 'Ajuda e comunidade',
            'faq' => 'Perguntas frequentes',
            'forum' => 'Fóruns da comunidade',
            'livestreams' => 'Transmissões ao vivo',
            'report' => 'Relatar um problemar',
        ],
        'support' => [
            '_' => 'Apoiar osu!',
            'tags' => 'Supporter Tags',
            'merchandise' => 'Mercadorias',
        ],
        'legal' => [
            '_' => 'Informações legais e estado',
            'copyright' => 'Copyright (DMCA)',
            'osu_status' => '@osustatus',
            'server_status' => 'Estado dos servidores',
            'terms' => 'Termos de Serviço',
        ],
    ],

    'errors' => [
        '404' => [
            'error' => 'Página não encontrada',
            'description' => 'Lamentamos, mas a página que você procura não está aqui!',
            'link' => false,
        ],
        '403' => [
            'error' => 'Você não deveria estar aqui.',
            'description' => 'Mas você poderia tentar voltar.',
            'link' => false,
        ],
        '401' => [
            'error' => 'Você não deveria estar aqui.',
            'description' => 'Mas você pode tentar voltar. Ou iniciar a sessão.',
            'link' => false,
        ],
        '405' => [
            'error' => 'Página não encontrada',
            'description' => 'Lamentamos, mas a página que você procura não está aqui!',
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
            'description' => 'Manutenções geralmente levam de 5 segundos a 10 minutos. Se estivermos fora do ar por mais tempo, acesse :link para mais informações.',
            'link' => [
                'text' => '@osustatus',
                'href' => 'https://twitter.com/osustatus',
            ],
        ],
        // used by sentry if it returns an error
        'reference' => 'Se precisar, aqui está um código que você pode dar para o suporte!',
    ],

    'popup_login' => [
        'login' => [
            'email' => 'endereço de e-mail',
            'forgot' => 'Esqueci as minhas credenciais',
            'password' => 'senha',
            'title' => 'Inicie a sessão para continuar',

            'error' => [
                'email' => 'O nome de usuário ou o endereço de e-mail não existem',
                'password' => 'Senha incorreta',
            ],
        ],

        'register' => [
            'info' => 'Você precisa de uma conta, senhor. Por que você já não tem uma?',
            'title' => 'Não tem uma conta?',
        ],
    ],

    'popup_user' => [
        'links' => [
            'account-edit' => 'Configurações',
            'logout' => 'Finalizar sessão',
            'profile' => 'Perfil',
        ],
    ],

    'popup_search' => [
        'initial' => 'Digite para buscar!',
    ],
];
