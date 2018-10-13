<?php

/**
 *    Copyright 2015-2018 ppy Pty. Ltd.
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
    'beatmap_discussion' => [
        'destroy' => [
            'is_hype' => 'Vous ne pouvez pas retirer votre hype.',
            'has_reply' => 'Impossible de supprimer un sujet avec des réponses',
        ],
        'nominate' => [
            'exhausted' => 'Vous avez atteint la limite quotidienne de nominations, veuillez réessayer demain.',
            'incorrect_state' => 'Une erreur est survenue lors de l’exécution de cette action, essayez d’actualiser la page.',
            'owner' => "Vous ne pouvez pas nominer votre propre beatmap.",
        ],
        'resolve' => [
            'not_owner' => 'Seuls l\'auteur du post d\'origine de la discussion et le créateur de la beatmap peuvent voir ce sujet.',
        ],

        'store' => [
            'mapper_note_wrong_user' => 'Seul le propriétaire de la beatmap ou un membre du groupe nominateur/QAT peut poster des notes de mappeur.',
        ],

        'vote' => [
            'limit_exceeded' => 'Veuillez attendre un peu avant d\'envoyer de nouveaux votes',
            'owner' => "Vous ne pouvez pas voter pour votre propre discussion.",
            'wrong_beatmapset_state' => 'Vous ne pouvez voter que sur les discussions des beatmaps en attente.',
        ],
    ],

    'beatmap_discussion_post' => [
        'edit' => [
            'system_generated' => 'Un sujet posté automatiquement ne peut être édité.',
            'not_owner' => 'Seul l\'auteur de ce post peut l\'éditer.',
        ],
    ],

    'chat' => [
        'channel' => [
            'read' => [
                'no_access' => 'Accès au canal demandé refusé.',
            ],
        ],
        'message' => [
            'send' => [
                'channel' => [
                    'no_access' => 'L\'accès au canal voulu est requis.',
                    'moderated' => 'Ce canal est fermé à la discussion.',
                    'not_lazer' => 'Vous ne pouvez parler que dans #lazer pour le moment.',
                ],

                'not_allowed' => 'Vous ne pouvez pas envoyer de messages si vous êtes banni/restreint/réduit au silence.',
            ],
        ],
    ],

    'contest' => [
        'voting_over' => 'Vous ne pouvez pas changer votre vote une fois la période de vote terminée.',
    ],

    'forum' => [
        'post' => [
            'delete' => [
                'only_last_post' => 'Seul le dernier message peut être supprimé.',
                'locked' => 'Impossible de supprimer un message sur un sujet verrouillé.',
                'no_forum_access' => 'L\'accès au forum demandé est nécessaire.',
                'not_owner' => 'Seul l\'auteur de ce post peut le supprimer.',
            ],

            'edit' => [
                'deleted' => 'Impossible de modifier un post supprimé.',
                'locked' => 'Ce post ne peut pas être édité.',
                'no_forum_access' => 'L\'accès au forum demandé est requis.',
                'not_owner' => 'Seul l\'auteur de ce post peut l\'éditer.',
                'topic_locked' => 'Impossible d\'éditer un post sur un sujet verrouillé.',
            ],

            'store' => [
                'play_more' => 'Essayez de jouer au jeu avant de poster sur les forums ! Si vous rencontrez des problèmes pour jouer, essayez de poster sur le forum Aide et Support.',
                'too_many_help_posts' => "Vous devez jouer davantage avant de pouvoir créer de nouveaux messages. Si vous rencontrez encore des difficultés pour jouer, envoyez un email à support@ppy.sh", // FIXME: unhardcode email address.
            ],
        ],

        'topic' => [
            'reply' => [
                'double_post' => 'Merci d\'éditer votre dernier post au lieu de poster à nouveau.',
                'locked' => 'Impossible de répondre à un sujet verrouillé.',
                'no_forum_access' => 'L\'accès au forum demandé est requis.',
                'no_permission' => 'Vous n\'êtes pas autorisé à répondre.',

                'user' => [
                    'require_login' => 'Merci de vous connecter pour répondre.',
                    'restricted' => "Impossible de répondre : votre compte est restreint.",
                    'silenced' => "Impossible de répondre : votre compte est réduit au silence.",
                ],
            ],

            'store' => [
                'no_forum_access' => 'L\'accès au forum demandé est requis.',
                'no_permission' => 'Vous n\'êtes pas autorisé à créer un sujet.',
                'forum_closed' => 'Ce forum est fermé et vous ne pouvez pas poster.',
            ],

            'vote' => [
                'no_forum_access' => 'L\'accès au forum demandé est requis.',
                'over' => 'Le vote est fini et vous ne pouvez plus voter.',
                'voted' => 'Le changement de vote n\'est pas permis.',

                'user' => [
                    'require_login' => 'Connectez-vous pour voter.',
                    'restricted' => "Impossible de voter : votre compte est restreint.",
                    'silenced' => "Impossible de voter : votre compte est réduit au silence.",
                ],
            ],

            'watch' => [
                'no_forum_access' => 'L\'accès au forum demandé est requis.',
            ],
        ],

        'topic_cover' => [
            'edit' => [
                'uneditable' => 'Bannière spécifiée invalide.',
                'not_owner' => 'Seul l\'auteur du post peut en éditer la bannière.',
            ],
        ],

        'view' => [
            'admin_only' => 'Ce forum n\'est accessible qu\'aux administrateurs.',
        ],
    ],

    'require_login' => 'Merci de vous connecter pour continuer.',

    'unauthorized' => 'Accès refusé.',

    'silenced' => "Action impossible quand votre compte est réduit au silence.",

    'restricted' => "Action impossible quand votre compte est restreint.",

    'user' => [
        'page' => [
            'edit' => [
                'locked' => 'La page utilisateur est verrouillée.',
                'not_owner' => 'Vous ne pouvez éditer que votre propre page, pas celle d\'autres utilisateurs.',
                'require_supporter_tag' => 'le tag supporter est requis.',
            ],
        ],
    ],
];
