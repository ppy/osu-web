<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'availability' => [
        'disabled' => 'מפה זו לא זמינה להורדה כרגע.',
        'parts-removed' => 'חלקים ממפה זו הוסרו לבקשת היוצר או מחזיק זכויות מצד שלישי.',
        'more-info' => 'בדוק כאן למידע נוסף.',
        'rule_violation' => 'חלק מהקבצים של המפה הוסרו אחרי שהגדרו כלא מתאימים לשימוש ב-!osu.',
    ],

    'download' => [
        'limit_exceeded' => '',
    ],

    'featured_artist_badge' => [
        'label' => '',
    ],

    'index' => [
        'title' => 'רישום מפות',
        'guest_title' => 'מפות',
    ],

    'panel' => [
        'empty' => 'אין מפות',

        'download' => [
            'all' => 'להוריד',
            'video' => 'להוריד עם סירטון',
            'no_video' => 'להוריד בלי סירטון',
            'direct' => 'פתח ב- osu!direct',
        ],
    ],

    'nominate' => [
        'hybrid_requires_modes' => 'הכלאת קבוצה של מפות מתבקש ממך לבחור לפחות מצב אחד בשביל לדרג את המפה.',
        'incorrect_mode' => 'אין לך הרשאה לדרג למצב: :mode',
        'full_bn_required' => 'עליך להיות מועמד כדי לקבל מועמדות מאושרת.',
        'too_many' => 'דרישות המעומדות כבר בוצעו.',

        'dialog' => [
            'confirmation' => 'האם אתה בטוח שאתה רוצה לדרג מפה זאת?',
            'header' => 'דירוג מפה',
            'hybrid_warning' => 'הערה: אתה רשאי לדרג רק פעם אחת, אנא דרג כל אחד ממצבי המשחק שאתה מתכוון אליהם',
            'which_modes' => 'דרג לאיזה מודים?',
        ],
    ],

    'nsfw_badge' => [
        'label' => '',
    ],

    'show' => [
        'discussion' => 'דיון',

        'details' => [
            'by_artist' => '',
            'favourite' => 'הוסף מפה למועדפות',
            'favourite_login' => '',
            'logged-out' => 'אתה צריך להתחבר לפני הורדת מפות כלשהן!',
            'mapped_by' => 'נוצרה על ידי :mapper',
            'unfavourite' => 'הסר מפה ממועדפות',
            'updated_timeago' => 'עודכנה לאחרונה :timeago',

            'download' => [
                '_' => 'הורד',
                'direct' => '',
                'no-video' => 'ללא וידאו',
                'video' => 'עם וידאו',
            ],

            'login_required' => [
                'bottom' => 'כדי לגשת לתכונות נוספות',
                'top' => 'התחבר',
            ],
        ],

        'details_date' => [
            'approved' => 'אושר ב-:timeago',
            'loved' => 'קיבל סטטוס- Loved לפני-:timeago',
            'qualified' => 'קיבל סטטוס-qualifie לפני :timeago',
            'ranked' => 'קיבל סטטוס-Ranked לפני :timeago',
            'submitted' => 'הושלם לפני :timeago',
            'updated' => 'עידכון אחרון לפני :timeago',
        ],

        'favourites' => [
            'limit_reached' => 'יש לך יותר מדי מפות מועדפות! בבקשה הסר כמה לפני שתנסה שוב.',
        ],

        'hype' => [
            'action' => 'תן הייפ למפה זו אם נהנית לשחק בה כדי לעזור לה להתקדם לסטטוס <strong>מדורגת</strong>.',

            'current' => [
                '_' => 'מפה זו כרגע :status.',

                'status' => [
                    'pending' => 'בהמתנה',
                    'qualified' => 'מוסמכת',
                    'wip' => 'בתהליך',
                ],
            ],

            'disqualify' => [
                '_' => 'אם נמצאה תקלה כל שהיא במפה, אבא פסול אותה :link.',
            ],

            'report' => [
                '_' => 'אם מצאת שגיאה במפה, אבא דווח זאת :link בשביל לידע את הצוות.',
                'button' => 'דווח על בעיה',
                'link' => 'כאן',
            ],
        ],

        'info' => [
            'description' => 'תיאור',
            'genre' => 'ז\'אנר',
            'language' => 'שפה',
            'no_scores' => 'נתונים עדיין מחושבים...',
            'nsfw' => '',
            'points-of-failure' => 'נקודות כשל',
            'source' => 'מקור',
            'storyboard' => '',
            'success-rate' => 'אחוז הצלחה',
            'tags' => 'תגים',
            'video' => '',
        ],

        'nsfw_warning' => [
            'details' => '',
            'title' => '',

            'buttons' => [
                'disable' => '',
                'listing' => '',
                'show' => '',
            ],
        ],

        'scoreboard' => [
            'achieved' => 'הושג :when',
            'country' => 'דירוג מדינה',
            'friend' => 'דירוג חברים',
            'global' => 'דירוג עולמי',
            'supporter-link' => 'לחץ <a href=":link">כאן</a> כדי לראות את כל הפיצ\'רים המגניבים שאתה מקבל!',
            'supporter-only' => 'אתה צריך להיות osu!supporter כדי לגשת לדירוג חברים ומדינה!',
            'title' => 'לוח תוצאות',

            'headers' => [
                'accuracy' => 'דיוק',
                'combo' => 'קומבו מירבי',
                'miss' => 'פספוס',
                'mods' => 'מודים',
                'player' => 'שחקן',
                'pp' => '',
                'rank' => 'דירוג',
                'score_total' => 'ציון כולל',
                'score' => 'ציון',
                'time' => 'זמן',
            ],

            'no_scores' => [
                'country' => 'אף אחד מהמדינה שלך השיג ציון על מפה זאת עדיין!',
                'friend' => 'אף אחד מהחברים שלך השיג ציון על מפה זאת עדיין!',
                'global' => 'אין ציונים עדיין. אולי תנסה להשיג כמה?',
                'loading' => 'טוען ציונים...',
                'unranked' => 'מפה לא מדורגת.',
            ],
            'score' => [
                'first' => 'מוביל',
                'own' => 'הכי טוב שלך',
            ],
        ],

        'stats' => [
            'cs' => 'גודל העיגול',
            'cs-mania' => 'כמות המקשים',
            'drain' => 'התרוקנות HP',
            'accuracy' => 'דיוק',
            'ar' => 'קצב ההתקרבות',
            'stars' => 'קושי כוכב',
            'total_length' => 'אורך',
            'bpm' => 'BPM',
            'count_circles' => 'מספר עיגולים',
            'count_sliders' => 'מספר סליידרים',
            'user-rating' => 'דירוג משתמשים',
            'rating-spread' => 'התפרסות דירוג',
            'nominations' => 'מינויים',
            'playcount' => 'מספר משחקים',
        ],

        'status' => [
            'ranked' => 'Ranked',
            'approved' => 'Approved',
            'loved' => 'Loved',
            'qualified' => 'Qualified',
            'wip' => 'WIP',
            'pending' => 'בהמתנה',
            'graveyard' => 'ננטש',
        ],
    ],
];
