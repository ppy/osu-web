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
    'index' => [
        'none_running' => 'אין טורנירים שרצים כרגע, נא בדוק מאוחר יותר!',
        'registration_period' => 'הרשמה: :start ל- :end',

        'header' => [
            'title' => 'טורנירים קהילתיים',
        ],

        'item' => [
            'registered' => 'שחקנים רשומים',
        ],

        'state' => [
            'current' => 'טורנירים פעילים',
            'previous' => 'טורנירים קודמים',
        ],
    ],

    'show' => [
        'banner' => 'תמוך בקבוצה שלך',
        'entered' => 'אתה רשום לטורניר הזה.<br><br>נא שים לב שזה <b>לא</b> אומר ששוייכת לקבוצה.<br>
<br>הוראות נוספות יישלחו אליך דרך אימייל קרוב יותר לתאריך הטורניר, אז בבקשה וודא שהאימייל של חשבון ה- osu! שלך תקין!',
        'info_page' => 'עמוד מידע',
        'login_to_register' => 'נא :login כדי לראות פרטי הרשמה!',
        'not_yet_entered' => 'אינך רשום לטורניר זה.',
        'rank_too_low' => 'סליחה, אינך עומד בדרישות הדירוג לטורניר זה!',
        'registration_ends' => 'הרשמות נסגרות בתאריך :date',

        'button' => [
            'cancel' => 'בטל הרשמה',
            'register' => 'תרשום אותי!',
        ],

        'period' => [
            'end' => '',
            'start' => '',
        ],

        'state' => [
            'before_registration' => 'הרשמה לטורניר זה עדיין לא נפתחה.',
            'ended' => 'טורניר זה הסתיים. בדוק את עמוד המידע בשביל התוצאות.',
            'registration_closed' => 'הרשמה לטורניר זה סגורה. בדוק את עמוד המידע בשביל עדכונים אחרונים.',
            'running' => 'טורניר זה כרגע בתהליך. בדוק את עמוד המידע בשביל פרטים נוספים.',
        ],
    ],
    'tournament_period' => ':start ל- :end',
];
