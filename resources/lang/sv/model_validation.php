<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'invalid' => 'Ogiltigt :attribute specificerat.',
    'not_negative' => ':attribute kan inte vara negativt.',
    'required' => ':attribute behövs.',
    'too_long' => ':attribute överskred maximal längd - kan endast vara upp till :limit tecken.',
    'wrong_confirmation' => 'Bekräftelse matchar inte.',

    'beatmapset_discussion' => [
        'beatmap_missing' => 'Tidsstämpel är angiven men beatmap saknas.',
        'beatmapset_no_hype' => "Denna beatmap kan inte hypas.",
        'hype_requires_null_beatmap' => 'Hype måste göras i den allmänna (Alla svårighetsgrader) sektionen.',
        'invalid_beatmap_id' => 'Ogiltig svårighetgrad angiven.',
        'invalid_beatmapset_id' => 'Ogiltig beatmap angiven.',
        'locked' => 'Diskussion är låst.',

        'attributes' => [
            'message_type' => 'Typ av meddelande',
            'timestamp' => 'Tidpunkt',
        ],

        'hype' => [
            'discussion_locked' => "Denna beatmap är för närvarande låst för diskussion och kan inte hypas",
            'guest' => 'Måste vara inloggad för att hypa.',
            'hyped' => 'Du har redan hypat denna beatmap.',
            'limit_exceeded' => 'Du har redan använt all din hype.',
            'not_hypeable' => 'Den här beatmapen kan inte bli hypad',
            'owner' => 'Ingen hypning är tillåten på din egna beatmap.',
        ],

        'timestamp' => [
            'exceeds_beatmapset_length' => 'Angivna tidsstämpeln är bortom längden på beatmapen.',
            'negative' => "Tidsstämpel kan inte vara negativ.",
        ],
    ],

    'beatmapset_discussion_post' => [
        'discussion_locked' => 'Diskussionen är låst.',
        'first_post' => 'Kan inte radera startinlägget.',

        'attributes' => [
            'message' => 'Meddelandet',
        ],
    ],

    'comment' => [
        'deleted_parent' => 'Att svara på en raderad kommentar är inte tillåtet.',
        'top_only' => 'Fästa kommentarssvar är inte tillåtet.',

        'attributes' => [
            'message' => 'Meddelandet',
        ],
    ],

    'follow' => [
        'invalid' => 'Ogiltigt :attribute specificerat.',
    ],

    'forum' => [
        'feature_vote' => [
            'not_feature_topic' => 'Kan endast rösta på funktion begäran.',
            'not_enough_feature_votes' => 'Inte tillräckligt med röster.',
        ],

        'poll_vote' => [
            'invalid' => 'Ogiltligt val specificerat.',
        ],

        'post' => [
            'beatmapset_post_no_delete' => 'Radera beatmap metadata inlägg är inte tillåtet.',
            'beatmapset_post_no_edit' => 'Redigera beatmap metadata inlägg är inte tillåtet.',
            'first_post_no_delete' => 'Kan inte ta bort ursprungsinlägget',
            'missing_topic' => 'Inlägget saknar ämne',
            'only_quote' => 'Ditt svar innehåller bara en citat.',

            'attributes' => [
                'post_text' => 'Skicka kropp',
            ],
        ],

        'topic' => [
            'attributes' => [
                'topic_title' => 'Ämnets titel',
            ],
        ],

        'topic_poll' => [
            'duplicate_options' => 'Duplicerade val är ej tillåtet.',
            'grace_period_expired' => 'Kan inte redigera en enkät efter mer än :limit timmar.',
            'hiding_results_forever' => 'Kan inte dölja resultaten på en enkät som aldrig slutar.',
            'invalid_max_options' => 'Val per användare får inte överskrida antalet tillgängliga val.',
            'minimum_one_selection' => 'Minst ett val per användare krävs.',
            'minimum_two_options' => 'Behöver åtminstone två val.',
            'too_many_options' => 'Överskred max antal tillåtna val.',

            'attributes' => [
                'title' => 'Enkät titel',
            ],
        ],

        'topic_vote' => [
            'required' => 'Välj ett alternativ att rösta på.',
            'too_many' => 'Valde mer val än tillåtet.',
        ],
    ],

    'oauth' => [
        'client' => [
            'too_many' => 'Överskred maximalt antal tillåtna OAuth program.',
            'url' => 'Var vänlig och skriv in en giltig URL.',

            'attributes' => [
                'name' => 'Applikationsnamn',
                'redirect' => 'URL för appens uppringning',
            ],
        ],
    ],

    'user' => [
        'contains_username' => 'Lösenord får inte innehålla användarnamn.',
        'email_already_used' => 'E-postadress används redan.',
        'email_not_allowed' => 'E-postadress inte tillåten.',
        'invalid_country' => 'Land finns inte i databasen.',
        'invalid_discord' => 'Discordanvändarnamn ogiltigt.',
        'invalid_email' => "Verkar inte som att det är en giltig e-postadress.",
        'invalid_twitter' => 'Twitteranvändarnamn ogiltigt.',
        'too_short' => 'Det nya lösenordet är för kort.',
        'unknown_duplicate' => 'Användarnamn eller e-postadress används redan.',
        'username_available_in' => 'Detta användarnamn kommer att vara tillgängligt att använda om :duration.',
        'username_available_soon' => 'Detta användarnamn kommer att bli tillgängligt vilken minut som helst!',
        'username_invalid_characters' => 'Det begärda användarnamnet innehåller ogiltiga tecken.',
        'username_in_use' => 'Användarnamnet används redan!',
        'username_locked' => 'Användarnamnet används redan!', // TODO: language for this should be slightly different.
        'username_no_space_userscore_mix' => 'Använd antingen understreck eller blanksteg, inte båda!',
        'username_no_spaces' => "Användarnamn kan inte börja eller sluta med blanksteg!",
        'username_not_allowed' => 'Det valda användarnamnet är inte tillåtet.',
        'username_too_short' => 'Det valda användarnamnet är för kort.',
        'username_too_long' => 'Det valda användarnamnet är för långt.',
        'weak' => 'Svartlistat lösenord.',
        'wrong_current_password' => 'Nuvarande lösenord är inkorrekt.',
        'wrong_email_confirmation' => 'Emailbekräftelse matchar inte.',
        'wrong_password_confirmation' => 'Lösenordsbekräftelse matchar inte.',
        'too_long' => 'Överskred maxlängd - kan endast vara upp till :limit karaktärer.',

        'attributes' => [
            'username' => 'Användarnamn',
            'user_email' => 'E-postadress',
            'password' => 'Lösenord',
        ],

        'change_username' => [
            'restricted' => 'Du kan inte ändra ditt användarnamn när det är begränsat.',
            'supporter_required' => [
                '_' => 'Du måste :link för att byta ditt användarnamn!',
                'link_text' => 'stödja osu!',
            ],
            'username_is_same' => 'Detta är redan ditt användarnamn, dumbom!',
        ],
    ],

    'user_report' => [
        'reason_not_valid' => ':reason är inte giltigt för denna anmälningstyp.',
        'self' => "Du kan inte anmäla dig själv!",
    ],

    'store' => [
        'order_item' => [
            'attributes' => [
                'quantity' => 'Antal',
                'cost' => 'Kostnad',
            ],
        ],
    ],
];
