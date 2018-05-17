<?php

/**
 *    Copyright 2015-2018 ppy Pty. Ltd.
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

    'beatmapset_activities' => [
        'title' => ":user님의 모딩 기록",

        'discussions' => [
            'title_recent' => '최근 시작된 토론',
        ],

        'events' => [
            'title_recent' => '최근 일어난 일',
        ],

        'posts' => [
            'title_recent' => '최근 게시물',
        ],

        'votes_received' => [
            'title_most' => '가장 많이 추천 된 (지난 3개월간)',
        ],

        'votes_made' => [
            'title_most' => '가장 많이 추천됨 (지난 3개월간)',
        ],
    ],

    'card' => [
        'loading' => '로딩중...',
        'send_message' => '메시지 보내기',
    ],

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

    'posts' => [
        'title' => ':username 님의 포스트',
    ],

    'signup' => [
        '_' => '회원가입',
    ],
    'anonymous' => [
        'login_link' => '클릭하여 로그인',
        'login_text' => '로그인',
        'username' => '손님',
        'error' => '계속하려면 로그인하셔야 합니다.',
    ],
    'logout_confirm' => '정말 로그아웃 하실건가요? :(',
    'restricted_banner' => [
        'title' => '계정이 제한되어 있습니다!',
        'message' => '계정이 제한되어있으면, 다른 플레이어와 소통할 수 없으며 점수가 본인에게만 표시됩니다. 계정 제한은 보통 자동적으로 처리되며, 24시간 이내에 철회될 수 있습니다. 제한에 대한 항소를 원하시면, <a href="mailto:accounts@ppy.sh">지원팀에 연락</a>해주시기 바랍니다.',
    ],
    'show' => [
        'age' => ':age살',
        'change_avatar' => '아바타를 바꾸세요!',
        'first_members' => 'osu!의 초창기부터 함께한 유저',
        'is_developer' => 'osu!개발진',
        'is_supporter' => 'osu!서포터',
        'joined_at' => ':date에 가입',
        'lastvisit' => ':date에 마지막으로 접속',
        'missingtext' => '오타가 있는 것 같은데요! (그게 아니라면 차단된 사용자일 수 있습니다)',
        'origin_age' => ':age',
        'origin_country_age' => ':age, :country에 거주',
        'origin_country' => ':country에 거주',
        'page_description' => 'osu! - :username님에 대해 궁금했던 모든 것!',
        'previous_usernames' => '전에 사용했던 이름',
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
                    'restriction_info' => "<a href='".route('store.products.show', 'supporter-tag')."' target='_blank'>osu!서포터</a>만 업로드할 수 있습니다",
                    'size_info' => '표지 크기는 2000x700 이여야 합니다',
                    'too_large' => '업로드된 파일이 너무 큽니다.',
                    'unsupported_format' => '지원되지 않는 확장자입니다.',
                ],
            ],

            'default_playmode' => [
                'is_default_tooltip' => '기본 게임 모드',
                'set' => ':mode를 프로필 기본 게임 모드로 설정',
            ],
        ],

        'extra' => [
            'followers' => ':count ',
            'unranked' => '최근 플레이가 없습니다',

            'achievements' => [
                'title' => '업적',
                'achieved-on' => ':date에 달성함',
            ],
            'beatmaps' => [
                'none' => '아직... 없네요...',
                'title' => '비트맵',

                'favourite' => [
                    'title' => '즐겨찾기한 비트맵 (:count개)',
                ],
                'graveyard' => [
                    'title' => '무덤에 묻힌 비트맵 (:count개)',
                ],
                'ranked_and_approved' => [
                    'title' => 'Ranked / Approved 된 비트맵 (:count개)',
                ],
                'unranked' => [
                    'title' => '대기 중인 비트맵 (:count개)',
                ],
            ],
            'historical' => [
                'empty' => '기록된 플레이가 없습니다. :(',
                'title' => '기록',

                'monthly_playcounts' => [
                    'title' => '플레이 기록',
                ],
                'most_played' => [
                    'count' => '플레이 횟수',
                    'title' => '가장 많이 플레이한 비트맵',
                ],
                'recent_plays' => [
                    'accuracy' => '정확도: :percentage',
                    'title' => '최근 플레이 (24시간)',
                ],
                'replays_watched_counts' => [
                    'title' => '관전한 횟수',
                ],
            ],
            'kudosu' => [
                'available' => '사용 가능한 Kudosu',
                'available_info' => "Kudosu는 제작자가 만든 비트맵이 더 관심을 끌게 해주는 kudosu 별(★) 로 교환할 수 있습니다. 여기 나타난 Kudosu는 아직 교환하지 않은 kudosu 수를 나타냅니다.",
                'recent_entries' => '최근 Kudosu 기록',
                'title' => 'Kudosu!',
                'total' => '총 획득한 Kudosu 수',
                'total_info' => '유저가 비트맵 제작 과정에서의 조정에 얼마나 기여했는지를 나타내는 척도입니다. 더 많은 정보를 보려면 <a href="'.osu_url('user.kudosu').'">이 페이지</a>를 확인해주세요.',

                'entry' => [
                    'amount' => ':amount kudosu',
                    'empty' => "아직 어떤 kudosu도 받지 못했습니다!",

                    'beatmap_discussion' => [
                        'allow_kudosu' => [
                            'give' => '모딩 글(:post)에서의 kudosu 거절이 취소되어 :amount를 받았습니다.',
                        ],

                        'deny_kudosu' => [
                            'reset' => '모딩 글(:post)에서 :amount를 거절당했습니다.',
                        ],

                        'delete' => [
                            'reset' => '모딩 글(:post)을 삭제하여 :amount를 잃었습니다.',
                        ],

                        'restore' => [
                            'give' => '삭제된 모딩 글(:post)을 복원하여 :amount를 받았습니다.',
                        ],

                        'vote' => [
                            'give' => '모딩 글(:post)의 투표에서 득표하여 :amount를 받았습니다',
                            'reset' => '모딩 글(:post)의 투표에서 충분한 표를 얻지 못해 :amount를 잃었습니다.',
                        ],

                        'recalculate' => [
                            'give' => '',
                            'reset' => '',
                        ],
                    ],

                    'forum_post' => [
                        'give' => ':post에서 :giver님으로부터 :amount를 받았습니다.',
                        'reset' => ':post에서 :giver님으로부터 Kudosu가 초기화되었습니다',
                        'revoke' => ':post에서 :giver님으로부터 kudosu를 거절당했습니다.',
                    ],
                ],
            ],
            'me' => [
                'title' => 'me!',
            ],
            'medals' => [
                'empty' => "아직 아무런 업적 메달도 받지 못했네요. ;_;",
                'title' => '메달',
            ],
            'recent_activity' => [
                'title' => '최근 활동',
            ],
            'top_ranks' => [
                'empty' => '아직 이렇다 할 플레이 기록이 없네요. :(',
                'not_ranked' => '랭크된 비트맵만 pp를 줍니다.',
                'pp' => ':amountpp',
                'title' => '순위',
                'weighted_pp' => '가중치 적용: :pp (:percentage)',

                'best' => [
                    'title' => '최고 퍼포먼스 점수',
                ],
                'first' => [
                    'title' => '1위 달성 맵',
                ],
            ],
            'account_standing' => [
                'title' => '계정 상태',
                'bad_standing' => "<strong>:username</strong> 님의 계정 상태는 영 좋지 못하네요 :(",
                'remaining_silence' => '<strong>:username</strong> 님은 :duration 후에 말할 수 있습니다.',

                'recent_infringements' => [
                    'title' => '최근 사건',
                    'date' => '날짜',
                    'action' => '동작',
                    'length' => '길이',
                    'length_permanent' => '영구',
                    'description' => '설명',
                    'actor' => ':username으로',

                    'actions' => [
                        'restriction' => '차단',
                        'silence' => '침묵',
                        'note' => '알림',
                    ],
                ],
            ],
        ],
        'info' => [
            'discord' => '디스코드',
            'interests' => '관심 분야',
            'lastfm' => 'Last.fm',
            'location' => '현재 거주하는 곳',
            'occupation' => '직업',
            'skype' => '스카이프',
            'twitter' => '트위터',
            'website' => '웹사이트',
        ],
        'not_found' => [
            'reason_1' => '이름을 바꿨나 봐요.',
            'reason_2' => '보안 문제 혹은 남용 문제 때문에 일시적으로 이 계정을 사용할 수 없습니다.',
            'reason_3' => '오타가 있을 수 있습니다!',
            'reason_header' => '이에 대한 몇 가지 이유가 있습니다:',
            'title' => '사용자를 찾을 수 없습니다! ;_;',
        ],
        'page' => [
            'description' => '<strong>me!</strong>는 유저 프로필 페이지에서 개인이 꾸밀 수 있는 공간입니다.',
            'edit_big' => 'me! 수정하기',
            'placeholder' => '페이지에 들어갈 내용을 입력하세요.',
            'restriction_info' => "이 기능을 이용하려면 <a href='".route('store.products.show', 'supporter-tag')."' target='_blank'>osu!서포터</a>가 되어야 합니다.",
        ],
        'post_count' => [
            '_' => '기여한 :link',
            'count' => ':count개의 포럼 글|:count개의 포럼 글',
        ],
        'rank' => [
            'country' => ':mode 모드에 대한 국가 내 순위',
            'global' => ':mode 모드에 대한 글로벌 순위',
        ],
        'stats' => [
            'hit_accuracy' => '명중률',
            'level' => '레벨 :level',
            'maximum_combo' => '최대 콤보 수',
            'play_count' => '플레이 횟수',
            'play_time' => '총 플레이 시간',
            'ranked_score' => '기록된 점수',
            'replays_watched_by_others' => '다른 플레이어가 관전한 횟수',
            'score_ranks' => '점수 순위',
            'total_hits' => '총 타격 횟수',
            'total_score' => '총 점수',
        ],
    ],
    'status' => [
        'online' => '온라인',
        'offline' => '오프라인',
    ],
    'store' => [
        'saved' => '사용자 계정 생성됨',
    ],
    'verify' => [
        'title' => '계정 인증',
    ],
];
