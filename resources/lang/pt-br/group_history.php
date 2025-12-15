<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'none' => 'Nenhum histórico do grupo encontrado!',
    'view' => 'Visualizar histórico do grupo',

    'event' => [
        'actor' => 'por :user',

        'message' => [
            'group_add' => ':group criado.',
            'group_remove' => ':group deletado.',
            'group_rename' => ':previous_group foi renomeado para :group.',
            'user_add' => ':user adicionado ao :group.',
            'user_add_with_playmodes' => ':user adicionado ao :group para :rulesets.',
            'user_add_playmodes' => ':rulesets foi adicionado ao cargo de :user, do :group.',
            'user_remove' => ':user foi removido do :group.',
            'user_remove_playmodes' => ':rulesets foi removido do cargo de :user, do :group.',
            'user_set_default' => 'O grupo padrão de :user foi definido para :group.',
        ],
    ],

    'form' => [
        'group' => 'Grupo',
        'group_all' => 'Todos os grupos',
        'max_date' => 'Para',
        'min_date' => 'De',
        'user' => 'Usuário',
        'user_prompt' => 'Usuário ou ID',
    ],

    'staff_log' => [
        '_' => 'O histórico de grupo antigo pode ser encontrado em :wiki_articles.',
        'wiki_articles' => 'histórico dos artigos da staff na wiki',
    ],
];
