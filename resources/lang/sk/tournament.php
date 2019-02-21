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
    'index' => [
        'none_running' => 'Zrovna neprebiehajú žiadne turnaje, pozri sa prosím neskôr!',
        'registration_period' => 'Registrácia: :start do :end',

        'header' => [
            'subtitle' => 'Zoznam aktívných, oficialne uznaných turnajov',
            'title' => 'Komunitné Turnaje',
        ],

        'item' => [
            'registered' => 'Zaregistrovaný hráči',
        ],

        'state' => [
            'current' => 'Prebiehajúce Turnaje',
            'previous' => 'Minulé Turnaje',
        ],
    ],

    'show' => [
        'banner' => 'Podpor Tvoj Tím',
        'entered' => 'Na tento turnaj si zaregistrovaný. <br><br>To ale neznamená, že si bol priradený k tímu.<br><br>Ďalšie inštrukcie ti budú zaslané na e-mail bližšie k dátumu turnaja, preto si prosím over, že emailová adresa priradená k tvojmu osu! účtu je platná!',
        'info_page' => 'Informačná Stránka',
        'login_to_register' => 'Prosím :login pre zobrazenie údajov k registrácií!',
        'not_yet_entered' => 'Nie si zaregistrovaný v tomto turnaji.',
        'rank_too_low' => 'Prepáč, nesplňuješ hodnostné požiadavky pre tento turnaj!',
        'registration_ends' => 'Registrácia končí :date',

        'button' => [
            'cancel' => 'Zrušiť Registráciu',
            'register' => 'Prihlásiť sa!',
        ],

        'state' => [
            'before_registration' => 'Registrácia pre tento turnaj sa ešte nezačala.',
            'ended' => 'Tento turnaj dospel k záveru. Pozrite si informačnú stránku pre výsledky.',
            'registration_closed' => 'Registrácia pre tento turnaj bola uzavretá. Pozrite si informačnú stránku pre najnovšie aktualizácie.',
            'running' => 'Tento turnaj momentálne prebieha. Pozri si informačné stránky pre viac detailov.',
        ],
    ],
    'tournament_period' => ':start do :end',
];
