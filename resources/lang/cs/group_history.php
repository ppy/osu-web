<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'none' => 'Nenalezena žádná historie skupin!',
    'view' => 'Zobrazit historii skupin',

    'event' => [
        'actor' => 'uživatelem :user',

        'message' => [
            'group_add' => ':group vytvořena.',
            'group_remove' => ':group smazána.',
            'group_rename' => ':previous_group byla přejmenována na :group.',
            'user_add' => ':user byl přidán do :group.',
            'user_add_with_playmodes' => ':user byl přidán do :group pro :rulesets.',
            'user_add_playmodes' => ':rulesets přidáno k členství uživatele :user ve skupině :group.',
            'user_remove' => ':user byl odebrán z :group.',
            'user_remove_playmodes' => ':rulesets odebráno z členství uživatele :user ve skupině :group.',
            'user_set_default' => 'Výchozí skupina uživatele :user byla nastavena na :group.',
        ],
    ],

    'form' => [
        'group' => 'Skupina',
        'group_all' => 'Všechny skupiny',
        'max_date' => 'Do',
        'min_date' => 'Od',
        'user' => 'Uživatel',
        'user_prompt' => 'Uživatelské jméno nebo ID',
    ],

    'staff_log' => [
        '_' => 'Starší historii skupin lze nalézt ve :wiki_articles.',
        'wiki_articles' => 'wiki článcích záznamů o změnách kolektivu',
    ],
];
