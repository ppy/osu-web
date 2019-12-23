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
        'sent' => 'Um e-mail foi enviado para :mail com um código de verificação. Insira o código.',
        'title' => 'Verificação de Conta',
        'verifying' => 'Verificando...',
        'issuing' => 'Enviando novo código...',

        'info' => [
            'check_spam' => "Certifique-se de verificar a sua pasta de spam caso não consiga encontrar o e-mail.",
            'recover' => "Caso tenha esquecido seu email ou não tenha mais acesso a ele, utilize o :link.",
            'recover_link' => 'processo de recuperação de e-mail aqui',
            'reissue' => 'Você também pode :reissue_link ou :logout_link.',
            'reissue_link' => 'solicitar outro código',
            'logout_link' => 'sair',
        ],
    ],

    'errors' => [
        'expired' => 'O código de verificação expirou, um novo e-mail de confirmação foi enviado.',
        'incorrect_key' => 'Código de verificação incorreto.',
        'retries_exceeded' => 'Código de verificação incorreto. Limite de tentativas excedido, um novo e-mail de confirmação foi enviado.',
        'reissued' => 'Código de verificação gerado, um novo e-mail de confirmação foi enviado.',
        'unknown' => 'Ocorreu um problema desconhecido, um novo e-mail de confirmação foi enviado.',
    ],
];
