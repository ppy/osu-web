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
    'pinned_topics' => 'נושאים מוצמדים',
    'slogan' => "זה מסוכן לשחק לבד.",
    'subforums' => 'תת פורומים',
    'title' => 'פורום osu!',

    'covers' => [
        'edit' => '',

        'create' => [
            '_' => 'בחר תמונת קאבר',
            'button' => 'העלה תמונה',
            'info' => 'גודל תמונה צריך להיות :dimensions. אתה יכול גם להפיל את התמונה שלך כאן כדי להעלות.',
        ],

        'destroy' => [
            '_' => 'הסר תמונת קאבר',
            'confirm' => 'האם אתה בטוח שברצונך להסיר את תמונת הקאבר?',
        ],
    ],

    'forums' => [
        'latest_post' => '',

        'index' => [
            'title' => '',
        ],

        'topics' => [
            'empty' => 'אין נושאים!',
        ],
    ],

    'mark_as_read' => [
        'forum' => 'סמן פורום כנקרא',
        'forums' => 'סמן פורומים כנקראו',
        'busy' => 'מסמן כנקרא...',
    ],

    'post' => [
        'confirm_destroy' => 'באמת למחוק פוסט?',
        'confirm_restore' => 'באמת לשחזר פוסט?',
        'edited' => 'נערך לאחרונה על-ידי :user :when, נערך :count פעמים.',
        'posted_at' => 'פורסם :when',

        'actions' => [
            'destroy' => 'מחק פוסט',
            'restore' => 'שחזר פוסט',
            'edit' => 'ערוך פוסט',
        ],

        'create' => [
            'title' => [
                'reply' => '',
            ],
        ],

        'info' => [
            'post_count' => ':count_delimited פוסט|:count_delimited פוסטים',
            'topic_starter' => '',
        ],
    ],

    'search' => [
        'go_to_post' => 'לך לפוסט',
        'post_number_input' => 'הזן מספר פוסט',
        'total_posts' => ':posts_count מספר פוסטים כולל',
    ],

    'topic' => [
        'deleted' => 'נושא שנמחק',
        'go_to_latest' => 'הצג את הפוסט האחרון',
        'latest_post' => ':when על-ידי :user',
        'latest_reply_by' => 'תגובה אחרונה מאת :user',
        'new_topic' => 'נושא חדש',
        'new_topic_login' => 'התחבר כדי לפרסם פוסט חדש',
        'post_reply' => 'פוסט',
        'reply_box_placeholder' => 'הקלד כאן כדי להשיב',
        'reply_title_prefix' => 'Re',
        'started_by' => 'מאת :user',
        'started_by_verbose' => 'הותחל על-ידי :user',

        'create' => [
            'close' => '',
            'preview' => 'תצוגה מקדימה',
            // TL note: this is used in the topic reply preview, when
            // the user goes back from previewing to editing the reply
            'preview_hide' => 'כתוב',
            'submit' => 'פוסט',

            'necropost' => [
                'default' => 'נושא זה לא היה פעיל במשך זמן מה. פרסם הודעה כאן רק אם יש לך סיבה ספציפית לעשות זאת.',

                'new_topic' => [
                    '_' => "נושא זה לא היה פעיל במשך זמן מה. אם אין לך סיבה ספציפית כדי לפרסם כאן, אנא :create במקום.",
                    'create' => 'צור נושא חדש',
                ],
            ],

            'placeholder' => [
                'body' => 'הקלד את תוכן הפוסט כאן',
                'title' => 'לחץ כאן כדי להגדיר כותרת',
            ],
        ],

        'jump' => [
            'enter' => 'לחץ כדי להזין מספר פוסט ספציפי',
            'first' => 'לך לפוסט הראשון',
            'last' => 'לך לפוסט האחרון',
            'next' => 'דלג על 10 הפוסטים הבאים',
            'previous' => 'לך 10 פוסטים אחורה',
        ],

        'post_edit' => [
            'cancel' => 'בטל',
            'post' => 'שמור',
        ],
    ],

    'topic_watches' => [
        'index' => [
            'title_compact' => 'פוסטים נעקבים',

            'box' => [
                'total' => 'פוסטים נעקבים',
                'unread' => 'פוסטים עם תגובות חדשות',
            ],

            'info' => [
                'total' => 'אתה עוקב אחרי :total נושאים.',
                'unread' => 'יש לך :unread תגובות לפוסטים נעקבים שלא נקראו.',
            ],
        ],

        'topic_buttons' => [
            'remove' => [
                'confirmation' => 'הפסק לעקוב אחרי נושא זה?',
                'title' => 'הפסק לעקוב',
            ],
        ],
    ],

    'topics' => [
        '_' => 'נושאים',

        'actions' => [
            'login_reply' => 'התחבר כדי להגיב',
            'reply' => 'הגב',
            'reply_with_quote' => 'צטט תגובה',
            'search' => 'חפש',
        ],

        'create' => [
            'create_poll' => 'יצירת סקר',

            'preview' => 'תצוגה מוקדמת של פוסט',

            'create_poll_button' => [
                'add' => 'צור סקר',
                'remove' => 'בטל יצירת סקר',
            ],

            'poll' => [
                'hide_results' => 'הסתר את תוצאות הסקר.',
                'hide_results_info' => 'הן יוצגו רק לאחר שהסקר יסתיים.',
                'length' => 'הרץ סקר למשך',
                'length_days_suffix' => 'ימים',
                'length_info' => 'השאר ריק כדי שהסקר לא ייגמר לעולם',
                'max_options' => 'אפשרויות לכל משתמש',
                'max_options_info' => 'זה מספר האפשרויות שכל משתמש יכול לבחור כאשר הוא מצביע.',
                'options' => 'אפשרויות',
                'options_info' => 'הצב כל אפשרות בשורה חדשה. אתה יכול להכניס עד 10 אפשרויות.',
                'title' => 'שאלה',
                'vote_change' => 'אפשר הצבעה מחדש.',
                'vote_change_info' => 'אם מאופשר, משתמשים יכולים לשנות את הצבעתם.',
            ],
        ],

        'edit_title' => [
            'start' => 'ערוך כותרת',
        ],

        'index' => [
            'feature_votes' => 'עדיפות כוכב',
            'replies' => 'תגובות',
            'views' => 'צפיות',
        ],

        'issue_tag_added' => [
            'to_0' => 'הסר תג "נוסף"',
            'to_0_done' => 'נוסר תג "נוסף"',
            'to_1' => 'הוסף תג "נוסף"',
            'to_1_done' => 'נוסף תג "נוסף"',
        ],

        'issue_tag_assigned' => [
            'to_0' => 'הסר תג "הוקצה"',
            'to_0_done' => 'נוסר תג "הוקצה"',
            'to_1' => 'הוסף תג "הוקצה"',
            'to_1_done' => 'נוסף תג "הוקצה"',
        ],

        'issue_tag_confirmed' => [
            'to_0' => 'הסר תג "אושר"',
            'to_0_done' => 'נוסר תג "אושר"',
            'to_1' => 'הוסף תג "אושר"',
            'to_1_done' => 'נוסף תג "אושר"',
        ],

        'issue_tag_duplicate' => [
            'to_0' => 'הסר תג "כפול"',
            'to_0_done' => 'נוסר תג "כפול"',
            'to_1' => 'הוסף תג "כפול"',
            'to_1_done' => 'נוסף תג "כפול"',
        ],

        'issue_tag_invalid' => [
            'to_0' => 'הסר תג "לא חוקי"',
            'to_0_done' => 'נוסר תג "לא חוקי"',
            'to_1' => 'הוסף תג "לא חוקי"',
            'to_1_done' => 'נוסף תג "לא חוקי"',
        ],

        'issue_tag_resolved' => [
            'to_0' => 'הסר תג "נפתר"',
            'to_0_done' => 'נוסר תג "נפתר"',
            'to_1' => 'הוסף תג "נפתר"',
            'to_1_done' => 'נוסף תג "נפתר"',
        ],

        'lock' => [
            'is_locked' => 'נושא זה נעול ולא ניתן להגיב בו',
            'to_0' => 'פתח נושא',
            'to_0_done' => 'הנושא נפתח',
            'to_1' => 'נעל נושא',
            'to_1_done' => 'הנושא ננעל',
        ],

        'moderate_move' => [
            'title' => 'עבור לפורום אחר',
        ],

        'moderate_pin' => [
            'to_0' => 'בטל הצמדת נושא',
            'to_0_done' => 'הצמדת הנושא בוטלה',
            'to_1' => 'הצמד נושא',
            'to_1_done' => 'הנושא הוצמד',
            'to_2' => 'הצמד נושא וסמן כהכרזה',
            'to_2_done' => 'הנושא הוצמד וסומן כהכרזה',
        ],

        'moderate_toggle_deleted' => [
            'show' => '',
            'hide' => '',
        ],

        'show' => [
            'deleted-posts' => 'פוסטים שנמחקו',
            'total_posts' => 'סך כל הפוסטים',

            'feature_vote' => [
                'current' => 'העדיפות הנוכחית: +:count',
                'do' => 'קדם בקשה זו',

                'info' => [
                    '_' => 'זו היא :feature_request. בקשות תכונה יכולות להיבחר על-ידי :supporters.',
                    'feature_request' => 'בקשת תכונה',
                    'supporters' => 'תומכים',
                ],

                'user' => [
                    'count' => '{0} אין הצבעות|{1} :count_delimited הצבעה|[2,*] :count_delimited הצבעות',
                    'current' => 'יש לך :votes נותרות.',
                    'not_enough' => "אין לך הצבעות נוספות",
                ],
            ],

            'poll' => [
                'edit' => '',
                'edit_warning' => '',
                'vote' => 'הצבע',

                'button' => [
                    'change_vote' => '',
                    'edit' => '',
                    'view_results' => '',
                    'vote' => '',
                ],

                'detail' => [
                    'end_time' => 'הסקר יסתיים ב- :time',
                    'ended' => 'הסקר הסתיים ב- :time',
                    'results_hidden' => 'התוצאות יוצגו לאחר שהסקר יסתיים.',
                    'total' => 'סך כל ההצבעות: :count',
                ],
            ],
        ],

        'watch' => [
            'to_not_watching' => 'לא מסומן',
            'to_watching' => 'סמן',
            'to_watching_mail' => 'סמן עם התראה',
            'tooltip_mail_disable' => 'התראה מופעלת. לחץ כדי לבטל',
            'tooltip_mail_enable' => 'התראה מבוטלת. לחץ כדי להפעיל',
        ],
    ],
];
