<?php

/**
 *    Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
 *    See the LICENCE file in the repository root for full licence text.
 */

return [
    'beatmap_discussion' => [
        'destroy' => [
            'is_hype' => 'Kan ikke ophæve hyping.',
            'has_reply' => 'Kan ikke slette en diskussion med svar',
        ],
        'nominate' => [
            'exhausted' => 'Du har nået dit maksimale antal nomineringer i dag, prøv igen i morgen!',
            'full_bn_required' => 'Du skal være en fuld nominator for at kunne udføre denne kvalificerende nominering.',
            'full_bn_required_hybrid' => 'Du skal være en fuld nominator for at kunne nominere beatmap sæt med mere end en spiltilstand.',
            'incorrect_state' => 'Fejl i udføringen af handlingen, prøv at genindlæse siden.',
            'owner' => "Kan ikke nominere din egen beatmap.",
        ],
        'resolve' => [
            'not_owner' => 'Kun den oprindlige ejer af tråden og beatmap ejeren kan løse en diskussion.',
        ],

        'store' => [
            'mapper_note_wrong_user' => 'Kun ejeren af dette beatmap eller en nominator/QAT group member kan sende map notes.',
        ],

        'vote' => [
            'limit_exceeded' => 'Vent venligst et stykke tid med at stemme igen.',
            'owner' => "Du kan ikke stemme på din egen diskussion!",
            'wrong_beatmapset_state' => 'Kan kun stemme på diskussioner hvis beatmappen er i Afventende.',
        ],
    ],

    'beatmap_discussion_post' => [
        'destroy' => [
            'not_owner' => '',
            'resolved' => '',
            'system_generated' => '',
        ],

        'edit' => [
            'not_owner' => 'Kun ejeren af dette opslag kan redigere det.',
            'resolved' => '',
            'system_generated' => 'Automatisk genererede opslag kan ikke redigeres.',
        ],

        'store' => [
            'beatmapset_locked' => 'Dette beatmap er låst for diskussion.',
        ],
    ],

    'chat' => [
        'blocked' => 'Du kan ikke sende denne besked, enten har brugeren blokeret dig eller du har blokeret brugeren.',
        'friends_only' => 'Brugeren blokere beskeder fra folk der ikke er på deres venneliste.',
        'moderated' => 'Denne kanal er i øjeblikket modereret.',
        'no_access' => 'Du har ikke adgang til denne kanal.',
        'restricted' => 'Du kan ikke sende beskeder nå du er muted eller banned.',
    ],

    'comment' => [
        'update' => [
            'deleted' => "Kan ikke redigere slettede opslag.",
        ],
    ],

    'contest' => [
        'voting_over' => 'Du kan ikke ændre din stemme efter stemmeperioden for denne konkurrence er slut.',
    ],

    'forum' => [
        'moderate' => [
            'no_permission' => 'Ingen tilladelse til at moderere dette forum.',
        ],

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
                'double_post' => 'Rediger din seneste besked i stedet for at lave en ny.',
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
                'play_more' => 'Du skal spille mere før du stemmer på forum.',
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
            'store' => [
                'forum_not_allowed' => 'Dette forum accepterer ikke emne coverbilleder.',
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
                'require_supporter_tag' => 'osu!supporter tag er påkrævet.',
            ],
        ],
    ],
];
