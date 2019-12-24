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
    'limitation_notice' => 'NOTE: Seules les personnes qui utilisent <a href=":lazer_link">osu!lazer</a> ou le nouveau site web recevront des messages privés grâce à ce système.<br/>Si vous n’êtes pas sûr, envoyez-leur un message par l’intermédiaire de <a href=":oldpm_link">l’ancienne page forum des messages privés</a> à la place.',
    'talking_in' => 'parle dans :channel',
    'talking_with' => 'parle avec :name',
    'title_compact' => 'chat',

    'cannot_send' => [
        'channel' => 'Vous ne pouvez pas envoyer de messages dans ce canal pour le moment. Cela peut être dû à une des raisons suivantes:',
        'user' => 'Vous ne pouvez pas envoyer de messages à cet utilisateur pour le moment. Cela peut être dû à une des raisons suivantes:',
        'reasons' => [
            'blocked' => 'Vous avez été bloqué par le destinataire',
            'channel_moderated' => 'Ce canal a été modéré',
            'friends_only' => 'Le destinaire accepte uniquement les messages provenant de personnes sur sa liste d’amis',
            'restricted' => 'Vous êtes actuellement restreint',
            'target_restricted' => 'Le destinataire est actuellement restreint',
        ],
    ],
    'input' => [
        'disabled' => 'impossible d’envoyer le message...',
        'placeholder' => 'saisissez le message...',
        'send' => 'Envoyer',
    ],
    'no-conversations' => [
        'howto' => "Démarrer des conversations depuis un profil utilisateur ou un popup carte utilisateur.",
        'lazer' => 'Les canaux publics que vous rejoignez via <a href=":link">osu!lazer</a> seront aussi visibles ici.',
        'pm_limitations' => 'Seules les personnes utilisant <a href=":link">osu!lazer</a> ou le nouveau site web recevront des messages privés.',
        'title' => 'pas encore de conversations',
    ],
];
