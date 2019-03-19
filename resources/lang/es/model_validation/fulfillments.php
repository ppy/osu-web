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
        'only_one' => 'Sólo se permite un cambio de nombre de usuario por cada orden.',
        'insufficient_paid' => 'El coste del cambio de nombre de usuario excede la cantidad pagada (:expected > :actual)',
        'reverting_username_mismatch' => 'El nombre de usuario actual (:current) no es el mismo nombre de usuario que se está intentando revocar (:username)',
    ],
    'supporter_tag' => [
        'insufficient_paid' => 'La donación es menor a la mínima necesitada para el osu!supporter (:actual > :expected)',
    ],
];
