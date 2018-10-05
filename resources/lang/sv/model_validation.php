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
    'not_negative' => ':attribute kan inte vara negativt.',
    'required' => ':attribute behövs.',
    'too_long' => ':attribute överskred maximal längd - kan endast vara upp till :limit tecken.',
    'wrong_confirmation' => 'Bekräftelse matchar inte.',

    'beatmap_discussion_post' => [
        'discussion_locked' => 'Diskussion är låst.',
        'first_post' => 'Kan inte radera ursprungs inlägg.',
    ],

    'beatmapset_discussion' => [
        'beatmap_missing' => 'Tidsstämpel är angiven men beatmap saknas.',
        'beatmapset_no_hype' => "Denna beatmap kan inte hypas.",
        'hype_requires_null_beatmap' => 'Hype måste göras i den allmänna (Alla svårighetsgrader) sektionen.',
        'invalid_beatmap_id' => 'Ogiltig svårighetgrad angiven.',
        'invalid_beatmapset_id' => 'Ogiltig beatmap angiven.',
        'locked' => 'Diskussion är låst.',

        'hype' => [
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
        ],

        'topic_poll' => [
            'duplicate_options' => 'Duplicerade val är ej tillåtet.',
            'invalid_max_options' => 'Val per användare får inte överskrida antalet tillgängliga val.',
            'minimum_one_selection' => 'Minst ett val per användare krävs.',
            'minimum_two_options' => 'Behöver åtminstone två val.',
            'too_many_options' => 'Överskred max antal tillåtna val.',
        ],

        'topic_vote' => [
            'required' => 'Välj ett alternativ att rösta på.',
            'too_many' => 'Valde mer val än tillåtet.',
        ],
    ],

    'user' => [
        'contains_username' => 'Lösenord får inte innehålla användarnamn.',
        'email_already_used' => 'E-postadress används redan.',
        'invalid_country' => 'Land finns inte i databasen.',
        'invalid_discord' => 'Discordanvändarnamn ogiltigt.',
        'invalid_email' => "Verkar inte som att det är en giltig e-postadress.",
        'too_short' => 'Det nya lösenordet är för kort.',
        'unknown_duplicate' => 'Användarnamn eller e-postadress används redan.',
        'username_available_in' => 'Detta användarnamn kommer att vara tillgängligt att använda om :duration.',
        'username_available_soon' => 'Detta användarnamn kommer att bli tillgängligt vilken minut som helst!',
        'username_invalid_characters' => 'Det begärda användarnamnet innehåller ogiltiga tecken.',
        'username_in_use' => 'Användarnamnet används redan!',
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

        'change_username' => [
            'supporter_required' => [
                '_' => 'Du måste ha :link för att byta ditt användarnamn!',
                'link_text' => 'stödjer osu!',
            ],
            'username_is_same' => 'Detta är redan ditt användarnamn, dumbom!',
        ],
    ],
];
