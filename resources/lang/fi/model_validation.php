<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'invalid' => 'Virheellinen :attribute määritelty.',
    'not_negative' => ':attribute ei voi olla negatiivinen.',
    'required' => ':attribute on pakollinen.',
    'too_long' => ':attribute ylittää maksimipituuden - voi olla enintään :limit merkkiä.',
    'url' => 'Syötä kelvollinen URL-osoite.',
    'wrong_confirmation' => 'Tarkistus ei täsmää.',

    'beatmapset_discussion' => [
        'beatmap_missing' => 'Aikaleima on määritelty, mutta rytmikartta puuttuu.',
        'beatmapset_no_hype' => "Rytmikarttaa ei voida hurrata.",
        'hype_requires_null_beatmap' => 'Hurraus täytyy tehdä Yleiset (kaikki vaikeustasot) -osiossa.',
        'invalid_beatmap_id' => 'Määritelly vaikeustaso on virheellinen.',
        'invalid_beatmapset_id' => 'Epäkelpo rytmikartta määritelty.',
        'locked' => 'Keskustelu on lukittu.',

        'attributes' => [
            'message_type' => 'Viestin tyyppi',
            'timestamp' => 'Aikaleima',
        ],

        'hype' => [
            'discussion_locked' => "Tämän rytmikartan keskustelu on lukittu eikä sitä voi hurrata",
            'guest' => 'Sinun on kirjauduttava sisään hurrataksesi.',
            'hyped' => 'Hurrasit jo tätä rytmikarttaa.',
            'limit_exceeded' => 'Olet käyttänyt kaikki hurrauksesi.',
            'not_hypeable' => 'Tätä rytmikarttaa ei voi hurrata',
            'owner' => 'Ei omien rytmikarttojen hurraamista.',
        ],

        'timestamp' => [
            'exceeds_beatmapset_length' => 'Määritelty aikaleima on rytmikartan pituuden ulkopuolella.',
            'negative' => "Aikaleima ei voi olla negatiivinen.",
        ],
    ],

    'beatmapset_discussion_post' => [
        'discussion_locked' => 'Keskustelu on lukittu.',
        'first_post' => 'Aloitusviestiä ei voida poistaa.',

        'attributes' => [
            'message' => 'Viesti',
        ],
    ],

    'comment' => [
        'deleted_parent' => 'Poistettuun kommenttiin ei voida vastata.',
        'top_only' => 'Kommentin vastauksen kiinnitys ei ole sallittu.',

        'attributes' => [
            'message' => 'Viesti',
        ],
    ],

    'follow' => [
        'invalid' => 'Virheellinen :attribute määritelty.',
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
            'beatmapset_post_no_delete' => 'Rytmikartan kuvailutietoviestin poistaminen ei ole sallittua.',
            'beatmapset_post_no_edit' => 'Rytmikartan kuvailutietoviesin muokkaaminen ei ole sallittua.',
            'first_post_no_delete' => 'Aloitusviestiä ei voi poistaa',
            'missing_topic' => 'Viestissä puuttuu aihe',
            'only_quote' => 'Sinun vastauksesi sisältää ainoastaan lainauksen.',

            'attributes' => [
                'post_text' => 'Varsinainen teksti',
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

    'legacy_api_key' => [
        'exists' => 'Käyttäjää kohti annetaan tällä hetkellä vain yksi rajapinnan avain.',

        'attributes' => [
            'api_key' => 'rajapinnan avain',
            'app_name' => 'sovelluksen nimi',
            'app_url' => 'sovelluksen url',
        ],
    ],

    'oauth' => [
        'client' => [
            'too_many' => 'Sallittujen OAuth-sovellusten maksimimäärä ylittyi.',
            'url' => 'Syötä kelvollinen URL-osoite.',

            'attributes' => [
                'name' => 'Sovelluksen Nimi',
                'redirect' => 'Sovelluksen Vastakutsun URL',
            ],
        ],
    ],

    'team' => [
        'invalid_characters' => '',
        'used' => '',
        'word_not_allowed' => '',

        'attributes' => [
            'default_ruleset_id' => '',
            'is_open' => '',
            'name' => '',
            'short_name' => '',
            'url' => '',
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
        'no_ranked_beatmapset' => 'Rankattuja rytmikarttoja ei voi ilmiantaa',
        'not_in_channel' => 'Et ole tällä kanavalla.',
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
