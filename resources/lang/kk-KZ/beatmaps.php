<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'change_owner' => [
        'too_many' => '',
    ],

    'discussion-votes' => [
        'update' => [
            'error' => 'Дауысты жаңарту іске аспады',
        ],
    ],

    'discussions' => [
        'allow_kudosu' => 'кудосуға рұқсат беру',
        'beatmap_information' => 'Карта Беті',
        'delete' => 'жою',
        'deleted' => ':editor :delete_time уақытында жойды.',
        'deny_kudosu' => 'кудосуға рұқсат бермеу',
        'edit' => 'өзгерту',
        'edited' => ':editor :update_time уақытында өзгертті.',
        'guest' => ':user ұсынған қонақтық қиындық',
        'kudosu_denied' => 'Кудосу алуға рұқсат берілмеді.',
        'message_placeholder_deleted_beatmap' => 'Бұл қиындық жойылды, сондықтан оны бұдан былай талқылауға болмайды.',
        'message_placeholder_locked' => 'Бұл карта үшін пікірталас өшірілген.',
        'message_placeholder_silenced' => "Бітеулі кезде пікірталас жүргізуге болмайды.",
        'message_type_select' => 'Пікір Типін таңдаңыз',
        'reply_notice' => 'Жауап беру үшін enter пернесін басыңыз.',
        'reply_resolve_notice' => '',
        'reply_placeholder' => 'Жауабыңызды осы жерге теріңіз',
        'require-login' => 'Жазба қалдыру немесе жауап беру үшін аккаунтыңызға кіріңіз',
        'resolved' => 'Шешілді',
        'restore' => 'қалпына келтіру',
        'show_deleted' => 'Жойылғандарды көрсету',
        'title' => 'Пікірталастар',
        'unresolved_count' => '',

        'collapse' => [
            'all-collapse' => 'Бәрін жасыру',
            'all-expand' => 'Барлығын кеңейту',
        ],

        'empty' => [
            'empty' => 'Әзірге пікірталас жоқ!',
            'hidden' => 'Таңдаулы сүзгіге келетін пікірталас жоқ.',
        ],

        'lock' => [
            'button' => [
                'lock' => 'Пікірталасты жабу',
                'unlock' => 'Пікірталасты ашу',
            ],

            'prompt' => [
                'lock' => 'Жабу себебі',
                'unlock' => 'Пікірталасты ашуға сенімдісіз бе?',
            ],
        ],

        'message_hint' => [
            'in_general' => 'Бұл жазба негізгі карта пікірталасына жөнелтіледі. Осы картаны модтау үшін хабарламаңызды уақыт белгісімен бастаңыз (мысалға 00:12:345).',
            'in_timeline' => 'Бірнеше уақыт белгілерін модтау үшін бірнеше жазба жөнелтесіз (бір жазбаға бір уақыт белгісі).',
        ],

        'message_placeholder' => [
            'general' => 'Негізгіге жөнелтетін жазбаны мында теріңіз (:version)',
            'generalAll' => 'Негізгіге жөнелтетін жазбаны мында теріңіз (Барлық қиындықтар)',
            'review' => 'Сын пікіріңізді мында теріңіз',
            'timeline' => 'Уақыт Межелігіне жөнелтетін жазбаны мында теріңіз (:version)',
        ],

        'message_type' => [
            'disqualify' => 'Дисквалификациялау',
            'hype' => 'Хайптау!',
            'mapper_note' => 'Жазба',
            'nomination_reset' => 'Номинацияны қалпына келтіру',
            'praise' => 'Мақтау',
            'problem' => 'Мәселе',
            'problem_warning' => 'Мәселе жайлы хабарлау',
            'review' => 'Сын пікір',
            'suggestion' => 'Ұсыныс',
        ],

        'message_type_title' => [
            'disqualify' => '',
            'hype' => 'Хайп жіберу!',
            'mapper_note' => '',
            'nomination_reset' => '',
            'praise' => 'Мақтау жіберу',
            'problem' => 'Мәселе жіберу',
            'problem_warning' => 'Мәселе жіберу',
            'review' => 'Қарау жіберу',
            'suggestion' => 'Ұсыныс жіберу',
        ],

        'mode' => [
            'events' => 'Тарих',
            'general' => 'Негізгі :scope',
            'reviews' => 'Сын пікірлер',
            'timeline' => 'Уақыт межелігі',
            'scopes' => [
                'general' => 'Осы қиындық',
                'generalAll' => 'Барлық қиындықтар',
            ],
        ],

        'new' => [
            'pin' => 'Бекіту',
            'timestamp' => 'Уақыт белгісі',
            'timestamp_missing' => 'уақыт белгісін қосу үшін өзгерту режимінде Ctrl-C және осында Ctrl-V басыңыз!',
            'title' => 'Жаңа Пікірталас',
            'unpin' => 'Шешу',
        ],

        'review' => [
            'new' => 'Жаңа Сын пікірлер',
            'embed' => [
                'delete' => 'Жою',
                'missing' => '[ПІКІРТАЛАС ЖОЙЫЛДЫ]',
                'unlink' => 'Байланысты жою',
                'unsaved' => 'Сақталмаған',
                'timestamp' => [
                    'all-diff' => '"Барлық қиындықтардағы" жазбаларда уақыт белгілеуге болмайды.',
                    'diff' => 'Жазба уақыт белгісімен басталса ол Уақыт Межелігінің астында көрсетіледі.',
                ],
            ],
            'insert-block' => [
                'paragraph' => 'абзац енгізу',
                'praise' => 'мақтау енгізу',
                'problem' => 'мәселе енгізу',
                'suggestion' => 'ұсыныс енгізу',
            ],
        ],

        'show' => [
            'title' => ':title авторы :mapper',
        ],

        'sort' => [
            'created_at' => 'Құру датасы',
            'timeline' => 'Уақыт Межелігі',
            'updated_at' => 'Соңғы жаңарту',
        ],

        'stats' => [
            'deleted' => 'Жойылған',
            'mapper_notes' => 'Ескертпелер',
            'mine' => 'Менікі',
            'pending' => 'Қарастырылуда',
            'praises' => 'Мақтаулар',
            'resolved' => 'Шешілді',
            'total' => 'Бәрі',
        ],

        'status-messages' => [
            'approved' => 'Бұл карта :date датасында мақұлданды!',
            'graveyard' => "Бұл карта :date датасынан бері жаңартылмады, сондықтан автор одан қол үзген секілді...",
            'loved' => 'Бұл карта :date датасында сүйікті атанды!',
            'ranked' => 'Бұл карта :date датасында рейтингтік атанды!',
            'wip' => 'Ескерту: Автор бұл картаны бітпеген деп белгіледі.',
        ],

        'votes' => [
            'none' => [
                'down' => 'Әзірге ешкім қарсы дауыс берген жоқ',
                'up' => 'Әзірге ешкім қостап дауыс берген жоқ',
            ],
            'latest' => [
                'down' => 'Соңғы қарсы дауыстар',
                'up' => 'Соңғы жақтаушы дауыстар',
            ],
        ],
    ],

    'hype' => [
        'button' => 'Картаны хайптау!',
        'button_done' => 'Хайпталып қойған!',
        'confirm' => "Сенімдіміз бе? Сіздің :n хайптарыңыздың біреуі қолданылады және оны қайтару мүмкін емес болады.",
        'explanation' => 'Бұл картаның номинацияда және рейтингте жақсырақ көрінуі үшін оны хайптаңыз!',
        'explanation_guest' => 'Бұл картаның номинацияда және рейтингте жақсырақ көрінуі үшін аккаунтыңызға кіріп, оны хайптаңыз!',
        'new_time' => "Сіз тағы бір хайп иеленесіз :new_time.",
        'remaining' => 'Сізде :remaining хайп қалды.',
        'required_text' => 'Хайп: :current/:required',
        'section_title' => 'Хайп Пойызы',
        'title' => 'Хайп',
    ],

    'feedback' => [
        'button' => 'Пікір қалдыру',
    ],

    'nominations' => [
        'already_nominated' => 'Сіз бұл картаны бұған дейін номинациялап қойдыңыз.',
        'cannot_nominate' => 'Сіз бұл карта ойын режимін номинациялай алмайсыз.',
        'delete' => 'Жою',
        'delete_own_confirm' => 'Сенімдісіз бе? Бұл карта жойылады да сіз қайта өз профиліңізге қайтарыласыз.',
        'delete_other_confirm' => 'Сенімдісіз бе? Бұл карта жойылады да сіз қайта қолданушы профиліне қайтарыласыз.',
        'disqualification_prompt' => 'Дисквалификация себебі?',
        'disqualified_at' => ':time_ago дисквалификацияланған (:reason).',
        'disqualified_no_reason' => 'себебі берілмеген',
        'disqualify' => 'Дисквалификациялау',
        'incorrect_state' => 'Әрекетті орындауда қателік орын алды, бетті жаңартып көріңіз.',
        'love' => 'Ұнату',
        'love_choose' => 'Ұнамды картаға қиындық таңдау',
        'love_confirm' => 'Бұл карта ұнай ма?',
        'nominate' => 'Номинациялау',
        'nominate_confirm' => 'Осы картаны номинациялайсыз ба?',
        'nominated_by' => ':users пайдаланушыдан номинация берілді',
        'not_enough_hype' => "Хайп жеткіліксіз болып тұр.",
        'remove_from_loved' => 'Ұнамдыдан алып тастау',
        'remove_from_loved_prompt' => 'Ұнамдыдан алып тастау себебі:',
        'required_text' => 'Номинациялар: :current/:required',
        'reset_message_deleted' => 'жойылған',
        'title' => 'Номинация Жағдайы',
        'unresolved_issues' => 'Ең алдымен шешімін табуы тиіс шешілмеген мәселелер бар.',

        'rank_estimate' => [
            '_' => 'Мәселе табылмаса, бұл картаның рейтингі :date күні беріледі. Бұл :queue ішінде #:position тұр.',
            'unresolved_problems' => '',
            'problems' => 'осы мәселелер',
            'on' => ':date күні',
            'queue' => 'рейтинг беру кезегі',
            'soon' => 'жуырда',
        ],

        'reset_at' => [
            'nomination_reset' => ':user номинация үдерісін жаңа мәселе кесірінен :time_ago бастапқы қалпына қайтарды :discussion (:message).',
            'disqualify' => ':user жаңа мәселе кесірінен :time_ago дисквалификациялады :discussion (:message).',
        ],

        'reset_confirm' => [
            'disqualify' => 'Сіз сенімдісіз бе? Бұл картадан квалификацияны алып тастайды және номинация үдерісін қалпына келтіреді.',
            'nomination_reset' => 'Сіз сенімдісіз бе? Жаңа мәселені жариялау номинация үдерісін қалпына келтіреді.',
            'problem_warning' => 'Осы картадағы мәселені хабарлауға сенімдісіз бе? Бұл номинаторларды ескертеді.',
        ],
    ],

    'listing' => [
        'search' => [
            'prompt' => 'кілт сөздерді енгізіңіз...',
            'login_required' => 'Іздеу үшін аккаунтыңызға кіріңіз.',
            'options' => 'Көбірек Іздеу Баптаулары',
            'supporter_filter' => ':filters бойынша сүзу үшін белсенді osu!supporter тегі қажет',
            'not-found' => 'нәтиже жоқ',
            'not-found-quote' => '... өкінішке орай, ештеңе табылмады.',
            'filters' => [
                'extra' => 'Қосымша',
                'general' => 'Негізгі',
                'genre' => 'Жанры',
                'language' => 'Тілі',
                'mode' => 'Режимі',
                'nsfw' => 'Былапыт Мазмұнды',
                'played' => 'Ойналды',
                'rank' => 'Рейтингі Жетілді',
                'status' => 'Санаттар',
            ],
            'sorting' => [
                'title' => 'Атауы',
                'artist' => 'Әртіс',
                'difficulty' => 'Деңгейі',
                'favourites' => 'Таңдаулылар',
                'updated' => 'Жаңартылған',
                'ranked' => 'Рейтингілік',
                'rating' => 'Рейтингі',
                'plays' => 'Ойындар',
                'relevance' => 'Релеванттығы',
                'nominations' => 'Номинациялар',
            ],
            'supporter_filter_quote' => [
                '_' => ':filters бойынша сүзу үшін белсенді :link қажет',
                'link_text' => 'osu!supporter тегі',
            ],
        ],
    ],
    'general' => [
        'converts' => 'Конвертерленген карталарды қосу',
        'featured_artists' => 'Таңдаулы Әртістер',
        'follows' => 'Жазылынған мапперлер',
        'recommended' => 'Жарасымды деңгей',
        'spotlights' => 'Чартқа кіретін карталар',
    ],
    'mode' => [
        'all' => 'Бәрі',
        'any' => 'Кез келген',
        'osu' => '',
        'taiko' => '',
        'fruits' => '',
        'mania' => '',
        'undefined' => '',
    ],
    'status' => [
        'any' => 'Кез келген',
        'approved' => 'Қабылданған',
        'favourites' => 'Таңдаулылар',
        'graveyard' => 'Тасталынған',
        'leaderboard' => 'Үздіктер кестесі бар',
        'loved' => 'Ұнамды',
        'mine' => 'Менің карталарым',
        'pending' => 'Қарастырылуда',
        'wip' => 'Жұмыс орындалуда',
        'qualified' => 'Квалификацияланған',
        'ranked' => 'Рейтингілік',
    ],
    'genre' => [
        'any' => 'Кез келген',
        'unspecified' => 'Анықталмаған',
        'video-game' => 'Видео Ойын',
        'anime' => 'Аниме',
        'rock' => 'Рок',
        'pop' => 'Поп',
        'other' => 'Басқа',
        'novelty' => 'Жаңашылдық',
        'hip-hop' => 'Хип-Хоп',
        'electronic' => 'Электро',
        'metal' => 'Метал',
        'classical' => 'Классика',
        'folk' => 'Ұлттық',
        'jazz' => 'Джаз',
    ],
    'language' => [
        'any' => 'Кез келген',
        'english' => 'Ағылшын',
        'chinese' => 'Қытай',
        'french' => 'Француз',
        'german' => 'Неміс',
        'italian' => 'Итальян',
        'japanese' => 'Жапон',
        'korean' => 'Кәріс',
        'spanish' => 'Испан',
        'swedish' => 'Швед',
        'russian' => 'Орыс',
        'polish' => 'Поляк',
        'instrumental' => 'Аспапты',
        'other' => 'Басқа',
        'unspecified' => 'Анықталмаған',
    ],

    'nsfw' => [
        'exclude' => 'Жасыру',
        'include' => 'Көрсету',
    ],

    'played' => [
        'any' => 'Кез келген',
        'played' => 'Ойналған',
        'unplayed' => 'Ойналмаған',
    ],
    'extra' => [
        'video' => 'Бейнесімен',
        'storyboard' => 'Сториборды бар',
    ],
    'rank' => [
        'any' => 'Кез келген',
        'XH' => 'Күміс SS',
        'X' => '',
        'SH' => 'Күміс S',
        'S' => '',
        'A' => '',
        'B' => '',
        'C' => '',
        'D' => '',
    ],
    'panel' => [
        'playcount' => 'Ойын саны :count',
        'favourites' => 'Ұнау саны :count',
    ],
    'variant' => [
        'mania' => [
            '4k' => '4K',
            '7k' => '7K',
            'all' => 'Бәрі',
        ],
    ],
];
