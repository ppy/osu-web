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
        'none_found' => '',
        'title' => 'דיוני Beatmap',

        'form' => [
            '_' => 'חיפוש',
            'deleted' => 'כלול דיונים שנמחקו',
            'only_unresolved' => '',
            'types' => 'סוגי הודעות',
            'username' => 'שם משתמש',

            'beatmapset_status' => [
                '_' => '',
                'all' => '',
                'disqualified' => '',
                'never_qualified' => '',
                'qualified' => '',
                'ranked' => '',
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
    ],

    'reply' => [
        'open' => [
            'guest' => 'התחבר כדי להגיב',
            'user' => 'הגב',
        ],
    ],

    'review' => [
        'go_to_parent' => '',
        'go_to_child' => '',
        'validation' => [
            'invalid_block_type' => '',
            'invalid_document' => '',
            'minimum_issues' => '',
            'missing_text' => '',
            'too_many_blocks' => '',
        ],
    ],

    'system' => [
        'resolved' => [
            'true' => 'מסומן כנפתר על ידי :user',
            'false' => 'נפתח מחדש על ידי :user',
        ],
    ],

    'timestamp_display' => [
        'general' => '',
        'general_all' => '',
    ],

    'user_filter' => [
        'everyone' => 'כולם',
        'label' => 'סנן לפי משתמש',
    ],
];
