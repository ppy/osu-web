<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'header' => [
        'small' => 'تنافس بطرق أكثر من مجرد النقر فوق الدوائر.',
        'large' => 'مسابقات المجتمع',
    ],

    'index' => [
        'nav_title' => 'الجدولة',
    ],

    'judge' => [
        'comments' => '',
        'hide_judged' => 'إخفاء المُدخلات المحكوم عليها',
        'nav_title' => 'تحكيم',
        'no_current_vote' => 'لم تصوت بعد.',
        'update' => 'تحديث',
        'validation' => [
            'missing_score' => 'درجة مفقودة',
            'contest_vote_judged' => 'لا يمكنك التصويت في المسابقات ذات التحكيم',
        ],
        'voted' => 'لقد سبق لك التصويت على هذا المُدخل.',
    ],

    'judge_results' => [
        '_' => 'تحكيم النتائج',
        'creator' => 'المنشئ',
        'score' => 'درجة',
        'score_std' => '',
        'total_score' => 'مجموع الدرجات',
        'total_score_std' => '',
    ],

    'voting' => [
        'judge_link' => 'أنت حكم في هذه المسابقة. أُحكم على المُدخلات هنا!',
        'judged_notice' => 'تستخدم هذه المسابقة نظام التحكيم. يقوم الحكّام بمعالجة المُدخلات حالياً.',
        'login_required' => 'يرجى تسجيل الدخول للتصويت.',
        'over' => 'لقد انتهى التصويت لهذه المسابقة',
        'show_voted_only' => 'إظهار التصويت',

        'best_of' => [
            'none_played' => "لا يبدو وكأنه قد لعبت اي خرائط تؤهلك لهذه المسابقة!",
        ],

        'button' => [
            'add' => 'تصويت',
            'remove' => 'إزالة التصويت',
            'used_up' => 'لقد استنفذت كافة اصواتك',
        ],

        'progress' => [
            '_' => ':used \ :max اصوات مستخدمة',
        ],

        'requirement' => [
            'playlist_beatmapsets' => [
                'incomplete_play' => 'يجب لعب جميع الخرائط في قوائم التشغيل المحددة قبل التصويت',
            ],
        ],
    ],

    'entry' => [
        '_' => 'مشاركة',
        'login_required' => 'الرجاء تسجيل الدخول للمشاركة في المسابقة.',
        'silenced_or_restricted' => 'لا يمكنك دخول المسابقات بينما تكون مقيد أو صامت.',
        'preparation' => 'نحن نقوم حاليا بإعداد هذه المسابقة. الرجاء الانتظار بصبر!',
        'drop_here' => 'ضع مشاركتك هنا',
        'download' => 'تحميل .osz',

        'wrong_type' => [
            'art' => 'تُقبل ملفات.jpg و.png فقط لهذه المسابقة.',
            'beatmap' => 'تُقبل ملفات .osu فقط لهذه المسابقة.',
            'music' => 'تُقبل ملفات .mp3 فقط لهذه المسابقة.',
        ],

        'wrong_dimensions' => 'مشاركات هذه المسابقة يجب ان تكون :widthx:height',
        'too_big' => 'مشاركات هذه المسابقة يمكن ان تصل الى :limit.',
    ],

    'beatmaps' => [
        'download' => 'تحميل المشاركة',
    ],

    'vote' => [
        'list' => 'الأصوات',
        'count' => ':count_delimited تصويت|:count_delimited الاصوات',
        'points' => ':count_delimited نقطة|:count_delimited نقاط',
        'points_float' => '',
    ],

    'dates' => [
        'ended' => 'انتهت :date',
        'ended_no_date' => 'انتهت',

        'starts' => [
            '_' => 'يبدأ :date',
            'soon' => 'قريبا™',
        ],
    ],

    'states' => [
        'entry' => 'المشاركة مفتوحة',
        'voting' => 'بدأ التصويت',
        'results' => 'النتائج خرجت',
    ],

    'show' => [
        'admin' => [
            'page' => '',
        ],
    ],
];
