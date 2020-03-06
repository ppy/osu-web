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
