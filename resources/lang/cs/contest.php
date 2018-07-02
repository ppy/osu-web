<?php

/**
 *    Copyright 2015-2018 ppy Pty. Ltd.
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
    'header' => [
        'small' => 'Soutěžte i jinak než jen klikáním kruhů.',
        'large' => 'osu! Komunitní Soutěže',
    ],
    'voting' => [
        'over' => 'Hlasování pro tuto soutěž bylo ukončeno',
        'login_required' => 'Pro hlasování se prosím přihlašte.',
        'best_of' => [
            'none_played' => "Vypadá to že nemáté zahranou žádnou mapu která je kvalifikovaná na tuto soutěž!",
        ],
    ],
    'entry' => [
        '_' => 'vstup',
        'login_required' => 'Přihlašte se prosím pro vstup do soutěže.',
        'silenced_or_restricted' => 'Nemůžete se zůčastnit soutěže když je váš účet v omezeném režimu nebo ztlumený.',
        'preparation' => 'Tuto soutěž právě připravujeme. Prosím čekejte trpělivě!',
        'over' => 'Díky za vaše vstupy! Podání byla uzavřena a hlasování se brzy otevře.',
        'limit_reached' => 'Dosáhli jste limitu vstupů pro tuto soutěž',
        'drop_here' => 'Svůj vstup přetáhněte sem',
        'wrong_type' => [
            'art' => 'Pouze .jpg a ,png soubory jsou přijímány pro tuto soutěž.',
            'beatmap' => 'Pouze .osu soubory jsou přijímány pro tuto soutěž.',
            'music' => 'Pouze .mp3 soubory jsou přijímány pro tuto soutěž.',
        ],
        'too_big' => 'Položky pro tuto soutěž můžou mít maximálně :limit.',
    ],
    'beatmaps' => [
        'download' => 'Stáhnout Vstup',
    ],
    'vote' => [
        'list' => 'hlasy',
        'count' => '1 hlas|:count hlasů',
    ],
    'dates' => [
        'ended' => 'Ukončeno :date',

        'starts' => [
            '_' => 'Začíná :date',
            'soon' => 'brzy™',
        ],
    ],
    'states' => [
        'entry' => 'Vstup Otevřen',
        'voting' => 'Hlasování Začalo',
        'results' => 'Výsledky Vyhlášeny',
    ],
];
