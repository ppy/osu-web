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
        'description' => 'אוספים ארוזים מראש של beatmaps המבוססים סביב נושא משותף.',
        'nav_title' => '',
        'title' => 'חבילות Beatmap',

        'blurb' => [
            'important' => 'קרא את זה לפני שאתה מוריד',
            'instruction' => [
                '_' => "התקנה: לאחר שהורדת חבילה, חלץ את קובץ ה- .rar לתוך תיקיית Songs של osu!.
כל השירים עדיין מכווצים כ- .zip ו/או .osz בתוך החבילה, לכן osu! יצטרך לחלץ את ה- beatmaps בעצמו בפעם הבאה שתיכנס למצב Play.
:scary תחלץ את קבצי ה- .zip/.osz בעצמך,
או שה- beatmaps יופיעו באופן שגוי בתוך osu! ולא יפעלו כראוי.",
                'scary' => 'אל',
            ],
            'note' => [
                '_' => 'שימו לב שמומלץ מאוד ל- :scary, מאחר והמפות הישנות ביותר הן באיכות הרבה יותר נמוכה מאשר המפות האחרונות.',
                'scary' => 'הורד את החבילות מהאחרונות למוקדמות',
            ],
        ],
    ],

    'show' => [
        'download' => 'הורד',
        'item' => [
            'cleared' => 'סוים בהצלחה',
            'not_cleared' => 'לא סוים בהצלחה',
        ],
    ],

    'mode' => [
        'artist' => 'אמן\אלבום',
        'chart' => 'Spotlights',
        'standard' => 'רגיל',
        'theme' => 'ערכת נושא',
    ],

    'require_login' => [
        '_' => 'אתה צריך להיות :link כדי להוריד',
        'link_text' => 'מחובר',
    ],
];
