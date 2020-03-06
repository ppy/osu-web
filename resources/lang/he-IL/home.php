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
    'landing' => [
        'download' => 'הורד עכשיו',
        'online' => '<strong>:players</strong> כרגע מחוברים ב- <strong>:games</strong> משחקים',
        'peak' => 'שיא, :count משתמשים מחוברים',
        'players' => '<strong>:count</strong> משתמשים רשומים',
        'title' => 'ברוך הבא',
        'see_more_news' => '',

        'slogan' => [
            'main' => 'משחק הקצב החינמי הכי טוב',
            'sub' => 'קצב הוא רק במרחק לחיצה',
        ],
    ],

    'search' => [
        'advanced_link' => 'חיפוש מתקדם',
        'button' => 'חיפוש',
        'empty_result' => 'לא נמצא דבר!',
        'keyword_required' => '',
        'placeholder' => 'הקלד לחיפוש',
        'title' => 'חיפוש',

        'beatmapset' => [
            'login_required' => '',
            'more' => ':count יותר תוצאות חיפוש מפה',
            'more_simple' => 'ראה עוד תוצאות חיפוש מפה',
            'title' => 'מפות',
        ],

        'forum_post' => [
            'all' => 'כל הפורומים',
            'link' => 'חפש פורום',
            'login_required' => '',
            'more_simple' => 'ראה עוד תוצאות חיפוש פורום',
            'title' => 'פורום',

            'label' => [
                'forum' => 'חפש בפורומים',
                'forum_children' => 'כלול תתי פורום',
                'topic_id' => 'מספר נושא',
                'username' => 'מחבר',
            ],
        ],

        'mode' => [
            'all' => 'הכל',
            'beatmapset' => 'ביטמאפ',
            'forum_post' => 'פורום',
            'user' => 'שחקן',
            'wiki_page' => 'וויקי',
        ],

        'user' => [
            'login_required' => '',
            'more' => ':count יותר תוצאות חיפוש שחקנים',
            'more_simple' => 'ראה עוד תוצאות חיפוש שחקנים',
            'more_hidden' => 'חיפוש שחקנים מוגבל ל- :max שחקנים. נסה לשפר את הגדרות החיפוש.',
            'title' => 'שחקנים',
        ],

        'wiki_page' => [
            'link' => 'חפש ויקי',
            'more_simple' => 'ראה עוד תוצאות חיפוש ויקי',
            'title' => 'ויקי',
        ],
    ],

    'download' => [
        'tagline' => "בוא<br>נתחיל!",
        'action' => 'הורד osu!',
        'os' => [
            'windows' => 'עבור Windows',
            'macos' => 'עבור macOS',
            'linux' => 'עבור Linux',
        ],
        'mirror' => 'מראה',
        'macos-fallback' => 'משתמשי macOS',
        'steps' => [
            'register' => [
                'title' => 'השג חשבון',
                'description' => 'עקוב אחר ההנחיות בתחילת המשחק כדי להתחבר או ליצור משתמש חדש',
            ],
            'download' => [
                'title' => 'הורד את המשחק',
                'description' => 'לחץ על הכפתור למעלה כדי להוריד את ההתקנה, ואז הפעל אותה!',
            ],
            'beatmaps' => [
                'title' => 'השג מפות',
                'description' => [
                    '_' => ':browse את הספריה הנרחבת של מפות שנוצרו על ידי משתמשים והתחל לשחק!',
                    'browse' => 'עיין',
                ],
            ],
        ],
        'video-guide' => 'מדריך וידאו',
    ],

    'user' => [
        'title' => 'לוח',
        'news' => [
            'title' => 'חדשות',
            'error' => 'שגיאה בטעינת החדשות, נסה לרענן את הדף?...',
        ],
        'header' => [
            'stats' => [
                'friends' => 'חברים מחוברים',
                'games' => 'משחקים',
                'online' => 'משתמשים מחוברים',
            ],
        ],
        'beatmaps' => [
            'new' => 'מפות מדורגות חדשות',
            'popular' => 'מפות פופולריות',
            'by_user' => '',
        ],
        'buttons' => [
            'download' => 'הורד את osu!',
            'support' => 'תמוך ב- osu!',
            'store' => 'חנות osu!',
        ],
    ],

    'support-osu' => [
        'title' => 'וואו!',
        'subtitle' => 'נראה שאתה נהנה! D:',
        'body' => [
            'part-1' => 'האם ידעת ש- osu! פועל ללא פרסומות, ומסתמך על שחקנים לתמיכה של הפיתוח ועלויות הריצה שלו?',
            'part-2' => 'האם גם ידעת שעל ידי תמיכה ב- osu! אתה מקבל ערימה של פיצ\'רים שימושיים, כגון <strong>הורדה בתוך המשחק</strong> שמופעלת אוטומטית כאשר אתה צופה במישהו או במשחק מרובה משתתפים?',
        ],
        'find-out-more' => 'לחץ כאן כדי לגלות עוד!',
        'download-starting' => "אה, ואל תדאג - ההורדה שלך כבר התחילה בשבילך ;)",
    ],
];
