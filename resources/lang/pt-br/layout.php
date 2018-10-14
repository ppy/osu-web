<?php

/**
 *    Copyright 2015-2018 ppy Pty. Ltd.
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
            'friends-index' => 'amigos',
            'changelog-index' => 'registro de alterações',
            'changelog-build' => 'versão',
            'getDownload' => 'baixar',
            'getIcons' => 'ícones',
            'groups-show' => 'grupos',
            'index' => 'dashboard',
            'legal-show' => 'informação',
            'news-index' => 'notícias',
            'news-show' => 'notícias',
            'password-reset-index' => 'redefinir senha',
            'search' => 'busca',
            'supportTheGame' => 'apoie o jogo',
            'team' => 'time',
        ],
        'help' => [
            '_' => 'ajuda',
            'getFaq' => 'perguntas frequentes',
            'getRules' => 'regras',
            'getSupport' => 'não, sério, preciso de ajuda!',
            'getWiki' => 'wiki',
            'wiki-show' => 'wiki',
        ],
        'beatmaps' => [
            '_' => 'beatmaps',
            'artists' => 'artistas em destaque',
            'beatmap_discussion_posts-index' => 'postagens de discussão sobre beatmaps',
            'beatmap_discussions-index' => 'discussões de beatmaps',
            'beatmapset-watches-index' => 'supervisão de modding',
            'beatmapset_discussion_votes-index' => 'votos na discussão de beatmaps',
            'beatmapset_events-index' => 'eventos do beatmap',
            'index' => 'listagem',
            'packs' => 'pacotes',
            'show' => 'informação',
        ],
        'beatmapsets' => [
            '_' => 'beatmaps',
            'discussion' => 'modding',
        ],
        'rankings' => [
            '_' => 'colocações',
            'index' => 'desempenho',
            'performance' => 'desempenho',
            'charts' => 'destaques',
            'score' => 'pontuação',
            'country' => 'país',
            'kudosu' => 'kudosu',
        ],
        'community' => [
            '_' => 'comunidade',
            'dev' => 'desenvolvimento',
            'getForum' => 'fóruns',
            'getChat' => 'chat',
            'getLive' => 'transmissões',
            'contests' => 'concursos',
            'profile' => 'perfil',
            'tournaments' => 'torneios',
            'tournaments-index' => 'torneios',
            'tournaments-show' => 'informações de torneios',
            'forum-topic-watches-index' => 'inscrições de tópico',
            'forum-topics-create' => 'fóruns',
            'forum-topics-show' => 'fóruns',
            'forum-forums-index' => 'fóruns',
            'forum-forums-show' => 'fóruns',
        ],
        'multiplayer' => [
            '_' => 'multiplayer',
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
            'logout' => 'Desconectar',
            'help' => 'Ajuda',
            'modding-history-discussions' => 'discussões de modding',
            'modding-history-events' => 'eventos de modding',
            'modding-history-index' => 'histórico de modding do usuário',
            'modding-history-posts' => 'postagens de modding do usuário',
            'modding-history-votesGiven' => 'votos de modding dados',
            'modding-history-votesReceived' => 'votos de modding recebidos',
        ],
        'store' => [
            '_' => 'loja',
            'checkout-show' => 'comprar',
            'getListing' => 'catálogo',
            'cart-show' => 'carrinho',

            'getCheckout' => 'comprar',
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
            'beatmapsets-covers' => 'capas de beatmap',
            'logs-index' => 'registro',
            'root' => 'índice',

            'beatmapsets' => [
                '_' => 'beatmaps',
                'show' => 'detalhes',
            ],
        ],
    ],

    'footer' => [
        'general' => [
            '_' => 'Geral',
            'home' => 'Início',
            'changelog-index' => 'Registro de Alterações',
            'beatmaps' => 'Lista de Beatmaps',
            'download' => 'Baixar osu!',
            'wiki' => 'Wiki',
        ],
        'help' => [
            '_' => 'Ajuda & Comunidade',
            'faq' => 'Perguntas Frequentes',
            'forum' => 'Fóruns da comunidade',
            'livestreams' => 'Transmissões Ao Vivo',
            'report' => 'Relatar um problema',
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
        '404' => [
            'error' => 'Página não encontrada',
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
                'text' => '@osustatus',
                'href' => 'https://twitter.com/osustatus',
            ],
        ],
        // used by sentry if it returns an error
        'reference' => "Se precisar, aqui está um código que você pode dar para o suporte!",
    ],

    'popup_login' => [
        'login' => [
            'email' => 'endereço de e-mail',
            'forgot' => "Esqueci as minhas credenciais",
            'password' => 'senha',
            'title' => 'Inicie a sessão para continuar',

            'error' => [
                'email' => "O nome de usuário ou o endereço de e-mail não existe",
                'password' => 'Senha incorreta',
            ],
        ],

        'register' => [
            'info' => "Você precisa de uma conta, senhor. Por que você ainda não tem uma?",
            'title' => "Não tem uma conta?",
        ],
    ],

    'popup_user' => [
        'links' => [
            'account-edit' => 'Configurações',
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
