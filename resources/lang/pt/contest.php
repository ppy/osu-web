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
        'small' => 'Compete em mais maneiras do que só clicar em círculos.',
        'large' => 'Concursos da Comunidade',
    ],
    'voting' => [
        'over' => 'A votação para este concurso terminou',
        'login_required' => 'Por favor inicia sessão para votar.',
        'best_of' => [
            'none_played' => "Não parece que jogaste nenhuns beatmaps que se qualificam para este concurso!",
        ],
    ],
    'entry' => [
        '_' => 'inscrição',
        'login_required' => 'Por favor inicia sessão para entrar no concurso.',
        'silenced_or_restricted' => 'Não podes entrar em concursos enquanto restrito ou silenciado.',
        'preparation' => 'Actualmente, estamos a preparar este concurso. Por favor espera pacientemente!',
        'over' => 'Obrigado pelas tuas inscrições! As submissões foram fechadas para este concurso e a votação irá abrir em breve.',
        'limit_reached' => 'Chegaste ao limite de inscrições para este concurso',
        'drop_here' => 'Larga a tua inscrição aqui',
        'wrong_type' => [
            'art' => 'Somente ficheiros .jpg e .png são aceites para este concurso.',
            'beatmap' => 'Somente ficheiros .osu são aceites para este concurso.',
            'music' => 'Somente ficheiros .mp3 são aceites para este concurso.',
        ],
        'too_big' => 'As inscrições para este concurso só podem ser até :limit.',
    ],
    'beatmaps' => [
        'download' => 'Transferir Inscrição',
    ],
    'vote' => [
        'list' => 'votos',
        'count' => '1 voto|:count votos',
    ],
    'dates' => [
        'ended' => 'Terminou em :date',

        'starts' => [
            '_' => 'Começa em :date',
            'soon' => 'em breve™',
        ],
    ],
    'states' => [
        'entry' => 'Entrada Aberta',
        'voting' => 'A Votação Começou',
        'results' => 'Resultados',
    ],
];
