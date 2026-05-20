<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'applications' => [
        'accept' => [
            'ok' => 'تم إضافة مستخدم إلى الفريق.',
        ],
        'destroy' => [
            'ok' => '',
        ],
        'reject' => [
            'ok' => '',
        ],
        'store' => [
            'ok' => 'تم إرسال طلب الانضمام إلى الفريق.',
        ],
    ],

    'card' => [
        'members' => '',
    ],

    'create' => [
        'submit' => 'إنشاء فريق',

        'form' => [
            'name_help' => '',
            'short_name_help' => 'الحد الأقصى 4 أحرف.',
            'title' => "لنقم بإنشاء فريق جديد",
        ],

        'intro' => [
            'description' => "",
            'title' => '',
        ],
    ],

    'destroy' => [
        'ok' => '',
    ],

    'edit' => [
        'ok' => 'تم حفظ الإعدادات بنجاح.',
        'title' => 'إعدادات الفريق',

        'description' => [
            'label' => '',
            'title' => 'وصف الفريق',
        ],

        'flag' => [
            'label' => 'علم الفريق',
            'title' => 'تعيين علم الفريق',
        ],

        'header' => [
            'label' => '',
            'title' => '',
        ],

        'settings' => [
            'application_help' => '',
            'default_ruleset_help' => '',
            'flag_help' => '',
            'header_help' => '',
            'title' => 'إعدادات الفريق',

            'application_state' => [
                'state_0' => '',
                'state_1' => '',
            ],
        ],
    ],

    'header_links' => [
        'edit' => '',
        'leaderboard' => 'الترتيب',
        'show' => 'معلومات',

        'members' => [
            'index' => '',
        ],
    ],

    'leaderboard' => [
        'global_rank' => 'الترتيب العالمي',
    ],

    'members' => [
        'destroy' => [
            'success' => 'تمت إزالة عضو من الفريق',
        ],

        'index' => [
            'title' => '',

            'applications' => [
                'accept_confirm' => '',
                'created_at' => '',
                'empty' => '',
                'empty_slots' => '',
                'empty_slots_overflow' => '',
                'reject_confirm' => '',
                'title' => '',
            ],

            'table' => [
                'joined_at' => '',
                'remove' => '',
                'remove_confirm' => '',
                'set_leader' => 'نقل قيادة الفريق',
                'set_leader_confirm' => '',
                'status' => '',
                'title' => '',
            ],

            'status' => [
                'status_0' => '',
                'status_1' => '',
            ],
        ],

        'set_leader' => [
            'success' => 'المستخدم :user هو الآن قائد الفريق.',
        ],
    ],

    'part' => [
        'ok' => '',
    ],

    'show' => [
        'bar' => [
            'chat' => 'محادثة الفريق',
            'destroy' => 'تفكيك الفريق',
            'join' => '',
            'join_cancel' => '',
            'part' => 'مغادرة الفريق',
        ],

        'info' => [
            'created' => '',
        ],

        'members' => [
            'members' => 'أعضاء الفريق',
            'owner' => 'قائد الفريق',
        ],

        'sections' => [
            'about' => '',
            'info' => 'معلومات',
            'members' => '',
        ],

        'statistics' => [
            'empty_slots' => '',
            'first_places' => '',
            'leader' => 'قائد الفريق',
            'rank' => '',
            'ranked_beatmapsets' => '',
        ],
    ],

    'store' => [
        'ok' => 'تم إنشاء الفريق.',
    ],
];
