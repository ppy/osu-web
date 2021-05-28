<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

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
        'none_found' => 'Aucune discussion ne correspond à ce critère de recherche.',
        'title' => 'Discussions de Beatmap',

        'form' => [
            '_' => 'Rechercher',
            'deleted' => 'Inclure les discussions supprimées',
            'mode' => 'Mode Beatmap',
            'only_unresolved' => 'Afficher uniquement les discussions non résolues',
            'types' => 'Types de message',
            'username' => 'Nom d’utilisateur',

            'beatmapset_status' => [
                '_' => 'État de la beatmap',
                'all' => 'Tous',
                'disqualified' => 'Disqualifiée',
                'never_qualified' => 'Jamais qualifiée',
                'qualified' => 'Qualifiée',
                'ranked' => 'Classée',
            ],

            'user' => [
                'label' => 'Utilisateur',
                'overview' => 'Aperçu des actions',
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
        'unsaved' => ':count dans cette review',
    ],

    'owner_editor' => [
        'button' => '',
        'reset_confirm' => '',
        'user' => '',
        'version' => '',
    ],

    'reply' => [
        'open' => [
            'guest' => 'Connectez-vous pour répondre',
            'user' => 'Répondre',
        ],
    ],

    'review' => [
        'block_count' => ':used / :max blocs utilisés',
        'go_to_parent' => 'Afficher le commentaire',
        'go_to_child' => 'Voir la discussion',
        'validation' => [
            'block_too_large' => 'chaque bloc peut contenir jusqu\'à :limit caractères',
            'external_references' => 'l\'avis contient des références à des problèmes qui n\'appartiennent pas à cet avis',
            'invalid_block_type' => 'type de bloc invalide',
            'invalid_document' => 'review invalide',
            'minimum_issues' => 'le review doit contenir un minimum de :count problème|le review doit contenir un minimum de :count problèmes',
            'missing_text' => 'le bloc manque du texte',
            'too_many_blocks' => 'les avis ne doivent contenir que :count paragraphes/problème|les revues doivent contenir jusqu\'à :count paragraphes/problèmes',
        ],
    ],

    'system' => [
        'resolved' => [
            'true' => 'Marqué comme résolu par :user',
            'false' => 'Réouvert par :user',
        ],
    ],

    'timestamp_display' => [
        'general' => 'général',
        'general_all' => 'général (tous)',
    ],

    'user_filter' => [
        'everyone' => 'Tout le monde',
        'label' => 'Filtrer par utilisateur',
    ],
];
