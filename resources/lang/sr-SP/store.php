<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'cart' => [
        'checkout' => 'Завршите куповину',
        'info' => ':count_delimited производа у колицима ($:subtotal)|:count_delimited производа у колицима ($:subtotal)',
        'more_goodies' => 'Желим да погледам још ствари пре него што завршим куповину',
        'shipping_fees' => 'накнада за отпрему',
        'title' => 'Корпа',
        'total' => 'укупно',

        'errors_no_checkout' => [
            'line_1' => 'Нажалост постоји проблем са Вашим колицима који спречава жавршавање куповине!',
            'line_2' => 'Уклоните или ажурирајте производе изнад да би сте наставили.',
        ],

        'empty' => [
            'text' => 'Ваша корпа је празна.',
            'return_link' => [
                '_' => 'Вратите се на  :link да би сте нашли доступне производе!',
                'link_text' => 'листа производа',
            ],
        ],
    ],

    'checkout' => [
        'cart_problems' => 'Нажалост постоји проблем са Вашим колицима!',
        'cart_problems_edit' => 'Кликните овде да би сте изменили.',
        'declined' => 'Плаћање је отказано.',
        'delayed_shipping' => 'Тренутно имамо превише наруџбина! И даље можете поручити, али молимо Вас да очекујете **закашњење од 1-2 недеље** док не прођемо кроз све наруџбине.',
        'old_cart' => 'Изгледа да су ваша колица застарела и поново су учитана, молимо Вас да пробате поново.',
        'pay' => 'Платите преко Paypal-а',
        'title_compact' => 'завршите куповину',

        'has_pending' => [
            '_' => 'Имате куповине која нису завршене, кликните :link да би сте их погледали.',
            'link_text' => 'овде',
        ],

        'pending_checkout' => [
            'line_1' => 'Претходна куповина је започета, али није завршена.',
            'line_2' => 'Наставите са куповином тако што ћете изабрати методу плаћања.',
        ],
    ],

    'discount' => 'сачувајте :percent%',

    'invoice' => [
        'echeck_delay' => 'Зато што је Ваша куповина плаћена eCheck-ом, молимо Вас да дозволите до 10 додатних дана док се куповина не потврди преко PayPal-а!',
        'title_compact' => 'рачун',

        'status' => [
            'processing' => [
                'title' => 'Ваша куповина још увек није потврђена!',
                'line_1' => 'Ако сте већ платили, могуће је да и даље чекамо потврду Вашег плаћања. Молимо Вас да освежите страницу за минут!',
                'line_2' => [
                    '_' => 'Ако сте наишли на проблем у току завршавања куповине, :link',
                    'link_text' => 'кликните овде да наставите са куповином',
                ],
            ],
        ],
    ],

    'order' => [
        'cancel' => 'Откажите наруџбину',
        'cancel_confirm' => 'Ова наруџбина ће бити отказана и плаћање неће бити прихваћено. Провајдер плаћања можда неће одмах извршити повраћај новца. Да ли сте сигурни?',
        'cancel_not_allowed' => 'Ова наруџбина тренутно не може бити отказана.',
        'invoice' => 'Прикажи Фактуру',
        'no_orders' => 'Нема наруџбина.',
        'paid_on' => 'Наруџбина извршена :date',
        'resume' => 'Наставите са куповином',
        'shopify_expired' => 'Линк за ову наруџбину је истекао.',

        'item' => [
            'display_name' => [
                'supporter_tag' => ':name за :username (:duration)',
            ],
            'quantity' => 'Количина',
        ],

        'not_modifiable_exception' => [
            'cancelled' => 'Не можете променити Вашу наруџбину зато што је отказана.',
            'checkout' => 'Не можете променити Вашу наруџбину док се процесуира.', // checkout and processing should have the same message.
            'default' => 'Наруџбина не може бити промењена',
            'delivered' => 'Не можете да промените Вашу наруџбину зато што је већ достављена.',
            'paid' => 'Не можете да промените Вашу наруџбину зато што је већ плаћена.',
            'processing' => 'Не можете променити Вашу наруџбину док се процесуира.',
            'shipped' => 'Не можете да промените Вашу наруџбину зато што је већ испоручена.',
        ],

        'status' => [
            'cancelled' => 'Отказано',
            'checkout' => 'Припрема се',
            'delivered' => 'Испоручено',
            'paid' => 'Плаћено',
            'processing' => 'Чека се потврда',
            'shipped' => 'Послато',
        ],
    ],

    'product' => [
        'name' => 'Име',

        'stock' => [
            'out' => 'Овај артикал тренутно није на лагеру. Проверите касније!',
            'out_with_alternative' => 'Нажалост овај артикал тренутно није на лагеру. Искористите падајући мени да изаберете другачији тип или проверите касније!',
        ],

        'add_to_cart' => 'Додати у корпу',
        'notify' => 'Обавести ме када буде доступан/на!',

        'notification_success' => 'бићете обавештени када производ буде био на лагеру. Кликните :link да откажете ',
        'notification_remove_text' => 'овде',

        'notification_in_stock' => 'Овај производ је већ на лагеру!',
    ],

    'supporter_tag' => [
        'gift' => 'поклоните играчу',
        'require_login' => [
            '_' => 'Морате бити :link да би сте добили osu!supporter таг!',
            'link_text' => 'пријављени',
        ],
    ],

    'username_change' => [
        'check' => 'Укуцајте име да би сте проверили доступност!',
        'checking' => 'Проверите доступност :username...',
        'require_login' => [
            '_' => 'Морате бити :link да би сте променили ваше име!',
            'link_text' => 'пријављени',
        ],
    ],

    'xsolla' => [
        'distributor' => '',
    ],
];
