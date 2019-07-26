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
        'title' => 'Balíky beatmáp',
        'description' => 'Kolekcie beatmáp s podobnou tématikou.',
    ],

    'show' => [
        'download' => 'Stiahnúť',
        'item' => [
            'cleared' => 'splnené',
            'not_cleared' => 'nesplnené',
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
