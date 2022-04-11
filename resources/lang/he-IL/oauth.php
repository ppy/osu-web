<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'cancel' => 'בטל',

    'authorise' => [
        'request' => 'מבקש הרשאה לגשת למשתמש שלך.',
        'scopes_title' => 'יישום זה יוכל:',
        'title' => 'בקשת הרשאה',
    ],

    'authorized_clients' => [
        'confirm_revoke' => 'האם אתה בטוחמ שאתה רוצה להסיר את ההרשאות של הלקוח?',
        'scopes_title' => 'היישום הזה יכול:',
        'owned_by' => 'בבעלות של :user',
        'none' => 'אין לקוחות',

        'revoked' => [
            'false' => 'לבטל גישה',
            'true' => 'גישה בוטלה',
        ],
    ],

    'client' => [
        'id' => 'ID של הלקוח',
        'name' => 'שם יישום',
        'redirect' => 'כתובת האתר של האפליקציה',
        'reset' => 'איפוס קליינט סודי',
        'reset_failed' => 'נכשל לאפס את הקליינט הסודי',
        'secret' => 'סוד לקוח',

        'secret_visible' => [
            'false' => 'הראה את הקליינט הסודי',
            'true' => 'הסתר את הקליינט הסודי',
        ],
    ],

    'new_client' => [
        'header' => 'הירשם לאפליקציית OAuth חדשה',
        'register' => 'רשום את האפליקציה',
        'terms_of_use' => [
            '_' => 'על ידי שימוש ב API אתה מסכים ל:link.',
            'link' => 'תנאי שימוש',
        ],
    ],

    'own_clients' => [
        'confirm_delete' => 'הבאם אתה בטוח שברצונך למחוק את הקובץ הזה?',
        'confirm_reset' => 'האם אתה בטוח שאתה רוצה לאפס את הקליינט הסודי? כתוצאה מכך, ירד הגישה לכל האסימונים הקיימים.',
        'new' => 'הוסף יישום OAuth',
        'none' => 'אין לקוחות',

        'revoked' => [
            'false' => 'מחק',
            'true' => 'נמחק',
        ],
    ],
];
