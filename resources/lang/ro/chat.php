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
    'limitation_notice' => 'NOTĂ: Doar cei ce folosesc <a href=":lazer_link">osu!lazer</a> sau noul website vor primi mesaje directe prin acest sistem.<br/>Dacă nu ești sigur, trimite-le un mesaj prin intermediul <a href=":oldpm_link">vechii pagini de trimis mesaje</a> în schimb.',
    'talking_in' => 'vorbești în :channel',
    'talking_with' => 'vorbești cu :name',
    'title_compact' => 'chat',

    'cannot_send' => [
        'channel' => 'Nu poți trimite mesaje în acest canal chiar acum. Acest lucru poate fi din cauza următoarelor motive:',
        'user' => 'Nu poți trimite mesaje acestui utilizator chiar acum. Acest lucru poate fi din cauza următoarelor motive:',
        'reasons' => [
            'blocked' => 'Ai fost blocat de către destinatar',
            'channel_moderated' => 'Acest canal a fost moderat',
            'friends_only' => 'Destinatarul acceptă mesaje doar de la persoane din lista lui de prieteni',
            'restricted' => 'Ești restricționat în prezent',
            'target_restricted' => 'Destinatarul este restricționat în prezent',
        ],
    ],
    'input' => [
        'disabled' => 'nu poți trimite mesaje...',
        'placeholder' => 'scrie un mesaj...',
        'send' => 'Trimite',
    ],
    'no-conversations' => [
        'howto' => "Începe conversații din profilul unui utilizator sau dintr-un pop-up de pe cartea de utilizator.",
        'lazer' => 'Canalele publice în care te alături prin intermediul <a href=":link">osu!lazer</a> vor fi vizibile aici.',
        'pm_limitations' => 'Doar persoanele care folosesc <a href=":link">osu!lazer</a> sau noul website vor primi mesaje directe.',
        'title' => 'nu sunt conversații încă',
    ],
];
