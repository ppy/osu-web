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
    'require_login' => 'Var vänlig logga in för att fortsätta.',
    'require_verification' => '',
    'restricted' => "Kan ej göra det när man är avstängd.",
    'silenced' => "Kan ej göra det när man är tystad.",
    'unauthorized' => 'Åtkomst nekad.',

    'beatmap_discussion' => [
        'destroy' => [
            'is_hype' => 'Kan inte ångra hype.',
            'has_reply' => 'Kan inte radera en diskussion med svar',
        ],
        'nominate' => [
            'exhausted' => 'Du har uppnått din nomineringsgräns för idag, var god försök igen imorgon.',
            'full_bn_required' => '',
            'full_bn_required_hybrid' => '',
            'incorrect_state' => 'Ett fel uppstod, försök att uppdatera sidan.',
            'owner' => "Kan ej nominera egen beatmap.",
        ],
        'resolve' => [
            'not_owner' => 'Endast tråd skaparen eller beatmap ägare kan lösa en diskussion.',
        ],

        'store' => [
            'mapper_note_wrong_user' => 'Endast beatmap ägaren eller nominator/QAT gruppmedlem kan publicera kart anteckningar.',
        ],

        'vote' => [
            'limit_exceeded' => 'Var god vänta innan du lägger mer röster',
            'owner' => "Kan inte rösta på din egen diskussion!",
            'wrong_beatmapset_state' => 'Kan endast rösta på diskussioner för väntande beatmaps.',
        ],
    ],

    'beatmap_discussion_post' => [
        'destroy' => [
            'not_owner' => '',
            'resolved' => '',
            'system_generated' => '',
        ],

        'edit' => [
            'not_owner' => 'Endast den som la upp inlägget kan redigera inlägget.',
            'resolved' => '',
            'system_generated' => 'Automatiskt genererade inlägg kan inte redigeras.',
        ],

        'store' => [
            'beatmapset_locked' => '',
        ],
    ],

    'chat' => [
        'blocked' => 'Kan inte skicka meddelanden till en användare som blockerar dig eller som du har blockerat.',
        'friends_only' => 'Användaren blockerar meddelanden från personer inte på sin vänlista.',
        'moderated' => '',
        'no_access' => 'Du har inte behörighet till denna kanal.',
        'restricted' => 'Du kan inte skicka meddelanden medan du är tystad, avstängd eller bannad.',
    ],

    'comment' => [
        'update' => [
            'deleted' => "Kan ej redigera raderade inlägg.",
        ],
    ],

    'contest' => [
        'voting_over' => 'Du kan inte ändra din röst efter att röstperioden för den här tävlingen har avslutas.',
    ],

    'forum' => [
        'moderate' => [
            'no_permission' => 'Inget tillstånd för att moderera detta forum.',
        ],

        'post' => [
            'delete' => [
                'only_last_post' => 'Endast sista inlägget kan raderas.',
                'locked' => 'Kan ej radera ett inlägg på en låst tråd.',
                'no_forum_access' => 'Åtkomst till begärt forum behövs.',
                'not_owner' => 'Endast trådskaparen kan radera inlägget.',
            ],

            'edit' => [
                'deleted' => 'Kan ej redigera raderat inlägg.',
                'locked' => 'Inlägget är låst för redigering.',
                'no_forum_access' => 'Åtkomst till begärt forum behövs.',
                'not_owner' => 'Endast trådskaparen kan redigera inlägget.',
                'topic_locked' => 'Kan ej redigera låst inlägg.',
            ],

            'store' => [
                'play_more' => 'Vänligen prova att spela spelet innan du postar på forumet! Om du har problem med att spela, skriv i Hjälp och Support-forumen.',
                'too_many_help_posts' => "Du behöver spela spelet mer innan du kan göra ytterligare inlägg. Om du fortfarande har problem med att spela spelet, maila support@ppy.sh", // FIXME: unhardcode email address.
            ],
        ],

        'topic' => [
            'reply' => [
                'double_post' => 'Vänligen redigera ditt senaste inlägg istället för att publicera ett inlägg igen.',
                'locked' => 'Kan ej svara på ett låst inlägg.',
                'no_forum_access' => 'Åtkomst till begärt forum behövs.',
                'no_permission' => 'Saknar behörighet för att svara.',

                'user' => [
                    'require_login' => 'Var vänlig logga in för att svara.',
                    'restricted' => "Kan ej svara när man är avstängd.",
                    'silenced' => "Kan ej svara när man är tystad.",
                ],
            ],

            'store' => [
                'no_forum_access' => 'Åtkomst till begärt forum behövs.',
                'no_permission' => 'Saknar behörighet för att skapa ny tråd.',
                'forum_closed' => 'Forum är stängd och kan inte lägga upp inlägg.',
            ],

            'vote' => [
                'no_forum_access' => 'Åtkomst till begärt forum behövs.',
                'over' => 'Röstningen är avslutad och kan inte röstas på längre.',
                'play_more' => '',
                'voted' => 'Ändra röst är ej tillåtet.',

                'user' => [
                    'require_login' => 'Var vänlig logga in för att rösta.',
                    'restricted' => "Kan ej rösta när man är avstängd.",
                    'silenced' => "Kan ej rösta när man är tystad.",
                ],
            ],

            'watch' => [
                'no_forum_access' => 'Åtkomst till begärt forum behövs.',
            ],
        ],

        'topic_cover' => [
            'edit' => [
                'uneditable' => 'Ogiltigt omslag specificerad.',
                'not_owner' => 'Endast trådskaparen kan redigera omslaget.',
            ],
            'store' => [
                'forum_not_allowed' => '',
            ],
        ],

        'view' => [
            'admin_only' => 'Endast administratörer kan se detta forum.',
        ],
    ],

    'user' => [
        'page' => [
            'edit' => [
                'locked' => 'Användar-sidan är låst.',
                'not_owner' => 'Kan endast redigera egen användar-sida.',
                'require_supporter_tag' => 'osu!supporter tag krävs.',
            ],
        ],
    ],
];
