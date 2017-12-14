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
    'index' => [
        'blurb' => [
            'important' => 'LÄS DETTA INNAN NEDLADDNING',
            'instruction' => [
                '_' => 'Installation: När en samling har laddats ner, extrahera .rar filen in till din osu! Songs mapp.
                    Alla sånger är fortfarande .zip/.osz inne i samlingen, så osu! kommer behöva extrahera beatmapsen nästa gång du går in i Spel läget.
                    Extrahera :scary .zip/.osz själv,
                    för då kommer beatmapsen visas inkorrekt och kommer inte fungera korrekt.',
                'scary' => 'INTE',
            ],
            'note' => [
                '_' => 'Att tänka på något som är högt rekommenderat är att :scary, eftersom dem äldsta mapsen är av mycket lägre kvalité jämfört med dem nyaste mapsen.',
                'scary' => 'ladda ner samlingarna från senaste till tidigaste',
            ],
        ],
        'title' => 'Beatmap Samling',
        'description' => 'För-samlade kollektioner av beatmaps baserad på ett gemensamt tema.',
    ],

    'show' => [
        'download' => 'Ladda ner',
        'item' => [
            'cleared' => 'rensad',
            'not_cleared' => 'ej rensad',
        ],
    ],

    'mode' => [
        'artist' => 'Artist/Album',
        'chart' => 'Diagram',
        'standard' => 'Standard',
        'theme' => 'Tema',
    ],

    'require_login' => [
        '_' => 'Du behöver vara :link för att ladda ner',
        'link_text' => 'inloggad',
    ],
];
