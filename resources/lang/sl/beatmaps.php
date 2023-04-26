<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'discussion-votes' => [
        'update' => [
            'error' => 'Neuspešna posodobitev glasovanja',
        ],
    ],

    'discussions' => [
        'allow_kudosu' => 'dovoli kudosu',
        'beatmap_information' => 'Stran beatmap',
        'delete' => 'odstrani',
        'deleted' => 'Odstranil :editor :delete_time.',
        'deny_kudosu' => 'zavrni kudosu',
        'edit' => 'uredi',
        'edited' => 'Uredil :editor :update_time.',
        'guest' => 'Gostiteljeva težavnost od :user',
        'kudosu_denied' => 'Zavrnjena pridobitev kudosu.',
        'message_placeholder_deleted_beatmap' => 'Ta težavnost je bila odstranjena in razprava ni več mogoča.',
        'message_placeholder_locked' => 'Razprava ta to beatmapo je bila onemogočena.',
        'message_placeholder_silenced' => "Objava pogovora ni mogoča medtem, ko si utišan.",
        'message_type_select' => 'Izberi Tip Komentarja',
        'reply_notice' => 'Pritisni enter za odgovor.',
        'reply_placeholder' => 'Vnesi svoj odgovor tukaj',
        'require-login' => 'Za objavo ali odgovor se prijavi',
        'resolved' => 'Rešeno',
        'restore' => 'povrni',
        'show_deleted' => 'Prikaži izbrisano',
        'title' => 'Razprave',

        'collapse' => [
            'all-collapse' => 'Strni vse',
            'all-expand' => 'Razširi vse',
        ],

        'empty' => [
            'empty' => 'Ni še razprav!',
            'hidden' => 'Nobena razprava ne ustreza izbranim filtrom.',
        ],

        'lock' => [
            'button' => [
                'lock' => 'Zakleni razpravo',
                'unlock' => 'Odkleni razpravo',
            ],

            'prompt' => [
                'lock' => 'Razlog za zaklep',
                'unlock' => 'Ali si prepričan za odklepanje?',
            ],
        ],

        'message_hint' => [
            'in_general' => 'Ta objava bo objavljena v splošno razpravo beatmap. Za moddanje te beatmape, pri sporočilu začni s časovno oznako (npr. 00:12:345).',
            'in_timeline' => 'Za moddanje več časovnih oznak, objavi to večkrat (ena objava na časovno oznako).',
        ],

        'message_placeholder' => [
            'general' => 'Za objavo v Splošno piši tukaj (:version)',
            'generalAll' => 'Za objavo v Splošno piši tukaj (Vse težavnosti)',
            'review' => 'Za objavo pregleda piši tukaj',
            'timeline' => 'Za objavo na Časovnico piši tukaj (:version)',
        ],

        'message_type' => [
            'disqualify' => 'Diskvalificiraj',
            'hype' => 'Hype!',
            'mapper_note' => 'Opomba',
            'nomination_reset' => 'Ponastavi nominacijo',
            'praise' => 'Pohvali',
            'problem' => 'Težava',
            'problem_warning' => 'Prijavi težavo',
            'review' => 'Pregled',
            'suggestion' => 'Predlog',
        ],

        'mode' => [
            'events' => 'Zgodovina',
            'general' => 'Splošno :scope',
            'reviews' => 'Pregledi',
            'timeline' => 'Časovnica',
            'scopes' => [
                'general' => 'Ta težavnost',
                'generalAll' => 'Vse težavnosti',
            ],
        ],

        'new' => [
            'pin' => 'Pripni',
            'timestamp' => 'Časovna oznaka',
            'timestamp_missing' => 'Za časovno oznako pritisni ctrl-c v načinu urejanja in prilepi svoje sporočilo!',
            'title' => 'Nova razprava',
            'unpin' => 'Odpni',
        ],

        'review' => [
            'new' => 'Nova ocena',
            'embed' => [
                'delete' => 'Odstrani',
                'missing' => '[RAZPRAVA ODSTRANJENA]',
                'unlink' => 'Odpni',
                'unsaved' => 'Neshranjeno',
                'timestamp' => [
                    'all-diff' => 'Časovnih oznak ni mogoče določiti objavam na "Vseh težavnostih".',
                    'diff' => 'Če se :type začne s časovno oznako, bo prikazan pod časovnico.',
                ],
            ],
            'insert-block' => [
                'paragraph' => 'vstavi odstavek',
                'praise' => 'vstavi pohvalo',
                'problem' => 'vnesi težavo',
                'suggestion' => 'vstavi predlog',
            ],
        ],

        'show' => [
            'title' => ':title mappal :mapper',
        ],

        'sort' => [
            'created_at' => 'Čas kreacije',
            'timeline' => 'Časovnica',
            'updated_at' => 'Nazadnje posodobljeno',
        ],

        'stats' => [
            'deleted' => 'Odstranjeno',
            'mapper_notes' => 'Zapiski',
            'mine' => 'Moje',
            'pending' => 'V teku',
            'praises' => 'Pohvale',
            'resolved' => 'Rešeno',
            'total' => 'Vse',
        ],

        'status-messages' => [
            'approved' => 'Ta beatmapa je bila sprejeta dne :date!',
            'graveyard' => "Ta beatmapa je bila postavljena v grob, ker ni bila posodobljena od :date...",
            'loved' => 'Ta beatmapa je bila dodana v loved dne :date!',
            'ranked' => 'Ta beatmapa je bila rangirana dne :date!',
            'wip' => 'Opomba: Lastnik je označil to beatmapo kot delo v teku.',
        ],

        'votes' => [
            'none' => [
                'down' => 'Ni še glasov proti',
                'up' => 'Ni še glasov za',
            ],
            'latest' => [
                'down' => 'Zadnji glasovi proti',
                'up' => 'Zadnji glasovi za',
            ],
        ],
    ],

    'hype' => [
        'button' => 'Hypaj Beatmapo!',
        'button_done' => 'Že Hypana!',
        'confirm' => "Ali si prepričan? To bo uporabilo tvoj preostali :n hype in tega ni mogoče razveljaviti.",
        'explanation' => 'Hypaj to beatmapo da bo bolj vidna za nominacije in rankiranje!',
        'explanation_guest' => 'Vpiši se in hypaj to beatmapo, da bo bolj vidna za nominacije in rankiranje!',
        'new_time' => "Nov hype boš dobil čez :new_time.",
        'remaining' => 'Imaš še :remaining hype točk.',
        'required_text' => 'Hype :current/:required',
        'section_title' => 'Hype Vlak',
        'title' => 'Hype',
    ],

    'feedback' => [
        'button' => 'Pusti povratne informacije',
    ],

    'nominations' => [
        'delete' => 'Odstrani',
        'delete_own_confirm' => 'Ali si prepričan? Beatmapa bo odstranjena in nato boš preusmerjen na svoj profil.',
        'delete_other_confirm' => 'Ali si prepričan? Beatmapa bo odstranjena in nato boš preusmerjen na igralčev profil.',
        'disqualification_prompt' => 'Razlog za diskvalifikacijo?',
        'disqualified_at' => 'Diskvalificiran :time_ago (:reason).',
        'disqualified_no_reason' => 'razlog ni naveden',
        'disqualify' => 'Diskvalificiraj',
        'incorrect_state' => 'Napaka pri izvajanju tega dejanja, poskusi osvežiti stran.',
        'love' => 'Love',
        'love_choose' => 'Izberi težavnost za loved',
        'love_confirm' => 'Obožuješ to beatmapo?',
        'nominate' => 'Nominiraj',
        'nominate_confirm' => 'Nominacija te beatmape?',
        'nominated_by' => 'nominiral :users',
        'not_enough_hype' => "Ni dovolj hype točk.",
        'remove_from_loved' => 'Odstrani iz Loved',
        'remove_from_loved_prompt' => 'Razlog za odstranitev iz Loved:',
        'required_text' => 'Nominacije: :current/:required',
        'reset_message_deleted' => 'odstranjeno',
        'title' => 'Stanje nominacije',
        'unresolved_issues' => 'Tukaj so nerešene težave, ki morajo biti najprej obravnavane.',

        'rank_estimate' => [
            '_' => 'Ta beatmapa bo približno rankirana :date če ne bo najdenih težav. Trenutno je #:position v :queue.',
            'on' => 'na :date',
            'queue' => 'čakalna vrsta rankiranja',
            'soon' => 'kmalu',
        ],

        'reset_at' => [
            'nomination_reset' => ':user je ponastavil nominacijski postopek :time_ago z novo težavo :discussion (:message).',
            'disqualify' => ':user je diskvalificiral beatmapo :time_ago z novo težavo :discussion (:message).',
        ],

        'reset_confirm' => [
            'disqualify' => 'Ali si prepričan? To bo odstranilo beatmapo iz kvalificiranja in ponastavilo nominacijski postopek.',
            'nomination_reset' => 'Ali si prepričan? Objava nove težave bo ponastavilo nominacijski postopek.',
            'problem_warning' => 'Ali si prepričan za prijavo težave k tej beatmapi? To bo opozorilo Beatmap Nominatorje.',
        ],
    ],

    'listing' => [
        'search' => [
            'prompt' => 'vpiši ključne besede...',
            'login_required' => 'Za iskanje se vpiši.',
            'options' => 'Več Možnosti Iskanja',
            'supporter_filter' => 'Filtriranje po :filters je potrebna aktivna osu!supporter značka',
            'not-found' => 'ni rezultatov',
            'not-found-quote' => '... ne, nič najdeno.',
            'filters' => [
                'extra' => 'Ekstra',
                'general' => 'Splošno',
                'genre' => 'Žanr',
                'language' => 'Jezik',
                'mode' => 'Igralni način',
                'nsfw' => 'Eksplicitna Vsebina',
                'played' => 'Igrano',
                'rank' => 'Pridobljeni Rank',
                'status' => 'Kategorije',
            ],
            'sorting' => [
                'title' => 'Naslov',
                'artist' => 'Ustvarjalec',
                'difficulty' => 'Težavnost',
                'favourites' => 'Priljubljeni',
                'updated' => 'Posodobljeno',
                'ranked' => 'Rankirano',
                'rating' => 'Ocena',
                'plays' => 'Igranja',
                'relevance' => 'Ustreznost',
                'nominations' => 'Nominacije',
            ],
            'supporter_filter_quote' => [
                '_' => 'Filtriranje po :filters je potreben aktivni :link',
                'link_text' => 'osu!supporter značka',
            ],
        ],
    ],
    'general' => [
        'converts' => 'Vključi pretvorjene beatmape',
        'featured_artists' => 'Predstavljeni ustvarjalci',
        'follows' => 'Naročeni mapperji',
        'recommended' => 'Priporočena težavnost',
        'spotlights' => 'Beatmape v ospredju',
    ],
    'mode' => [
        'all' => 'Vse',
        'any' => 'Vse',
        'osu' => '',
        'taiko' => '',
        'fruits' => '',
        'mania' => '',
    ],
    'status' => [
        'any' => 'Vse',
        'approved' => 'Odobreno',
        'favourites' => 'Priljubljeni',
        'graveyard' => 'Pokopališče',
        'leaderboard' => 'Vsebuje lestvico najboljših',
        'loved' => 'Loved',
        'mine' => 'Moje beatmape',
        'pending' => 'V čakanju',
        'wip' => 'WIP',
        'qualified' => 'Kvalificirano',
        'ranked' => 'Rankirano',
    ],
    'genre' => [
        'any' => 'Vse',
        'unspecified' => 'Nedoločeno',
        'video-game' => 'Video igra',
        'anime' => 'Anime',
        'rock' => 'Rock',
        'pop' => 'Pop',
        'other' => 'Drugo',
        'novelty' => 'Novost',
        'hip-hop' => 'Hip Hop',
        'electronic' => 'Elektronska',
        'metal' => 'Metal',
        'classical' => 'Klasična',
        'folk' => 'Narodna',
        'jazz' => 'Jazz',
    ],
    'language' => [
        'any' => 'Vse',
        'english' => 'Angleščina',
        'chinese' => 'Kitajščina',
        'french' => 'Francoščina',
        'german' => 'Nemščina',
        'italian' => 'Italijanščina',
        'japanese' => 'Japonščina',
        'korean' => 'Korejščina',
        'spanish' => 'Španščina',
        'swedish' => 'Švedščina',
        'russian' => 'Ruščina',
        'polish' => 'Poljščina',
        'instrumental' => 'Instrumentalna',
        'other' => 'Drugo',
        'unspecified' => 'Nedoločeno',
    ],

    'nsfw' => [
        'exclude' => 'Skrij',
        'include' => 'Prikaži',
    ],

    'played' => [
        'any' => 'Vse',
        'played' => 'Igrano',
        'unplayed' => 'Neigrano',
    ],
    'extra' => [
        'video' => 'Vsebuje videoposnetek',
        'storyboard' => 'Vsebuje storyboard',
    ],
    'rank' => [
        'any' => 'Vse',
        'XH' => 'Srebrni SS',
        'X' => '',
        'SH' => 'Srebrni S',
        'S' => '',
        'A' => '',
        'B' => '',
        'C' => '',
        'D' => '',
    ],
    'panel' => [
        'playcount' => 'Število igranj: :count',
        'favourites' => 'Priljubljeni: :count',
    ],
    'variant' => [
        'mania' => [
            '4k' => '4K',
            '7k' => '7K',
            'all' => 'Vse',
        ],
    ],
];
