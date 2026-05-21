<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'header' => [
        'small' => 'Compita de mais maneiras do que apenas clicar em círculos.',
        'large' => 'Concursos da comunidade',
    ],

    'index' => [
        'nav_title' => 'listagem',
    ],

    'judge' => [
        'comments' => 'comentários',
        'hide_judged' => 'esconder inscrições avaliadas',
        'nav_title' => 'avaliar',
        'no_current_vote' => 'ainda não votou.',
        'update' => 'atualizar',
        'validation' => [
            'missing_score' => 'pontuação em falta',
            'contest_vote_judged' => 'não pode votar em concursos apreciados',
        ],
        'voted' => 'Já submetou um voto nesta participação.',
    ],

    'judge_results' => [
        '_' => 'Resultados da apreciação',
        'creator' => 'criador',
        'score' => 'Pontuação',
        'score_std' => 'Pontuação padronizada',
        'total_score' => 'pontuação total',
        'total_score_std' => 'pontuação padronizada total',
    ],

    'voting' => [
        'judge_link' => 'É um dos jurados deste concurso. Avalie as participações aqui!',
        'judged_notice' => 'Este concurso está a utilizar o sistema de avaliação. Os jurados estão atualmente a analisar as participações.',
        'login_required' => 'Inicie a sessão para votar.',
        'over' => 'A votação para este concurso terminou',
        'show_voted_only' => 'Mostrar votados',

        'best_of' => [
            'none_played' => "Parece que não jogou nenhum mapa que se qualifique para este concurso!",
        ],

        'button' => [
            'add' => 'Votar',
            'remove' => 'Remover voto',
            'used_up' => 'Usou todos os seus votos',
        ],

        'progress' => [
            '_' => ':used / :max votos utilizados',
        ],

        'requirement' => [
            'playlist_beatmapsets' => [
                'incomplete_play' => 'Tem de jogar todos os mapas das listas de reprodução especificadas antes de votar',
            ],
        ],
    ],

    'entry' => [
        '_' => 'inscrição',
        'login_required' => 'Inicie a sessão para entrar no concurso.',
        'silenced_or_restricted' => 'Não pode entrar em concursos enquanto estiver restrito ou silenciado.',
        'preparation' => 'Estamos atualmente a preparar este concurso. Por favor, aguarde pacientemente!',
        'drop_here' => 'Largue a sua inscrição aqui',
        'allowed_extensions' => 'os ficheiros :types são aceites',
        'max_size' => 'Tamanho máximo: :limit',
        'required_dimensions' => 'As dimensões devem ser :widthx:height',
        'download' => 'Transferir .osz',
        'wrong_file_type' => 'Apenas os ficheiros :types são aceites para este concurso.',
        'wrong_dimensions' => 'As entradas para este concurso devem ser :widthx:height',
        'too_big' => 'As inscrições para este concurso só podem ser até :limit.',
    ],

    'beatmaps' => [
        'download' => 'Transferir inscrição',
    ],

    'vote' => [
        'list' => 'votos',
        'count' => ':count_delimited voto|:count_delimited votos',
        'points' => ':count_delimited ponto|:count_delimited pontos',
        'points_float' => ':points pontos',
    ],

    'dates' => [
        'ended' => 'Terminou em :date',
        'ended_no_date' => 'Concluído',

        'starts' => [
            '_' => 'Começa em :date',
            'soon' => 'em breve™',
        ],
    ],

    'states' => [
        'entry' => 'Entrada aberta',
        'voting' => 'A votação começou',
        'results' => 'Resultados',
    ],

    'show' => [
        'admin' => [
            'page' => 'Ver informações e participações',
        ],
    ],
];
