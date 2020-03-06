<?php

/**
 *    Copyright (c) ppy Pty Ltd <contact@ppy.sh>.
 *
 *    This file is part of osu!web. osu!web is distributed with the hope of
 *    attracting more community contributions to the core ecosystem of osu!.
 *
 *    osu!web is free software: you can redistribute it and/or modify
 *    it under the terms of the Affero GNU General Public License version 3
 *    as published by the Free Software Foundation.
 *
 *    osu!web is distributed WITHOUT ANY WARRANTY; without even the implied
 *    warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
 *    See the GNU Affero General Public License for more details.
 *
 *    You should have received a copy of the GNU Affero General Public License
 *    along with osu!web.  If not, see <http://www.gnu.org/licenses/>.
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

    'review' => [
        'go_to_parent' => 'Voir l\'avis',
        'go_to_child' => 'Voir la discussion',
        'validation' => [
            'invalid_block_type' => '',
            'invalid_document' => '',
            'minimum_issues' => '',
            'missing_text' => '',
            'too_many_blocks' => '',
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
        'label' => 'Filtre par utilisateur',
    ],
];
