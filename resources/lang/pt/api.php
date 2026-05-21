<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'error' => [
        'chat' => [
            'empty' => 'Não é possível enviar uma mensagem vazia.',
            'limit_exceeded' => 'Está a enviar mensagens demasiado rapidamente, por favor, aguarde um momento antes de tentar novamente.',
            'too_long' => 'A mensagem que está a tentar enviar é demasiado longa.',
        ],
    ],

    'scopes' => [
        'bot' => 'Atuar como um robô de conversação.',
        'identify' => 'Identificar‑lo e ler o seu perfil público.',

        'chat' => [
            'read' => 'Ler mensagens em seu nome.',
            'write' => 'Enviar mensagens em seu nome.',
            'write_manage' => 'Entrar e sair de canais em seu nome.',
        ],

        'forum' => [
            'write' => 'Criar e editar tópicos e publicações do fórum em seu nome.',
            'write_manage' => 'Gerir tópicos e publicações do fórum em seu nome.',
        ],

        'friends' => [
            'read' => 'Ver quem está a seguir.',
        ],

        'multiplayer' => [
            'write_manage' => 'Criar e gerir salas multijogador em seu nome.',
        ],

        'public' => 'Ler dados públicos em seu nome.',
    ],
];
