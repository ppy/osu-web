<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'play_more' => 'Vad sägs om att spela lite osu! istället?',
    'require_login' => 'Var vänlig logga in för att fortsätta.',
    'require_verification' => 'Vänligen verifiera för att fortsätta.',
    'restricted' => "Kan ej göra det när du är begränsad.",
    'silenced' => "Kan ej göra det när man är tystad.",
    'unauthorized' => 'Åtkomst nekad.',

    'beatmap_discussion' => [
        'destroy' => [
            'is_hype' => 'Kan inte ångra hyping.',
            'has_reply' => 'Kan inte radera en diskussion med svar',
        ],
        'nominate' => [
            'exhausted' => 'Du har uppnått din nomineringsgräns för idag, var god försök igen imorgon.',
            'incorrect_state' => 'Ett fel uppstod, försök att uppdatera sidan.',
            'owner' => "Kan ej nominera sin egna beatmap.",
            'set_metadata' => 'Du måste ange genren och språket innan du nominerar.',
        ],
        'resolve' => [
            'not_owner' => 'Endast trådskaparen eller beatmap-ägare kan lösa en diskussion.',
        ],

        'store' => [
            'mapper_note_wrong_user' => 'Endast beatmap-ägaren eller en väljar/NAT-gruppmedlem kan publicera mapparens anteckningar.',
        ],

        'vote' => [
            'bot' => "Kan inte rösta på diskussion gjord av bot",
            'limit_exceeded' => 'Var god vänta innan du lägger fler röster',
            'owner' => "Kan inte rösta på din egen diskussion!",
            'wrong_beatmapset_state' => 'Kan endast rösta på diskussioner för väntande beatmaps.',
        ],
    ],

    'beatmap_discussion_post' => [
        'destroy' => [
            'not_owner' => 'Du kan bara ta bort dina egna inlägg.',
            'resolved' => 'Du kan inte radera ett inlägg i en löst diskussion.',
            'system_generated' => 'Automatiskt genererade inlägg kan inte tas bort.',
        ],

        'edit' => [
            'not_owner' => 'Endast den som lade upp inlägget kan redigera inlägget.',
            'resolved' => 'Du kan inte redigera ett inlägg i en löst diskussion.',
            'system_generated' => 'Automatiskt genererade inlägg kan inte redigeras.',
        ],

        'store' => [
            'beatmapset_locked' => 'Denna beatmap är låst för diskussion.',
        ],
    ],

    'beatmapset' => [
        'metadata' => [
            'nominated' => 'Du kan inte ändra metadata för en nominerad beatmap. Kontakta en BN eller NAT-medlem om du tror att det är felaktigt inställt.',
        ],
    ],

    'chat' => [
        'blocked' => 'Kan inte skicka meddelanden till en användare som blockerar dig eller som du har blockerat.',
        'friends_only' => 'Användaren blockerar meddelanden från personer som inte finns på sin vänlista.',
        'moderated' => 'Den kanalen är för närvarande modererad.',
        'no_access' => 'Du har ingen behörighet till denna kanalen.',
        'restricted' => 'Du kan inte skicka meddelanden medan du är tystad, begränsad eller bannad.',
        'silenced' => 'Du kan inte skicka meddelanden medan du är tystad, begränsad eller bannad.',
    ],

    'comment' => [
        'update' => [
            'deleted' => "Kan ej redigera raderade inlägg.",
        ],
    ],

    'contest' => [
        'voting_over' => 'Du kan inte ändra din röst efter att röstperioden för den här tävlingen har avslutas.',

        'entry' => [
            'limit_reached' => 'Du har uppnått max antal bidrag i denna tävling',
            'over' => 'Tack för era bidrag! Möjligheten att lägga till bidrag har stängt och röstning kommer öppnas snart.',
        ],
    ],

    'forum' => [
        'moderate' => [
            'no_permission' => 'Inget tillstånd för att moderera detta forum.',
        ],

        'post' => [
            'delete' => [
                'only_last_post' => 'Endast sista inlägget kan raderas.',
                'locked' => 'Kan ej radera ett inlägg på ett låst ämne.',
                'no_forum_access' => 'Åtkomst till begärt forum behövs.',
                'not_owner' => 'Endast avsändaren kan radera inlägget.',
            ],

            'edit' => [
                'deleted' => 'Kan ej redigera borttagna inlägg.',
                'locked' => 'Inlägget är låst för redigering.',
                'no_forum_access' => 'Åtkomst till begärt forum behövs.',
                'not_owner' => 'Endast avsändaren kan redigera inlägget.',
                'topic_locked' => 'Kan ej redigera inlägg med ett låst ämne.',
            ],

            'store' => [
                'play_more' => 'Vänligen prova att spela spelet innan du skickar ett inlägg på forumet! Om du har problem med att spela, skriv i Hjälp och Support-forumen.',
                'too_many_help_posts' => "Du behöver spela spelet mer innan du kan skicka fler inlägg. Om du fortfarande har problem med att spela spelet, mejla support@ppy.sh", // FIXME: unhardcode email address.
            ],
        ],

        'topic' => [
            'reply' => [
                'double_post' => 'Vänligen redigera ditt senaste inlägg istället för att skicka ett inlägg till.',
                'locked' => 'Kan ej svara på ett låst inlägg.',
                'no_forum_access' => 'Åtkomst till begärt forum behövs.',
                'no_permission' => 'Saknar behörighet för att svara.',

                'user' => [
                    'require_login' => 'Var vänlig logga in för att svara.',
                    'restricted' => "Kan ej svara när du är begränsad.",
                    'silenced' => "Kan ej svara när du är tystad.",
                ],
            ],

            'store' => [
                'no_forum_access' => 'Åtkomst till begärt forum behövs.',
                'no_permission' => 'Saknar behörighet för att kunna skapa ny tråd.',
                'forum_closed' => 'Forumet är stängd och kan inte skickas till.',
            ],

            'vote' => [
                'no_forum_access' => 'Åtkomst till begärt forum behövs.',
                'over' => 'Röstningen är avslutad och kan inte röstas på längre.',
                'play_more' => 'Du måste spela mer innan du röstar på forumet.',
                'voted' => 'Ändra röst är ej tillåtet.',

                'user' => [
                    'require_login' => 'Var vänlig logga in för att kunna rösta.',
                    'restricted' => "Kan ej rösta när man är begränsad.",
                    'silenced' => "Kan ej rösta när du är tystad.",
                ],
            ],

            'watch' => [
                'no_forum_access' => 'Åtkomst till begärd forum behövs.',
            ],
        ],

        'topic_cover' => [
            'edit' => [
                'uneditable' => 'Ogiltigt omslag specificerades.',
                'not_owner' => 'Endast ägaren kan redigera omslaget.',
            ],
            'store' => [
                'forum_not_allowed' => 'Detta forum accepterar inte ämnesomslag.',
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
                'not_owner' => 'Kan endast redigera sin egna användar-sida.',
                'require_supporter_tag' => 'osu!supporter tagg krävs.',
            ],
        ],
    ],
];
