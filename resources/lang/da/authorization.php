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
            'is_hype' => 'Kan ikke ophæve hyping.',
            'has_reply' => 'Kan ikke slette en diskussion med svar',
        ],
        'nominate' => [
            'exhausted' => 'Du har nået dit maksimale antal nomineringer i dag, prøv igen i morgen!',
            'incorrect_state' => 'Fejl i udføringen af handlingen, prøv at genindlæse siden.',
            'owner' => "Kan ikke nominere din egen beatmap.",
        ],
        'resolve' => [
            'not_owner' => 'Kun den oprindlige ejer af tråden og beatmap ejeren kan løse en diskussion.',
        ],

        'store' => [
            'mapper_note_wrong_user' => '',
        ],

        'vote' => [
            'limit_exceeded' => 'Vent venligst et stykke tid med at stemme igen.',
            'owner' => "Du kan ikke stemme på din egen diskussion!",
            'wrong_beatmapset_state' => 'Kan kun stemme på diskussioner hvis beatmappen er i Afventende.',
        ],
    ],

    'beatmap_discussion_post' => [
        'edit' => [
            'system_generated' => 'Automatisk genererede opslag kan ikke redigeres.',
            'not_owner' => 'Kun ejeren af dette opslag kan redigere det.',
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

                'not_allowed' => 'Kan ikke sende besked imens du er bannet/begrænset/mutet.',
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
                'deleted' => 'Kan ikke redigere slettede opslag',
                'locked' => 'Dette opslag er låst fra at blive redigeret.',
                'no_forum_access' => 'Adgang til det anmodede forum er nødvendig.',
                'not_owner' => 'Kun ejeren af dette opslaget kan redigere opslaget.',
                'topic_locked' => 'Kan ikke redigere opslag fra låste emner.',
            ],

            'store' => [
                'play_more' => 'Prøv at spille spillet før du skriver i forumet, tak! Hvis du har et problem med at spille, bedes du skrive til Hjælp og Support forumet.',
                'too_many_help_posts' => "Du skal spille spillet mere, før du kan lave flere indlæg. Hvis du stadig har problemer med at spille spillet, skal du sende en email til support@ppy.sh", // FIXME: unhardcode email address.
            ],
        ],

        'topic' => [
            'reply' => [
                'double_post' => '',
                'locked' => 'Kan ikke svare en låst tråd.',
                'no_forum_access' => 'Adgang til det anmodede forum er nødvendig.',
                'no_permission' => 'Du har ikke tilladelse til at svare.',

                'user' => [
                    'require_login' => 'Log venligst ind for at svare.',
                    'restricted' => "Du kan ikke svare, når du er begrænset.",
                    'silenced' => "Du kan ikke svare, når du er mutet.",
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
                    'restricted' => "Du kan ikke stemme, når du er begrænset.",
                    'silenced' => "Du kan ikke stemme, når du er mutet.",
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

    'silenced' => "Det kan du ikke gøre, når du er mutet.",

    'restricted' => "Det kan du ikke gøre, når du er begrænset.",

    'user' => [
        'page' => [
            'edit' => [
                'locked' => 'Brugerside er låst.',
                'not_owner' => 'Du kan kun redigere din egen brugerside.',
                'require_supporter_tag' => '',
            ],
        ],
    ],
];
