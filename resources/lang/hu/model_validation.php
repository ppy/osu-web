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
    'not_negative' => ':attribute nem lehet negatív.',
    'required' => ':attribute kötelező.',
    'too_long' => ':attribute elérte a maximális hosszt - csak :limit karakter hosszú lehet.',
    'wrong_confirmation' => 'A megerősítés nem egyezik.',

    'beatmap_discussion_post' => [
        'discussion_locked' => 'A megbeszélés zárt.',
        'first_post' => 'Nem lehet a kezdő posztot törölni.',
    ],

    'beatmapset_discussion' => [
        'beatmap_missing' => 'Időbélyeg meg van adva, de a beatmap hiányzik.',
        'beatmapset_no_hype' => "Beatmap-eket nem lehet népszerűsíteni.",
        'hype_requires_null_beatmap' => 'A népszerűsítés az Általános (összes nehézség) részlegen végzendő.',
        'invalid_beatmap_id' => 'Érvénytelen nehézség van megadva.',
        'invalid_beatmapset_id' => 'Érvénytelen beatmap van megadva.',
        'locked' => 'A megbeszélés zárva van.',

        'hype' => [
            'guest' => 'A népszerűsítéshez be kell lépned.',
            'hyped' => 'Már népszerűsítetted ezt a beatmap-et.',
            'limit_exceeded' => 'Az összes népszerűsítési esélyed elhasználtad.',
            'not_hypeable' => 'Ez beatmap nem lehet népszerűsítve',
            'owner' => 'Saját beatmap-ed nem lehet népszerűsíteni.',
        ],

        'timestamp' => [
            'exceeds_beatmapset_length' => 'Megadott időbélyeg későbbi mint a beatmap hossza.',
            'negative' => "Időbélyeg nem lehet negatív.",
        ],
    ],

    'forum' => [
        'feature_vote' => [
            'not_feature_topic' => 'Csak jövőbeli feature-re lehet szavazni.',
            'not_enough_feature_votes' => 'Nincs elég szavazat.',
        ],

        'poll_vote' => [
            'invalid' => 'Érvénytelen beállítás lett megadva.',
        ],

        'post' => [
            'beatmapset_post_no_delete' => 'Beatmap metaadat törlése nem engedélyezett.',
            'beatmapset_post_no_edit' => 'Beatmap metaadat poszt szerkesztése nem engedélyezett.',
        ],

        'topic_poll' => [
            'duplicate_options' => 'Duplikálás nem engedélyezett.',
            'invalid_max_options' => 'Felhasználónkénti opciók száma nem haladhatja meg az elérhető opciók mennyiségét.',
            'minimum_one_selection' => 'Minimum egy opció kell felhasználónként.',
            'minimum_two_options' => 'Legalább 2 választási lehetőség kell.',
            'too_many_options' => 'Elérted a maximum opciók számát.',
        ],

        'topic_vote' => [
            'required' => 'Válassz egy opciót szavazásnál.',
            'too_many' => 'Az engedélyezettnél több opciót választottál.',
        ],
    ],

    'user' => [
        'contains_username' => 'A jelszó nem tartalmazhat felhasználónevet.',
        'email_already_used' => 'Ez az e-mail cím már használatban van.',
        'invalid_country' => 'Az ország nincs az adatbázisban.',
        'invalid_discord' => 'Érvénytelen Discord felhasználónév.',
        'invalid_email' => "Nem úgy néz ki, hogy ez érvényes e-mail cím lenne.",
        'too_short' => 'Az új jelszó túl rövid.',
        'unknown_duplicate' => 'Ez a felhasználónév vagy e-mail cím már használatban van.',
        'username_available_in' => 'Ez a felhasználónév elérhető lesz :duration időn belül.',
        'username_available_soon' => 'Ez a felhasználónév bármelyik pillanatban elérhető lehet!',
        'username_invalid_characters' => 'A kért felhasználónév nem felhasználható karaktereket tartalmaz.',
        'username_in_use' => 'Foglalt felhasználónév!',
        'username_no_space_userscore_mix' => 'Vagy alsóvonalat használj, vagy space gomb lenyomásával üres teret, nem menő mind a kettő!',
        'username_no_spaces' => "A felhasználóneved nem kezdődhet és nem is végződhet üres hellyel!",
        'username_not_allowed' => 'Ez a felhasználónév nem engedett.',
        'username_too_short' => 'Felhasználónév túl rövid.',
        'username_too_long' => 'Túl hosszú felhasználónév.',
        'weak' => 'Feketelistás jelszó.',
        'wrong_current_password' => 'Helytelen jelszó.',
        'wrong_email_confirmation' => 'Email megerősítés nem egyezik.',
        'wrong_password_confirmation' => 'Jelszó megerősítés nem egyezik.',
        'too_long' => 'Elérted a maximum hosszúságot - maximum :limit karaktert használhatsz.',

        'change_username' => [
            'supporter_required' => [
                '_' => ':link szükséges a névváltoztatáshoz!',
                'link_text' => 'támogatta osu!-t',
            ],
            'username_is_same' => 'Már ez a felhasználóneved te butus!',
        ],
    ],
];
