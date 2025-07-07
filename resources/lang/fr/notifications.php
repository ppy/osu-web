<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'all_read' => 'Toutes les notifications ont été lues !',
    'delete' => 'Supprimer les notifications (:type)',
    'loading' => 'Chargement des notifications non lues...',
    'mark_read' => 'Marquer comme lu (:type)',
    'none' => 'Pas de notifications',
    'see_all' => 'voir toutes les notifications',
    'see_channel' => 'accéder au tchat',
    'verifying' => 'Veuillez vérifier votre session pour voir les notifications',

    'action_type' => [
        '_' => 'toutes',
        'beatmapset' => 'beatmaps',
        'build' => 'versions',
        'channel' => 'tchat',
        'forum_topic' => 'forum',
        'news_post' => 'news',
        'team' => 'équipe',
        'user' => 'profil',
    ],

    'filters' => [
        '_' => 'tout',
        'beatmapset' => 'beatmaps',
        'build' => 'versions',
        'channel' => 'tchat',
        'forum_topic' => 'forum',
        'news_post' => 'news',
        'team' => 'équipe',
        'user' => 'profil',
    ],

    'item' => [
        'beatmapset' => [
            '_' => 'Beatmap',

            'beatmap_owner_change' => [
                '_' => 'Guest difficulty',
                'beatmap_owner_change' => 'Vous êtes maintenant propriétaire de la difficulté ":beatmap" pour la beatmap ":title"',
                'beatmap_owner_change_compact' => 'Vous êtes maintenant propriétaire de la difficulté ":beatmap"',
            ],

            'beatmapset_discussion' => [
                '_' => 'Discussions de beatmaps',
                'beatmapset_discussion_lock' => 'La discussion de ":title" a été verrouillée',
                'beatmapset_discussion_lock_compact' => 'La discussion a été verrouillée',
                'beatmapset_discussion_post_new' => 'Nouveau post sur ":title" par :username : ":content"',
                'beatmapset_discussion_post_new_empty' => 'Nouveau post sur ":title" par :username',
                'beatmapset_discussion_post_new_compact' => 'Nouveau post par :username : ":content"',
                'beatmapset_discussion_post_new_compact_empty' => 'Nouveau post par :username',
                'beatmapset_discussion_review_new' => 'Nouvel avis sur ":title" par :username contenant :review_counts',
                'beatmapset_discussion_review_new_compact' => 'Nouvel avis par :username contenant :review_counts',
                'beatmapset_discussion_unlock' => 'La discussion de ":title" a été déverrouillée',
                'beatmapset_discussion_unlock_compact' => 'La discussion n\'est plus verrouillée',

                'review_count' => [
                    'praises' => ':count_delimited compliment|:count_delimited compliments',
                    'problems' => ':count_delimited problème|:count_delimited problèmes',
                    'suggestions' => ':count_delimited suggestion|:count_delimited suggestions',
                ],
            ],

            'beatmapset_problem' => [
                '_' => 'Problème de beatmap qualifiée',
                'beatmapset_discussion_qualified_problem' => 'Signalé par :username sur ":title" : ":content"',
                'beatmapset_discussion_qualified_problem_empty' => 'Signalé par :username sur ":title"',
                'beatmapset_discussion_qualified_problem_compact' => 'Signalé par :username : ":content"',
                'beatmapset_discussion_qualified_problem_compact_empty' => 'Signalé par :username',
            ],

            'beatmapset_state' => [
                '_' => 'Modification de l\'état de la beatmap',
                'beatmapset_disqualify' => '":title" a été disqualifiée',
                'beatmapset_disqualify_compact' => 'La beatmap a été disqualifiée',
                'beatmapset_love' => '":title" a été ajoutée à la catégorie Loved',
                'beatmapset_love_compact' => 'La beatmap a été promue à la catégorie Loved',
                'beatmapset_nominate' => '":title" a été nominée',
                'beatmapset_nominate_compact' => 'La beatmap a été nominée',
                'beatmapset_qualify' => '":title" a obtenu suffisamment de nominations et est entrée dans la file d\'attente de classement',
                'beatmapset_qualify_compact' => 'La beatmap est entrée dans la file d’attente de classement',
                'beatmapset_rank' => '":title" a été classée',
                'beatmapset_rank_compact' => 'La beatmap a été classée',
                'beatmapset_remove_from_loved' => '":title" a été retirée de la catégorie Loved',
                'beatmapset_remove_from_loved_compact' => 'La beatmap a été retirée de la catégorie loved',
                'beatmapset_reset_nominations' => 'La nomination de ":title" a été réinitialisée',
                'beatmapset_reset_nominations_compact' => 'La nomination a été réinitialisée',
            ],

            'comment' => [
                '_' => 'Nouveau commentaire',

                'comment_new' => ':username a commenté ":content" sur ":title"',
                'comment_new_compact' => ':username a commenté ":content"',
                'comment_reply' => ':username a répondu ":content" sur ":title"',
                'comment_reply_compact' => ':username à répondu ":content"',
            ],
        ],

        'channel' => [
            '_' => 'Tchat',

            'announcement' => [
                '_' => 'Nouvelle annonce',

                'announce' => [
                    'channel_announcement' => ':username dit ":title"',
                    'channel_announcement_compact' => ':title',
                    'channel_announcement_group' => 'Annonce de :username',
                ],
            ],

            'channel' => [
                '_' => 'Nouveau message',

                'pm' => [
                    'channel_message' => ':username dit ":title"',
                    'channel_message_compact' => ':title',
                    'channel_message_group' => 'de :username',
                ],
            ],

            'channel_team' => [
                '_' => 'Nouveau message d\'équipe',

                'team' => [
                    'channel_team' => ':username dit « :title »',
                    'channel_team_compact' => ':username dit « :title »',
                    'channel_team_group' => ':username dit « :title »',
                ],
            ],
        ],

        'build' => [
            '_' => 'Changelog',

            'comment' => [
                '_' => 'Nouveau commentaire',

                'comment_new' => ':username a commenté ":content" sur ":title"',
                'comment_new_compact' => ':username a commenté ":content"',
                'comment_reply' => ':username a répondu ":content" sur ":title"',
                'comment_reply_compact' => ':username a répondu ":content"',
            ],
        ],

        'news_post' => [
            '_' => 'News',

            'comment' => [
                '_' => 'Nouveau commentaire',

                'comment_new' => ':username a commenté ":content" sur ":title"',
                'comment_new_compact' => ':username a commenté ":content"',
                'comment_reply' => ':username a répondu ":content" sur ":title"',
                'comment_reply_compact' => ':username a répondu ":content"',
            ],
        ],

        'forum_topic' => [
            '_' => 'Sujet du forum',

            'forum_topic_reply' => [
                '_' => 'Nouvelle réponse du forum',
                'forum_topic_reply' => ':username a répondu à ":title"',
                'forum_topic_reply_compact' => ':username a répondu',
            ],
        ],

        'team' => [
            'team_application' => [
                '_' => 'Candidature pour votre équipe',

                'team_application_accept' => "Vous faites désormais partie de l'équipe :title",
                'team_application_accept_compact' => "Vous faites désormais partie de l'équipe :title",

                'team_application_group' => 'Informations concernant votre candidature pour rejoindre une équipe',

                'team_application_reject' => 'Votre demande pour rejoindre l\'équipe :title a été refusée',
                'team_application_reject_compact' => 'Votre demande pour rejoindre l\'équipe :title a été refusée',
                'team_application_store' => ':title voudrait rejoindre votre équipe',
                'team_application_store_compact' => ':title voudrait rejoindre votre équipe',
            ],
        ],

        'user' => [
            'user_beatmapset_new' => [
                '_' => 'Nouvelle beatmap',

                'user_beatmapset_new' => 'Nouvelle beatmap ":title" par :username',
                'user_beatmapset_new_compact' => 'Nouvelle beatmap ":title"',
                'user_beatmapset_new_group' => 'Nouvelles beatmaps par :username',

                'user_beatmapset_revive' => 'La beatmap ":title" a été ramenée à la vie par :username',
                'user_beatmapset_revive_compact' => 'La beatmap ":title" a été ramenée à la vie',
            ],
        ],

        'user_achievement' => [
            '_' => 'Médailles',

            'user_achievement_unlock' => [
                '_' => 'Nouvelle médaille',
                'user_achievement_unlock' => '":title" débloquée !',
                'user_achievement_unlock_compact' => '«:title» débloquée !',
                'user_achievement_unlock_group' => 'Médailles déverrouillées !',
            ],
        ],
    ],

    'mail' => [
        'beatmapset' => [
            'beatmap_owner_change' => [
                'beatmap_owner_change' => 'Vous faites maintenant partie des participants à la beatmap ":title"',
            ],

            'beatmapset_discussion' => [
                'beatmapset_discussion_lock' => 'La discussion sur ":title" a été verrouillée',
                'beatmapset_discussion_post_new' => 'La discussion sur ":title" a de nouvelles mises à jour',
                'beatmapset_discussion_unlock' => 'La discussion sur ":title" a été déverrouillée',
            ],

            'beatmapset_problem' => [
                'beatmapset_discussion_qualified_problem' => 'Un nouveau problème a été signalé sur ":title"',
            ],

            'beatmapset_state' => [
                'beatmapset_disqualify' => '":title" a été disqualifiée',
                'beatmapset_love' => '":title" a été promue à la catégorie Loved',
                'beatmapset_nominate' => '":title" a été nominée',
                'beatmapset_qualify' => '":title" a obtenu suffisamment de nominations et est entrée dans la file d\'attente de classement',
                'beatmapset_rank' => '":title" a été classée',
                'beatmapset_remove_from_loved' => '":title" a été retirée de la catégorie Loved',
                'beatmapset_reset_nominations' => 'La nomination de ":title" a été réinitialisée',
            ],

            'comment' => [
                'comment_new' => 'La beatmap ":title" a de nouveaux commentaires',
            ],
        ],

        'channel' => [
            'announcement' => [
                'channel_announcement' => 'Il y a une nouvelle annonce dans « :name »',
            ],
            'channel' => [
                'channel_message' => 'Vous avez reçu un nouveau message de :username',
            ],
            'channel_team' => [
                'channel_team' => 'Il y a un nouveau message dans l\'équipe « :name »',
            ],
        ],

        'build' => [
            'comment' => [
                'comment_new' => 'Le changelog ":title" a reçu de nouveaux commentaires',
            ],
        ],

        'news_post' => [
            'comment' => [
                'comment_new' => 'L\'article ":title" a de nouveaux commentaires',
            ],
        ],

        'forum_topic' => [
            'forum_topic_reply' => [
                'forum_topic_reply' => 'Il y a de nouvelles réponses dans ":title"',
            ],
        ],

        'team' => [
            'team_application' => [
                'team_application_accept' => "Vous faites désormais partie de l'équipe :title",
                'team_application_reject' => 'Votre demande pour rejoindre l\'équipe :title a été refusée',
                'team_application_store' => ':title voudrait rejoindre votre équipe',
            ],
        ],

        'user' => [
            'user_beatmapset_new' => [
                'user_beatmapset_new' => ':username a créé de nouvelles beatmaps',
                'user_beatmapset_revive' => ':username a ressuscité des beatmaps',
            ],
        ],
    ],
];
