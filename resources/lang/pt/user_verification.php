<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'box' => [
        'sent' => 'Um e-mail foi enviado para :mail com um código de verificação. Introduza-o.',
        'title' => 'Verificação da conta',
        'verifying' => 'A verificar...',
        'issuing' => 'A emitir o novo código...',

        'info' => [
            'check_spam' => "Certifique‑se de verificar a sua pasta de publicidade caso não encontre o e-mail.",
            'recover' => "Se não conseguir aceder ao seu e-mail ou se já não se lembrar qual utilizou, siga o :link.",
            'recover_link' => 'processo de recuperação de email aqui',
            'reissue' => 'Também pode :reissue_link ou :logout_link.',
            'reissue_link' => 'pedir outro código',
            'logout_link' => 'terminar a sessão',
        ],
    ],

    'box_totp' => [
        'heading' => 'Por favor, introduza o código do seu autenticador.',

        'info' => [
            'logout' => [
                '_' => 'Também pode :link.',
                'link' => 'encerrar a sessão',
            ],
            'mail_fallback' => [
                '_' => 'Se não conseguir aceder à sua aplicação, :link.',
                'link' => 'pode, em alternativa, verificar através do e-mail',
            ],
        ],
    ],

    'errors' => [
        'expired' => 'O código de verificação expirou. Foi enviado um novo e-mail de verificação.',
        'incorrect_key' => 'O código de verificação está incorreto.',
        'retries_exceeded' => 'O código de verificação está incorreto. O limite de tentativas foi excedido, um novo e-mail de verificação foi enviado.',
        'reissued' => 'O Código de verificação foi reenviado. Um novo e-mail de verificação foi enviado.',
        'totp_used_key' => 'O código de verificação já foi utilizado. Aguarde e use um novo.',
        'totp_gone' => 'O token de autenticação foi removido. A verificação passará a ser feita por e-mail. O e-mail de verificação foi enviado.',
        'unknown' => 'Ocorreu um problema desconhecido. Um novo e-mail de verificação foi enviado.',
    ],
];
