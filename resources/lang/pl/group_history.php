<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'none' => 'Nie znaleziono żadnych zdarzeń w historii grupy!',
    'view' => 'Wyświetl historię grupy',

    'event' => [
        'actor' => 'przez :user',

        'message' => [
            'group_add' => ':group została stworzona.',
            'group_remove' => ':group została usunięta.',
            'group_rename' => ':previous_group zmieniła nazwę na :group.',
            'user_add' => ':user został dodany do :group.',
            'user_add_with_playmodes' => ':user został dodany do :group dla :rulesets.',
            'user_add_playmodes' => ':rulesets dodano do członkostwa :user w grupie :group.',
            'user_remove' => ':user został usunięty z :group.',
            'user_remove_playmodes' => ':rulesets usunięte od członkostwa :user w grupie :group.',
            'user_set_default' => 'Domyślna grupa :user została ustawiona na :group.',
        ],
    ],

    'form' => [
        'group' => 'Grupa',
        'group_all' => 'Wszystkie grupy',
        'max_date' => 'Do',
        'min_date' => 'Od',
        'user' => 'Użytkownik',
        'user_prompt' => 'Nazwa lub ID użytkownika',
    ],

    'staff_log' => [
        '_' => 'Wcześniejsze zmiany w grupach są udokumentowane w :wiki_articles.',
        'wiki_articles' => 'artykułach na wiki',
    ],
];
