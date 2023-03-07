<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'invalid' => 'Določen :attribute je neveljaven.',
    'not_negative' => ':attribute ne sme biti negativen.',
    'required' => ':attribute je obvezen.',
    'too_long' => 'Dosežen največja dolžina za :attribute - lahko vsebuje samo do :limit znakov.',
    'wrong_confirmation' => 'Potrditev se ne ujema.',

    'beatmapset_discussion' => [
        'beatmap_missing' => 'Časovna oznaka je navedena, ampak manjka težavnost beatmape.',
        'beatmapset_no_hype' => "Beatmapa ne more biti hypana.",
        'hype_requires_null_beatmap' => 'Hype mora biti opravljen v General (vse težavnosti) delu. ',
        'invalid_beatmap_id' => 'Določena težavnost je neveljavna. ',
        'invalid_beatmapset_id' => 'Določena beatmapa je neveljavna.',
        'locked' => 'Razprava je zaklenjena.',

        'attributes' => [
            'message_type' => 'Tip sporočila',
            'timestamp' => 'Časovna oznaka',
        ],

        'hype' => [
            'discussion_locked' => "Ta beatmapa je trenutno zaklenjena za razpravo in ne more biti hypana",
            'guest' => 'Za hypanje je potreben vpis.',
            'hyped' => 'To beatmapo si že hypal.',
            'limit_exceeded' => 'Porabil si vse svoje hype točke.',
            'not_hypeable' => 'Ta beatmapa ne more biti hypana',
            'owner' => 'Ne moreš hypati svoje beatmape.',
        ],

        'timestamp' => [
            'exceeds_beatmapset_length' => 'Določena časovna oznaka presega dolžino beatmape.',
            'negative' => "Časovna oznaka ne sme biti negativna.",
        ],
    ],

    'beatmapset_discussion_post' => [
        'discussion_locked' => 'Razprava je zaklenjena.',
        'first_post' => 'Izbris začetne objave ni mogoč.',

        'attributes' => [
            'message' => 'Sporočilo',
        ],
    ],

    'comment' => [
        'deleted_parent' => 'Odgovor na izbrisan komentar ni dovoljen.',
        'top_only' => 'Pripenjanje odgovora na komentar ni dovoljeno.',

        'attributes' => [
            'message' => 'Sporočilo',
        ],
    ],

    'follow' => [
        'invalid' => 'Določen :attribute je neveljaven.',
    ],

    'forum' => [
        'feature_vote' => [
            'not_feature_topic' => 'Lahko glasuješ le za zahtevo za funkcijo.',
            'not_enough_feature_votes' => 'Ni dovolj glasov.',
        ],

        'poll_vote' => [
            'invalid' => 'Določena možnost je neveljavna.',
        ],

        'post' => [
            'beatmapset_post_no_delete' => 'Brisanje objave metadata beatmape ni dovoljeno.',
            'beatmapset_post_no_edit' => 'Urejanje objave metadata beatmape ni dovoljeno.',
            'first_post_no_delete' => 'Izbris začetne objave ni mogoč',
            'missing_topic' => 'Objavi manjka tema',
            'only_quote' => 'Tvoj odgovor vsebuje le citat.',

            'attributes' => [
                'post_text' => 'Telo objave',
            ],
        ],

        'topic' => [
            'attributes' => [
                'topic_title' => 'Naslov teme',
            ],
        ],

        'topic_poll' => [
            'duplicate_options' => 'Podvojena možnost ni dovoljena.',
            'grace_period_expired' => 'Urejanje glasovanja po več kot :limit ur ni možno.',
            'hiding_results_forever' => 'Rezultatov glasovanja, ki se nikoli ne konča, ni možno skriti.',
            'invalid_max_options' => 'Možnosti na igralca naj ne presega številu možnih možnosti.',
            'minimum_one_selection' => 'Na igralca je potrebna vsaj ena možnost.',
            'minimum_two_options' => 'Potrebni sta dve možnosti.',
            'too_many_options' => 'Prekoračeno največje število dovoljenih možnosti.',

            'attributes' => [
                'title' => 'Naslov glasovanja',
            ],
        ],

        'topic_vote' => [
            'required' => 'Izberi možnost, ko glasuješ.',
            'too_many' => 'Izbranih več možnosti kot je dovoljeno.',
        ],
    ],

    'oauth' => [
        'client' => [
            'too_many' => 'Prekoračeno največje število dovoljenih OAuth aplikacij.',
            'url' => 'Prosimo vnesi pravilen URL.',

            'attributes' => [
                'name' => 'Ime aplikacije',
                'redirect' => 'Callback URL aplikacije',
            ],
        ],
    ],

    'user' => [
        'contains_username' => 'Geslo naj ne vsebuje uporabniškega imena.',
        'email_already_used' => 'Ta E-poštni naslov je že uporabljen.',
        'email_not_allowed' => 'Ta E-poštni naslov ni dovoljen.',
        'invalid_country' => 'Država ni v podatkovni bazi.',
        'invalid_discord' => 'Neveljavno Discord uporabniško ime.',
        'invalid_email' => "E-poštni naslov ni veljaven.",
        'invalid_twitter' => 'Neveljavno Twitter uporabniško ime.',
        'too_short' => 'Novo geslo je prekratko.',
        'unknown_duplicate' => 'Uporabniško ime ali e-poštni naslov je že uporabljen.',
        'username_available_in' => 'To uporabniško ime bo na voljo čez :duration.',
        'username_available_soon' => 'To uporabniško ime bo na voljo zelo kmalu!',
        'username_invalid_characters' => 'Željeno uporabniško ime vsebuje neveljavne znake.',
        'username_in_use' => 'To uporabniško ime je že v uporabi!',
        'username_locked' => 'To uporabniško ime je že v uporabi!', // TODO: language for this should be slightly different.
        'username_no_space_userscore_mix' => 'Prosimo uporabi podčrtaje ali presledke, ne oboje hkrati!',
        'username_no_spaces' => "Uporabniško ime se ne sme začeti ali končati s presledki!",
        'username_not_allowed' => 'Ta izbira uporabniškega imena ni dovoljena. ',
        'username_too_short' => 'Željeno uporabniško ime je prekratko.',
        'username_too_long' => 'Željeno uporabniško ime je predolgo.',
        'weak' => 'Nedovoljeno geslo.',
        'wrong_current_password' => 'Trenutno geslo je nepravilno.',
        'wrong_email_confirmation' => 'E-poštno potrdilo se ne ujema.',
        'wrong_password_confirmation' => 'Potrdilo gesla se ne ujema.',
        'too_long' => 'Prekoračena največja dolžina - lahko vsebuje le do :limit znakov.',

        'attributes' => [
            'username' => 'Uporabniško ime',
            'user_email' => 'E-poštni naslov',
            'password' => 'Geslo',
        ],

        'change_username' => [
            'restricted' => 'Ne moreš si spremeniti uporabniškega imena medtem, ko imaš omejitev na profilu.',
            'supporter_required' => [
                '_' => 'Za spremembo imena moraš :link!',
                'link_text' => 'podpirati osu!',
            ],
            'username_is_same' => 'To uporabniško ime je že tvoje!',
        ],
    ],

    'user_report' => [
        'no_ranked_beatmapset' => 'Rankiranih beatmap ni možno prijaviti ',
        'reason_not_valid' => ':reason ni veljaven tip prijave.',
        'self' => "Ne moreš prijaviti samega sebe!",
    ],

    'store' => [
        'order_item' => [
            'attributes' => [
                'quantity' => 'Količina',
                'cost' => 'Cena',
            ],
        ],
    ],
];
