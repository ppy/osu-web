<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'play_more' => 'Hvad med at spille nogle osu! i stedet?',
    'require_login' => 'Log venligst ind for at fortsætte.',
    'require_verification' => 'Verificer venligst for at fortsætte.',
    'restricted' => "Det kan du ikke gøre, når du er tilbageholdt.",
    'silenced' => "Det kan du ikke gøre, når du er mutet.",
    'unauthorized' => 'Adgang nægtet.',

    'beatmap_discussion' => [
        'destroy' => [
            'is_hype' => 'Kan ikke fortryde hyping.',
            'has_reply' => 'Kan ikke slette en diskussion med svar',
        ],
        'nominate' => [
            'exhausted' => 'Du har nået dit maksimale antal nomineringer i dag, prøv igen i morgen!',
            'incorrect_state' => 'Fejl i udføringen af handlingen, prøv at genindlæse siden.',
            'owner' => "Kan ikke nominere din egen beatmap.",
            'set_metadata' => 'Du skal vælge genren og sproget, før du nominerer.',
        ],
        'resolve' => [
            'not_owner' => 'Kun den oprindelige ejer af tråden og beatmap-ejeren kan løse en diskussion.',
        ],

        'store' => [
            'mapper_note_wrong_user' => 'Kun ejeren af dette beatmap eller en nominator/NAT-medlem kan lave notes opslag.',
        ],

        'vote' => [
            'bot' => "Kan ikke stemme på diskussion lavet af bot",
            'limit_exceeded' => 'Vent venligst før du stemmer igen',
            'owner' => "Du kan ikke stemme på din egen diskussion!",
            'wrong_beatmapset_state' => 'Kan kun stemme på diskussioner fra afventende beatmaps.',
        ],
    ],

    'beatmap_discussion_post' => [
        'destroy' => [
            'not_owner' => 'Du kan kun slette dine egne opslag.',
            'resolved' => 'Du kan ikke slette et opslag fra en løst diskussion.',
            'system_generated' => 'Automatisk genererede oplsag kan ikke slettes.',
        ],

        'edit' => [
            'not_owner' => 'Kun ejeren af dette opslag kan redigere det.',
            'resolved' => 'Du kan ikke redigere et opslag fra en løst diskussion.',
            'system_generated' => 'Automatisk genererede opslag kan ikke redigeres.',
        ],

        'store' => [
            'beatmapset_locked' => 'Dette beatmap er låst for diskussion.',
        ],
    ],

    'beatmapset' => [
        'metadata' => [
            'nominated' => 'Du kan ikke ændre metadata for et nomineret map. Kontakt et BAT- eller NAT-medlem, hvis du mener, at det er angivet forkert.',
        ],
    ],

    'chat' => [
        'blocked' => 'Du kan ikke sende denne besked, enten har brugeren blokeret dig eller du har blokeret brugeren.',
        'friends_only' => 'Brugeren blokerer beskeder fra folk der ikke er på deres venneliste.',
        'moderated' => 'Denne kanal er i øjeblikket modereret.',
        'no_access' => 'Du har ikke adgang til denne kanal.',
        'restricted' => 'Du kan ikke sende beskeder når du er enten muted, begrænset eller banned.',
        'silenced' => 'Du kan ikke sende beskeder når du er enten muted, begrænset eller banned.',
    ],

    'comment' => [
        'update' => [
            'deleted' => "Kan ikke redigere slettede opslag.",
        ],
    ],

    'contest' => [
        'voting_over' => 'Du kan ikke ændre din stemme efter stemmeperioden for denne konkurrence er slut.',

        'entry' => [
            'limit_reached' => 'Du har nået dit maksimale antal bidrag for denne konkurrence',
            'over' => 'Tak for jeres bidrag! Indsendelsen for denne konkurrence er slut, og afstemning vil finde sted snarest!.',
        ],
    ],

    'forum' => [
        'moderate' => [
            'no_permission' => 'Ingen tilladelse til at moderere dette forum.',
        ],

        'post' => [
            'delete' => [
                'only_last_post' => 'Kun sidste opslag kan slettes.',
                'locked' => 'Kan ikke slette opslag fra låste emner.',
                'no_forum_access' => 'Adgang til det anmodede forum er nødvendigt.',
                'not_owner' => 'Kun ejeren af dette opslag kan slette det.',
            ],

            'edit' => [
                'deleted' => 'Kan ikke redigere slettede opslag.',
                'locked' => 'Dette opslag er låst fra at blive redigeret.',
                'no_forum_access' => 'Adgang til det anmodede forum er nødvendigt.',
                'not_owner' => 'Kun ejeren af dette opslag kan redigere det.',
                'topic_locked' => 'Kan ikke redigere opslag fra låste emner.',
            ],

            'store' => [
                'play_more' => 'Prøv at spille spillet før du skriver i forumet, tak! Hvis du har et problem med at få spillet op at køre, bedes du skrive i \'Hjælp og Support\' forumet.',
                'too_many_help_posts' => "Du skal spille mere, før du kan lave flere indlæg. Hvis du stadig har problemer med at få spillet op at køre, skal du sende en email til support@ppy.sh", // FIXME: unhardcode email address.
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
                'play_more' => 'Du skal spille mere før du kan stemme på forumet.',
                'voted' => 'Det er ikke tilladt at ændre din stemme.',

                'user' => [
                    'require_login' => 'Log venligst ind for at stemme.',
                    'restricted' => "Du kan ikke stemme, når du er begrænset.",
                    'silenced' => "Du kan ikke stemme, når du er mutet.",
                ],
            ],

            'watch' => [
                'no_forum_access' => 'Adgang til det anmodede forum er nødvendigt.',
            ],
        ],

        'topic_cover' => [
            'edit' => [
                'uneditable' => 'Ugyldigt cover-billede valgt.',
                'not_owner' => 'Kun ejeren kan redigere dette cover-billede.',
            ],
            'store' => [
                'forum_not_allowed' => 'Dette forum accepterer ikke emne-coverbilleder.',
            ],
        ],

        'view' => [
            'admin_only' => 'Kun administratorer kan se dette forum.',
        ],
    ],

    'user' => [
        'page' => [
            'edit' => [
                'locked' => 'Brugerside er låst.',
                'not_owner' => 'Du kan kun redigere din egen brugerside.',
                'require_supporter_tag' => 'osu!supporter tag er nødvendigt.',
            ],
        ],
    ],
];
