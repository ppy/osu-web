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
            'has_reply' => 'Kan inte radera en diskussion med svar',
        ],
        'nominate' => [
            'exhausted' => 'Du har uppnått din nominerings gräns för idag, var god försök igen imorgon.',
        ],
        'resolve' => [
            'not_owner' => 'Endast tråd skaparen eller beatmap ägare kan lösa en diskussion.',
        ],

        'vote' => [
            'limit_exceeded' => 'Var god vänta innan du lägger mer röster',
            'owner' => 'Kan inte rösta på din egen diskussion!',
        ],
    ],

    'beatmap_discussion_post' => [
        'edit' => [
            'system_generated' => 'Automatiska genererande inlägg kan inte redigeras.',
            'not_owner' => 'Endast den som la upp inlägget kan redigera inlägget.',
        ],
    ],

    'chat' => [
        'channel' => [
            'read' => [
                'no_access' => 'Åtkomst till begärd kanal tillåts inte.',
            ],
        ],
        'message' => [
            'send' => [
                'channel' => [
                    'no_access' => 'Åtkomst till kanal behövs',
                    'moderated' => 'Kanal modereras just nu.',
                    'not_lazer' => 'Du kan endast prata i #lazer just nu.',
                ],

                'not_allowed' => 'Kan ej skicka meddelande medans man är bannad/begränsad/tystad.',
            ],
        ],
    ],

    'contest' => [
        'voting_over' => 'Du kan inte ändra din röst efter röst perioden för den här tävlingen har avslutas.',
    ],

    'forum' => [
        'post' => [
            'delete' => [
                'only_last_post' => 'Endast sista inlägget kan raderas.',
                'locked' => 'Kan ej radera ett inlägg på en låst tråd.',
                'no_forum_access' => 'Åtkomst till begärd forum behövs.',
                'not_owner' => 'Endast ägare kan radera inlägget.',
            ],

            'edit' => [
                'deleted' => 'Kan ej redigera raderad inlägg.',
                'locked' => 'Inlägget är låst för redigering.',
                'no_forum_access' => 'Åtkomst till begärd forum behövs.',
                'not_owner' => 'Endast ägare kan redigera inlägget.',
                'topic_locked' => 'Kan ej redigera låst inlägg.',
            ],
        ],

        'topic' => [
            'reply' => [
                'double_post' => 'Du la precis upp ett inlägg. Vänta en stund eller redigera ditt senaste inlägg.',
                'locked' => 'Kan ej svara på ett låst inlägg.',
                'no_forum_access' => 'Åtkomst till begärd forum behövs.',
                'no_permission' => 'Inget tillstånd att svara.',

                'user' => [
                    'require_login' => 'Var vänlig logga in för att svara.',
                    'restricted' => 'Kan ej svara när man är begränsad.',
                    'silenced' => 'Kan ej svara när man är tystad.',
                ],
            ],

            'store' => [
                'no_forum_access' => 'Åtkomst till begärd forum behövs.',
                'no_permission' => 'Inget tillstånd för att skapa ny tråd.',
                'forum_closed' => 'Forum är stängd och kan inte lägga upp inlägg.',
            ],

            'vote' => [
                'no_forum_access' => 'Åtkomst till begärd forum behövs.',
                'over' => 'Röstning är avslutad och kan inte röstas på längre.',
                'voted' => 'Ändra röst är ej tillåtet.',

                'user' => [
                    'require_login' => 'Var vänlig logga in för att rösta.',
                    'restricted' => 'Kan ej rösta när man är begränsad.',
                    'silenced' => 'Kan ej rösta när man är tystad.',
                ],
            ],

            'watch' => [
                'no_forum_access' => 'Kan ej rösta när man är begränsad.',
            ],
        ],

        'topic_cover' => [
            'edit' => [
                'uneditable' => 'Ogiltigt omslag specificerad.',
                'not_owner' => 'Endast ägare kan redigera omslag.',
            ],
        ],

        'view' => [
            'admin_only' => 'Endast admin kan se detta forum',
        ],
    ],

    'require_login' => 'Var vänlig logga in för att fortsätta.',

    'unauthorized' => 'Åtkomst nekad.',

    'silenced' => 'Kan ej göra det när man är tystad.',

    'restricted' => 'Kan ej göra det när man är begränsad.',

    'user' => [
        'page' => [
            'edit' => [
                'locked' => 'Användar sida är låst.',
                'not_owner' => 'Kan endast redigera egen användar sida.',
                'require_supporter_tag' => 'Supporter tagg behövs.',
            ],
        ],
    ],
];
