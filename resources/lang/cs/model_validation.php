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
    'not_negative' => ':attribute nesmí být záporný.',
    'required' => ':attribute je vyžadován.',
    'too_long' => ':attribute přesáhl maximální délku - může mít maximálně :limit znaků.',
    'wrong_confirmation' => 'Potvrzení se neshoduje.',

    'beatmap_discussion_post' => [
        'discussion_locked' => 'Diskuze je uzamčená.',
        'first_post' => 'Počáteční příspěvek nelze odstranit.',
    ],

    'beatmapset_discussion' => [
        'beatmap_missing' => 'Časová sekvence je specifikována, ale chybí beatmapa.',
        'beatmapset_no_hype' => "Tato beatmapa nemůže být nadchnutá.",
        'hype_requires_null_beatmap' => 'Nadšení musí být provedeno v General (všech obtížností).',
        'invalid_beatmap_id' => 'Byla zadaná neplatná obtížnost.',
        'invalid_beatmapset_id' => 'Byla zadaná neplatná beatmapa.',
        'locked' => 'Diskuze je uzamčená.',

        'hype' => [
            'guest' => 'Musíš být přihlášek k nadšení.',
            'hyped' => 'Tuto beatmapu již si nadchnul.',
            'limit_exceeded' => 'Využil jsi všechny svoje nadšení.',
            'not_hypeable' => 'Tato beatmapa nemůže být nadchnutá',
            'owner' => 'Nemůžeš nadchnout svojí beatmapu.',
        ],

        'timestamp' => [
            'exceeds_beatmapset_length' => 'Upřesněná sekvence času přesahuje délku beatmapy.',
            'negative' => "Časová sekvence nemůže být záporná.",
        ],
    ],

    'forum' => [
        'feature_vote' => [
            'not_feature_topic' => 'Lze hlasovat pouze o funkcích.',
            'not_enough_feature_votes' => 'Nedostatek hlasů.',
        ],

        'poll_vote' => [
            'invalid' => 'Zadaná neplatná možnost.',
        ],

        'post' => [
            'beatmapset_post_no_delete' => 'Mazání metadat beatmapy není povoleno.',
            'beatmapset_post_no_edit' => 'Editace metadat beatmapy není povoleno.',
        ],

        'topic_poll' => [
            'duplicate_options' => 'Duplikované možnosti nejsou povoleny.',
            'invalid_max_options' => 'Možnost jednoho uživatele by neměla přesáhnout hodnotu povolených možností.',
            'minimum_one_selection' => 'Minimálně jedna možnost na uživatele je vyžadována.',
            'minimum_two_options' => 'Jsou vyžadovány alespoň dvě možnosti.',
            'too_many_options' => 'Byl překročen limit povolených možností.',
        ],

        'topic_vote' => [
            'required' => 'Vyber možnost při hlasování.',
            'too_many' => 'Vybral jsi moc možností, než je povoleno.',
        ],
    ],

    'user' => [
        'contains_username' => 'Heslo nesmí obsahovat uživatelské jméno.',
        'email_already_used' => 'E-mailová adresa už byla použita.',
        'invalid_country' => 'Stát není v databázi.',
        'invalid_discord' => 'Discord uživatelské jmeno je neplatné.',
        'invalid_email' => "Vypadá to na neplatnou e-mailovou adresu.",
        'too_short' => 'Nové heslo je příliš krátké.',
        'unknown_duplicate' => 'Uživatelské jméno nebo e-mailová adresa je již použita.',
        'username_available_in' => 'Toto uživatelské jméno bude k dispozici za :duration.',
        'username_available_soon' => 'Toto uživatelské jméno bude k dispozici pro použití každou chvíli!',
        'username_invalid_characters' => 'Žádané uživatelské jméno obsahuje neplatné znaky.',
        'username_in_use' => 'Uživatelské jméno je již používáno!',
        'username_no_space_userscore_mix' => 'Použijte prosím podtržítka nebo mezery, ne obojí!',
        'username_no_spaces' => "Uživatelské jméno nesmí začínat nebo končit mezerou!",
        'username_not_allowed' => 'Toto uživatelské jméno není povoleno.',
        'username_too_short' => 'Požadované uživatelské jméno je příliš krátké.',
        'username_too_long' => 'Požadované uživatelské jméno je příliš dlouhé.',
        'weak' => 'Zakázané heslo.',
        'wrong_current_password' => 'Tvé aktuální heslo je nesprávné.',
        'wrong_email_confirmation' => 'Ověření emailu se neshoduje.',
        'wrong_password_confirmation' => 'Zadaná hesla se neshodují.',
        'too_long' => 'Překročena maximální délka - maximální délka je :limit znaků.',

        'change_username' => [
            'supporter_required' => [
                '_' => 'Musíš mít :link na změnu jména!',
                'link_text' => 'podpořit osu! nákupem supporter tagu!',
            ],
            'username_is_same' => 'Tohle je tvoje uživatelské jméno, hlupáku!',
        ],
    ],
];
