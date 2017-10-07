<?php

/**
 *    Copyright 2015-2017 ppy Pty. Ltd.
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
    'deleted' => '[삭제된 사용자]',

    'login' => [
        '_' => '로그인',
        'locked_ip' => 'IP 주소가 잠겨있습니다. 잠시 기다려주세요.',
        'username' => '유저이름',
        'password' => '비밀번호',
        'button' => '로그인',
        'button_posting' => '로그인 중...',
        'remember' => '이 컴퓨터에서 계정 정보 기억하기',
        'title' => '계속하려면 로그인해 주세요',
        'failed' => '계정 정보가 올바르지 않습니다',
        'register' => "osu!계정이 없으신가요? 새로 하나 만들어보세요",
        'forgot' => '비밀번호를 잊어버리셨나요?',
        'beta' => [
            'main' => '베타 권한은 현재 일부 특수 사용자만 가지고 있습니다.',
            'small' => '(서포터들도 곧 받게 될 거에요)',
        ],

        'here' => '이곳', // this is substituted in when generating a link above. change it to suit the language.
    ],
    'signup' => [
        '_' => '회원가입',
    ],
    'anonymous' => [
        'login_link' => '클릭하여 로그인',
        'username' => '손님',
        'error' => '계속하려면 로그인하셔야 합니다.',
    ],
    'logout_confirm' => '정말 로그아웃 하실건가요? :(',
    'restricted_banner' => [
        'title' => '계정이 제한되어 있습니다!',
        'message' => '계정이 제한되어있으면, 다른 플레이어와 소통할 수 없으며 점수가 본인에게만 표시됩니다. 계정 제한은 보통 자동적으로 처리되며, 24시간 이내에 철회될 수 있습니다. 제한에 대한 항소를 원하시면, <a href="mailto:accounts@ppy.sh">지원팀에 연락</a>해주시기 바랍니다.',
    ],
    'show' => [
        '404' => '사용자를 찾을 수 없습니다! ;_;',
        'age' => ':age살',
        'current_location' => ':location에 거주',
        'first_members' => 'Here since the beginning',
        'is_developer' => 'osu!개발자',
        'is_supporter' => 'osu!서포터',
        'joined_at' => ':date에 가입',
        'lastvisit' => ':date에 마지막으로 접속',
        'missingtext' => '오타가 있는 것 같은데요! (그게 아니라면 차단된 사용자일 수 있습니다)',
        'origin_age' => ':age',
        'origin_country' => ':country에 거주',
        'origin_country_age' => ':age, :country에 거주',
        'page_description' => 'osu! - Everything you ever wanted to know about :username!',
        'plays_with' => '플레이 장비: :devices',
        'title' => ":username님의 프로필",

        'edit' => [
            'cover' => [
                'button' => '프로필 표지 변경',
                'defaults_info' => '이후에 더 많은 표지 설정이 추가됩니다',
                'upload' => [
                    'broken_file' => '이미지 처리 실패. 업로드하려는 이미지를 확인하시고 다시 시도해주세요.',
                    'button' => '이미지 업로드',
                    'dropzone' => '업로드하려면 여기에 끌어놓으세요',
                    'dropzone_info' => '이쪽에 이미지를 끌어놓아 업로드할수도 있습니다',
                    'restriction_info' => "<a href='".osu_url('support-the-game')."' target='_blank'>osu!서포터</a>만 업로드할 수 있습니다",
                    'size_info' => '표지 크기는 2000x700 이여야 합니다',
                    'too_large' => '업로드된 파일이 너무 큽니다.',
                    'unsupported_format' => '지원되지 않는 확장자입니다.',
                ],
            ],
        ],
        'extra' => [
            'followers' => '1 follower|:count followers',
            'unranked' => '최근 플레이가 없습니다',

            'achievements' => [
                'title' => '업적',
                'achieved-on' => ':date에 달성함',
            ],
            'beatmaps' => [
                'title' => '비트맵',
            ],
            'historical' => [
                'empty' => 'No performance records. :(',
                'most_played' => [
                    'count' => 'times played',
                    'title' => 'Most Played Beatmaps',
                ],
                'recent_plays' => [
                    'accuracy' => 'accuracy: :percentage',
                    'title' => 'Recent Plays (24h)',
                ],
                'title' => 'Historical',
            ],
            'kudosu' => [
                'available' => 'Kudosu Available',
                'available_info' => "Kudosu can be traded for kudosu stars, which will help your beatmap get more attention. This is the number of kudosu you haven't traded in yet.",
                'recent_entries' => 'Recent Kudosu History',
                'title' => 'Kudosu!',
                'total' => 'Total Kudosu Earned',
                'total_info' => 'Based on how much of a contribution the user has made to beatmap moderation. See <a href="'.osu_url('user.kudosu').'">this page</a> for more information.',

                'entry' => [
                    'amount' => ':amount kudosu',
                    'empty' => "This user hasn't received any kudosu!",

                    'beatmap_discussion' => [
                        'allow_kudosu' => [
                            'give' => 'Received :amount from kudosu deny repeal of modding post :post',
                        ],

                        'deny_kudosu' => [
                            'reset' => 'Denied :amount from modding post :post',
                        ],

                        'delete' => [
                            'reset' => 'Lost :amount from modding post deletion of :post',
                        ],

                        'restore' => [
                            'give' => 'Received :amount from modding post restoration of :post',
                        ],

                        'vote' => [
                            'give' => 'Received :amount from obtaining votes in modding post of :post',
                            'reset' => 'Lost :amount from losing votes in modding post of :post',
                        ],
                    ],

                    'forum_post' => [
                        'give' => 'Received :amount from :giver for a post at :post',
                        'reset' => 'Kudosu reset by :giver for the post :post',
                        'revoke' => 'Denied kudosu by :giver for the post :post',
                    ],
                ],
            ],
            'me' => [
                'title' => 'me!',
            ],
            'medals' => [
                'empty' => "This user hasn't gotten any yet. ;_;",
                'title' => 'Medals',
            ],
            'recent_activities' => [
                'title' => 'Recent',
            ],
            'top_ranks' => [
                'best' => [
                    'title' => 'Best Performance',
                ],
                'empty' => 'No awesome performance records yet. :(',
                'first' => [
                    'title' => 'First Place Ranks',
                ],
                'pp' => ':amountpp',
                'title' => 'Ranks',
                'weighted_pp' => 'weighted: :pp (:percentage)',
            ],
            'beatmaps' => [
                'title' => 'Beatmaps',
                'favourite' => [
                    'title' => 'Favourite Beatmaps (:count)',
                ],
                'ranked_and_approved' => [
                    'title' => 'Ranked & Approved Beatmaps (:count)',
                ],
                'none' => 'None... yet.',
            ],
        ],
        'page' => [
            'description' => '<strong>me!</strong> is a personal customisable area in your profile page.',
            'edit_big' => 'Edit me!',
            'placeholder' => 'Type page content here',
            'restriction_info' => "You need to be an <a href='".osu_url('support-the-game')."' target='_blank'>osu!supporter</a> to unlock this feature.",
        ],
        'rank' => [
            'country' => 'Country rank for :mode',
            'global' => 'Global rank for :mode',
        ],
        'stats' => [
            'hit_accuracy' => '명중률',
            'level' => '레벨 :level',
            'maximum_combo' => '최대 콤보 수',
            'play_count' => '플레이 횟수',
            'ranked_score' => '기록된 점수',
            'replays_watched_by_others' => '다른 플레이어가 관전한 횟수',
            'score_ranks' => 'Score Ranks',
            'total_hits' => 'Total Hits',
            'total_score' => 'Total Score',
        ],
    ],
    'status' => [
        'online' => '온라인',
        'offline' => '오프라인',
    ],
    'store' => [
        'saved' => 'User created',
    ],
    'verify' => [
        'title' => 'Account Verification',
    ],
];
