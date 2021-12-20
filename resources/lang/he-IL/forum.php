<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'pinned_topics' => 'נושאים מוצמדים',
    'slogan' => "זה מסוכן לשחק לבד.",
    'subforums' => 'תת פורומים',
    'title' => 'פורום osu!',

    'covers' => [
        'edit' => 'ערוך',

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
        'latest_post' => 'פוסט אחרון',

        'index' => [
            'title' => 'אינדקס הפורום',
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
        'posted_by' => '',

        'actions' => [
            'destroy' => 'מחק פוסט',
            'edit' => 'ערוך פוסט',
            'report' => 'הגש תלונה על הפוסט',
            'restore' => 'שחזר פוסט',
        ],

        'create' => [
            'title' => [
                'reply' => 'תגובה חדשה',
            ],
        ],

        'info' => [
            'post_count' => ':count_delimited פוסט|:count_delimited פוסטים',
            'topic_starter' => 'התחלת נושא',
        ],
    ],

    'search' => [
        'go_to_post' => 'לך לפוסט',
        'post_number_input' => 'הזן מספר פוסט',
        'total_posts' => ':posts_count מספר פוסטים כולל',
    ],

    'topic' => [
        'confirm_destroy' => '',
        'confirm_restore' => '',
        'deleted' => 'נושא שנמחק',
        'go_to_latest' => 'הצג את הפוסט האחרון',
        'has_replied' => 'הגבת בנושא זה',
        'in_forum' => 'ב :forum ',
        'latest_post' => ':when על-ידי :user',
        'latest_reply_by' => 'תגובה אחרונה מאת :user',
        'new_topic' => 'נושא חדש',
        'new_topic_login' => 'התחבר כדי לפרסם פוסט חדש',
        'post_reply' => 'פוסט',
        'reply_box_placeholder' => 'הקלד כאן כדי להשיב',
        'reply_title_prefix' => 'Re',
        'started_by' => 'מאת :user',
        'started_by_verbose' => 'הותחל על-ידי :user',

        'actions' => [
            'destroy' => '',
            'restore' => '',
        ],

        'create' => [
            'close' => 'סגור',
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

        'logs' => [
            '_' => '',
            'button' => '',

            'columns' => [
                'action' => '',
                'date' => '',
                'user' => '',
            ],

            'data' => [
                'add_tag' => '',
                'announcement' => '',
                'edit_topic' => '',
                'fork' => '',
                'pin' => '',
                'post_operation' => '',
                'remove_tag' => '',
                'source_forum_operation' => '',
                'unpin' => '',
            ],

            'no_results' => '',

            'operations' => [
                'delete_post' => '',
                'delete_topic' => '',
                'edit_topic' => '',
                'edit_poll' => '',
                'fork' => '',
                'issue_tag' => '',
                'lock' => '',
                'merge' => '',
                'move' => '',
                'pin' => '',
                'post_edited' => '',
                'restore_post' => '',
                'restore_topic' => '',
                'split_destination' => '',
                'split_source' => '',
                'topic_type' => '',
                'topic_type_changed' => '',
                'unlock' => '',
                'unpin' => '',
                'user_lock' => '',
                'user_unlock' => '',
            ],
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
            'to_0_confirm' => 'פתח נושא?',
            'to_0_done' => 'הנושא נפתח',
            'to_1' => 'נעל נושא',
            'to_1_confirm' => 'לנעול את האשכול?',
            'to_1_done' => 'הנושא ננעל',
        ],

        'moderate_move' => [
            'title' => 'עבור לפורום אחר',
        ],

        'moderate_pin' => [
            'to_0' => 'בטל הצמדת נושא',
            'to_0_confirm' => 'בטל הצמדת האשכול?',
            'to_0_done' => 'הצמדת הנושא בוטלה',
            'to_1' => 'הצמד נושא',
            'to_1_confirm' => 'הצמד אשכול?',
            'to_1_done' => 'הנושא הוצמד',
            'to_2' => 'הצמד נושא וסמן כהכרזה',
            'to_2_confirm' => 'הצמד אשכול וסמן כהכרזה?',
            'to_2_done' => 'הנושא הוצמד וסומן כהכרזה',
        ],

        'moderate_toggle_deleted' => [
            'show' => 'הראה פוסטים מחוקים',
            'hide' => 'הסתר פוסטים מחוקים',
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
                'edit' => 'ערוך סקר',
                'edit_warning' => 'עריכת סקר תסיר את התוצאות הנוכחיות!',
                'vote' => 'הצבע',

                'button' => [
                    'change_vote' => 'שנה הצבעה',
                    'edit' => 'ערוך סקר',
                    'view_results' => 'דלג לתוצאות',
                    'vote' => 'הצבעה',
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
