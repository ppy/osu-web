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
            'instruction' => [
                '_' => "Inštalácia: Akonáhle je balík stiahnutý, rozbaľte .rar súbor do priečinku s osu! skladbami.
Skladby vnútri balíka sú stále v .zip a/alebo .osz formáte, takže osu! si bude musieť beatmapy rozbaliť, keď nabudúce začnete hrať.
:scary extrahujte .zip/.osz súbory sami,
lebo sa budú beatmapy v osu! zobrazovať nesprávne a nebudú poriadne fungovať.",
                'scary' => 'NE',
            ],
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
            '_' => '',
            'link' => '',
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
