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
        'description' => 'Iepriekš pakotas bītmapju kolekcijas ir pamatā balstītas uz kopīgu tēmu.',
        'nav_title' => '',
        'title' => 'Bītmapju Pakas',

        'blurb' => [
            'important' => 'IZLASIET PIRMS LEJUPLĀDĒJIET',
            'instruction' => [
                '_' => "Uzstādīšana: Līdz ko fails tiks lejuplādēts, atvērsiet .rar failu iekš jūsu osu! Dziesmu sadaļā.                     Visas dziesmas joprojām ir .zip un/vai .osz formātā, tādēļ osu! būs nepieciešams atvērt bītmapes nākamajā reizē, kad tiks palaista spēle.                     :scary izvelc.zip/.osz failus pats                   , vai arī bītmapes var rādīties kļūdainas un var nefunkcionēt pareizi.",
                'scary' => 'Nekādā gadījumā',
            ],
            'note' => [
                '_' => 'Ir vērts atcerēties :scary, jo vecās mapes ir daudz zemākas kvalitātes kā lielākā daļa jauno mapju.',
                'scary' => 'lejuplādēt pakas secībā no jaunākajām līdz vecākajām',
            ],
        ],
    ],

    'show' => [
        'download' => 'Lejuplādēt',
        'item' => [
            'cleared' => 'nokārtots',
            'not_cleared' => 'nav nokārtots',
        ],
    ],

    'mode' => [
        'artist' => 'Izpildītājs/Albums',
        'chart' => 'Uzmanības centrā',
        'standard' => 'Standarts',
        'theme' => 'Tēma',
    ],

    'require_login' => [
        '_' => 'Jums ir nepieciešama :link lai lejuplādētu',
        'link_text' => 'ierakstījies',
    ],
];
