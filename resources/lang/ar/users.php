<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'deleted' => '[مستخدم محذوف]',

    'beatmapset_activities' => [
        'title' => "سجل اقتراحات :user",
        'title_compact' => 'تقديم الإقتِراحات',

        'discussions' => [
            'title_recent' => 'المناقشات التي بدأت مؤخرا',
        ],

        'events' => [
            'title_recent' => 'آخر الأحداث',
        ],

        'posts' => [
            'title_recent' => 'المنشورات الأخيرة',
        ],

        'votes_received' => [
            'title_most' => 'الأكثر تصويتاََ بواسطة (آخر ٣ اشهر)',
        ],

        'votes_made' => [
            'title_most' => 'الأكثر تصويتاََ (آخر ٣ اشهر)',
        ],
    ],

    'blocks' => [
        'banner_text' => 'لقد قمت بحظر هذا المستخدم.',
        'comment_text' => 'هذا التعليق مخفي.',
        'blocked_count' => 'المستخدمون المحظورون (:count)',
        'hide_profile' => 'إخفاء الملف الشخصي',
        'hide_comment' => 'إخفاء',
        'forum_post_text' => 'تم إخفاء هذه المشاركة.',
        'not_blocked' => 'هذا المستخدم ليس محظوراََ.',
        'show_profile' => 'عرض الملف الشخصي',
        'show_comment' => 'إظهار',
        'too_many' => 'تم الوصول للحد الأقصى للحظر.',
        'button' => [
            'block' => 'حظر',
            'unblock' => 'إلغاء الحظر',
        ],
    ],

    'card' => [
        'gift_supporter' => 'إهداء علامة supporter ',
        'loading' => 'جاري التحميل...',
        'send_message' => 'إرسال رسالة',
    ],

    'create' => [
        'form' => [
            'password' => 'كلمة السر',
            'password_confirmation' => 'تأكيد كلمة السر',
            'submit' => 'إنشاء حساب',
            'user_email' => 'البريد الإلكتروني',
            'user_email_confirmation' => 'تأكيد البريد الإلكتروني',
            'username' => 'اسم المستخدم',

            'tos_notice' => [
                '_' => 'بإنشائك للحساب، فأنت توافق على :link',
                'link' => 'شروط الخدمة',
            ],
        ],
    ],

    'disabled' => [
        'title' => 'اه-اوه! يبدو انه قد تم تعطيل حسابك.',
        'warning' => "في حال قمت بانتهاك أحد القوانين، يُرجى ملاحظة أنه يوجد عادةً فترة تهدئة مدتها شهر واحد لن نأخذ خلالها أي طلبات للعفو بعين الاعتبار. بعد هذه الفترة، يمكنك التواصل معنا إذا رأيت ذلك ضروريًا. يُرجى العلم أن إنشاء حسابات جديدة بعد تعطيل حسابك سيؤدي إلى <strong>تمديد فترة التهدئة هذه لمدة شهر واحد</strong>. كما يُرجى الانتباه إلى أن <strong>إنشاء كل حساب جديد يُعد انتهاكًا إضافيًا للقوانين</strong>. ننصحك بشدة بعدم اتباع هذا المسار!",

        'if_mistake' => [
            '_' => 'إذا كنت ترى أن هذا خطأ، فنرحب بك بالتواصل معنا (عبر :email أو بالنقر على علامة “?” في الزاوية السفلية اليمنى من هذه الصفحة). يرجى ملاحظة أننا نكون دائمًا على ثقة تامة بإجراءاتنا، لأنها تستند إلى بيانات قوية جدًا. كما نحتفظ بالحق في تجاهل طلبك إذا شعرنا بأنك غير صادق بشكل متعمد.',
            'email' => 'البريد الإلكتروني',
        ],

        'reasons' => [
            'compromised' => 'تم اعتبار أن حسابك قد تم اختراقه. قد يتم تعطيله مؤقتًا أثناء التحقق من هويته.
',
            'opening' => 'هناك عدد من الأسباب التي قد تؤدي إلى تعطيل حسابك:',

            'tos' => [
                '_' => 'لقد خرقت واحداََ او اكثر من :community_rules او :tos.',
                'community_rules' => 'قوانين المجتمع',
                'tos' => 'بنود الخدمة',
            ],
        ],
    ],

    'filtering' => [
        'by_game_mode' => 'الأعضاء حسب نمط اللعبة',
    ],

    'force_reactivation' => [
        'reason' => [
            'inactive' => "لم تستعمل حسابك منذ وقتِِ طويل.",
            'inactive_different_country' => "لم تستعمل حسابك منذ وقتِِ طويل.",
        ],
    ],

    'login' => [
        '_' => 'تسجيل الدخول',
        'button' => 'تسجيل الدخول',
        'button_posting' => 'يسجل الدخول...',
        'email_login_disabled' => 'تسجيل الدخول باستخدام البريد الإلكتروني معطّل حاليًا. يُرجى استخدام اسم المستخدم بدلًا من ذلك.',
        'failed' => 'تسجيل دخول غير صحيح',
        'forgot' => 'نسيت كلمة المرور؟',
        'info' => 'الرجاء تسجيل الدخول للاستمرار',
        'invalid_captcha' => 'فَشِلت الكابتشا، قم بتحديث الصفحة وحاول مرة أخرى.',
        'locked_ip' => 'عنوان IP الخاص بك محظور مؤقتاً. يرجى الانتظار بضع دقائق.',
        'password' => 'كلمة السر',
        'register' => "لا تملك حسابًا في osu!؟ أنشئ حسابًا جديدًا",
        'remember' => 'تذكر هذا الجهاز',
        'title' => 'الرجاء تسجيل الدخول للمضي قدما',
        'username' => 'اسم المستخدم',

        'beta' => [
            'main' => 'وصول البيتا مقيد حالياََ للمستخدمين ذوي الاِمتيازات فقط.',
            'small' => '(سوف يحصل عليه osu!supporters قريبا)',
        ],
    ],

    'multiplayer' => [
        'index' => [
            'active' => 'نشطة',
            'ended' => 'منتهية',
        ],
    ],

    'ogp' => [
        'modding_description' => 'الخرائط: :counts',
        'modding_description_empty' => 'ليس لدى المستخدم أي خرائط...',

        'description' => [
            '_' => 'الترتيب (:ruleset): :global | :country',
            'country' => 'الدولة :rank',
            'global' => 'عالمياََ :rank',
        ],
    ],

    'posts' => [
        'title' => ':username منشورات',
    ],

    'anonymous' => [
        'login_link' => 'انقر لتسجيل الدخول',
        'login_text' => 'تسجيل الدخول',
        'username' => 'زائر',
        'error' => 'تحتاج إلى تسجيل الدخول للقيام بذلك.',
    ],
    'logout_confirm' => 'أتريد تسجيل الخروج حقا؟ :(',
    'report' => [
        'button_text' => 'اِبلاغ',
        'comments' => 'تعليقات إضافية',
        'placeholder' => 'يرجى تقديم أي معلومات تعتقد انه يمكن أن تكون مفيدة.',
        'reason' => 'السبب',
        'thanks' => 'شكرا لبلاغِك!',
        'title' => 'هل تريد الإبلاغ عن المستخدم :username؟',

        'actions' => [
            'send' => 'إرسال البلاغ',
            'cancel' => 'إلغاء',
        ],

        'dmca' => [
            'message_1' => [
                '_' => 'يرجى الإبلاغ عن انتهاك حقوق الطبع والنشر من خلال مطالبة DMCA إلى :mail حسب :policy.',
                'policy' => 'سياسة حقوق الطبع والنشر لـ !osu',
            ],
            'message_2' => 'ينطبق هذا على الحالات التي يتم فيها استخدام المقاطع الصوتية، أو المحتوى المرئي، أو محتوى مستويات اللعبة (الخريطة) بدون إذن رسمي.',
        ],

        'options' => [
            'cheating' => 'لعب مؤذي/ غش',
            'copyright_infringement' => 'انتهاك حقوق النشر',
            'inappropriate_chat' => 'سلوك غير لائق في الدردشة',
            'insults' => 'اهانتي / اهانة الاخرين',
            'multiple_accounts' => 'استخدام حسابات متعددة',
            'nonsense' => 'هُراء',
            'other' => 'أخرى (اكتب أدناه)',
            'spam' => 'إرسال رسائل مزعجة (سبام)',
            'unwanted_content' => 'محتوى غير مناسب',
        ],
    ],
    'restricted_banner' => [
        'title' => 'تم تقييد حسابك!',
        'message' => 'أثناء فترة التقييد، لن تتمكن من التفاعل مع اللاعبين الآخرين، وستكون نتائجك مرئية لك فقط. يحدث هذا عادةً نتيجة عملية تلقائية، وغالبًا ما يتم رفعه خلال 24 ساعة. :link',
        'message_link' => 'تحقق من هذه الصفحة لمعرفة المزيد.',
    ],
    'show' => [
        'age' => ':age سنة',
        'change_avatar' => 'غير صورتك!',
        'first_members' => 'هنا منذ البداية',
        'is_developer' => 'مطور!osu',
        'is_supporter' => 'osu!supporter',
        'joined_at' => 'انضم في :date',
        'lastvisit' => 'آخر ظهور :date',
        'lastvisit_online' => 'متصل حالياً',
        'missingtext' => 'لقد ادخلت معلومات خاطئة! (او قد يكون المستخدم مقيد)',
        'origin_country' => 'من :country',
        'previous_usernames' => 'سابقاََ',
        'plays_with' => 'يستخدم :devices',

        'comments_count' => [
            '_' => 'نَشَر :link',
            'count' => ':count_delimited تعليق|:count_delimited تعليقات',
        ],
        'cover' => [
            'to_0' => 'إخفاء الغلاف',
            'to_1' => 'إظهار الغلاف',
        ],
        'daily_challenge' => [
            'daily' => 'التتابع اليومي',
            'daily_streak_best' => 'أفضل تتابع يومي',
            'daily_streak_current' => 'التتابع اليومي الحالي',
            'playcount' => 'إجمالي المشاركات',
            'title' => 'التحدي\nاليومي',
            'top_10p_placements' => 'أفضل 10% من المراكز',
            'top_50p_placements' => 'أفضل 50% من المراكز',
            'weekly' => 'التتابع الأسبوعي',
            'weekly_streak_best' => 'أفضل تتابع أسبوعي',
            'weekly_streak_current' => 'التتابع الأسبوعي الحالي',

            'unit' => [
                'day' => ':valued',
                'week' => ':valuew',
            ],
        ],
        'edit' => [
            'cover' => [
                'button' => 'تغيير صورة الغلاف',
                'defaults_info' => 'خيارات اغلفة اضافية ستكون متاحة في المستقبل',
                'holdover_remove_confirm' => "الغلاف المحدد سابقاً لم يعد متوفّراً ولن تستطيع اختياره مجدداً بعد تغييره. هل تريد المتابعة؟",
                'title' => 'صورة الغلاف',

                'upload' => [
                    'broken_file' => 'فشلت معالجة الصورة. تحقق من الصورة المرفوعة وحاول مرة أخرى.',
                    'button' => 'رفع صورة',
                    'dropzone' => 'اَسقط الملف هنا للرفع',
                    'dropzone_info' => 'يمكنك أيضا إسقاط الصورة هنا للرفع',
                    'size_info' => 'يجب أن يكون حجم الغلاف 2000×500',
                    'too_large' => 'الملف المرفوع كبير جدا.',
                    'unsupported_format' => 'تنسيق غير مدعوم.',

                    'restriction_info' => [
                        '_' => 'الرفع متاح لـ :link فقط',
                        'link' => 'osu!supporters',
                    ],
                ],
            ],

            'default_playmode' => [
                'is_default_tooltip' => 'وضع اللعبة الافتراضي',
                'set' => 'عين :mode كالوضع الافتراضي للعبة',
            ],

            'hue' => [
                'reset_no_supporter' => 'إعادة تعيين اللون إلى الافتراضي؟ ستكون علامة الداعم مطلوبة لتغيير اللون إلى لون مختلف.',
                'title' => 'اللون',

                'supporter' => [
                    '_' => 'تتوفر سمات ألوان مخصصة فقط لـ :link',
                    'link' => 'osu!supporters',
                ],
            ],
        ],

        'extra' => [
            'none' => 'بلا',
            'unranked' => 'لا نتائج اخيرة',

            'achievements' => [
                'achieved-on' => 'احتُل عند :date',
                'locked' => 'مُغلق',
                'title' => 'الانجازات',
            ],
            'beatmaps' => [
                'by_artist' => 'بواسطة :artist',
                'title' => 'خرائط الايقاع',

                'favourite' => [
                    'title' => 'الخرائط المفضلة',
                ],
                'graveyard' => [
                    'title' => 'الخرائط المقبورة',
                ],
                'guest' => [
                    'title' => 'خرائط من مشاركات الضيف',
                ],
                'loved' => [
                    'title' => 'خرائط Loved',
                ],
                'nominated' => [
                    'title' => 'خرائط Ranked جديدة',
                ],
                'pending' => [
                    'title' => 'الخرائط المعلقة',
                ],
                'ranked' => [
                    'title' => 'الخرائط المصنفة (Ranked)',
                ],
            ],
            'discussions' => [
                'title' => 'المناقشات',
                'title_longer' => 'المناقشات الأخيرة',
                'show_more' => 'رؤية المزيد من المناقشات',
            ],
            'events' => [
                'title' => 'الأحداث',
                'title_longer' => 'الأحداث الأخيرة',
                'show_more' => 'عرض المزيد من الأحداث',
            ],
            'historical' => [
                'title' => 'التاريخ',

                'monthly_playcounts' => [
                    'title' => 'تاريخ اللعب',
                    'count_label' => 'مرات اللعب',
                ],
                'most_played' => [
                    'count' => 'مرة لُعِبت',
                    'title' => 'الخرائط الاكثر لعباََ',
                ],
                'recent_plays' => [
                    'accuracy' => 'الدقة: :percentage',
                    'title' => 'الخرائط الملعوبة اخر (24 ساعة)',
                ],
                'replays_watched_counts' => [
                    'title' => 'تاريخ مشاهدات الـ Replays',
                    'count_label' => 'الـ Replays التي شاهدتها',
                ],
                'score_replay_stats' => [
                    'title' => 'الإعادات الأكثر مشاهدة',
                ],
            ],
            'kudosu' => [
                'recent_entries' => 'تاريخ الكودوسو الفائت',
                'title' => 'كودوسو!',
                'total' => 'عدد الكودوسو الحاصل عليها',

                'entry' => [
                    'amount' => ':amount كودوسو',
                    'empty' => "هذا المستخدم لم يحصل على اية كودوسو!",

                    'beatmap_discussion' => [
                        'allow_kudosu' => [
                            'give' => 'حصل على :amount من الكودوسو التي رفضت من اقتراح على منشور :post',
                        ],

                        'deny_kudosu' => [
                            'reset' => 'رفض :amount من منشور الاقتراح :post',
                        ],

                        'delete' => [
                            'reset' => 'خسر :amount من حذف منشور الاقتراح :post',
                        ],

                        'restore' => [
                            'give' => 'استلم :amount من استعادة منشور الاقتراح :post',
                        ],

                        'vote' => [
                            'give' => 'استلم :amount من خلال الحصول على اصوات منشور الاقتراح :post',
                            'reset' => 'خسر :amount من خلال خسارة اصوات منشور الاقتراح :post',
                        ],

                        'recalculate' => [
                            'give' => 'استلم :amount من خلال اعادة حساب منشور الاقتراح :post',
                            'reset' => 'خسر :amount من خلال اعادة حساب منشور الاقتراح :post',
                        ],
                    ],

                    'forum_post' => [
                        'give' => 'استلم :amount من :giver لمنشوره في :post',
                        'reset' => 'إعادة تعيين كودوسو بواسطة :giver للمنشور :post',
                        'revoke' => 'رفض كودوسو بواسطة :giver للمنشور :post',
                    ],
                ],

                'total_info' => [
                    '_' => 'يعتمد على مقدار مساهمة المستخدم في الإشراف على خرائط الإيقاع. راجع :link لمزيد من المعلومات.',
                    'link' => 'هذه الصفحة',
                ],
            ],
            'me' => [
                'title' => 'أنا!',
            ],
            'medals' => [
                'empty' => "هذا المستخدم لم يحصل على أي شيئ حتى الآن. ;_;",
                'recent' => 'الأخير',
                'title' => 'الاوسمة',
            ],
            'playlists' => [
                'title' => 'ألعاب قائمة التشغيل',
            ],
            'posts' => [
                'title' => 'المنشورات',
                'title_longer' => 'المنشورات الحديثة',
                'show_more' => 'عرض المزيد من المنشورات',
            ],
            'ranked-play' => [
                'title' => 'مباريات اللعب المصنّف',
            ],
            'recent_activity' => [
                'title' => 'الأخيرة',
            ],
            'realtime' => [
                'title' => 'الألعاب الجماعية',
            ],
            'top_ranks' => [
                'download_replay' => 'تحميل الـ Replay',
                'not_ranked' => 'لا تمنح نقاط pp سوى خرائط الإيقاع المصنفة',
                'pp_weight' => 'موزون :percentage',
                'view_details' => 'عرض التفاصيل',
                'title' => 'النتائج',

                'best' => [
                    'title' => 'أفضل أداء',
                ],
                'first' => [
                    'title' => 'المراكز الاولى',
                ],
                'pin' => [
                    'to_0' => 'إزالة التثبيت',
                    'to_0_done' => 'تم إلغاء تثبيت النتيجة',
                    'to_1' => 'تثبيت',
                    'to_1_done' => 'تم تثبيت النتيجة',
                ],
                'pinned' => [
                    'title' => 'النتائج المثبتة',
                ],
            ],
            'votes' => [
                'given' => 'الأصوات المقدمة (اخر 3 اشهر)',
                'received' => 'الأصوات المستلمة (اخر 3 اشهر)',
                'title' => 'الأصوات',
                'title_longer' => 'الأصوات الأخيرة',
                'vote_count' => ':count_delimited صوت|:count_delimited اصوات',
            ],
            'account_standing' => [
                'title' => 'حالة الحساب',
                'bad_standing' => "حساب :username في حالة غير جيدة :(",
                'remaining_silence' => 'سيتمكن :username من التحدث مجددًا خلال :duration.',

                'recent_infringements' => [
                    'title' => 'الحوادث الاخيرة',
                    'date' => 'التاريخ',
                    'action' => 'النشاط',
                    'length' => 'الطول',
                    'length_indefinite' => 'غير محدد',
                    'description' => 'الوصف',
                    'actor' => 'بواسطة :username',

                    'actions' => [
                        'restriction' => 'حظر',
                        'silence' => 'سكون',
                        'tournament_ban' => 'حظر البطولات',
                        'note' => 'ملاحظة',
                    ],
                ],
            ],
        ],

        'info' => [
            'discord' => '',
            'interests' => 'الاهتمامات',
            'location' => 'الموقع الحالي',
            'occupation' => 'المهنة',
            'twitter' => '',
            'website' => 'الموقع',
        ],

        'matchmaking' => [
            'title' => 'اللعب المصنّف',
        ],

        'not_found' => [
            'reason_1' => 'لربما غير اسم المستخدم الخاص به.',
            'reason_2' => 'قد يكون الحساب غير متاح مؤقتًا بسبب مشاكل أمنية أو إساءة استخدام.',
            'reason_3' => 'لربما قمت بخطأ!',
            'reason_header' => 'هناك عدة اسباب لهذا:',
            'title' => 'لم يتم العثور على المستخدم ! ;_;',
        ],
        'page' => [
            'button' => 'تعديل الملف الشخصي',
            'description' => '<strong>انا!</strong> هي مساحة شخصية قابلة للتخصيص في صفحة ملفك الشخصي.',
            'edit_big' => 'عدّلني!',
            'placeholder' => 'ادخل محتوى الصفحة هنا',

            'restriction_info' => [
                '_' => 'تحتاج ان تكون :link لفتح هذه الميزة.',
                'link' => 'osu!supporter',
            ],
        ],
        'post_count' => [
            '_' => 'ساهم بـ :link',
            'count' => ':count_delimited منشور منتدى":count_delimited منشورات المنتدى',
        ],
        'rank' => [
            'country' => 'ترتيب الدولة لـ :mode',
            'country_simple' => 'ترتيب الدولة',
            'global' => 'الترتيب العالمي لـ :mode',
            'global_simple' => 'الترتيب العالمي',
            'highest' => 'أعلى ترتيب: :rank في :date',
        ],
        'score_processing' => [
            '_' => '',
            'link' => '',
        ],
        'season_stats' => [
            'division_top_percentage' => '',
            'total_score' => 'إجمالي النقاط',
        ],
        'stats' => [
            'hit_accuracy' => 'دقة التصويب',
            'hits_per_play' => '',
            'level' => 'المستوى :level',
            'level_progress' => 'التقدم للمستوى التالي',
            'maximum_combo' => 'اقصى كومبو',
            'medals' => 'الاوسمة',
            'play_count' => 'مرات اللعب',
            'play_time' => 'وقت اللعب الإجمالي',
            'ranked_score' => 'النتيجة المصنفة',
            'replays_watched_by_others' => 'الـ Replays التي شاهدها الأخرون',
            'score_ranks' => 'ترتيب النقاط',
            'total_hits' => 'مجموع التصويبات',
            'total_score' => 'مجموع النقاط',
            // modding stats
            'graveyard_beatmapset_count' => 'الخرائط المقبورة',
            'loved_beatmapset_count' => 'خرائط Loved',
            'pending_beatmapset_count' => 'الخرائط المعلقة',
            'ranked_beatmapset_count' => 'الخرائط المصنفة (Ranked)',
        ],
    ],

    'silenced_banner' => [
        'title' => 'أنت مُقيد (صامت) حاليا.',
        'message' => 'قد تكون بعض الإجراءات غير متوفرة.',
    ],

    'status' => [
        'all' => 'الكل',
        'online' => 'متصل',
        'offline' => 'غير متصل',
    ],
    'store' => [
        'from_client' => 'الرجاء التسجيل داخل اللعبة بدلاً من هنا!',
        'from_web' => 'يرجى إكمال التسجيل عبر موقع osu!',
        'saved' => 'انشأ المستخدم',
    ],
    'verify' => [
        'title' => 'التحقق من الحساب',
    ],

    'view_mode' => [
        'brick' => 'عرض الطوب',
        'card' => 'العرض كبطاقة',
        'list' => 'عرض كلائحة',
    ],
];
