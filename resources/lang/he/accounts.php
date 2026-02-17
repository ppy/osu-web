<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'edit' => [
        'title_compact' => 'הגדרות',
        'username' => 'שם משתמש',

        'avatar' => [
            'title' => 'תמונת פרופיל',
            'reset' => 'אפס',
            'rules' => 'אנא וודא שתמונת הפרופיל שלכם תקינה לפי :link.<br/>זאת אומרת שהיא חייבת להיות <strong>מתאימה לכל הגילאים</strong>. לדוגמה: ללא עירום, תוכן מרמז, תוכן פוגעני.',
            'rules_link' => 'חוקי הקהילה',
        ],

        'email' => [
            'new' => 'דואר אלקטרוני חדש',
            'new_confirmation' => 'אישור דואר אלקטרוני חדש',
            'title' => 'דואר אלקטרוני',
            'locked' => [
                '_' => 'אנא צרו קשר עם ה:accounts אם אתם צריכים לעדכן את הדואר האלקטרוני שלכם.',
                'accounts' => 'צוות תמיכת חשבון',
            ],
        ],

        'legacy_api' => [
            'api' => 'api',
            'irc' => 'irc',
            'title' => 'api דור קודם',
        ],

        'password' => [
            'current' => 'סיסמה נוכחית',
            'new' => 'סיסמה חדשה',
            'new_confirmation' => 'אישור סיסמה',
            'title' => 'סיסמה',
        ],

        'profile' => [
            'country' => 'מדינה',
            'title' => 'פרופיל',

            'country_change' => [
                '_' => "זה נראה שמדינת החשבון שלכם לא תואמת את מדינת המגורים שלכם.",
                'update_link' => 'עדכן ל:country',
            ],

            'user' => [
                'user_discord' => '',
                'user_from' => 'מיקום נוכחי',
                'user_interests' => 'תחומי עניין',
                'user_occ' => 'עיסוק',
                'user_twitter' => '',
                'user_website' => 'אתר אינטרנטי',
            ],
        ],

        'signature' => [
            'title' => 'חותמת',
            'update' => 'עדכן',
        ],
    ],

    'github_user' => [
        'info' => "",
        'link' => '',
        'title' => 'גיטהאב',
        'unlink' => '',

        'error' => [
            'already_linked' => '',
            'no_contribution' => '',
            'unverified_email' => '',
        ],
    ],

    'notifications' => [
        'beatmapset_discussion_qualified_problem' => 'לקבל הודעת בעת תקלה במפה מאומתת במודים הנלווים',
        'beatmapset_disqualify' => 'קבלת התראות עבור כאשר מפות השייכות למצבי המשחק הבאים נפסלות',
        'comment_reply' => 'קבל התראות עבור מענות לתגובות שלכם',
        'news_post' => '',
        'title' => 'התראות',
        'topic_auto_subscribe' => 'קבלת התראות אוטומטית בפורום אשר נוצר על ידך',

        'options' => [
            '_' => 'אפשרויות משלוח',
            'beatmap_owner_change' => '',
            'beatmapset:modding' => 'תומך יותר המפה',
            'channel_message' => 'הודעות פרטיות',
            'channel_team' => '',
            'comment_new' => 'תגובות חדשות',
            'forum_topic_reply' => 'תגובה על הנושא',
            'mail' => 'דואר אלקטרוני',
            'mapping' => '',
            'news_post' => '',
            'push' => 'דחיפה',
        ],
    ],

    'oauth' => [
        'authorized_clients' => 'קליינט מורשה',
        'own_clients' => 'קליינט אישי',
        'title' => 'OAuth',
    ],

    'options' => [
        'beatmapset_show_anime_cover' => '',
        'beatmapset_show_nsfw' => '',
        'beatmapset_title_show_original' => 'הראה נתוני מפה בשפה המקורית',
        'title' => 'אפשרויות',

        'beatmapset_download' => [
            '_' => 'סוג סטנדרטי להורדת מפות',
            'all' => 'עם וידיאו אם אפשר',
            'direct' => 'לפתוח ב-osu!direct',
            'no_video' => 'בלי וידיאו',
        ],
    ],

    'playstyles' => [
        'keyboard' => 'מקלדת',
        'mouse' => 'עכבר',
        'tablet' => 'לוח גרפי',
        'title' => 'צורת משחק',
        'touch' => 'מסך מגע',
    ],

    'privacy' => [
        'friends_only' => 'לחסום הודעות פרטיות מאנשים לא ברשימת החברים שלך',
        'hide_online' => 'הסתר את הנוכחות המקוונת שלך',
        'hide_online_info' => '',
        'title' => '僅用於中文',
    ],

    'security' => [
        'current_session' => 'נוכחי',
        'end_session' => 'סיים סשן',
        'end_session_confirmation' => 'זה יסיים מיד את הסשן שלך על המכשיר הזה. האם אתה בטוח?',
        'last_active' => 'פעילות אחרונה:',
        'title' => 'אבטחה',
        'web_sessions' => 'סשנים אינטרנטיים',
    ],

    'update_email' => [
        'update' => 'עדכן',
    ],

    'update_password' => [
        'update' => 'עדכן',
    ],

    'user_totp' => [
        'title' => '',
        'usage_note' => '',

        'button' => [
            'remove' => '',
            'setup' => '',
        ],
        'status' => [
            'label' => '',
            'not_set' => '',
            'set' => '',
        ],
    ],

    'verification_completed' => [
        'text' => 'אתה יכול לסגור חלון זה עכשיו',
        'title' => 'האימות הושלם',
    ],

    'verification_invalid' => [
        'title' => 'קישור האימות פג או לא תקף',
    ],
];
