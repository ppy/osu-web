<?php

/**
 *    Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
 *    See the LICENCE file in the repository root for full licence text.
 */

return [
    'limitation_notice' => 'Kun folk som bruger <a href=":lazer_link">osu!lazer</a> eller den nye side vil få beskeder igennem dette system.<br/>hvis du er usikker, send dem en besked <a href=":oldpm_link">fra den gamle privat besked side</a> i stedet for.',
    'talking_in' => 'taler i :channel',
    'talking_with' => 'taler med:name',
    'title_compact' => 'chat',
    'title' => 'Chat',
    'cannot_send' => [
        'channel' => 'Du kan ikke skrive i denne kanal på nuværende tidspunkt. Dette kan være pga. en af disse grunde:',
        'user' => 'Du kan ikke skrive til denne person på nuværende tidspunkt. Dette kan være pga. en af disse grunde:',
        'reasons' => [
            'blocked' => 'Du er blevet blokeret af modtageren',
            'channel_moderated' => 'Chatten er blevet sat til moderated',
            'friends_only' => 'Modtageren accepterer kun meddelelser fra personer på deres venneliste',
            'restricted' => 'Du er i øjeblikket begrænset',
            'target_restricted' => 'Modtageren er i øjeblikket begrænset',
        ],
    ],
    'input' => [
        'disabled' => 'kunne ikke sende besked...',
        'placeholder' => 'skriv Besked...',
        'send' => 'Send',
    ],
    'no-conversations' => [
        'howto' => "Start samtaler fra en brugers profil eller en brugerkort popup.",
        'lazer' => 'Offentlige kanaler du joiner via <a href=":link">osu!lazer</a> vil også vises her.',
        'pm_limitations' => 'Kun personer der bruger <a href=":link">osu!lazer</a> eller den nye side vil modtage Privat Beskeder.',
        'title' => 'ingen samtaler "endnu"',
    ],
];
