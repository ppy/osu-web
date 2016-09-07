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
    'codes' => [
        'http-403' => 'Acesso negado.',
        'http-401' => 'Favor fazer login para continuar.',
    ],
    'account' => [
        'profile-order' => [
            'generic' => 'Um erro ocorreu. Tente atualizar a página.',
        ],
    ],
    'community' => [
        'slack' => [
            'not-eligible' => 'Sua conta não segue os requisitos para um convite do Slack.',
            'slack-error' => 'Um erro ocorreu nos servidores do Slack. Tente novamente em alguns minutos.',
        ],
    ],
    'beatmaps' => [ 
        'standard-converts-only' => 'Apenas o modo OSU! pode ter marcado em outros modos.', 
    ], 
    'logged_out' => 'Você foi deslogado. Faça login e tente novamente.',
    'supporter_only' => 'Você precisa ter uma supporter tag para usar esta função.',
    'no_restricted_access' => 'Você não pode executar esta ação enquanto sua conta estiver em modo restrito.',
    'unknown' => 'Erro desconhecido.',
];
