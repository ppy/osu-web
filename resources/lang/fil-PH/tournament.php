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
    'index' => [
        'none_running' => 'Walang gumaganap na torneo ngayon, tingnan mo muli mamaya!',
        'registration_period' => 'Pagpaparehistro: :start hanggang :end',

        'header' => [
            'title' => 'Mga Komunidad na Torneo',
        ],

        'item' => [
            'registered' => 'Mga rehistradong manlalaro',
        ],

        'state' => [
            'current' => 'Mga Aktibong Torneo',
            'previous' => 'Mga Dating Torneo',
        ],
    ],

    'show' => [
        'banner' => 'Supportahan Ang Iyong Koponan',
        'entered' => 'Nakarehistro ka para sa torneong ito.<br><br>Tadaan na hindi ibig sabihin na naka-assign ka sa isang kopono.<br><br>Ang mga susunod na tagubilin ay ipapadala sa iyo sa pamamagitan ng email nang pagkalapit ng araw ng torneo, kaya siguraduhin na balido ang email address ng osu! account mo!',
        'info_page' => 'Pahina ng Impormasyon',
        'login_to_register' => 'Maaring :login para makita ang detalye sa rehistrasyon!',
        'not_yet_entered' => 'Hindi ka nakarehistro para sa torneong ito.',
        'rank_too_low' => 'Paumanhin, pero hindi sapat ang iyong ranggo para sa torneong ito!',
        'registration_ends' => 'Ang pagpaparehistro ay matatapos sa :date',

        'button' => [
            'cancel' => 'Magkansela ng Pagpaparehistro',
            'register' => 'Isali ako!',
        ],

        'period' => [
            'end' => '',
            'start' => '',
        ],

        'state' => [
            'before_registration' => 'Hindi pa nagsimula ang pagpaparehistro para sa torneong ito.',
            'ended' => 'Natapos na ang torneong ito. Tingang ang information page para sa mga resulta.',
            'registration_closed' => 'Natapos na ang pagpaparehistro para sa torneong ito. Tingang ang information page para sa mga pagbabago.',
            'running' => 'Gumaganap pa ang itong torneo. Tingnan ang information page para sa karagdagang mga detalye.',
        ],
    ],
    'tournament_period' => ':start hanggang :end',
];
