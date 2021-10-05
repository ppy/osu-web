<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'authorizations' => [
        'update' => [
            'null_user' => '',
            'system_generated' => '',
            'wrong_user' => '',
        ],
    ],

    'events' => [
        'empty' => '',
    ],

    'index' => [
        'deleted_beatmap' => '',
        'none_found' => '',
        'title' => '',

        'form' => [
            '_' => '',
            'deleted' => '',
            'mode' => '',
            'only_unresolved' => '',
            'types' => 'نوع پیام',
            'username' => 'نام کاربری',

            'beatmapset_status' => [
                '_' => 'وضعیت بیتمپ',
                'all' => 'همه',
                'disqualified' => 'رد صلاحیت',
                'never_qualified' => 'هیچوقت واجد شرایط نشده',
                'qualified' => 'واجد شرايط',
                'ranked' => 'رنک شده',
            ],

            'user' => [
                'label' => 'کاربر',
                'overview' => 'مرور فعالیت ها',
            ],
        ],
    ],

    'item' => [
        'created_at' => 'تاریخ مطلب',
        'deleted_at' => 'تاریخ حذف',
        'message_type' => 'نوع',
        'permalink' => 'پیوند ثابت',
    ],

    'nearby_posts' => [
        'confirm' => '',
        'notice' => '',
        'unsaved' => '',
    ],

    'owner_editor' => [
        'button' => '',
        'reset_confirm' => '',
        'user' => '',
        'version' => '',
    ],

    'reply' => [
        'open' => [
            'guest' => '',
            'user' => '',
        ],
    ],

    'review' => [
        'block_count' => '',
        'go_to_parent' => '',
        'go_to_child' => '',
        'validation' => [
            'block_too_large' => '',
            'external_references' => '',
            'invalid_block_type' => '',
            'invalid_document' => '',
            'invalid_discussion_type' => '',
            'minimum_issues' => '',
            'missing_text' => '',
            'too_many_blocks' => '',
        ],
    ],

    'system' => [
        'resolved' => [
            'true' => '',
            'false' => '',
        ],
    ],

    'timestamp_display' => [
        'general' => '',
        'general_all' => '',
    ],

    'user_filter' => [
        'everyone' => '',
        'label' => '',
    ],
];
