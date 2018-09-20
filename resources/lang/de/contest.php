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
        'small' => 'Tritt gegen mehr als nur Kreise an.',
        'large' => 'Community Wettbewerbe',
    ],
    'voting' => [
        'over' => 'Die Abstimmung für diesen Wettbewerb ist beendet',
        'login_required' => 'Zum Abstimmen bitte einloggen.',
        'best_of' => [
            'none_played' => "Es scheint, als hättest du keine der Beatmaps gespielt, die dich für den Wettbewerb qualifiziert hätten!",
        ],
    ],
    'entry' => [
        '_' => 'entry',
        'login_required' => 'Zum Beitreten bitte einloggen.',
        'silenced_or_restricted' => 'Man kann restricted oder stummgeschaltet nicht an Wettbewerben teilnehmen.',
        'preparation' => 'Wir bereiten diesen Wettbewerb gerade vor. Bitte habe Geduld!',
        'over' => 'Vielen Dank für eure Einsendungen! Der Einsendezeitraum ist vorbei, die Abstimmungen werden bald beginnen.',
        'limit_reached' => 'Du hast das Einsendelimit für diesen Wettbewerb erreicht',
        'drop_here' => 'Lege deine Einsendung hier ab',
        'wrong_type' => [
            'art' => 'Nur .jpg und .png-Dateien werden in diesem Wettbewerb akzeptiert.',
            'beatmap' => 'Nur .osu-Dateien werden in diesem Wettbewerb akzeptiert.',
            'music' => 'Nur .mp3-Dateien werden in diesem Wettbewerb akzeptiert.',
        ],
        'too_big' => 'Einsendungen in diesem Wettbewerb können nur bis zu :limit. groß sein',
    ],
    'beatmaps' => [
        'download' => 'Einsendung herunterladen',
    ],
    'vote' => [
        'list' => 'stimmen',
        'count' => '1 stimme|:count stimmen',
    ],
    'dates' => [
        'ended' => 'Endete am :date',

        'starts' => [
            '_' => 'Startet am :date',
            'soon' => 'soon™',
        ],
    ],
    'states' => [
        'entry' => 'Einsendungen offen',
        'voting' => 'Abstimmungen gestartet',
        'results' => 'Ergebnisse bekanntgegeben',
    ],
];
