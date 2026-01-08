<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'none' => 'История группы не найдена!',
    'view' => 'Открыть историю группы',

    'event' => [
        'actor' => 'пользователем :user',

        'message' => [
            'group_add' => 'Группа :group создана.',
            'group_remove' => 'Группа :group удалена.',
            'group_rename' => 'Группа :previous_group переименована в :group.',
            'user_add' => ':user добавлен в :group.',
            'user_add_with_playmodes' => ':user добавлен в :group по режиму игры :rulesets.',
            'user_add_playmodes' => 'Участнику :user группы :group назначен режим игры :rulesets.',
            'user_remove' => ':user исключён из :group.',
            'user_remove_playmodes' => 'Участнику :user группы :group снят режим игры :rulesets.',
            'user_set_default' => ':group установлена основной для :user.',
        ],
    ],

    'form' => [
        'group' => 'Группа',
        'group_all' => 'Все группы',
        'max_date' => 'От',
        'min_date' => 'До',
        'user' => 'Пользователь',
        'user_prompt' => 'Никнейм или ID',
    ],

    'staff_log' => [
        '_' => 'Более раннюю историю групп можно изучить в :wiki_articles.',
        'wiki_articles' => 'статье вики об истории команд osu!',
    ],
];
