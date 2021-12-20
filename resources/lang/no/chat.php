<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'talking_in' => 'snakker i :channel',
    'talking_with' => 'snakker med :name',
    'title_compact' => 'chat',

    'cannot_send' => [
        'channel' => 'Du kan ikke sende meldinger i denne kanalen akkurat nå. Dette kan være en av følgende grunner:',
        'user' => 'Du kan ikke sende meldinger til denne brukeren akkurat nå. Dette kan være en av følgende grunner:',
        'reasons' => [
            'blocked' => 'Du har blitt blokkert av mottakeren',
            'channel_moderated' => 'Kanalen har blitt satt i moderator modus',
            'friends_only' => 'Mottakeren aksepterer bare meldinger fra folk på deres egen venneliste',
            'not_enough_plays' => '',
            'not_verified' => '',
            'restricted' => 'Du er for øyeblikket i begrenset modus',
            'silenced' => '',
            'target_restricted' => 'Mottakeren er i begrenset modus',
        ],
    ],
    'input' => [
        'disabled' => 'kan ikke sende melding...',
        'disconnected' => '',
        'placeholder' => 'skriv melding...',
        'send' => 'Send',
    ],
    'no-conversations' => [
        'howto' => "Start samtaler gjennom en brukers profil eller deres brukerkort.",
        'lazer' => 'Offentlige kanaler som du deltar i via <a href=":link">osu!lazer</a> vil også bli synlig her.',
        'title' => 'ingen samtaler ennå',
    ],
];
