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
        'small' => 'Konkurrer i flere måter enn bare å trykke på sirkler.',
        'large' => 'Fellesskapskonkurranser',
    ],

    'index' => [
        'nav_title' => '',
    ],

    'voting' => [
        'over' => 'Avstemmingen for denne konkurransen har avsluttet',
        'login_required' => 'Vennligst logg inn for å stemme.',

        'best_of' => [
            'none_played' => "Det ser ikke ut som du har spilt noen av beatmappene som kvaliseres for denne konkurransen!",
        ],

        'button' => [
            'add' => 'Stem',
            'remove' => 'Fjern stemme',
            'used_up' => 'Du har brukt opp alle stemmene dine',
        ],
    ],
    'entry' => [
        '_' => 'deltager',
        'login_required' => 'Vennligst logg inn for å delta i konkurransen.',
        'silenced_or_restricted' => 'Du kan ikke bli med i konkurranser mens du er begrenset eller stum.',
        'preparation' => 'Vi driver for tiden å forbereder denne konkurransen. Vennligst vent tålmodig!',
        'over' => 'Takk for dine bidrag! Påmeldingen for denne konkurransen har stengt og avstemningen vil åpne snart.',
        'limit_reached' => 'Du har nådd maks antall bidrag for denne konkurransen',
        'drop_here' => 'Slipp bidraget ditt her',
        'download' => 'Last ned .osz',
        'wrong_type' => [
            'art' => 'Bare .jpg og .png filer er akseptert for denne konkurransen.',
            'beatmap' => 'Bare .osu filer er akseptert for denne konkurransen.',
            'music' => 'Bare .mp3 filer er akseptert for denne konkurransen.',
        ],
        'too_big' => 'Bidrag til denne konkurransen kan maks være :limit.',
    ],
    'beatmaps' => [
        'download' => 'Last ned bidraget',
    ],
    'vote' => [
        'list' => 'stemmer',
        'count' => ':count_delimited stemme|:count_delimited stemmer',
        'points' => ':count_delimited poeng|:count_delimited poeng',
    ],
    'dates' => [
        'ended' => 'Avsluttet :date',

        'starts' => [
            '_' => 'Starter :date',
            'soon' => 'snart™',
        ],
    ],
    'states' => [
        'entry' => 'Påmelding åpen',
        'voting' => 'Avstemningen har begynt',
        'results' => 'Resultat er ute',
    ],
];
