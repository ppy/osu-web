<?php

/**
 *    Copyright 2015-2017 ppy Pty. Ltd.
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
        'header' => [
            'subtitle' => 'A listing of active, officially-recognised tournaments',
            'title' => 'Community Tournaments',
        ],
        'none_running' => 'There are no tournaments running at the moment, please check back later!',
        'registration_period' => 'Registration: :start to :end',
    ],
    'show' => [
        'button' => [
            'register' => 'Sign me up!',
            'cancel' => 'Cancel Registration',
        ],
        'entered' => 'Your are registered for this tournament.<br><br>Note that this does not mean you have been assigned to a team.<br><br>Further instructions will be sent to you via email closer to the tournament date, so please ensure your osu! account\'s email address is valid!',
        'login_to_register' => 'Please :login to view registration details!',
        'not_yet_entered' => 'You are not registered for this tournament.',
        'rank_too_low' => 'Sorry, you do not meet the rank requirements for this tournament!',
        'registration_ends' => 'Registrations close on :date',
    ],
    'tournament_period' => ':start to :end',
];
