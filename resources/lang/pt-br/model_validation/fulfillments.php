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
        'only_one' => 'apenas 1 troca de nome de usuário é permitida por compra.',
        'insufficient_paid' => 'O custo para trocar de nome de usuário ultrapassa a quantia paga (:expected > :actual)',
        'reverting_username_mismatch' => 'O atual nome de usuário (:current) não é o mesmo escolhido ao revogar (:username)',
    ],
    'supporter_tag' => [
        'insufficient_paid' => 'O valor da doação é menor que o necessário para obter uma osu!supporter tag (:actual > :expected)',
    ],
];
