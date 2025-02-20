<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'invalid' => 'Nepareizs :attribute specificēts.',
    'not_negative' => ':attribute nevar būt negatīvs.',
    'required' => ':attribute ir nepieciešams.',
    'too_long' => ':attribute pārsniedza maksimālo garumu - drīkst būt tikai līdz :limit zīmēm.',
    'url' => 'Lūdzu ievadi pareizu URL.',
    'wrong_confirmation' => 'Apstiprinājums nesakrīt.',

    'beatmapset_discussion' => [
        'beatmap_missing' => 'Laika skala ir norādīta, bet trūkst ritma-mape.',
        'beatmapset_no_hype' => "Ritma-mapi nevar uzslavēt.",
        'hype_requires_null_beatmap' => 'Publikācija ir jāuzstāda Galvenajā (visu sarežģītību) sadaļā.',
        'invalid_beatmap_id' => 'Nederīgs sarežģījums norādīts.',
        'invalid_beatmapset_id' => 'Nederīga ritma-mape norādīta.',
        'locked' => 'Diskusija ir slēgta.',

        'attributes' => [
            'message_type' => 'Ziņojuma tips',
            'timestamp' => 'Laika josla',
        ],

        'hype' => [
            'discussion_locked' => "Šī ritma-mape ir pašlaik aizvērta diskusijām, un to nevar ",
            'guest' => 'Ir jāielogojas, lai uzslavētu.',
            'hyped' => 'Tu jau esi uzslavējis šo ritma-mapi.',
            'limit_exceeded' => 'Tu esi izmantojis visus savus uzslavējumus.',
            'not_hypeable' => 'Šo ritma-mapi nevar uzslavēt',
            'owner' => 'Nevar uzslavēt pats savu ritma-mapi.',
        ],

        'timestamp' => [
            'exceeds_beatmapset_length' => 'Norādītā laika josla ir pārsniegusi ritma-mapes garumu.',
            'negative' => "Laika josla nevar būt negatīva.",
        ],
    ],

    'beatmapset_discussion_post' => [
        'discussion_locked' => 'Diskusijas ir aizvērtas.',
        'first_post' => 'Nevar izdzēst pašu pirmo rakstu.',

        'attributes' => [
            'message' => 'Ziņa',
        ],
    ],

    'comment' => [
        'deleted_parent' => 'Atbildēšana uz izdzēstu komentāru nav atļauta.',
        'top_only' => 'Nav atļauts piespraust komentāra atbildi.',

        'attributes' => [
            'message' => 'Ziņa',
        ],
    ],

    'follow' => [
        'invalid' => 'Nederīgs:attribute norādīts.',
    ],

    'forum' => [
        'feature_vote' => [
            'not_feature_topic' => 'Var tikai balsot iezīmētu pieprasījumu.',
            'not_enough_feature_votes' => 'Nav pietiekami daudz balsu.',
        ],

        'poll_vote' => [
            'invalid' => 'Nederīga opcija norādīta.',
        ],

        'post' => [
            'beatmapset_post_no_delete' => 'Nav atļauts izdzēst ritma-mapes metadatu rakstu.',
            'beatmapset_post_no_edit' => 'Nedrīkst rediğēt ritma-mapes metadatu rakstu.',
            'first_post_no_delete' => 'Nevar izdzēst pašu pirmo rakstu',
            'missing_topic' => 'Rakstam pietrūkst temats',
            'only_quote' => 'Tava atbilde satur tikai citējumu.',

            'attributes' => [
                'post_text' => 'Publicēt pamatu',
            ],
        ],

        'topic' => [
            'attributes' => [
                'topic_title' => 'Temata virsraksts',
            ],
        ],

        'topic_poll' => [
            'duplicate_options' => 'Dublicēta opcija nav atļauta.',
            'grace_period_expired' => 'Nevar rediğēt aptauju pēc vairāk nekā :limit stundām.',
            'hiding_results_forever' => 'Nevar paslēpt nekad nebeidzošas aptaujas rezultātus.',
            'invalid_max_options' => 'Lietotāja maksimālo opciju izvēle nevar pārsniegt pieejamo opciju skaitu.',
            'minimum_one_selection' => 'Minimums viena opcija katram lietotājam ir nepieciešama.',
            'minimum_two_options' => 'Vajag vismaz divas opcijas.',
            'too_many_options' => 'Pārsniedzi maksimālo atļauto opciju skaitu.',

            'attributes' => [
                'title' => 'Aptaujas virsraksts',
            ],
        ],

        'topic_vote' => [
            'required' => 'Izvēlies opciju kad balso.',
            'too_many' => 'Izvēlētas vairāk opcijas nekā atļautas.',
        ],
    ],

    'legacy_api_key' => [
        'exists' => 'Pašlaik tikai viena API atslēga ir iedota lietotājiem.',

        'attributes' => [
            'api_key' => 'api atslēga',
            'app_name' => 'aplikācijas nosaukums',
            'app_url' => 'aplikācijas url',
        ],
    ],

    'oauth' => [
        'client' => [
            'too_many' => 'Pārsniedzi maksimālo OAuth aplikāciju skaitu.',
            'url' => 'Lūdzu ievadi pareizu URL adresi.',

            'attributes' => [
                'name' => 'Aplikācijas Nosaukums',
                'redirect' => 'Aplikācijas Atsaukuma URL',
            ],
        ],
    ],

    'user' => [
        'contains_username' => 'Parole nedrīkst saturēt lietotājvārdu.',
        'email_already_used' => 'E-pasta adrese jau tiek lietota.',
        'email_not_allowed' => 'E-pasta adrese nav atļauta.',
        'invalid_country' => 'Valsts nav datubāzē.',
        'invalid_discord' => 'Discorda lietotājvārds ir nepareizs.',
        'invalid_email' => "Neizskatās pēc pareizas e-pasta adreses.",
        'invalid_twitter' => 'Twittera lietotājvārds ir nepareizs.',
        'too_short' => 'Jaunā parole ir pārāk īsa.',
        'unknown_duplicate' => 'Lietotājvārds vai e-pasts jau ir izmantots.',
        'username_available_in' => 'Šis lietotājvārds būs pieejams izmantošanai pēc :duration.',
        'username_available_soon' => 'Šis lietotājvārds būs pieejams izmantošanai, jebkuru katru brīdi!',
        'username_invalid_characters' => 'Pieprasītais lietotājvārds satur neatļautas rakstzīmes.',
        'username_in_use' => 'Lietotājvārds jau tiek lietots!',
        'username_locked' => 'Lietotājvārds jau tiek lietots!', // TODO: language for this should be slightly different.
        'username_no_space_userscore_mix' => 'Lūdzi izmantot vai nu apakšsvītras vai atstarpes, nevis abas!',
        'username_no_spaces' => "Lietotājvārds nevar sākties vai beigties ar atstarpēm!",
        'username_not_allowed' => 'Šī lietotājvārda izvēle nav atļauta.',
        'username_too_short' => 'Pieprasītais lietotājvārds ir par īsu.',
        'username_too_long' => 'Pieprasītais lietotājvārds ir par garu.',
        'weak' => 'Parole melnajā sarakstā.',
        'wrong_current_password' => 'Pašreizējā parole ir nepareiza.',
        'wrong_email_confirmation' => 'E-pasta apstiprinājums nesakrīt.',
        'wrong_password_confirmation' => 'Paroles apstiprinājums neatbilst.',
        'too_long' => 'Pārsniedza maksimālo garumu - drīkst būt tikai līdz :limit zīmēm.',

        'attributes' => [
            'username' => 'Lietotājvārds',
            'user_email' => 'E-pasta adrese',
            'password' => 'Parole',
        ],

        'change_username' => [
            'restricted' => 'Tu nevari nomainīt savu lietotājvārdu, kamēr tu esi ierobežots.',
            'supporter_required' => [
                '_' => 'Tev vajag :link , lai nomainītu savu lietotājvārdu!',
                'link_text' => 'atbalstīja osu!',
            ],
            'username_is_same' => 'Šis jau ir tavs lietotājvārds, pookie!',
        ],
    ],

    'user_report' => [
        'no_ranked_beatmapset' => 'Novērtējamas ritma-mapes nevar tikt nosūdzētas',
        'not_in_channel' => 'Tu neesi šajā kanālā.',
        'reason_not_valid' => ':reason nav saistīts ar šīs sūdzības tipu.',
        'self' => "Tu nevari nosūdzēt pats sevi!",
    ],

    'store' => [
        'order_item' => [
            'attributes' => [
                'quantity' => 'Daudzums',
                'cost' => 'Izmaksas',
            ],
        ],
    ],
];
