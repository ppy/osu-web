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
    'discussion-posts' => [
        'store' => [
            'error' => 'Falha ao salvar publicação',
        ],
    ],

    'discussion-votes' => [
        'update' => [
            'error' => 'Falha ao atualizar votos',
        ],
    ],

    'discussions' => [
        'allow_kudosu' => 'permitir kudosu',
        'delete' => 'excluir',
        'deleted' => 'Excluída por :editor :delete_time',
        'deny_kudosu' => 'recusar kudosu',
        'edit' => 'editar',
        'edited' => 'Última edição por :editor :update_time',
        'message_placeholder' => 'Digite aqui para publicar',
        'message_type_select' => 'Selecione o tipo de comentário',
        'reply_placeholder' => 'Digite a sua resposta aqui',
        'require-login' => 'Por favor, inicie a sessão para publicar ou responder',
        'resolved' => 'Resolvido',
        'restore' => 'recuperar',
        'title' => 'Discussões',

        'collapse' => [
            'all-collapse' => 'Recolher todas',
            'all-expand' => 'Expandir todas',
        ],

        'empty' => [
            'empty' => 'Nenhuma discussão ainda!',
            'hidden' => 'Nenhuma discussão corresponde ao filtro selecionado.',
        ],

        'message_hint' => [
            'in_general' => 'Esta publicação irá para a discussão geral de beatmaps. Para modificar este beatmap, inicie a mensagem com o timestamp (ex: 00:12:345).',
            'in_timeline' => 'Para modificar vários timestamps, publique várias vezes (uma publicação por timestamp).',
        ],

        'message_type' => [
            'praise' => 'Elogio',
            'problem' => 'Problema',
            'suggestion' => 'Sugestão',
        ],

        'mode' => [
            'general' => 'Geral',
            'timeline' => 'Linha do tempo',
        ],

        'new' => [
            'timestamp' => 'Timestamp',
            'timestamp_missing' => 'ctrl-c no modo de edição e cole na sua mensagem para adicionar um timestamp!',
            'title' => 'Nova discussão',
        ],

        'show' => [
            'title' => ':title mapeado por :mapper',
        ],

        'stats' => [
            'deleted' => 'Excluídos',
            'mine' => 'Meus',
            'pending' => 'Pendentes',
            'praises' => 'Elogios',
            'resolved' => 'Resolvidos',
            'total' => 'Total',
        ],
    ],

    'nominations' => [
        'disqualifed-at' => 'desqualificado :time_ago (:reason).',
        'disqualifed_no_reason' => 'nenhuma razão especificada',
        'disqualification-prompt' => 'Motivo da desqualificação?',
        'disqualify' => 'Desqualificar',
        'incorrect-state' => 'Erro ao executar essa ação, tente atualizar a página.',
        'nominate' => 'Nomear',
        'nominate-confirm' => 'Nomear este beatmap?',
        'qualified' => 'Estimado para ser ranqueado em :date, caso nenhum problema for encontrado.',
        'qualified-soon' => 'Estimado para ser ranqueado em breve, caso nenhum problema for encontrado.',
        'required-text' => 'Nomeações: :current/:required',
        'title' => 'Estado da nomeação',
    ],

    'listing' => [
        'search' => [
            'prompt' => 'digite palavras-chave...',
            'options' => 'Mais opções de busca',
            'not-found' => 'sem resultados',
            'not-found-quote' => '... não, nada encontrado.',
        ],
        'mode' => 'Modo',
        'status' => 'Estado de rank',
        'mapped-by' => 'mapeado por :mapper',
        'source' => 'de :source',
        'load-more' => 'Carregar mais...',
    ],
    'beatmapset' => [
        'availability' => [
            'disabled' => 'Este beatmap não está disponível para download.',
            'parts-removed' => 'Partes deste beatmap foram removidas a pedido do criador ou de um detentor de direitos de terceiros.',
            'more-info' => 'Clique aqui para mais informações.',
        ],
        'show' => [
            'discussion' => 'Discussão',

            'details' => [
                'made-by' => 'criado por ',
                'submitted' => 'enviado em ',
                'updated' => 'última atualização em ',
                'ranked' => 'ranqueado em ',
                'approved' => 'aprovado em ',
                'qualified' => 'qualificado em ',
                'loved' => 'amado em ',
                'logged-out' => 'Você precisa iniciar a sessão antes de baixar beatmaps!',
                'download' => [
                    '_' => 'baixar',
                    'video' => 'com vídeo',
                    'no-video' => 'sem vídeo',
                    'direct' => 'osu!direct',
                ],
                'favourite' => 'Adicionar aos favoritos',
                'unfavourite' => 'Remover dos favoritos',
            ],
            'stats' => [
                'cs' => 'Tamanho do círculo',
                'cs-mania' => 'Número de teclas',
                'drain' => 'Dreno de HP',
                'accuracy' => 'Precisão',
                'ar' => 'Taxa de aproximação',
                'stars' => 'Estrelas de dificuldade',
                'total_length' => 'Comprimento',
                'bpm' => 'BPM',
                'count_circles' => 'Quantidade de círculos',
                'count_sliders' => 'Quantidade de sliders',
                'user-rating' => 'Avaliação de usuários',
                'rating-spread' => 'Gráfico de avaliações',
            ],
            'info' => [
                'success-rate' => 'Taxa de sucesso',
                'points-of-failure' => 'Pontos de falha',

                'description' => 'Descrição',

                'source' => 'Fonte',
                'tags' => 'Marcadores',
            ],
            'scoreboard' => [
                'achieved' => 'alcançado há :when',
                'country' => 'Ranking de país',
                'friend' => 'Ranking de amigos',
                'global' => 'Ranking global',
                'supporter-link' => 'Clique <a href=":link">aqui</a> para ver todas as novas funções às quais você ganha acesso!',
                'supporter-only' => 'Você precisa de uma supporter tag para acessar rankings de amigos e de país!',
                'title' => 'Placar',

                'list' => [
                    'accuracy' => 'Precisão',
                    'player-header' => 'Jogador',
                    'rank-header' => 'Rank',
                    'score' => 'Pontuação',
                ],
                'no-scores' => [
                    'country' => 'Ninguém do seu país fez uma pontuação neste mapa ainda!',
                    'friend' => 'Nenhum dos seus amigos fez uma pontuação neste mapa ainda!',
                    'global' => 'Sem pontuações ainda. Não quer tentar marcar algumas?',
                    'loading' => 'Carregando pontuações...',
                ],
                'score' => [
                    'first' => 'Na liderança',
                    'own' => 'Seu melhor',
                ],
                'stats' => [
                    'accuracy' => 'Precisão',
                    'score' => 'Pontuação',
                ],
            ],
        ],
    ],
    'mode' => [
        'any' => 'Qualquer',
        'osu' => 'osu!',
        'taiko' => 'osu!taiko',
        'fruits' => 'osu!catch',
        'mania' => 'osu!mania',
    ],
    'status' => [
        'any' => 'Qualquer',
        'ranked-approved' => 'Ranqueados e aprovados',
        'approved' => 'Aprovados',
        'loved' => 'Amados',
        'faves' => 'Favoritos',
        'modreqs' => 'Pedidos de mod',
        'pending' => 'Pendentes',
        'graveyard' => 'Cemitério',
        'my-maps' => 'Meus mapas',
    ],
    'genre' => [
        'any' => 'Qualquer',
        'unspecified' => 'Indefinido',
        'video-game' => 'Jogo',
        'anime' => 'Anime',
        'rock' => 'Rock',
        'pop' => 'Pop',
        'other' => 'Outros',
        'novelty' => 'Novelty',
        'hip-hop' => 'Hip Hop',
        'electronic' => 'Eletrônica',
    ],
    'mods' => [
        'NF' => 'No Fail',
        'EZ' => 'Easy Mode',
        'HD' => 'Hidden',
        'HR' => 'Hard Rock',
        'SD' => 'Sudden Death',
        'DT' => 'Double Time',
        'Relax' => 'Relax',
        'HT' => 'Half Time',
        'NC' => 'Nightcore',
        'FL' => 'Flashlight',
        'SO' => 'Spun Out',
        'AP' => 'Auto Pilot',
        'PF' => 'Perfect',
        '4K' => '4K',
        '5K' => '5K',
        '6K' => '6K',
        '7K' => '7K',
        '8K' => '8K',
        'FI' => 'Fade In',
        '9K' => '9K',
        'NM' => 'Sem mods',
    ],
    'language' => [
    'any' => 'Qualquer',
    'english' => 'Inglês',
    'chinese' => 'Chinês',
    'french' => 'Francês',
    'german' => 'Alemão',
    'italian' => 'Italiano',
    'japanese' => 'Japonês',
    'korean' => 'Coreano',
    'spanish' => 'Espanhol',
    'swedish' => 'Sueco',
    'instrumental' => 'Instrumental',
    'other' => 'Outros',
    ],
    'extra' => [
        'video' => 'Possui vídeo',
        'storyboard' => 'Possui storyboard',
    ],
    'rank' => [
        'any' => 'Qualquer',
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
