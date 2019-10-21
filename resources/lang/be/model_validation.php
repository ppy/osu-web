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
    'not_negative' => ':attribute не можа быць адмоўным.',
    'required' => ':attribute ёсць неабходны.',
    'too_long' => ':attribute максімальная колькасць сімвалаў перавышана - абмежаванне на :limit сімвалаў.',
    'wrong_confirmation' => 'Пацверджання не супадае.',

    'beatmap_discussion_post' => [
        'discussion_locked' => 'Абмеркаванне закрыта.',
        'first_post' => 'Нельга выдаліць пачатковы допіс.',

        'attributes' => [
            'message' => 'Паведамленне',
        ],
    ],

    'beatmapset_discussion' => [
        'beatmap_missing' => 'Пазнака часу вызначана, але бітмапа не знойдзена.',
        'beatmapset_no_hype' => "Бітмапа не можа быць хайпанутай.",
        'hype_requires_null_beatmap' => 'Хайп мусіць быць выкарыстаны толькі ў Агульнай (усе цяжкасці) секцыі.',
        'invalid_beatmap_id' => 'Вызначана няправільная цяжкасць.',
        'invalid_beatmapset_id' => 'Вызначана няправільная бітмапа.',
        'locked' => 'Абмеркаванне закрыта.',

        'attributes' => [
            'message_type' => 'Тып паведамлення',
            'timestamp' => 'Пазнака часу',
        ],

        'hype' => [
            'guest' => 'Каб хайпаваць, трэба ўвайсці.',
            'hyped' => 'Вы ўжо надалі хайп гэтай бітмапе.',
            'limit_exceeded' => 'Вы ўжо скарысталі ўвесь свой хайп.',
            'not_hypeable' => 'Гэтыя бітмапа не можа быць хайпанутай',
            'owner' => 'Немагчыма хайпаваць свае ўласныя бітмапы.',
        ],

        'timestamp' => [
            'exceeds_beatmapset_length' => 'Вызначаная пазнака часу вышэй за даўжыню бітмапы.',
            'negative' => "Пазнака часу не можа быць адмоўнай.",
        ],
    ],

    'comment' => [
        'deleted_parent' => 'Нельга адказваць на выдалены каментарый.',

        'attributes' => [
            'message' => 'Паведамленне',
        ],
    ],

    'follow' => [
        'invalid' => ':attribute вызначана няправільн.',
    ],

    'forum' => [
        'feature_vote' => [
            'not_feature_topic' => 'Магчыма толькі прагаласаваць за запыт функцыі.',
            'not_enough_feature_votes' => 'Недастаткова галасоў.',
        ],

        'poll_vote' => [
            'invalid' => 'Вызначыны няправільныя параметры.',
        ],

        'post' => [
            'beatmapset_post_no_delete' => 'Выдаленне метададзеных допіса бітмапы недазволена.',
            'beatmapset_post_no_edit' => 'Рэдагаванне метададзеных допіса бітмапы недазволена.',
            'only_quote' => 'Ваш адказ змяшчае толькі цытату.',

            'attributes' => [
                'post_text' => 'Змесціва допіса',
            ],
        ],

        'topic' => [
            'attributes' => [
                'topic_title' => 'Загаловак тэмы',
            ],
        ],

        'topic_poll' => [
            'duplicate_options' => 'Дубляваць параметры недазволена.',
            'grace_period_expired' => 'Пасля :limit часоў рэдагаванне апытання немагчыма',
            'hiding_results_forever' => 'Нельга схаваць вынікі апытання, калі яно ніколі не скончыцца.',
            'invalid_max_options' => 'Параметр на карыстальніка не можа перавышаць колькасць даступных параметраў.',
            'minimum_one_selection' => 'Патрабуецца мінімум адзін параметр на карыстальніка.',
            'minimum_two_options' => 'Трэба як мінімум два параметры.',
            'too_many_options' => 'Перавышана максімальна дазволеная колькасць параметраў.',

            'attributes' => [
                'title' => 'Загаловак апытання',
            ],
        ],

        'topic_vote' => [
            'required' => 'Выберыце параметр падчас галасавання.',
            'too_many' => 'Выбрана больш параметраў, чым дазволена.',
        ],
    ],

    'oauth' => [
        'client' => [
            'too_many' => '',
            'url' => '',

            'attributes' => [
                'name' => '',
                'redirect' => '',
            ],
        ],
    ],

    'user' => [
        'contains_username' => 'Пароль не павінен змяшчаць імя карыстальніка.',
        'email_already_used' => 'Эл. пошта ўжо выкарыстоўваецца.',
        'invalid_country' => 'Краіны няма ў базедадзеных.',
        'invalid_discord' => 'Няправільнае імя карыстальніка Discord.',
        'invalid_email' => "Не падобна на дзейны адрас эл. пошты.",
        'too_short' => 'Новы пароль надта кароткі.',
        'unknown_duplicate' => 'Імя карыстальніка або адрас эл. пошты ўжо выкарыстоўваюцца.',
        'username_available_in' => 'Гэтае імя карыстальніка будзе даступнае для выкарыстоўвання ў :duration.',
        'username_available_soon' => 'Гэтае імя карыстальніка будзе даступнае для выкарыстоўвання ў любую хвіліну!',
        'username_invalid_characters' => 'Запытаная імя карыстальніка змяшчае няправільныя сімвалы.',
        'username_in_use' => 'Імя карыстальніка ўжо выкарыстоўваецца!',
        'username_locked' => 'Імя карыстальніка ўжо выкарыстоўваецца!', // TODO: language for this should be slightly different.
        'username_no_space_userscore_mix' => 'Не выкарыстоўвайце прабелы і сімвалы падкрэсліванне!',
        'username_no_spaces' => "Імя карыстальніка не можа пачынацца або сканчацца прабеламі!",
        'username_not_allowed' => 'Гэтае імя карыстальніка недаступна.',
        'username_too_short' => 'Запытанае імя карыстальніка надта кароткае.',
        'username_too_long' => 'Запытанае імя карыстальніка надта доўгае.',
        'weak' => 'Надта лёгкі пароль.',
        'wrong_current_password' => 'Бягучы пароль няправільны.',
        'wrong_email_confirmation' => 'Пацверджанне эл. пошты не супадае.',
        'wrong_password_confirmation' => 'Пацверджанне паролю не супадаюць.',
        'too_long' => 'Перавышанп максімальная даўжыня - абмежаванне на :limit сімвалаў.',

        'attributes' => [
            'username' => 'Імя карыстальніка',
            'user_email' => 'E-mail адрас',
            'password' => 'Пароль',
        ],

        'change_username' => [
            'restricted' => 'Вы не можаце змяніць імя карыстальніка падчас абмежавання.',
            'supporter_required' => [
                '_' => 'Каб змяніць імя, вы мусіце «:link»!',
                'link_text' => 'падтрымаць osu!',
            ],
            'username_is_same' => 'Гэта ўжо і ёсць ваша імя карыстанне!',
        ],
    ],

    'user_report' => [
        'reason_not_valid' => '',
        'self' => "Вы не можаце паскардзіцца на самога сябе!",
    ],

    'store' => [
        'order_item' => [
            'attributes' => [
                'quantity' => 'Колькасць',
                'cost' => 'Цана',
            ],
        ],
    ],
];
