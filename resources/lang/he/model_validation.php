<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'invalid' => 'לא נתון :attribute ספציפי.',
    'not_negative' => ':attribute לא יכול להיות שלילי.',
    'required' => ':attribute נדרש.',
    'too_long' => ':attribute חרג מהאורך המקסימלי - יכול להיות רק עד :limit תווים.',
    'wrong_confirmation' => 'האימות אינו תואם.',

    'beatmapset_discussion' => [
        'beatmap_missing' => 'חותמת זמן צוינה אך מפה חסרה.',
        'beatmapset_no_hype' => "מפה לא יכולה לקבל הייפ.",
        'hype_requires_null_beatmap' => 'הייפ חייב להיעשות בתוך סעיף "כללי" (כל רמות הקושי).',
        'invalid_beatmap_id' => 'רמת קושי לא תקינה צוינה.',
        'invalid_beatmapset_id' => 'מפה לא תקינה צוינה.',
        'locked' => 'הדיון נעול.',

        'attributes' => [
            'message_type' => 'סוג הודעה',
            'timestamp' => 'חותמת זמן',
        ],

        'hype' => [
            'discussion_locked' => "המפה הנתונה סגורה לדיון ולכן לא יכולה להיות נלהבת",
            'guest' => 'הינך חייב להיות מחובר כדי לתת הייפ.',
            'hyped' => 'כבר נתת הייפ למפה זו.',
            'limit_exceeded' => 'התשמשת בכל ההייפ שלך.',
            'not_hypeable' => 'מפה זו לא יכולה לקבל הייפ',
            'owner' => 'לא ניתן לתת הייפ למפה שלך.',
        ],

        'timestamp' => [
            'exceeds_beatmapset_length' => 'חותמת זמן ספציפית חורגת מאורך המפה.',
            'negative' => "חותמת זמן לא יכולה להיות שלילית.",
        ],
    ],

    'beatmapset_discussion_post' => [
        'discussion_locked' => 'הדיון נעול.',
        'first_post' => 'לא ניתן למחוק את הפוסט ההתחלתי.',

        'attributes' => [
            'message' => 'ההודעה',
        ],
    ],

    'comment' => [
        'deleted_parent' => 'תגובה להודעה מחוקה אינה מותרת.',
        'top_only' => 'להתגובה המוצמדת לא ניתן להגיב.',

        'attributes' => [
            'message' => 'ההודעה',
        ],
    ],

    'follow' => [
        'invalid' => '',
    ],

    'forum' => [
        'feature_vote' => [
            'not_feature_topic' => 'ניתן להצביע רק לבקשת תכונה.',
            'not_enough_feature_votes' => 'אין מספיק הצבעות.',
        ],

        'poll_vote' => [
            'invalid' => 'צוינה אפשרות לא חוקית.',
        ],

        'post' => [
            'beatmapset_post_no_delete' => 'מחיקת פוסט מטה-נתונים של מפה אינו מותר.',
            'beatmapset_post_no_edit' => 'עריכת פוסט מטה-נתונים של מפה אינו מותר.',
            'first_post_no_delete' => '',
            'missing_topic' => '',
            'only_quote' => 'תגובתך מכילה רק ציטוט.',

            'attributes' => [
                'post_text' => 'גוף הפוסט',
            ],
        ],

        'topic' => [
            'attributes' => [
                'topic_title' => 'כותרת הנושא',
            ],
        ],

        'topic_poll' => [
            'duplicate_options' => 'אפשרות כפולה אינה מותרת.',
            'grace_period_expired' => 'לא ניתן לערוך סקר לאחר יותר מ- :limit שעות',
            'hiding_results_forever' => 'לא ניתן להסתיר תוצאות של סקר שלא מסתיים אף פעם.',
            'invalid_max_options' => 'אפשרות לכל משתמש אינה יכולה לחרוג ממספר האפשרויות הזמינות.',
            'minimum_one_selection' => 'נדרש מינימום של אפשרות אחת לכל משתמש.',
            'minimum_two_options' => 'צריך לפחות שתי אפשרויות.',
            'too_many_options' => 'חרגת מהמספר המרבי של האפשרויות המותרות.',

            'attributes' => [
                'title' => 'כותרת ההצבעה',
            ],
        ],

        'topic_vote' => [
            'required' => 'בחר אפשרות בעת ההצבעה.',
            'too_many' => 'נבחרו יותר אפשרויות מהמותר.',
        ],
    ],

    'oauth' => [
        'client' => [
            'too_many' => '',
            'url' => 'אנא הכנס כתובת אינטרנט תקפה.',

            'attributes' => [
                'name' => 'שם יישום',
                'redirect' => '',
            ],
        ],
    ],

    'user' => [
        'contains_username' => 'הסיסמה אינה יכולה להכיל את שם המשתמש.',
        'email_already_used' => 'כתובת האימייל כבר בשימוש.',
        'email_not_allowed' => 'כתובת הדוא"ל אינה תקינה.',
        'invalid_country' => 'המדינה לא במסד הנתונים.',
        'invalid_discord' => 'שם משתמש ה- Discord לא תקין.',
        'invalid_email' => "לא נראה שכתובת האימייל חוקית.",
        'invalid_twitter' => 'שם משתמש של טוויטר אינו תקין.',
        'too_short' => 'הסיסמה החדשה קצרה מדי.',
        'unknown_duplicate' => 'שם משתמש או כתובת אימייל כבר בשימוש.',
        'username_available_in' => 'שם המשתמש הזה יהיה זמין לשימוש ב- :duration.',
        'username_available_soon' => 'שם המשתמש הזה יהיה זמין לשימוש בכל רגע!',
        'username_invalid_characters' => 'שם המשתמש המבוקש מכיל תווים לא חוקיים.',
        'username_in_use' => 'שם המשתמש כבר בשימוש!',
        'username_locked' => 'שם המשתמש כבר בשימוש!', // TODO: language for this should be slightly different.
        'username_no_space_userscore_mix' => 'נא השתמש בקווים תחתונים או רווחים, לא בשניהם יחד!',
        'username_no_spaces' => "שם משתמש לא יכול להתחיל או להסתיים עם רווחים!",
        'username_not_allowed' => 'בחירת שם משתמש זה אינה מותרת.',
        'username_too_short' => 'שם המשתמש המבוקש קצר מדי.',
        'username_too_long' => 'שם המשתמש המבוקש ארוך מדי.',
        'weak' => 'סיסמה אסורה.',
        'wrong_current_password' => 'הסיסמה הנוכחת אינה נכונה.',
        'wrong_email_confirmation' => 'אימות אימייל אינו תואם.',
        'wrong_password_confirmation' => 'אימות סיסמה אינו תואם.',
        'too_long' => 'חרגת מהאורך המרבי - יכול להיות רק עד :limit תווים.',

        'attributes' => [
            'username' => 'שם משתמש',
            'user_email' => 'כתובת דוא"ל',
            'password' => 'סיסמא',
        ],

        'change_username' => [
            'restricted' => 'אינך יכול לשנות את שם המשתמש שלך כאשר אתה מוגבל.',
            'supporter_required' => [
                '_' => 'היית חייב :link כדי לשנות את השם שלך!',
                'link_text' => 'לתמוך ב- osu!',
            ],
            'username_is_same' => 'זה כבר שם המשתמש שלך, טיפשון!',
        ],
    ],

    'user_report' => [
        'no_ranked_beatmapset' => '',
        'reason_not_valid' => ':reason לא בתוקף כלפי הסוג דיווח הנתון.',
        'self' => "אינך יכול לדווח על עצמך!",
    ],

    'store' => [
        'order_item' => [
            'attributes' => [
                'quantity' => 'כמות',
                'cost' => 'עלות',
            ],
        ],
    ],
];
