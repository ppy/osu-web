<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'index' => [
        'description' => 'Kolekcie beatmáp s podobnou tématikou.',
        'nav_title' => 'výpis',
        'title' => 'Balíky beatmáp',

        'blurb' => [
            'important' => 'PREČÍTAJTE SI PRED SŤAHOVANÍM',
            'install_instruction' => 'Inštalácia: Keď bol nainštalovaný balíček, extrahujte vnútro balíčka do osu! Songs zložky a osu! urobí zbytok.',
            'note' => [
                '_' => 'Taktiež je veľmi odporúčané :scary, keďže staré mapy sú oveľa menej kvalitné v porovnaní s tými nedávnymi.',
                'scary' => 'sťahovať balíky od najnovších po najstaršie',
            ],
        ],
    ],

    'show' => [
        'download' => 'Stiahnúť',
        'item' => [
            'cleared' => 'splnené',
            'not_cleared' => 'nesplnené',
        ],
        'no_diff_reduction' => [
            '_' => ':link nemôže byť použiť k vyčistení tohoto balíčku.',
            'link' => 'Módy k redukovanie obtiažnosti ',
        ],
    ],

    'mode' => [
        'artist' => 'Interpret/Album',
        'chart' => 'Oslňujúce',
        'standard' => 'Obyčajné',
        'theme' => 'Témy',
    ],

    'require_login' => [
        '_' => 'Aby ste mohli sťahovať musíte byť :link',
        'link_text' => 'prihlásený',
    ],
];
