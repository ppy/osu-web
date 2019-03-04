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
        'only_one' => 'maar 1 naamsverandering toegestaan per order.',
        'insufficient_paid' => 'Kosten om gebruikersnaam te wijzigen overschrijdt het betaalde bedrag (:expected > :actual)',
        'reverting_username_mismatch' => 'Huidige gebruikersnaam (:current) is niet dezelfde als de gebruikersnaam die we probeerde te verwijderen (:username)',
    ],
    'supporter_tag' => [
        'insufficient_paid' => 'Donatie is minder dan vereist voor osu!supporter tag geschenk (:actual > :expected)',
    ],
];
