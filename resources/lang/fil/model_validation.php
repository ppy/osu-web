<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'invalid' => 'Imbalido ang nakasaad na :attribute.',
    'not_negative' => ':attribute ay bawal maging negatibo.',
    'required' => ':attribute ay kinakailangan.',
    'too_long' => ':attribute ay lumampas sa maksimum na haba - maaaring lamang maging hanggang :limit na character.',
    'wrong_confirmation' => 'Ang kumpirmasyon ay hindi tugma.',

    'beatmapset_discussion' => [
        'beatmap_missing' => 'Ang Timestamp ay tiyak ngunit ang beatmap ay nawawala.',
        'beatmapset_no_hype' => "Ang beatmap ay bawal iboto.",
        'hype_requires_null_beatmap' => 'Ang pagboto ay dapat gawin sa Pangkalahatang (lahat ng pagkahirap) seksyon.',
        'invalid_beatmap_id' => 'Imbalidong hirap ang isinaad.',
        'invalid_beatmapset_id' => 'Imbalidong beatmap ang isinaad.',
        'locked' => 'Naka-lock na ang talakayan.',

        'attributes' => [
            'message_type' => 'Uri ng mensahe',
            'timestamp' => 'Timestamp',
        ],

        'hype' => [
            'discussion_locked' => "Ang beatmap na ito ay nakakandado mula sa mga diskusyon at bawal i-hype",
            'guest' => 'Dapat nakasign-in upang makaboto.',
            'hyped' => 'Naboto mo na ang beatmap na ito.',
            'limit_exceeded' => 'Nagamit mo na ang iyong mga boto.',
            'not_hypeable' => 'Ang beatmap na ito ay hindi maaaring i-hype',
            'owner' => 'Bawal iboto ang sariling beatmap.',
        ],

        'timestamp' => [
            'exceeds_beatmapset_length' => 'Ang naturang timestamp ay lagpas sa kahabaan ng beatmap.',
            'negative' => "Ang timestamp ay bawal maging negatibo.",
        ],
    ],

    'beatmapset_discussion_post' => [
        'discussion_locked' => 'Ang talakayan na ito ay nakakandado.',
        'first_post' => 'Bawal burahin ang nasimulang post.',

        'attributes' => [
            'message' => 'Mensahe',
        ],
    ],

    'comment' => [
        'deleted_parent' => 'Hindi maaaring tumugon sa binurang komento.',
        'top_only' => 'Ang pag-aspile sa komentong tugon ay ipinagbabawal.',

        'attributes' => [
            'message' => 'Mensahe',
        ],
    ],

    'follow' => [
        'invalid' => 'Imbalidong :attribute ang isinaad.',
    ],

    'forum' => [
        'feature_vote' => [
            'not_feature_topic' => 'Maaari lamang bumoto sa kahilingang itinampok.',
            'not_enough_feature_votes' => 'Hindi sapat ang mga boto.',
        ],

        'poll_vote' => [
            'invalid' => 'Imbalidong opsyon ang isinaad.',
        ],

        'post' => [
            'beatmapset_post_no_delete' => 'Ang pagbasura sa beatmap metadata post ay ipinagbabawal.',
            'beatmapset_post_no_edit' => 'Ang pag-edit sa beatmap metadata post ay ipinagbabawal.',
            'first_post_no_delete' => 'Bawal burahin ang nasimulang post',
            'missing_topic' => 'Walang paksa ang iyong post',
            'only_quote' => 'Ang iyong tugon ay naglalaman lamang ng sipi.',

            'attributes' => [
                'post_text' => 'Katawan',
            ],
        ],

        'topic' => [
            'attributes' => [
                'topic_title' => 'Titulo ng paksa',
            ],
        ],

        'topic_poll' => [
            'duplicate_options' => 'Ang naulit na opsyon ay ipinagbabawal.',
            'grace_period_expired' => 'Bawal mag-edit ng poll nang hindi lalampas sa :limit na oras.',
            'hiding_results_forever' => 'Bawal itago ang resulta ng poll na hindi natatapos.',
            'invalid_max_options' => 'Ang opsyon ng bawat user ay hindi maaaraing lumampas sa bilang ng mga naturang opsyon.',
            'minimum_one_selection' => 'Kinakailangan ng hindi kukulang sa isang opsyon bawat user.',
            'minimum_two_options' => 'Kailangan ng hindi kukulang sa dalawang opsyon.',
            'too_many_options' => 'Lampas sa pinakamalaking bilang ng nararapat na mga opsyon.',

            'attributes' => [
                'title' => 'Pamagat ng poll',
            ],
        ],

        'topic_vote' => [
            'required' => 'Pumili ng opsyon kapag bumoboto.',
            'too_many' => 'Nakapali ng nakahihigit na opsyon na pinahihintulutan.',
        ],
    ],

    'oauth' => [
        'client' => [
            'too_many' => 'Lampas sa pinakamalaking bilang ng pinahihintulutang OAuth na aplikasyon.',
            'url' => 'Maglaan ng tamang URL.',

            'attributes' => [
                'name' => 'Pangalan ng Aplikasyon',
                'redirect' => 'Application Callback URL',
            ],
        ],
    ],

    'user' => [
        'contains_username' => 'Ang password ay hindi dapat naglalaman ng username.',
        'email_already_used' => 'Nagamit na ang email address.',
        'email_not_allowed' => 'Ipinagbabawal ang naturang email address.',
        'invalid_country' => 'Ang bansa ay wala sa database.',
        'invalid_discord' => 'Invalid ang Discord username.',
        'invalid_email' => "Parang hindi ito balidong email address.",
        'invalid_twitter' => 'Invalid ang Twitter username.',
        'too_short' => 'Ang bagong password ay napakaikli.',
        'unknown_duplicate' => 'Ang username o email address ay nagamit na.',
        'username_available_in' => 'Ang username na ito ay muling magagamit sa loob ng :duration.',
        'username_available_soon' => 'Ang username na ito ay malapit nang magamit!',
        'username_invalid_characters' => 'Ang naturang username ay naglalaman ng mga ipinagbabawal na karakter.',
        'username_in_use' => 'Nagamit na ang username na ito!',
        'username_locked' => 'Nagamit na ang username na ito!', // TODO: language for this should be slightly different.
        'username_no_space_userscore_mix' => 'Gumamit lamang ng underscore lang o patlang lang, bawal pareho!',
        'username_no_spaces' => "Ang username ay hindi dapat magsimula o magtapos sa patlang!",
        'username_not_allowed' => 'Ang username na ito ay hindi maaaring gamitin.',
        'username_too_short' => 'Ang hinihinging username ay masyadong maikli.',
        'username_too_long' => 'Ang hinihinging username ay masyadong mahaba.',
        'weak' => 'Ipinagbabawal na password.',
        'wrong_current_password' => 'Ang naturang password ay mali.',
        'wrong_email_confirmation' => 'Ang kumpirmasyon ng email ay hindi tugma.',
        'wrong_password_confirmation' => 'Ang kumpirmasyon ng password ay hindi tugma.',
        'too_long' => 'Lumampas sa maksimum na haba - hanggang :limit na karakter lamang ang pwede.',

        'attributes' => [
            'username' => 'Username',
            'user_email' => 'Email Address',
            'password' => 'Password',
        ],

        'change_username' => [
            'restricted' => 'Hindi ka pwedeng magpalit ng username habang ikaw ay restricted.',
            'supporter_required' => [
                '_' => 'Kailangan mo ang :link upang mabago ang iyong pangalan!',
                'link_text' => 'sumuporta sa osu!',
            ],
            'username_is_same' => 'Username mo ito ngayon!',
        ],
    ],

    'user_report' => [
        'no_ranked_beatmapset' => 'Hindi pwede i-report ang mga Ranked beatmaps',
        'reason_not_valid' => 'Ang rason na:reason ay hindi akma sa ganitong uri ng report.',
        'self' => "Hindi mo maaaring i-report ang sarili mo!",
    ],

    'store' => [
        'order_item' => [
            'attributes' => [
                'quantity' => 'Bilang',
                'cost' => 'Halaga',
            ],
        ],
    ],
];
