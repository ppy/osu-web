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
        'checkout' => 'Проверка',
        'info' => ':count_delimited товар в корзине ($:subtotal)|:count_delimited товара в корзине ($:subtotal)|:count_delimited товаров в корзине ($:subtotal)',
        'more_goodies' => 'Я хочу посмотреть другие товары перед завершением заказа',
        'shipping_fees' => 'стоимость доставки',
        'title' => 'Корзина',
        'total' => 'итого',

        'errors_no_checkout' => [
            'line_1' => 'Ой ой, у вас проблемы с корзиной!',
            'line_2' => 'Удалите или обновите товары ниже для продолжения.',
        ],

        'empty' => [
            'text' => 'Ваша корзина пуста.',
            'return_link' => [
                '_' => 'Вернитесь в :link чтобы найти другие товары!',
                'link_text' => 'магазин',
            ],
        ],
    ],

    'checkout' => [
        'cart_problems' => 'Ой-ой, у нас проблемы с вашей картой!',
        'cart_problems_edit' => 'Нажмите здесь, чтобы изменить это.',
        'declined' => 'Ваш платеж был отменен.',
        'delayed_shipping' => 'В настоящее время у нас много заказов! Вы можете заказать товар, но пожалуйста, помните, что его обработка может задержаться на 1–2 недели, пока мы разбираемся с существующими заказами.',
        'old_cart' => 'Ваша корзина, кажется, устарела и была перезагружена, пожалуйста попробуйте еще раз.',
        'pay' => 'Оплатить с PayPal',

        'has_pending' => [
            '_' => 'У Вас есть незавершённые транзакции, нажмите :link, чтобы завершить их.',
            'link_text' => 'сюда',
        ],

        'pending_checkout' => [
            'line_1' => 'Ваш предыдущий платеж был начат, но не был завершен.',
            'line_2' => 'Продолжите оформление заказа, выбрав способ оплаты.',
        ],
    ],

    'discount' => 'вы сэкономите :percent%',

    'invoice' => [
        'echeck_delay' => 'Поскольку оплата была через eCheck, ожидание подтверждения оплаты через Paypal может занят до 10 дней!',
        'status' => [
            'processing' => [
                'title' => 'Ваш платеж ещё не подтверждён!',
                'line_1' => 'Если вы уже заплатили, мы все ещё можем ожидать подтверждения платежа. Пожалуйста, обновите эту страницу через минуту или две!',
                'line_2' => [
                    '_' => 'Если во время оплаты возникла проблема, :link',
                    'link_text' => 'нажмите здесь, чтобы продолжить оплату',
                ],
            ],
        ],
    ],

    'order' => [
        'paid_on' => 'Заказ размещён :date',

        'invoice' => 'Просмотр счёта',
        'no_orders' => 'Вы ничего не заказывали.',
        'resume' => 'Продолжить покупку',

        'item' => [
            'display_name' => [
                'supporter_tag' => ':name для :username (:duration)',
            ],
            'quantity' => 'Количество',
        ],

        'not_modifiable_exception' => [
            'cancelled' => 'Вы не можете изменить свой заказ, так как он был отменён.',
            'checkout' => 'Вы не можете изменить свой заказ, пока он обрабатывается.', // checkout and processing should have the same message.
            'default' => 'Заказ невозможно изменить',
            'delivered' => 'Вы не можете изменить свой заказ, так как он уже доставлен.',
            'paid' => 'Вы не можете изменить свой заказ, поскольку он уже оплачен.',
            'processing' => 'Вы не можете изменить свой заказ, пока он обрабатывается.',
            'shipped' => 'Вы не можете изменить свой заказ, так как он уже отправлен.',
        ],

        'status' => [
            'cancelled' => 'Отменено',
            'checkout' => 'Подготовка',
            'delivered' => 'Доставлено',
            'paid' => 'Оплачено',
            'processing' => 'Ожидание подтверждения',
            'shipped' => 'В пути',
        ],
    ],

    'product' => [
        'name' => 'Название',

        'stock' => [
            'out' => 'В настоящее время данного товара нет в наличии. Загляните сюда позже!',
            'out_with_alternative' => 'К сожалению, данного товара нет в наличии. Используйте выпадающее меню, чтобы выбрать другой тип товара, или загляните сюда позже!',
        ],

        'add_to_cart' => 'Добавить в корзину',
        'notify' => 'Напомнить мне о поступлении!',

        'notification_success' => 'Вы будете оповещены когда товар будет в наличии. Нажмите :link для отмены',
        'notification_remove_text' => 'сюда',

        'notification_in_stock' => 'Данный товар уже в наличии!',
    ],

    'supporter_tag' => [
        'gift' => 'подарок для игрока',
        'require_login' => [
            '_' => 'Вы должны :link для покупки osu!supporter!',
            'link_text' => 'войти в аккаунт',
        ],
    ],

    'username_change' => [
        'check' => 'Введите имя, чтобы проверить его доступность!',
        'checking' => 'Проверяем доступность имени :username...',
        'require_login' => [
            '_' => 'Вы должны :link для смены имени пользователя!',
            'link_text' => 'войти в аккаунт',
        ],
    ],

    'xsolla' => [
        'distributor' => '',
    ],
];
