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
    'admin' => [
        'warehouse' => 'Склад',
    ],

    'cart' => [
        'checkout' => 'Перевірка',
        'info' => '',
        'more_goodies' => 'Я хочу подивитися на інші товари перед завершенням замовлення',
        'shipping_fees' => 'вартість доставки',
        'title' => 'Кошик',
        'total' => 'всього',

        'errors_no_checkout' => [
            'line_1' => 'Ой йой, у вас проблеми з кошиком!',
            'line_2' => 'Видаліть або оновіть товари нижче для продовження.',
        ],

        'empty' => [
            'text' => 'Ваш кошик порожній.',
            'return_link' => [
                '_' => 'Поверніться в :link щоб знайти інші товари!',
                'link_text' => 'магазин',
            ],
        ],
    ],

    'checkout' => [
        'cart_problems' => 'Ой-йой, у нас проблеми з вашою карткою!',
        'cart_problems_edit' => 'Натисніть тут, щоб змінити.',
        'declined' => 'Ваш платіж було скасовано.',
        'delayed_shipping' => 'В даний час у нас багато замовлень. Ти можеш замовити товар, але будь ласка, пам\'ятай, що його обробка замовлення може зайняти 1-2 тижні.',
        'old_cart' => 'Здається ваша корзина застаріла, тому була перезавантажена, будь ласка спробуйте ще раз.',
        'pay' => 'Оплатити за допомогою PayPal',

        'has_pending' => [
            '_' => 'У вас є незавершені транзакції, натисніть :link щоб завершити їх.',
            'link_text' => 'сюди',
        ],

        'pending_checkout' => [
            'line_1' => 'Ваш попередній платіж було розпочато, але не було завершено.',
            'line_2' => 'Виберіть спосіб оплати щоб оформити замовлення.',
        ],
    ],

    'discount' => 'ви заощадите :percent%',

    'invoice' => [
        'echeck_delay' => 'Оскільки оплата була через eCheck, очікування підтвердження оплати через Paypal може зайнятий до 10 днів!',
        'status' => [
            'processing' => [
                'title' => 'Ваш платіж ще не підтверджений!',
                'line_1' => 'Якщо ви вже заплатили, ми все ще можемо очікувати підтвердження платежу. Будь ласка, оновіть цю сторінку через хвилину або дві!',
                'line_2' => [
                    '_' => 'Якщо під час оплати виникла проблема, :link',
                    'link_text' => 'натисніть тут, щоб продовжити оплату',
                ],
            ],
        ],
    ],

    'order' => [
        'paid_on' => 'Замовлення розміщено :date',

        'invoice' => 'Переглянути рахунок',
        'no_orders' => 'Ви нічого не замовляли.',
        'resume' => 'Продовжити покупку',

        'item' => [
            'display_name' => [
                'supporter_tag' => ':name для :username (:duration)',
            ],
            'quantity' => 'Кількість',
        ],

        'not_modifiable_exception' => [
            'cancelled' => 'Ви не можете змінити своє замовлення, так як його було скасовано.',
            'checkout' => 'Ви не можете змінити своє замовлення, поки він обробляється.', // checkout and processing should have the same message.
            'default' => 'Замовлення неможливо змінити',
            'delivered' => 'Ви не можете змінити своє замовлення, так як воно вже доставлене.',
            'paid' => 'Ви не можете змінити своє замовлення, так як його було оплачено.',
            'processing' => 'Ви не можете змінити своє замовлення, поки він обробляється.',
            'shipped' => 'Ви не можете змінити своє замовлення, так як воно вже відправлено.',
        ],

        'status' => [
            'cancelled' => 'Скасовано',
            'checkout' => 'Підготування',
            'delivered' => 'Доставлено',
            'paid' => 'Оплачено',
            'processing' => 'Очікування підтвердження',
            'shipped' => 'В дорозі',
        ],
    ],

    'product' => [
        'name' => 'Назва',

        'stock' => [
            'out' => 'В даний час товар немає в наявності. Зазирни сюди пізніше!',
            'out_with_alternative' => 'Даний тип в даний час відсутній на складі :(. Зазирни сюди пізніше.',
        ],

        'add_to_cart' => 'До кошика',
        'notify' => 'Повідомити мене, коли буде в наявності!',

        'notification_success' => 'ви будете сповіщені коли товар буде в наявності. натисніть :link для скасування',
        'notification_remove_text' => 'сюди',

        'notification_in_stock' => 'Цей продукт вже є в наявності!',
    ],

    'supporter_tag' => [
        'gift' => 'подарунок для гравця',
        'require_login' => [
            '_' => 'Ви маєте бути :link для покупки osu!прихильник!',
            'link_text' => 'увійти',
        ],
    ],

    'username_change' => [
        'check' => 'Введіть ім\'я, щоб перевірити його доступність!',
        'checking' => 'Перевіряємо доступність імені :username...',
        'require_login' => [
            '_' => 'Ви повинні :link для зміни ніку!',
            'link_text' => 'увійти',
        ],
    ],

    'xsolla' => [
        'distributor' => '',
    ],
];
