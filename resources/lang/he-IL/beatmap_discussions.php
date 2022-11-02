<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'authorizations' => [
        'update' => [
            'null_user' => 'הינך חייב להיות מחובר כדי לערוך.',
            'system_generated' => 'לא ניתן לערוך הודעה שנוצרה על ידי המערכת.',
            'wrong_user' => 'הינך חייב להיות הבעלים של הפוסט כדי לערוך.',
        ],
    ],

    'events' => [
        'empty' => 'שום דבר לא קרה... עדיין.',
    ],

    'index' => [
        'deleted_beatmap' => 'נמחק',
        'none_found' => 'לא נמצאו אשכולות לפי הקריטריונים המבוקשים.',
        'title' => 'דיוני Beatmap',

        'form' => [
            '_' => 'חיפוש',
            'deleted' => 'כלול דיונים שנמחקו',
            'mode' => '',
            'only_unresolved' => 'הצג רק דיונים פתוחים',
            'types' => 'סוגי הודעות',
            'username' => 'שם משתמש',

            'beatmapset_status' => [
                '_' => 'סטטוס מפות',
                'all' => 'הכל',
                'disqualified' => 'פוסל',
                'never_qualified' => 'טרם הוסמך',
                'qualified' => 'מוסמך',
                'ranked' => 'מדורג',
            ],

            'user' => [
                'label' => 'משתמש',
                'overview' => 'סיכום פעילויות',
            ],
        ],
    ],

    'item' => [
        'created_at' => 'תאריך הפרסום',
        'deleted_at' => 'תאריך מחיקה',
        'message_type' => 'סוג',
        'permalink' => 'קישור קבוע',
    ],

    'nearby_posts' => [
        'confirm' => 'אף אחת מההודעות עונות על ענייני',
        'notice' => 'ישנן הודעות בסביבות :timestamp (:existing_timestamps). נא בדוק אותן לפני פרסום ההודעה.',
        'unsaved' => ':count בסקר זה',
    ],

    'owner_editor' => [
        'button' => '',
        'reset_confirm' => '',
        'user' => '',
        'version' => '',
    ],

    'reply' => [
        'open' => [
            'guest' => 'התחבר כדי להגיב',
            'user' => 'הגב',
        ],
    ],

    'review' => [
        'block_count' => ':used פסקאות מתוך :max שומשו',
        'go_to_parent' => 'צפה בהודעת ביקורת',
        'go_to_child' => 'ראה דיון',
        'validation' => [
            'block_too_large' => 'כל פסקה יכולה להכיל עד :limit תווים',
            'external_references' => 'סקר המכיל דברים לא קשורים לנושא הנבחר',
            'invalid_block_type' => 'סוג פסקה שגוי',
            'invalid_document' => 'ביקורת שגויה',
            'invalid_discussion_type' => '',
            'minimum_issues' => 'תגובה חייבת להכיל לפחות :count נושאים|ביקורת חייבת להכיל לפחות:count נושאים',
            'missing_text' => 'חסר טקסט בתיבה',
            'too_many_blocks' => 'תגובה יכולה להכיל רק:count פסקה/ביקורת יכולים להכיל עד:count ',
        ],
    ],

    'system' => [
        'resolved' => [
            'true' => 'מסומן כנפתר על ידי :user',
            'false' => 'נפתח מחדש על ידי :user',
        ],
    ],

    'timestamp_display' => [
        'general' => 'כללי',
        'general_all' => 'כללי (הכל)',
    ],

    'user_filter' => [
        'everyone' => 'כולם',
        'label' => 'סנן לפי משתמש',
    ],
];
