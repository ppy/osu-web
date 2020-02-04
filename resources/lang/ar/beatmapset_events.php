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
        'approve' => 'مقبولة.',
        'discussion_delete' => 'المشرف حذف المناقشة :discussion.',
        'discussion_lock' => 'تم ايقاف المناقشة لهذه الخريطة. (:text)',
        'discussion_post_delete' => 'المشرف حذف منشور من المناقشة :discussion.',
        'discussion_post_restore' => 'المشرف اِستعاد منشور من المناقشة :discussion.',
        'discussion_restore' => 'اِستعاد المشرف المناقشة :discussion.',
        'discussion_unlock' => 'تم تشغيل المناقشة لهذه الخريطة.',
        'disqualify' => 'استبعدت بواسطة :user. السبب::discussion (:text).',
        'disqualify_legacy' => 'استبعدت بواسطة :user. السبب::text.',
        'issue_reopen' => 'اُعيد فتح المشكلة :discussion المحلولة مسبقاََ.',
        'issue_resolve' => 'المشكلة :discussion عُلمت كـ محلولة.',
        'kudosu_allow' => 'لقد تمت إزالة الحرمان من كودوسو للمناقشة :discussion.',
        'kudosu_deny' => 'المناقشة :discussion حُرِمت من كودوسو.',
        'kudosu_gain' => 'المناشقة :discussion بواسطة :user حصلت على اصوات كافية للكودوسو.',
        'kudosu_lost' => 'المناقشة :discussion بواسطة :user خسرت اصواتاََ وتم حذف كودوسو.',
        'kudosu_recalculate' => 'المناقشة :discussion حصلت على اعادة حساب الكودوسو.',
        'love' => 'حُبِبت بواسطة :user',
        'nominate' => 'رُشحت بواسطة :user.',
        'nomination_reset' => 'اثارت المشكلة :discussion (:text) اِعادة تعيين الترشيح.',
        'qualify' => 'هذه الخريطة وصلت إلى العدد المطلوب من الترشيحات وتأهلت.',
        'rank' => 'مصفوفة.',
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
        'discussion_delete' => 'حذف المناقشة',
        'discussion_post_delete' => 'حذف رد المناقشة',
        'discussion_post_restore' => 'إعادة رد المناقشة',
        'discussion_restore' => 'إعادة المناقشة',
        'disqualify' => 'فقدان الأهلية',
        'issue_reopen' => 'إعادة فتح باب المناقشة',
        'issue_resolve' => 'حل المناقشة',
        'kudosu_allow' => 'تبديل كودوسو',
        'kudosu_deny' => 'رفض كودوسو',
        'kudosu_gain' => 'كسب كودوسو',
        'kudosu_lost' => 'خسارة كودوسو',
        'kudosu_recalculate' => 'حساب كودوسو',
        'love' => 'حُب',
        'nominate' => 'ترشيح',
        'nomination_reset' => 'إعادة تعيين الترشيح',
        'qualify' => 'المؤهل',
        'rank' => 'الترتيب',
    ],
];
