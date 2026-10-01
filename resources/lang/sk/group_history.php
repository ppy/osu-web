<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'none' => 'Nenašla sa žiadna história skupiny!',
    'view' => 'Zobraziť históriu skupiny',

    'event' => [
        'actor' => 'od :user',

        'message' => [
            'group_add' => ':group vytvorená.',
            'group_remove' => ':group vymazaná.',
            'group_rename' => ':previous_group bola premenovaná na :group.',
            'user_add' => ':user bol pridaný do :group.',
            'user_add_with_playmodes' => ':user bol pridaný do :group pre :rulesets.',
            'user_add_playmodes' => 'Do skupiny :group používateľa :user bolo pridané :rulesets.',
            'user_remove' => ':user bol odstránený z :group.',
            'user_remove_playmodes' => 'Zo skupiny :group používateľa :user bolo odstránené :rulesets.',
            'user_set_default' => 'Predvolená skupina používateľa :user bola zmenená na :group.',
        ],
    ],

    'form' => [
        'group' => 'Skupina',
        'group_all' => 'Všetky skupiny',
        'max_date' => 'Do',
        'min_date' => 'Od',
        'user' => 'Používateľ',
        'user_prompt' => 'Používateľské meno alebo ID',
    ],

    'staff_log' => [
        '_' => 'Staršiu históriu skupiny môžeš nájsť v :wiki_articles.',
        'wiki_articles' => 'wiki artikle',
    ],
];
