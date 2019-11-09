<?php

/**
 *    Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
 *    See the LICENCE file in the repository root for full licence text.
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
            'approved' => 'approved am ',
            'favourite' => 'Dieses Beatmapset zu deinen Favoriten hinzufügen',
            'logged-out' => 'Zum Herunterladen von Beatmaps muss man eingeloggt sein!',
            'loved' => 'loved am ',
            'mapped_by' => 'erstellt von :mapper',
            'qualified' => 'qualifziert am ',
            'ranked' => 'ranked am ',
            'submitted' => 'eingereicht am ',
            'unfavourite' => 'Dieses Beatmapset von deinen Favoriten entfernen',
            'updated' => 'letztes update am ',
            'updated_timeago' => 'zuletzt aktualisiert :timeago',

            'download' => [
                '_' => 'Herunterladen',
                'direct' => 'osu!direct',
                'no-video' => 'ohne Video',
                'video' => 'mit Video',
            ],

            'login_required' => [
                'bottom' => 'für mehr Features',
                'top' => 'Einloggen',
            ],
        ],

        'favourites' => [
            'limit_reached' => 'Du hast zu viele favorisierte Beatmaps! Bitte entferne welche, bevor du es nochmal versuchst.',
        ],

        'hype' => [
            'action' => 'Wenn du es genossen hast diese Karte zu spielen, dann hype diese Karte, um beim Fortschritt zum <strong>Ranked</strong>-Status beizutragen.',

            'current' => [
                '_' => 'Die Map ist zurzeit :status.',

                'status' => [
                    'pending' => 'ausstehend',
                    'qualified' => 'qualifiziert',
                    'wip' => 'work-in-progress',
                ],
            ],

            'report' => [
                '_' => '',
                'button' => '',
                'button_title' => '',
                'link' => '',
            ],
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
            'achieved' => 'erreicht :when',
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
    ],
];
