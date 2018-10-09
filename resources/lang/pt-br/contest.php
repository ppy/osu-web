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
    'header' => [
        'small' => 'Compita de outras formas além de clicar em círculos.',
        'large' => 'Concursos da Comunidade',
    ],
    'voting' => [
        'over' => 'A votação deste concurso já foi encerrada',
        'login_required' => 'Por favor, conecte-se para votar.',
        'best_of' => [
            'none_played' => "Parece que você não jogou nenhum dos beatmaps qualificados para este concurso!",
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
        'count' => '1 voto|:count votos',
    ],
    'dates' => [
        'ended' => 'Encerrada em :date',

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
