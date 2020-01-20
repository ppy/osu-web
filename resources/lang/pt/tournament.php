<?php

/**
 *    Copyright (c) ppy Pty Ltd <contact@ppy.sh>.
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
    'index' => [
        'none_running' => 'Não há torneios a decorrer de momento, por favor volta mais tarde!',
        'registration_period' => 'Inscrição: :start até :end',

        'header' => [
            'title' => 'Torneios da comunidade',
        ],

        'item' => [
            'registered' => 'Jogadores registados',
        ],

        'state' => [
            'current' => 'Torneios ativos',
            'previous' => 'Torneios passados',
        ],
    ],

    'show' => [
        'banner' => 'Apoia a tua equipa',
        'entered' => 'Estás inscrito(a) para este torneio.<br><br>Nota que isto não significa que foste atribuído(a) a uma equipa.<br><br>Instruções adicionais serão enviadas para ti via email próximas à data do torneio, por isso e por favor assegura-te que o endereço de email da tua conta osu! é válida!',
        'info_page' => 'Página de informações',
        'login_to_register' => 'Por favor :login para veres os detalhes da inscrição!',
        'not_yet_entered' => 'Não estás inscrito(a) para este torneio.',
        'rank_too_low' => 'Desculpa, não cumpres os requisitos de classificação para este torneio!',
        'registration_ends' => 'As inscrições fecham em :date',

        'button' => [
            'cancel' => 'Cancelar inscrição',
            'register' => 'Inscreve-me!',
        ],

        'period' => [
            'end' => 'Fim',
            'start' => 'Começar',
        ],

        'state' => [
            'before_registration' => 'A inscrição para este torneio ainda não foi aberta.',
            'ended' => 'Este torneio foi concluído. Consulta a página de informação para ver os resultados.',
            'registration_closed' => 'A inscrição para este torneio fechou. Consulta a página de informação para ver as últimas atualizações.',
            'running' => 'Este torneio está atualmente em progresso. Consulta a página de informação para mais detalhes.',
        ],
    ],
    'tournament_period' => ':start até :end',
];
