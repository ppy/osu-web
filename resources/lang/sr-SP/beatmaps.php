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
        'guest' => '',
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
            'timeline' => '',
            'updated_at' => '',
        ],

        'stats' => [
            'deleted' => '',
            'mapper_notes' => '',
            'mine' => '',
            'pending' => '',
            'praises' => '',
            'resolved' => '',
            'total' => '',
        ],

        'status-messages' => [
            'approved' => '',
            'graveyard' => "",
            'loved' => '',
            'ranked' => '',
            'wip' => '',
        ],

        'votes' => [
            'none' => [
                'down' => '',
                'up' => '',
            ],
            'latest' => [
                'down' => '',
                'up' => '',
            ],
        ],
    ],

    'hype' => [
        'button' => '',
        'button_done' => '',
        'confirm' => "",
        'explanation' => '',
        'explanation_guest' => '',
        'new_time' => "",
        'remaining' => '',
        'required_text' => '',
        'section_title' => '',
        'title' => '',
    ],

    'feedback' => [
        'button' => '',
    ],

    'nominations' => [
        'delete' => '',
        'delete_own_confirm' => '',
        'delete_other_confirm' => '',
        'disqualification_prompt' => '',
        'disqualified_at' => '',
        'disqualified_no_reason' => '',
        'disqualify' => '',
        'incorrect_state' => '',
        'love' => '',
        'love_choose' => '',
        'love_confirm' => '',
        'nominate' => '',
        'nominate_confirm' => '',
        'nominated_by' => '',
        'not_enough_hype' => "",
        'remove_from_loved' => '',
        'remove_from_loved_prompt' => '',
        'required_text' => '',
        'reset_message_deleted' => '',
        'title' => '',
        'unresolved_issues' => '',

        'rank_estimate' => [
            '_' => '',
            'queue' => '',
            'soon' => '',
        ],

        'reset_at' => [
            'nomination_reset' => '',
            'disqualify' => '',
        ],

        'reset_confirm' => [
            'nomination_reset' => '',
            'disqualify' => '',
        ],
    ],

    'listing' => [
        'search' => [
            'prompt' => '',
            'login_required' => '',
            'options' => '',
            'supporter_filter' => '',
            'not-found' => '',
            'not-found-quote' => '',
            'filters' => [
                'extra' => '',
                'general' => '',
                'genre' => '',
                'language' => '',
                'mode' => '',
                'nsfw' => '',
                'played' => '',
                'rank' => '',
                'status' => '',
            ],
            'sorting' => [
                'title' => '',
                'artist' => '',
                'difficulty' => '',
                'favourites' => '',
                'updated' => '',
                'ranked' => '',
                'rating' => '',
                'plays' => '',
                'relevance' => '',
                'nominations' => '',
            ],
            'supporter_filter_quote' => [
                '_' => '',
                'link_text' => '',
            ],
        ],
    ],
    'general' => [
        'converts' => '',
        'featured_artists' => '',
        'follows' => '',
        'recommended' => '',
    ],
    'mode' => [
        'all' => '',
        'any' => '',
        'osu' => '',
        'taiko' => '',
        'fruits' => '',
        'mania' => '',
    ],
    'status' => [
        'any' => '',
        'approved' => '',
        'favourites' => '',
        'graveyard' => '',
        'leaderboard' => '',
        'loved' => '',
        'mine' => '',
        'pending' => '',
        'qualified' => '',
        'ranked' => '',
    ],
    'genre' => [
        'any' => '',
        'unspecified' => '',
        'video-game' => '',
        'anime' => '',
        'rock' => '',
        'pop' => '',
        'other' => '',
        'novelty' => '',
        'hip-hop' => '',
        'electronic' => '',
        'metal' => '',
        'classical' => '',
        'folk' => '',
        'jazz' => '',
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
        'MR' => '',
        'NC' => '',
        'NF' => '',
        'NM' => '',
        'PF' => '',
        'RX' => '',
        'SD' => '',
        'SO' => '',
        'TD' => '',
        'V2' => '',
    ],
    'language' => [
        'any' => '',
        'english' => '',
        'chinese' => '',
        'french' => '',
        'german' => '',
        'italian' => '',
        'japanese' => '',
        'korean' => '',
        'spanish' => '',
        'swedish' => '',
        'russian' => '',
        'polish' => '',
        'instrumental' => '',
        'other' => '',
        'unspecified' => '',
    ],

    'nsfw' => [
        'exclude' => '',
        'include' => '',
    ],

    'played' => [
        'any' => '',
        'played' => '',
        'unplayed' => '',
    ],
    'extra' => [
        'video' => '',
        'storyboard' => '',
    ],
    'rank' => [
        'any' => '',
        'XH' => '',
        'X' => '',
        'SH' => '',
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
    'variant' => [
        'mania' => [
            '4k' => '',
            '7k' => '',
            'all' => '',
        ],
    ],
];
