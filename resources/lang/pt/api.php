<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'error' => [
        'chat' => [
            'empty' => 'Não é possível enviar uma mensagem em branco.',
            'limit_exceeded' => 'Estás a enviar mensagens demasiado depressa, por favor espera um pouco antes de tentares novamente.',
            'too_long' => 'A mensagem que estás a tentar enviar é demasiado longa.',
        ],
    ],

    'scopes' => [
        'bot' => 'Agir como um bot de chat.',
        'identify' => 'Identificar-te e ler o teu perfil público.',

        'chat' => [
            'write' => 'Enviar mensagens em teu nome.',
        ],

        'forum' => [
            'write' => 'Criar e editar tópicos e publicações do fórum em teu nome.',
        ],

        'friends' => [
            'read' => 'Ver quem estás a seguir.',
        ],

        'public' => 'Ler dados públicos em teu nome.',
    ],
];
