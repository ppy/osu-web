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
        'first_post' => 'Je kan de startpost niet verwijderen.',
    ],

    'beatmapset_discussion' => [
        'beatmap_missing' => 'Tijdstip is opgegeven, maar beatmap ontbreekt.',
        'beatmapset_no_hype' => "Beatmap kan niet worden gehyped.",
        'hype_requires_null_beatmap' => 'Hype moet gebeuren in de General afdeling (alle moeilijkheidsgraden).',
        'invalid_beatmap_id' => 'Ongeldige moeilijkheidsgraad opgegeven.',
        'invalid_beatmapset_id' => 'Ongeldige beatmap opgegeven.',
        'locked' => 'Discussie is vergrendeld.',

        'hype' => [
            'guest' => 'He moet ingelogd zijn om te hypen.',
            'hyped' => 'Je hebt deze beatmap al gehyped.',
            'limit_exceeded' => 'Je hebt all je hype opgebruikt.',
            'not_hypeable' => 'Deze beatmap kan niet gehyped worden',
            'owner' => 'Je kan je eigen beatmap niet hypen!',
        ],

        'timestamp' => [
            'exceeds_beatmapset_length' => 'Opgegeven tijdstip is later dan het einde van de beatmap.',
            'negative' => "Tijdstip kan niet negatief zijn.",
        ],
    ],

    'forum' => [
        'feature_vote' => [
            'not_feature_topic' => 'Kan alleen maar stemmen op een feature aanvraag.',
            'not_enough_feature_votes' => 'Niet genoeg stemmen.',
        ],

        'poll_vote' => [
            'invalid' => 'Ongeldige optie opgegeven.',
        ],

        'post' => [
            'beatmapset_post_no_delete' => 'Beatmap metadata post verwijderen is niet toegestaan.',
            'beatmapset_post_no_edit' => 'Beatmap metadata post bewerken is niet toegestaan.',
        ],

        'topic_poll' => [
            'duplicate_options' => 'Een optie dupliceren is niet toegestaan.',
            'invalid_max_options' => 'Opties per gebruiker mag niet groter zijn dan het aantal opties.',
            'minimum_one_selection' => 'Minstens een optie per gebruiker is vereist.',
            'minimum_two_options' => 'Moet ten minste twee opties hebben.',
            'too_many_options' => 'Maximum aantal opties overschreden.',
        ],

        'topic_vote' => [
            'required' => 'Selecteer een optie om te stemmen.',
            'too_many' => 'Meer opties selecteren is niet toegestaan.',
        ],
    ],

    'user' => [
        'contains_username' => 'Wachtwoorden mogen je gebruikersnaam niet bevatten.',
        'email_already_used' => 'Dit e-mailadres is al in gebruik.',
        'invalid_country' => 'Land niet in de database.',
        'invalid_discord' => 'Discord gebruikersnaam is ongeldig.',
        'invalid_email' => "Dit lijkt niet een geldig e-mailadres te zijn.",
        'too_short' => 'Nieuw wachtwoord is te kort.',
        'unknown_duplicate' => 'Gebruikersnaam of e-mailadres is al in gebruik.',
        'username_available_in' => 'Deze gebruikersnaam zal over :duration beschikbaar zijn.',
        'username_available_soon' => 'Deze gebruikersnaam kan elk moment beschikbaar worden!',
        'username_invalid_characters' => 'De opgevraagde gebruikersnaam bevat ongeldige tekens.',
        'username_in_use' => 'Gebruikersnaam is al in gebruik!',
        'username_no_space_userscore_mix' => 'Gebruik oftewel underscores of spaties, niet beide!',
        'username_no_spaces' => "Gebruikersnaam kan niet beginnen of eindigen met spaties!",
        'username_not_allowed' => 'Deze gebruikersnaam is niet toegestaan.',
        'username_too_short' => 'De aangevraagde gebruikersnaam is te kort.',
        'username_too_long' => 'De aangevraagde gebruikersnaam is te lang.',
        'weak' => 'Wachtwoord staat op de zwarte lijst.',
        'wrong_current_password' => 'Dit wachtwoord is onjuist.',
        'wrong_email_confirmation' => 'Email bevestiging komt niet overeen.',
        'wrong_password_confirmation' => 'Wachtwoord bevestiging komt niet overeen.',
        'too_long' => 'Maximum lengte overschreden - kan enkel tot :limit karakters zijn.',

        'change_username' => [
            'supporter_required' => [
                '_' => 'Je moet :link hebben om je naam te veranderen!',
                'link_text' => 'support osu!',
            ],
            'username_is_same' => 'Dit is je gebruikersnaam al, dommerik!',
        ],
    ],
];
