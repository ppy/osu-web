<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'admin' => [
        'warehouse' => 'المستودع',
    ],

    'cart' => [
        'checkout' => 'إتمام الشراء',
        'info' => ':count_delimited عنصر في السلة ($:subtotal)|:count_delimited عناصر في السلة ($:subtotal)',
        'more_goodies' => 'أريد أن تحقق من المزيد من الأشياء قبل إتمام الأمر',
        'shipping_fees' => 'رسوم الشحن',
        'title' => 'عربة التسوق',
        'total' => 'المجموع',

        'errors_no_checkout' => [
            'line_1' => 'آه أوه، هناك مشاكل مع سلة التسوق الخاصة بك تمنع الدفع!',
            'line_2' => 'إزال أو حدث العناصر المذكورة أعلاه للاِستمرار.',
        ],

        'empty' => [
            'text' => 'سلة التسوق الخاصة بك فارغة.',
            'return_link' => [
                '_' => 'عُد الى :link لأيجاد بعض الأغراض الجيدة!',
                'link_text' => 'قائمة المتجر',
            ],
        ],
    ],

    'checkout' => [
        'cart_problems' => 'آه أوه، هناك مشاكل مع سلة التسوق الخاصة بك!',
        'cart_problems_edit' => 'اضغط هنا لتعديلها.',
        'declined' => 'تم إلغاء الدفع.',
        'delayed_shipping' => 'نحن حالياََ غارقون في الطلبات! انت مرحب بوضع طلبك, ولكن ارجوك انتظر **1-2 اسابيع اضافية اخرى** حتى ننتهي من الطلبات الحالية.',
        'old_cart' => 'سلة التسوق الخاصة بك تبدو منتهية الصلاحية وتم اعادة شحنها, الرجاء المحاولة مجدداََ.',
        'pay' => 'الدفع بـ باي بال',
        'title_compact' => 'إتمام الشراء',

        'has_pending' => [
            '_' => 'لديك طلبات غير مكتملة, اضغط :link لعرضهم.',
            'link_text' => 'هتا',
        ],

        'pending_checkout' => [
            'line_1' => 'دفعة سابقة بدأت ولكن لم تنتهي.',
            'line_2' => 'استكمل طلبك بأختيار طريقة دفع.',
        ],
    ],

    'discount' => 'حفظ :percent%',

    'invoice' => [
        'echeck_delay' => 'بما ان دفعتك كانت الكترونية، يرجى السماح لنا حتى 10 أيام إضافية لدفع للمرور عن طريق باي بال!',
        'title_compact' => 'الفاتورة',

        'status' => [
            'processing' => [
                'title' => 'لم يتم تأكيد الدفع الخاص بك بعد!',
                'line_1' => 'إذا كنت قد دفعت فعلا، قد لا نزال تنتظر الحصول على تأكيد للدفع الخاص بك. الرجاء تحديث هذه الصفحة خلال دقيقة أو دقيقتين!',
                'line_2' => [
                    '_' => 'إذا واجهت مشكلة أثناء الدفع, :link',
                    'link_text' => 'انقر هنا لاِستئناف الدفع',
                ],
            ],
        ],
    ],

    'order' => [
        'cancel' => 'إلغاء الطلبية',
        'cancel_confirm' => 'سيتم إلغاء هذه الطلبية ولن يَتُمَ تسديد الدفُعات. قد لا يتم استرداد الدفعات على الفور, هل أنت متأكد؟',
        'cancel_not_allowed' => 'لا يمكن إلغاء هذه الطلبية حالياََ.',
        'invoice' => 'عرض الفاتورة',
        'no_orders' => 'لا طلبات للعرض.',
        'paid_on' => 'تم تعيين الطلب :date',
        'resume' => 'استئناف الدفع',
        'shopify_expired' => 'انتهت صلاحية رابط الدفع لهذه الطلبية.',

        'item' => [
            'display_name' => [
                'supporter_tag' => ':name لـ :username (:duration)',
            ],
            'quantity' => 'الكمية',
        ],

        'not_modifiable_exception' => [
            'cancelled' => 'لا يمكنك تعديل طلبك لأنه مُلغى.',
            'checkout' => 'لا يمكنك تعديل طلبك بينما يتم معالجته.', // checkout and processing should have the same message.
            'default' => 'الطلب غير قابل للتعديل',
            'delivered' => 'لا يمكنك تعديل طلبك لأنه تم توصيلة بالفعل.',
            'paid' => 'لا يمكنك تعديل طلبك لأنه تم الدفع له مسبقاََ.',
            'processing' => 'لا يمكنك تعديل طلبك بينما يتم معالجته.',
            'shipped' => 'لا يمكنك تعديل طلبك لأنه تم توصيلة بالفعل.',
        ],

        'status' => [
            'cancelled' => 'مُلغى',
            'checkout' => 'جاري الإعداد',
            'delivered' => 'وصلت',
            'paid' => 'دُفِعَت',
            'processing' => 'بانتظار التأكيد',
            'shipped' => 'تم الشحن',
        ],
    ],

    'product' => [
        'name' => 'الإسم',

        'stock' => [
            'out' => 'هذا المنتج غير متوفر حالياََ. تحقق منه لاحقاََ!',
            'out_with_alternative' => 'للأسف نفذ المنتج. استعمل القائمة المنسدلة لأختيار نوع اخر او تحقق من هذا النوع لاحقاََ!',
        ],

        'add_to_cart' => 'أضف للسلة',
        'notify' => 'أرسل إشعاراً عند توفر هذا المنتج!',

        'notification_success' => 'سيتم إعلامك عندما يكون لدينا مخزون جديد. انقر فوق :link للإلغاء',
        'notification_remove_text' => 'هتا',

        'notification_in_stock' => 'هذا المنتج لم يعد متوفراََ!',
    ],

    'supporter_tag' => [
        'gift' => 'اهدِه الى لاعب',
        'require_login' => [
            '_' => 'يجب ان تكون :link لتحصل على شارة osu!supporter!',
            'link_text' => 'مُسَجَل',
        ],
    ],

    'username_change' => [
        'check' => 'أدخل اسم مستخدم للتحقق من توَفُرِه!',
        'checking' => 'التحقق من توافر :username...',
        'require_login' => [
            '_' => 'تحتاج إلى أن تكون :link لتغيير اسمك!',
            'link_text' => 'مُسَجَل',
        ],
    ],

    'xsolla' => [
        'distributor' => '',
    ],
];
