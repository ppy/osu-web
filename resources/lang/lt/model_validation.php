<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'invalid' => 'Negalimas :attribute nurodytas.',
    'not_negative' => ':attribute negali būti neigiamas.',
    'required' => ':attribute yra privalomas.',
    'too_long' => ':attribute yra per ilgas - gali būti daugiausiai :limit simbolių.',
    'url' => '',
    'wrong_confirmation' => 'Patvirtinimas nesutampa.',

    'beatmapset_discussion' => [
        'beatmap_missing' => 'Laiko žyma nurodyta tačiau trūksta bitmapo sunkumo.',
        'beatmapset_no_hype' => "Bitmapas negali būti skatinamas.",
        'hype_requires_null_beatmap' => 'Skatinimas turi būti atliekamas Bendroje (visų sudėtingumų) sekcijoje.',
        'invalid_beatmap_id' => 'Nurodytas neteisingas sunkumas.',
        'invalid_beatmapset_id' => 'Nurodytas neteisingas bitmapas.',
        'locked' => 'Diskusija užrakinta.',

        'attributes' => [
            'message_type' => 'Žinutės tipas',
            'timestamp' => 'Laiko žyma',
        ],

        'hype' => [
            'discussion_locked' => "Šio bitmapo diskusija šiuo metu užrakinta ir jis negali būti skatinamas",
            'guest' => 'Skatinimui reikia prisijungti.',
            'hyped' => 'Tu jau paskatinai šį bitmapą.',
            'limit_exceeded' => 'Jau išnaudojai visus savo skatinimus.',
            'not_hypeable' => 'Šis Bitmapas negali būti skatinamas',
            'owner' => 'Savo bitmapo skatinti negali.',
        ],

        'timestamp' => [
            'exceeds_beatmapset_length' => 'Nurodytas laiko žyma yra didesnė negu bitmapo trukmė.',
            'negative' => "Laikas negali būti neigiamas.",
        ],
    ],

    'beatmapset_discussion_post' => [
        'discussion_locked' => 'Diskusija užrakinta.',
        'first_post' => 'Negalimas ištrinti pirmojo įrašo.',

        'attributes' => [
            'message' => 'Žinutė',
        ],
    ],

    'comment' => [
        'deleted_parent' => 'Atsakymas į ištrintą komentarą negalimas.',
        'top_only' => 'Komentaro atsakymo prisegimas negalimas.',

        'attributes' => [
            'message' => 'Žinutė',
        ],
    ],

    'follow' => [
        'invalid' => 'Negalimas :attribute nurodytas.',
    ],

    'forum' => [
        'feature_vote' => [
            'not_feature_topic' => 'Gali balsuoti tik funkcijų prašymuose.',
            'not_enough_feature_votes' => 'Nepakanka balsų.',
        ],

        'poll_vote' => [
            'invalid' => 'Nurodytas negalimas nustatymas.',
        ],

        'post' => [
            'beatmapset_post_no_delete' => 'Negalima ištrinti bitmapo metaduomenų įrašo.',
            'beatmapset_post_no_edit' => 'Negalima redaguoti bitmapo metaduomenų įrašo.',
            'first_post_no_delete' => 'Negalimas ištrinti pirmojo įrašo',
            'missing_topic' => 'Įrašas neturi temos',
            'only_quote' => 'Jūsų atsakyme yra tik citata.',

            'attributes' => [
                'post_text' => 'Įrašo laukas',
            ],
        ],

        'topic' => [
            'attributes' => [
                'topic_title' => 'Temos pavadinimas',
            ],
        ],

        'topic_poll' => [
            'duplicate_options' => 'Dubliuoti nustatymai negalimi.',
            'grace_period_expired' => 'Negalima redaguoti apklausos po daugiau nei :limit valandų.',
            'hiding_results_forever' => 'Negalima paslėpti rezultatų iš apklausos, kuri niekada nesibaigia.',
            'invalid_max_options' => 'Pasirinkimų vienam vartotojui negali būti daugiau nei pačių pasirinkimų.',
            'minimum_one_selection' => 'Turi būti bent vienas pasirinkimas vienam vartotojui.',
            'minimum_two_options' => 'Turi būti bent du pasirinkimai.',
            'too_many_options' => 'Pažymėta daugiau pasirinkimų nei galima.',

            'attributes' => [
                'title' => 'Apklausos pavadinimas',
            ],
        ],

        'topic_vote' => [
            'required' => 'Pažymėk pasirinkimą, kai balsuoji.',
            'too_many' => 'Pasirinkta daugiau nei galima.',
        ],
    ],

    'legacy_api_key' => [
        'exists' => '',
    ],

    'oauth' => [
        'client' => [
            'too_many' => 'Viršytas galimas OAuth aplikacijų skaičius.',
            'url' => 'Prašome įvesti tinkamą URL.',

            'attributes' => [
                'name' => 'Aplikacijos Pavadinimas',
                'redirect' => 'Aplikacijos Atgalinio susisiekimo URL',
            ],
        ],
    ],

    'user' => [
        'contains_username' => 'Slaptažodyje negali būti vartotojo vardas.',
        'email_already_used' => 'El. pašto adresas jau naudojamas.',
        'email_not_allowed' => 'Negalimas el. pašto adresas.',
        'invalid_country' => 'Šalies nėra duomenų bazėje.',
        'invalid_discord' => 'Negalimas Discord vartotojo vardas.',
        'invalid_email' => "Nepanašu, kad tai galiojantis el. pašto adresas.",
        'invalid_twitter' => 'Negalimas Twitter vartotojo vardas.',
        'too_short' => 'Naujas slaptažodis per trumpas.',
        'unknown_duplicate' => 'Vartotojo vardas arba el. pašto adresas jau yra naudojamas.',
        'username_available_in' => 'Šį vartotojo vardą bus galima naudoti :duration.',
        'username_available_soon' => 'Šį vartotojo vardą bus galima naudoti bet kuria minutę!',
        'username_invalid_characters' => 'Prašomas vartotojo vardas turi negalimų ženklų.',
        'username_in_use' => 'Vartotojo vardas jau naudojamas!',
        'username_locked' => 'Vartotojo vardas jau naudojamas!', // TODO: language for this should be slightly different.
        'username_no_space_userscore_mix' => 'Prašome naudoti pabrėžimus arba tarpus, bet ne abu!',
        'username_no_spaces' => "Vartotojo vardas negali prasidėti ar beigtis su tarpais!",
        'username_not_allowed' => 'Šis Vartotojo vardas negalimas.',
        'username_too_short' => 'Prašomas vartotojo vardas per trumpas.',
        'username_too_long' => 'Prašomas vartotojo varadas per ilgas.',
        'weak' => 'Juodojo sąrašo slaptažodis.',
        'wrong_current_password' => 'Dabartinis slaptažodis neteisingas.',
        'wrong_email_confirmation' => 'El. pašto patvirtinimas nesutampa.',
        'wrong_password_confirmation' => 'Slaptažodžio patvirtinimas nesutampa.',
        'too_long' => 'Viršytas galimas ilgis. Gali būti tik iki :limit ženklų.',

        'attributes' => [
            'username' => 'Vartotojo vardas',
            'user_email' => 'El. pašto adresas',
            'password' => 'Slaptažodis',
        ],

        'change_username' => [
            'restricted' => 'Negali pakeisti savo vartotojo vardą, kol esi apribotas.',
            'supporter_required' => [
                '_' => 'Jūs turite būti :link, kad galėtum pasikeisti savo vardą!',
                'link_text' => 'parėmęs osu!',
            ],
            'username_is_same' => 'Jau naudojate šį vartotojo vardą!',
        ],
    ],

    'user_report' => [
        'no_ranked_beatmapset' => 'Reitinguoti bitmapai negali būti pranešti',
        'reason_not_valid' => ':reason negalioja šiam pranešimo tipui.',
        'self' => "Negalite pranešti savęs!",
    ],

    'store' => [
        'order_item' => [
            'attributes' => [
                'quantity' => 'Kiekis',
                'cost' => 'Kaina',
            ],
        ],
    ],
];
