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
        'sent' => 'Pranešimas buvo išsiųstas į :mail su atpažinimo kodu. Įrašyk kodą.',
        'title' => 'Paskyros patvirtinimas',
        'verifying' => 'Patvirtinama...',
        'issuing' => 'Sukurtas naujas kodas...',

        'info' => [
            'check_spam' => "",
            'recover' => "",
            'recover_link' => '',
            'reissue' => '',
            'reissue_link' => '',
            'logout_link' => 'atsijungti',
        ],
    ],

    'errors' => [
        'expired' => 'Atpažinimo kodas pasibaigė. Naujas patvirtinimo pranešimas išsiųstas',
        'incorrect_key' => 'Neteisingas patvirtinimo kodas.',
        'retries_exceeded' => '',
        'reissued' => '',
        'unknown' => '',
    ],
];
