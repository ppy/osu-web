<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'none' => 'No group history found!',

    'event' => [
        'actor' => 'by :user',

        'message' => [
            'group_add' => ':group created.',
            'group_remove' => ':group deleted.',
            'group_rename' => ':previous_group renamed to :group.',
            'user_add' => ':user added to :group.',
            'user_add_with_playmodes' => ':user added to :group for :playmodes.',
            'user_add_playmodes' => ':playmodes added to :user\'s :group membership.',
            'user_remove' => ':user removed from :group.',
            'user_remove_playmodes' => ':playmodes removed from :user\'s :group membership.',
            'user_set_default' => ':user\'s default group set to :group.',
        ],
    ],

    'form' => [
        'after' => 'After',
        'before' => 'Before',
        'group' => 'Group',
        'group_all' => 'All groups',
        'user' => 'User',
        'user_prompt' => 'Username or ID',
    ],

    'staff_log' => [
        '_' => 'Older group history can be found in :wiki_articles.',
        'wiki_articles' => 'the staff log wiki articles',
    ],
];
