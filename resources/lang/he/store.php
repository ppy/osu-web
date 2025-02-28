<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'cart' => [
        'checkout' => 'תשלום',
        'empty_cart' => '',
        'info' => ':count_delimited פריטים בעגלה ($:subtotal)|:count_delimited פריטים בעגלה ($:subtotal)',
        'more_goodies' => 'אני רוצה להוסיף עוד דברים לפני השלמת ההזמנה',
        'shipping_fees' => 'עלות משלוח',
        'title' => 'עגלת קניות',
        'total' => 'סך הכל',

        'errors_no_checkout' => [
            'line_1' => 'אוי לא, יש בעיות עם העגלה שלך שמונעות תשלום!',
            'line_2' => 'הסר או עדכן את החפצים שלמעלה כדי להמשיך.',
        ],

        'empty' => [
            'text' => 'העגלה שלך ריקה.',
            'return_link' => [
                '_' => 'חזור ל- :link כדי למצוא כמה דברים טובים!',
                'link_text' => 'רשומת חנות',
            ],
        ],
    ],

    'checkout' => [
        'cart_problems' => 'אוי לא, יש בעיות עם העגלה שלך!',
        'cart_problems_edit' => 'לחץ כאן כדי לערוך את זה.',
        'declined' => 'התשלום בוטל.',
        'delayed_shipping' => 'אנחנו כרגע עמוסים עם הזמנות! אתה מוזמן לבצע את ההזמנה שלך, אבל בבקשה צפה ל- **עיכוב נוסף של 1-2 שבועות** כאשר אנחנו מנסים להתמודד עם הזמנות קיימות.',
        'hide_from_activity' => '',
        'old_cart' => 'נדמה שפג תוקף העגלה שלך והיא נטענה מחדש, אנא נסה שוב.',
        'pay' => 'תשלום עם Paypal',
        'title_compact' => 'תשלום',

        'has_pending' => [
            '_' => 'יש לך תשלומים לא גמורים, לחץ :link כדי לראות אותם.',
            'link_text' => 'כאן',
        ],

        'pending_checkout' => [
            'line_1' => 'תשלום קודם הותחל אך לא סוים.',
            'line_2' => 'המשך את התשלום שלך על ידי בחירת שיטת תשלום.',
        ],
    ],

    'discount' => 'שמור :percent%',
    'free' => '',

    'invoice' => [
        'contact' => '',
        'date' => '',
        'echeck_delay' => 'מכיוון שהתשלום שלך היה eCheck, נא אפשר עד ל-- 10 ימים נוספים לתשלום לעבור דרך PayPal!',
        'echeck_denied' => '',
        'hide_from_activity' => '',
        'sent_via' => '',
        'shipping_to' => '',
        'title' => '',
        'title_compact' => 'חשבונית',

        'status' => [
            'cancelled' => [
                'title' => '',
                'line_1' => [
                    '_' => "",
                    'link_text' => '',
                ],
            ],
            'delivered' => [
                'title' => '',
                'line_1' => [
                    '_' => '',
                    'link_text' => '',
                ],
            ],
            'prepared' => [
                'title' => '',
                'line_1' => '',
                'line_2' => '',
            ],
            'processing' => [
                'title' => 'התשלום שלך עדיין לא אושר!',
                'line_1' => 'אם כבר שילמת, יכול להיות שאנחנו עדיין מחכים לקבל אישור על התשלום שלך. נא רענן דף זה עוד דקה או שתיים!',
                'line_2' => [
                    '_' => 'אם נתקלת בבעיה בעת התשלום, :link',
                    'link_text' => 'לחץ כאן כדי להמשיך את התשלום',
                ],
            ],
            'shipped' => [
                'title' => '',
                'tracking_details' => '',
                'no_tracking_details' => [
                    '_' => "",
                    'link_text' => '',
                ],
            ],
        ],
    ],

    'order' => [
        'cancel' => 'בטל הזמנה',
        'cancel_confirm' => 'המשלוח הזה יבוטל והתשלום לא יתקבל בשבילו. ייתכן שספק התשלום לא ישחרר כספים שמורים באופן מיידי. האם אתה בטוח?',
        'cancel_not_allowed' => 'המשלוח הזה לא יכול להיות מבוטל בזמן זה.',
        'invoice' => 'צפה בחשבונית',
        'no_orders' => 'אין הזמנות.',
        'paid_on' => 'הזמנה בוצעה ב- :date',
        'resume' => 'המשך תשלום',
        'shipping_and_handling' => '',
        'shopify_expired' => 'לינק התשלום עבור המשלוח הזה לא בתוקף.',
        'subtotal' => '',
        'total' => '',

        'details' => [
            'order_number' => '',
            'payment_terms' => '',
            'salesperson' => '',
            'shipping_method' => '',
            'shipping_terms' => '',
            'title' => '',
        ],

        'item' => [
            'quantity' => 'כמות',

            'display_name' => [
                'supporter_tag' => ':name ל- :username (:duration)',
            ],

            'subtext' => [
                'supporter_tag' => '',
            ],
        ],

        'not_modifiable_exception' => [
            'cancelled' => 'אינך יכול לשנות את ההזמנה שלך כי היא בוטלה.',
            'checkout' => 'אינך יכול לשנות את ההזמנה שלך בזמן שהיא מעובדת.', // checkout and processing should have the same message.
            'default' => 'ההזמנה אינה ניתנת לשינוי',
            'delivered' => 'אינך יכול לשנות את ההזמנה שלך כי היא כבר נמסרה.',
            'paid' => 'אינך יכול לשנות את ההזמנה שלך כי כבר שילמת עבורה.',
            'processing' => 'אינך יכול לשנות את ההזמנה שלך בזמן שהיא מעובדת.',
            'shipped' => 'אינך יכול לשנות את ההזמנה שלך כי היא כבר נשלחה.',
        ],

        'status' => [
            'cancelled' => 'בוטל',
            'checkout' => 'מכין',
            'delivered' => 'נמסר',
            'paid' => 'שולם',
            'processing' => 'מחכה לאישור',
            'shipped' => 'נשלח',
            'title' => '',
        ],

        'thanks' => [
            'title' => '',
            'line_1' => [
                '_' => '',
                'link_text' => '',
            ],
        ],
    ],

    'product' => [
        'name' => 'שם',

        'stock' => [
            'out' => 'מוצר זה כרגע לא במלאי. בדוק מאוחר יותר!',
            'out_with_alternative' => 'לצערנו מוצר זה כרגע לא במלאי. השתמש בתפריט על מנת לבחור סוג אחר אם בדוק מאוחר יותר!',
        ],

        'add_to_cart' => 'הוסף לעגלה',
        'notify' => 'נא להודיע ​​לי כאשר המוצר זמין!',

        'notification_success' => 'אנחנו ניידע אותך כאשר יהיה לנו מלאי חדש. לחץ :link כדי לבטל',
        'notification_remove_text' => 'כאן',

        'notification_in_stock' => 'מוצר זה כבר זמין במלאי!',
    ],

    'supporter_tag' => [
        'gift' => 'תן מתנה לשחקן',
        'gift_message' => '',

        'require_login' => [
            '_' => 'הינך צריך להיות :link כדי להשיג תג osu!supporter!',
            'link_text' => 'מחובר',
        ],
    ],

    'username_change' => [
        'check' => 'הזן שם משתמש כדי לבדוק זמינות!',
        'checking' => 'בודק זמינות :username...',
        'placeholder' => '',
        'label' => '',
        'current' => '',

        'require_login' => [
            '_' => 'הינך חייב להיות :link כדי לשנות את השם שלך!',
            'link_text' => 'מחובר',
        ],
    ],

    'xsolla' => [
        'distributor' => '',
    ],
];
