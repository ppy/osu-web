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
    'discussion-posts' => [
        'store' => [
            'error' => 'Salvar post falhou',
        ],
    ],

    'discussion-votes' => [
        'update' => [
            'error' => 'Atualizar votos falhou',
        ],
    ],

    'discussions' => [
        'collapse' => [
            'all-collapse' => 'Comprimir todos',
            'all-expand' => 'Expandir todos',
        ],

        'edit' => 'edit',
        'edited' => 'Editado pela última vez por :editor :update_time',
        'empty' => [
            'empty' => 'Sem discussões aqui por enquanto!',
            'filtered' => 'Nenhuma discussão encontrada com este filtro.',
        ],

        'message_hint' => [
            'in_general' => 'Este post vai para a discussão de geral de beatmaps. Para moddar este beatmap, comece sua mensagem com um timestamp (ex. 00:12:345).',
            'in_timeline' => 'Para moddar vários timestamps, poste várias vezes (um post por timestamp).',
        ],

        'message_placeholder' => 'Digite aqui para postar',

        'message_type' => [
            'praise' => 'Aplaudir',
            'problem' => 'Problema',
            'suggestion' => 'Sugestão',
        ],

        'message_type_select' => 'Escolha Tipo do Comentário',

        'mode' => [
            'general' => 'Geral',
            'timeline' => 'Linha do Tempo',
        ],

        'require-login' => 'Faça login para postar ou responder',
        'resolved' => 'Resolvido',

        'show' => [
            'title' => 'Discussão de Beatmaps',
        ],

        'stats' => [
            'mine' => 'Meu',
            'pending' => 'Pendentes',
            'praises' => 'Aplausos',
            'resolved' => 'Resolvidos',
            'total' => 'Total',
        ],
    ],

    'listing' => [
        'search' => [
            'prompt' => 'digite palavras-chave...',
            'options' => 'Mais Opções de Busca',
            'not-found' => 'sem resultados',
            'not-found-quote' => '... não, nada encontrado.',
        ],
        'mode' => 'Modo',
        'status' => 'Status de Rank',
        'mapped-by' => 'mapeado por :mapper',
        'source' => 'de :source',
        'load-more' => 'Carregar mais...',
    ],
    'beatmapset' => [
        'show' => [
            'details' => [
                'made-by' => 'feito por :user',
                'submitted' => 'publicado em ',
                'ranked' => 'rankeado em ',
                'logged-out' => 'Você precisa fazer login antes de baixar beatmaps!',
                'download' => [
                    'normal' => 'download',
                    'direct' => 'osu!direct',
                    'no-video' => 'versão sem vídeo',
                ],
            ],
            'stats' => [
                'cs' => 'Circle Size',
                'hp' => 'HP Drain',
                'od' => 'Accuracy',
                'ar' => 'Approach Rate',
                'stars' => 'Estrelas de Dificuldade',
                'length' => 'Duração',
                'bpm' => 'BPM',

                'chart' => [
                    'cs' => 'CS',
                    'hp' => 'HP',
                    'od' => 'OD',
                    'ar' => 'AR',
                    'sd' => 'SD',
                ],

                'source' => 'Fonte',
                'tags' => 'Tags',
            ],
            'extra' => [
                'description' => [
                    'title' => 'Descrição',
                ],
                'success-rate' => [
                    'title' => 'Taxa de Sucesso',
                    'rate' => 'Taxa de Sucesso: :percentage%',
                    'points' => 'Pontos de Falha',
                    'retry' => 'Tentar novamente',
                    'fail' => 'Falha',
                ],
                'scoreboard' => [
                    'title' => 'Placar',
                    'no-scores' => [
                        'global' => 'Sem pontuações ainda. Talvez você deveria fazer algumas?',
                        'loading' => 'Carregando pontuações...',
                        'country' => 'Ninguém do seu país fez uma pontuação neste mapa ainda!',
                        'friend' => 'Nenhum dos seus amigos fez uma pontuação neste mapa ainda!',
                    ],
                    'supporter-only' => 'Você precisa de uma supporter tag para acessar rankings de amigos e de país!',
                    'supporter-link' => 'Clique <a href=":link">aqui</a> para ver todas as novas funções às quais você ganha acesso!',
                    'global' => 'Ranking Global',
                    'country' => 'Ranking de País',
                    'friend' => 'Ranking de Amigos',
                    'first' => [
                        'accuracy' => 'Precisão',
                        'score' => 'Pontuação',
                        'count300' => '300',
                        'count100' => '100',
                        'count50' => '50',
                    ],
                    'list' => [
                        'rank-header' => 'Rank',
                        'player-header' => 'Jogador',
                        'score' => 'Pontuação',
                        'accuracy' => 'Precisão',
                    ],
                ],
            ],
        ],
    ],
    'mode' => [
        'any' => 'Todos',
        'osu' => 'osu!',
        'taiko' => 'osu!taiko',
        'fruits' => 'osu!catch',
        'mania' => 'osu!mania',
    ],
    'status' => [
        'any' => 'Todos',
        'ranked-approved' => 'Rankeados & Aprovados',
        'approved' => 'Aprovados',
        'faves' => 'Favoritos',
        'modreqs' => 'Pedidos de Mod',
        'pending' => 'Pendentes',
        'graveyard' => 'Cemitério',
        'my-maps' => 'Meus Mapas',
    ],
    'genre' => [
        'any' => 'Todos',
        'unspecified' => 'Indefinido',
        'video-game' => 'Video Game',
        'anime' => 'Anime',
        'rock' => 'Rock',
        'pop' => 'Pop',
        'other' => 'Outros',
        'novelty' => 'Novelty',
        'hip-hop' => 'Hip Hop',
        'electronic' => 'Eletrônica',
    ],
    'language' => [
    'any' => 'Todos',
    'english' => 'Inglês',
    'chinese' => 'Chinês',
    'french' => 'Francês',
    'german' => 'Alemão',
    'italian' => 'Italiano',
    'japanese' => 'Japonês',
    'korean' => 'Koreano',
    'spanish' => 'Espanhol',
    'swedish' => 'Sueco',
    'instrumental' => 'Instrumental',
    'other' => 'Outros',
    ],
    'extra' => [
        'video' => 'Tem Vídeo',
        'storyboard' => 'Tem Storyboard',
    ],
    'rank' => [
        'any' => 'Todos',
        'XH' => 'SS Prateado',
        'X' => 'SS',
        'SH' => 'S Prateado',
        'S' => 'S',
        'A' => 'A',
        'B' => 'B',
        'C' => 'C',
        'D' => 'D',
    ],
];
