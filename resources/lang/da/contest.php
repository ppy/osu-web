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
        'small' => 'Konkurrér på flere måder end bare at klikke på cirkler.',
        'large' => '',
    ],
    'voting' => [
        'over' => 'Afstemning for denne konkurrence er sluit',
        'login_required' => 'Log venligst ind for at stemme.',
        'best_of' => [
            'none_played' => "Det ser ikke ud som om, at du har spillet nogle beatmaps, som kvalificerer sig til denne konkurrence!",
        ],
    ],
    'entry' => [
        '_' => 'entry',
        'login_required' => 'Log venligst ind for at deltage i denne konkurrence.',
        'silenced_or_restricted' => 'Du kan ikke deltage i konkurrencer, når du er mutet eller begrænset.',
        'preparation' => 'Vi er i gang med at forberede den næste konkurrence. Vær tålmodig!',
        'over' => 'Tak for jeres bidrag! Indsendelsen for denne konkurrence er slut, og afstemning vil finde sted snarest!.',
        'limit_reached' => 'Du har nået dit maksimale antal bidrag for denne konkurrence',
        'drop_here' => 'Aflever dit bidrag her',
        'wrong_type' => [
            'art' => 'Kun .jpg og .png filer er accepteret i denne konkurrence.',
            'beatmap' => 'Kun .osu filer er accepteret i denne konkurrence.',
            'music' => 'Kun .mp3 filer er accepteret i denne konkurrence.',
        ],
        'too_big' => 'Bidrag til denne konkurrence kan maks være op til :limit.',
    ],
    'beatmaps' => [
        'download' => 'Download Bidrag',
    ],
    'vote' => [
        'list' => 'stemmer',
        'count' => '1 stemme|:count stemmer',
    ],
    'dates' => [
        'ended' => 'Sluttede den :date',

        'starts' => [
            '_' => 'Starter den :date',
            'soon' => 'snart™',
        ],
    ],
    'states' => [
        'entry' => 'Åbent For Bidrag',
        'voting' => 'Afstemning Begyndt',
        'results' => 'Resultaterne Er Ude',
    ],
];
