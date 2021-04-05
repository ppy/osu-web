<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'error' => [
        'chat' => [
            'empty' => 'Não é possível enviar mensagens em branco.',
            'limit_exceeded' => 'Você está enviando mensagens muito rapidamente, espere um pouco antes de tentar novamente.',
            'too_long' => 'A mensagem que você está tentando enviar é longa demais.',
        ],
    ],

    'scopes' => [
        'bot' => 'Agir como um bot de chat.',
        'identify' => 'Identificar você e ler seu perfil público.',

        'chat' => [
            'write' => 'Enviar mensagens em seu nome.',
        ],

        'forum' => [
            'write' => 'Criar e editar tópicos e postagens do fórum em seu nome.',
        ],

        'friends' => [
            'read' => 'Veja quem você está seguindo.',
        ],

        'public' => 'Ler dados públicos em seu nome.',
    ],
];
