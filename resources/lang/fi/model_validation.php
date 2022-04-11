<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'invalid' => '',
    'not_negative' => ':attribute ei voi olla negatiivinen.',
    'required' => ':attribute on pakollinen.',
    'too_long' => ':attribute ylittää maksimipituuden - voi olla enintään :limit merkkiä.',
    'wrong_confirmation' => 'Tarkistus ei täsmää.',

    'beatmapset_discussion' => [
        'beatmap_missing' => 'Aikaleima on määritelty, mutta beatmap puuttuu.',
        'beatmapset_no_hype' => "Beatmappia ei voi hurrata.",
        'hype_requires_null_beatmap' => 'Hurraus täytyy tehdä Yleiset -osiossa (kaikki vaikeusasteet).',
        'invalid_beatmap_id' => 'Määritelly vaikeustaso on virheellinen.',
        'invalid_beatmapset_id' => 'Määritelty beatmap on virheellinen.',
        'locked' => 'Keskustelu on lukittu.',

        'attributes' => [
            'message_type' => '',
            'timestamp' => '',
        ],

        'hype' => [
            'discussion_locked' => "",
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

    'beatmapset_discussion_post' => [
        'discussion_locked' => 'Keskustelu on lukittu.',
        'first_post' => 'Aloitusviestiä ei voida poistaa.',

        'attributes' => [
            'message' => '',
        ],
    ],

    'comment' => [
        'deleted_parent' => 'Poistettuun kommenttiin ei voida vastata.',
        'top_only' => '',

        'attributes' => [
            'message' => '',
        ],
    ],

    'follow' => [
        'invalid' => '',
    ],

    'forum' => [
        'feature_vote' => [
            'not_feature_topic' => 'Vain ominaisuutta voi äänestää.',
            'not_enough_feature_votes' => 'Ei tarpeeksi ääniä.',
        ],

        'poll_vote' => [
            'invalid' => 'Virheellinen valinta määritelty.',
        ],

        'post' => [
            'beatmapset_post_no_delete' => 'Beatmapin metatietoviestiä ei voida poistaa.',
            'beatmapset_post_no_edit' => 'Beatmapin metatietoviestiä ei voida muokata.',
            'first_post_no_delete' => 'Aloitusviestiä ei voi poistaa',
            'missing_topic' => 'Viestissä puuttuu aihe',
            'only_quote' => 'Sinun vastauksesi sisältää ainoastaan lainauksen.',

            'attributes' => [
                'post_text' => '',
            ],
        ],

        'topic' => [
            'attributes' => [
                'topic_title' => 'Aiheen otsikko',
            ],
        ],

        'topic_poll' => [
            'duplicate_options' => 'Identtiset valinnat eivät ole sallittuja.',
            'grace_period_expired' => 'Äänestystä ei voi muokata :limit tunnin jälkeen',
            'hiding_results_forever' => 'Ei voi piilottaa tuloksia kyselystä, joka ei koskaan pääty.',
            'invalid_max_options' => 'Valinnat käyttäjää kohti eivät voi ylittää kaikkien valintojen määrää.',
            'minimum_one_selection' => 'Vähintään yksi valinta käyttäjää kohti on vaadittu.',
            'minimum_two_options' => 'Tarvitsee ainakin kaksi valintaa.',
            'too_many_options' => 'Sallittujen valintojen määrä ylittyi.',

            'attributes' => [
                'title' => 'Kyselyn otsikko',
            ],
        ],

        'topic_vote' => [
            'required' => 'Valitse jotain äänestäessäsi.',
            'too_many' => 'Enemmän valintoja kuin sallittu.',
        ],
    ],

    'oauth' => [
        'client' => [
            'too_many' => '',
            'url' => 'Syötä kelvollinen URL-osoite.',

            'attributes' => [
                'name' => 'Sovelluksen Nimi',
                'redirect' => 'Sovelluksen Vastakutsun URL',
            ],
        ],
    ],

    'user' => [
        'contains_username' => 'Salasana ei saa sisältää käyttäjätunnusta.',
        'email_already_used' => 'Tämä sähköpostiosoite on jo käytössä.',
        'email_not_allowed' => 'Sähköpostiosoite ei ole sallittu.',
        'invalid_country' => 'Maata ei ole tietokannassa.',
        'invalid_discord' => 'Virheellinen Discord käyttäjänimi.',
        'invalid_email' => "Ei näytä kelvolliselta sähköpostiosoitteelta.",
        'invalid_twitter' => 'Twitter-käyttäjätunnus ei kelpaa.',
        'too_short' => 'Uusi salasana on liian lyhyt.',
        'unknown_duplicate' => 'Käyttäjätunnus tai sähköpostiosoite on jo käytössä.',
        'username_available_in' => 'Tämän käyttäjänimen aukeamiseen on aikaa :duration.',
        'username_available_soon' => 'Tämä nimi on käytössä millä hetkellä hyvänsä!',
        'username_invalid_characters' => 'Käyttäjätunnus sisältää virheellisiä merkkejä.',
        'username_in_use' => 'Käyttäjätunnus on jo käytössä!',
        'username_locked' => 'Käyttäjänimi on jo käytössä!', // TODO: language for this should be slightly different.
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

        'attributes' => [
            'username' => 'Käyttäjänimi',
            'user_email' => 'Sähköpostiosoite',
            'password' => 'Salasana',
        ],

        'change_username' => [
            'restricted' => 'Et voi vaihtaa käyttäjänimeäsi kun tilisi on rajoitettu.',
            'supporter_required' => [
                '_' => 'Sinun pitää olla :link, jotta voit muuttaa nimeäsi!',
                'link_text' => 'tukenut osua!',
            ],
            'username_is_same' => 'Tämä on jo käyttäjänimesi, höpsö!',
        ],
    ],

    'user_report' => [
        'no_ranked_beatmapset' => '',
        'reason_not_valid' => ':reason ei kelpaa tälle ilmoitustyypille.',
        'self' => "Et voi ilmiantaa itseäsi!",
    ],

    'store' => [
        'order_item' => [
            'attributes' => [
                'quantity' => 'Määrä',
                'cost' => 'Hinta',
            ],
        ],
    ],
];
