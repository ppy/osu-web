<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'invalid' => 'Érvénytelen :attribute megadva.',
    'not_negative' => ':attribute nem lehet negatív.',
    'required' => ':attribute kötelező.',
    'too_long' => ':attribute elérte a maximális hosszt - csak :limit karakter hosszú lehet.',
    'wrong_confirmation' => 'A megerősítés nem egyezik.',

    'beatmapset_discussion' => [
        'beatmap_missing' => 'Időbélyeg meg van adva, de a beatmap hiányzik.',
        'beatmapset_no_hype' => "A beatmapet nem lehet hype-olni.",
        'hype_requires_null_beatmap' => 'A Hype-olás az Általános (összes nehézség) szekcióban végzendő.',
        'invalid_beatmap_id' => 'Érvénytelen nehézség lett megadva.',
        'invalid_beatmapset_id' => 'Érvénytelen beatmap lett megadva.',
        'locked' => 'A megbeszélés zárolva van.',

        'attributes' => [
            'message_type' => 'Üzenet típus',
            'timestamp' => 'Időbélyeg',
        ],

        'hype' => [
            'discussion_locked' => "Ez a beatmap jelenleg nem elérhető kommentelésre és hype-olásra",
            'guest' => 'A hype-oláshoz bejelentkezve kell lenned.',
            'hyped' => 'Már hype-oltad ezt a beatmapet.',
            'limit_exceeded' => 'Az összes hype-odat elhasználtad.',
            'not_hypeable' => 'Ez a beatmap nem hype-olható',
            'owner' => 'Saját beatmapet nem lehet hype-olni.',
        ],

        'timestamp' => [
            'exceeds_beatmapset_length' => 'A megadott időbélyeg későbbi mint a beatmap hossza.',
            'negative' => "Időbélyeg nem lehet negatív.",
        ],
    ],

    'beatmapset_discussion_post' => [
        'discussion_locked' => 'A megbeszélés zárolva van.',
        'first_post' => 'Nem lehet a kezdő posztot törölni.',

        'attributes' => [
            'message' => 'Az üzenet',
        ],
    ],

    'comment' => [
        'deleted_parent' => 'Törölt hozzászólásokra nem lehet válaszolni.',
        'top_only' => 'Visszajátszási kommentek kitűzése nem engedélyezett.',

        'attributes' => [
            'message' => 'Az üzenet',
        ],
    ],

    'follow' => [
        'invalid' => 'Érvénytelen :attribute lett megadva.',
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
            'first_post_no_delete' => 'Nem lehet a kezdő posztot törölni',
            'missing_topic' => 'Posztnak nincs témája',
            'only_quote' => 'A válaszod csak egy idézetet tartalmaz.',

            'attributes' => [
                'post_text' => 'Poszt felület',
            ],
        ],

        'topic' => [
            'attributes' => [
                'topic_title' => 'Téma cím',
            ],
        ],

        'topic_poll' => [
            'duplicate_options' => 'Duplikálás nem engedélyezett.',
            'grace_period_expired' => 'Nem lehet szerkeszteni a szavazást több mint :limit óra után',
            'hiding_results_forever' => 'Egy végtelen szavazás eredményeit nem lehet elrejteni.',
            'invalid_max_options' => 'Felhasználónkénti opciók száma nem haladhatja meg az elérhető opciók mennyiségét.',
            'minimum_one_selection' => 'Minimum egy opció kell felhasználónként.',
            'minimum_two_options' => 'Legalább 2 választási lehetőség kell.',
            'too_many_options' => 'Elérted a maximum opciók számát.',

            'attributes' => [
                'title' => 'Szavazás címe',
            ],
        ],

        'topic_vote' => [
            'required' => 'Válassz egy opciót szavazásnál.',
            'too_many' => 'Az engedélyezettnél több opciót választottál.',
        ],
    ],

    'oauth' => [
        'client' => [
            'too_many' => 'Elérted a maximum OAuth applikációk számát.',
            'url' => 'Kérjük adjon meg egy helyes URL-t.',

            'attributes' => [
                'name' => 'Alkalmazás neve',
                'redirect' => 'Alkalmazás Visszahívási URL',
            ],
        ],
    ],

    'user' => [
        'contains_username' => 'A jelszó nem tartalmazhat felhasználónevet.',
        'email_already_used' => 'Ez az e-mail cím már használatban van.',
        'email_not_allowed' => 'Nem megengedett e-mail cím.',
        'invalid_country' => 'Az ország nincs az adatbázisban.',
        'invalid_discord' => 'Érvénytelen Discord felhasználónév.',
        'invalid_email' => "Nem úgy néz ki, hogy ez érvényes e-mail cím lenne.",
        'invalid_twitter' => 'Érvénytelen Twitter felhasználónév.',
        'too_short' => 'Az új jelszó túl rövid.',
        'unknown_duplicate' => 'Ez a felhasználónév vagy e-mail cím már használatban van.',
        'username_available_in' => 'Ez a felhasználónév elérhető lesz :duration időn belül.',
        'username_available_soon' => 'Ez a felhasználónév bármelyik pillanatban elérhető lehet!',
        'username_invalid_characters' => 'A kért felhasználónév nem felhasználható karaktereket tartalmaz.',
        'username_in_use' => 'Foglalt felhasználónév!',
        'username_locked' => 'A név már használatban van!', // TODO: language for this should be slightly different.
        'username_no_space_userscore_mix' => 'Vagy alsóvonalat használj, vagy space gomb lenyomásával üres teret, nem menő mind a kettő!',
        'username_no_spaces' => "A felhasználóneved nem kezdődhet és nem is végződhet üres hellyel!",
        'username_not_allowed' => 'Ez a felhasználónév nem engedett.',
        'username_too_short' => 'A kért felhasználónév túl rövid.',
        'username_too_long' => 'A kért felhasználónév túl hosszú.',
        'weak' => 'Feketelistás jelszó.',
        'wrong_current_password' => 'A jelenlegi jelszó nem megfelelő.',
        'wrong_email_confirmation' => 'Email megerősítés nem egyezik.',
        'wrong_password_confirmation' => 'Jelszó megerősítés nem egyezik.',
        'too_long' => 'Elérted a maximum hosszúságot - maximum :limit karaktert használhatsz.',

        'attributes' => [
            'username' => 'Felhasználónév',
            'user_email' => 'E-mail cím',
            'password' => 'Jelszó',
        ],

        'change_username' => [
            'restricted' => 'Felfüggesztett állapotban nem változtathatsz felhasználónevet.',
            'supporter_required' => [
                '_' => ':link szükséges a névváltoztatáshoz!',
                'link_text' => 'támogatta osu!-t',
            ],
            'username_is_same' => 'Már ez a felhasználóneved te butus!',
        ],
    ],

    'user_report' => [
        'no_ranked_beatmapset' => 'Rangsorolt beatmapokat nem lehet jelenteni',
        'reason_not_valid' => 'ez a jelentés nem megfelelő, ehhez a jelentés fajtához.:reason.',
        'self' => "Nem jelentheted magadat!",
    ],

    'store' => [
        'order_item' => [
            'attributes' => [
                'quantity' => 'Mennyiség',
                'cost' => 'Ár',
            ],
        ],
    ],
];
