<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'none' => 'Nessuno storico di gruppo trovato!',
    'view' => 'Vedi storico del gruppo',

    'event' => [
        'actor' => 'per :user',

        'message' => [
            'group_add' => ':group creato.',
            'group_remove' => ':group eliminato.',
            'group_rename' => ':previous_group rinominato in :group.',
            'user_add' => ':user aggiunto a :group.',
            'user_add_with_playmodes' => ':user aggiunto a :group per :rulesets.',
            'user_add_playmodes' => '',
            'user_remove' => ':user rimosso da :group.',
            'user_remove_playmodes' => '',
            'user_set_default' => 'Gruppo predefinito di :user impostato a :group.',
        ],
    ],

    'form' => [
        'group' => 'Gruppo',
        'group_all' => 'Tutti i gruppi',
        'max_date' => 'Al',
        'min_date' => 'Dal',
        'user' => 'Utente',
        'user_prompt' => 'Nome utente o ID',
    ],

    'staff_log' => [
        '_' => 'Le cronologie di gruppo più vecchie possono essere trovate negli :wiki_articles.',
        'wiki_articles' => 'articoli della wiki sui registri dello staff',
    ],
];
