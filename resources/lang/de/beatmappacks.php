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
