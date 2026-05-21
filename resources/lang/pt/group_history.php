<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'none' => 'Não foi encontrado nenhum histórico de grupo!',
    'view' => 'Ver o histórico do grupo',

    'event' => [
        'actor' => 'por :user',

        'message' => [
            'group_add' => ':group criado.',
            'group_remove' => ':group eliminado.',
            'group_rename' => ':previous_group mudou de nome para :group.',
            'user_add' => ':user adicionado a :group.',
            'user_add_with_playmodes' => ':user adicionado a :group para :rulesets.',
            'user_add_playmodes' => ':rulesets adicionados à posse de :user no grupo :group.',
            'user_remove' => ':user removido de :group.',
            'user_remove_playmodes' => ':rulesets removidos da posse de :user no grupo :group.',
            'user_set_default' => 'o grupo predefinido de :user foi definido como :group.',
        ],
    ],

    'form' => [
        'group' => 'Grupo',
        'group_all' => 'Todos os grupos',
        'max_date' => 'Para',
        'min_date' => 'De',
        'user' => 'Utilizador',
        'user_prompt' => 'Nome de utilizador ou ID',
    ],

    'staff_log' => [
        '_' => 'O histórico de grupo mais antigo pode ser encontrado em :wiki_articles.',
        'wiki_articles' => 'os artigos da wiki do registo da equipa de pessoal',
    ],
];
