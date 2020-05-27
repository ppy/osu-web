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

    'voting' => [
        'over' => 'A votação deste concurso já foi encerrada',
        'login_required' => 'Por favor, conecte-se para votar.',

        'best_of' => [
            'none_played' => "Parece que você não jogou nenhum dos beatmaps qualificados para este concurso!",
        ],

        'button' => [
            'add' => 'Votar',
            'remove' => 'Remover voto',
            'used_up' => 'Você usou todos seus votos',
        ],
    ],
    'entry' => [
        '_' => 'inscrição',
        'login_required' => 'Por favor, conecte-se para participar deste concurso.',
        'silenced_or_restricted' => 'Você não pode participar de concursos enquanto restrito ou silenciado.',
        'preparation' => 'Estamos preparando este concurso. Por favor, aguarde pacientemente!',
        'over' => 'Agradecemos a sua participação! As inscrições para este concurso foram encerradas e a votação abrirá em breve.',
        'limit_reached' => 'Você atingiu o limite de inscrições para este concurso',
        'drop_here' => 'Solte a sua inscrição aqui',
        'download' => 'Baixar .osz',
        'wrong_type' => [
            'art' => 'Apenas arquivos .jpg e .png são aceitos para este concurso.',
            'beatmap' => 'Apenas arquivos .osu são aceitos para este concurso.',
            'music' => 'Apenas arquivos .mp3 são aceitos para este concurso.',
        ],
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
