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
    'box' => [
        'sent' => 'May napadala na email sa :mail na may isang verification code. Ipasok ang code.',
        'title' => 'Beripikasyon ng Account',
        'verifying' => '',
        'issuing' => 'Nagbibigay ng bagong code...',

        'info' => [
            'check_spam' => "Siguraduhin na suriin ang iyong spam folder kung hindi mo makita ang email.",
            'recover' => "Kung hindi mo ma-access ang iyong email o nakalimutan kung ano ang ginamit mo, pakisundin ang :link.",
            'recover_link' => 'proseso ng pagbawi ng email dito',
            'reissue' => 'Pwede ka ring :reissue_link o :logout_link.',
            'reissue_link' => 'humingi ng isa pang code',
            'logout_link' => 'mag-sign out',
        ],
    ],

    'errors' => [
        'expired' => '',
        'incorrect_key' => 'Maling verification code.',
        'retries_exceeded' => 'Maling verification code. Lumampas sa limitasyon ng pag-ulit, nagpadala ng bagong verification email.',
        'reissued' => 'Nagpalabas muli ng verfication code, nagpadala ng bagong verification email.',
        'unknown' => '',
    ],
];
