<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

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
