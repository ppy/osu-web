<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'deleted' => '[обрисан корисник]',

    'beatmapset_activities' => [
        'title' => "Историјске Измене од :user",
        'title_compact' => 'Измене',

        'discussions' => [
            'title_recent' => 'Скоро започете дискусије',
        ],

        'events' => [
            'title_recent' => 'Недавни догађаји',
        ],

        'posts' => [
            'title_recent' => 'Скорији постови',
        ],

        'votes_received' => [
            'title_most' => 'Највише лајкова сортирано по (последња 3 месеца)',
        ],

        'votes_made' => [
            'title_most' => 'Највише лајкова (последња 3 месеца)',
        ],
    ],

    'blocks' => [
        'banner_text' => 'Блокирали сте овог корисника.',
        'comment_text' => 'Овај коментар је сакривен.',
        'blocked_count' => 'блокирани корисници (:count)',
        'hide_profile' => 'Сакриј профил',
        'hide_comment' => 'сакриј',
        'forum_post_text' => 'Овај пост је сакривен.',
        'not_blocked' => 'Овај корисник није блокиран.',
        'show_profile' => 'Прикажи профил',
        'show_comment' => 'прикажи',
        'too_many' => 'Ограничење листе блокираних корисника је достигнуто.',
        'button' => [
            'block' => 'Блокирај',
            'unblock' => 'Одблокирај',
        ],
    ],

    'card' => [
        'gift_supporter' => 'Поклони osu!supporter ознаку',
        'loading' => 'Учитавање...',
        'send_message' => 'Пошаљите поруку',
    ],

    'create' => [
        'form' => [
            'password' => 'лозинка',
            'password_confirmation' => 'потврда лозинке',
            'submit' => 'креирај налог',
            'user_email' => 'Е-пошта',
            'user_email_confirmation' => 'потврда Е-поште',
            'username' => 'корисничко име',

            'tos_notice' => [
                '_' => 'креирањем налога прихватате :link',
                'link' => 'услове коришћења',
            ],
        ],
    ],

    'disabled' => [
        'title' => 'Изгледа да је ваш налог угашен.',
        'warning' => "У случају да сте прекршили неко правила, молимо Вас да узмете у обзир да постоји период од месец дана између захтева за амнестију који мора проћи да би смо узели захтев у обзир. После овог периода, слободно нас контактирајте ако верујете да је то неопходно. Такође узмите у обзир да креирање нових налога након што Вам је први налог угашен ће <strong>продужити период након кога можете послати захтев за амнестију</strong>. <strong>За сваки налог који направите, додатно кршите правила<strong>. Предлажемо вам да не радите то!",

        'if_mistake' => [
            '_' => 'Ако мислите да је ово грешка, можете нас контактирати (преко :email или кликом на "?" доле-лево у ћошку странице). Узмите у обзир да смо увек 100% сигурни у наше акције, зато што су базиране на солидним подацима. Задржавамо права да занемаримо Ваш захтев ако имамо осећај да сте намерно неискрени.',
            'email' => 'Е-пошта',
        ],

        'reasons' => [
            'compromised' => 'Изгледа да је ваш налог угрожен. Можда ће бити недоступан привремено док се не потврди идентитет власника.',
            'opening' => 'Постоји број разлога зашто Ваш налог може бити угашен:',

            'tos' => [
                '_' => 'Прекршили сте једно или више наших :community_rules или :tos.',
                'community_rules' => 'правила заједнице',
                'tos' => 'услове коришћења',
            ],
        ],
    ],

    'filtering' => [
        'by_game_mode' => 'Чланови сортирани по моду',
    ],

    'force_reactivation' => [
        'reason' => [
            'inactive' => "Ваш налог није коришћен дужи период времена.",
            'inactive_different_country' => "Ваш налог није коришћен дужи период времена.",
        ],
    ],

    'login' => [
        '_' => 'Пријавите се',
        'button' => 'Пријавите се',
        'button_posting' => 'Пријављивање...',
        'email_login_disabled' => 'Пријављивање са Е-поштом је тренутно онемогућен. Молимо Вас да користите корисничко име.',
        'failed' => 'Нетачна пријава',
        'forgot' => 'Заборавили сте лозинку?',
        'info' => 'Молимо Вас да се пријавите да бисте наставили',
        'invalid_captcha' => 'Превише неуспелих покушаја пријаве, молимо Вас да урадите captcha и пробате поново. (Освежите страницу ако не видите captcha)',
        'locked_ip' => 'Ваша IP адреса је закључана. Молимо Вас да сачекате пар минута.',
        'password' => 'Лозинка',
        'register' => "Немате osu! налог? Направите нови",
        'remember' => 'Упамти ме на овом рачунару',
        'title' => 'Молимо Вас да се пријавите да би сте наставили',
        'username' => 'Корисничко име',

        'beta' => [
            'main' => 'Приступ beta верзији је тренутно дозвољено само привилегованим корисницима.',
            'small' => '(osu!supporters ће ускоро добити приступ)',
        ],
    ],

    'ogp' => [
        'modding_description' => 'Мапе :counts',
        'modding_description_empty' => 'Корисник нема ниједну мапу...',

        'description' => [
            '_' => 'Ранг (:ruleset): :global | :country',
            'country' => 'Државни :rank',
            'global' => 'Глобални :rank',
        ],
    ],

    'posts' => [
        'title' => ':username\'s постови',
    ],

    'anonymous' => [
        'login_link' => 'кликните за пријављивање',
        'login_text' => 'пријавите се',
        'username' => 'Гост',
        'error' => 'Морате бити пријављени да би сте извршили ову акцију.',
    ],
    'logout_confirm' => 'Да ли сте сигурни да се желите одјавити? :(',
    'report' => [
        'button_text' => 'Пријавите',
        'comments' => 'Коментари',
        'placeholder' => 'Молимо Вас унесите било које детаље за које сматрате да могу бити корисни.',
        'reason' => 'Разлог',
        'thanks' => 'Хвала на извештају!',
        'title' => 'Пријавите корисника :username?',

        'actions' => [
            'send' => 'Пошаљи Извештај',
            'cancel' => 'Откажи',
        ],

        'dmca' => [
            'message_1' => [
                '_' => '',
                'policy' => '',
            ],
            'message_2' => '',
        ],

        'options' => [
            'cheating' => 'Варање',
            'copyright_infringement' => '',
            'inappropriate_chat' => '',
            'insults' => 'Вређа мене / друге',
            'multiple_accounts' => 'Коришћење више налога',
            'nonsense' => 'Глупости',
            'other' => 'Друго (напишите испод)',
            'spam' => 'Спамовање',
            'unwanted_content' => 'Линковање неприкладног садржаја',
        ],
    ],
    'restricted_banner' => [
        'title' => 'Ваш налог је суспендован!',
        'message' => 'Док сте суспендовани, не можете имати интеракцију са другим играчима и Ваши резултати ће бити видљиви само вама. Суспензија је углавном део аутоматизованог процеса и уобичајено је уклоњена у року од 24 сата. Ако желите послати жалбу, молимо Вас да <a href="mailto:accounts@ppy.sh">контактирате подршку</a>.',
        'message_link' => 'Проверите ову страницу да бисте сазнали више.',
    ],
    'show' => [
        'age' => 'стар :age година',
        'change_avatar' => 'промените аватар!',
        'first_members' => 'Овде од почетка',
        'is_developer' => 'osu!програмер',
        'is_supporter' => 'osu!supporter',
        'joined_at' => 'Придружио/ла се :date',
        'lastvisit' => 'Последњи пут виђен/a :date',
        'lastvisit_online' => 'Тренутно Доступан',
        'missingtext' => 'Можда сте направили грешку у куцању! (или је корисник можда банован)',
        'origin_country' => 'Из :country',
        'previous_usernames' => 'претходно познати као',
        'plays_with' => 'Игра са :devices',

        'comments_count' => [
            '_' => 'Постовао :link',
            'count' => ':count_delimited коментар|:count_delimited коментара',
        ],
        'cover' => [
            'to_0' => 'Сакриј позадину',
            'to_1' => 'Прикажи позадину',
        ],
        'daily_challenge' => [
            'daily' => 'Дневна Серија',
            'daily_streak_best' => 'Најбоља Дневна Серија',
            'daily_streak_current' => 'Тренутна Дневна Серија',
            'playcount' => 'Укупно Учесника',
            'title' => 'Дневни\nИзазов',
            'top_10p_placements' => '10% Најбољих Места',
            'top_50p_placements' => '50% Најбољих Места',
            'weekly' => 'Недељна Серија',
            'weekly_streak_best' => 'Најбоља Недељна Серија',
            'weekly_streak_current' => 'Тренутна Недељна Серија',

            'unit' => [
                'day' => ':valueд',
                'week' => ':valueн',
            ],
        ],
        'edit' => [
            'cover' => [
                'button' => 'Промени Позадину Профила',
                'defaults_info' => 'Више опција за позадине ће бити доступне ускоро',
                'holdover_remove_confirm' => "Претходно изабрана позадина више није доступан за избор. Не можете га поново изабрати након преласка на другу позадину. Наставити?",
                'title' => 'Позадина',

                'upload' => [
                    'broken_file' => 'Процесуирање слике није било успешно. Проверите послату слику и пробајте поново.',
                    'button' => 'Додај слику',
                    'dropzone' => 'Превуците овде да би сте додали слику',
                    'dropzone_info' => 'Такође можете превући своју слику овде да би сте је додали',
                    'size_info' => 'Величина позадине мора бити 2400x640',
                    'too_large' => 'Послата датотека је превелика.',
                    'unsupported_format' => 'Неподржани формат.',

                    'restriction_info' => [
                        '_' => 'Слање достуно само за :link',
                        'link' => 'osu!supporter-е',
                    ],
                ],
            ],

            'default_playmode' => [
                'is_default_tooltip' => 'подразумевани мод игре',
                'set' => 'подесите :mode као подразумевани мод',
            ],

            'hue' => [
                'reset_no_supporter' => 'Желите да промените боју на подразумевану? osu!supporter ће бити потребна да би сте променили у другу боју.',
                'title' => 'Боја',

                'supporter' => [
                    '_' => 'Прилагођене теме боја доступне су само за :link',
                    'link' => 'osu!supporter',
                ],
            ],
        ],

        'extra' => [
            'none' => 'ниједан',
            'unranked' => 'Није скорије играно',

            'achievements' => [
                'achieved-on' => 'Постигнуто :date',
                'locked' => 'Закључано',
                'title' => 'Достигнућа',
            ],
            'beatmaps' => [
                'by_artist' => 'од :artist',
                'title' => 'Мапе',

                'favourite' => [
                    'title' => 'Омиљене Мапе',
                ],
                'graveyard' => [
                    'title' => 'Запуштене Мапе',
                ],
                'guest' => [
                    'title' => 'Мапе са учешћем гостију',
                ],
                'loved' => [
                    'title' => 'Loved Мапе',
                ],
                'nominated' => [
                    'title' => 'Номиноване рангиране мапе',
                ],
                'pending' => [
                    'title' => 'Нерешене Мапе',
                ],
                'ranked' => [
                    'title' => 'Рангиране Мапе',
                ],
            ],
            'discussions' => [
                'title' => 'Дискусије',
                'title_longer' => 'Скорашње Дискусије',
                'show_more' => 'погледајте још дискусија',
            ],
            'events' => [
                'title' => 'Догађаји',
                'title_longer' => 'Недавни догађаји',
                'show_more' => 'погледајте још догађаја',
            ],
            'historical' => [
                'title' => 'Историјски',

                'monthly_playcounts' => [
                    'title' => 'Број играња',
                    'count_label' => 'Играња',
                ],
                'most_played' => [
                    'count' => 'одиграно пута',
                    'title' => 'Најиграније Мапе',
                ],
                'recent_plays' => [
                    'accuracy' => ':percentage прецизности',
                    'title' => 'Скорашње Игре (24h)',
                ],
                'replays_watched_counts' => [
                    'title' => 'Историја погледаних резултата',
                    'count_label' => 'Погледани Резултати',
                ],
            ],
            'kudosu' => [
                'recent_entries' => 'Скорија kudosu историја',
                'title' => 'Kudosu!',
                'total' => 'Укупан број зарађених kudosu-а',

                'entry' => [
                    'amount' => ':amount kudosu',
                    'empty' => "Овај корисник није добио kudosu!",

                    'beatmap_discussion' => [
                        'allow_kudosu' => [
                            'give' => 'Примио :amount kudosu за порицање укидања мод поста :post',
                        ],

                        'deny_kudosu' => [
                            'reset' => 'Одбијен :amount од мод поста :post',
                        ],

                        'delete' => [
                            'reset' => 'Изгубио :amount због брисања мод поста у :post',
                        ],

                        'restore' => [
                            'give' => 'Примио :amount за рестаурацију мод поста :post',
                        ],

                        'vote' => [
                            'give' => 'Примио :amount због добијених гласова у мод посту :post',
                            'reset' => 'Изгубио :amount због губитка гласова у мод посту :post',
                        ],

                        'recalculate' => [
                            'give' => 'Примио :amount због прерачуна гласова у мод посту :post',
                            'reset' => 'Изгубио :amount због прерачуна гласова у мод посту :post',
                        ],
                    ],

                    'forum_post' => [
                        'give' => 'Примио :amount од :giver за пост :post',
                        'reset' => 'Kudosu ресетован од стране корисника :giver за пост :post',
                        'revoke' => 'Kudosu је одбијен од стране корисника :giver за пост :post',
                    ],
                ],

                'total_info' => [
                    '_' => 'У зависности од доприноса који је корисник направио у модерацији мапа. Погледајте :link за више информација.',
                    'link' => 'на овој страници',
                ],
            ],
            'me' => [
                'title' => 'о мени!',
            ],
            'medals' => [
                'empty' => "Овај корисник још увек нема медаље. ;_;",
                'recent' => 'Најновије',
                'title' => 'Медаље',
            ],
            'playlists' => [
                'title' => 'Плејлист Игре',
            ],
            'posts' => [
                'title' => 'Објаве',
                'title_longer' => 'Скорије Објаве',
                'show_more' => 'видите још објава',
            ],
            'recent_activity' => [
                'title' => 'Скорашње',
            ],
            'realtime' => [
                'title' => 'Мултиплејер Игре',
            ],
            'top_ranks' => [
                'download_replay' => 'Преузмите Снимак',
                'not_ranked' => 'Само ранковане мапе дају pp',
                'pp_weight' => 'процењен :percentage',
                'view_details' => 'Прикажи детаље',
                'title' => 'Рангови',

                'best' => [
                    'title' => 'Најбоље перформансе',
                ],
                'first' => [
                    'title' => 'Прва места',
                ],
                'pin' => [
                    'to_0' => 'Откачи',
                    'to_0_done' => 'Резултат откачен',
                    'to_1' => 'Закачи',
                    'to_1_done' => 'Резултат закачен',
                ],
                'pinned' => [
                    'title' => 'Закачени резултати',
                ],
            ],
            'votes' => [
                'given' => 'Дати гласови (последња 3 месеца)',
                'received' => 'Примљени гласови (последња 3 месеца)',
                'title' => 'Гласови',
                'title_longer' => 'Скорији гласови',
                'vote_count' => ':count_delimited глас|:count_delimited гласови',
            ],
            'account_standing' => [
                'title' => 'Стање Налога',
                'bad_standing' => "налог корисника :username није у добром стању :(",
                'remaining_silence' => ':username ће моћи да пише поново за :duration.',

                'recent_infringements' => [
                    'title' => 'Скорија кршења правила',
                    'date' => 'датум',
                    'action' => 'радња',
                    'length' => 'дужина',
                    'length_indefinite' => 'Неодређен',
                    'description' => 'опис',
                    'actor' => 'од корисника/це :username',

                    'actions' => [
                        'restriction' => 'Бан',
                        'silence' => 'Мутиран',
                        'tournament_ban' => 'Забрана учествовања у турнирима',
                        'note' => 'Белешка',
                    ],
                ],
            ],
        ],

        'info' => [
            'discord' => '',
            'interests' => 'Интереси',
            'location' => 'Тренутна локација',
            'occupation' => 'Занимање',
            'twitter' => '',
            'website' => 'Веб сајт',
        ],
        'not_found' => [
            'reason_1' => 'Можда су променили корисничко име.',
            'reason_2' => 'Овај налог може бити тренутно недоступан због безбедносних проблема или злоупотребе.',
            'reason_3' => 'Можда сте погрешно укуцали!',
            'reason_header' => 'Постоји пар могућих резултата за ово:',
            'title' => 'Корисник није пронађен! ;_;',
        ],
        'page' => [
            'button' => 'уредите страницу налога',
            'description' => '<strong>о мени!</strong> је лично прилагодљив део на вашој страници профила.',
            'edit_big' => 'Измени о мени!',
            'placeholder' => 'Упишите садржај странице овде',

            'restriction_info' => [
                '_' => 'Морате бити :link да би сте откључали ову опцију.',
                'link' => 'osu!supporter',
            ],
        ],
        'post_count' => [
            '_' => 'Допринели :link',
            'count' => ':count_delimited форум објава|:count_delimited форум објава',
        ],
        'rank' => [
            'country' => 'Државни ранг за :mode',
            'country_simple' => 'Државни Ранг',
            'global' => 'Глобални ранг за :mode',
            'global_simple' => 'Глобални ранг',
            'highest' => 'Највиши ранг: :rank на :date',
        ],
        'season_stats' => [
            'division_top_percentage' => '',
            'total_score' => '',
        ],
        'stats' => [
            'hit_accuracy' => 'Прецизност',
            'hits_per_play' => '',
            'level' => ':level ниво',
            'level_progress' => 'напредак до следећег нивоа',
            'maximum_combo' => 'Максимални комбо постигнут',
            'medals' => 'Медаље',
            'play_count' => 'Број Играња',
            'play_time' => 'Укупно време играња',
            'ranked_score' => 'Ранкован резултат',
            'replays_watched_by_others' => 'Број одгледаних снимака резултата',
            'score_ranks' => 'Ранг по укупној цифри резултата',
            'total_hits' => 'Укупан број удараца',
            'total_score' => 'Укупан резултат',
            // modding stats
            'graveyard_beatmapset_count' => 'Запуштене Мапе',
            'loved_beatmapset_count' => 'Loved Мапе',
            'pending_beatmapset_count' => 'Мапе на чекању',
            'ranked_beatmapset_count' => 'Ранговане Мапе',
        ],
    ],

    'silenced_banner' => [
        'title' => 'Тренутно сте мутирани.',
        'message' => 'Неке акције можда неће бити доступне.',
    ],

    'status' => [
        'all' => 'Све',
        'online' => 'Доступан',
        'offline' => 'Офлајн',
    ],
    'store' => [
        'from_client' => 'молимо Вас да се региструјете преко клијента игре!',
        'from_web' => 'молимо довршите регистрацију користећи osu! веб сајт',
        'saved' => 'Корисник је креиран',
    ],
    'verify' => [
        'title' => 'Верификација налога',
    ],

    'view_mode' => [
        'brick' => 'Компактан преглед',
        'card' => 'Преглед као картице',
        'list' => 'Преглед као листа',
    ],
];
