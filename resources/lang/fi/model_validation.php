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
    'not_negative' => ':attribute ei voi olla negatiivinen.',
    'required' => ':attribute on pakollinen.',
    'too_long' => ':attribute ylittää maksimipituuden - voi ylimillään olla :limit merkkiä.',
    'wrong_confirmation' => 'Tarkistus ei täsmää.',

    'beatmap_discussion_post' => [
        'discussion_locked' => 'Keskustelu on lukittu.',
        'first_post' => 'Aloitusviestiä ei voi poistaa.',
    ],

    'beatmapset_discussion' => [
        'beatmap_missing' => 'Aikaleima on määritelty, mutta rytmikartta puuttuu.',
        'beatmapset_no_hype' => "Rytmikarttaa ei voi hypettää.",
        'hype_requires_null_beatmap' => 'Hypetys täytyy tehdä Yleiset -osiossa (kaikki vaikeusasteet).',
        'invalid_beatmap_id' => 'Virheellinen vaikeusaste määritelty.',
        'invalid_beatmapset_id' => 'Epäkelpo rytmikartta määritelty.',
        'locked' => 'Keskustelu on lukittu.',
        'mapper_note_wrong_user' => 'Vain rytmikartan omistaja voi lisätä kartoittajan muistiinpanoja.',

        'hype' => [
            'guest' => 'Sinun täytyy olla kirjautunut sisään jotta voit hypettää.',
            'hyped' => 'Olet jo hypettänyt tätä rytmikarttaa.',
            'limit_exceeded' => 'Olet käyttänyt kaiken hypesi.',
            'not_hypeable' => 'Tätä rytmikarttaa ei voi hypettää',
            'owner' => 'Ei omien rytmikarttojen hypettämistä.',
        ],

        'timestamp' => [
            'exceeds_beatmapset_length' => 'Määritelty aikaleima on rytmikartan pituuden ulkopuolella.',
            'negative' => "Aikaleima ei voi olla negatiivinen.",
        ],
    ],

    'forum' => [
        'feature_vote' => [
            'not_feature_topic' => '',
            'not_enough_feature_votes' => 'Ei tarpeeksi ääniä.',
        ],

        'poll_vote' => [
            'invalid' => '',
        ],

        'post' => [
            'beatmapset_post_no_delete' => 'Rytmikartan metatietoviesin poistaminen ei ole sallittua.',
            'beatmapset_post_no_edit' => 'Rytmikartan metatietoviesin muokkaaminen ei ole sallittua.',
        ],

        'topic_poll' => [
            'duplicate_options' => '',
            'invalid_max_options' => '',
            'minimum_one_selection' => '',
            'minimum_two_options' => '',
            'too_many_options' => '',
        ],

        'topic_vote' => [
            'required' => '',
            'too_many' => '',
        ],
    ],

    'user' => [
        'contains_username' => 'Salasana ei saa sisältää käyttäjätunnusta.',
        'email_already_used' => 'Tälle sähköpostille on jo luotu tunnus.',
        'invalid_country' => 'Maa ei ole tietokannassa.',
        'invalid_discord' => 'Virheellinen Discord käyttäjänimi.',
        'invalid_email' => "Ei näytä olevan kelvollinen sähköpostiosoite.",
        'too_short' => 'Uusi salasana on liian lyhyt.',
        'unknown_duplicate' => 'Käyttäjätunnus tai sähköposti osoite on jo käytössä.',
        'username_available_in' => '',
        'username_available_soon' => '',
        'username_invalid_characters' => 'Käyttäjätunnus sisältää virheellisiä merkkejä.',
        'username_in_use' => 'Käyttäjätunnus on jo käytössä!',
        'username_no_space_userscore_mix' => 'Käytä joko alaviivoja tai välilyöntehä, ei molempia!',
        'username_no_spaces' => "Käyttäjätunnus ei voi alkaa tai loppua välilyönneillä!",
        'username_not_allowed' => 'Tätä käyttäjätunnusta ei ole sallittu.',
        'username_too_short' => 'Pyydetty käyttäjätunnus on liian lyhyt.',
        'username_too_long' => 'Pyydetty käyttäjätunnus on liian pitkä.',
        'weak' => 'Mustalla listalla oleva salasana.',
        'wrong_current_password' => 'Nykyinen salasanasi on virheellinen.',
        'wrong_email_confirmation' => 'Salasanat eivät vastaa toisiaan.',
        'wrong_password_confirmation' => 'Salasanat eivät vastaa toisiaan.',
        'too_long' => '',

        'change_username' => [
            'supporter_required' => [
                '_' => 'Sinulla pitöö olla :link jotta voit muuttaa nimeäsi!',
                'link_text' => '',
            ],
            'username_is_same' => 'Tämä on jo käyttäjänimesi, höpsö!',
        ],
    ],
];
