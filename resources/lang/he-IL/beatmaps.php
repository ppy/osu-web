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
    'discussion-posts' => [
        'store' => [
            'error' => 'נכשל בשמירת הודעה',
        ],
    ],

    'discussion-votes' => [
        'update' => [
            'error' => 'נכשל בעדכון הצבעה',
        ],
    ],

    'discussions' => [
        'allow_kudosu' => 'אפשר kudosu',
        'beatmap_information' => '',
        'delete' => 'מחק',
        'deleted' => 'נמחק על ידי :editor :delete_time.',
        'deny_kudosu' => 'דחה kudosu',
        'edit' => 'ערוך',
        'edited' => 'נערך לאחרונה על ידי :editor :update_time.',
        'kudosu_denied' => 'נדחה מקבלת kudosu.',
        'message_placeholder_deleted_beatmap' => 'רמת הקושי הזאת נמחקה לכן לא ניתן לדון בה.',
        'message_placeholder_locked' => 'דיון למפה זו בוטל.',
        'message_type_select' => 'בחר סוג תגובה',
        'reply_notice' => 'הקש על Enter כדי להגיב.',
        'reply_placeholder' => 'הקלד את תגובתך כאן',
        'require-login' => 'אנא התחבר על מנת לפרסם הודעה או להגיב',
        'resolved' => 'נפתר',
        'restore' => 'שחזר',
        'show_deleted' => 'הצג שנמחק',
        'title' => 'דיונים',

        'collapse' => [
            'all-collapse' => 'סגור הכל',
            'all-expand' => 'הרחב הכל',
        ],

        'empty' => [
            'empty' => 'עדיין אין דיונים!',
            'hidden' => 'אין דיון שמתאים לסינון שנבחר.',
        ],

        'lock' => [
            'button' => [
                'lock' => 'נעל דיון',
                'unlock' => 'פתח דיון',
            ],

            'prompt' => [
                'lock' => 'סיבת הנעילה',
                'unlock' => 'האם אתה בטוח שברצונך לפתוח?',
            ],
        ],

        'message_hint' => [
            'in_general' => 'פוסט זה יעבור לדיוני beatmapset כללים. כדי לעשות mod ל- beatmap זה, התחל הודעה עם חותמת זמן (למשל 00:12:345).',
            'in_timeline' => 'כדי לבצע mod לחותמות זמן מרובות, פרסם הודעה מספר פעמים (הודעה אחת לחותמת זמן).',
        ],

        'message_placeholder' => [
            'general' => 'הקלד כאן כדי לפרסם הודעה ל- כללי (:version)',
            'generalAll' => 'הקלד כאן כדי לפרסם הודעה ל- כללי (כל רמות הקושי)',
            'timeline' => 'הקלד כאן כדי לפרסם הודעה ל- "ציר זמן" (:version)',
        ],

        'message_type' => [
            'disqualify' => 'פסול',
            'hype' => 'הייפ!',
            'mapper_note' => 'הערה',
            'nomination_reset' => 'איפוס מועמדות',
            'praise' => 'שבח',
            'problem' => 'בעיה',
            'review' => '',
            'suggestion' => 'הצעה',
        ],

        'mode' => [
            'events' => 'היסטוריה',
            'general' => 'כללי :scope',
            'reviews' => '',
            'timeline' => 'ציר זמן',
            'scopes' => [
                'general' => 'רמת הקושי הזאת',
                'generalAll' => 'כל רמות הקושי',
            ],
        ],

        'new' => [
            'pin' => 'נעץ',
            'timestamp' => 'חותמת זמן',
            'timestamp_missing' => 'העתק במצב עריכה והדבק בהודעה שלך כדי להוסיף חותמת זמן!',
            'title' => 'דיון חדש',
            'unpin' => 'בטל נעיצה',
        ],

        'show' => [
            'title' => ':title ממופה על ידי :mapper',
        ],

        'sort' => [
            'created_at' => 'זמן יצירה',
            'timeline' => 'ציר זמן',
            'updated_at' => 'עידכון אחרון',
        ],

        'stats' => [
            'deleted' => 'נמחק',
            'mapper_notes' => 'הערות',
            'mine' => 'מוקש',
            'pending' => 'ממתין',
            'praises' => 'שבחים',
            'resolved' => 'נפתר',
            'total' => 'הכל',
        ],

        'status-messages' => [
            'approved' => 'Beatmap זו אושרה ב :date!',
            'graveyard' => "Beatmap זו לא עודכנה מאז :date וקרוב לוודאי שננטשה על ידי היוצר...",
            'loved' => 'Beatmap זו הוספה ל "אהובות" ב- :date!',
            'ranked' => 'Beatmap זו דורגה ב :date!',
            'wip' => 'הערה: Beatmap זו מסומנת כ "עבודה בתהליך" על ידי היוצר.',
        ],

        'votes' => [
            'none' => [
                'down' => '',
                'up' => '',
            ],
            'latest' => [
                'down' => '',
                'up' => '',
            ],
        ],
    ],

    'hype' => [
        'button' => 'הייפ Beatmap!',
        'button_done' => 'כבר Hyped!',
        'confirm' => "אתה בטוח? זה ישתמש באחד מ- :n ההייפים הנותרים שלך ולא ניתן לבטל זאת.",
        'explanation' => 'תן הייפ ל beatmap הזו כדי להפוך אותה לגלויה יותר להיות מועמדת ומדורגת!',
        'explanation_guest' => 'התחבר ותן הייף ל beatmap זו כדי להפוך אותה לגלויה יותר להיות מועמדת ומדורגת!',
        'new_time' => "תקבל הייפ אחר :new_time.",
        'remaining' => 'יש לך :remaining הייפים נותרים.',
        'required_text' => 'הייפ: :current/:required',
        'section_title' => 'רכבת הייפ',
        'title' => 'הייפ',
    ],

    'feedback' => [
        'button' => 'השאר משוב',
    ],

    'nominations' => [
        'delete' => 'מחק',
        'delete_own_confirm' => 'אתה בטוח? Beatmap זו תימחק ואתה תועבר חזרה לפרופיל שלך.',
        'delete_other_confirm' => 'אתה בטוח? Beatmap זו תימחק ואתה תועבר חזרה לפרופיל של המשתמש.',
        'disqualification_prompt' => 'סיבת הפסילה?',
        'disqualified_at' => 'נפסלה :time_ago (:reason).',
        'disqualified_no_reason' => 'לא פורטה הסיבה',
        'disqualify' => 'פסול',
        'incorrect_state' => 'שגיאה בעת ביצוע פעולה זו, נסה לרענן את הדף.',
        'love' => 'אוהב',
        'love_confirm' => 'לאהוב מפה זו?',
        'nominate' => 'למנות',
        'nominate_confirm' => 'למנות מפה זו?',
        'nominated_by' => 'מונתה על ידי :users',
        'not_enough_hype' => "",
        'qualified' => 'משוער שתידרג ב- :date, אם לא נמצאו בעיות.',
        'qualified_soon' => 'משוער שתידרג בקרוב, אם לא נמצאו בעיות.',
        'required_text' => 'מינויים: :current/:required',
        'reset_message_deleted' => 'נמחק',
        'title' => 'סטטוס המינוי',
        'unresolved_issues' => 'ישנן עדיין בעיות שלא נפתרו שחייבות טיפול קודם.',

        'reset_at' => [
            'nomination_reset' => 'תהליך המינוי התאפס :time_ago על ידי :user עם בעיה חדשה :discussion (:message).',
            'disqualify' => 'נפסלה :time_ago על ידי :user עם בעיה חדשה :discussion (:message).',
        ],

        'reset_confirm' => [
            'nomination_reset' => 'אתה בטוח? פרסום בעיה חדשה יאפס את תהליך המינוי.',
            'disqualify' => 'אתה בטוח? זה יסיר את המפה מ- "מוקדמות" ויאפס את תהליך המינוי.',
        ],
    ],

    'listing' => [
        'search' => [
            'prompt' => 'הקלד מילות מפתח...',
            'login_required' => 'התחבר כדי לחפש.',
            'options' => 'אפשרויות חיפוש נוספות',
            'supporter_filter' => 'סינון לפי :filters דורש תג osu!supporter פעיל',
            'not-found' => 'אין תוצאות',
            'not-found-quote' => '... לא, לא נמצא כלום.',
            'filters' => [
                'general' => 'כללי',
                'mode' => 'מצב',
                'status' => 'קטגוריות',
                'genre' => 'ז\'אנר',
                'language' => 'שפה',
                'extra' => 'נוסף',
                'rank' => 'דרגה הושגה',
                'played' => 'שוחקה',
            ],
            'sorting' => [
                'title' => 'כותרת',
                'artist' => 'אמן',
                'difficulty' => 'דרגת קושי',
                'favourites' => 'מועדפות',
                'updated' => 'עודכנה',
                'ranked' => 'מדורגת',
                'rating' => 'דירוג',
                'plays' => 'שיחוקים',
                'relevance' => 'רלוונטיות',
                'nominations' => 'מינויים',
            ],
            'supporter_filter_quote' => [
                '_' => 'סינון לפי :filters דורש :link פעיל',
                'link_text' => 'תג osu!supporter',
            ],
        ],
    ],
    'general' => [
        'recommended' => 'דרגת קושי מומלצת',
        'converts' => 'כלול מפות מומרות',
    ],
    'mode' => [
        'any' => 'הכל',
        'osu' => '',
        'taiko' => '',
        'fruits' => '',
        'mania' => '',
    ],
    'status' => [
        'any' => 'הכל',
        'approved' => 'מאושרת',
        'favourites' => '',
        'graveyard' => 'קבורה',
        'leaderboard' => '',
        'loved' => 'אהובה',
        'mine' => '',
        'pending' => 'בתהליך * WIP',
        'qualified' => 'מוסמכת',
        'ranked' => '',
    ],
    'genre' => [
        'any' => 'הכל',
        'unspecified' => 'לא מוגדר',
        'video-game' => 'משחק וידאו',
        'anime' => 'אנימה',
        'rock' => 'רוק',
        'pop' => 'פופ',
        'other' => 'אחר',
        'novelty' => 'Novelty',
        'hip-hop' => 'היפ הופ',
        'electronic' => 'אלקטרוני',
    ],
    'mods' => [
        '4K' => '',
        '5K' => '',
        '6K' => '',
        '7K' => '',
        '8K' => '',
        '9K' => '',
        'AP' => '',
        'DT' => '',
        'EZ' => '',
        'FI' => '',
        'FL' => '',
        'HD' => '',
        'HR' => '',
        'HT' => '',
        'MR' => '',
        'NC' => '',
        'NF' => '',
        'NM' => '',
        'PF' => '',
        'Relax' => '',
        'SD' => '',
        'SO' => '',
        'TD' => '',
    ],
    'language' => [
        'any' => '',
        'english' => 'אנגלית',
        'chinese' => 'סינית',
        'french' => 'צרפתית',
        'german' => 'גרמנית',
        'italian' => 'איטלקית',
        'japanese' => 'יפנית',
        'korean' => 'קוריאנית',
        'spanish' => 'ספרדית',
        'swedish' => 'שוודית',
        'instrumental' => 'אינסטרומנטלי',
        'other' => 'אחר',
    ],
    'played' => [
        'any' => 'הכל',
        'played' => 'שוחקה',
        'unplayed' => 'לא שוחקה',
    ],
    'extra' => [
        'video' => 'יש וידאו',
        'storyboard' => 'יש Storyboard',
    ],
    'rank' => [
        'any' => 'הכל',
        'XH' => 'SS כסוף',
        'X' => '',
        'SH' => 'S כסוף',
        'S' => '',
        'A' => '',
        'B' => '',
        'C' => '',
        'D' => '',
    ],
    'panel' => [
        'playcount' => 'מספר משחקים: :count',
        'favourites' => 'מועדפות: :count',
    ],
];
