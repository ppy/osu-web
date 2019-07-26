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
    'error' => [
        'chat' => [
            'empty' => 'Não é possível enviar uma mensagem em branco.',
            'limit_exceeded' => 'Estás a enviar mensagens demasiado depressa, por favor espera um pouco antes de tentares novamente.',
            'too_long' => 'A mensagem que estás a tentar enviar é demasiado longa.',
        ],
    ],

    'scopes' => [
        'identify' => 'Identificar-te e ler o teu perfil público.',

        'friends' => [
            'read' => 'Ver quem estás a seguir.',
        ],
    ],
];
