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
        'warehouse' => 'Сховішча',
    ],

    'cart' => [
        'checkout' => 'Завяршэнне пакупкі',
        'more_goodies' => 'Я хачу праглядзець іншыя тавары перад завяршэннем пакупкі',
        'shipping_fees' => 'кошт дастаўкі',
        'title' => 'Кошык',
        'total' => 'усяго',

        'errors_no_checkout' => [
            'line_1' => 'Ой ой, у вас праблемы з кошыкам, якія перашкаджаюць куплі!',
            'line_2' => 'Каб працягнуць, выдаліце або абнавіць рэчы ніжэй.',
        ],

        'empty' => [
            'text' => 'Ваш кошык пусты.',
            'return_link' => [
                '_' => 'Вярніцеся да :link, каб знайсці іншыя тавары!',
                'link_text' => 'спіс крамы',
            ],
        ],
    ],

    'checkout' => [
        'cart_problems' => 'Ой-ой, праблемы з вашай карткай!',
        'cart_problems_edit' => 'Каб рэдагаваць гэта, націсніце сюды.',
        'declined' => 'Аплата была скасаваная.',
        'delayed_shipping' => 'У дадзены момант у нас шмат заказаў. Вы можаце заказваць, але помніце, што яго апрацоўка можа займаць дадатковыя 1-2 тадні.',
        'old_cart' => 'Ваш кошык, здаецца, састарэў і быў перазагружаны, паспрабуйце нанова.',
        'pay' => 'Аплата праз Paypal',

        'has_pending' => [
            '_' => 'Вы маеце незавершаныя пакупкі, націсніце :link каб праглядзець іх.',
            'link_text' => 'сюды',
        ],

        'pending_checkout' => [
            'line_1' => 'Папярэдняя пакупка была пачатая, але не завершаная.',
            'line_2' => 'Каб працягнуць пакупку, выберыце спосаб аплаты.',
        ],
    ],

    'discount' => 'эканомія: :percent%',

    'invoice' => [
        'echeck_delay' => 'Так як аплата была праз eCheck, чаканне пацверджання аплаты праз Paypal можа займаць да 10 дзён!',
        'status' => [
            'processing' => [
                'title' => 'Ваша аплата яшчэ не была пацверджана!',
                'line_1' => 'Калі вы ўжо аплацілі, то мы ўсё яшчэ можам чакаць пацверджання вашай куплі. Каплі ласка, абнавіць старонку праз хвіліну або дзве!',
                'line_2' => [
                    '_' => 'Калі ўзнікла праблема падчас аплаты, то :link',
                    'link_text' => 'націсніце тут, каб узнавіць аплату',
                ],
            ],
        ],
    ],

    'mail' => [
        'payment_completed' => [
            'subject' => 'Мы атрымалі ваш заказ у osu!store!',
        ],
    ],

    'order' => [
        'paid_on' => 'Заказ размешчаны :date',

        'invoice' => 'Праглядзець рахунак',
        'no_orders' => 'Няма заказаў для паказу.',

        'item' => [
            'display_name' => [
                'supporter_tag' => ':name для :username (:duration)',
            ],
            'quantity' => 'Колькасць',
        ],

        'not_modifiable_exception' => [
            'cancelled' => 'Вы не можаце змяніць свой заказ, так як ён быў скасаваны.',
            'checkout' => 'Вы не можаце змяніць свой заказ падчас яго апрацоўкі.', // checkout and processing should have the same message.
            'default' => 'Заказ немагчыма змяніць',
            'delivered' => 'Вы не можаце змяніць свой заказ, так як ён ужо быў дастаўлены.',
            'paid' => 'Вы не можаце змяніць свой заказ, так як ён ужо быў аплочаны.',
            'processing' => 'Вы не можаце змяніць свой заказ падчас яго апрацоўкі.',
            'shipped' => 'Вы не можаце змяніць свой заказ, так як ён ужо адпраўлены.',
        ],

        'status' => [
            'cancelled' => 'Скасавана',
            'checkout' => 'Падрыхтоўка',
            'delivered' => 'Дастаўлена',
            'paid' => 'Аплочана',
            'processing' => 'Чаканне пацвярджэння',
            'shipped' => '',
        ],
    ],

    'product' => [
        'name' => 'Назва',

        'stock' => [
            'out' => 'На дадзены момант гэтая рэч распродана. Праверце яе наяўнасць пазней!',
            'out_with_alternative' => 'На жаль, гэтай рэчы няма на складзе. Паспрабуйце іншыя параметры або праверце наяўнасць пазней!',
        ],

        'add_to_cart' => 'Дадаць да кошыку',
        'notify' => 'Апавясціць мяне, калі будзе даступна!',

        'notification_success' => 'вы будзеце абвешчаны аб наяўнасці рэчы. націсніце :link, каб скасаваць',
        'notification_remove_text' => 'сюды',

        'notification_in_stock' => 'Гэты прадукт ўжо наяўны для продажу!',
    ],

    'supporter_tag' => [
        'gift' => 'падарунак для гульца',
        'require_login' => [
            '_' => 'Вы павінны :link, каб атрымаць тэг osu!supporter!',
            'link_text' => 'увайсці',
        ],
    ],

    'username_change' => [
        'check' => 'Увядзіце імя карыстальніка, каб праверыць яго даступнасць!',
        'checking' => 'Ідзе праверка даступнасці :username...',
        'require_login' => [
            '_' => 'Вы павінны :link, каб змяніць імя карыстальніка!',
            'link_text' => 'увайсці',
        ],
    ],
];
