<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'pinned_topics' => 'المواضيع المثبتة',
    'slogan' => "من الخطر اللعب بمفردك.",
    'subforums' => 'المنتديات الفرعية',
    'title' => 'منتديات osu!',

    'covers' => [
        'edit' => 'تحرير الغلاف',

        'create' => [
            '_' => 'أضف صورة غلاف',
            'button' => 'رفع صورة',
            'info' => 'يجب أن يكون حجم الغلاف :dimensions. يمكنك أيضا إسقاط صورتك هنا لرفعها.',
        ],

        'destroy' => [
            '_' => 'إزالة صورة الغلاف',
            'confirm' => 'هل أنت متأكد أنك تريد إزالة صورة الغلاف؟',
        ],
    ],

    'forums' => [
        'latest_post' => 'اخر المنشورات',

        'index' => [
            'title' => 'فهرس المنتدى',
        ],

        'topics' => [
            'empty' => 'لا توجد مواضيع!',
        ],
    ],

    'mark_as_read' => [
        'forum' => 'تحديد المنتدى كمقروء',
        'forums' => 'تحديد المنتديات كمقروءة',
        'busy' => 'يتم التحديد كمقروءة...',
    ],

    'post' => [
        'confirm_destroy' => 'اتريد حقاََ حذف المنشور؟',
        'confirm_restore' => 'اتريد حقاََ اِسترجاع المنشور؟',
        'edited' => 'التعديل الأخير تم بواسطة :user :when، عُدِلَ ::count_delimited مرة في المجموع.|التعديل الأخير تم بواسطة :user:when, عُدِلَ ::count_delimited مرات في المجموع.',
        'posted_at' => 'نُشِر :when',
        'posted_by' => 'منشور بواسطة :username',

        'actions' => [
            'destroy' => 'منشور محذوف',
            'edit' => 'تعديل المنشور',
            'report' => 'الإبلاغ عن المنشور',
            'restore' => 'اِستعادة المنشور',
        ],

        'create' => [
            'title' => [
                'reply' => 'رد جديد',
            ],
        ],

        'info' => [
            'post_count' => ':count_delimited منشور|:count_delimited منشورات',
            'topic_starter' => 'كاتب الموضوع',
        ],
    ],

    'search' => [
        'go_to_post' => 'انتقل الى المنشور',
        'post_number_input' => 'ادخل رقم المنشور',
        'total_posts' => ':posts_count المنشورات الكلية',
    ],

    'topic' => [
        'confirm_destroy' => 'حذف الموضوع حقاً؟',
        'confirm_restore' => 'استعادة الموضوع حقاً؟',
        'deleted' => 'موضوع محذوف',
        'go_to_latest' => 'عرض اخر منشور',
        'has_replied' => 'لقد قمت بالرد على هذا الموضوع',
        'in_forum' => 'في :forum',
        'latest_post' => ':when بواسطة :user',
        'latest_reply_by' => 'آخر رد من :user',
        'new_topic' => 'موضوع جديد',
        'new_topic_login' => 'قم بتسجيل الدخول لإضافة موضوع جديد',
        'post_reply' => 'نشر',
        'reply_box_placeholder' => 'اكتب هنا للرد',
        'reply_title_prefix' => 'إعادة',
        'started_by' => 'بواسطة :user',
        'started_by_verbose' => 'بدأت بواسطة :user',

        'actions' => [
            'destroy' => 'حذف الموضوع',
            'restore' => 'استعادة الموضوع',
        ],

        'create' => [
            'close' => 'إغلاق',
            'preview' => 'معاينة',
            // TL note: this is used in the topic reply preview, when
            // the user goes back from previewing to editing the reply
            'preview_hide' => 'كتابة',
            'submit' => 'نشر',

            'necropost' => [
                'default' => 'هذا الموضوع غير نشط لفترة من الوقت. انشر هنا فقط إذا كان لديك سبب محدد للقيام بذلك.',

                'new_topic' => [
                    '_' => "هذا الموضوع غير نشط منذ فترة. اذا لم تكن تملك سبب محدد للنشر هنا, ارجوك :create بدلاََ من النشر.",
                    'create' => 'ابدأ موضوعاً جديداً',
                ],
            ],

            'placeholder' => [
                'body' => 'ادخل محتوى المنشور هنا',
                'title' => 'اضغط هنا لاِدخال عنوان',
            ],
        ],

        'jump' => [
            'enter' => 'اضغط هنا لاِدخال رقم منشور محدد',
            'first' => 'الذهاب إلى المنشور الأول',
            'last' => 'الذهاب إلى آخر منشور',
            'next' => 'تخطى الـ 10 منشورات القادمة',
            'previous' => 'عُد 10 منشورات للخلف',
        ],

        'logs' => [
            '_' => '',
            'button' => '',

            'columns' => [
                'action' => '',
                'date' => '',
                'user' => '',
            ],

            'data' => [
                'add_tag' => '',
                'announcement' => '',
                'edit_topic' => '',
                'fork' => '',
                'pin' => '',
                'post_operation' => '',
                'remove_tag' => '',
                'source_forum_operation' => '',
                'unpin' => '',
            ],

            'no_results' => '',

            'operations' => [
                'delete_post' => '',
                'delete_topic' => '',
                'edit_topic' => '',
                'edit_poll' => '',
                'fork' => '',
                'issue_tag' => '',
                'lock' => '',
                'merge' => '',
                'move' => '',
                'pin' => '',
                'post_edited' => '',
                'restore_post' => '',
                'restore_topic' => '',
                'split_destination' => '',
                'split_source' => '',
                'topic_type' => '',
                'topic_type_changed' => '',
                'unlock' => '',
                'unpin' => '',
                'user_lock' => '',
                'user_unlock' => '',
            ],
        ],

        'post_edit' => [
            'cancel' => 'إلغاء',
            'post' => 'حفظ',
        ],
    ],

    'topic_watches' => [
        'index' => [
            'title_compact' => 'اشتراكات المنتدى',

            'box' => [
                'total' => 'الموضيع المشترك فيها',
                'unread' => 'المواضيع مع ردود جديدة',
            ],

            'info' => [
                'total' => 'لقد اشتركت في :total موضوع.',
                'unread' => 'لديك :unread ردود غير مقروءة في المواضيع المشترك فيها.',
            ],
        ],

        'topic_buttons' => [
            'remove' => [
                'confirmation' => 'إلغاء الاشتراك من الموضوع؟',
                'title' => 'إلغاء الإشتراك',
            ],
        ],
    ],

    'topics' => [
        '_' => 'المواضيع',

        'actions' => [
            'login_reply' => 'سجل الدخول للرد',
            'reply' => 'رد',
            'reply_with_quote' => 'اقتبس المنشور للرد',
            'search' => 'بحث',
        ],

        'create' => [
            'create_poll' => 'انشاء اِستطلاع رأي',

            'preview' => 'معاينة المنشور',

            'create_poll_button' => [
                'add' => 'إنشاء اِستطلاع',
                'remove' => 'الغاء اِنشاء الاِستطلاع',
            ],

            'poll' => [
                'hide_results' => 'إخفاء نتائج التصويت.',
                'hide_results_info' => 'لن يتم عرضها إلا بعد انتهاء التصويت.',
                'length' => 'افتح الاِستطلاع لـ',
                'length_days_suffix' => 'أيام',
                'length_info' => 'اترك فارغاََ لمدة لا تنتهي',
                'max_options' => 'الخيارات للـ مستخدم',
                'max_options_info' => 'هذا رقم الخيارات التي يمكن ان يختارها كل مستخدم عند التصويت.',
                'options' => 'الخيارات',
                'options_info' => 'ضع كل خيار في سطر جديد. تستطيع ادخال 10 خيارات.',
                'title' => 'سؤال',
                'vote_change' => 'اسمح باِعادة التصويت.',
                'vote_change_info' => 'اذا قمت بتفعيله, سيكون بمقدور المستخدمين تغيير اصواتهم.',
            ],
        ],

        'edit_title' => [
            'start' => 'تعديل العنوان',
        ],

        'index' => [
            'feature_votes' => 'تفضيل النجمة',
            'replies' => 'الردود',
            'views' => 'المشاهدات',
        ],

        'issue_tag_added' => [
            'to_0' => 'احذف اشارة "الاِضافة"',
            'to_0_done' => 'اشارة "الاِضافة" حُذِفَت',
            'to_1' => 'اضف اشارة "الاِضافة"',
            'to_1_done' => 'اشارة "الاِضافة" اضيفت',
        ],

        'issue_tag_assigned' => [
            'to_0' => 'احذف اشارة "التعيين"',
            'to_0_done' => 'اشارة "التعيين" حُذِفَت',
            'to_1' => 'اضف اشارة "التعيين"',
            'to_1_done' => 'اشارة "التعيين" اضيفت',
        ],

        'issue_tag_confirmed' => [
            'to_0' => 'احذف اشارة "التأكيد"',
            'to_0_done' => 'اشارة "التأكيد" حذفت',
            'to_1' => 'اضف اشارة "التأكيد"',
            'to_1_done' => 'اشارة "التأكيد" اضيفت',
        ],

        'issue_tag_duplicate' => [
            'to_0' => 'احذف اشارة "التكرار"',
            'to_0_done' => 'اشارة "التكرار" حذفت',
            'to_1' => 'اضف اشارة "التكرار"',
            'to_1_done' => 'اشارة "التكرار" اضيفت',
        ],

        'issue_tag_invalid' => [
            'to_0' => 'احذف اشارة "غير صالح"',
            'to_0_done' => 'اشارة "غير صالح" حُذِفَت',
            'to_1' => 'اضف اشارة "غير صالح"',
            'to_1_done' => 'اشارة "غير صالح" اضيفت',
        ],

        'issue_tag_resolved' => [
            'to_0' => 'احذفت اشارة "مُصلَح"',
            'to_0_done' => 'اشارة "مُصلَح" حُذِفَت',
            'to_1' => 'اضف اشارة "مُصلَح"',
            'to_1_done' => 'اشارة "مُصلَح" اضيفت',
        ],

        'lock' => [
            'is_locked' => 'هذا الموضوع مغلق ولا يمكن الرد عليه',
            'to_0' => 'فتح الموضوع',
            'to_0_confirm' => 'فتح الموضوع؟',
            'to_0_done' => 'تمّ إلغاء تأمين الموضوع',
            'to_1' => 'قفل الموضوع',
            'to_1_confirm' => 'قفل الموضوع؟',
            'to_1_done' => 'تمّ تأمين الموضوع',
        ],

        'moderate_move' => [
            'title' => 'نقل إلى منتدى آخر',
        ],

        'moderate_pin' => [
            'to_0' => 'إزالة تثبيت الموضوع',
            'to_0_confirm' => 'إلغاء تثبيت الموضوع؟',
            'to_0_done' => 'تمّ إلغاء تثبيت الموضوع',
            'to_1' => 'تثبيت الموضوع',
            'to_1_confirm' => 'تثبيت الموضوع؟',
            'to_1_done' => 'تم تثبيت الموضوع',
            'to_2' => 'ثبت الموضوع وعَلِم كـ اِعلان',
            'to_2_confirm' => 'تثبيت الموضوع وتعليمه كـ أِعلان؟',
            'to_2_done' => 'تم تثبيت الموضوع ووضعه كـ إعلان',
        ],

        'moderate_toggle_deleted' => [
            'show' => 'إظهار المنشورات المحذوفة',
            'hide' => 'إخفاء المنشورات المحذوفة',
        ],

        'show' => [
            'deleted-posts' => 'المنشورات المحذوفة',
            'total_posts' => 'عدد المنشورات الكلي',

            'feature_vote' => [
                'current' => 'الأفضلية الحالية: +:count',
                'do' => 'روج لهذا المنشور',

                'info' => [
                    '_' => 'هذا :feature_request. هذه الطلبات يمكن ان يوافق عليها بواسطة :supporters.',
                    'feature_request' => 'طلبات الميزات',
                    'supporters' => 'الداعمون',
                ],

                'user' => [
                    'count' => '{0} لا اصوات|{1}:count_delimited صوت|[2,*] :count_delimited اصوات',
                    'current' => 'لديك :votes متبقية.',
                    'not_enough' => "ليس لديك أي اصوات متبقية",
                ],
            ],

            'poll' => [
                'edit' => 'تعديل الاستبيان',
                'edit_warning' => 'تحرير الاِستطلاع سيقوم بإزالة النتائج الحالية!',
                'vote' => 'تصويت',

                'button' => [
                    'change_vote' => 'تغيير التصويت',
                    'edit' => 'تعديل الاستطلاع',
                    'view_results' => 'تخطي الى النتائج',
                    'vote' => 'تصويت',
                ],

                'detail' => [
                    'end_time' => 'سوف ينتهي الاقتراع في :time',
                    'ended' => 'انتهى الاقتراع :time',
                    'results_hidden' => 'سيتم عرض النتائج بعد انتهاء التصويت.',
                    'total' => 'مجموع الأصوات: :count',
                ],
            ],
        ],

        'watch' => [
            'to_not_watching' => 'لا إشارات مرجعية',
            'to_watching' => 'إشارة مرجعية',
            'to_watching_mail' => 'اِشارة مرجعية مع اخطار',
            'tooltip_mail_disable' => 'تم تمكين الاِخطار. انقر للتعطيل',
            'tooltip_mail_enable' => 'تم اِطفاء الاِخطار. انقر للتشغيل',
        ],
    ],
];
