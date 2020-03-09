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
    'header' => [
        'small' => 'תתחרה בדרכים נוספות חוץ מרק ללחוץ על עיגולים.',
        'large' => 'תחרויות קהילה',
    ],

    'index' => [
        'nav_title' => '',
    ],

    'voting' => [
        'over' => 'הצבעה לתחרות זו הסתיימה',
        'login_required' => 'אנא התחבר כדי להצביע.',

        'best_of' => [
            'none_played' => "זה לא נראה ששיחקת מפות כלשהן שמועמדות לתחרות זו!",
        ],

        'button' => [
            'add' => 'הצבע',
            'remove' => 'הסר הצבעה',
            'used_up' => 'השתמשת בכל ההצבעות שלך',
        ],
    ],
    'entry' => [
        '_' => 'ערך',
        'login_required' => 'נא התחבר כדי להיכנס לתחרות.',
        'silenced_or_restricted' => 'אינך יכול להיכנס לתחרויות כאשר אתה מוגבל או מושתק.',
        'preparation' => 'אנו כרגע מכינים תחרות זאת. נא חכה בסבלנות!',
        'over' => 'תודה על השליחות שלכם! שליחות נסגרו לתחרות זו והצבעה תיפתח בקרוב.',
        'limit_reached' => 'הגעת למגבלת השליחות שלך לתחרות זו',
        'drop_here' => 'זרוק את שליחתך לפה',
        'download' => 'הורד .osz',
        'wrong_type' => [
            'art' => 'רק קבצי .jpg ו- .png מתקבלים לתחרות זו.',
            'beatmap' => 'רק קבצי .osu מתקבלים לתחרות זו.',
            'music' => 'רק קבצי .mp3 מתקבלים לתחרות זו.',
        ],
        'too_big' => 'שליחות לתחרות זו יכולות להיות עד :limit.',
    ],
    'beatmaps' => [
        'download' => 'הורד שליחה',
    ],
    'vote' => [
        'list' => 'הצבעות',
        'count' => ':count_delimited הצבעה|:count_delimited הצבעות',
        'points' => ':count_delimited נקודה|:count_delimited נקודות',
    ],
    'dates' => [
        'ended' => 'נגמר ב- :date',

        'starts' => [
            '_' => 'מתחיל ב- :date',
            'soon' => 'בקרוב™',
        ],
    ],
    'states' => [
        'entry' => 'שליחה פתוחה',
        'voting' => 'הצבעה התחילה',
        'results' => 'תוצאות',
    ],
];
