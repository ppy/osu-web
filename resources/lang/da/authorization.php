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
            'is_hype' => 'Kan ikke ophæve hyping.',
            'has_reply' => 'Kan ikke slette en diskussion med svar',
        ],
        'nominate' => [
            'exhausted' => 'Du har nået dit maksimale antal nomineringer i dag, prøv igen i morgen!',
        ],
        'resolve' => [
            'not_owner' => 'Kun trådens person af oprindelse og beatmap ejer kan løse en diskussion.',
        ],

        'vote' => [
            'limit_exceeded' => 'Vent venligst et stykke tid med at stemme igen.',
            'owner' => 'Du kan ikke stemme på din egen diskussion!',
        ],
    ],

    'beatmap_discussion_post' => [
        'edit' => [
            'system_generated' => 'Automatisk genererede opslag kan ikke slettes.',
            'not_owner' => 'Kun ejeren af dette opslag kan ændre det.',
        ],
    ],

    'chat' => [
        'channel' => [
            'read' => [
                'no_access' => 'Adgang til den anmodede kanal er nægtet.',
            ],
        ],
        'message' => [
            'send' => [
                'channel' => [
                    'no_access' => 'Adgang til den anmodede kanal er nødvendig.',
                    'moderated' => 'Kanal er i øjeblikket modereret.',
                    'not_lazer' => 'Du kan i øjeblikket kun tale i #lazer.',
                ],

                'not_allowed' => 'Kan ikke sende besked når bannet/begrænset/mutet.',
            ],
        ],
    ],

    'contest' => [
        'voting_over' => 'Du kan ikke ændre din stemme efter stemmeperioden for denne konkurrence er slut.',
    ],

    'forum' => [
        'post' => [
            'delete' => [
                'only_last_post' => 'Kun sidste opslag kan blive slettet.',
                'locked' => 'Kan ikke slette opslag fra låste emner.',
                'no_forum_access' => 'Adgang til det anmodede forum er nødvendig.',
                'not_owner' => 'Kun ejeren af dette opslag kan slette opslaget.',
            ],

            'edit' => [
                'deleted' => 'Kan ikke ændre slettet opslag',
                'locked' => 'Dette opslag er låst fra at blive redigeret.',
                'no_forum_access' => 'Adgang til det anmodede forum er nødvendig.',
                'not_owner' => 'Kun ejeren af dette opslag kan slette opslaget.',
                'topic_locked' => 'Kan ikke slette opslag fra låste emner.',
            ],
        ],

        'topic' => [
            'reply' => [
                'double_post' => 'Du har lige slået dette op! Vent et stykke tid, eller rediger dit seneste opslag.',
                'locked' => 'Kan ikke svare til en låst tråd.',
                'no_forum_access' => 'Adgang til det anmodede forum er nødvendig.',
                'no_permission' => 'Du har ikke tilladelse til at svare.',

                'user' => [
                    'require_login' => 'Log venligst ind for at svare.',
                    'restricted' => 'Du kan ikke svare, når du er begrænset.',
                    'silenced' => 'Du kan ikke svare, når dui er mutet.',
                ],
            ],

            'store' => [
                'no_forum_access' => 'Adgang til det anmodede forum er nødvendig.',
                'no_permission' => 'Du har ikke tilladelse til at lave et nyt emne.',
                'forum_closed' => 'Forummet er lukket og intet kan blive slået op.',
            ],

            'vote' => [
                'no_forum_access' => 'Adgang til det anmodede forum er nødvendig.',
                'over' => 'Stemmeafgivningen er slut og kan ikke stemmes på længere.',
                'voted' => 'Det er ikke tilladt at ændre stemme.',

                'user' => [
                    'require_login' => 'Log venligst ind for at stemme.',
                    'restricted' => 'Du kan ikke stemme, når du er begrænset.',
                    'silenced' => 'Du kan ikke stemme, når du er mutet.',
                ],
            ],

            'watch' => [
                'no_forum_access' => 'Adgang til det anmodede forum er nødvendig.',
            ],
        ],

        'topic_cover' => [
            'edit' => [
                'uneditable' => 'Ugyldigt cover valgt.',
                'not_owner' => 'Kun ejeren kan redigere dette cover.',
            ],
        ],

        'view' => [
            'admin_only' => 'Kun administratorer kan se dette forum.',
        ],
    ],

    'require_login' => 'Log venligst ind for at fortsætte.',

    'unauthorized' => 'Adgang nægtet.',

    'silenced' => 'Det kan du ikke gøre, når du er mutet.',

    'restricted' => 'Det kan du ikke gøre, når du er begrænset.',

    'user' => [
        'page' => [
            'edit' => [
                'locked' => 'Brugerside er låst.',
                'not_owner' => 'Du kan kun ændre din egen brugerside.',
                'require_supporter_tag' => 'Supporter tag er nødvendigt.',
            ],
        ],
    ],
];
