<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'none' => 'Історію команди не знайдено!',
    'view' => 'Переглянути історію команди',

    'event' => [
        'actor' => 'за користувачем :user',

        'message' => [
            'group_add' => ':group створено.',
            'group_remove' => ':group видалено.',
            'group_rename' => ':previous_group перейменовано на :group.',
            'user_add' => ':user додано до :group.',
            'user_add_with_playmodes' => ':user додано до :group (:rulesets).',
            'user_add_playmodes' => ' :user з команди :group призначено режим :rulesets.',
            'user_remove' => ':user видалено з :group.',
            'user_remove_playmodes' => ' :user з команди :group знято режим :rulesets.',
            'user_set_default' => ':group встановлена як основна команда для :user.',
        ],
    ],

    'form' => [
        'group' => 'Команда',
        'group_all' => 'Усі команди',
        'max_date' => 'Від',
        'min_date' => 'До',
        'user' => 'Користувач',
        'user_prompt' => 'Ім\'я користувача або ID',
    ],

    'staff_log' => [
        '_' => 'Ранню історію команд можна дослідити на :wiki_articles.',
        'wiki_articles' => 'відповідній сторінці вікі',
    ],
];
