<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'discussion-votes' => [
        'update' => [
            'error' => 'Дошло је до грешке са ажурирањем гласа',
        ],
    ],

    'discussions' => [
        'allow_kudosu' => 'дозволи кудосу',
        'beatmap_information' => 'Страница мапе',
        'delete' => 'обришите',
        'deleted' => 'Обрисано од стране :editor у :delete_time.',
        'deny_kudosu' => 'одбиј кудосу',
        'edit' => 'измени',
        'edited' => 'Последњи пут измењено од стране :editor у :update_time.',
        'guest' => 'Гостојућа тежина од:user',
        'kudosu_denied' => 'Добијање кудосу је одбијено.',
        'message_placeholder_deleted_beatmap' => 'Ова тежина мапе је обрисана и не може се више дискутовати о њој.',
        'message_placeholder_locked' => 'Дискусија за ову мапу је искључена.',
        'message_placeholder_silenced' => "Не можете постовати на дискусију док сте мутирани.",
        'message_type_select' => 'Изабери врсту коментара',
        'reply_notice' => 'Притисните ентер да одговорите.',
        'reply_placeholder' => 'Овде унесите ваш одговор',
        'require-login' => 'Пријавите се да бисте поставили или одговорили',
        'resolved' => 'Решено',
        'restore' => 'поврати',
        'show_deleted' => 'Покажи обрисане',
        'title' => 'Дискусије',

        'collapse' => [
            'all-collapse' => 'Обори све',
            'all-expand' => 'Рашири све',
        ],

        'empty' => [
            'empty' => 'Још увек није започета дискусија!',
            'hidden' => 'Не постоји дискусија која одговара Вашем филтеру.',
        ],

        'lock' => [
            'button' => [
                'lock' => 'Закључај дискусију',
                'unlock' => 'Откључај дискусију',
            ],

            'prompt' => [
                'lock' => 'Разлог за закључавање',
                'unlock' => 'Да ли сте сигурни да желите да откључате дискусију?',
            ],
        ],

        'message_hint' => [
            'in_general' => 'Овај пост ће бити постављен у генералну дискусију за сет мапе. Да би сте модовали ову мапу, започните поруку са маркером (нпр. 00:12:345).',
            'in_timeline' => 'Да би сте модовали више маркера, направите више постова (један пост по маркеру).',
        ],

        'message_placeholder' => [
            'general' => 'Куцајте овде да би сте постовали у Генералну (:version)',
            'generalAll' => 'Куцајте овде да би сте постовали у Генералну (Све тежине)',
            'review' => 'Куцајте овде да би сте поставили рецензију',
            'timeline' => 'Куцајте овде да би сте постовали на временску линију (:version)',
        ],

        'message_type' => [
            'disqualify' => 'Дисквалификуј',
            'hype' => 'Хајп!',
            'mapper_note' => 'Белешке',
            'nomination_reset' => 'Ресетујте номинацију',
            'praise' => 'Похвалите',
            'problem' => 'Проблем',
            'problem_warning' => 'Пријавите Проблем',
            'review' => 'Рецензија',
            'suggestion' => 'Предлог',
        ],

        'mode' => [
            'events' => 'Историја',
            'general' => 'Генерална :scope',
            'reviews' => 'Рецензије',
            'timeline' => 'Временска линија',
            'scopes' => [
                'general' => 'Ова тежина мапе',
                'generalAll' => 'Све тежине мапе',
            ],
        ],

        'new' => [
            'pin' => 'Закачи',
            'timestamp' => 'Временски печат',
            'timestamp_missing' => 'ctrl-c у едит моду и ctrl-v у Вашој поруци да би сте додали временски печат!',
            'title' => 'Нова Дискусија',
            'unpin' => 'Откачи',
        ],

        'review' => [
            'new' => 'Нова рецензија',
            'embed' => [
                'delete' => 'Обриши',
                'missing' => '[ДИСКУСИЈА ОБРИСАНА]',
                'unlink' => 'Раздвоји',
                'unsaved' => 'Несачуване',
                'timestamp' => [
                    'all-diff' => 'Постови за све тежине мапе не могу садржати временски печат.',
                    'diff' => 'Ако :type почиње са временским печатом, биће показана испод временске линије.',
                ],
            ],
            'insert-block' => [
                'paragraph' => 'уметни пасус',
                'praise' => 'уметни похвалу',
                'problem' => 'уметни проблем',
                'suggestion' => 'уметни сугестију',
            ],
        ],

        'show' => [
            'title' => ':title маповано од стране :mapper',
        ],

        'sort' => [
            'created_at' => 'Време креирања',
            'timeline' => 'Временска линија',
            'updated_at' => 'Последње ажурирање',
        ],

        'stats' => [
            'deleted' => 'Обрисано',
            'mapper_notes' => 'Белешке',
            'mine' => 'Моје',
            'pending' => 'На чекању',
            'praises' => 'Похвале',
            'resolved' => 'Решено',
            'total' => 'Све',
        ],

        'status-messages' => [
            'approved' => 'Ова мапа је додата у одобрену категорију :date!',
            'graveyard' => "Ова мапа није ажурирана од :date и из тог разлога је померена у \"graveyarded\" категорију...",
            'loved' => 'Ова мапа је додата у "loved" категорију :date!',
            'ranked' => 'Ова мапа је додата у "ranked" категорију :date!',
            'wip' => 'Белешка: Ова мапа је означена као рад у току од стране креатора.',
        ],

        'votes' => [
            'none' => [
                'down' => 'Тренутно нема дислајкова',
                'up' => 'Тренутно нема лајкова',
            ],
            'latest' => [
                'down' => 'Најновији дислајкови',
                'up' => 'Најновији лајкови',
            ],
        ],
    ],

    'hype' => [
        'button' => '"Хајпујте" Мапу!',
        'button_done' => 'Већ сте "Хајповали"!',
        'confirm' => "Да ли сте сигурни? Ова акција ће искористити једну од Ваших преосталих :n \"хајпова\" и не може бити поништено.",
        'explanation' => '"Хајпујте" ову мапу да би била видљивија за номинације и "ranked" статус!',
        'explanation_guest' => 'Улогујте се и "хајпујте" ову мапу да би била видљивија за номинације и "ranked" статус!',
        'new_time' => "Добићете још један \"хајп\" у :new_time.",
        'remaining' => 'Имате још :remaining "хајпова".',
        'required_text' => '"Хајп" :current/:required',
        'section_title' => '"Хајп" Воз',
        'title' => '"Хајп"',
    ],

    'feedback' => [
        'button' => 'Оставите Утиске',
    ],

    'nominations' => [
        'delete' => 'Обришите',
        'delete_own_confirm' => 'Да ли сте сигурни? Мапа ће бити обрисана и бићете враћени назад на Ваш профил.',
        'delete_other_confirm' => 'Да ли сте сигурни? Мапа ће бити обрисана и бићете враћени назад на профил корисника.',
        'disqualification_prompt' => 'Разлог за дисквалификацију?',
        'disqualified_at' => 'Дисквалификовано :time_ago (:reason).',
        'disqualified_no_reason' => 'без одређеног разлога',
        'disqualify' => 'Дисквалификујте',
        'incorrect_state' => 'Дошло је до грешке, покушајте да освежите страницу.',
        'love' => '"love"',
        'love_choose' => 'Изаберите тежину за "loved"',
        'love_confirm' => '"Love"-ујте ову мапу?',
        'nominate' => 'Номинујте',
        'nominate_confirm' => 'Номинујте ову мапу?',
        'nominated_by' => 'номиновано од стране :users',
        'not_enough_hype' => "Нема довољно \"хајпа\".",
        'remove_from_loved' => 'Уклоните из "loved"',
        'remove_from_loved_prompt' => 'Разлог за уклањање из "Лoved":',
        'required_text' => 'Номинације: :current/:required
',
        'reset_message_deleted' => 'обрисано',
        'title' => 'Статус Номинације',
        'unresolved_issues' => 'Још увек има нерешених проблема који се прво морају решити.',

        'rank_estimate' => [
            '_' => 'Процењује се да ће мапа бити померена у "ranked" секцију :date ако се не пронађу проблеми. Мапа је тренутно #:position у :queue.',
            'queue' => 'ред за "ranked" секцију',
            'soon' => 'ускоро',
        ],

        'reset_at' => [
            'nomination_reset' => 'Процес номинације је ресетован :time_ago од стране :user са новим проблемом :discussion (:message).',
            'disqualify' => 'Дисквалификовано :time_ago од стране :user са новим проблемом :discussion (:message).',
        ],

        'reset_confirm' => [
            'disqualify' => 'Да ли сте сигурни? Ово ће уклонити мапу из квалификација и рестартоваће процес номинације.',
            'nomination_reset' => 'Да ли сте сигурни? Качењем новог проблема се ресетује процес номинације.',
            'problem_warning' => 'Да ли сте сигурни да желите пријавити проблем са овом мапом? Ово акција ће обавестити Номинаторе Мапа.',
        ],
    ],

    'listing' => [
        'search' => [
            'prompt' => 'унесите кључну реч...',
            'login_required' => 'Улогујте се да би сте тражили.',
            'options' => 'Више опција за тражење',
            'supporter_filter' => 'Филтеровање по :filters захтева да имате активну osu!supporter претплату',
            'not-found' => 'нема резултата',
            'not-found-quote' => '... не, ништа нисмо нашли.',
            'filters' => [
                'extra' => 'Додаци',
                'general' => 'Опште',
                'genre' => 'Жанр',
                'language' => 'Језик',
                'mode' => 'Мод',
                'nsfw' => 'Експлицитни Садржај',
                'played' => 'Одиграно',
                'rank' => 'Достигнут ранк',
                'status' => 'Категорије',
            ],
            'sorting' => [
                'title' => 'Наслов',
                'artist' => 'Извођач',
                'difficulty' => 'Тежина',
                'favourites' => 'Омиљено',
                'updated' => 'Ажурирано',
                'ranked' => 'Ранковано',
                'rating' => 'Оцена',
                'plays' => 'Одиграно',
                'relevance' => 'Релевантност',
                'nominations' => 'Номинације',
            ],
            'supporter_filter_quote' => [
                '_' => 'Филтеровање по :filters захтева да имате активан :link',
                'link_text' => 'osu!supporter претплата',
            ],
        ],
    ],
    'general' => [
        'converts' => 'Укључујући конвертоване мапе',
        'featured_artists' => 'Истакнути уметници',
        'follows' => 'Креатори које пратите',
        'recommended' => 'Препоручена тежина',
        'spotlights' => 'Истакнуте мапе',
    ],
    'mode' => [
        'all' => 'Све',
        'any' => 'Било који',
        'osu' => '',
        'taiko' => '',
        'fruits' => '',
        'mania' => '',
    ],
    'status' => [
        'any' => 'Било који',
        'approved' => 'Одобрено',
        'favourites' => 'Омиљено',
        'graveyard' => 'Гробље',
        'leaderboard' => 'Има табелу',
        'loved' => '"loved"',
        'mine' => 'Моје Мапе',
        'pending' => 'На чекању',
        'wip' => 'Рад у току',
        'qualified' => 'Квалификовано',
        'ranked' => 'Рангирано',
    ],
    'genre' => [
        'any' => 'Било који',
        'unspecified' => 'Недефинисано',
        'video-game' => 'Видео игре',
        'anime' => 'Аниме',
        'rock' => 'Рок',
        'pop' => 'Поп',
        'other' => 'Остало',
        'novelty' => 'Оригинално',
        'hip-hop' => 'Хип Хоп',
        'electronic' => 'Електроника',
        'metal' => 'Метал',
        'classical' => 'Класика',
        'folk' => 'Фолк',
        'jazz' => 'Џез',
    ],
    'language' => [
        'any' => 'Било који',
        'english' => 'Енглески',
        'chinese' => 'Кинески',
        'french' => 'Француски',
        'german' => 'Немачки',
        'italian' => 'Италијански',
        'japanese' => 'Јапански',
        'korean' => 'Корејски',
        'spanish' => 'Шпански',
        'swedish' => 'Шведски',
        'russian' => 'Руски',
        'polish' => 'Пољски',
        'instrumental' => 'Инструментал',
        'other' => 'Остало',
        'unspecified' => 'Недефинисано',
    ],

    'nsfw' => [
        'exclude' => 'Сакријте',
        'include' => 'Прикажите',
    ],

    'played' => [
        'any' => 'Било који',
        'played' => 'Одиграно',
        'unplayed' => 'Неиграно',
    ],
    'extra' => [
        'video' => 'Има Видео',
        'storyboard' => 'Има "Storyboard"',
    ],
    'rank' => [
        'any' => 'Било који',
        'XH' => 'Сребрни СС',
        'X' => '',
        'SH' => 'Сребрни С',
        'S' => '',
        'A' => '',
        'B' => '',
        'C' => '',
        'D' => '',
    ],
    'panel' => [
        'playcount' => 'Број игара: :count',
        'favourites' => 'Фаворити: :count',
    ],
    'variant' => [
        'mania' => [
            '4k' => '4K',
            '7k' => '7K',
            'all' => 'Све',
        ],
    ],
];
