<?php

/**
 *    Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
 *    See the LICENCE file in the repository root for full licence text.
 */

return [
    'not_negative' => ':attribute nemôže byť negatívny.',
    'required' => ':attribute je vyžadovaný.',
    'too_long' => ':attribute presiahol maximálnu dĺžku - môže mať maximálne :limit znakov.',
    'wrong_confirmation' => 'Potvrdenie sa nezhoduje.',

    'beatmap_discussion_post' => [
        'discussion_locked' => 'Diskusia je uzamknutá.',
        'first_post' => 'Počiatočný príspevok sa nedá odstrániť.',
    ],

    'beatmapset_discussion' => [
        'beatmap_missing' => 'Časová sekvencia je špecifikovaná, ale chýba beatmapa.',
        'beatmapset_no_hype' => "Táto beatmapa nemôže byť nadchnutá.",
        'hype_requires_null_beatmap' => 'Nadšenie musí byť konané v General (vśetkých obtiažností).',
        'invalid_beatmap_id' => 'Bola zadaná neplatná obtiažnosť.',
        'invalid_beatmapset_id' => 'Bola zadaná neplatná beatmapa.',
        'locked' => 'Diskusia je uzamknutá.',

        'hype' => [
            'guest' => 'Musíš byť prihláseny k nadšeniu.',
            'hyped' => 'Túto beatmapu si už nadchol.',
            'limit_exceeded' => 'Použil si všetky svoje nadšenia.',
            'not_hypeable' => 'Táto beatmapa nemôže byť nadchnutá',
            'owner' => 'Nemôžeš nadchnúť svoju beatmapu.',
        ],

        'timestamp' => [
            'exceeds_beatmapset_length' => 'Upresnená sekvencia času presahuje dĺžku beatmapy.',
            'negative' => "Časová sekvencia nemôže byť záporná.",
        ],
    ],

    'comment' => [
        'deleted_parent' => 'Odpovedať na odstránený komentár nie je povolené.',
    ],

    'forum' => [
        'feature_vote' => [
            'not_feature_topic' => 'Dá sa hlasovať iba o funkciách.',
            'not_enough_feature_votes' => 'Nedostatok hlasov.',
        ],

        'poll_vote' => [
            'invalid' => 'Bola zadaná neplatná možnosť.',
        ],

        'post' => [
            'beatmapset_post_no_delete' => 'Mazanie metadát beatmapy nie je povolené.',
            'beatmapset_post_no_edit' => 'Editovanie metadát beatmapy nie je povolené.',
            'only_quote' => '',
        ],

        'topic_poll' => [
            'duplicate_options' => 'Duplikované možnosti nie su povolené.',
            'grace_period_expired' => '',
            'invalid_max_options' => 'Možnosť jedného použivatela by nemala presiahnúť hodnotu povolených možností.',
            'minimum_one_selection' => 'Minimálne jedná možnosť na používatela je vyžadovaná.',
            'minimum_two_options' => 'Sú vyžadované aspoň dve možnosti.',
            'too_many_options' => 'Bol prekročený limit povolených možností.',
        ],

        'topic_vote' => [
            'required' => 'Vyber možnosť pri hlasovaní.',
            'too_many' => 'Vybral si viacej možností, než je povolené.',
        ],
    ],

    'user' => [
        'contains_username' => 'Heslo nemôže obsahovať užívateľské meno.',
        'email_already_used' => 'E-mailová adresa už bola použitá.',
        'invalid_country' => 'Krajina nie je v databáze.',
        'invalid_discord' => 'Nesprávne užívateľské meno na Discorde.',
        'invalid_email' => "Vyzerá to na neplatnú e-mailovú adresu.",
        'too_short' => 'Nové heslo je príliš krátke.',
        'unknown_duplicate' => 'Užívateľské meno alebo e-mailová adresa sa už používa.',
        'username_available_in' => 'Toto užívateľské meno bude k dispozícií za :duration.',
        'username_available_soon' => 'Toto užívateľské meno bude k dispozícií každú chvíľu!',
        'username_invalid_characters' => 'Zadané užívateľské meno obsahuje neplatné znaky.',
        'username_in_use' => 'Užívateľské meno sa už používa!',
        'username_locked' => '', // TODO: language for this should be slightly different.
        'username_no_space_userscore_mix' => 'Prosím použite podčiarknutia alebo medzery, nie oboje!',
        'username_no_spaces' => "Užívateľské meno nesmie začať alebo končiť medzerou!",
        'username_not_allowed' => 'Toto užívateľské meno nie je povolené.',
        'username_too_short' => 'Požadované užívateľské meno je príliš krátke.',
        'username_too_long' => 'Požadované užívateľské meno je príliš dlhé.',
        'weak' => 'Zakázané heslo.',
        'wrong_current_password' => 'Aktuálne heslo je nesprávne.',
        'wrong_email_confirmation' => 'Potvrdenie e-mailu sa nezhoduje.',
        'wrong_password_confirmation' => 'Zadané heslá sa nezhodujú.',
        'too_long' => 'Prekročila sa maximálna dĺžka - maximálna dĺžka je :limit znakov.',

        'change_username' => [
            'supporter_required' => [
                '_' => 'Musíš mať :link pre zmenu mena!',
                'link_text' => 'podporiť osu!',
            ],
            'username_is_same' => 'Toto už je tvoje užívateľské meno, hlupák!',
        ],
    ],

    'user_report' => [
        'self' => "",
    ],
];
