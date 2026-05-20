<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'none' => 'Ingen grupphistorik hittades!',
    'view' => 'Visa grupp historik',

    'event' => [
        'actor' => 'av :user',

        'message' => [
            'group_add' => ':group skapad.',
            'group_remove' => ':group borttagen.',
            'group_rename' => ':previous_group bytte namn till :group.',
            'user_add' => ':user tillagd i :group.',
            'user_add_with_playmodes' => ':user har lagts till :group för :rulesets.',
            'user_add_playmodes' => ':rulesets har lagts till :user :group medlemskap.',
            'user_remove' => ':user borttagen från :group.',
            'user_remove_playmodes' => ':rulesets borttagen från :user :group medlemskap.',
            'user_set_default' => ':user standardgrupp satt till :group.',
        ],
    ],

    'form' => [
        'group' => 'Grupp',
        'group_all' => 'Alla grupper',
        'max_date' => 'Till',
        'min_date' => 'Från',
        'user' => 'Användare',
        'user_prompt' => 'Användarnamn eller ID',
    ],

    'staff_log' => [
        '_' => 'Äldre grupphistorik finns i :wiki_articles.',
        'wiki_articles' => 'personal logg wiki artiklar',
    ],
];
