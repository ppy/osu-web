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
    'landing' => [
        'download' => 'Descarregar agora',
        'online' => '<strong>:players</strong> actualmente online em <strong>:games</strong> jogos',
        'peak' => 'Pico, :count utilizadores online',
        'players' => '<strong>:count</strong> jogadores registados',

        'slogan' => [
            'main' => 'o melhor grátis-para-ganhar jogo de ritmo',
            'sub' => 'o ritmo está a um clique de distância',
        ],
    ],

    'search' => [
        'advanced_link' => 'Pesquisa avançada',
        'button' => 'Pesquisar',
        'empty_result' => 'Nada encontrado!',
        'missing_query' => 'Uma palavra-chave de pesquisa com um mínimo de :n caracteres é exigida',
        'placeholder' => 'escreve para procurar',
        'title' => 'Procurar',

        'beatmapset' => [
            'more' => 'Há mais :count resultados de pesquisa de beatmap',
            'more_simple' => 'Ver mais resultados de pesquisa de beatmap',
            'title' => 'Beatmaps',
        ],

        'forum_post' => [
            'all' => 'Todos os fóruns',
            'link' => 'Pesquisar o fórum',
            'more_simple' => 'Ver mais resultados de pesquisa de fórum',
            'title' => 'Fórum',

            'label' => [
                'forum' => 'procurar nos fóruns',
                'forum_children' => 'incluir sub-fóruns',
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
            'more' => 'Há mais :count resultados de pesquisa de jogador',
            'more_simple' => 'Ver mais resultados de pesquisa de jogador',
            'more_hidden' => 'A pesquisa de jogador está limitada a :max jogadores. Tenta redefinir a questão de pesquisa.',
            'title' => 'Jogadores',
        ],

        'wiki_page' => [
            'link' => 'Pesquisar na wiki',
            'more_simple' => 'Ver mais resultados de pesquisa da wiki',
            'title' => 'Wiki',
        ],
    ],

    'download' => [
        'tagline' => "vamos pôr-te<br>a começar!",
        'action' => 'Descarrega o osu!',
        'os' => [
            'windows' => 'para Windows',
            'macos' => 'para macOS',
            'linux' => 'para Linux',
        ],
        'mirror' => 'link alternativo',
        'macos-fallback' => 'utilizadores de macOS',
        'steps' => [
            'register' => [
                'title' => 'adquire uma conta',
                'description' => 'segue as indicações ao iniciares o jogo para iniciar sessão ou criar uma nova conta',
            ],
            'download' => [
                'title' => 'descarrega o jogo',
                'description' => 'clica no botão acima para transferir o instalador, e depois abre-o!',
            ],
            'beatmaps' => [
                'title' => 'obtém beatmaps',
                'description' => [
                    '_' => ':browse a biblioteca vasta de beatmaps criados por utilizadores e começa a jogar!',
                    'browse' => 'navegar',
                ],
            ],
        ],
        'video-guide' => 'vídeo de guia',
    ],

    'user' => [
        'title' => 'painel de controlo',
        'news' => [
            'title' => 'Notícias',
            'error' => 'Erro ao carregar notícias, tentar recarregar a página?...',
        ],
        'header' => [
            'welcome' => 'Olá, <strong>:username</strong>!',
            'messages' => 'Tu tens :count nova mensagem|Tu tens :count novas mensagens',
            'stats' => [
                'friends' => 'Amigos Online',
                'games' => 'Jogos',
                'online' => 'Utilizadores Online',
            ],
        ],
        'beatmaps' => [
            'new' => 'Novos Beatmaps Classificados',
            'popular' => 'Beatmaps Populares',
            'by' => 'por',
            'plays' => ':count partidas',
        ],
        'buttons' => [
            'download' => 'Transfere o osu!',
            'support' => 'Apoia o osu!',
            'store' => 'osu!store',
        ],
    ],

    'support-osu' => [
        'title' => 'Uau!',
        'subtitle' => 'Pareces estar a ter um momento agradável! :D',
        'body' => [
            'part-1' => 'Sabias que o osu! corre sem nenhuma publicidade, e que depende de jogadores para apoiar o seu desenvolvimento e custos de execução?',
            'part-2' => 'Também sabias que ao apoiar o osu! recebes um monte de funcionalidades úteis, tal como <strong>downloads dentro do jogo</strong> que acciona automaticamente em jogos de espectador e multijogador?',
        ],
        'find-out-more' => 'Clica aqui para descobrir mais!',
        'download-starting' => "Ah, e não te preocupes - o teu download já foi iniciado para ti ;)",
    ],
];
