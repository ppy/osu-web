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
    'discussion-posts' => [
        'store' => [
            'error' => 'Nabigong isave ang post',
        ],
    ],

    'discussion-votes' => [
        'update' => [
            'error' => 'Nabigong i-update ang boto',
        ],
    ],

    'discussions' => [
        'allow_kudosu' => 'payang ang kudosu',
        'beatmap_information' => '',
        'delete' => 'tanggalin',
        'deleted' => 'Tinanggal ni :editor :delete_time.',
        'deny_kudosu' => 'itanggi ang kudosu',
        'edit' => 'I-edit',
        'edited' => 'Huling na-edit ni :editor :update_time.',
        'kudosu_denied' => 'Natanggi sa pagtamo ng kudosu.',
        'message_placeholder_deleted_beatmap' => 'Ang difficulty na ito ay naburo na kaya ito\'y hindi na madidiscuss.',
        'message_placeholder_locked' => 'Ang talakayan para sa beatmap na ito ay isinara na.',
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
            'empty' => 'Wala pang diskusyon!',
            'hidden' => 'Walang diskusyon ang tumutugma sa napiling filter.',
        ],

        'lock' => [
            'button' => [
                'lock' => 'Isara ang talakayan',
                'unlock' => 'Buksan ang talakayan',
            ],

            'prompt' => [
                'lock' => 'Katwiran sa pagsara',
                'unlock' => 'Sigurado ka bang ibuksan?',
            ],
        ],

        'message_hint' => [
            'in_general' => 'Ang post na ito ay pupunta sa general beatmapset discussion. Para ma-mod tong beatmap, magsimula ng mensahe na may timestamp (hal. 00:12:345).',
            'in_timeline' => 'Para magmod ng maraming timestamps, magpost ng maraming beses (isang post kada timestamp).',
        ],

        'message_placeholder' => [
            'general' => 'Mag-type dito upang mag-post sa General (:version)',
            'generalAll' => 'Mag-type dito upang mag-post sa General (Lahat ng mga difficulty)',
            'timeline' => 'Mag-type dito upang mag-post sa Timeline (:version)',
        ],

        'message_type' => [
            'disqualify' => 'I-disqualify',
            'hype' => 'Hype!',
            'mapper_note' => 'Paalala',
            'nomination_reset' => 'I-reset ang nominasyon',
            'praise' => 'Puri',
            'problem' => 'Problema',
            'review' => '',
            'suggestion' => 'Suhestyon',
        ],

        'mode' => [
            'events' => 'Kasaysayan',
            'general' => 'Kabuuan :scope',
            'reviews' => '',
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
                'down' => '',
                'up' => '',
            ],
            'latest' => [
                'down' => '',
                'up' => '',
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
        'love_confirm' => 'I-love ang beatmap na ito?',
        'nominate' => 'Inomina',
        'nominate_confirm' => 'Inomina ang beatmap?',
        'nominated_by' => 'ininomina nina :users',
        'not_enough_hype' => "",
        'qualified' => 'Inestima na mararank :date, kung walang isyu na nahanap.',
        'qualified_soon' => 'Inestima na mararank sa hinaharap, kung walang isyu na nahanap.',
        'required_text' => 'Nominasyon: :current/:required',
        'reset_message_deleted' => 'tinanggal',
        'title' => 'Status ng Nominasyon',
        'unresolved_issues' => 'Kung mayroon pang mga di nasosolusyonan na isyu na dapat na i-address muna.',

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
                'general' => 'Pangkalahatan',
                'mode' => 'Mode',
                'status' => 'Mga Kategorya',
                'genre' => 'Genre',
                'language' => 'Wika',
                'extra' => 'extra',
                'rank' => 'Naabot na Rank',
                'played' => 'Nalaro',
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
        'recommended' => 'Nirerekomenda na difficulty',
        'converts' => 'Kasamang converted beatmaps',
    ],
    'mode' => [
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
        'Relax' => '',
        'SD' => '',
        'SO' => '',
        'TD' => '',
    ],
    'language' => [
        'any' => '',
        'english' => 'Ingles',
        'chinese' => 'Intsik',
        'french' => 'Pranses',
        'german' => 'German',
        'italian' => 'Italyano',
        'japanese' => 'Hapon',
        'korean' => 'Koreano',
        'spanish' => 'Espanyol',
        'swedish' => 'Swedish',
        'instrumental' => 'Instrumental',
        'other' => 'Iba pa',
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
];
