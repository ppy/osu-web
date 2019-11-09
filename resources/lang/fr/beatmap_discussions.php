<?php

/**
 *    Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
 *    See the LICENCE file in the repository root for full licence text.
 */

return [
    'authorizations' => [
        'update' => [
            'null_user' => 'Vous devez être connecté pour éditer.',
            'system_generated' => 'Un post généré par le système ne peut être édité.',
            'wrong_user' => 'Vous devez être l\'auteur du post pour l\'éditer.',
        ],
    ],

    'events' => [
        'empty' => 'Il ne s\'est rien passé... pour le moment.',
    ],

    'index' => [
        'deleted_beatmap' => 'supprimé',
        'title' => 'Discussions de Beatmap',

        'form' => [
            '_' => 'Rechercher',
            'deleted' => 'Inclure les discussions supprimées',
            'only_unresolved' => '',
            'types' => 'Types de message',
            'username' => 'Nom d’utilisateur',

            'beatmapset_status' => [
                '_' => '',
                'all' => '',
                'disqualified' => '',
                'never_qualified' => '',
                'qualified' => '',
                'ranked' => '',
            ],

            'user' => [
                'label' => 'Utilisateur',
                'overview' => 'Activités',
            ],
        ],
    ],

    'item' => [
        'created_at' => 'Date du post',
        'deleted_at' => 'Date de suppression',
        'message_type' => 'Type',
        'permalink' => 'Permalien',
    ],

    'nearby_posts' => [
        'confirm' => 'Aucun des posts ne parle de mon problème',
        'notice' => 'Il y a des posts pour :timestamp (:existing_timestamps). Merci de les vérifier avant de poster.',
    ],

    'reply' => [
        'open' => [
            'guest' => 'Connectez-vous pour répondre',
            'user' => 'Répondre',
        ],
    ],

    'system' => [
        'resolved' => [
            'true' => 'Marqué comme résolu par :user',
            'false' => 'Réouvert par :user',
        ],
    ],

    'user_filter' => [
        'everyone' => 'Tout le monde',
        'label' => 'Filtre par utilisateur',
    ],
];
