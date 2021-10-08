<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'invalid' => 'Вызначыны няпрявільны :attribute.',
    'not_negative' => ':attribute не можа быць адмоўным.',
    'required' => ':attribute ёсць неабходны.',
    'too_long' => ':attribute максімальная колькасць сімвалаў перавышана - абмежаванне на :limit сімвалаў.',
    'wrong_confirmation' => 'Пацверджання не супадае.',

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
            'discussion_locked' => "Дадзеная карта у бягучы момант зачынена для абмеркавання і не можа быць хайпанута",
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

    'beatmapset_discussion_post' => [
        'discussion_locked' => 'Абмеркаванне закрыта.',
        'first_post' => 'Нельга выдаліць пачатковы допіс.',

        'attributes' => [
            'message' => 'Паведамленне',
        ],
    ],

    'comment' => [
        'deleted_parent' => 'Нельга адказваць на выдалены каментарый.',
        'top_only' => 'Нельга замацоўваць адказы на каментары.',

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
            'first_post_no_delete' => 'Нельга выдаліць пачатковую публікацыю',
            'missing_topic' => 'У пасту адсутнічае тэма',
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
            'too_many' => 'Перавышана максімальна дазволеная колькасць прыклад OAuth.',
            'url' => 'Калі ласка, увядзіце сапраўдны URL.',

            'attributes' => [
                'name' => 'Назва праграмы',
                'redirect' => 'Callback URL Прыкладання',
            ],
        ],
    ],

    'user' => [
        'contains_username' => 'Пароль не павінен змяшчаць імя карыстальніка.',
        'email_already_used' => 'Эл. пошта ўжо выкарыстоўваецца.',
        'email_not_allowed' => 'Адрас электроннай пошты не дапускаецца.',
        'invalid_country' => 'Краіны няма ў базедадзеных.',
        'invalid_discord' => 'Няправільнае імя карыстальніка Discord.',
        'invalid_email' => "Не падобна на дзейны адрас эл. пошты.",
        'invalid_twitter' => 'Няправільнае імя карыстальніка Twitter.',
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
        'no_ranked_beatmapset' => 'Нельга скардзіцца на ранкаваныя бітмапы',
        'reason_not_valid' => ':reason не падыходзіць для дадзенага тыпу дакладу.',
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
