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
    'username_change' => [
        'only_one' => 'Nur ein Benutzername pro Auftrag erlaubt.',
        'insufficient_paid' => 'Die Namensänderung kostet mehr als gezahlt wurde (:expected > :actual)',
        'reverting_username_mismatch' => 'Aktueller Nutzername (:current) entspricht nicht dem, der widerrufen werden soll (:username)',
    ],
    'supporter_tag' => [
        'insufficient_paid' => 'Deine Spende ist zu gering, um das osu!supporter tag Geschenk zu erhalten (:actual > :expected)',
    ],
];
