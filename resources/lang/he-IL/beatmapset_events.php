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
    'event' => [
        'approve' => 'מאושרת.',
        'discussion_delete' => 'מנהל מחק דיון :discussion.',
        'discussion_lock' => 'דיון למפה זו בוטל. (:text)',
        'discussion_post_delete' => 'מנהל מחק הודעה מדיון :discussion.',
        'discussion_post_restore' => 'מנהל שחזר הודעה מדיון :discussion.',
        'discussion_restore' => 'מנהל שחזר דיון :discussion.',
        'discussion_unlock' => 'דיון למפה זו בוטל.',
        'disqualify' => 'נפסל על ידי :user. סיבה: :discussion (:text).',
        'disqualify_legacy' => 'נפסל על ידי :user. סיבה: :text.',
        'issue_reopen' => 'בעיה שנפתרה :discussion נפתח מחדש.',
        'issue_resolve' => 'בעיה :discussion מסומנת כנפתרה.',
        'kudosu_allow' => 'דחיית kudosu לדיון :discussion הוסרה.',
        'kudosu_deny' => 'דיון :discussion נדחה ל- kudosu.',
        'kudosu_gain' => 'דיון :discussion על ידי :user השיג מספיק הצבעות בשביל kudosu.',
        'kudosu_lost' => 'דיון :discussion על ידי :user איבד הצבעות ו kudosu שהוענק הוסר.',
        'kudosu_recalculate' => 'לדיון :discussion התבצע חישוב מחדש ל- kudosu.',
        'love' => 'אהובה על-ידי :user',
        'nominate' => 'מונתה על ידי :user.',
        'nomination_reset' => 'בעיה חדשה :discussion (:text) הפעילה את איפוס המינוי.',
        'qualify' => 'מפה זו הגיעה למספר הנדרש של מינויים והוסמכה.',
        'rank' => 'מדורגת.',
    ],

    'index' => [
        'title' => 'אירועי סט מפות',

        'form' => [
            'period' => 'תקופה',
            'types' => 'סוגים',
        ],
    ],

    'item' => [
        'content' => 'תוכן',
        'discussion_deleted' => '[נמחק]',
        'type' => 'סוג',
    ],

    'type' => [
        'approve' => 'אישור',
        'discussion_delete' => 'מחיקת דיון',
        'discussion_post_delete' => 'מחיקת תגובת דיון',
        'discussion_post_restore' => 'שחזור תגובת דיון',
        'discussion_restore' => 'שחזור דיון',
        'disqualify' => 'פסילה',
        'issue_reopen' => 'פתיחה מחדש של דיון',
        'issue_resolve' => 'פתרון של דיון',
        'kudosu_allow' => 'קצבת kudosu',
        'kudosu_deny' => 'שלילת kudosu',
        'kudosu_gain' => 'רווח kudosu',
        'kudosu_lost' => 'הפסד kudosu',
        'kudosu_recalculate' => 'חישוב מחדש של kudosu',
        'love' => 'אוהב',
        'nominate' => 'מינוי',
        'nomination_reset' => 'איפוס מינוי',
        'qualify' => 'הסמכה',
        'rank' => 'דירוג',
    ],
];
