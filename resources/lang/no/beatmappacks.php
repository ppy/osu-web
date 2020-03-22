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
        'description' => 'Forhåndspakkede samlinger av beatmaps basert rundt et felles tema.',
        'nav_title' => '',
        'title' => 'Beatmappakker',

        'blurb' => [
            'important' => 'LES DETTE FØR NEDLASTING',
            'instruction' => [
                '_' => "Installasjon: Pakk ut .rar filen i osu!'s \"Songs\" mappe når en pakke er lastet ned,
                    Alle sanger i pakken er fortsatt i filformatet .zip og/eller .osz, så osu! vil pakke dem ut automatisk neste gang du spiller.
                    :scary pakk ut zip/osz filene selv,
                    ettersom dette kan medføre til at beatmappene ikke vises eller fungerer riktig i osu!",
                'scary' => 'ALDRI',
            ],
            'note' => [
                '_' => 'Legg også merke til at det er sterkt anbefalt å :scary, ettersom de eldste mappene er av mye lavere kvalitet enn de fleste nye maps.',
                'scary' => 'laste ned de nye pakkene først',
            ],
        ],
    ],

    'show' => [
        'download' => 'Last ned',
        'item' => [
            'cleared' => 'fullført',
            'not_cleared' => 'ikke fullført',
        ],
    ],

    'mode' => [
        'artist' => 'Artist/Album',
        'chart' => 'I rampelyset',
        'standard' => 'Standard',
        'theme' => 'Tema',
    ],

    'require_login' => [
        '_' => 'Du må være :link for å laste ned',
        'link_text' => 'logget inn',
    ],
];
