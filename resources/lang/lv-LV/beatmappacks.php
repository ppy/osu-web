<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

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
        'no_diff_reduction' => [
            '_' => '',
            'link' => '',
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
