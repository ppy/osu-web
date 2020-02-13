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
    'limitation_notice' => 'Megjegyzés: Csak az <a href=":lazer_link">osu!lazer-t</a> vagy az új weboldalt használó emberek kapnak PM-eket ezen a rendszeren keresztül.<br/>Ha bizonytalan vagy, inkább a <a href=":oldpm_link">régi fórum PM oldaláról</a> üzenj nekik.',
    'talking_in' => ':channel-ben beszélés',
    'talking_with' => ':name-el beszélés',
    'title_compact' => 'chat',

    'cannot_send' => [
        'channel' => 'Nem üzenhetsz ebbe a csatornába jelenleg. Ez emiatt az okok miatt lehet:',
        'user' => 'Nem üzenhetsz ennek a felhasználónak jelenleg. Ez emiatt az okok miatt lehet:',
        'reasons' => [
            'blocked' => 'A címzett blokkolt téged',
            'channel_moderated' => 'A csatorna moderálva lett',
            'friends_only' => 'A címzett csak a barátlistáján szereplő emberektől fogad üzeneteket',
            'restricted' => 'Jelenleg fel vagy függesztve',
            'target_restricted' => 'A címzett jelenleg korlátozva van',
        ],
    ],
    'input' => [
        'disabled' => 'üzenet küldése sikertelen...',
        'placeholder' => 'üzenet írása...',
        'send' => 'Küldés',
    ],
    'no-conversations' => [
        'howto' => "Beszélgetés indítása egy felhasználó profiljából vagy egy felugró felhasználókártyából.",
        'lazer' => 'Az <a href=":link">osu!lazer</a>-en keresztül csatlakozott nyilvános csatornák itt is láthatóak lesznek.',
        'pm_limitations' => 'Kizárólag az <a href=":link">osu!lazer</a>-t vagy az új weboldalt használók kapnak PM-eket.',
        'title' => 'még nincsenek beszélgetések',
    ],
];
