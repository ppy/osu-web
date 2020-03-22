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
    'limitation_notice' => 'NOTA: Somente as pessoas que usem <a href=":lazer_link">osu!lazer</a> ou o novo website é que receberão mensagens privadas através deste sistema.<br/>Se estás incerto, envia-os uma mensagem a partir da <a href=":oldpm_link">página de mensagens privadas do fórum velho</a> como alternativa.',
    'talking_in' => 'a falar em :channel',
    'talking_with' => 'a falar com :name',
    'title_compact' => 'chat',

    'cannot_send' => [
        'channel' => 'Não podes mandar mensagens neste canal de momento. Isto poderá ser devido a uma das razões:',
        'user' => 'Não podes enviar mensagens a este utilizador de momento. Isto poderá ser devido a uma das razões:',
        'reasons' => [
            'blocked' => 'Foste bloqueado pelo destinatário',
            'channel_moderated' => 'O canal foi moderado',
            'friends_only' => 'O destinatário só aceita mensagens de pessoas da sua lista de amigos',
            'restricted' => 'Tu estás restrito',
            'target_restricted' => 'O destinatário está atualmente restrito',
        ],
    ],
    'input' => [
        'disabled' => 'incapacitado de enviar mensagem...',
        'placeholder' => 'escrever mensagem...',
        'send' => 'Enviar',
    ],
    'no-conversations' => [
        'howto' => "Começa a conversar a partir do perfil dum utilizador ou dum popup cartão de utilizador.",
        'lazer' => 'Canais públicos que te juntes via <a href=":link">osu!lazer</a> também serão visíveis aqui.',
        'pm_limitations' => 'Somente pessoas que usem <a href=":link">osu!lazer</a> ou o novo website é que receberão mensagens privadas.',
        'title' => 'ainda sem conversações',
    ],
];
