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
    'limitation_notice' => 'NOTA: Somente pessoas que estiverem utilizando <a href=":lazer_link">osu!lazer</a> ou o novo website poderão receber mensagens privadas através deste sistema.<br/>Se estiver incerto, utilize a <a href=":oldpm_link">página de mensagens privadas do fórum antigo</a> como alternativa.',
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
            'restricted' => 'Você está atualmente em estado restrito',
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
        'pm_limitations' => 'Apenas pessoas utilizando <a href=":link">osu!lazer</a> ou o novo website receberão mensagens privadas.',
        'title' => 'sem conversas no momento',
    ],
];
