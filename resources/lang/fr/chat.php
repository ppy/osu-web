<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
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
            'not_enough_plays' => 'Vous n\'avez pas assez joué au jeu',
            'not_verified' => 'Votre session n\'a pas été vérifiée',
            'restricted' => 'Vous êtes actuellement restreint',
            'silenced' => '',
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
        'title' => 'pas encore de conversations',
    ],
];
