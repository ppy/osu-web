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
        'header' => [
            'subtitle' => 'Uma lista de torneios ativos e oficialmente reconhecidos',
            'title' => 'Torneios da Comunidade',
        ],
        'none_running' => 'Não há nenhum torneio acontecendo no momento, volte mais tarde!',
        'registration_period' => 'Período de inscrições: :start até :end',
    ],

    'show' => [
        'banner' => 'Apoie seu time',
        'entered' => 'Você se registrou nesse torneio.<br><br>Note que isso não significa que você foi adicionado em um time.<br><br>Intruções adicionais serão enviadas via email mais próximo da data do torneio, então, por favor, certifique-se de que seu entereço de email e conta do osu! são válidos!',
        'info_page' => 'Página de informações',
        'login_to_register' => 'Por favor :login para visualizar os detalhes de inscrição!',
        'not_yet_entered' => 'Você não está registrado nesse torneio.',
        'rank_too_low' => 'Desculpa, você não tem os requisitos mínimos necessários para esse torneio!',
        'registration_ends' => 'Período de inscrição será finalizado em :date',

        'button' => [
            'cancel' => 'Cancelar Inscrição',
            'register' => 'Inscreva-me!',
        ],

        'state' => [
            'before_registration' => 'A inscrição para este torneio ainda não está aberta.',
            'ended' => 'Este torneio foi concluído. Para ver o resultado, verifique a página de informações.',
            'registration_closed' => 'As inscrições para o torneio foram fechadas. Verifique a página de informações para atualizações mais recentes.',
            'running' => 'Esse torneio está atualmente em progresso. Verifique a página de informações para mais detalhes.',
        ],
    ],
    'tournament_period' => ':start até :end',
];
