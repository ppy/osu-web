<?php

/**
 *    Copyright 2015-2016 ppy Pty. Ltd.
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
        'sent' => 'Um e-mail foi enviado para :mail com um código de verificação. Entre com o código.',
        'title' => 'Verificação de conta',
        'verifying' => 'Verificando...',

        'info' => [
            'check_spam' => "Certifique-se de verificar a sua pasta de spam se você não conseguir encontrar o e-mail.",
            'recover' => "Se você não consegue acessar seu e-mail ou ter esquecido qual você usou, siga o :link.",
            'recover_link' => 'processo de recuperação de e-mail aqui',
        ],
    ],

    'email' => [
        'subject' => 'osu! verificação de conta',
    ],

    'errors' => [
        'expired' => 'Código de verificação expirado, novo e-mail de confirmação enviado.',
        'incorrect_key' => 'Código de verificação incorreto.',
        'retries_exceeded' => 'Código de verificação incorreto. Limite de tentativas excedido, novo e-mail de confirmação enviado.',
        'unknown' => 'Problema desconhecido ocorreu, novo e-mail de confirmação enviado.',
    ],
];

