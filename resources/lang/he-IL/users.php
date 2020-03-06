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
    'deleted' => '[משתמש שנמחק]',

    'beatmapset_activities' => [
        'title' => "היסטוריית מודינג של :user",
        'title_compact' => 'מודינג',

        'discussions' => [
            'title_recent' => 'דיונים שהתחילו לאחרונה',
        ],

        'events' => [
            'title_recent' => 'אירועים אחרונים',
        ],

        'posts' => [
            'title_recent' => 'פוסטים אחרונים',
        ],

        'votes_received' => [
            'title_most' => 'הוצבע לטובה על ידי (3 חודשים אחרונים)',
        ],

        'votes_made' => [
            'title_most' => 'הכי מוצבע לטובה (3 חודשים אחרונה)',
        ],
    ],

    'blocks' => [
        'banner_text' => 'חסמת משתמש זה.',
        'blocked_count' => 'משתמשים חסומים (:count)',
        'hide_profile' => 'הסתר פרופיל',
        'not_blocked' => 'משתמש זה אינו חסום.',
        'show_profile' => 'הצג פרופיל',
        'too_many' => 'הגעת למגבלת החסימות.',
        'button' => [
            'block' => 'חסום',
            'unblock' => 'בטל חסימה',
        ],
    ],

    'card' => [
        'loading' => 'טוען...',
        'send_message' => 'שלח הודעה',
    ],

    'disabled' => [
        'title' => '',
        'warning' => "",

        'if_mistake' => [
            '_' => '',
            'email' => '',
        ],

        'reasons' => [
            'compromised' => '',
            'opening' => '',

            'tos' => [
                '_' => '',
                'community_rules' => '',
                'tos' => '',
            ],
        ],
    ],

    'force_reactivation' => [
        'reason' => [
            'inactive_different_country' => "",
        ],
    ],

    'login' => [
        '_' => 'התחבר',
        'button' => 'התחבר',
        'button_posting' => 'מתחבר...',
        'email_login_disabled' => '',
        'failed' => 'התחברות שגויה',
        'forgot' => 'שכחת סיסמה?',
        'info' => '',
        'locked_ip' => 'כתובת ה- IP שלך נעולה. נא המתן כמה דקות.',
        'password' => 'סיסמה',
        'register' => "אין לך חשבון osu!? צור אחד חדש",
        'remember' => 'זכור מחשב זה',
        'title' => 'נא התחבר כדי להמשיך',
        'username' => 'שם משתמש',

        'beta' => [
            'main' => 'גישת בטא כרגע מוגבלת למשתמשים נבחרים.',
            'small' => '(osu!supporters ייכנסו בקרוב)',
        ],
    ],

    'posts' => [
        'title' => 'פוסטים של :username',
    ],

    'anonymous' => [
        'login_link' => 'לחץ כדי להתחבר',
        'login_text' => 'התחבר',
        'username' => 'אורח',
        'error' => 'הינך צריך להיות מחובר כדי לעשות את זה.',
    ],
    'logout_confirm' => 'האם אתה בטוח שברצונך להתנתק? :(',
    'report' => [
        'button_text' => 'דווח',
        'comments' => 'הערות נוספות',
        'placeholder' => 'נא ספק כל מידע שאתה מאמין שיכול להיות שימושי.',
        'reason' => 'סיבה',
        'thanks' => 'תודה על הדיווח שלך!',
        'title' => 'לדווח את :username?',

        'actions' => [
            'send' => 'שלח דיווח',
            'cancel' => 'בטל',
        ],

        'options' => [
            'cheating' => 'אי הוגנות / רמאות',
            'insults' => 'העליב אותי / אחרים',
            'spam' => 'ספאם',
            'unwanted_content' => 'שולחים קישורים לתוכן לא הולם',
            'nonsense' => 'שטויות',
            'other' => 'אחר (הקלד למטה)',
        ],
    ],
    'restricted_banner' => [
        'title' => 'החשבון שלך הוגבל!',
        'message' => 'כאשר אתה מוגבל, לא תוכל לדבר עם שחקנים אחרים והתוצאות שלך יהיו גלויות רק לך. הגבלה זו בדרך כלל נובעת מתהליך אוטומטי ובדרך כלל מוסרת לאחר 24 שעות. אם ברצונך לערער על ההגבלה שלך, נא <a href="mailto:accounts@ppy.sh">צור קשר עם התמיכה</a>.',
    ],
    'show' => [
        'age' => 'בן :age שנים',
        'change_avatar' => 'שנה תמונת פרופיל!',
        'first_members' => 'כאן מההתחלה',
        'is_developer' => 'מפתח osu!',
        'is_supporter' => 'osu!supporter',
        'joined_at' => 'הצטרף :date',
        'lastvisit' => 'נראה לאחרונה :date',
        'lastvisit_online' => 'כרגע מחובר',
        'missingtext' => 'ייתכן שביצעת שגיאת כתיב! (או שהמשתמש מושעה)',
        'origin_country' => 'מ- :country',
        'page_description' => 'osu! - כל מה שרצית לדעת על :username!',
        'previous_usernames' => 'לשעבר ידוע בתור',
        'plays_with' => 'משחק עם :devices',
        'title' => "הפרופיל של :username",

        'edit' => [
            'cover' => [
                'button' => 'החלף תמונת פרופיל',
                'defaults_info' => 'אפשרויות תמונה נוספות יהיו זמינות בעתיד',
                'upload' => [
                    'broken_file' => 'עיבוד תמונה נכשל. אמת את התמונה שהעלית ונסה שוב.',
                    'button' => 'העלה תמונה',
                    'dropzone' => 'הנח כאן כדי להעלות',
                    'dropzone_info' => 'אתה יכול גם להניח את התמונה שלך כאן כדי להעלות',
                    'size_info' => 'גודל תמונה צריך להיות 2800x620',
                    'too_large' => 'הקובץ שהועלה גדול מדי.',
                    'unsupported_format' => 'פורמט לא נתמך.',

                    'restriction_info' => [
                        '_' => '',
                        'link' => '',
                    ],
                ],
            ],

            'default_playmode' => [
                'is_default_tooltip' => 'מצב משחק ברירת מחדל',
                'set' => 'הגדר :mode כמצב משחק ברירת מחדל של הפרופיל',
            ],
        ],

        'extra' => [
            'none' => '',
            'unranked' => 'לא שיחק לאחרונה',

            'achievements' => [
                'achieved-on' => 'הושג בתאריך :date',
                'locked' => 'נעול',
                'title' => 'הישגים',
            ],
            'beatmaps' => [
                'by_artist' => 'מאת :artist',
                'none' => 'כלום... עדיין.',
                'title' => 'מפות',

                'favourite' => [
                    'title' => 'מפות מועדפות',
                ],
                'graveyard' => [
                    'title' => 'מפות בבית הקברות',
                ],
                'loved' => [
                    'title' => 'מפות אהובות',
                ],
                'ranked_and_approved' => [
                    'title' => 'מפות מדורגות & מאושרות',
                ],
                'unranked' => [
                    'title' => 'מפות ממתינות',
                ],
            ],
            'discussions' => [
                'title' => '',
                'title_longer' => '',
                'show_more' => '',
            ],
            'events' => [
                'title' => '',
                'title_longer' => '',
                'show_more' => '',
            ],
            'historical' => [
                'empty' => 'אין רישומי ביצועים. :(',
                'title' => 'היסטורי',

                'monthly_playcounts' => [
                    'title' => 'היסטוריית משחק',
                    'count_label' => 'שיחוקים',
                ],
                'most_played' => [
                    'count' => 'פעמים ששוחקו',
                    'title' => 'המפות הכי משוחקות',
                ],
                'recent_plays' => [
                    'accuracy' => 'דיוק: :percentage',
                    'title' => 'משחקים אחרונים (24ש)',
                ],
                'replays_watched_counts' => [
                    'title' => 'היסטוריית שידורים חוזרים שנצפו',
                    'count_label' => 'שידורים חוזרים שנצפו',
                ],
            ],
            'kudosu' => [
                'available' => 'Kudosu זמין',
                'available_info' => "ניתן להחליף Kudosu עבור כוכבים, שיעזרו למפה שלך לקבל יותר תשומת לב. זו כמות ה- Kudosu שלא החלפת עדיין.",
                'recent_entries' => 'היסטוריית Kudosu אחרונה',
                'title' => 'Kudosu!',
                'total' => 'Kudosu כולל שהושג',

                'entry' => [
                    'amount' => ':amount kudosu',
                    'empty' => "משתמש זה לא קיבל kudosu כלל!",

                    'beatmap_discussion' => [
                        'allow_kudosu' => [
                            'give' => 'קיבל :amount מביטול דחיית kudosu של פוסט מודינג :post',
                        ],

                        'deny_kudosu' => [
                            'reset' => 'נדחה :amount מפוסט מודינג :post',
                        ],

                        'delete' => [
                            'reset' => 'איבד :amount ממחיקת פוסט מודינג :post',
                        ],

                        'restore' => [
                            'give' => 'קיבל :amount משחזור פוסט מודינג :post',
                        ],

                        'vote' => [
                            'give' => 'קיבל :amount מהשגת הצבעות בפוסט מודינג :post',
                            'reset' => 'איבד :amount מהפסד הצבעות בפוסט מודינג :post',
                        ],

                        'recalculate' => [
                            'give' => 'קיבל :amount מחישוב מחדש של הצבעות בפוסט מודינג :post',
                            'reset' => 'איבד :amount מחישוב מחדש של הצבעות בפוסט מודינג :post',
                        ],
                    ],

                    'forum_post' => [
                        'give' => 'קיבל :amount מ- :giver עבור פוסט :post',
                        'reset' => 'Kudosu אופס על ידי :giver עבור פוסט :post',
                        'revoke' => 'Kudosu נדחה על ידי :giver עבור פוסט :post',
                    ],
                ],

                'total_info' => [
                    '_' => '',
                    'link' => '',
                ],
            ],
            'me' => [
                'title' => 'אני!',
            ],
            'medals' => [
                'empty' => "משתמש זה לא קיבל כלום עדיין. ;_;",
                'recent' => 'אחרון',
                'title' => 'מדליות',
            ],
            'posts' => [
                'title' => '',
                'title_longer' => '',
                'show_more' => '',
            ],
            'recent_activity' => [
                'title' => 'אחרון',
            ],
            'top_ranks' => [
                'download_replay' => 'הורד שידור חוזר',
                'empty' => 'אין רישומי ביצועים מדהימים עדיין. :(',
                'not_ranked' => 'רק מפות מדורגות נותנות pp.',
                'pp_weight' => ':percentage משוקלל',
                'title' => 'דירוגים',

                'best' => [
                    'title' => 'הביצוע הטוב ביותר',
                ],
                'first' => [
                    'title' => 'דירוגים של מקום ראשון',
                ],
            ],
            'votes' => [
                'given' => '',
                'received' => '',
                'title' => '',
                'title_longer' => '',
                'vote_count' => '',
            ],
            'account_standing' => [
                'title' => 'מעמד חשבון',
                'bad_standing' => "החשבון של <strong>:username</strong> אינו במעמד טוב :(",
                'remaining_silence' => '<strong>:username</strong> יהיה מסוגל לדבר שוב בתוך :duration.',

                'recent_infringements' => [
                    'title' => 'הפרות אחרונות',
                    'date' => 'תאריך',
                    'action' => 'פעולה',
                    'length' => 'אורך',
                    'length_permanent' => 'לצמיתות',
                    'description' => 'תיאור',
                    'actor' => 'על ידי :username',

                    'actions' => [
                        'restriction' => 'השעיה',
                        'silence' => 'השתקה',
                        'note' => 'הערה',
                    ],
                ],
            ],
        ],

        'info' => [
            'discord' => '',
            'interests' => 'תחומי עניין',
            'lastfm' => 'Last.fm',
            'location' => 'מיקום נוכחי',
            'occupation' => 'עיסוק',
            'skype' => '',
            'twitter' => '',
            'website' => 'אתר אינטרנט',
        ],
        'not_found' => [
            'reason_1' => 'ייתכן שהם שינו את שם המשתמש שלהם.',
            'reason_2' => 'ייתכון שהחשבון אינו זמין באופן זמני עקב בעיות אבטחה או שימוש לרעה.',
            'reason_3' => 'ייתכן שביצעת שגיאת כתיב!',
            'reason_header' => 'קיימות כמה סיבות אפשריות לכך:',
            'title' => 'משתמש לא נמצא! ;_;',
        ],
        'page' => [
            'button' => 'ערוך עמוד פרופיל',
            'description' => '<strong>אני!</strong> הוא אזור אישי מותאם אישית בעמוד הפרופיל שלך.',
            'edit_big' => 'ערוך אותי!',
            'placeholder' => 'הקלד את תוכן העמוד כאן',

            'restriction_info' => [
                '_' => '',
                'link' => '',
            ],
        ],
        'post_count' => [
            '_' => 'תרם :link',
            'count' => ':count_delimited פוסט|:count_delimited פוסטים',
        ],
        'rank' => [
            'country' => 'דירוג מדינה ל- :mode',
            'country_simple' => 'דירוג מדינה',
            'global' => 'דירוג עולמי ל- :mode',
            'global_simple' => 'דירוג עולמי',
        ],
        'stats' => [
            'hit_accuracy' => 'דיוק פגיעה',
            'level' => 'רמה :level',
            'level_progress' => 'התקדמות לרמה הבאה',
            'maximum_combo' => 'רצף מירבי',
            'medals' => 'מדליות',
            'play_count' => 'מספר משחקים',
            'play_time' => 'סך הכל זמן משחק',
            'ranked_score' => 'תוצאה מדורגת',
            'replays_watched_by_others' => 'שידורים חוזרים שנצפו על ידי אחרים',
            'score_ranks' => 'דירוגי תוצאות',
            'total_hits' => 'סך כל הפגיעות',
            'total_score' => 'סך כל התוצאות',
            // modding stats
            'ranked_and_approved_beatmapset_count' => '',
            'loved_beatmapset_count' => '',
            'unranked_beatmapset_count' => '',
            'graveyard_beatmapset_count' => '',
        ],
    ],

    'status' => [
        'all' => 'הכל',
        'online' => 'מחובר',
        'offline' => 'מנותק',
    ],
    'store' => [
        'saved' => 'משתמש נוצר',
    ],
    'verify' => [
        'title' => 'אימות חשבון',
    ],

    'view_mode' => [
        'card' => '',
        'list' => '',
    ],
];
