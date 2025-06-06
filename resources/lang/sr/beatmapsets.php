<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'availability' => [
        'disabled' => 'Ова мапа није тренутно доступна за преузимање.',
        'parts-removed' => 'Делови ове беатмапе су уклоњени на захтев власника или трећег носиоца права.
',
        'more-info' => 'Кликни овде за више информација.',
        'rule_violation' => 'Нека средства садржана у овој мапи су уклоњена након што су сматрана неприкладним за употребу у osu!.',
    ],

    'cover' => [
        'deleted' => 'Обрисана мапа',
    ],

    'download' => [
        'limit_exceeded' => 'Успорите, играјте више.',
        'no_mirrors' => '',
    ],

    'featured_artist_badge' => [
        'label' => 'Истакнут уметник',
    ],

    'index' => [
        'title' => 'Листинг мапа',
        'guest_title' => 'Мапе',
    ],

    'panel' => [
        'empty' => 'нема мапе',

        'download' => [
            'all' => 'преузмите',
            'video' => 'преузмите са видеом',
            'no_video' => 'преузмите без видеа',
            'direct' => 'отвори у osu!direct',
        ],
    ],

    'nominate' => [
        'bng_limited_too_many_rulesets' => '',
        'full_nomination_required' => '',
        'hybrid_requires_modes' => 'Хибридне мапе захтевају да изаберете најмање један режим играња за номинацију.',
        'incorrect_mode' => 'Немате дозволу да номинујете за mode :mode',
        'invalid_limited_nomination' => '',
        'invalid_ruleset' => '',
        'too_many' => 'Услов за номинацију је већ испуњен.',
        'too_many_non_main_ruleset' => '',

        'dialog' => [
            'confirmation' => 'Да ли сте сигурни да желите да номинујете ову мапу?',
            'different_nominator_warning' => '',
            'header' => 'Номинујте ову мапу',
            'hybrid_warning' => 'напомена: можете номиновати само једном, па вас молимо да се уверите да номинујете за све модове игре које намеравате да играте',
            'current_main_ruleset' => '',
            'which_modes' => 'Номинирај за које модове?',
        ],
    ],

    'nsfw_badge' => [
        'label' => 'Експлицитно',
    ],

    'show' => [
        'discussion' => 'Дискусија',

        'admin' => [
            'full_size_cover' => '',
        ],

        'deleted_banner' => [
            'title' => 'Ова мапа је избрисана.',
            'message' => '(ово могу да виде само модератори)',
        ],

        'details' => [
            'by_artist' => 'од :artist',
            'favourite' => 'означите ову мапу као омиљену',
            'favourite_login' => 'пријави се како би означили мапу као омиљену',
            'logged-out' => 'мораш се пријавити пре преузимања било које мапе!',
            'mapped_by' => 'маповано од стране :mapper',
            'mapped_by_guest' => 'гост тешкоће од :mapper',
            'unfavourite' => 'уклони мапу са ознаке омиљено',
            'updated_timeago' => 'последњи пут ажурирано :timeago',

            'download' => [
                '_' => 'Преузми',
                'direct' => '',
                'no-video' => 'без Видеа',
                'video' => 'са Видеом',
            ],

            'login_required' => [
                'bottom' => 'за приступ више функције',
                'top' => 'Пријава',
            ],
        ],

        'details_date' => [
            'approved' => 'одобрено :timeago',
            'loved' => 'loved :timeago',
            'qualified' => 'квалификовано :timeago',
            'ranked' => 'рангирано :timeago',
            'submitted' => 'постављено :timeago',
            'updated' => 'последњи пут ажуриран :timeago',
        ],

        'favourites' => [
            'limit_reached' => 'Имате превише омиљених мапа! Молимо уклоните неке од њих пре него што покушате поново.',
        ],

        'hype' => [
            'action' => 'Хајпујте ову мапу ако сте уживали играјући је и да им помогнете да напредује до статуса <strong>Рангирана</strong>.',

            'current' => [
                '_' => 'Ова мапа је тренутно :status.',

                'status' => [
                    'pending' => 'на чекању',
                    'qualified' => 'квалификовано',
                    'wip' => 'рад у току',
                ],
            ],

            'disqualify' => [
                '_' => 'Ако нађете проблем са овом мапом, молимо дисквалификујте их :link.',
            ],

            'report' => [
                '_' => 'Ако нађете проблем са овом мапом, пријавите :link да упозорите тим.',
                'button' => 'Пријавите Проблем',
                'link' => 'овде',
            ],
        ],

        'info' => [
            'description' => 'Опис',
            'genre' => 'Жанр',
            'language' => 'Језик',
            'mapper_tags' => '',
            'no_scores' => 'Подаци се још израчунавају...',
            'nominators' => 'Номинатори',
            'nsfw' => 'Експлицитни садржај',
            'offset' => 'Онлајн офсет',
            'points-of-failure' => 'Тачке Неуспеха',
            'source' => 'Извор',
            'storyboard' => 'Ова мапа садржи storyboard',
            'success-rate' => 'Стопа Успеха',
            'user_tags' => '',
            'video' => 'Ова мапа садржи видео',
        ],

        'nsfw_warning' => [
            'details' => 'Ова мапа садржи експлицитан, увредљив или узнемирујући садржај. Желите ли га ипак погледати?',
            'title' => 'Експлицитни Садржај',

            'buttons' => [
                'disable' => 'Онемогући упозорење',
                'listing' => 'Листинг мапа',
                'show' => 'Прикажи',
            ],
        ],

        'scoreboard' => [
            'achieved' => 'постигнуто :when',
            'country' => 'Државни Ранг',
            'error' => 'Неуспешно учитавање рангирања',
            'friend' => 'Ранг Пријатеља',
            'global' => 'Глобални Ранг',
            'supporter-link' => 'Кликните <a href=":link">овде</a> да видите све фенси функције које добијате!',
            'supporter-only' => 'Мораш бити osu!supporter да приступите рангирању специфичним за пријатеље, државу или мод!',
            'team' => '',
            'title' => 'Scoreboard',

            'headers' => [
                'accuracy' => 'Прецизност',
                'combo' => 'Макс Комбо',
                'miss' => 'Грешке',
                'mods' => 'Модови',
                'pin' => 'Закачи',
                'player' => 'Играч',
                'pp' => '',
                'rank' => 'Ранг',
                'score' => 'Резултат',
                'score_total' => 'Укупан Резултат',
                'time' => 'Време',
            ],

            'no_scores' => [
                'country' => 'Нико из твоје државе још није поставио резултат на овој мапи!',
                'friend' => 'Нико од твојих пријатеља још није поставио резултат на овој мапи!',
                'global' => 'Још нема резултата. Можда би требало да покушате да поставите неке?',
                'loading' => 'Учитавање резултата...',
                'team' => '',
                'unranked' => 'Нерангиране мапе.',
            ],
            'score' => [
                'first' => 'У вођству',
                'own' => 'Твој Рекорд',
            ],
            'supporter_link' => [
                '_' => 'Кликните :here да видите све фенси функције које добијате!',
                'here' => 'овде',
            ],
        ],

        'stats' => [
            'cs' => 'Величина Кругова',
            'cs-mania' => 'Број типки',
            'drain' => 'HP Трошак',
            'accuracy' => 'Прецизност',
            'ar' => 'Стопа Приближавања',
            'stars' => 'Оцена Тежине',
            'total_length' => 'Дужина (Дужина одвода: :hit_length)',
            'bpm' => 'BPM',
            'count_circles' => 'Број Кругова',
            'count_sliders' => 'Број Слајдера',
            'offset' => 'Онлајн офсет: :offset',
            'user-rating' => 'Корисничка Оцена',
            'rating-spread' => 'Ширење Оцена',
            'nominations' => 'Номинације',
            'playcount' => 'Број играња',
        ],

        'status' => [
            'ranked' => 'Рангирано',
            'approved' => 'Одобрено',
            'loved' => 'Loved',
            'qualified' => 'Квалификован',
            'wip' => 'Рад у току',
            'pending' => 'На чекању',
            'graveyard' => 'Запуштено',
        ],
    ],

    'spotlight_badge' => [
        'label' => 'Истакнуто',
    ],
];
