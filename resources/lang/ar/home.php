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
    'landing' => [
        'download' => 'تحميل الآن',
        'online' => '<strong>:players</strong> حاليا متصل في <strong>:games</strong> مباريات',
        'peak' => 'كحد اعلى, :count مستخدمون نشطون',
        'players' => '<strong>:count</strong> لاعبون مُسجلون',
        'title' => 'أهلا وسهلا',
        'see_more_news' => 'عرض المزيد من الأخبار',

        'slogan' => [
            'main' => 'افضل لعبة ايقاع مجانية',
            'sub' => 'الإيقاع بعيد نقرة واحدة فقط',
        ],
    ],

    'search' => [
        'advanced_link' => 'البحث المتقدم',
        'button' => 'بحث',
        'empty_result' => 'لا يوجد شيء!',
        'keyword_required' => 'مطلوب كلمة البحث',
        'placeholder' => 'اكتب للبحث',
        'title' => 'البحث',

        'beatmapset' => [
            'more' => ':count المزيد من نتائج بحث الخرائط',
            'more_simple' => 'انظر للمزيد من نتائج بحث الخرائط',
            'title' => 'خرائط الايقاع',
        ],

        'forum_post' => [
            'all' => 'جميع المنتديات',
            'link' => 'البحث في المنتدى',
            'more_simple' => 'انظر للمزيد من نتائج بحث المنتدى',
            'title' => 'المنتدى',

            'label' => [
                'forum' => 'البحث في المنتديات',
                'forum_children' => 'تضمين المنتديات الفرعية',
                'topic_id' => 'الموضوع #',
                'username' => 'الكاتب',
            ],
        ],

        'mode' => [
            'all' => 'الكل',
            'beatmapset' => 'خريطة',
            'forum_post' => 'منتدى',
            'user' => 'لاعب',
            'wiki_page' => 'ويكي',
        ],

        'user' => [
            'more' => ':count المزيد من نتائج بحث اللاعبين',
            'more_simple' => 'انظر للمزيد من نتائج بحث اللاعبين',
            'more_hidden' => 'بحث اللاعبين محدود الى :max لاعب. حاول تكرير اداة البحث.',
            'title' => 'اللاعبون',
        ],

        'wiki_page' => [
            'link' => 'البحث في الويكي',
            'more_simple' => 'انظر للمزيد من نتائج بحث الويكي',
            'title' => 'ويكي',
        ],
    ],

    'download' => [
        'tagline' => "لنجعلك<br>مستعداََ!",
        'action' => 'حمل osu!',
        'os' => [
            'windows' => 'لنظام التشغيل Windows',
            'macos' => 'لنظام التشغل MacOS',
            'linux' => 'لنظام التشغيل Linux',
        ],
        'mirror' => 'مُباشر',
        'macos-fallback' => 'مستخدمين MacOS',
        'steps' => [
            'register' => [
                'title' => 'احصل على حساب',
                'description' => 'اتبع التعليمات عند بدأ اللعبة لتسجيل الدخول وعمل حساب جديد',
            ],
            'download' => [
                'title' => 'حمل اللعبة',
                'description' => 'اضغط الزر في الأعلى لتحميل المثبت, ثم قم بفتحه!',
            ],
            'beatmaps' => [
                'title' => 'احصل على خرائط',
                'description' => [
                    '_' => ':browse المكتبة الهائلة من الخرائط التي ابتدعها المستخدمون وابدأ اللعب!',
                    'browse' => 'تصفح',
                ],
            ],
        ],
        'video-guide' => 'دليل الفديو',
    ],

    'user' => [
        'title' => 'لوحة المعلومات',
        'news' => [
            'title' => 'الأخبار',
            'error' => 'خطأ في تحميل الأخبار، حاول تحديث الصفحة؟...',
        ],
        'header' => [
            'stats' => [
                'friends' => 'الأصدقاء المتصلون',
                'games' => 'المباريات',
                'online' => 'المستخدمون النشطون',
            ],
        ],
        'beatmaps' => [
            'new' => 'خرائط مصفوفة جديدة',
            'popular' => 'خرائط شعبية',
            'by_user' => 'بواسطة :user',
        ],
        'buttons' => [
            'download' => 'حَمِل osu!',
            'support' => 'اِدعم osu!',
            'store' => 'متجر!osu',
        ],
    ],

    'support-osu' => [
        'title' => 'واو!',
        'subtitle' => 'يبدو انك تستمع بوقتك! :D',
        'body' => [
            'part-1' => 'هل تعلم ان osu! تعمل بدون اعلانات, وتعتمد على اللاعبين لدعم التطوير وتكاليف العمل؟',
            'part-2' => 'هل تعلم ايضا انه بدعم لـ osu! فستحصل على فائض من المميزات الجيدة, مثل <strong>التحميل داخل اللعبة</strong> الذي يعمل تلقائيا عند المشاهدين وغرف اللعب المتعدد؟',
        ],
        'find-out-more' => 'اضغط هنا لمعرفة المزيد!',
        'download-starting' => "اوه, ولا تقلق - تحميلك قد بدأ بالفعل الان ;)",
    ],
];
