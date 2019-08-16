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
    'codes' => [
        'http-401' => 'Pro pokračování se prosím přihlaš.',
        'http-403' => 'Přístup odepřen.',
        'http-404' => 'Nenalezeno.',
        'http-429' => 'Příliš mnoho pokusů. Zkus to znovu později.',
    ],
    'account' => [
        'profile-order' => [
            'generic' => 'Došlo k chybě. Zkus stránku obnovit.',
        ],
    ],
    'beatmaps' => [
        'invalid_mode' => 'Byl specifikován neplatný mód.',
        'standard_converts_only' => 'Není dostupné žádné score pro zvolený mód na této obtížnosti.',
    ],
    'checkout' => [
        'generic' => '',
    ],
    'search' => [
        'default' => '',
        'operation_timeout_exception' => '',
    ],

    'logged_out' => 'Byl jsi odhlášen. Přihlas se prosím a zkus to znovu.',
    'supporter_only' => 'Pro použití této funkce musíš mít osu! supporter tag.',
    'no_restricted_access' => 'Tuto akci nemůžeš provést, když je tvůj účet v omezeném režimu.',
    'unknown' => 'Vyskytla se neznámá chyba.',
];
