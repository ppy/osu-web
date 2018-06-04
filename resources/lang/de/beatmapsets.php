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
    'availability' => [
        'disabled' => 'Diese Beatmap steht momentan nicht zum Herunterladen zur Verfügung.',
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
            'mapped_by' => 'erstellt von :mapper',
            'submitted' => 'eingereicht am ',
            'updated' => 'letztes update am ',
            'updated_timeago' => 'zuletzt aktualisiert :timeago',
            'ranked' => 'ranked am ',
            'approved' => 'approved am ',
            'qualified' => 'qualifziert am ',
            'loved' => 'loved am ',
            'logged-out' => 'Zum Herunterladen von Beatmaps muss man eingeloggt sein!',
            'download' => [
                '_' => 'Herunterladen',
                'video' => 'mit Video',
                'no-video' => 'ohne Video',
                'direct' => 'osu!direct',
            ],
            'favourite' => 'Dieses Beatmapset zu deinen Favoriten hinzufügen',
            'unfavourite' => 'Dieses Beatmapset von deinen Favoriten entfernen',
            'favourited_count' => '+ 1 anderer!|+ :count andere!',
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
            'nominations' => 'Nominierungen',
            'playcount' => 'Playcount',
        ],
        'info' => [
            'description' => 'Beschreibung',
            'genre' => 'Genre',
            'language' => 'Sprache',
            'no_scores' => 'Die Daten werden noch verarbeitet...',
            'points-of-failure' => 'Stellen, an denen Spieler gescheitert sind',
            'source' => 'Quelle',
            'success-rate' => 'Erfolgsrate',
            'tags' => 'Tags',
            'unranked' => 'Unranked beatmap',
        ],
        'scoreboard' => [
            'achieved' => 'erreicht am :when',
            'country' => 'Länder-Rangliste',
            'friend' => 'Freundes-Rangliste',
            'global' => 'Globale Rangliste',
            'supporter-link' => '<a href=":link">Hier</a> klicken, um alle tollen Features zu entdecken!',
            'supporter-only' => 'Du musst Supporter sein, um Freundes- und Länderranglisten zu sehen!',
            'title' => 'Ranglisten',

            'headers' => [
                'accuracy' => 'Genauigkeit',
                'combo' => 'Combo',
                'miss' => 'Miss',
                'mods' => 'Mods',
                'player' => 'Spieler',
                'pp' => 'pp',
                'rank' => 'Rang',
                'score_total' => 'Gesamtpunktzahl',
                'score' => 'Punktzahl',
            ],

            'no_scores' => [
                'country' => 'Niemand in deinem Land hat einen Rang auf dieser Beatmap!',
                'friend' => 'Keiner deiner Freunde hat einen Rang auf dieser Beatmap!',
                'global' => 'Noch niemand auf der Rangliste. Wie wärs?',
                'loading' => 'Lade Ränge...',
                'unranked' => 'Unranked Beatmap.',
            ],
            'score' => [
                'first' => 'An der Spitze',
                'own' => 'Dein bester Rang',
            ],
        ],
    ],
];
