<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'none' => 'Aucun historique de groupe trouvé !',
    'view' => 'Afficher l\'historique du groupe',

    'event' => [
        'actor' => 'par :user',

        'message' => [
            'group_add' => ':group créé.',
            'group_remove' => ':group supprimé.',
            'group_rename' => 'Le groupe :previous_group a été renommé en :group.',
            'user_add' => ':user a été ajouté au groupe :group.',
            'user_add_with_playmodes' => ':user a été ajouté au groupe :group pour le mode :rulesets.',
            'user_add_playmodes' => 'Le mode :rulesets a été ajouté au groupe :group pour :user.',
            'user_remove' => ':user a été retiré du groupe :group.',
            'user_remove_playmodes' => 'Le mode :rulesets a été retiré du groupe :group pour :user.',
            'user_set_default' => 'Le groupe par défaut de :user a été défini sur :group.',
        ],
    ],

    'form' => [
        'group' => 'Groupe',
        'group_all' => 'Tous les groupes',
        'max_date' => 'À',
        'min_date' => 'Du',
        'user' => 'Utilisateur',
        'user_prompt' => 'Nom d\'utilisateur ou ID',
    ],

    'staff_log' => [
        '_' => 'L\'ancien historique des groupes peut être trouvé dans :wiki_articles.',
        'wiki_articles' => 'les articles du wiki le concernant',
    ],
];
