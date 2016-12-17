<?php
/**
 *    Copyright 2015 ppy Pty. Ltd.
 *
 *    This file is part of osu!web. osu!web is distributed in the hopes of
 *    attracting more community contributions to the core ecosystem of osu!
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
            'has_reply' => 'Impossible de supprimer un sujet avec des réponses'
        ],
        'nominate' => [
            'exhausted' => 'Vous avez atteint la limite quotidienne de nominations, veuillez réessayer demain.'
        ],
        'resolve' => [
            'general_discussion' => 'La discussion générale ne peut être marquée comme résolue.',
            'not_owner' => 'Seuls le rédacteur du post et le créateur de la beatmap peuvent voir ce sujet.'
        ]
    ],
    'beatmap_discussion_post' => [
        'edit' => [
            'system_generated' => 'Un sujet posté automatiquement ne peut être édité.',
            'not_owner' => 'Seul le rédacteur du message peut l\'éditer.'
        ]
    ],
    'chat' => [
        'channel' => [
            'read' => [
                'no_access' => 'Accès au canal demandé non permis.'
            ]
        ],
        'message' => [
            'send' => [
                'channel' => [
                    'no_access' => 'L\'accès au canal cible est requis.',
                    'moderated' => 'Ce canal est modéré.'
                ],
                'not_allowed' => 'Vous ne pouvez pas envoyer de messags si vous êtes banni/restreint/réduit au silence.'
            ]
        ]
    ],
    'contest' => [
        'voting_over' => 'Vous ne pouvez pas changer votre vote après la période de vote définie.'
    ],
    'forum' => [
        'post' => [
            'delete' => [
                'only_last_post' => 'Uniquement le dernier message peut être supprimé.',
                'locked' => 'Impossible de supprimer un message sur un sujet verouillé.',
                'no_forum_access' => 'L\'accès au forum demandé est nécessaire.',
                'not_owner' => 'Uniquement le rédacteur du message peut le supprimer.'
            ],
            'edit' => [
                'locked' => 'Ce message est verrouillé à l\'édition.',
                'no_forum_access' => 'L\'accès au forum demandé est nécessaire.',
                'not_owner' => 'Uniquement le rédacteur du message peut l\'éditer.',
                'topic_locked' => 'Impossible d\'éditer un message sur un sujet verrouillé.'
            ]
        ],
        'topic' => [
            'reply' => [
                'double_post' => 'Vous venez de poster, patientez un moment ou éditez votre dernier message.',
                'locked' => 'Impossible de répondre à un sujet verrouillé.',
                'no_forum_access' => 'L\'accès au forum demandé est nécessaire.',
                'no_permission' => 'Impossible de poster une réponse : permission refusée.',
                'user' => [
                    'require_login' => 'Merci de bien vouloir vous connecter pour pouvoir répondre.',
                    'restricted' => 'Impossible de répondre : votre compte est restreint.',
                    'silenced' => 'Impossible de répondre : vous avez été réduit au silence.'
                ]
            ],
            'store' => [
                'no_forum_access' => 'L\'accès au forum demandé est nécessaire.',
                'no_permission' => 'Vous n\'avez pas la permission de créer un sujet.',
                'forum_closed' => 'Ce forum est verrouiller. Vous ne pouvez plus y poster de nouveaux sujets de discussion.'
            ],
            'vote' => [
                'no_forum_access' => 'L\'accès au forum demandé est nécessaire.',
                'over' => 'La période de vote est terminée. Vous ne pouvez plus voter.',
                'voted' => 'Le changement de vote n\'est pas permis.',
                'user' => [
                    'require_login' => 'Connectez-vous pour voter.',
                    'restricted' => 'Impossible de voter : votre compte est restreint.',
                    'silenced' => 'Impossible de voter : vous êtes réduit au silence.'
                ]
            ],
            'watch' => [
                'no_forum_access' => 'L\'accès au forum demandé est nécessaire.'
            ]
        ],
        'topic_cover' => [
            'edit' => [
                'uneditable' => 'Bannière invalide.',
                'not_owner' => 'Uniquement le propriétaire peut éditer la bannière.'
            ]
        ],
        'view' => [
            'admin_only' => 'Uniquement un administrateur peut voir ce forum.'
        ]
    ],
    'require_login' => 'Merci de vous connecter pour continuer.',
    'unauthorized' => 'Accès refusé.',
    'silenced' => 'Impossible : votre compte est restreint.',
    'restricted' => 'Impossible : vous êtes réduit au silence.',
    'user' => [
        'page' => [
            'edit' => [
                'locked' => 'La page utilisateur est verrouillé.',
                'not_owner' => 'Vous pouvez seulement éditer votre page.',
                'require_supporter_tag' => 'Cette fonction est reservée aux osu!supporter.'
            ]
        ]
    ]
];
