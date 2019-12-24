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
    'box' => [
        'sent' => 'Um email foi enviado para :mail com um código de verificação. Introduz o código.',
        'title' => 'Verificação da conta',
        'verifying' => 'A verificar...',
        'issuing' => 'A emitir o novo código...',

        'info' => [
            'check_spam' => "Assegura-te de que confirmas a pasta de spam se não conseguires encontrar o email.",
            'recover' => "Se não conseguires aceder ao teu email ou esqueceste-te do que usaste, por favor segue o :link.",
            'recover_link' => 'processo de recuperação de email aqui',
            'reissue' => 'Também podes :reissue_link ou :logout_link.',
            'reissue_link' => 'pedir outro código',
            'logout_link' => 'terminar sessão',
        ],
    ],

    'errors' => [
        'expired' => 'O código de verificação está expirado, um novo email de verificação foi enviado.',
        'incorrect_key' => 'Código de verificação incorreto.',
        'retries_exceeded' => 'Código de verificação incorreto. O limite de tentativas foi excedido, um novo email de verificação foi enviado.',
        'reissued' => 'Código de verificação reenviado, um novo email de verificação foi enviado.',
        'unknown' => 'Ocorreu um problema desconhecido, um novo email de verificação foi enviado.',
    ],
];
