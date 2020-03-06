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
    'availability' => [
        'disabled' => 'מפה זו לא זמינה להורדה כרגע.',
        'parts-removed' => 'חלקים ממפה זו הוסרו לבקשת היוצר או מחזיק זכויות מצד שלישי.',
        'more-info' => 'בדוק כאן למידע נוסף.',
    ],

    'index' => [
        'title' => 'רישום מפות',
        'guest_title' => 'מפות',
    ],

    'show' => [
        'discussion' => 'דיון',

        'details' => [
            'approved' => 'אושרה ב ',
            'favourite' => 'הוסף מפה למועדפות',
            'logged-out' => 'אתה צריך להתחבר לפני הורדת מפות כלשהן!',
            'loved' => 'אהובה ב ',
            'mapped_by' => 'נוצרה על ידי :mapper',
            'qualified' => 'הוסמכה ב ',
            'ranked' => 'דורגה ב ',
            'submitted' => 'נשלחה ב ',
            'unfavourite' => 'הסר מפה ממועדפות',
            'updated' => 'עודכנה לאחרונה ב ',
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
                '_' => '',
                'button_title' => '',
            ],

            'report' => [
                '_' => '',
                'button' => '',
                'button_title' => '',
                'link' => '',
            ],
        ],

        'info' => [
            'description' => 'תיאור',
            'genre' => 'ז\'אנר',
            'language' => 'שפה',
            'no_scores' => 'נתונים עדיין מחושבים...',
            'points-of-failure' => 'נקודות כשל',
            'source' => 'מקור',
            'success-rate' => 'אחוז הצלחה',
            'tags' => 'תגים',
            'unranked' => 'מפה לא מדורגת',
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
            'ranked' => '',
            'approved' => '',
            'loved' => '',
            'qualified' => '',
            'wip' => '',
            'pending' => '',
            'graveyard' => '',
        ],
    ],
];
