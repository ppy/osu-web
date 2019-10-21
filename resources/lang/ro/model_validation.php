<?php

/**
 *    Copyright (c) ppy Pty Ltd <contact@ppy.sh>.
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
    'not_negative' => ':attribute nu poate fi negativ.',
    'required' => ':attribute este necesar.',
    'too_long' => ':attribute depășește lungimea maximă - poate fi doar până la :limit de caractere.',
    'wrong_confirmation' => 'Confirmarea nu se potrivește.',

    'beatmap_discussion_post' => [
        'discussion_locked' => 'Discuția este închisă.',
        'first_post' => 'Nu se poate șterge postarea de pornire.',

        'attributes' => [
            'message' => 'Mesajul',
        ],
    ],

    'beatmapset_discussion' => [
        'beatmap_missing' => 'Marcajul de timp este specificat dar beatmapul lipsește.',
        'beatmapset_no_hype' => "Acest beatmap nu poate fi hyped.",
        'hype_requires_null_beatmap' => 'Hype trebuie să fie făcut în secțiunea General (toate dificultățile).',
        'invalid_beatmap_id' => 'Dificultatea specificată nu este validă.',
        'invalid_beatmapset_id' => 'Beatmapul specificat nu este valid.',
        'locked' => 'Discuția este închisă.',

        'attributes' => [
            'message_type' => 'Tipul mesajului',
            'timestamp' => 'Dată/Oră',
        ],

        'hype' => [
            'guest' => 'Trebuie să fii autentificat pentru a acorda un hype.',
            'hyped' => 'Deja ai acordat un hype acestui beatmap.',
            'limit_exceeded' => 'Ți-ai folosit deja tot hype-ul.',
            'not_hypeable' => 'Acest beatmap nu poate fi hyped',
            'owner' => 'Nu ii poți acorda un hype propriului tău beatmap.',
        ],

        'timestamp' => [
            'exceeds_beatmapset_length' => 'Marcajul de timp specificat este dincolo de lungimea beatmapului.',
            'negative' => "Marcajul de timp nu poate fi negativ.",
        ],
    ],

    'comment' => [
        'deleted_parent' => 'Nu este permis să răspunzi la un comentariu șters.',

        'attributes' => [
            'message' => 'Mesajul',
        ],
    ],

    'follow' => [
        'invalid' => '',
    ],

    'forum' => [
        'feature_vote' => [
            'not_feature_topic' => 'Poți vota doar o cerere de funcții.',
            'not_enough_feature_votes' => 'Voturi insuficiente.',
        ],

        'poll_vote' => [
            'invalid' => 'Opțiunea specificată este invalidă.',
        ],

        'post' => [
            'beatmapset_post_no_delete' => 'Ștergerea metadatei unui beatmap nu este permisă.',
            'beatmapset_post_no_edit' => 'Editarea metadatei unui beatmap nu este permisă.',
            'only_quote' => 'Răspunsul tău conţine doar un citat.',

            'attributes' => [
                'post_text' => '',
            ],
        ],

        'topic' => [
            'attributes' => [
                'topic_title' => 'Titlul subiectului',
            ],
        ],

        'topic_poll' => [
            'duplicate_options' => 'Opțiunile duplicate nu sunt permise.',
            'grace_period_expired' => 'Nu poți edita un sondaj după mai mult de :limit ore',
            'hiding_results_forever' => '',
            'invalid_max_options' => 'Opțiunea per utilizator nu poate depăși numărul de opțiuni disponibile.',
            'minimum_one_selection' => 'Este necesar cel puțin o opțiune per utilizator.',
            'minimum_two_options' => 'Este nevoie de cel puțin două opțiuni.',
            'too_many_options' => 'Ai depășit numărul maxim de opțiuni permise.',

            'attributes' => [
                'title' => 'Titlu sondaj',
            ],
        ],

        'topic_vote' => [
            'required' => 'Selectează o opțiune când votezi.',
            'too_many' => 'Ai selectat mai multe opțiuni decât este permis.',
        ],
    ],

    'oauth' => [
        'client' => [
            'too_many' => '',
            'url' => '',

            'attributes' => [
                'name' => '',
                'redirect' => '',
            ],
        ],
    ],

    'user' => [
        'contains_username' => 'Parola nu poate conține numele de utilizator.',
        'email_already_used' => 'Adresa de e-mail este deja folosită.',
        'invalid_country' => 'Țara nu se află în baza de date.',
        'invalid_discord' => 'Nume de utilizator Discord invalid.',
        'invalid_email' => "Nu pare să fie o adresă de e-mail validă.",
        'too_short' => 'Parola nouă este prea scurtă.',
        'unknown_duplicate' => 'Numele de utilizator sau adresa de e-mail sunt deja folosite.',
        'username_available_in' => 'Acest nume de utilizator va fi disponibil pentru utilizare în :duration.',
        'username_available_soon' => 'Acest nume de utilizator va fi disponibil pentru utilizare în orice moment de acum!',
        'username_invalid_characters' => 'Numele de utilizator solicitat conține caractere invalide.',
        'username_in_use' => 'Numele de utilizator este deja folosit!',
        'username_locked' => 'Numele de utilizator este deja luat!', // TODO: language for this should be slightly different.
        'username_no_space_userscore_mix' => 'Te rugăm să folosești fie underscore, fie spații, nu ambele!',
        'username_no_spaces' => "Numele de utilizator nu poate începe sau termina cu spații!",
        'username_not_allowed' => 'Acest nume de utilizator nu este permis.',
        'username_too_short' => 'Numele de utilizator solicitat este prea scurt.',
        'username_too_long' => 'Numele de utilizator solicitat este prea lung.',
        'weak' => 'Parolă interzisă.',
        'wrong_current_password' => 'Parola curentă este incorectă.',
        'wrong_email_confirmation' => 'Confirmarea e-mailului nu se potrivește.',
        'wrong_password_confirmation' => 'Parola de confirmare nu se potrivește.',
        'too_long' => 'Ai depășit lungimea maximă - nu poate fi decât până la :limit caractere.',

        'attributes' => [
            'username' => 'Nume de utilizator',
            'user_email' => 'Adresă de e-mail',
            'password' => 'Parolă',
        ],

        'change_username' => [
            'restricted' => 'Nu iți poți schimba numele de utilizator cât timp ești restricționat.',
            'supporter_required' => [
                '_' => 'Trebuie să :link pentru a-ți schimba numele!',
                'link_text' => 'fii un suporter osu!',
            ],
            'username_is_same' => 'Acesta este deja numele tău de utilizator, prostuțule!',
        ],
    ],

    'user_report' => [
        'reason_not_valid' => '',
        'self' => "Nu te poți raporta pe tine însuți!",
    ],

    'store' => [
        'order_item' => [
            'attributes' => [
                'quantity' => 'Cantitate',
                'cost' => 'Cost',
            ],
        ],
    ],
];
