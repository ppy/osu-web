<?php

/**
 *    Copyright 2015-2017 ppy Pty. Ltd.
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
            'is_hype' => 'Hypen kann nicht rückgängig gemacht werden.',
            'has_reply' => 'Diskussionen mit Antworten können nicht gelöscht werden',
        ],
        'nominate' => [
            'exhausted' => 'Dein Nominierungslimit für heute wurde erreicht, bitte versuche es morgen erneut.',
        ],
        'resolve' => [
            // todo: gute übersetzung für 'resolve'..
            // diskussion für beendet / gelöst erklären? auflösen? klären?
            'not_owner' => 'Nur der Threadersteller und Beatmapbesitzer können die Diskussion .',
        ],

        'vote' => [
            'limit_exceeded' => 'Bitte warte eine Weile, bevor du mehr Stimmen abgibst',
            'owner' => 'Man kann nicht bei der eigenen Diskussion abstimmen!',
        ],
    ],

    'beatmap_discussion_post' => [
        'edit' => [
            'system_generated' => 'Automatisch erzeugter Beitrag kann nicht bearbeitet werden',
            'not_owner' => 'Nur der Autor des Beitrages kann den Beitrag bearbeiten.',
        ],
    ],

    'chat' => [
        'channel' => [
            'read' => [
                'no_access' => 'Zugang zum angeforderten Channel ist nicht gestattet.',
            ],
        ],
        'message' => [
            'send' => [
                'channel' => [
                    'no_access' => 'Zugang zum Zielkanal ist erforderlich.',
                    'moderated' => 'Der Kanal ist momentan moderiert.',
                    'not_lazer' => 'Momentan kannst du nur in #lazer sprechen.',
                ],

                // todo: übersetzung für restricted
                'not_allowed' => 'Man kann .',
            ],
        ],
    ],

    'contest' => [
        'voting_over' => 'Stimmen können nach dem Abstimmungsende nicht mehr geändert werden.',
    ],

    'forum' => [
        'post' => [
            'delete' => [
                'only_last_post' => 'Nur der letzte Beitrag kann gelöscht werden.',
                // todo: übersetzung für 'locked' im bezug auf forentopics
                'locked' => 'Beiträge in locked topics können nicht gelöscht werden.',
                'no_forum_access' => 'Zugang zum angeforderten Forum wurde verwehrt.',
                'not_owner' => 'Only poster can delete the post.',
            ],

            'edit' => [
                'deleted' => 'Gelöschter Beitrag kann nicht bearbeitet werden.',
                // todo: auch hier 'locked'
                'locked' => 'Dieser Beitrag ist locked und kann nicht bearbeitet werden.',
                'no_forum_access' => 'Zugang zum angeforderten Forum wurde verwehrt.',
                'not_owner' => 'Nur der Autor des Beitrages kann den Beitrag bearbeiten.',
                'topic_locked' => 'Beiträge in locked topics können nicht bearbeitet werden.',
            ],
        ],

        'topic' => [
            'reply' => [
                'double_post' => 'Du hast gerade erst etwas beigetragen! Warte kurz oder bearbeite deinen letzten Beitrag!',
                'locked' => 'Auf locked Threads kann nicht geantwortet werden.',
                'no_forum_access' => 'Zugang zum angeforderten Forum wurde verwehrt.',
                'no_permission' => 'Keine Berechtigung zum Antworten.',

                'user' => [
                    'require_login' => 'Zum Antworten bitte einloggen.',
                    'restricted' => "Antworten.",
                    'silenced' => "Can't reply while silenced.",
                ],
            ],

            'store' => [
                'no_forum_access' => 'Access to requested forum is required.',
                'no_permission' => 'No permission to create new topic.',
                'forum_closed' => 'Forum is closed and can not be posted to.',
            ],

            'vote' => [
                'no_forum_access' => 'Access to requested forum is required.',
                'over' => 'Polling is over and can not be voted on anymore.',
                'voted' => 'Changing vote is not allowed.',

                'user' => [
                    'require_login' => 'Please login to vote.',
                    'restricted' => "Can't vote while restricted.",
                    'silenced' => "Can't vote while silenced.",
                ],
            ],

            'watch' => [
                'no_forum_access' => 'Access to requested forum is required.',
            ],
        ],

        'topic_cover' => [
            'edit' => [
                'uneditable' => 'Invalid cover specified.',
                'not_owner' => 'Only owner can edit cover.',
            ],
        ],

        'view' => [
            'admin_only' => 'Only admin can view this forum.',
        ],
    ],

    'require_login' => 'Please login to proceed.',

    'unauthorized' => 'Access denied.',

    'silenced' => "Can't do that while silenced.",

    'restricted' => "Can't do that while restricted.",

    'user' => [
        'page' => [
            'edit' => [
                'locked' => 'User page is locked.',
                'not_owner' => 'Can only edit own user page.',
                'require_supporter_tag' => 'Supporter tag is required.',
            ],
        ],
    ],
];
