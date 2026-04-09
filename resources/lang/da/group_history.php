<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'none' => 'Ingen gruppe historik fundet!',
    'view' => 'Vis gruppens historik',

    'event' => [
        'actor' => 'af :user',

        'message' => [
            'group_add' => ':group oprettet.',
            'group_remove' => ':group slettet.',
            'group_rename' => ':previous_group omdøbt til :group.',
            'user_add' => ':user tilføjet til :group.',
            'user_add_with_playmodes' => ':user tilføjet til :group for :rulesets.',
            'user_add_playmodes' => ':rulesets tilføjet til :user\'s :group medlemskab.',
            'user_remove' => ':user fjernet fra :group.',
            'user_remove_playmodes' => ':rulesets fjernet fra :user\'s :group medlemskab.',
            'user_set_default' => ':user\'s standard gruppe indstillet til :group.',
        ],
    ],

    'form' => [
        'group' => 'Gruppe',
        'group_all' => 'Alle grupper',
        'max_date' => 'Til',
        'min_date' => 'Fra',
        'user' => 'Bruger',
        'user_prompt' => 'Brugernavn eller ID',
    ],

    'staff_log' => [
        '_' => 'Ældre gruppe historik kan findes i :wiki_articles.',
        'wiki_articles' => 'wiki-artikler om personale-loggen',
    ],
];
