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
    'limitation_notice' => 'הערה: רק אנשים שמשתמשים ב- <a href=":lazer_link">osu!lazer</a> או באתר החדש יקבלו הודעות פרטיות דרך מערכת זו.<br/>אם אתה לא בטוח, שלח להם הודעה דרך <a href=":oldpm_link">עמוד הפורום הישן</a> במקום.',
    'talking_in' => 'מדבר ב- :channel',
    'talking_with' => 'מדבר עם :name',
    'title_compact' => 'צ\'אט',

    'cannot_send' => [
        'channel' => 'אתה לא יכול לשלוח הודעה בערוץ הזה כרגע. זה יכול להיות בגלל הסיבות הבאות:',
        'user' => 'אתה לא יכול לשלוח הודעה למשתמש הזה כרגע. זה יכול להיות בגלל הסיבות הבאות:',
        'reasons' => [
            'blocked' => 'נחסמת על ידי הנמען',
            'channel_moderated' => 'ערוץ זה מנוהל',
            'friends_only' => 'הנמען מקבל הודעות רק מאנשים שברשימת החברים שלו',
            'restricted' => 'אתה כרגע מוגבל',
            'target_restricted' => 'הנמען כרגע מוגבל',
        ],
    ],
    'input' => [
        'disabled' => 'אין אפשרות לשלוח את ההודעה...',
        'placeholder' => 'הקלד הודעה...',
        'send' => 'שלח',
    ],
    'no-conversations' => [
        'howto' => "התחל שיחות מפרופיל של משתמש או כרטיס משתמש קופץ.",
        'lazer' => 'ערוצים ציבוריים שאתה מצטרף אליהם דרך <a href=":link">osu!lazer</a> יהיו כאן.',
        'pm_limitations' => 'רק אנשים שמשתמשים ב- <a href=":link">osu!lazer</a> או באתר החדש יקבלו הודעות פרטיות.',
        'title' => 'אין שיחות עדיין',
    ],
];
