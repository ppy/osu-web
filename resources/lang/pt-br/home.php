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
        'online' => '<strong>:players</strong> jogadores online em <strong>:games</strong> partidas',
        'peak' => 'Pico, :count usuários online',
        'players' => '<strong>:count</strong> jogadores registrados',

        'download' => [
            '_' => 'Baixe agora',
            'soon' => 'osu! para outros sistemas operacionais virá em breve',
            'for' => 'para :os',
            'other' => 'clique aqui para :os1 ou :os2',
        ],

        'slogan' => [
            'main' => 'simulador de ritmo gratuito',
            'sub' => 'o ritmo está a um clique de distância',
        ],
    ],

    'search' => [
        'advanced_link' => 'Pesquisa Avançada',
        'button' => 'Pesquisar',
        'empty_result' => 'Nada encontrado!',
        'missing_query' => 'Search :n characters is required',
        'title' => 'Resultados da Pesquisa',

        'beatmapset' => [
            'more' => ':count mais resultados de beatmaps',
            'more_simple' => 'Ver mais resultados de beatmaps',
            'title' => 'Beatmaps',
        ],

        'forum_post' => [
            'all' => 'All forums',
            'link' => 'Pesquisar no forum',
            'more_simple' => 'Ver mais resultados do forum',
            'title' => 'Forum',

            'label' => [
                'forum' => 'Pesquisar no forum',
                'forum_children' => 'incluir subforums',
                'username' => 'autor',
            ],
        ],

        'mode' => [
            'all' => 'all',
            'beatmapset' => 'beatmap',
            'forum_post' => 'forum',
            'user' => 'player',
            'wiki_page' => 'wiki',
        ],

        'user' => [
            'more' => ':count more player search results',
            'more_simple' => 'See more player search results',
            'title' => 'Players',
        ],

        'wiki_page' => [
            'link' => 'Search the wiki',
            'more_simple' => 'See more wiki search results',
            'title' => 'Wiki',
        ],
    ],

    'download' => [
      'header' => [
          '1' => "vamos",
          '2' => 'começar.',
          '3' => 'baixe o cliente do osu! para Windows',
      ],
      'steps' => [
          '1' => [
              'name' => 'Passo 1',
              'content' => 'baixe o cliente do osu!',
          ],
          '2' => [
              'name' => 'Passo 2',
              'content' => 'crie uma conta no osu!',
          ],
          '3' => [
              'name' => 'Passo 3',
              'content' => '???',
          ],
      ],
      'more' => 'Quer saber mais?',
      'more_text' => 'Olhe o canal do <a href="https://www.youtube.com/user/osuacademy/">osu!academy no youtube</a> para ver tutoriais atualizados e dicas em como conseguir o melhor possivel do osu!',
    ],

    'user' => [
        'title' => 'notícias',
        'news' => [
            'title' => 'Notícias',
            'error' => 'Erro ao carregar notícias, tente recarregar a página?...',
        ],
        'header' => [
            'welcome' => 'Olá, <strong>:username</strong>!',
            'messages' => 'Você tem 1 nova mensagem|Você tem :count novas mensagens',
            'stats' => [
				'games' => 'Partidas',
                'online' => 'Usuários online',
            ],
        ],
        'beatmaps' => [
            'new' => 'Novos beatmaps aprovados',
            'popular' => 'Beatmaps populares',
            'by' => 'por',
            'plays' => ':count partidas',
        ],
        'buttons' => [
            'download' => 'Baixar osu!',
            'support' => 'Apoiar osu!',
            'store' => 'osu!store',
        ],
    ],
];
