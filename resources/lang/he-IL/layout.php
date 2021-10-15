<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'audio' => [
        'autoplay' => 'נגן את השיר הבא אוטומטית',
    ],

    'defaults' => [
        'page_description' => 'osu! - קצב הוא במרחק *לחיצה* אחת! עם Ouendan/EBA, Taiko ומצבי משחק מקוריים, בנוסף לעורך שלבים המתפקד במלואו.',
    ],

    'header' => [
        'admin' => [
            'beatmapset' => 'מפות',
            'beatmapset_covers' => 'כיסויי מפות',
            'contest' => 'תחרות',
            'contests' => 'תחרויות',
            'root' => 'קונסולה',
        ],

        'artists' => [
            'index' => 'רשימה',
        ],

        'changelog' => [
            'index' => 'רשימה',
        ],

        'help' => [
            'index' => 'אינדקס',
            'sitemap' => 'מפת אתר',
        ],

        'store' => [
            'cart' => 'עגלה',
            'orders' => 'היסטוריית הזמנות',
            'products' => 'מוצרים',
        ],

        'tournaments' => [
            'index' => 'רשימה',
        ],

        'users' => [
            'modding' => 'מודינג',
            'multiplayer' => '',
            'show' => 'מידע',
        ],
    ],

    'gallery' => [
        'close' => 'סגור (Esc)',
        'fullscreen' => 'החלף למסך מלא',
        'zoom' => 'התקרב / התרחק',
        'previous' => 'קודם (חץ שמאלה)',
        'next' => 'הבא (חץ ימינה)',
    ],

    'menu' => [
        'beatmaps' => [
            '_' => 'מפות',
        ],
        'community' => [
            '_' => 'קהילה',
            'dev' => 'פיתוח',
        ],
        'help' => [
            '_' => 'עזרה',
            'getAbuse' => 'דווח על ניצול לרעה',
            'getFaq' => 'שאלות ותשובות נפוצות',
            'getRules' => 'חוקים',
            'getSupport' => 'לא, באמת, אני צריך עזרה!',
        ],
        'home' => [
            '_' => 'בית',
            'team' => 'קבוצה',
        ],
        'rankings' => [
            '_' => 'דירוגים',
            'kudosu' => 'kudosu',
        ],
        'store' => [
            '_' => 'חנות',
        ],
    ],

    'footer' => [
        'general' => [
            '_' => 'כללי',
            'home' => 'בית',
            'changelog-index' => 'רשימת שינויים',
            'beatmaps' => 'רשימת מפות',
            'download' => 'הורד את osu!',
        ],
        'help' => [
            '_' => 'עזרה & קהילה',
            'faq' => 'שאלות נפוצות',
            'forum' => 'פורומי קהילה',
            'livestreams' => 'שידורים חיים',
            'report' => 'דווח על בעיה',
            'wiki' => 'ויקי',
        ],
        'legal' => [
            '_' => 'חוקי & סטטוס',
            'copyright' => 'זכויות יוצרים (DMCA)',
            'privacy' => 'פרטיות',
            'server_status' => 'מצב השרת',
            'source_code' => 'קוד מקור',
            'terms' => 'תנאים',
        ],
    ],

    'errors' => [
        '400' => [
            'error' => 'פרמטר בקשה לא חוקי',
            'description' => '',
        ],
        '404' => [
            'error' => 'עמוד חסר',
            'description' => "סליחה, אבל העמוד שביקשת לא פה!",
        ],
        '403' => [
            'error' => "אתה לא אמור להיות כאן.",
            'description' => 'אבל אתה יכול לנסות לחזור.',
        ],
        '401' => [
            'error' => "אתה לא אמור להיות כאן.",
            'description' => 'אבל אתה יכול לנסות לחזור. או אולי להתחבר.',
        ],
        '405' => [
            'error' => 'עמוד חסר',
            'description' => "סליחה, אבל העמוד שביקשת לא פה!",
        ],
        '422' => [
            'error' => 'פרמטר בקשה לא חוקי',
            'description' => '',
        ],
        '429' => [
            'error' => '',
            'description' => '',
        ],
        '500' => [
            'error' => 'אוי לא! משהו נשבר! ;_;',
            'description' => "אנחנו מודעים אוטומטית על כל שגיאה.",
        ],
        'fatal' => [
            'error' => 'אוי לא! משהו נשבר (לגמרי)! ;_;',
            'description' => "אנחנו מודעים אוטומטית על כל שגיאה.",
        ],
        '503' => [
            'error' => 'למטה לתחזוקה!',
            'description' => "תחזוקה בדרך כלל לוקחת כל זמן מ- 5 שניות עד 10 דקות. אם אנחנו למטה יותר זמן, ראה :link למידע נוסף.",
            'link' => [
                'text' => '',
                'href' => '',
            ],
        ],
        // used by sentry if it returns an error
        'reference' => "בכל מקרה, הנה קוד שאתה יכול לתת כדי לתרום!",
    ],

    'popup_login' => [
        'button' => 'כניסה / הרשמה',

        'login' => [
            'forgot' => "שכחתי את הפרטים שלי",
            'password' => 'סיסמה',
            'title' => 'התחבר כדי להמשיך',
            'username' => 'שם משתמש',

            'error' => [
                'email' => "שם משתמש או כתובת אימייל לא קיימים",
                'password' => 'סיסמה שגויה',
            ],
        ],

        'register' => [
            'download' => 'הורדה',
            'info' => 'אתה צריך חשבון, אדוני. למה אין לך אחד עדיין?',
            'title' => "אין לך חשבון?",
        ],
    ],

    'popup_user' => [
        'links' => [
            'account-edit' => 'הגדרות',
            'follows' => 'רשימת מעקב',
            'friends' => 'חברים',
            'logout' => 'התנתק',
            'profile' => 'הפרופיל שלי',
        ],
    ],

    'popup_search' => [
        'initial' => 'הקלד לחיפוש!',
        'retry' => 'חיפוש נכשל. לחץ כדי לנסות שוב.',
    ],
];
