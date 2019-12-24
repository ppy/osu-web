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
    'limitation_notice' => 'Merk: Bare folk som bruker <a href=":lazer_link">osu!lazer</a> eller den nye nettsiden vil motta direktemeldinger gjennom dette syetemet. <br/>Hvis du er usikker, send dem en melding via <a href=":oldpm_link">private meldinger på den gamle forumsiden</a> isteden.',
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
            'restricted' => 'Du er for øyeblikket i begrenset modus',
            'target_restricted' => 'Mottakeren er i begrenset modus',
        ],
    ],
    'input' => [
        'disabled' => 'kan ikke sende melding...',
        'placeholder' => 'skriv melding...',
        'send' => 'Send',
    ],
    'no-conversations' => [
        'howto' => "Start samtaler gjennom en brukers profil eller deres brukerkort.",
        'lazer' => 'Offentlige kanaler som du deltar i via <a href=":link">osu!lazer</a> vil også bli synlig her.',
        'pm_limitations' => 'Bare folk som bruker <a href=":link">osu!lazer</a> eller den nye nettsiden vil motta direktemeldinger.',
        'title' => 'ingen samtaler ennå',
    ],
];
