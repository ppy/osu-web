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
    'limitation_notice' => 'Kun folk som bruger <a href=":lazer_link">osu!lazer</a> eller den nye side vil få beskeder igennem dette system.<br/>hvis du er usikker, send dem en besked <a href=":oldpm_link">fra den gamle privat besked side</a> i stedet for.',
    'talking_in' => 'taler i :channel',
    'talking_with' => 'taler med:name',
    'title_compact' => 'chat',

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
        'howto' => "Start samtaler fra en brugers profil eller et brugerkort-popup.",
        'lazer' => 'Offentlige kanaler du joiner via <a href=":link">osu!lazer</a> vil også vises her.',
        'pm_limitations' => 'Kun personer der bruger <a href=":link">osu!lazer</a> eller den nye side vil modtage Privat Beskeder.',
        'title' => 'ingen samtaler "endnu"',
    ],
];
