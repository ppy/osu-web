<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'username_change' => [
        'only_one' => 'only 1 username change allowed per order fulfillment.',
        'insufficient_paid' => 'Username change cost exceeds amount paid (:expected > :actual)',
        'reverting_username_mismatch' => 'Current username (:current) is not the same as change to revoke (:username)',
    ],
    'supporter_tag' => [
        'insufficient_paid' => 'Donation is less than required for osu!supporter tag gift (:actual > :expected)',
    ],
];
