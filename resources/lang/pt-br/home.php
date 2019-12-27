<?php

/**
 *    Copyright (c) ppy Pty Ltd <contact@ppy.sh>.
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
        'title' => 'bem-vindo(a)',
        'see_more_news' => 'ver mais notícias',

        'slogan' => [
            'main' => 'o melhor jogo de ritmo gratuito',
            'sub' => 'o ritmo está a um clique de distância',
        ],
    ],

    'search' => [
        'advanced_link' => 'Pesquisa avançada',
        'button' => 'Procurar',
        'empty_result' => 'Nada encontrado!',
        'keyword_required' => 'Uma palavra-chave é necessária',
        'placeholder' => 'digite para pesquisar',
        'title' => 'Pesquisar',

        'beatmapset' => [
            'more' => ':count mais resultados de beatmaps',
            'more_simple' => 'Veja mais resultados de busca de beatmaps',
            'title' => 'Beatmaps',
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
            'beatmapset' => 'beatmap',
            'forum_post' => 'fórum',
            'user' => 'jogador',
            'wiki_page' => 'wiki',
        ],

        'user' => [
            'more' => ':count mais resultados de busca por usuários',
            'more_simple' => 'Veja mais resultados de busca por usuários',
            'more_hidden' => 'O limite de busca por jogador é limitado em :max. Tente refinar mais a sua pesquisa.',
            'title' => 'Jogadores',
        ],

        'wiki_page' => [
            'link' => 'Procurar na wiki',
            'more_simple' => 'Veja mais resultados de busca na wiki',
            'title' => 'Wiki',
        ],
    ],

    'download' => [
        'tagline' => "vamos<br>começar!",
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
                'description' => 'siga as instruções quando iniciar o jogo para conectar-se ou criar uma nova conta',
            ],
            'download' => [
                'title' => 'baixar o jogo',
                'description' => 'clique no botão acima para baixar o instalador, depois execute-o!',
            ],
            'beatmaps' => [
                'title' => 'baixar beatmaps',
                'description' => [
                    '_' => ':browse pela vasta coleção de beatmaps criados por usuários e comece a jogar!',
                    'browse' => 'navegue',
                ],
            ],
        ],
        'video-guide' => 'guia em vídeo',
    ],

    'user' => [
        'title' => 'dashboard',
        'news' => [
            'title' => 'Notícias',
            'error' => 'Erro ao carregar as notícias, tente atualizar a página?...',
        ],
        'header' => [
            'stats' => [
                'friends' => 'Amigos Online',
                'games' => 'Partidas',
                'online' => 'Usuários Online',
            ],
        ],
        'beatmaps' => [
            'new' => 'Novos beatmaps ranqueados',
            'popular' => 'Beatmaps Populares',
            'by_user' => 'por :user',
        ],
        'buttons' => [
            'download' => 'Baixar osu!',
            'support' => 'Apoie o osu!',
            'store' => 'osu!store',
        ],
    ],

    'support-osu' => [
        'title' => 'Nossa!',
        'subtitle' => 'Parece que você está se divertindo bastante! :D',
        'body' => [
            'part-1' => 'Você sabia que o osu! não tem nenhum anúncio e depende do apoio dos jogadores para cobrir custos de estabilidade e desenvolvimento?',
            'part-2' => 'Você também sabia que apoiar o osu! te dá um monte de coisas úteis, como <strong>download dentro do jogo</strong> que é automaticamente ativado no modo espectador ou em partidas multijogadores?',
        ],
        'find-out-more' => 'Clique aqui para saber mais!',
        'download-starting' => "Ah, e não se preocupe - seu download já começou ;)",
    ],
];
