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
    'header' => [
        'small' => 'Súťaž aj inak, než klikaním kruhov.',
        'large' => 'Súťaže Komunity',
    ],
    'voting' => [
        'over' => 'Hlasovanie pre túto súťaź bolo ukončené',
        'login_required' => 'Pre hlasovanie sa prosím prihlás.',

        'best_of' => [
            'none_played' => "Vypadá to, že nemáš zahratú žiadnu mapu, ktorá je kvalifikovaná pre túto súťaž!",
        ],

        'button' => [
            'add' => '',
            'remove' => '',
            'used_up' => '',
        ],
    ],
    'entry' => [
        '_' => 'vstup',
        'login_required' => 'Prosím, prihlás sa pre vstup do súťaźe.',
        'silenced_or_restricted' => 'Nemôžeš sa zúčastniť súťaže, keď je tvoj účet v obmedzenom režime alebo umlčaný.',
        'preparation' => 'Momentálne pripravujeme túto súťaž. Prosím čakaj trpezlivo!',
        'over' => 'Díky za vaše vstupy! Podania boli uzavreté a hlasovanie sa čoskoro otvorí.',
        'limit_reached' => 'Dosiahol si limit vstupov pre túto súťaž',
        'drop_here' => 'Tvoj vstup pretiahni sem',
        'download' => 'Stiahnuť .osz',
        'wrong_type' => [
            'art' => 'Iba .jpg a .png súbory sú akceptované pre túto súťaž.',
            'beatmap' => 'Iba .osu súbory su akceptované pre túto súťaž.',
            'music' => 'Iba .mp3 súbory sú akceptované pre túto súťaž.',
        ],
        'too_big' => 'Možné vstupy pre túto súťaž sú :limit-krát.',
    ],
    'beatmaps' => [
        'download' => 'Stiahnuť vstup',
    ],
    'vote' => [
        'list' => 'hlasy',
        'count' => ':count hlas|:count hlasov',
        'points' => ':count bod|:count body',
    ],
    'dates' => [
        'ended' => 'Ukončené :date',

        'starts' => [
            '_' => 'Začína :date',
            'soon' => 'čoskoro™',
        ],
    ],
    'states' => [
        'entry' => 'Vstup Otvorený',
        'voting' => 'Hlasovanie Začalo',
        'results' => 'Výsledky',
    ],
];
