<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'talking_in' => 'hablando en :channel',
    'talking_with' => 'hablando con :name',
    'title_compact' => 'chat',

    'cannot_send' => [
        'channel' => 'No puede enviar un mensaje a este canal en este momento. Esto puede deberse a cualquiera de las siguientes razones:',
        'user' => 'No puede enviar un mensaje a este usuario en este momento. Esto puede deberse a cualquiera de las siguientes razones:',
        'reasons' => [
            'blocked' => 'Usted fue bloqueado por el destinatario',
            'channel_moderated' => 'El canal ha sido moderado',
            'friends_only' => 'El destinatario sólo acepta mensajes de personas en su lista de amigos',
            'not_enough_plays' => 'No ha jugado lo suficiente',
            'not_verified' => 'Su sesión no ha sido verificada',
            'restricted' => 'Actualmente está restringido',
            'silenced' => 'Actualmente está silenciado',
            'target_restricted' => 'El destinatario está actualmente restringido',
        ],
    ],
    'input' => [
        'disabled' => 'no se puede enviar el mensaje...',
        'placeholder' => 'escriba el mensaje...',
        'send' => 'Enviar',
    ],
    'no-conversations' => [
        'howto' => "Inicie conversaciones desde el perfil de un usuario o desde una tarjeta de usuario emergente.",
        'lazer' => 'Los canales públicos a los que se una a través de <a href=":link">osu!lazer</a> también serán visibles aquí.',
        'title' => 'aún no hay conversaciones',
    ],
];
