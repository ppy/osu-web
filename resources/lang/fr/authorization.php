<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'play_more' => 'Que diriez-vous de jouer un peu d\'osu! à la place ?',
    'require_login' => 'Veuillez vous connecter pour continuer.',
    'require_verification' => 'Veuillez vous authentifier pour continuer.',
    'restricted' => "Vous ne pouvez pas effectuer cette action lorsque votre compte est restreint.",
    'silenced' => "Vous ne pouvez pas effectuer cette action lorsque vous êtes réduit au silence.",
    'unauthorized' => 'Accès refusé.',

    'beatmap_discussion' => [
        'destroy' => [
            'is_hype' => 'Vous ne pouvez pas retirer votre hype.',
            'has_reply' => 'Impossible de supprimer un sujet avec des réponses',
        ],
        'nominate' => [
            'exhausted' => 'Vous avez atteint la limite quotidienne de nominations, veuillez réessayer demain.',
            'incorrect_state' => 'Une erreur est survenue lors de l’exécution de cette action, essayez d’actualiser la page.',
            'owner' => "Vous ne pouvez pas nominer votre propre beatmap.",
            'set_metadata' => 'Veuillez définir le genre et la langue de la musique avant de nominer cette beatmap.',
        ],
        'resolve' => [
            'not_owner' => 'Seuls l\'auteur du post et le créateur de la beatmap peuvent résoudre ce sujet.',
        ],

        'store' => [
            'mapper_note_wrong_user' => 'Seul le propriétaire de la beatmap, un Beatmap Nominator ou un membre de la NAT peut publier des notes sur la beatmap.',
        ],

        'vote' => [
            'bot' => "Vous ne pouvez pas voter sur une discussion créée par un bot",
            'limit_exceeded' => 'Veuillez attendre un peu avant d\'envoyer de nouveaux votes',
            'owner' => "Vous ne pouvez pas voter dans votre propre sondage.",
            'wrong_beatmapset_state' => 'Vous ne pouvez voter que sur les discussions des beatmaps en attente.',
        ],
    ],

    'beatmap_discussion_post' => [
        'destroy' => [
            'not_owner' => 'Vous pouvez uniquement supprimer vos propres posts.',
            'resolved' => 'Vous ne pouvez pas supprimer un post d\'une discussion résolue.',
            'system_generated' => 'Les posts automatiquement générés ne peuvent pas être supprimés.',
        ],

        'edit' => [
            'not_owner' => 'Seul l\'auteur de ce post peut l\'éditer.',
            'resolved' => 'Vous ne pouvez pas modifier un post d\'une discussion résolue.',
            'system_generated' => 'Un sujet posté automatiquement ne peut être édité.',
        ],
    ],

    'beatmapset' => [
        'discussion_locked' => 'La discussion de cette beatmap est verrouillée.',

        'metadata' => [
            'nominated' => 'Vous ne pouvez pas modifier les métadonnées d\'une beatmap nominée. Contactez un Beatmap Nominator ou un membre de la NAT si vous pensez qu\'elles sont mal définies.',
        ],
    ],

    'beatmap_tag' => [
        'store' => [
            'no_score' => 'Vous devez réaliser un score sur une beatmap pour ajouter un tag.',
        ],
    ],

    'chat' => [
        'blocked' => 'Vous ne pouvez pas envoyer un message à un utilisateur qui vous a bloqué ou que vous avez bloqué.',
        'friends_only' => 'Cet utilisateur bloque les messages des utilisateurs qui ne sont pas dans sa liste d’amis.',
        'moderated' => 'Ce canal est actuellement restreint par un modérateur.',
        'no_access' => 'Vous n’avez pas accès à ce canal.',
        'no_announce' => 'Vous n\'avez pas la permission de publier une annonce.',
        'receive_friends_only' => 'L\'utilisateur n\'est peut-être pas en mesure de répondre parce que vous n\'acceptez que les messages des utilisateurs de votre liste d\'amis.',
        'restricted' => 'Vous ne pouvez pas envoyer de messages en étant réduit au silence, restreint ou banni.',
        'silenced' => 'Vous ne pouvez pas envoyer de messages en étant réduit au silence, restreint ou banni.',
    ],

    'comment' => [
        'store' => [
            'disabled' => 'Les commentaires ont été désactivés',
        ],
        'update' => [
            'deleted' => "Vous ne pouvez pas éditer un post supprimé.",
        ],
    ],

    'contest' => [
        'judging_not_active' => 'Il n\'est pas possible de juger pour ce concours.',
        'voting_over' => 'Vous ne pouvez plus modifier votre vote une fois la période de vote passée.',

        'entry' => [
            'limit_reached' => 'Vous avez atteint la limite d\'entrées pour ce concours',
            'over' => 'Merci pour vos inscriptions ! Les soumissions sont fermées pour ce concours et le vote va bientôt ouvrir.',
        ],
    ],

    'forum' => [
        'moderate' => [
            'no_permission' => 'Vous n’avez pas la permission de modérer ce forum.',
        ],

        'post' => [
            'delete' => [
                'only_last_post' => 'Seul le dernier post peut être supprimé.',
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
                'play_more' => 'Essayez de jouer au jeu avant de poster sur les forums ! Si vous rencontrez des problèmes pour jouer, veuillez poster sur les forums Help et Support.',
                'too_many_help_posts' => "Vous devez jouer davantage avant de pouvoir créer de nouveaux posts. Si vous rencontrez toujours des difficultés pour jouer, envoyez un e-mail à support@ppy.sh", // FIXME: unhardcode email address.
            ],
        ],

        'topic' => [
            'reply' => [
                'double_post' => 'Merci d\'éditer votre dernier post au lieu de poster à nouveau.',
                'locked' => 'Impossible de répondre à un sujet verrouillé.',
                'no_forum_access' => 'L\'accès au forum demandé est requis.',
                'no_permission' => 'Vous n\'êtes pas autorisé à répondre.',

                'user' => [
                    'require_login' => 'Veuillez vous connecter pour répondre.',
                    'restricted' => "Impossible de répondre : votre compte est restreint.",
                    'silenced' => "Impossible de répondre : votre compte est réduit au silence.",
                ],
            ],

            'store' => [
                'no_forum_access' => 'L\'accès au forum demandé est requis.',
                'no_permission' => 'Vous n\'êtes pas autorisé à créer un sujet.',
                'forum_closed' => 'Ce forum est fermé et il n\'est pas possible de poster.',
            ],

            'vote' => [
                'no_forum_access' => 'L\'accès au forum demandé est requis.',
                'over' => 'La période de vote est terminée et vous ne pouvez plus voter.',
                'play_more' => 'Vous devez jouer plus avant de voter sur le forum.',
                'voted' => 'Le changement de vote n\'est pas autorisé.',

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
            'store' => [
                'forum_not_allowed' => 'Ce forum n\'accepte pas les couvertures de sujets.',
            ],
        ],

        'view' => [
            'admin_only' => 'Ce forum n\'est accessible qu\'aux administrateurs.',
        ],
    ],

    'room' => [
        'destroy' => [
            'not_owner' => 'Seul le propriétaire de la salle peut la fermer.',
        ],
    ],

    'score' => [
        'pin' => [
            'disabled_type' => "Impossible d'épingler ce type de score",
            'failed' => "Impossible d'épingler un échec.",
            'not_owner' => 'Seul le propriétaire du score peut épingler ce score.',
            'too_many' => 'Trop de scores épinglés.',
        ],
    ],

    'team' => [
        'application' => [
            'store' => [
                'already_member' => "Vous faites déjà partie de l'équipe.",
                'already_other_member' => "Vous faites déjà partie d'une autre équipe.",
                'currently_applying' => 'Vous avez déjà demandé à rejoindre une autre équipe.',
                'team_closed' => 'Cette équipe n\'accepte pas les candidatures pour l\'instant.',
                'team_full' => "L'équipe est complète et ne peut plus accepter de nouveaux membres.",
            ],
        ],
        'part' => [
            'is_leader' => "Le chef d'équipe ne peut pas quitter l'équipe.",
            'not_member' => 'Pas un membre de l\'équipe.',
        ],
        'store' => [
            'require_supporter_tag' => '',
        ],
    ],

    'user' => [
        'page' => [
            'edit' => [
                'locked' => 'La page utilisateur est verrouillée.',
                'not_owner' => 'Vous ne pouvez éditer que votre propre page, pas celle d\'autres utilisateurs.',
                'require_supporter_tag' => 'Vous devez être un osu!supporter.',
            ],
        ],
        'update_email' => [
            'locked' => 'l\'adresse e-mail est verrouillée',
        ],
    ],
];
