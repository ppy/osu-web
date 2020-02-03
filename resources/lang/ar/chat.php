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
    'limitation_notice' => 'ملاحظة: فقط الأشخاص الذين يستعملون <a href=":lazer_link">osu!lazer</a> او الموقع الجديد سوف يستلمون رسائل خاصة من خلال هذا النظام.<br/>اذا لم تكن متأكداََ, ارسل هذه الرسائل عبر <a href=":oldpm_link">صفحة المنتدى القديمة لأرسال الرسائل</a>بدلا من ذلك.',
    'talking_in' => 'يتحدث في :channel',
    'talking_with' => 'يتحدث مع :name',
    'title_compact' => 'محادثة',

    'cannot_send' => [
        'channel' => 'لا يمكنك الاِرسال في هذه القناة حاليا. قد يكون هذا سبب لأي من الأسباب التالية:',
        'user' => 'لا يمكنك الاِرسال لهذا المستخدم حاليا. قد يكون هذا سبب لأي من الأسباب التالية:',
        'reasons' => [
            'blocked' => 'تم حظرك بواسطة المستلم',
            'channel_moderated' => 'القناة تحت الأدارة',
            'friends_only' => 'يقبل المستلم الرسائل من الناس في قائمة الأصدقاء فقط',
            'restricted' => 'أنت مقيد حاليا',
            'target_restricted' => 'المستلم مقيد حاليا',
        ],
    ],
    'input' => [
        'disabled' => 'غير قادر على إرسال الرسالة...',
        'placeholder' => 'اكتب الرسالة...',
        'send' => 'إرسال',
    ],
    'no-conversations' => [
        'howto' => "بدء محادثات من ملف تعريف المستخدم أو منبثقة بطاقة المستخدم.",
        'lazer' => 'القنوات العامة التي تنضم اليها عن طريق <a href=":link"> osu!lazer</a> سوف تكون مرئية هنا ايضا.',
        'pm_limitations' => 'فقط الناس الذين يستخدمون <a href=":link">osu!lazer</a> او الموقع الجديد سيستلمون رسائل خاصة.',
        'title' => 'لا محادثات بعد',
    ],
];
