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
    'limitation_notice' => 'NOTA: Sólo las personas que estén usando <a href=":lazer_link">osu!lazer</a> o el nuevo sitio web recibirán MPs a través de este sistema.<br/>Si no está seguro, envíeles un mensaje a través de la <a href=":oldpm_link">página de MP del antiguo foro</a>.',
    'talking_in' => 'Hablando en :channel',
    'talking_with' => 'Hablando con :name',
    'title_compact' => 'chat',

    'cannot_send' => [
        'channel' => 'No puedes enviar mensajes a este canal en este momento. Esto puede ser debido a cualquiera de las siguientes razones:',
        'user' => 'No puedes enviar mensajes a este canal en este momento. Esto puede ser debido a cualquiera de las siguientes razones:',
        'reasons' => [
            'blocked' => 'Usted fue bloqueado por el destinatario',
            'channel_moderated' => 'El canal ha sido moderado',
            'friends_only' => 'El destinatario sólo acepta mensajes de personas en su lista de amigos',
            'restricted' => 'Actualmente estás restringido',
            'target_restricted' => 'El destinatario está actualmente restringido',
        ],
    ],
    'input' => [
        'disabled' => 'No se pudo enviar el mensaje...',
        'placeholder' => 'Escribe el mensaje...',
        'send' => 'Enviar',
    ],
    'no-conversations' => [
        'howto' => "Inicia conversaciones desde el perfil de un usuario o con un usercard popup.",
        'lazer' => 'Los canales a los que te unas por medio de <a href=":link">osu!lazer</a> aparecerán aquí.',
        'pm_limitations' => 'Sólo las personas que usan <a href=":link">osu!lazer</a> o el nuevo sitio web recibirán MPs.',
        'title' => 'Sin conversaciones',
    ],
];
