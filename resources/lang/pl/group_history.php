<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'none' => 'Nie znaleziono żadnych zdarzeń w historii grupy!',
    'view' => 'Wyświetl historię grupy',

    'event' => [
        'actor' => 'przez :user',

        'message' => [
            'group_add' => 'Utworzono grupę :group.',
            'group_remove' => 'Usunięto grupę :group.',
            'group_rename' => 'Zmieniono nazwę grupy z :previous_group na :group.',
            'user_add' => 'Dodano użytkownika :user do grupy :group.',
            'user_add_with_playmodes' => 'Dodano użytkownika :user do grupy :group (:rulesets).',
            'user_add_playmodes' => 'Rozszerzono członkostwo użytkownika :user w grupie :group o :rulesets.',
            'user_remove' => 'Usunięto użytkownika :user z grupy :group.',
            'user_remove_playmodes' => 'Ograniczono członkostwo użytkownika :user w grupie :group o :rulesets.',
            'user_set_default' => 'Ustawiono domyślną grupę użytkownika :user na :group.',
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
