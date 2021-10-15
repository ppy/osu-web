<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'availability' => [
        'disabled' => 'Diese Beatmap steht momentan nicht zum Herunterladen zur Verfügung.',
        'parts-removed' => 'Teile dieser Beatmap wurden auf Anfrage des Erstellers oder eines Rechteinhabers entfernt.',
        'more-info' => 'Siehe hier für mehr Informationen.',
        'rule_violation' => 'Einige in dieser Beatmap enthaltene Assets wurden entfernt, nachdem sie als nicht für die Verwendung in osu! geeignet eingestuft worden waren.',
    ],

    'download' => [
        'limit_exceeded' => 'Nur langsam, spiel mehr.',
    ],

    'featured_artist_badge' => [
        'label' => 'Featured artist',
    ],

    'index' => [
        'title' => 'Beatmaps: Liste',
        'guest_title' => 'Beatmaps',
    ],

    'panel' => [
        'empty' => 'keine beatmaps',

        'download' => [
            'all' => 'herunterladen',
            'video' => 'mit Video herunterladen',
            'no_video' => 'ohne Video herunterladen',
            'direct' => 'in osu!direct öffnen',
        ],
    ],

    'nominate' => [
        'hybrid_requires_modes' => 'Für ein Hybrid-Beatmapset musst du mindestens einen Spielmodus auswählen, für den du nominieren möchtest.',
        'incorrect_mode' => 'Du hast keine Berechtigung, für diesen Modus zu nominieren: :mode',
        'full_bn_required' => 'Du musst ein vollwertiger Nominator sein, um diese qualifizierende Nominierung durchzuführen.',
        'too_many' => 'Nominierungsvoraussetzung bereits erfüllt.',

        'dialog' => [
            'confirmation' => 'Bist du sicher, dass du diese Beatmap nominieren möchtest?',
            'header' => 'Beatmap nominieren',
            'hybrid_warning' => 'hinweis: du kannst nur einmal nominieren, also stelle bitte sicher, dass du für alle spielmodi nominierst, die du beabsichtigst',
            'which_modes' => 'Für welche Modi nominieren?',
        ],
    ],

    'nsfw_badge' => [
        'label' => 'Explizit',
    ],

    'show' => [
        'discussion' => 'Diskussion',

        'details' => [
            'by_artist' => 'von :artist',
            'favourite' => 'Dieses Beatmapset zu deinen Favoriten hinzufügen',
            'favourite_login' => 'Melde dich an, um diese Beatmap zu favorisieren',
            'logged-out' => 'Zum Herunterladen von Beatmaps muss man eingeloggt sein!',
            'mapped_by' => 'erstellt von :mapper',
            'unfavourite' => 'Dieses Beatmapset von deinen Favoriten entfernen',
            'updated_timeago' => 'zuletzt aktualisiert :timeago',

            'download' => [
                '_' => 'Herunterladen',
                'direct' => '',
                'no-video' => 'ohne Video',
                'video' => 'mit Video',
            ],

            'login_required' => [
                'bottom' => 'für mehr Features',
                'top' => 'Einloggen',
            ],
        ],

        'details_date' => [
            'approved' => 'approved :timeago',
            'loved' => 'loved :timeago',
            'qualified' => 'qualifiziert :timeago',
            'ranked' => 'ranked :timeago',
            'submitted' => 'hochgeladen :timeago',
            'updated' => 'zuletzt aktualisiert :timeago',
        ],

        'favourites' => [
            'limit_reached' => 'Du hast zu viele favorisierte Beatmaps! Bitte entferne welche, bevor du es nochmal versuchst.',
        ],

        'hype' => [
            'action' => 'Wenn es dir Spaß gemacht hat, diese Map zu spielen, dann hype sie, um bei ihrem Fortschritt zum <strong>Ranked</strong>-Status zu helfen.',

            'current' => [
                '_' => 'Die Map ist zurzeit :status.',

                'status' => [
                    'pending' => 'ausstehend',
                    'qualified' => 'qualifiziert',
                    'wip' => 'work-in-progress',
                ],
            ],

            'disqualify' => [
                '_' => 'Wenn du ein Problem mit dieser Beatmap findest, disqualifiziere diese bitte :link.',
            ],

            'report' => [
                '_' => 'Wenn du ein Problem mit dieser Beatmap findest, melde es bitte :link, um das Team zu informieren.',
                'button' => 'Problem melden',
                'link' => 'hier',
            ],
        ],

        'info' => [
            'description' => 'Beschreibung',
            'genre' => 'Genre',
            'language' => 'Sprache',
            'no_scores' => 'Die Daten werden noch verarbeitet...',
            'nsfw' => 'Expliziter Inhalt',
            'points-of-failure' => 'Stellen, an denen Spieler gescheitert sind',
            'source' => 'Quelle',
            'storyboard' => 'Diese Beatmap enthält ein Storyboard',
            'success-rate' => 'Erfolgsrate',
            'tags' => 'Tags',
            'video' => 'Diese Beatmap enthält ein Video',
        ],

        'nsfw_warning' => [
            'details' => 'Diese Beatmap enthält explizite, anstößige oder verstörende Inhalte. Möchtest du sie trotzdem sehen?',
            'title' => 'Expliziter Inhalt',

            'buttons' => [
                'disable' => 'Warnung deaktivieren',
                'listing' => 'Beatmap-Auflistung',
                'show' => 'Anzeigen',
            ],
        ],

        'scoreboard' => [
            'achieved' => 'erreicht :when',
            'country' => 'Landesrangliste',
            'friend' => 'Freundesrangliste',
            'global' => 'Globale Rangliste',
            'supporter-link' => '<a href=":link">Hier</a> klicken, um alle tollen Features zu entdecken!',
            'supporter-only' => 'Du musst Supporter sein, um Freundes- und Landesranglisten zu sehen!',
            'title' => 'Ranglisten',

            'headers' => [
                'accuracy' => 'Genauigkeit',
                'combo' => 'Combo',
                'miss' => 'Miss',
                'mods' => 'Mods',
                'player' => 'Spieler',
                'pp' => '',
                'rank' => 'Rang',
                'score_total' => 'Gesamtpunktzahl',
                'score' => 'Punktzahl',
                'time' => 'Zeit',
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

        'status' => [
            'ranked' => 'Ranked',
            'approved' => 'Approved',
            'loved' => 'Loved',
            'qualified' => 'Qualifiziert',
            'wip' => 'WIP',
            'pending' => 'Ausstehend',
            'graveyard' => 'Friedhof',
        ],
    ],
];
