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
    'coming_soon' => 'už čoskoro',
    'limitation_notice' => 'POZNÁMKA: Iba ľudia ktorý používajú <a href=":lazer_link">osu!lazer</a> alebo novú stránku môžu dostať súkromné správy cez tento systém.<br/>Ak ste si nie istý, pošlite im správu cez <a href=":oldpm_link">starý systém na fórum</a>.',
    'talking_in' => 'píšete do :channel',
    'talking_with' => 'píšete si s :name',
    'title_compact' => 'chat',
    'title' => 'Chat',
    'cannot_send' => [
        'channel' => 'Momentálne nemôžete poslať správu do tohto kanálu. Toto môže byť zapríčinené hociktorým z týchto dôvodov:',
        'user' => 'Momentálne nemôžete poslať správu tomuto užívateľovi. Toto môže byť zapríčinené hociktorým z týchto dôvodov:',
        'reasons' => [
            'blocked' => 'Boli ste zablokovaný príjemcom',
            'channel_moderated' => 'Tento kanál je moderovaný',
            'friends_only' => 'Príjemca akceptuje správy len od ľudí na jeho zozname priateľov',
            'restricted' => 'Momentálne ste obmedzený',
            'target_restricted' => 'Príjemca je momentálne obmedzený',
        ],
    ],
    'input' => [
        'disabled' => 'nedá sa poslať správa...',
        'placeholder' => 'napíšte správu...',
        'send' => 'Odoslať',
    ],
    'no-conversations' => [
        'howto' => "Začnite konverzáciu z profilu užívateľa alebo z popup karty užívateľa.",
        'lazer' => 'Verejné kanály na ktoré sa pripojíte cez <a href=":link">osu!lazer</a> budú viditeľné aj tu.',
        'pm_limitations' => 'Iba ľudia ktorý používajú <a href=":link">osu!lazer</a> alebo novú webstránku dostanú skromné správy.',
        'title' => 'zatiaľ žiadne konverzácie',
    ],
];
