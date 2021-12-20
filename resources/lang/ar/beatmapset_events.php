<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'event' => [
        'approve' => 'مقبولة.',
        'beatmap_owner_change' => 'مالك الصعوبة :beatmap تغير إلى :new_user.',
        'discussion_delete' => 'المشرف حذف المناقشة :discussion.',
        'discussion_lock' => 'تم ايقاف المناقشة لهذه الخريطة. (:text)',
        'discussion_post_delete' => 'المشرف حذف منشور من المناقشة :discussion.',
        'discussion_post_restore' => 'المشرف اِستعاد منشور من المناقشة :discussion.',
        'discussion_restore' => 'اِستعاد المشرف المناقشة :discussion.',
        'discussion_unlock' => 'تم تشغيل المناقشة لهذه الخريطة.',
        'disqualify' => 'استبعدت بواسطة :user. السبب::discussion (:text).',
        'disqualify_legacy' => 'استبعدت بواسطة :user. السبب::text.',
        'genre_edit' => 'تم تغيير النوع من :old الى :new.',
        'issue_reopen' => 'اُعيد فتح المشكلة :discussion المحلولة مسبقاََ.',
        'issue_resolve' => 'المشكلة :discussion عُلمت كـ محلولة.',
        'kudosu_allow' => 'لقد تمت إزالة الحرمان من كودوسو للمناقشة :discussion.',
        'kudosu_deny' => 'المناقشة :discussion حُرِمت من كودوسو.',
        'kudosu_gain' => 'المناشقة :discussion بواسطة :user حصلت على اصوات كافية للكودوسو.',
        'kudosu_lost' => 'المناقشة :discussion بواسطة :user خسرت اصواتاََ وتم حذف كودوسو.',
        'kudosu_recalculate' => 'المناقشة :discussion حصلت على اعادة حساب الكودوسو.',
        'language_edit' => 'تم تغيير اللغة من :old الى :new.',
        'love' => 'حُبِبت بواسطة :user',
        'nominate' => 'رُشحت بواسطة :user.',
        'nominate_modes' => 'تم ترشيحها بواسطة :user (:modes).',
        'nomination_reset' => 'اثارت المشكلة :discussion (:text) اِعادة تعيين الترشيح.',
        'nomination_reset_received' => '',
        'nomination_reset_received_profile' => '',
        'qualify' => 'هذه الخريطة وصلت إلى العدد المطلوب من الترشيحات وتأهلت.',
        'rank' => 'مصفوفة.',
        'remove_from_loved' => 'تمت إزالتها من "المحبوبة" من قِبَل :user. (:text)',

        'nsfw_toggle' => [
            'to_0' => 'تصيف "محتوى حساس" مَلغي',
            'to_1' => 'مٌصنف كـ "محتوى حساس"',
        ],
    ],

    'index' => [
        'title' => 'أحداث الخريطة',

        'form' => [
            'period' => 'الفترة',
            'types' => 'الأنواع',
        ],
    ],

    'item' => [
        'content' => 'المحتوى',
        'discussion_deleted' => '[deleted]',
        'type' => 'النوع',
    ],

    'type' => [
        'approve' => 'موافقة',
        'beatmap_owner_change' => 'تغير مالك صعوبة',
        'discussion_delete' => 'حذف مناقشة',
        'discussion_post_delete' => 'حذف رد مناقشة',
        'discussion_post_restore' => 'إعادة رد مناقشة',
        'discussion_restore' => 'إعادة مناقشة',
        'disqualify' => 'فقدان أهلية',
        'genre_edit' => 'تعديل نوع',
        'issue_reopen' => 'إعادة فتح باب مناقشة',
        'issue_resolve' => 'حل مناقشة',
        'kudosu_allow' => 'سماح كودوسو',
        'kudosu_deny' => 'رفض كودوسو',
        'kudosu_gain' => 'كسب كودوسو',
        'kudosu_lost' => 'خسارة كودوسو',
        'kudosu_recalculate' => 'حساب كودوسو',
        'language_edit' => 'تعديل اللغة',
        'love' => 'حُب',
        'nominate' => 'ترشيح',
        'nomination_reset' => 'إعادة تعيين الترشيح',
        'nomination_reset_received' => '',
        'nsfw_toggle' => 'تصنيف حساس',
        'qualify' => 'المؤهل',
        'rank' => 'الترتيب',
        'remove_from_loved' => 'اِزبالة من "المحبوبة"',
    ],
];
