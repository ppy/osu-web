<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'invalid' => 'Zadaná neplatná :attribute.',
    'not_negative' => ':attribute nesmí být záporný.',
    'required' => ':attribute je vyžadován.',
    'too_long' => ':attribute přesáhl maximální délku - může mít maximálně :limit znaků.',
    'url' => '',
    'wrong_confirmation' => 'Potvrzení se neshoduje.',

    'beatmapset_discussion' => [
        'beatmap_missing' => 'Časová značka je specifikována, ale chybí obtížnost beatmapy.',
        'beatmapset_no_hype' => "Tato beatmapa nemůže být nadchnutá.",
        'hype_requires_null_beatmap' => 'Nadšení musí být provedeno v General (všech obtížností).',
        'invalid_beatmap_id' => 'Byla zadaná neplatná obtížnost.',
        'invalid_beatmapset_id' => 'Byla zadaná neplatná beatmapa.',
        'locked' => 'Diskuze je uzamčená.',

        'attributes' => [
            'message_type' => 'Typ zprávy',
            'timestamp' => 'Časové razítko',
        ],

        'hype' => [
            'discussion_locked' => "Tato beatmapa je v současnosti uzamčena v diskuzi a nelze ji nadchnout",
            'guest' => 'Musíš být přihlášek k nadšení.',
            'hyped' => 'Tuto beatmapu již si nadchnul.',
            'limit_exceeded' => 'Využil jsi všechny svoje nadšení.',
            'not_hypeable' => 'Tato beatmapa nemůže být nadchnutá',
            'owner' => 'Nemůžeš podpořit svoji vlastní beatmapu.',
        ],

        'timestamp' => [
            'exceeds_beatmapset_length' => 'Uvedená časová značka přesahuje délku beatmapy.',
            'negative' => "Časová značka nemůže být záporná.",
        ],
    ],

    'beatmapset_discussion_post' => [
        'discussion_locked' => 'Diskuze je uzamčená.',
        'first_post' => 'Počáteční příspěvek nelze odstranit.',

        'attributes' => [
            'message' => 'Zpráva',
        ],
    ],

    'comment' => [
        'deleted_parent' => 'Odpovídat na smazaný komentář není povoleno.',
        'top_only' => 'Připínání odpovědi není povoleno.',

        'attributes' => [
            'message' => 'Zpráva',
        ],
    ],

    'follow' => [
        'invalid' => 'Zadaná neplatná :attribute.',
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
            'first_post_no_delete' => 'Počáteční pozici nelze odstranit',
            'missing_topic' => 'Příspěvku chybí téma',
            'only_quote' => 'Tvoje odpověď obsahuje jenom citát.',

            'attributes' => [
                'post_text' => 'Tělo příspěvku',
            ],
        ],

        'topic' => [
            'attributes' => [
                'topic_title' => 'Titulek příspěvku',
            ],
        ],

        'topic_poll' => [
            'duplicate_options' => 'Duplikované možnosti nejsou povoleny.',
            'grace_period_expired' => 'Nemůžete upravovat hlasování po více jak :limit hodinách',
            'hiding_results_forever' => 'Nelze skrýt výsledky ankety, která nikdy neskončí.',
            'invalid_max_options' => 'Možnost jednoho uživatele by neměla přesáhnout hodnotu povolených možností.',
            'minimum_one_selection' => 'Minimálně jedna možnost na uživatele je vyžadována.',
            'minimum_two_options' => 'Jsou vyžadovány alespoň dvě možnosti.',
            'too_many_options' => 'Byl překročen limit povolených možností.',

            'attributes' => [
                'title' => 'Název ankety',
            ],
        ],

        'topic_vote' => [
            'required' => 'Vyber možnost při hlasování.',
            'too_many' => 'Vybral jsi moc možností, než je povoleno.',
        ],
    ],

    'legacy_api_key' => [
        'exists' => '',
    ],

    'oauth' => [
        'client' => [
            'too_many' => 'Byl překročen limit povolených možností.',
            'url' => 'Zadejte prosím platnou adresu URL.',

            'attributes' => [
                'name' => 'Název aplikace',
                'redirect' => 'URL zpětného volání aplikace',
            ],
        ],
    ],

    'user' => [
        'contains_username' => 'Heslo nesmí obsahovat uživatelské jméno.',
        'email_already_used' => 'E-mailová adresa už byla použita.',
        'email_not_allowed' => 'E-mailová adresa není povolena.',
        'invalid_country' => 'Stát není v databázi.',
        'invalid_discord' => 'Discord uživatelské jmeno je neplatné.',
        'invalid_email' => "Vypadá to na neplatnou e-mailovou adresu.",
        'invalid_twitter' => 'Twitter uživatelské jméno je neplatné.',
        'too_short' => 'Nové heslo je příliš krátké.',
        'unknown_duplicate' => 'Uživatelské jméno nebo e-mailová adresa je již použita.',
        'username_available_in' => 'Toto uživatelské jméno bude k dispozici za :duration.',
        'username_available_soon' => 'Toto uživatelské jméno bude k dispozici pro použití každou chvíli!',
        'username_invalid_characters' => 'Žádané uživatelské jméno obsahuje neplatné znaky.',
        'username_in_use' => 'Uživatelské jméno je již používáno!',
        'username_locked' => 'Tohle jméno už někdo používá!', // TODO: language for this should be slightly different.
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

        'attributes' => [
            'username' => 'Uživatelské jméno',
            'user_email' => 'E-mailová adresa',
            'password' => 'Heslo',
        ],

        'change_username' => [
            'restricted' => 'Nemůžeš si změnit své uživatelské jméno, když jsi omezený.',
            'supporter_required' => [
                '_' => 'Musíš :link pro změnu jména!',
                'link_text' => 'podpořit osu!',
            ],
            'username_is_same' => 'Tohle je tvoje uživatelské jméno, hlupáku!',
        ],
    ],

    'user_report' => [
        'no_ranked_beatmapset' => 'Hodnocené beatmapy nemohou být nahlášeny',
        'reason_not_valid' => ':reason není platný pro tento typ nahlášení.',
        'self' => "Nemůžete nahlásit sám sebe!",
    ],

    'store' => [
        'order_item' => [
            'attributes' => [
                'quantity' => 'Množství',
                'cost' => 'Cena',
            ],
        ],
    ],
];
