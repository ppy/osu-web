<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'discussion-votes' => [
        'update' => [
            'error' => 'Nabigong i-update ang boto',
        ],
    ],

    'discussions' => [
        'allow_kudosu' => 'payang ang kudosu',
        'beatmap_information' => 'Pahina ng Beatmap',
        'delete' => 'tanggalin',
        'deleted' => 'Tinanggal ni :editor :delete_time.',
        'deny_kudosu' => 'itanggi ang kudosu',
        'edit' => 'I-edit',
        'edited' => 'Huling na-edit ni :editor :update_time.',
        'guest' => 'Guest difficulty ni :user',
        'kudosu_denied' => 'Natanggi sa pagtamo ng kudosu.',
        'message_placeholder_deleted_beatmap' => 'Ang difficulty na ito ay naburo na kaya ito\'y hindi na madidiscuss.',
        'message_placeholder_locked' => 'Ang talakayan para sa beatmap na ito ay isinara na.',
        'message_placeholder_silenced' => "Hindi maaaring magpost ng diskusyon habang pinatahimik.",
        'message_type_select' => 'Piliin ang tipo ng komento',
        'reply_notice' => 'Pindutin ang Enter para magreply.',
        'reply_placeholder' => 'I-type ang mensahe dito',
        'require-login' => 'Mag sign in para makapagpaskil o makasagot',
        'resolved' => 'Nalutas',
        'restore' => 'ibalik',
        'show_deleted' => 'Ipakita ang tinanggal',
        'title' => 'Diskusyon',

        'collapse' => [
            'all-collapse' => 'Icollapse lahat',
            'all-expand' => 'Iexpand lahat',
        ],

        'empty' => [
            'empty' => 'Wala pang pagtalakay!',
            'hidden' => 'Walang pagtalakay na tumugma sa napiling filter.',
        ],

        'lock' => [
            'button' => [
                'lock' => 'Isara ang talakayan',
                'unlock' => 'Buksan ang talakayan',
            ],

            'prompt' => [
                'lock' => 'Katwiran sa pagsara',
                'unlock' => 'Sigurado ka bang buksan?',
            ],
        ],

        'message_hint' => [
            'in_general' => 'Ang post na ito ay pupunta sa general beatmapset discussion. Para ma-mod tong beatmap, magsimula ng mensahe na may timestamp (hal. 00:12:345).',
            'in_timeline' => 'Para magmod ng maraming timestamps, magpost ng maraming beses (isang post kada timestamp).',
        ],

        'message_placeholder' => [
            'general' => 'Mag-type dito upang mag-post sa General (:version)',
            'generalAll' => 'Mag-type dito upang mag-post sa General (Lahat ng mga difficulty)',
            'review' => 'Mag-type dito para mag-post ng review',
            'timeline' => 'Mag-type dito upang mag-post sa Timeline (:version)',
        ],

        'message_type' => [
            'disqualify' => 'I-disqualify',
            'hype' => 'Hype!',
            'mapper_note' => 'Paalala',
            'nomination_reset' => 'I-reset ang nominasyon',
            'praise' => 'Puri',
            'problem' => 'Problema',
            'review' => 'Rebyu',
            'suggestion' => 'Suhestyon',
        ],

        'mode' => [
            'events' => 'Kasaysayan',
            'general' => 'Kabuuan :scope',
            'reviews' => 'Mga Rebyu',
            'timeline' => 'Timeline',
            'scopes' => [
                'general' => 'Ganitong difficulty',
                'generalAll' => 'Lahat ng difficulty',
            ],
        ],

        'new' => [
            'pin' => 'Ipanatili',
            'timestamp' => 'Timestamp',
            'timestamp_missing' => 'ctrl-c sa edit mode at ipaste ang iyong mensahe para makapagdagdag ng timestamp!',
            'title' => 'Bagong diskusyon',
            'unpin' => 'Huwag ipanatili',
        ],

        'review' => [
            'new' => 'Bagong Rebyu',
            'embed' => [
                'delete' => 'Burahin',
                'missing' => '[BURADONG DISKUSYON]',
                'unlink' => 'I-unlink',
                'unsaved' => 'Hindi pa nai-save',
                'timestamp' => [
                    'all-diff' => 'Hindi maaaring may timestamp ang mga post sa "Lahat na difficulty".',
                    'diff' => 'Kung ang :type na ito ay nagsisimula sa isang timestamp, ito ay ipapakita sa ilalim ng Timeline.',
                ],
            ],
            'insert-block' => [
                'paragraph' => 'magdagdag ng talata',
                'praise' => 'magdagdag ng papuri',
                'problem' => 'magdagdag ng problema',
                'suggestion' => 'magdagdag ng mungkahi',
            ],
        ],

        'show' => [
            'title' => ':title inimapa ni :mapper',
        ],

        'sort' => [
            'created_at' => 'Oras ng pagkalikha',
            'timeline' => 'Timeline',
            'updated_at' => 'Huling update',
        ],

        'stats' => [
            'deleted' => 'Tinanggal',
            'mapper_notes' => 'Mga tala',
            'mine' => 'Mine',
            'pending' => 'Pending',
            'praises' => 'Praises',
            'resolved' => 'Nalutas',
            'total' => 'Lahat',
        ],

        'status-messages' => [
            'approved' => 'Ang beatmap ay naaprubahan noong :date!',
            'graveyard' => "Ang beatmap ay hindi pa nauupdated mula :date at marahil ito ay naabandona na ng may-gawa...",
            'loved' => 'Ang beatmap ay nadagdag sa loved noong :date!',
            'ranked' => 'Ang beatmap ay nasa ranked noong :date!',
            'wip' => 'Note: Ang beatmap na ito ay namarkahan na work-in-progress ng may-gawa nito.',
        ],

        'votes' => [
            'none' => [
                'down' => 'Wala pang downvote',
                'up' => 'Wala pang upvote',
            ],
            'latest' => [
                'down' => 'Mga kaka-downvote',
                'up' => 'Mga kaka-upvote',
            ],
        ],
    ],

    'hype' => [
        'button' => 'I-hype ang Beatmap!',
        'button_done' => 'Na-hype na!',
        'confirm' => "Ikaw ba ay sigurado? Ito ay gagamit sa isa sa iyong mga natitirang :n hype at hindi na maibabalik.",
        'explanation' => 'I-hype ang beatmap para ito ay maging mas kita para sa nominasyon at ranking!',
        'explanation_guest' => 'Magsign in at i-hype ang beatmap para maging mas kita para sa nominasyon at ranking!',
        'new_time' => "Makakakuha ka ulit ng hype :new_time.",
        'remaining' => 'Ikaw ay may natitirang :remaining hype.',
        'required_text' => 'Hype: :current/:required',
        'section_title' => 'Hype Train',
        'title' => 'Hype',
    ],

    'feedback' => [
        'button' => 'Mag-iwan ng suhestyon',
    ],

    'nominations' => [
        'delete' => 'Tanggalin',
        'delete_own_confirm' => 'Sigurado ka ba? Ang beatmap ay matatanggal at ikaw ay muling babalik sa iyong profile.',
        'delete_other_confirm' => 'Sigurado ka ba? Ang beatmap ay matatanggal at ikaw ay muling babalik sa profile ng user.',
        'disqualification_prompt' => 'Rason ng diskwalipikasyon?',
        'disqualified_at' => 'Nadiskwalipa :time_ago (:reason).',
        'disqualified_no_reason' => 'walang tinukoy na dahilan',
        'disqualify' => 'I-disqualify',
        'incorrect_state' => 'Nagkaerror sa paggawa ng aksyon, subukang irefresh ang page.',
        'love' => 'Love',
        'love_choose' => 'Pumili ng difficulty para sa loved',
        'love_confirm' => 'I-love ang beatmap na ito?',
        'nominate' => 'Inomina',
        'nominate_confirm' => 'Inomina ang beatmap?',
        'nominated_by' => 'ininomina nina :users',
        'not_enough_hype' => "Kulang pa ang hype.",
        'remove_from_loved' => 'Tinanggal sa Loved',
        'remove_from_loved_prompt' => 'Dahilan kung bakit tinanggal sa Loved:',
        'required_text' => 'Nominasyon: :current/:required',
        'reset_message_deleted' => 'tinanggal',
        'title' => 'Status ng Nominasyon',
        'unresolved_issues' => 'Kung mayroon pang mga di nasosolusyonan na isyu na dapat na i-address muna.',

        'rank_estimate' => [
            '_' => 'Ang mapa na ito ay tatantiyahin na maging ranked sa :date kapag walang isyu ang nahanap. Nasa ika-#:position  ng :queue.',
            'queue' => 'pila ng ranking',
            'soon' => 'malapit na',
        ],

        'reset_at' => [
            'nomination_reset' => 'Ang proseso ng nominasyon ay nareset :time_ago ni :user na may bagong problema :discussion (:message).',
            'disqualify' => 'Diniskwalipika :time_ago ni :user na may bagong problema :discussion (:message).',
        ],

        'reset_confirm' => [
            'nomination_reset' => 'Sigurado ka ba? Ang pagpopost ng bagong problema ay magsisimula muli ng proseso ng nominasyon.',
            'disqualify' => 'Sigurado ka ba? Tatanggalin nito ang beatmap mula sa pagkaka-qualified at mare-reset ang proseso ng nomination.',
        ],
    ],

    'listing' => [
        'search' => [
            'prompt' => 'magtype ng keywords...',
            'login_required' => 'Mag-sign in upang makapag-search.',
            'options' => 'Mga opsyon pa sa pagsesearch',
            'supporter_filter' => 'Ang pag fi-filter ng :filters ay nag re-require ng aktibong osu!supporter tag',
            'not-found' => 'walang resulta',
            'not-found-quote' => '... nope, walang nahanap.',
            'filters' => [
                'extra' => 'extra',
                'general' => 'Pangkalahatan',
                'genre' => 'Genre',
                'language' => 'Wika',
                'mode' => 'Mode',
                'nsfw' => 'Maselang Nilalaman',
                'played' => 'Nalaro',
                'rank' => 'Naabot na Rank',
                'status' => 'Mga Kategorya',
            ],
            'sorting' => [
                'title' => 'Pamagat',
                'artist' => 'Artist',
                'difficulty' => 'Difficulty',
                'favourites' => 'Mga Paborito',
                'updated' => 'Na-update',
                'ranked' => 'Ranked',
                'rating' => 'Rating',
                'plays' => 'Plays',
                'relevance' => 'Relevance',
                'nominations' => 'Mga Nominasyon',
            ],
            'supporter_filter_quote' => [
                '_' => 'Ang pag fi-filter ng :filters ay nag re-require ng aktibong :link',
                'link_text' => 'osu!supporter tag',
            ],
        ],
    ],
    'general' => [
        'converts' => 'Kasamang converted beatmaps',
        'featured_artists' => '',
        'follows' => 'Mga naka-subscribe na mappers',
        'recommended' => 'Nirerekomenda na difficulty',
    ],
    'mode' => [
        'all' => 'Lahat',
        'any' => 'Kahit Ano',
        'osu' => '',
        'taiko' => '',
        'fruits' => '',
        'mania' => '',
    ],
    'status' => [
        'any' => 'Kahit Ano',
        'approved' => 'Approved',
        'favourites' => 'Mga Paborito',
        'graveyard' => 'Graveyard',
        'leaderboard' => 'May leaderboard',
        'loved' => 'Loved',
        'mine' => 'Aking mga Mapa',
        'pending' => 'Pending & WIP',
        'qualified' => 'Qualified',
        'ranked' => 'Nakaranggo',
    ],
    'genre' => [
        'any' => 'Kahit Ano',
        'unspecified' => 'Hindi matukoy',
        'video-game' => 'Video Game',
        'anime' => 'Anime',
        'rock' => 'Rock',
        'pop' => 'Pop',
        'other' => 'Iba',
        'novelty' => 'Novelty',
        'hip-hop' => 'Hip Hop',
        'electronic' => 'Elektronik',
        'metal' => 'Metal',
        'classical' => 'Klasikal',
        'folk' => 'Folk',
        'jazz' => 'Jazz',
    ],
    'mods' => [
        '4K' => '',
        '5K' => '',
        '6K' => '',
        '7K' => '',
        '8K' => '',
        '9K' => '',
        'AP' => '',
        'DT' => '',
        'EZ' => '',
        'FI' => '',
        'FL' => '',
        'HD' => '',
        'HR' => '',
        'HT' => '',
        'MR' => '',
        'NC' => '',
        'NF' => '',
        'NM' => '',
        'PF' => '',
        'RX' => '',
        'SD' => '',
        'SO' => '',
        'TD' => '',
        'V2' => '',
    ],
    'language' => [
        'any' => 'Kahit Ano',
        'english' => 'Ingles',
        'chinese' => 'Intsik',
        'french' => 'Pranses',
        'german' => 'German',
        'italian' => 'Italyano',
        'japanese' => 'Hapon',
        'korean' => 'Koreano',
        'spanish' => 'Espanyol',
        'swedish' => 'Swedish',
        'russian' => 'Russian',
        'polish' => 'Polish',
        'instrumental' => 'Instrumental',
        'other' => 'Iba pa',
        'unspecified' => 'Hindi matukoy',
    ],

    'nsfw' => [
        'exclude' => 'Itago',
        'include' => 'Ipakita',
    ],

    'played' => [
        'any' => 'Kahit Ano',
        'played' => 'Nalaro',
        'unplayed' => 'Di pa nalalaro',
    ],
    'extra' => [
        'video' => 'May video',
        'storyboard' => 'May Storyboard',
    ],
    'rank' => [
        'any' => 'Kahit Ano',
        'XH' => 'Pilak na SS',
        'X' => '',
        'SH' => 'Pilak na S',
        'S' => '',
        'A' => '',
        'B' => '',
        'C' => '',
        'D' => '',
    ],
    'panel' => [
        'playcount' => 'Playcount: :count',
        'favourites' => 'Favourites: :count',
    ],
    'variant' => [
        'mania' => [
            '4k' => '4K',
            '7k' => '7K',
            'all' => 'Lahat',
        ],
    ],
];
