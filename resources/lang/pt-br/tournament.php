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
    'index' => [
        'none_running' => 'Não há nenhum torneio acontecendo no momento, volte mais tarde!',
        'registration_period' => 'Período de inscrições: :start até :end',

        'header' => [
            'subtitle' => 'Uma lista de torneios ativos e oficialmente reconhecidos',
            'title' => 'Torneios da Comunidade',
        ],

        'item' => [
            'registered' => 'Jogadores registrados',
        ],

        'state' => [
            'current' => 'Torneios Ativos',
            'previous' => 'Torneios Passados',
        ],
    ],

    'show' => [
        'banner' => 'Apoie Seu Time',
        'entered' => 'Você se registrou para esse torneio.<br><br>Note que isso não significa que você foi adicionado à um time.<br><br>Intruções adicionais serão enviadas via email próximo à data do torneio, então por favor, certifique-se de que o endereço de email de sua conta osu! é valido!',
        'info_page' => 'Página de informações',
        'login_to_register' => 'Por favor :login para visualizar os detalhes de inscrição!',
        'not_yet_entered' => 'Você não está registrado nesse torneio.',
        'rank_too_low' => 'Desculpa, você não possui os requisitos de ranking necessários para esse torneio!',
        'registration_ends' => 'O período de inscrições será encerrado em :date',

        'button' => [
            'cancel' => 'Cancelar Inscrição',
            'register' => 'Inscreva-me!',
        ],

        'state' => [
            'before_registration' => 'As Inscrições para este torneio ainda não foram abertas.',
            'ended' => 'Este torneio foi concluído. Para ver o resultado, verifique a página de informações.',
            'registration_closed' => 'As inscrições para esse torneio foram encerradas. Verifique a página de informações para atualizações mais recentes.',
            'running' => 'Esse torneio está atualmente em progresso. Verifique a página de informações para mais detalhes.',
        ],
    ],
    'tournament_period' => ':start até :end',
];
