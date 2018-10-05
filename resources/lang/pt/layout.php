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
        'page_description' => 'osu! - Ritmo está apenas a um *clique* de distância! Com Ouendan/EBA, Taiko e modos de jogo originais, como também um editor de níveis totalmente funcional.',
    ],

    'menu' => [
        'home' => [
            '_' => 'início',
            'account-edit' => 'definições',
            'friends-index' => 'amigos',
            'changelog-index' => 'lista de mudanças',
            'changelog-build' => 'compilação',
            'getDownload' => 'transferir',
            'getIcons' => 'ícones',
            'groups-show' => 'grupos',
            'index' => 'painel de controlo',
            'legal-show' => 'informação',
            'news-index' => 'notícias',
            'news-show' => 'notícias',
            'password-reset-index' => 'redefinir palavra-passe',
            'search' => 'pesquisar',
            'supportTheGame' => 'suporta o jogo',
            'team' => 'equipa',
        ],
        'help' => [
            '_' => 'ajuda',
            'getFaq' => 'perguntas frequentes',
            'getRules' => 'regras',
            'getSupport' => 'não, a sério, eu preciso de ajuda!',
            'getWiki' => 'wiki',
            'wiki-show' => 'wiki',
        ],
        'beatmaps' => [
            '_' => 'beatmaps',
            'artists' => 'featured artists',
            'beatmap_discussion_posts-index' => 'publicações de discussão de beatmap',
            'beatmap_discussions-index' => 'discussões de beatmap',
            'beatmapset-watches-index' => 'lista de observação de modificações',
            'beatmapset_discussion_votes-index' => 'votos de discussão de beatmap',
            'beatmapset_events-index' => 'eventos de conjunto de beatmaps',
            'index' => 'listagem',
            'packs' => 'pacotes',
            'show' => 'info',
        ],
        'beatmapsets' => [
            '_' => 'beatmaps',
            'discussion' => 'modding',
        ],
        'rankings' => [
            '_' => 'classificações',
            'index' => 'desempenho',
            'performance' => 'desempenho',
            'charts' => 'em destaque',
            'score' => 'pontuação',
            'country' => 'país',
            'kudosu' => 'kudosu',
        ],
        'community' => [
            '_' => 'comunidade',
            'dev' => 'desenvolvimento',
            'getForum' => 'fóruns',
            'getChat' => 'chat',
            'getLive' => 'ao vivo',
            'contests' => 'concursos',
            'profile' => 'perfil',
            'tournaments' => 'torneios',
            'tournaments-index' => 'torneios',
            'tournaments-show' => 'informação do torneio',
            'forum-topic-watches-index' => 'subscrições',
            'forum-topics-create' => 'fóruns',
            'forum-topics-show' => 'fóruns',
            'forum-forums-index' => 'fóruns',
            'forum-forums-show' => 'fóruns',
        ],
        'multiplayer' => [
            '_' => 'multijogador',
            'show' => 'combate',
        ],
        'error' => [
            '_' => 'erro',
            '404' => 'em falta',
            '403' => 'proibido',
            '401' => 'não autorizado',
            '405' => 'em falta',
            '500' => 'algo quebrou',
            '503' => 'manutenção',
        ],
        'user' => [
            '_' => 'utilizador',
            'getLogin' => 'iniciar sessão',
            'disabled' => 'desactivado',

            'register' => 'registar',
            'reset' => 'recuperar',
            'new' => 'novo',

            'messages' => 'Mensagens',
            'settings' => 'Definições',
            'logout' => 'Terminar Sessão',
            'help' => 'Ajuda',
            'modding-history-discussions' => 'discussões de modificações do utilizador',
            'modding-history-events' => 'eventos de modificações do utilizador',
            'modding-history-index' => 'historial de modificações do utilizador',
            'modding-history-posts' => 'publicações de modificações do utilizador',
            'modding-history-votesGiven' => 'votos de modificações do utilizador dados',
            'modding-history-votesReceived' => 'votos de modificações do utilizador recebidos',
        ],
        'store' => [
            '_' => 'loja',
            'checkout-show' => 'pagamento',
            'getListing' => 'listagem',
            'cart-show' => 'carrinho',

            'getCheckout' => 'pagamento',
            'getInvoice' => 'factura',
            'products-show' => 'produto',

            'new' => 'novo',
            'home' => 'início',
            'index' => 'início',
            'thanks' => 'obrigado',
        ],
        'admin-forum' => [
            '_' => '',
            'forum-covers-index' => '',
        ],
        'admin-store' => [
            '_' => '',
            'orders-index' => '',
            'orders-show' => '',
        ],
        'admin' => [
            '_' => '',
            'beatmapsets-covers' => '',
            'logs-index' => '',
            'root' => '',

            'beatmapsets' => [
                '_' => '',
                'show' => '',
            ],
        ],
    ],

    'footer' => [
        'general' => [
            '_' => 'Geral',
            'home' => 'Início',
            'changelog-index' => 'Registo de alterações',
            'beatmaps' => 'Listagem de Beatmaps',
            'download' => 'Descarrega o osu!',
            'wiki' => 'Wiki',
        ],
        'help' => [
            '_' => 'Ajuda & Comunidade',
            'faq' => 'Perguntas Frequentes',
            'forum' => 'Fóruns da Comunidade',
            'livestreams' => 'Transmissões Ao Vivo',
            'report' => 'Comunicar um Problema',
        ],
        'legal' => [
            '_' => 'Legalidade & Situação Jurídica',
            'copyright' => 'Direitos de Autor (DMCA)',
            'privacy' => 'Privacidade',
            'server_status' => 'Estado do Servidor',
            'source_code' => 'Código-Fonte',
            'terms' => 'Termos de Serviço',
        ],
    ],

    'errors' => [
        '404' => [
            'error' => 'Página em Falta',
            'description' => "Lamento, mas a página que pediste não está aqui!",
        ],
        '403' => [
            'error' => "Não devias estar aqui.",
            'description' => 'Contudo, podias tentar voltar atrás.',
        ],
        '401' => [
            'error' => "Não devias estar aqui.",
            'description' => 'Contudo, podias tentar voltar atrás. Ou talvez iniciar sessão.',
        ],
        '405' => [
            'error' => 'Página em Falta',
            'description' => "Lamento, mas a página que pediste não está aqui!",
        ],
        '500' => [
            'error' => 'Oh não! Algo se quebrou! ;_;',
            'description' => "Nós somos automaticamente notificados de todos os erros.",
        ],
        'fatal' => [
            'error' => 'Oh não! Algo se quebrou (seriamente)! ;_;',
            'description' => "Nós somos automaticamente notificados de todos os erros.",
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
        'login' => [
            'email' => 'endereço de email',
            'forgot' => "Esqueci-me dos meus detalhes",
            'password' => 'palavra-passe',
            'title' => 'Inicia Sessão Para Proceder',

            'error' => [
                'email' => "Nome de utilizador ou endereço de email não existente",
                'password' => 'Palavra-passe incorrecta',
            ],
        ],

        'register' => [
            'info' => "Precisa de uma conta, senhor. Porque é que ainda não tem uma?",
            'title' => "Não tens uma conta?",
        ],
    ],

    'popup_user' => [
        'links' => [
            'account-edit' => 'Definições',
            'friends' => 'Amigos',
            'logout' => 'Terminar Sessão',
            'profile' => 'Meu Perfil',
        ],
    ],

    'popup_search' => [
        'initial' => 'Digita para pesquisar!',
        'retry' => 'Pesquisa falhada. Clica para tentar outra vez.',
    ],
];
