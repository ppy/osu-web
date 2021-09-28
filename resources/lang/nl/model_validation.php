<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'invalid' => 'Ongeldig :attribute opgegeven.',
    'not_negative' => ':attribute kan niet negatief zijn.',
    'required' => ':attribute is nodig.',
    'too_long' => ':attribute heeft de maximum lengte overschreden - kan enkel tot :limit karakters gebruiken.',
    'wrong_confirmation' => 'Bevestiging komt niet overeen.',

    'beatmapset_discussion' => [
        'beatmap_missing' => 'Tijdstip is opgegeven, maar beatmap ontbreekt.',
        'beatmapset_no_hype' => "Beatmap kan niet worden gehyped.",
        'hype_requires_null_beatmap' => 'Hype moet gebeuren in de General afdeling (alle moeilijkheidsgraden).',
        'invalid_beatmap_id' => 'Ongeldige moeilijkheidsgraad opgegeven.',
        'invalid_beatmapset_id' => 'Ongeldige beatmap opgegeven.',
        'locked' => 'Discussie is vergrendeld.',

        'attributes' => [
            'message_type' => 'Berichttype',
            'timestamp' => 'Timestamp',
        ],

        'hype' => [
            'discussion_locked' => "Deze beatmap is momenteel vergrendeld voor discussie en kan niet gehyped worden",
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

    'beatmapset_discussion_post' => [
        'discussion_locked' => 'Discussie is vergrendeld.',
        'first_post' => 'Kan startbericht niet verwijderen.',

        'attributes' => [
            'message' => 'Het bericht',
        ],
    ],

    'comment' => [
        'deleted_parent' => 'Op een verwijderde comment reageren is niet toegestaan.',
        'top_only' => 'Het pinnen van een antwoord op een reactie is niet toegestaan.',

        'attributes' => [
            'message' => 'Het bericht',
        ],
    ],

    'follow' => [
        'invalid' => 'Ongeldig :attribute opgegeven.',
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
            'first_post_no_delete' => 'Kan bericht niet verwijderen',
            'missing_topic' => 'Bericht ontbreekt onderwerp',
            'only_quote' => 'Uw antwoord bevat slechts een citaat.',

            'attributes' => [
                'post_text' => 'Post body',
            ],
        ],

        'topic' => [
            'attributes' => [
                'topic_title' => 'Onderwerptitel',
            ],
        ],

        'topic_poll' => [
            'duplicate_options' => 'Een optie dupliceren is niet toegestaan.',
            'grace_period_expired' => 'Kan een poll niet bewerken na meer dan :limit uren.',
            'hiding_results_forever' => 'Kan resultaten van een poll die nooit eindigt niet verbergen.',
            'invalid_max_options' => 'Opties per gebruiker mag niet groter zijn dan het aantal opties.',
            'minimum_one_selection' => 'Minstens een optie per gebruiker is vereist.',
            'minimum_two_options' => 'Moet ten minste twee opties hebben.',
            'too_many_options' => 'Maximum aantal opties overschreden.',

            'attributes' => [
                'title' => 'Poll titel',
            ],
        ],

        'topic_vote' => [
            'required' => 'Selecteer een optie om te stemmen.',
            'too_many' => 'Meer opties selecteren is niet toegestaan.',
        ],
    ],

    'oauth' => [
        'client' => [
            'too_many' => 'Het maximum aantal toegestane OAuth toepassingen is overschreden.',
            'url' => 'Voer een geldige URL in.',

            'attributes' => [
                'name' => 'Applicatienaam',
                'redirect' => 'Applicatie Terugbel URL',
            ],
        ],
    ],

    'user' => [
        'contains_username' => 'Wachtwoorden mogen je gebruikersnaam niet bevatten.',
        'email_already_used' => 'Dit e-mailadres is al in gebruik.',
        'email_not_allowed' => 'E-mailadres niet toegestaan.',
        'invalid_country' => 'Land niet in de database.',
        'invalid_discord' => 'Discord gebruikersnaam is ongeldig.',
        'invalid_email' => "Dit lijkt niet een geldig e-mailadres te zijn.",
        'invalid_twitter' => 'Twitter gebruikersnaam ongeldig.',
        'too_short' => 'Nieuw wachtwoord is te kort.',
        'unknown_duplicate' => 'Gebruikersnaam of e-mailadres is al in gebruik.',
        'username_available_in' => 'Deze gebruikersnaam zal over :duration beschikbaar zijn.',
        'username_available_soon' => 'Deze gebruikersnaam kan elk moment beschikbaar worden!',
        'username_invalid_characters' => 'De opgevraagde gebruikersnaam bevat ongeldige tekens.',
        'username_in_use' => 'Gebruikersnaam is al in gebruik!',
        'username_locked' => 'Gebruikersnaam is al in gebruik!', // TODO: language for this should be slightly different.
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

        'attributes' => [
            'username' => 'Gebruikersnaam',
            'user_email' => 'E-mailadres',
            'password' => 'Wachtwoord',
        ],

        'change_username' => [
            'restricted' => 'Je kan je gebruikersnaam niet wijzigen terwijl je restricted bent.',
            'supporter_required' => [
                '_' => 'Je moet :link hebben om je naam te veranderen!',
                'link_text' => 'support osu!',
            ],
            'username_is_same' => 'Dit is je gebruikersnaam al, dommerik!',
        ],
    ],

    'user_report' => [
        'no_ranked_beatmapset' => '',
        'reason_not_valid' => ':reason is niet geldig voor dit rapporttype.',
        'self' => "Je kunt jezelf niet rapporteren!",
    ],

    'store' => [
        'order_item' => [
            'attributes' => [
                'quantity' => 'Hoeveelheid',
                'cost' => 'Kosten',
            ],
        ],
    ],
];
