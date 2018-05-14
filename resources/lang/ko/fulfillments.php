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
    'username_change' => [
        'only_one' => 'only 1 username change allowed per order fulfillment.',
        'insufficient_paid' => 'Username change cost exceeds amount paid (:expected > :actual)',
        'reverting_username_mismatch' => 'Current username (:current) is not the same as change to revoke (:username)',
    ],
    'supporter_tag' => [
        'insufficient_paid' => 'Donation is less than required for supporter tag gift (:actual > :expected)',
    ],
];
