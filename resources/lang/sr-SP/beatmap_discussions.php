<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'authorizations' => [
        'update' => [
            'null_user' => 'Морате бити пријављени да би сте могли да едитујете.',
            'system_generated' => 'Аутоматски генерисани постови не могу бити измењени.',
            'wrong_user' => 'Да би сте изменили пост морате бити власник.',
        ],
    ],

    'events' => [
        'empty' => 'Ништа се не дешава... за сад.',
    ],

    'index' => [
        'deleted_beatmap' => 'обрисано',
        'none_found' => 'Не постоји дискусија која одговара Вашем критеријуму.',
        'title' => 'Дискусије за мапе',

        'form' => [
            '_' => 'Претрага',
            'deleted' => 'Укључујући обрисане дискусије',
            'mode' => '',
            'only_unresolved' => 'Покажи само нерешене дискусије',
            'types' => 'Врсте порука',
            'username' => 'Корисничко име',

            'beatmapset_status' => [
                '_' => 'Статус мапе',
                'all' => 'Све',
                'disqualified' => 'Дисквалификовани',
                'never_qualified' => 'Никад квалификовано',
                'qualified' => 'Квалификовано',
                'ranked' => 'Ранковано',
            ],

            'user' => [
                'label' => 'Корисник',
                'overview' => 'Преглед активности',
            ],
        ],
    ],

    'item' => [
        'created_at' => 'Датум Објаве',
        'deleted_at' => 'Датум брисања',
        'message_type' => 'Врста',
        'permalink' => 'Пермалинк',
    ],

    'nearby_posts' => [
        'confirm' => 'Ниједан од постова не одговара мојим бригама',
        'notice' => 'Већ постоје постови око :timestamp (:existing_timestamps). Молимо Вас проверите их пре него што постујете.',
        'unsaved' => ':count у овој ревизији',
    ],

    'owner_editor' => [
        'button' => '',
        'reset_confirm' => '',
        'user' => '',
        'version' => '',
    ],

    'reply' => [
        'open' => [
            'guest' => 'Пријавите се да би сте одговорили',
            'user' => 'Одговори',
        ],
    ],

    'review' => [
        'block_count' => ':used / :max блокова искоришћено',
        'go_to_parent' => 'Погледајте ревизију поста',
        'go_to_child' => 'Прегледајте Дискусију',
        'validation' => [
            'block_too_large' => 'сваки блок може садржати чак до :limit карактера',
            'external_references' => 'ревизија садржи референце које припадају проблемима које не припадају овој ревизији',
            'invalid_block_type' => 'неважећа врста блока',
            'invalid_document' => 'неважећа ревизија',
            'invalid_discussion_type' => '',
            'minimum_issues' => 'ревизија мора садржати минимално :count проблем|ревизија мора садржати минимум од :count проблема',
            'missing_text' => 'блок нема текст',
            'too_many_blocks' => 'ревизије могу садржати само :count параграф/проблем|ревизије могу садржати само :count параграфа/проблема',
        ],
    ],

    'system' => [
        'resolved' => [
            'true' => 'Означено као завршено од стране :user',
            'false' => 'Поново отворено од стране :user',
        ],
    ],

    'timestamp_display' => [
        'general' => 'опште',
        'general_all' => 'опште (све)',
    ],

    'user_filter' => [
        'everyone' => 'Сви',
        'label' => 'Филтрирај по кориснику',
    ],
];
