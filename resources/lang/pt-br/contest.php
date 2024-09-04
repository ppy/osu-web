<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'header' => [
        'small' => 'Compita de outras formas além de clicar em círculos.',
        'large' => 'Concursos da Comunidade',
    ],

    'index' => [
        'nav_title' => 'listagem',
    ],

    'judge' => [
        'comments' => 'comentários',
        'hide_judged' => 'esconder entradas julgadas',
        'nav_title' => 'juiz',
        'no_current_vote' => 'você ainda não votou.',
        'update' => 'atualizar',
        'validation' => [
            'missing_score' => 'pontuação faltando',
            'contest_vote_judged' => 'não é possível votar em concursos já julgados',
        ],
        'voted' => 'Você já enviou um voto nesta entrada.',
    ],

    'judge_results' => [
        '_' => 'Resultado do julgamento',
        'creator' => 'criador',
        'score' => 'Pontuação',
        'total_score' => 'pontuação total',
    ],

    'voting' => [
        'judge_link' => 'Você é um juiz deste concurso. Avalie as entradas aqui!',
        'judged_notice' => 'Este concurso está utilizando o sistema de julgamento, os juízes estão atualmente avaliando as entradas.',
        'login_required' => 'Por favor, conecte-se para votar.',
        'over' => 'A votação deste concurso já foi encerrada',
        'show_voted_only' => 'Mostrar votados',

        'best_of' => [
            'none_played' => "Parece que você não jogou nenhum dos beatmaps qualificados para este concurso!",
        ],

        'button' => [
            'add' => 'Votar',
            'remove' => 'Remover voto',
            'used_up' => 'Você usou todos seus votos',
        ],

        'progress' => [
            '_' => ':used / :max votos usados',
        ],

        'requirement' => [
            'playlist_beatmapsets' => [
                'incomplete_play' => 'É necessário reproduzir todos os beatmaps nas playlists especificadas antes de votar',
            ],
        ],
    ],

    'entry' => [
        '_' => 'inscrição',
        'login_required' => 'Por favor, conecte-se para participar deste concurso.',
        'silenced_or_restricted' => 'Você não pode participar de concursos enquanto restrito ou silenciado.',
        'preparation' => 'Estamos preparando este concurso. Por favor, aguarde pacientemente!',
        'drop_here' => 'Solte a sua inscrição aqui',
        'download' => 'Baixar .osz',

        'wrong_type' => [
            'art' => 'Apenas arquivos .jpg e .png são aceitos para este concurso.',
            'beatmap' => 'Apenas arquivos .osu são aceitos para este concurso.',
            'music' => 'Apenas arquivos .mp3 são aceitos para este concurso.',
        ],

        'wrong_dimensions' => 'Inscrições devem ser :widthx:height',
        'too_big' => 'Inscrições não podem exceder :limit.',
    ],

    'beatmaps' => [
        'download' => 'Baixar Inscrição',
    ],

    'vote' => [
        'list' => 'votos',
        'count' => ':count voto|:count votos',
        'points' => ':count ponto|:count pontos',
    ],

    'dates' => [
        'ended' => 'Encerrada em :date',
        'ended_no_date' => 'Encerrado',

        'starts' => [
            '_' => 'Começa em :date',
            'soon' => 'em breve™',
        ],
    ],

    'states' => [
        'entry' => 'Inscrição Aberta',
        'voting' => 'Votação Iniciada',
        'results' => 'Resultados',
    ],
];
