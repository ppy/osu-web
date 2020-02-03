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
        'small' => 'Concurează în mai multe moduri decât doar făcând clic pe cercuri.',
        'large' => 'Concursuri comunitare',
    ],

    'index' => [
        'nav_title' => '',
    ],

    'voting' => [
        'over' => 'Votarea pentru acest concurs s-a încheiat',
        'login_required' => 'Te rugăm să te autentifici pentru a vota.',

        'best_of' => [
            'none_played' => "Nu pare să fi jucat niciun beatmap care se califică pentru acest concurs!",
        ],

        'button' => [
            'add' => 'Votează',
            'remove' => 'Retrage votul',
            'used_up' => 'Ți-ai folosit toate voturile',
        ],
    ],
    'entry' => [
        '_' => 'intrare',
        'login_required' => 'Te rugăm să te conectezi pentru a intra în concurs.',
        'silenced_or_restricted' => 'Nu poți participa la concursuri în timp ce ești restricționat sau amuțit.',
        'preparation' => 'Pregătim acest concurs în prezent. Te rugăm să aștepți cu răbdare!',
        'over' => 'Îți mulțumim pentru intrările tale! Înscrierile s-au închis pentru acest concurs și votarea se va deschide în curând.',
        'limit_reached' => 'Ai atins limita de intrări în acest concurs',
        'drop_here' => 'Trage intrarea ta aici',
        'download' => 'Descarcă .osz',
        'wrong_type' => [
            'art' => 'Numai fișierele de tip .jpg și .png sunt acceptate pentru acest concurs.',
            'beatmap' => 'Numai fișierele de tip .osu sunt acceptate pentru acest concurs.',
            'music' => 'Numai fișierele de tip .mp3 sunt acceptate pentru acest concurs.',
        ],
        'too_big' => 'Întrările pentru acest concurs pot fi numai până la :limit.',
    ],
    'beatmaps' => [
        'download' => 'Descarcă intrarea',
    ],
    'vote' => [
        'list' => 'voturi',
        'count' => ':count vot|:count voturi|:count de voturi',
        'points' => ':count punct|:count puncte|:count de puncte',
    ],
    'dates' => [
        'ended' => 'S-a terminat pe :date',

        'starts' => [
            '_' => 'Începe pe :date',
            'soon' => 'curând™',
        ],
    ],
    'states' => [
        'entry' => 'Inscriere deschisă',
        'voting' => 'Votarea a început',
        'results' => 'Rezultate postate',
    ],
];
