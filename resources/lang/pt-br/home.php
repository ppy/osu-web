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
    'landing' => [
        'download' => 'Baixar agora',
        'online' => '<strong>:players</strong> jogadores online em <strong>:games</strong> partidas',
        'peak' => 'Pico, :count usuários online',
        'players' => '<strong>:count</strong> jogadores registrados',

        'slogan' => [
            'main' => 'jogo de ritmo gratuito',
            'sub' => 'o ritmo está a um clique de distância',
        ],
    ],

    'search' => [
        'advanced_link' => 'Pesquisa avançada',
        'button' => 'Procurar',
        'empty_result' => 'Nada encontrado!',
        'missing_query' => 'Procure por palavras que tenham no mínimo :n caracteres',
        'title' => 'Resultados de busca',

        'beatmapset' => [
            'more' => ':count mais resultados de mapas',
            'more_simple' => 'Veja mais resultados de busca de mapas',
            'title' => 'Mapas',
        ],

        'forum_post' => [
            'all' => 'Todos os fóruns',
            'link' => 'Procurar no fórum',
            'more_simple' => 'Veja mais resultados de busca nos fóruns',
            'title' => 'Fórum',

            'label' => [
                'forum' => 'procurar nos fóruns',
                'forum_children' => 'incluir subfóruns',
                'topic_id' => 'tópico #',
                'username' => 'autor',
            ],
        ],

        'mode' => [
            'all' => 'todos',
            'beatmapset' => 'mapa',
            'forum_post' => 'fórum',
            'user' => 'jogador',
            'wiki_page' => 'wiki',
        ],

        'user' => [
            'more' => ':count mais resultados de busca por usuários',
            'more_simple' => 'Veja mais resultados de busca por usuários',
            'more_hidden' => 'O limite de busca por jogaodr é limitado em :max. Tente aprofundar mais a sua pesquisa.',
            'title' => 'Jogadores',
        ],

        'wiki_page' => [
            'link' => 'Procurar na wiki',
            'more_simple' => 'Veja mais resultados de busca na wiki',
            'title' => 'Wiki',
        ],
    ],

    'download' => [
        'tagline' => 'vamos<br>começar!',
        'action' => 'Baixar osu!',
        'os' => [
            'windows' => 'para Windows',
            'macos' => 'para macOS',
            'linux' => 'para Linux',
        ],
        'mirror' => 'link alternativo',
        'macos-fallback' => 'usuários de macOS',
        'steps' => [
            'register' => [
                'title' => 'crie uma conta',
                'description' => 'siga os comandos quando iniciar o jogo para conectar-se ou criar uma nova conta',
            ],
            'download' => [
                'title' => 'baixar o jogo',
                'description' => 'clique no botão acima para baixar o instalador, depois execute-o!',
            ],
            'beatmaps' => [
                'title' => 'baixar mapas',
                'description' => [
                    '_' => ':browse a vasta coleção de mapas criados por usuários e comece a jogar!',
                    'browse' => 'procure',
                ],
            ],
        ],
        'video-guide' => 'guia em vídeo',
    ],

    'user' => [
        'news' => [
            'title' => 'Notícias',
            'error' => 'Erro ao carregar as notícias, tente atualizar a página?...',
        ],
        'header' => [
            'welcome' => 'Bem-vindo(a), <strong>:username</strong>!',
            'messages' => 'Você tem 1 nova mensagem|Você tem :count novas mensagens',
            'stats' => [
                'friends' => 'Amigos online',
                'games' => 'Jogos',
                'online' => 'Usuários online',
            ],
        ],
        'beatmaps' => [
            'new' => 'Novos mapas aprovados',
            'popular' => 'Mapas populares',
            'by' => 'por',
            'plays' => ':count vezes jogadas',
        ],
        'buttons' => [
            'download' => 'Baixar osu!',
            'support' => 'Apoie o osu!',
            'store' => 'osu!store',
        ],
    ],

    'support-osu' => [
        'title' => 'Nossa!',
        'subtitle' => 'Parece que você está muito bem! :D',
        'body' => [
            'part-1' => 'Você sabia que o osu! não tem nenhum anúncio e depende do apoio dos jogadores para cobrir custos de estabilidade e desenvolvimento?',
            'part-2' => 'Você também sabia que apoiar o osu! te dá um monte de coisas úteis, como <strong>download dentro do jogo</strong> que é automaticamente ativado no modo espectador ou em jogos multiplayers?',
        ],
        'find-out-more' => 'Clique aqui para saber mais!',
        'download-starting' => 'Ah, e não se preocupe - seu download já começou por você ;)',
    ],
];
