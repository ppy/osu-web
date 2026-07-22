<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'applications' => [
        'accept' => [
            'ok' => 'تم إضافة مستخدم إلى الفريق.',
        ],
        'destroy' => [
            'ok' => 'تم إلغاء طلب الانضمام.',
        ],
        'reject' => [
            'ok' => 'تم رفض طلب الانضمام.',
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
            'name_help' => 'الاسم الذي تختاره سيكون دائمًا في الوقت الحالي، لذا احرص على اختياره بعناية.',
            'short_name_help' => 'الحد الأقصى 4 أحرف.',
            'title' => "لنقم بإنشاء فريق جديد",
        ],

        'intro' => [
            'description' => "العب مع أصدقائك، سواء الحاليين أو الجدد. أنت لست ضمن فريق حاليًا. انضم إلى فريق موجود بزيارة صفحته أو أنشئ فريقك الخاص من هذه الصفحة.",
            'search_link' => '',
            'title' => 'فريق!',
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
        'edit' => 'الإعدادات',
        'leaderboard' => 'لوحة الصدارة',
        'show' => 'معلومات',

        'members' => [
            'index' => 'إدارة الأعضاء',
        ],
    ],

    'leaderboard' => [
        'global_rank' => 'التصنيف العالمي',
    ],

    'members' => [
        'destroy' => [
            'success' => 'تمت إزالة عضو من الفريق',
        ],

        'index' => [
            'title' => 'إدارة الأعضاء',

            'applications' => [
                'accept_confirm' => 'هل تريد إضافة المستخدم :user إلى الفريق؟',
                'created_at' => '',
                'empty' => '',
                'empty_slots' => '',
                'empty_slots_overflow' => '',
                'reject_confirm' => 'هل تريد رفض طلب الانضمام من المستخدم :user؟',
                'title' => '',
            ],

            'table' => [
                'joined_at' => '',
                'remove' => '',
                'remove_confirm' => 'هل تريد إزالة المستخدم :user من الفريق؟',
                'set_leader' => 'نقل قيادة الفريق',
                'set_leader_confirm' => 'هل تريد نقل قيادة الفريق إلى المستخدم :user؟',
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
            'ranked_beatmapsets' => 'خرائط الإيقاع المصنّفة',
        ],
    ],

    'store' => [
        'ok' => 'تم إنشاء الفريق.',
    ],
];
