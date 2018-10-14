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
    'index' => [
        'none_running' => 'Zrovna neprobíhají žádné turnaje, vrať se prosím později!',
        'registration_period' => 'Registrace: :start do :end',

        'header' => [
            'subtitle' => 'Seznam aktivních, oficiálně uznaných turnajů',
            'title' => 'Komunitní turnaje',
        ],

        'item' => [
            'registered' => 'Registrovaní hráči',
        ],

        'state' => [
            'current' => 'Probíhající turnaje',
            'previous' => 'Minulé zápasy',
        ],
    ],

    'show' => [
        'banner' => 'Podpoř svůj tým',
        'entered' => 'Na tento turnaj jsi zaregistrovaný.<br><br>To ovšem neznamená, že jsi byl přiřazen k týmu.<br><br>Další instrukce ti budou zaslány na email blíže k datu turnaje, proto prosím ověř, že emailová adresa přiřazena k tvému osu! účtu je platná!',
        'info_page' => 'Informační stránka',
        'login_to_register' => 'Prosím :login pro zobrazení údajů k registraci!',
        'not_yet_entered' => 'Do tohoto turnaje nejsi zaregistrován.',
        'rank_too_low' => 'Bohužel nesplňuješ hodnostní požadavky pro tento turnaj!',
        'registration_ends' => 'Registrace se uzavírá :date',

        'button' => [
            'cancel' => 'Zrušit registraci',
            'register' => 'Přihlaš mě!',
        ],

        'state' => [
            'before_registration' => 'Registrace pro tento turnaj zatím nejsou otevřené.',
            'ended' => 'Tento turnaj je uzavřený. Pro výsledky navštiv informační stránku.',
            'registration_closed' => 'Registrace pro tento turnaj jsou ukončené. Poslední aktualizace najdeš na informační stránce.',
            'running' => 'Tento turnaj zrovna probíhá. Navštiv informační stránku pro více informací.',
        ],
    ],
    'tournament_period' => ':stars do :end',
];
