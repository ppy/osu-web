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
        'only_one' => 'endast 1 ändring av användarnamn är tillåtet per order.',
        'insufficient_paid' => 'Användarnamn ändring överskrider summa betald (:expected > :actual)',
        'reverting_username_mismatch' => 'Nuvarande användarnamn (:current) är inte detsamma som ändring till återkallande (:username)',
    ],
    'supporter_tag' => [
        'insufficient_paid' => 'Donationen är mindre än tillräckligt för supporter tag present (:actual > :expected)',
    ],
];
