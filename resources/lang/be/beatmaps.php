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
    'discussion-posts' => [
        'store' => [
            'error' => 'Не атрымалася захаваць допіс',
        ],
    ],

    'discussion-votes' => [
        'update' => [
            'error' => 'Не атрымалася абнавіць голас',
        ],
    ],

    'discussions' => [
        'allow_kudosu' => 'дазволіць кудосу',
        'delete' => 'выдаліць',
        'deleted' => 'Выдалена :editor а :delete_time.',
        'deny_kudosu' => 'забараніць кудосу',
        'edit' => 'рэдагаваць',
        'edited' => 'Апошняе рэдагаванне :editor а :update_time.',
        'kudosu_denied' => 'Адмоўлена ў атрыманні кудосу.',
        'message_placeholder_deleted_beatmap' => 'Гэтая цяжкасць была выдалена і абмяркоўваць у ёй больш нельга.',
        'message_type_select' => 'Выбраць тып каментарыя',
        'reply_notice' => 'Каб адказаць, націсніце «Enter».',
        'reply_placeholder' => 'Напішыце свой адказ тут',
        'require-login' => 'Увайдзіце, каб апублікаваць або адказаць',
        'resolved' => 'Вырашана',
        'restore' => 'аднавіць',
        'title' => 'Абмеркаванні',

        'collapse' => [
            'all-collapse' => 'Згарнуць усё',
            'all-expand' => 'Разгарнуць усё',
        ],

        'empty' => [
            'empty' => 'Яшчэ няма абмеркаванняў!',
            'hidden' => 'Няма абмеркаванняў адпавядальных фільтру.',
        ],

        'message_hint' => [
            'in_general' => 'Гэты допіс пойдзе ў агульную тэму абмеркавання пакета бітмапы. Каб змяніць гэтую бітмапу, пачніце сваёй паведамленне з пазнакі часу (напрыклад 00:12:345).',
            'in_timeline' => 'Для змянення некалькіх пазнак часу, стварыце допіс некалькі раз (адзін допіс на пазнаку часу).',
        ],

        'message_placeholder' => [
            'general' => 'Каб апублікаваць у агульных, напішыце тут (:version)',
            'generalAll' => 'Каб апублікаваць у агульных, напішыце тут (Усе цяжкасці)',
            'timeline' => 'Каб размясціць у шкале часу, напішыце тут (:version)',
        ],

        'message_type' => [
            'disqualify' => 'Дыскваліфікаваць',
            'hype' => 'Надаць хайп!',
            'mapper_note' => 'Нататка',
            'nomination_reset' => 'Скід намінацыі',
            'praise' => 'Пахвала',
            'problem' => 'Праблема',
            'suggestion' => 'Прапанова',
        ],

        'mode' => [
            'events' => 'Гісторыя',
            'general' => 'Агульнае :scope',
            'timeline' => 'Шкала часу',
            'scopes' => [
                'general' => 'Гэтая цяжкасць',
                'generalAll' => 'Усе цяжкасці',
            ],
        ],

        'new' => [
            'timestamp' => 'Пазнака часу',
            'timestamp_missing' => 'націсніце «ctrl-c» у рэдактары, каб скапіяваць пазнаку часу!',
            'title' => 'Новые абмеркаванне',
        ],

        'show' => [
            'title' => ':title зроблены :mapper',
        ],

        'sort' => [
            '_' => 'Адсартавана па:',
            'created_at' => '',
            'timeline' => '',
            'updated_at' => '',
        ],

        'stats' => [
            'deleted' => 'Выдалена',
            'mapper_notes' => 'Нататкі',
            'mine' => 'Мой',
            'pending' => 'Чакае',
            'praises' => 'Пахвалы',
            'resolved' => 'Вырашана',
            'total' => 'Усе',
        ],

        'status-messages' => [
            'approved' => 'Гэтая бітмапа была ўхвалена :date!',
            'graveyard' => "Гэтыя бітмапа не абнаўлялася з :date і падобна на тое, што ейны стваральнік закінуў яе...",
            'loved' => 'Гэтая бітмапа была даданая да «любімай» :date!',
            'ranked' => 'Гэтая бітмапа набыла ранг :date!',
            'wip' => 'Заўвага: Гэтая бітмапа была пазначана стваральнікам як незавершаная.',
        ],

    ],

    'hype' => [
        'button' => 'Надаць хайп бітмапе!',
        'button_done' => 'Хайп ужо быў нададзены!',
        'confirm' => "Вы ўпэўнены? Гэта выкарыстае 1 адзінку хайпу з :n і адмяніць будзе немагчыма.",
        'explanation' => 'Гэта зробіць бітмапу даступнай для намінавання!',
        'explanation_guest' => 'Увайдзіце, каб надаць хайпу гэтай бітмапе для намінацыі і рэйтынгу!',
        'new_time' => "Вы атрымалі іншы хайп :new_time.",
        'remaining' => 'У вас засталося :remaining хайпа.',
        'required_text' => 'Хайп: :current/:required',
        'section_title' => 'Прагрэс хуйпу',
        'title' => 'Надаць хайп',
    ],

    'feedback' => [
        'button' => 'Пакінуць водгук',
    ],

    'nominations' => [
        'delete' => 'Выдаліць',
        'delete_own_confirm' => 'Вы ўпэўнены? Гэтая бітмапа будзе выдалена і вы будзеце перанакіраваны назад у свой профіль.',
        'delete_other_confirm' => 'Вы ўпэўнены? Гэтая бітмапа будзе выдалена і вы будзеце перанакіраваны назад у профіль карыстальніка.',
        'disqualification_prompt' => 'Прычына дыскваліфікацыі?',
        'disqualified_at' => 'Дыскваліфікаваны :time_ago (:reason).',
        'disqualified_no_reason' => 'няма вызначанай прычыны',
        'disqualify' => 'Дыскваліфікаваць',
        'incorrect_state' => 'Узнікла невядомая памылка, паспрабуйце перазагрузіць старонку.',
        'love' => 'Любімае',
        'love_confirm' => 'Адзначыць гэтую бітмапу як любімую?',
        'nominate' => 'Намінаваць',
        'nominate_confirm' => 'Намінаваць гэтую бітмапу?',
        'nominated_by' => 'намінавана :users',
        'qualified' => 'Калі больш няма праблем, то бітмапа атрымае статус ракнутой прыблізна :date.',
        'qualified_soon' => 'Калі больш няма праблем, то бітмапа атрымае статус ракнутой вельмі хутка.',
        'required_text' => 'Намінацыі: :current/:required',
        'reset_message_deleted' => 'выдалена',
        'title' => 'Стан намінацыі',
        'unresolved_issues' => 'Усё яшчэ ёсць нявырашаныя праблемы, якія трэбы вырашыць у першую чаргу.',

        'reset_at' => [
            'nomination_reset' => ':user скінуў прагрэс намінацый :time_ago з-за новай праблемы :discussion (:message).',
            'disqualify' => ':user дыскваліфікаваў :time_ago з-за новай праблемы :discussion (:message).',
        ],

        'reset_confirm' => [
            'nomination_reset' => 'Вы ўпэўнены? Паведамленне аб новай праблемы скіне прагрэс намінацыі.',
            'disqualify' => 'Вы ўпэўнены? Гэта выдаліць бітмапу з кваліфікацыі і скіне прагрэс намінацыі.',
        ],
    ],

    'listing' => [
        'search' => [
            'prompt' => 'напішыце ключавыя словы...',
            'login_required' => 'Увайдзіце, каб шукаць.',
            'options' => 'Больш параметраў пошуку',
            'supporter_filter' => 'Фільтрацыя па :filters патрабуе наяўнасці актыўнага тэга osu!supporter',
            'not-found' => 'няма вынікаў',
            'not-found-quote' => '... няма, нічога не знойдзена.',
            'filters' => [
                'general' => 'Агульнае',
                'mode' => 'Рэжым',
                'status' => 'Катэгорыі',
                'genre' => 'Жанр',
                'language' => 'Мова',
                'extra' => 'дадаткова',
                'rank' => 'Рэйтынг',
                'played' => 'Згуляна',
            ],
            'sorting' => [
                'title' => '',
                'artist' => '',
                'difficulty' => '',
                'updated' => '',
                'ranked' => '',
                'rating' => '',
                'plays' => '',
                'relevance' => '',
                'nominations' => '',
            ],
            'supporter_filter_quote' => [
                '_' => 'Фільтрацыі па :filters патрабуецца :link',
                'link_text' => 'тэг osu!supporter',
            ],
        ],
    ],
    'general' => [
        'recommended' => 'Рэкамендавана цяжкасць',
        'converts' => 'Уключыць канвертаваныя бітмапы',
    ],
    'mode' => [
        'any' => 'Усе',
        'osu' => '',
        'taiko' => '',
        'fruits' => '',
        'mania' => '',
    ],
    'status' => [
        'any' => 'Усе',
        'ranked-approved' => 'Рэйтынгавыя і ўсхваліныя',
        'approved' => 'Усхваліныя',
        'qualified' => 'Кваліфікаваныя',
        'loved' => 'Любімыя',
        'faves' => 'Абраныя',
        'pending' => 'Чаканыя і ў працэсе распрацоўкі',
        'graveyard' => 'Закінутыя',
        'my-maps' => 'Мае мапы',
    ],
    'genre' => [
        'any' => 'Усе',
        'unspecified' => 'Не вызначана',
        'video-game' => 'Відэа гульні',
        'anime' => 'Анімэ',
        'rock' => 'Рок',
        'pop' => 'Поп',
        'other' => 'Iншае',
        'novelty' => 'Новый',
        'hip-hop' => 'Хіп-хоп',
        'electronic' => 'Электронная музыка',
    ],
    'mods' => [
        '4K' => '',
        '5K' => '',
        '6K' => '',
        '7K' => '',
        '8K' => '',
        '9K' => '',
        'AP' => '',
        'DT' => '',
        'EZ' => '',
        'FI' => '',
        'FL' => '',
        'HD' => '',
        'HR' => '',
        'HT' => '',
        'NC' => '',
        'NF' => '',
        'NM' => '',
        'PF' => '',
        'Relax' => '',
        'SD' => '',
        'SO' => '',
        'TD' => '',
    ],
    'language' => [
        'any' => '',
        'english' => 'Англійская',
        'chinese' => 'Кітайская',
        'french' => 'Французская',
        'german' => 'Нямецкая',
        'italian' => 'Італьянская',
        'japanese' => 'Японская',
        'korean' => 'Карэйская',
        'spanish' => 'Іспанская',
        'swedish' => 'Шведская',
        'instrumental' => 'Інструментал',
        'other' => 'Іншае',
    ],
    'played' => [
        'any' => 'Усе',
        'played' => 'Згуляна',
        'unplayed' => 'Не згуляна',
    ],
    'extra' => [
        'video' => 'Ёсць відэа',
        'storyboard' => 'Ёсць дошка гісторыі',
    ],
    'rank' => [
        'any' => 'Усе',
        'XH' => 'Срэбны SS',
        'X' => '',
        'SH' => 'Срэбны S',
        'S' => '',
        'A' => '',
        'B' => '',
        'C' => '',
        'D' => '',
    ],
    'panel' => [
        'playcount' => '',
        'favourites' => '',
    ],
];
