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
    'too_long' => ':attribute ylittää maksimipituuden - voi olla enintään :limit merkkiä.',
    'wrong_confirmation' => 'Tarkistus ei täsmää.',

    'beatmap_discussion_post' => [
        'discussion_locked' => 'Keskustelu on lukittu.',
        'first_post' => 'Aloitusviestiä ei voi poistaa.',
    ],

    'beatmapset_discussion' => [
        'beatmap_missing' => 'Aikaleima on määritelty, mutta beatmap puuttuu.',
        'beatmapset_no_hype' => "Beatmappia ei voi hurrata.",
        'hype_requires_null_beatmap' => 'Hurraus täytyy tehdä Yleiset -osiossa (kaikki vaikeusasteet).',
        'invalid_beatmap_id' => 'Määritelly vaikeustaso on virheellinen.',
        'invalid_beatmapset_id' => 'Määritelty beatmap on virheellinen.',
        'locked' => 'Keskustelu on lukittu.',

        'hype' => [
            'guest' => 'Sinun on kirjauduttava sisään hurrataksesi.',
            'hyped' => 'Hurrasit jo tätä beatmappia.',
            'limit_exceeded' => 'Olet käyttänyt kaikki hurrauksesi.',
            'not_hypeable' => 'Tätä beatmappia ei voi hurrata',
            'owner' => 'Ei omien beatmappien hurraamista.',
        ],

        'timestamp' => [
            'exceeds_beatmapset_length' => 'Määritelty aikaleima on beatmapin pituuden ulkopuolella.',
            'negative' => "Aikaleima ei voi olla negatiivinen.",
        ],
    ],

    'forum' => [
        'feature_vote' => [
            'not_feature_topic' => 'Voi äänestää vain ominaisuutta.',
            'not_enough_feature_votes' => 'Ei tarpeeksi ääniä.',
        ],

        'poll_vote' => [
            'invalid' => 'Virheellinen valinta määritelty.',
        ],

        'post' => [
            'beatmapset_post_no_delete' => 'Beatmapin metatietoviestiä ei voi poistaa.',
            'beatmapset_post_no_edit' => 'Beatmapin metatietoviestiä ei voi muokata.',
        ],

        'topic_poll' => [
            'duplicate_options' => 'Identtiset valinnat eivät ole sallittuja.',
            'invalid_max_options' => 'Valinnat käyttäjää kohti eivät voi ylittää kaikkien valintojen määrää.',
            'minimum_one_selection' => 'Vähintään yksi valinta käyttäjää kohti on vaadittu.',
            'minimum_two_options' => 'Tarvitsee ainakin kaksi valintaa.',
            'too_many_options' => 'Sallittujen valintojen määrä ylittyi.',
        ],

        'topic_vote' => [
            'required' => 'Valitse jotain äänestäessäsi.',
            'too_many' => 'Enemmän valintoja kuin sallittu.',
        ],
    ],

    'user' => [
        'contains_username' => 'Salasana ei saa sisältää käyttäjätunnusta.',
        'email_already_used' => 'Tämä sähköpostiosoite on jo käytössä.',
        'invalid_country' => 'Maa ei ole tietokannassa.',
        'invalid_discord' => 'Virheellinen Discord käyttäjänimi.',
        'invalid_email' => "Ei näytä kelvolliselta sähköpostiosoitteelta.",
        'too_short' => 'Uusi salasana on liian lyhyt.',
        'unknown_duplicate' => 'Käyttäjätunnus tai sähköpostiosoite on jo käytössä.',
        'username_available_in' => 'Tämän käyttäjänimen aukeamiseen on aikaa :duration.',
        'username_available_soon' => 'Tämä nimi on käytössä millä hetkellä hyvänsä!',
        'username_invalid_characters' => 'Käyttäjätunnus sisältää virheellisiä merkkejä.',
        'username_in_use' => 'Käyttäjätunnus on jo käytössä!',
        'username_no_space_userscore_mix' => 'Käytä joko alaviivoja tai välilyöntejä, ei molempia!',
        'username_no_spaces' => "Käyttäjätunnus ei voi alkaa tai loppua välilyönneillä!",
        'username_not_allowed' => 'Tätä käyttäjätunnusta ei ole sallittu.',
        'username_too_short' => 'Haluamasi käyttäjätunnus on liian lyhyt.',
        'username_too_long' => 'Haluamasi käyttäjätunnus on liian pitkä.',
        'weak' => 'Mustalla listalla oleva salasana.',
        'wrong_current_password' => 'Nykyinen salasanasi on virheellinen.',
        'wrong_email_confirmation' => 'Sähköpostivahvistus ei täsmää.',
        'wrong_password_confirmation' => 'Salasanat eivät vastaa toisiaan.',
        'too_long' => 'Liian pitkä - Kirjaimia voi olla enintään :limit.',

        'change_username' => [
            'supporter_required' => [
                '_' => 'Sinun pitää olla :link, jotta voit muuttaa nimeäsi!',
                'link_text' => 'tukenut osua!',
            ],
            'username_is_same' => 'Tämä on jo käyttäjänimesi, höpsö!',
        ],
    ],
];
