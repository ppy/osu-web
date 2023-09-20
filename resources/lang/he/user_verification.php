<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'box' => [
        'sent' => 'דוא"ל נשלח ל- :mail עם קוד אימות. הזן את הקוד.',
        'title' => 'אימות חשבון',
        'verifying' => 'מאמת...',
        'issuing' => 'מנפיק קוד חדש...',

        'info' => [
            'check_spam' => "ודא לבדוק את תיקיית הספאם במידה ואתם לא מוצאים את הדוא\"ל.",
            'recover' => "אם אין לכם גישה לדוא\"ל שלכם או ששכחתם במה השתמשתם, עקוב אחרי ה:link.",
            'recover_link' => 'תהליך שחזור אימייל כאן',
            'reissue' => 'אתה יכול גם :reissue_link או :logout_link.',
            'reissue_link' => 'בקש קוד נוסף',
            'logout_link' => 'יציאה',
        ],
    ],

    'errors' => [
        'expired' => 'קוד האימות פג, נשלח דוא"ל אימות חדש.',
        'incorrect_key' => 'קוד אימות שגוי.',
        'retries_exceeded' => 'קוד אימות שגוי. חריגה ממגבלת הנסיונות, אימייל אימות חדש נשלח.',
        'reissued' => 'קוד האימות פג, נשלח אימייל אימות חדש.',
        'unknown' => 'אירעה בעיה לא ידוע, נשלח דוא"ל אימות חדש.',
    ],
];
