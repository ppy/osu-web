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
        'members' => ':count_delimited عضو|:count_delimited أعضاء',
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
            'title' => 'فريق!',
        ],
    ],

    'destroy' => [
        'ok' => 'تم حذف الفريق.',
    ],

    'edit' => [
        'ok' => 'تم حفظ الإعدادات بنجاح.',
        'title' => 'إعدادات الفريق',

        'description' => [
            'label' => 'الوصف',
            'title' => 'وصف الفريق',
        ],

        'flag' => [
            'label' => 'علم الفريق',
            'title' => 'تعيين علم الفريق',
        ],

        'header' => [
            'label' => 'صورة الغلاف',
            'title' => 'تعيين صورة الغلاف',
        ],

        'settings' => [
            'application_help' => 'ما إذا كان سيُسمح للأشخاص بالتقدم للانضمام إلى الفريق',
            'default_ruleset_help' => '',
            'flag_help' => 'الحد الأقصى للحجم: :width×:height',
            'header_help' => 'الحد الأقصى للحجم: :width×:height',
            'title' => 'إعدادات الفريق',

            'application_state' => [
                'state_0' => 'مغلق',
                'state_1' => 'مفتوح',
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
                'created_at' => 'تم الطلب في',
                'empty' => 'لا توجد طلبات انضمام في الوقت الحالي.',
                'empty_slots' => 'الفتحات المتاحة',
                'empty_slots_overflow' => ':count_delimited تجاوز المستخدم|:count_delimited تجاوز المستخدمين',
                'reject_confirm' => 'هل تريد رفض طلب الانضمام من المستخدم :user؟',
                'title' => 'طلبات الانضمام',
            ],

            'table' => [
                'joined_at' => 'تاريخ الانضمام',
                'remove' => 'إزالة',
                'remove_confirm' => 'هل تريد إزالة المستخدم :user من الفريق؟',
                'set_leader' => 'نقل قيادة الفريق',
                'set_leader_confirm' => 'هل تريد نقل قيادة الفريق إلى المستخدم :user؟',
                'status' => 'الحالة',
                'title' => 'الأعضاء الحاليون',
            ],

            'status' => [
                'status_0' => 'غير نشط',
                'status_1' => 'نشط',
            ],
        ],

        'set_leader' => [
            'success' => 'المستخدم :user هو الآن قائد الفريق.',
        ],
    ],

    'part' => [
        'ok' => 'غادر الفريق ;_;',
    ],

    'show' => [
        'bar' => [
            'chat' => 'محادثة الفريق',
            'destroy' => 'تفكيك الفريق',
            'join' => 'أطلب الانضمام',
            'join_cancel' => 'إلغاء طلب الانضمام',
            'part' => 'مغادرة الفريق',
        ],

        'info' => [
            'created' => 'تأسَّس',
        ],

        'members' => [
            'members' => 'أعضاء الفريق',
            'owner' => 'قائد الفريق',
        ],

        'sections' => [
            'about' => 'نبذة عنا!',
            'info' => 'معلومات',
            'members' => 'الأعضاء',
        ],

        'statistics' => [
            'empty_slots' => ':count_delimited فتحة متاحة|:count_delimited فتحات متاحة',
            'first_places' => 'المراكز الأولى',
            'leader' => 'قائد الفريق',
            'rank' => 'الترتيب',
            'ranked_beatmapsets' => 'خرائط الإيقاع المصنّفة',
        ],
    ],

    'store' => [
        'ok' => 'تم إنشاء الفريق.',
    ],
];
