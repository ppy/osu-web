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
    'error' => [
        'chat' => [
            'empty' => 'Kan ikke sende en tom besked.',
            'limit_exceeded' => 'Du sender beskeder for hurtigt, vent venligst lidt før du prøver igen.',
            'too_long' => 'Beskeden du prøver at sende er for lang.',
        ],
    ],

    'scopes' => [
        'identify' => 'Identificere dig og læse din offentlige profil.',

        'friends' => [
            'read' => 'Se hvem du følger.',
        ],
    ],
];
