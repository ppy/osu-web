<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

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
