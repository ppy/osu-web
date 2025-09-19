<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'page_description' => 'الفنانين المميزين على osu!',
    'title' => 'الفنانين المميزين',

    'admin' => [
        'hidden' => 'الفنان مُخفى حاليا',
    ],

    'beatmaps' => [
        '_' => 'خرائط الموسيقى',
        'download' => 'تنزيل قالب خريطة',
        'download-na' => 'غير الخريطة غير متوفر حتى الآن',
    ],

    'index' => [
        'description' => 'الفانين المميزين هم فنانين نعمل معهم لغرض توصيل كل اصلي وجديد من الموسيقى على osu!. هؤلاء الفنانون ومجموعة من اغانيهِم تم أُختيرت بواسطة فريق osu! لأنها مناسبة ومطورة لتلبية العمل عليها. بعض من الفنانين قد عملوا على موسيقى جديدة خاصة فقط لـ osu!.<br><br>كل الأغاني في هذا القسم تم توقيتها مسبقا ومقدمة على شكل ملف .osz وهي موثقة ومرخصة بشكل رسمي لاستعمالها في osu! و المحتويات المتعلقة بـ osu!.',
    ],

    'links' => [
        'beatmaps' => 'osu! الخرائط على',
        'osu' => 'ملف شخصي في osu!',
        'site' => 'موقع رسمي',
    ],

    'songs' => [
        '_' => 'الأغاني',
        'count' => ':count_delimited أغنية|:count_delimited أغاني',
        'original' => 'osu! اغنية اصلية',
        'original_badge' => 'اصلي',
    ],

    'tracklist' => [
        'title' => 'العنوان',
        'length' => 'الطول',
        'bpm' => 'bpm',
        'genre' => 'النوع',
    ],

    'tracks' => [
        'index' => [
            '_' => 'البحث عن الإغاني',

            'exclusive_only' => [
                'all' => 'الكل',
                'exclusive_only' => 'أغنية osu! أصلية',
            ],

            'form' => [
                'advanced' => 'بحث متقدم',
                'album' => 'ألبوم',
                'artist' => 'الفنان',
                'bpm_gte' => 'الحد الأدنى لـ BPM',
                'bpm_lte' => 'الحد الأقصى لـ BPM',
                'empty' => 'لم تم العثور على أي اغاني تطابق معايير البحث.',
                'exclusive_only' => 'النوع',
                'genre' => 'الصنف',
                'genre_all' => 'الكل',
                'length_gte' => 'ادنى للطول',
                'length_lte' => 'اقصى طول',
            ],
        ],
    ],
];
