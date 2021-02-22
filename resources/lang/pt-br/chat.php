<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'talking_in' => 'conversando em :channel',
    'talking_with' => 'conversando com :name',
    'title_compact' => 'chat',

    'cannot_send' => [
        'channel' => 'Você não pode conversar neste canal no momento. Isso pode ter ocorrido pelos seguintes motivos:',
        'user' => 'Você não pode conversar com este usuário no momento. Isso pode ter ocorrido pelos seguintes motivos:',
        'reasons' => [
            'blocked' => 'Você foi bloqueado pelo destinatário',
            'channel_moderated' => 'Este canal está sendo moderado',
            'friends_only' => 'O destinatário apenas aceita mensagens de pessoas em sua lista de amigos',
            'not_enough_plays' => 'Você não jogou o suficiente',
            'not_verified' => 'Sua sessão não foi verificada',
            'restricted' => 'Você está atualmente em estado restrito',
            'silenced' => '',
            'target_restricted' => 'O destinatário está atualmente em estado restrito',
        ],
    ],
    'input' => [
        'disabled' => 'incapaz de enviar mensagem...',
        'placeholder' => 'escrever uma mensagem...',
        'send' => 'Enviar',
    ],
    'no-conversations' => [
        'howto' => "Comece uma conversa através do perfil ou pelo cartão do usuário.",
        'lazer' => 'Canais públicos que você entrar via <a href=":link">osu!lazer</a> também serão visíveis aqui.',
        'title' => 'sem conversas no momento',
    ],
];
