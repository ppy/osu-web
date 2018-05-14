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
            'is_hype' => 'Can not undo hyping.',
            'has_reply' => 'Can not delete discussion with replies',
        ],
        'nominate' => [
            'exhausted' => 'You have reached your nomination limit for the day, please try again tomorrow.',
        ],
        'resolve' => [
            'not_owner' => 'Alleen de eigenaar van de thread of de eigenaar van de beatmap kan een discussie als opgelost markeren.',
        ],

        'vote' => [
            'limit_exceeded' => 'Please wait a while before casting more votes',
            'owner' => "Can't vote on own discussion.",
            'wrong_beatmapset_state' => 'Can only vote on discussions of pending beatmaps.',
        ],
    ],

    'beatmap_discussion_post' => [
        'edit' => [
            'system_generated' => 'Automatisch gegenereerde posts kunnen niet worden bewerkt.',
            'not_owner' => 'Alleen de eigenaar kan deze post bewerken.',
        ],
    ],

    'chat' => [
        'channel' => [
            'read' => [
                'no_access' => 'Toegang tot dit kanaal is niet toegestaan.',
            ],
        ],
        'message' => [
            'send' => [
                'channel' => [
                    'no_access' => 'Toegang tot dit kanaal is vereist.',
                    'moderated' => 'Kanaal wordt op het moment gemodereerd.',
                    'not_lazer' => 'You can only speak in #lazer at this time.',
                ],

                'not_allowed' => 'Je kunt geen berichten sturen terwijl je bent verbannen/restricted/silenced.',
            ],
        ],
    ],

    'contest' => [
        'voting_over' => 'You cannot change your vote after the voting period for this contest has ended.',
    ],

    'forum' => [
        'post' => [
            'delete' => [
                'only_last_post' => 'Alleen de laatste post kan worden verwijderd.',
                'locked' => 'Kan geen post in een gesloten onderwerp verwijderen.',
                'no_forum_access' => 'Toegang tot dit forum is nodig.',
                'not_owner' => 'Alleen de eigenaar kan deze post verwijderen.',
            ],

            'edit' => [
                'deleted' => 'Can not edit deleted post.',
                'locked' => 'De post is afgesloten voor bewerkingen.',
                'no_forum_access' => 'Toegang tot dit forum is nodig.',
                'not_owner' => 'Alleen de eigenaar kan de post bewerken.',
                'topic_locked' => 'Kan geen post in een gesloten onderwerp bewerken.',
            ],

            'store' => [
                'play_more' => 'Try playing the game before posting on the forums, please! If you have a problem with playing, please post to the Help and Support forum.',
                'too_many_help_posts' => "You need to play the game more before you can make additional posts. If you're still having trouble playing the game, email support@ppy.sh", // FIXME: unhardcode email address.
            ],
        ],

        'topic' => [
            'reply' => [
                'double_post' => 'Je hebt zojuist gepost. Wacht even voordat je een nieuwe maakt of bewerk je vorige post.',
                'locked' => 'Je kunt niet antwoorden op een gesloten onderwerp.',
                'no_forum_access' => 'Toegang tot dit forum is nodig.',
                'no_permission' => 'Geen toestemming om te antwoorden.',

                'user' => [
                    'require_login' => 'Please sign in to reply.',
                    'restricted' => "Can't reply while restricted.",
                    'silenced' => "Can't reply while silenced.",
                ],
            ],

            'store' => [
                'no_forum_access' => 'Toegang tot dit forum is nodig.',
                'no_permission' => 'Geen toestemming om een onderwerp te starten.',
                'forum_closed' => 'Forum is gesloten en kan niet in gepost worden.',
            ],

            'vote' => [
                'no_forum_access' => 'Access to requested forum is required.',
                'over' => 'Polling is over and can not be voted on anymore.',
                'voted' => 'Changing vote is not allowed.',

                'user' => [
                    'require_login' => 'Please sign in to vote.',
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
                'uneditable' => 'Foutieve cover gespecificeerd.',
                'not_owner' => 'Alleen de eigenaar kan de cover bewerken.',
            ],
        ],

        'view' => [
            'admin_only' => 'Alleen admins kunnen dit forum zien.',
        ],
    ],

    'require_login' => 'Log in om verder te gaan.',

    'unauthorized' => 'Toegang geweigerd.',

    'silenced' => "Je kunt dit niet doen terwijl je silenced bent.",

    'restricted' => "Je kunt dit niet doen terwijl je restricted bent.",

    'user' => [
        'page' => [
            'edit' => [
                'locked' => 'Gebruikerspagina is gesloten.',
                'not_owner' => 'Je kunt alleen je eigen gebruikerspagina bewerken.',
                'require_supporter_tag' => 'Supporter tag is nodig.',
            ],
        ],
    ],
];
