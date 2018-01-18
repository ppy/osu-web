<?php

/**
 *    Copyright 2015-2017 ppy Pty. Ltd.
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
    'availability' => [
        'disabled' => 'Diese Beatmap steht momentan nicht zum Download zur Verfügung.',
        'parts-removed' => 'Teile dieser Beatmap wurden auf Anfrage eines Rechteinhabers entfernt.',
        'more-info' => 'Siehe hier für mehr Informationen.',
    ],

    'index' => [
        'title' => 'Beatmaps: Liste',
        'guest_title' => 'Beatmaps',
    ],

    'show' => [
        'discussion' => 'Diskussion',

        'details' => [
            'made-by' => 'erstellt von ',
            'submitted' => 'eingereicht an ',
            'updated' => 'letztes update an ',
            'ranked' => '<ranked> an ',
            'approved' => '<approved> an ',
            'qualified' => '<qualifziert> an ',
            'loved' => '<loved> on ',
            'logged-out' => 'Zum Herunterladen von Beatmaps muss man eingeloggt sein!',
            'download' => [
                '_' => 'Download',
                'video' => 'mit Video',
                'no-video' => 'ohne Video',
                'direct' => 'osu!direct',
            ],
            'favourite' => 'Dieses Beatmapset zu deinen Favoriten hinzufügen',
            'unfavourite' => 'Dieses Beatmapset von deinen Favoriten entfernen',
            'favourited_count' => '+ 1 other!|+ :count others!',
        ],
        'stats' => [
            'cs' => 'Circle Size',
            'cs-mania' => 'Tastenanzahl',
            'drain' => 'HP Drain',
            'accuracy' => 'Genauigkeit',
            'ar' => 'Approach Rate',
            'stars' => 'Star Difficulty',
            'total_length' => 'Länge',
            'bpm' => 'BPM',
            'count_circles' => 'Circle-Anzahl',
            'count_sliders' => 'Slider-Anzahl',
            'user-rating' => 'Benutzerbewertungen',
            'rating-spread' => 'Bewertungsverteilung',
        ],
        'info' => [
            'no_scores' => 'Unranked beatmap',
            'points-of-failure' => 'Points of Failure',
            'success-rate' => 'Erfolgsrate',

            'description' => 'Beschreibung',

            'source' => 'Quelle',
            'tags' => 'Tags',
        ],
        'scoreboard' => [
            'achieved' => 'erreicht am :when',
            'country' => 'Länder-Rangliste',
            'friend' => 'Freundes-Rangliste',
            'global' => 'Globale Rangliste',
            'miss_count' => ':count miss',
            'supporter-link' => '<a href=":link">Hier</a> klicken, um alle tollen Features zu entdecken!',
            'supporter-only' => 'Du musst Supporter sein, um Freundes- und Länderranglisten zu sehen!',
            'title' => 'Ranglisten',

            'list' => [
                'accuracy' => 'Genauigkeit',
                'player-header' => 'Spieler',
                'rank-header' => 'Rang',
                'score' => 'Punktzahl',
            ],
            'no_scores' => [
                'country' => 'Niemand in deinem Land hat einen Rang auf dieser Beatmap!',
                'friend' => 'Keiner deiner Freunde hat einen Rang auf dieser Beatmap!',
                'global' => 'Noch niemand auf der Rangliste. Wie wärs?',
                'loading' => 'Lade Ränge...',
                'unranked' => 'Nicht <ranked> Beatmap.',
            ],
            'score' => [
                'first' => 'An der Spitze',
                'own' => 'Dein bester Rang',
            ],
            'stats' => [
                'accuracy' => 'Genauigkeit',
                'combo' => 'Combo',
                'misses' => 'Miss',
                'score' => 'Punktzahl',
            ],
        ],
    ],
];
