<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'index' => [
        'description' => 'Fertig gepackte Sammlungen an Beatmaps, die auf einem gemeinsamen Thema basieren.',
        'nav_title' => 'liste',
        'title' => 'Beatmap-Pakete',

        'blurb' => [
            'important' => 'VOR DEM HERUNTERLADEN BITTE LESEN',
            'instruction' => [
                '_' => "Installation: Sobald das Paket heruntergeladen wurde, entpacke das .rar-Archiv in dein osu! \"Songs\"-Verzeichnis.
                    Alle Lieder sind innerhalb des Pakets noch einmal als .zip oder .osz-Archiv verpackt, deshalb muss osu! die Beatmaps beim nächsten Start noch einmal entpacken.
                    Entpacke die .zip/.osz-Dateien :scary selbst,
                    oder die Beatmaps werden in osu! nicht richtig funktionieren.",
                'scary' => 'NICHT',
            ],
            'note' => [
                '_' => 'Außerdem ist es sehr empfehlenswert, :scary, weil die älteren Beatmaps qualitativ wesentlich schlechter sind als aktuellere Beatmaps.',
                'scary' => 'die neuesten Pakete zuerst herunterzuladen',
            ],
        ],
    ],

    'show' => [
        'download' => 'Download',
        'item' => [
            'cleared' => 'geschafft',
            'not_cleared' => 'nicht geschafft',
        ],
        'no_diff_reduction' => [
            '_' => ':link darf zum Absolvieren dieses Pakets nicht verwendet werden.',
            'link' => 'Schwierigkeitsverringerungsmods',
        ],
    ],

    'mode' => [
        'artist' => 'Künstler/Album',
        'chart' => 'Im Spotlight',
        'standard' => 'Standard',
        'theme' => 'Thema',
    ],

    'require_login' => [
        '_' => 'Zum Herunterladen muss man :link sein',
        'link_text' => 'eingeloggt',
    ],
];
