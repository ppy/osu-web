<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'none' => 'L\'historial del grup no s\'ha trobat!',
    'view' => 'Mostra l\'historial del grup',

    'event' => [
        'actor' => 'de :user',

        'message' => [
            'group_add' => 'S\'ha creat el grup :group.',
            'group_remove' => 'S\'ha esborrat el grup :group.',
            'group_rename' => 'S\'ha canviat el nom de :previous_group a :group.',
            'user_add' => 'S\'ha afegit l\'usuari :user al grup :group.',
            'user_add_with_playmodes' => 'L\'usuari :user s\'ha afegit a :group de :rulesets.',
            'user_add_playmodes' => 'S\'ha afegit :rulesets al grup :group de :user.',
            'user_remove' => 'L\'usuari :user s\'ha tret del grup :group.',
            'user_remove_playmodes' => 'S\'ha tret :rulesets del grup :group de :user.',
            'user_set_default' => 'El grup per defecte de l\'usuari :user s\'ha canviat a :group.',
        ],
    ],

    'form' => [
        'group' => 'Grup',
        'group_all' => 'Tots els grups',
        'max_date' => 'A',
        'min_date' => 'De',
        'user' => 'Usuari',
        'user_prompt' => 'Nom d\'usuari o ID',
    ],

    'staff_log' => [
        '_' => 'Els historials més antics del grup es poden trobar a :wiki_articles.',
        'wiki_articles' => 'els articles wiki del registre de personal',
    ],
];
