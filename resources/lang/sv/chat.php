<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'talking_in' => 'pratar i :channel',
    'talking_with' => 'pratar med :name',
    'title_compact' => 'chatt',

    'cannot_send' => [
        'channel' => 'Du kan inte skicka ett meddelande i denna kanal just nu. Detta kan bero på någon av följande skäl:',
        'user' => 'Du kan inte skicka ett meddelande till denna användare just nu. Detta kan bero på någon av följande skäl:',
        'reasons' => [
            'blocked' => 'Du blockerades av mottagaren',
            'channel_moderated' => 'Kanalen har modererats',
            'friends_only' => 'Mottagaren accepterar endast meddelanden från personer på sin vänlista',
            'not_enough_plays' => 'Du har inte spelat spelet tillräckligt',
            'not_verified' => 'Din session har inte verifierats',
            'restricted' => 'Du är för närvarande begränsad',
            'silenced' => 'Du är för närvarande tystad',
            'target_restricted' => 'Mottagaren är för närvarande begränsad',
        ],
    ],
    'input' => [
        'disabled' => 'kan inte skicka meddelande...',
        'placeholder' => 'skriv ett meddelande...',
        'send' => 'Skicka',
    ],
    'no-conversations' => [
        'howto' => "Starta konversationer från en användares profil eller en usercard popup.",
        'lazer' => 'Offentliga kanaler du går med i via <a href=":link">osu!lazer</a> kommer också att synas här.',
        'title' => 'inga konversationer ännu',
    ],
];
