<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'none' => '¡No se ha encontrado nada en el historial de grupos!',
    'view' => 'Ver historial del grupo',

    'event' => [
        'actor' => 'por :user',

        'message' => [
            'group_add' => ':group creado.',
            'group_remove' => ':group eliminado.',
            'group_rename' => ':previous_group fue renombrado a :group.',
            'user_add' => ':user fue añadido a :group.',
            'user_add_with_playmodes' => ':user fue añadido a :group de :rulesets.',
            'user_add_playmodes' => ':rulesets fue añadido a la membresía de :group de :user.',
            'user_remove' => ':user fue retirado de :group.',
            'user_remove_playmodes' => ':rulesets fue retirado de la membresía de :group de :user.',
            'user_set_default' => 'Grupo predeterminado de :user establecido a :group.',
        ],
    ],

    'form' => [
        'group' => 'Grupo',
        'group_all' => 'Todos los grupos',
        'max_date' => 'Hasta',
        'min_date' => 'Desde',
        'user' => 'Usuario',
        'user_prompt' => 'Nombre de usuario o ID',
    ],

    'staff_log' => [
        '_' => 'Los historiales más antiguos de los grupos se pueden encontrar en :wiki_articles.',
        'wiki_articles' => 'los artículos del registro del personal de la wiki',
    ],
];
