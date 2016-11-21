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
    'header' => [
        'small' => 'Compita de outras formas do que apenas clicar em círculos.',
        'large' => 'Concursos comunitários osu!',
    ],
    'voting' => [
        'over' => 'A votação deste concurso terminou',
    ],
    'entry' => [
        'login_required' => 'Por favor, inicie a sessão para participar deste concurso.',
        'silenced_or_restricted' => 'Você não pode participar de concursos enquanto estiver restrito ou silenciado.',
        'preparation' => 'Estamos atualmente preparando este concurso. Aguarde pacientemente!',
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
        'download' => 'Baixar inscrição',
    ],
    'votes' => '1 voto|:count votos',
    'dates' => [
        'ended' => 'termina :date',

        'starts' => [
            '_' => 'começa :date',
            'soon' => 'em breve™',
        ],
    ],
    'states' => [
        'entry' => 'Entrada aberta',
        'voting' => 'Votação iniciada',
        'results' => 'Resultados',
    ],
];
