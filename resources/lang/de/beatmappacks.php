<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'index' => [
        'description' => 'Fertig gepackte Sammlungen an Beatmaps, die auf einem gemeinsamen Thema basieren.',
        'empty' => 'Demnächst verfügbar!',
        'nav_title' => 'Liste',
        'title' => 'Beatmap-Packs',

        'blurb' => [
            'important' => 'VOR DEM HERUNTERLADEN BITTE LESEN',
            'install_instruction' => 'Installation: Sobald ein Beatmap-Pack heruntergeladen wurde, entpacke den Inhalt des Packs in dein osu! Songs-Verzeichnis und osu! wird den Rest erledigen.',
            'note' => [
                '_' => 'Außerdem ist es sehr empfehlenswert dir :scary, weil ältere Beatmaps eine geringere Qualität aufweisen als aktuellere Beatmaps.',
                'scary' => 'die neusten Beatmap-Packs zuerst herunterzuladen',
            ],
        ],
    ],

    'show' => [
        'download' => 'Herunterladen',
        'item' => [
            'cleared' => 'geschafft',
            'not_cleared' => 'nicht geschafft',
        ],
        'no_diff_reduction' => [
            '_' => ':link darf zum Absolvieren dieses Beatmap-Packs nicht verwendet werden.',
            'link' => 'Mods zur Vereinfachung der Schwierigkeit',
        ],
    ],

    'mode' => [
        'artist' => 'Künstler/Album',
        'chart' => 'Spotlights',
        'featured' => 'Featured Artist',
        'standard' => 'Standard',
        'theme' => 'Thema',
        'tournament' => 'Turnier',
    ],

    'require_login' => [
        '_' => 'Du musst :link sein, um dies herunterladen zu können',
        'link_text' => 'eingeloggt',
    ],
];
