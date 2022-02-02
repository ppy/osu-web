<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'all_read' => 'Toutes les notifications ont été lues !',
    'delete' => 'Supprimer :type',
    'loading' => 'Chargement des notifications non lues...',
    'mark_read' => 'Marquer comme lu :type',
    'none' => 'Pas de notifications',
    'see_all' => 'voir toutes les notifications',
    'see_channel' => 'accéder au tchat',
    'verifying' => 'Veuillez vérifier votre session pour voir les notifications',

    'filters' => [
        '_' => 'tout',
        'user' => 'profil',
        'beatmapset' => 'beatmaps',
        'forum_topic' => 'forum',
        'news_post' => 'news',
        'build' => 'versions',
        'channel' => 'tchat',
    ],

    'item' => [
        'beatmapset' => [
            '_' => 'Beatmap',

            'beatmap_owner_change' => [
                '_' => 'Difficultés invités',
                'beatmap_owner_change' => 'Vous êtes maintenant propriétaire de la difficulté ":beatmap" pour la beatmap ":title"',
                'beatmap_owner_change_compact' => 'Vous êtes maintenant propriétaire de la difficulté ":beatmap"',
            ],

            'beatmapset_discussion' => [
                '_' => 'Discussions de beatmaps',
                'beatmapset_discussion_lock' => 'La discussion de la beatmap ":title" a été verrouillée',
                'beatmapset_discussion_lock_compact' => 'La discussion a été verrouillée',
                'beatmapset_discussion_post_new' => 'Nouveau message sur ":title" par :username : ":content"',
                'beatmapset_discussion_post_new_empty' => 'Nouveau message sur ":title" par :username',
                'beatmapset_discussion_post_new_compact' => 'Nouveau message par :username : ":content"',
                'beatmapset_discussion_post_new_compact_empty' => 'Nouveau message par :username',
                'beatmapset_discussion_review_new' => 'Nouvelle review sur ":title" par :username contenant des problèmes : :problems, suggestions : :suggestions, encouragements : :praises',
                'beatmapset_discussion_review_new_compact' => 'Nouvelle review par :username contenant des problèmes : :problems, suggestions : :suggestions, compliments : :praises',
                'beatmapset_discussion_unlock' => 'La discussion de la beatmap ":title" a été déverrouillée',
                'beatmapset_discussion_unlock_compact' => 'La discussion n\'est plus verrouillée',
            ],

            'beatmapset_problem' => [
                '_' => 'Problème de beatmap qualifiée',
                'beatmapset_discussion_qualified_problem' => 'Signalé par :username sur ":title" : ":content"',
                'beatmapset_discussion_qualified_problem_empty' => 'Signalé par :username sur ":title"',
                'beatmapset_discussion_qualified_problem_compact' => 'Signalé par :username : ":content"',
                'beatmapset_discussion_qualified_problem_compact_empty' => 'Signalé par :username',
            ],

            'beatmapset_state' => [
                '_' => 'Statut de la beatmap modifié',
                'beatmapset_disqualify' => '":title" a été disqualifiée',
                'beatmapset_disqualify_compact' => 'La beatmap a été disqualifiée',
                'beatmapset_love' => '":title" a été ajoutée à la catégorie Loved',
                'beatmapset_love_compact' => 'La beatmap est passée à la catégorie Loved',
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
                '_' => '',

                'announce' => [
                    'channel_announcement' => '',
                    'channel_announcement_compact' => '',
                    'channel_announcement_group' => '',
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
                'forum_topic_reply' => ':username a répondu au sujet du forum ":title"',
                'forum_topic_reply_compact' => ':username a répondu',
            ],
        ],

        'legacy_pm' => [
            '_' => 'Ancienne page forum des messages privés',

            'legacy_pm' => [
                '_' => '',
                'legacy_pm' => ':count_delimited message non lu|:count_delimited messages non lus',
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
                'beatmap_owner_change' => 'Vous êtes maintenant invité de la beatmap ":title"',
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
                'beatmapset_love' => '":title" est passée à la catégorie Loved',
                'beatmapset_nominate' => '":title" a été nominée',
                'beatmapset_qualify' => '":title" a atteint suffisamment de nominations et est entrée dans la file d\'attente de classement',
                'beatmapset_rank' => '":title" a été classée',
                'beatmapset_remove_from_loved' => '":title" a été retirée de la catégorie Loved',
                'beatmapset_reset_nominations' => 'La nomination de ":title" a été réinitialisée',
            ],

            'comment' => [
                'comment_new' => 'La beatmap ":title" a de nouveaux commentaires',
            ],
        ],

        'channel' => [
            'channel' => [
                'pm' => 'Vous avez reçu un nouveau message de :username',
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

        'user' => [
            'user_achievement_unlock' => [
                'user_achievement_unlock' => ':username a déverrouillé une nouvelle médaille, ":title" !',
                'user_achievement_unlock_self' => 'Vous avez déverrouillé une nouvelle médaille, ":title" !',
            ],

            'user_beatmapset_new' => [
                'user_beatmapset_new' => ':username a créé de nouvelles beatmaps',
            ],
        ],
    ],
];
