<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'none' => 'Nincsen csoport előzmény található!',
    'view' => 'Csoport Előzmények Megtekintése',

    'event' => [
        'actor' => ':user által',

        'message' => [
            'group_add' => ':group létrehozva.',
            'group_remove' => ':group törölve.',
            'group_rename' => ':previous_group átnevezve erre :group.',
            'user_add' => ':user hozzáadva a(z) :group csoporthoz.',
            'user_add_with_playmodes' => ':user hozzáadva a(z) :group csoporthoz ezért :rulesets.',
            'user_add_playmodes' => ':rulesets hozzáadva :user felhasználónak :group tagságához.',
            'user_remove' => ':user eltávolítva a(z) :group csoportból.',
            'user_remove_playmodes' => ':rulesets eltávolítva :user felhasználótól :group tagságától.',
            'user_set_default' => ':user beállíttotta az alapértmezett csoportot erre: :group.',
        ],
    ],

    'form' => [
        'group' => 'Csoport',
        'group_all' => 'Összes csoport',
        'max_date' => 'Címzett',
        'min_date' => 'Feladó',
        'user' => 'Felhasználó',
        'user_prompt' => 'Felhasználónév vagy ID',
    ],

    'staff_log' => [
        '_' => 'A csoport korábbi történetéről :wiki_articles oldalon olvashat.',
        'wiki_articles' => 'a személyzeti napló wiki-cikkei',
    ],
];
