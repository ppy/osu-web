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
    'not_negative' => ':attribute kan niet negatief zijn.',
    'required' => ':attribute is nodig.',
    'too_long' => ':attribute heeft de maximum lengte overschreden - kan enkel tot :limit karakters gebruiken.',
    'wrong_confirmation' => 'Bevestiging komt niet overeen.',

    'beatmap_discussion_post' => [
        'discussion_locked' => 'Discussie is vergrendeld.',
        'first_post' => '',
    ],

    'beatmapset_discussion' => [
        'beatmap_missing' => '',
        'beatmapset_no_hype' => "",
        'hype_requires_null_beatmap' => '',
        'invalid_beatmap_id' => '',
        'invalid_beatmapset_id' => '',
        'locked' => 'Discussie is vergrendeld.',
        'mapper_note_wrong_user' => '',

        'hype' => [
            'guest' => '',
            'hyped' => '',
            'limit_exceeded' => '',
            'not_hypeable' => '',
            'owner' => '',
        ],

        'timestamp' => [
            'exceeds_beatmapset_length' => '',
            'negative' => "",
        ],
    ],

    'forum' => [
        'feature_vote' => [
            'not_feature_topic' => 'Kan alleen maar stemmen op een feature aanvraag.',
            'not_enough_feature_votes' => 'Niet genoeg stemmen.',
        ],

        'poll_vote' => [
            'invalid' => '',
        ],

        'post' => [
            'beatmapset_post_no_delete' => '',
            'beatmapset_post_no_edit' => '',
        ],

        'topic_poll' => [
            'duplicate_options' => '',
            'invalid_max_options' => '',
            'minimum_one_selection' => '',
            'minimum_two_options' => 'Moet ten minste twee opties hebben.',
            'too_many_options' => '',
        ],

        'topic_vote' => [
            'required' => 'Selecteer een optie om te stemmen.',
            'too_many' => 'Meer opties selecteren is niet toegestaan.',
        ],
    ],

    'user' => [
        'contains_username' => '',
        'email_already_used' => 'Dit e-mailadres is al in gebruik.',
        'invalid_country' => '',
        'invalid_discord' => 'Discord gebruikersnaam is ongeldig.',
        'invalid_email' => "",
        'too_short' => 'Nieuw wachtwoord is te kort.',
        'unknown_duplicate' => 'Gebruikersnaam of e-mailadres is al in gebruik.',
        'username_available_in' => 'Deze gebruikersnaam zal over :duration beschikbaar zijn.',
        'username_available_soon' => 'Deze gebruikersnaam kan elk moment beschikbaar worden!',
        'username_invalid_characters' => '',
        'username_in_use' => 'Gebruikersnaam is al in gebruik!',
        'username_no_space_userscore_mix' => '',
        'username_no_spaces' => "",
        'username_not_allowed' => 'Deze gebruikersnaam is niet toegestaan.',
        'username_too_short' => '',
        'username_too_long' => '',
        'weak' => '',
        'wrong_current_password' => '',
        'wrong_email_confirmation' => '',
        'wrong_password_confirmation' => '',
        'too_long' => '',

        'change_username' => [
            'supporter_required' => [
                '_' => 'Je moet :link hebben om je naam te veranderen!',
                'link_text' => '',
            ],
            'username_is_same' => '',
        ],
    ],
];
