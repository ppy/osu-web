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
            'empty' => 'Não é possível enviar mensagens em branco.',
            'limit_exceeded' => 'Você está enviando mensagens muito rapidamente, espere um pouco antes de tentar novamente.',
            'too_long' => 'A mensagem que você está tentando enviar é longa demais.',
        ],
    ],

    'scopes' => [
        'identify' => 'Identificar você e ler seu perfil público.',

        'friends' => [
            'read' => 'Veja quem você está seguindo.',
        ],
    ],
];
