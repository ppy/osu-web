<?php

/**
 *    Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
 *    See the LICENCE file in the repository root for full licence text.
 */

return [
    'deleted' => '[삭제된 사용자]',

    'beatmapset_activities' => [
        'title' => ":user님의 모딩 기록",
        'title_compact' => '모딩',

        'discussions' => [
            'title_recent' => '최근 시작된 토론',
        ],

        'events' => [
            'title_recent' => '최근 이벤트',
        ],

        'posts' => [
            'title_recent' => '최근 답변',
        ],

        'votes_received' => [
            'title_most' => '투표받은 횟수 (최근 3개월)',
        ],

        'votes_made' => [
            'title_most' => '투표한 횟수 (최근 3개월)',
        ],
    ],

    'blocks' => [
        'banner_text' => '이 사용자를 차단했습니다.',
        'blocked_count' => '차단된 사용자 (:count)',
        'hide_profile' => '프로필 숨기기',
        'not_blocked' => '해당 유저는 차단되어있지 않습니다.',
        'show_profile' => '프로필 표시',
        'too_many' => '차단 한계에 도달했습니다.',
        'button' => [
            'block' => '차단',
            'unblock' => '차단 해제',
        ],
    ],

    'card' => [
        'loading' => '로딩중...',
        'send_message' => '메시지 보내기',
    ],

    'login' => [
        '_' => '로그인',
        'locked_ip' => 'IP 주소가 잠겨있습니다. 잠시 기다려주세요.',
        'username' => 'Username',
        'password' => 'Password',
        'button' => '로그인',
        'button_posting' => '로그인 중...',
        'remember' => '이 컴퓨터에서 계정 정보 기억하기',
        'title' => '계속하려면 로그인해 주세요',
        'failed' => '계정 정보가 올바르지 않습니다',
        'register' => "osu!계정이 없으신가요? 새로 하나 만들어보세요",
        'forgot' => '비밀번호를 잊어버리셨나요?',
        'beta' => [
            'main' => '베타 권한은 현재 일부 특수 사용자만 가지고 있습니다.',
            'small' => '(osu! 서포터들도 곧 받게 될 거에요)',
        ],

        'here' => '이곳', // this is substituted in when generating a link above. change it to suit the language.
    ],

    'posts' => [
        'title' => ':username님의 글',
    ],

    'anonymous' => [
        'login_link' => '클릭하여 로그인',
        'login_text' => '로그인',
        'username' => '손님',
        'error' => '계속하려면 로그인하셔야 합니다.',
    ],
    'logout_confirm' => '정말 로그아웃하실건가요? :(',
    'report' => [
        'button_text' => '신고',
        'comments' => '추가 의견',
        'placeholder' => '아시는 정보를 입력해 주세요. 유용하게 쓰일 수 있습니다.',
        'reason' => '이유',
        'thanks' => '신고해 주셔서 감사합니다!',
        'title' => ':username 님을 신고할까요?',

        'actions' => [
            'send' => '신고 보내기',
            'cancel' => '취소',
        ],

        'options' => [
            'cheating' => '부정 행위 / 치트 사용',
            'insults' => '자신 / 다른 사람을 모욕 함',
            'spam' => '도배',
            'unwanted_content' => '부적절한 콘텐츠에 링크 걸기',
            'nonsense' => '허튼소리',
            'other' => '기타 (아래에 입력해 주세요)',
        ],
    ],
    'restricted_banner' => [
        'title' => '계정이 제한되어 있습니다!',
        'message' => '계정이 제한되어있으면 다른 플레이어와 소통할 수 없으며 점수가 본인에게만 표시됩니다. 계정 제한은 보통 자동적으로 처리되며, 24시간 이내에 철회될 수 있습니다. 제한에 대한 항소를 원하시면 <a href="mailto:accounts@ppy.sh">지원팀에 연락</a>해주시기 바랍니다.',
    ],
    'show' => [
        'age' => '만 :age세',
        'change_avatar' => '아바타를 바꾸세요!',
        'first_members' => 'osu!의 초창기부터 함께한 유저',
        'is_developer' => 'osu!developer',
        'is_supporter' => 'osu!supporter',
        'joined_at' => ':date에 가입',
        'lastvisit' => ':date에 마지막으로 접속',
        'lastvisit_online' => '현재 온라인',
        'missingtext' => '오타가 있는 것 같은데요! (또는 차단된 사용자일 수 있습니다)',
        'origin_country' => ':country에 거주',
        'page_description' => 'osu! - :username님에 대해 궁금했던 모든 것!',
        'previous_usernames' => '이전 사용자명',
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
                    'size_info' => '표지 크기는 2800x620 이여야 합니다',
                    'too_large' => '업로드된 파일이 너무 큽니다.',
                    'unsupported_format' => '지원되지 않는 확장자입니다.',

                    'restriction_info' => [
                        '_' => '업로드는 :link만 가능합니다',
                        'link' => 'osu! 서포터',
                    ],
                ],
            ],

            'default_playmode' => [
                'is_default_tooltip' => '메인 게임 모드',
                'set' => ':mode를 메인 게임 모드로 설정',
            ],
        ],

        'extra' => [
            'none' => '없음',
            'unranked' => '최근 플레이가 없습니다',

            'achievements' => [
                'achieved-on' => ':date에 달성함',
                'locked' => '잠김',
                'title' => '업적',
            ],
            'beatmaps' => [
                'by_artist' => 'by :artist',
                'none' => '아직... 없네요...',
                'title' => '비트맵',

                'favourite' => [
                    'title' => '즐겨찾기한 비트맵',
                ],
                'graveyard' => [
                    'title' => '무덤에 간 비트맵',
                ],
                'loved' => [
                    'title' => 'Loved 비트맵',
                ],
                'ranked_and_approved' => [
                    'title' => 'Ranked / Approved 된 비트맵',
                ],
                'unranked' => [
                    'title' => 'Pending 비트맵',
                ],
            ],
            'discussions' => [
                'title' => '토론',
                'title_longer' => '최근 토론',
                'show_more' => '토론 더 보기',
            ],
            'events' => [
                'title' => '이벤트',
                'title_longer' => '최근 이벤트',
                'show_more' => '이벤트 더 보기',
            ],
            'historical' => [
                'empty' => '기록된 플레이가 없습니다. :(',
                'title' => '통계',

                'monthly_playcounts' => [
                    'title' => '플레이 기록',
                    'count_label' => '플레이 횟수',
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
                    'title' => '리플레이가 재생된 횟수',
                    'count_label' => '리플레이 재생 횟수',
                ],
            ],
            'kudosu' => [
                'available' => '사용 가능한 Kudosu',
                'available_info' => "Kudosu는 제작자가 만든 비트맵의 노출 순위를 올리는 kudosu 별(★) 로 교환될 수 있습니다. 위에 적힌 수는 아직 교환되지 않은 kudosu 수를 나타냅니다.",
                'recent_entries' => '최근 Kudosu 기록',
                'title' => 'Kudosu!',
                'total' => '총 획득한 Kudosu 수',

                'entry' => [
                    'amount' => ':amount kudosu',
                    'empty' => "획득한 kudosu가 없습니다!",

                    'beatmap_discussion' => [
                        'allow_kudosu' => [
                            'give' => '토론 :post에서의 kudosu 획득 자격이 복구되어 :amount를 받았습니다.',
                        ],

                        'deny_kudosu' => [
                            'reset' => '토론 :post에서 :amount를 거절당했습니다.',
                        ],

                        'delete' => [
                            'reset' => '토론 :post이 삭제되어 :amount를 잃었습니다.',
                        ],

                        'restore' => [
                            'give' => '삭제된 토론 :post이 복원되어 :amount를 받았습니다.',
                        ],

                        'vote' => [
                            'give' => '모딩 토론 :post에서 득표하여 :amount를 받았습니다.',
                            'reset' => '모딩 글(:post)의 투표에서 충분한 표를 얻지 못해 :amount를 잃었습니다.',
                        ],

                        'recalculate' => [
                            'give' => '모딩 토론 :post에서 투표가 재계산되어 :amount를 얻었습니다.',
                            'reset' => '모딩 토론 :post에서 투표가 재계산되어 :amount를 잃었습니다.',
                        ],
                    ],

                    'forum_post' => [
                        'give' => ':post에서 :giver님으로부터 :amount를 받았습니다.',
                        'reset' => ':post에서 :giver님으로부터 kudosu가 초기화되었습니다.',
                        'revoke' => ':post에서 :giver님으로부터 kudosu 획득 자격을 박탈당했습니다.',
                    ],
                ],

                'total_info' => [
                    '_' => '유저가 비트맵 제작 과정에 얼마나 기여했는지에 기반합니다. 더 많은 정보를 얻고싶으시다면 :link를 참고해주세요.',
                    'link' => '이 페이지',
                ],
            ],
            'me' => [
                'title' => 'me!',
            ],
            'medals' => [
                'empty' => "아직 아무런 메달도 받지 못했네요. ;_;",
                'recent' => '최근 획득',
                'title' => '메달',
            ],
            'posts' => [
                'title' => '게시글',
                'title_longer' => '최근 게시글',
                'show_more' => '글 더 보기',
            ],
            'recent_activity' => [
                'title' => '최근 활동',
            ],
            'top_ranks' => [
                'download_replay' => '리플레이 다운로드',
                'empty' => '아직 이렇다 할 플레이 기록이 없네요. :(',
                'not_ranked' => '랭크된 비트맵만 pp를 줍니다.',
                'pp_weight' => '가중치 :percentage',
                'title' => '랭크',

                'best' => [
                    'title' => '최고 성과',
                ],
                'first' => [
                    'title' => '1위 달성 맵',
                ],
            ],
            'votes' => [
                'given' => '투표 참여 수 (지난 3개월 간)',
                'received' => '받은 투표수 (지난 3개월 간)',
                'title' => '투표',
                'title_longer' => '최근 투표',
                'vote_count' => ':count_delimited 투표',
            ],
            'account_standing' => [
                'title' => '계정 상태',
                'bad_standing' => "<strong>:username</strong>님의 계정이 룰을 위반하였습니다 :(",
                'remaining_silence' => '<strong>:username</strong>님은 :duration 후에 말할 수 있습니다.',

                'recent_infringements' => [
                    'title' => '최근 사건',
                    'date' => '날짜',
                    'action' => '처벌',
                    'length' => '기간',
                    'length_permanent' => '영구',
                    'description' => '사유',
                    'actor' => ':username으로',

                    'actions' => [
                        'restriction' => 'Ban',
                        'silence' => 'Silence',
                        'note' => '알림',
                    ],
                ],
            ],
        ],

        'header_title' => [
            '_' => '플레이어 :info',
            'info' => '정보',
        ],

        'info' => [
            'discord' => '디스코드',
            'interests' => '관심 분야',
            'lastfm' => 'Last.fm',
            'location' => '거주지',
            'occupation' => '직업',
            'skype' => '스카이프',
            'twitter' => '트위터',
            'website' => '웹사이트',
        ],
        'not_found' => [
            'reason_1' => '사용자명이 변경되었을 가능성이 있습니다.',
            'reason_2' => '보안 혹은 남용 문제 때문에 일시적으로 이 계정을 사용할 수 없습니다.',
            'reason_3' => '오타가 있나봐요!',
            'reason_header' => '이에 대한 몇 가지 이유가 있습니다:',
            'title' => '사용자를 찾을 수 없습니다! ;_;',
        ],
        'page' => [
            'button' => '프로필 페이지 수정',
            'description' => '<strong>me!</strong>는 유저 프로필 페이지에서 개인이 꾸밀 수 있는 공간입니다.',
            'edit_big' => 'me! 수정하기',
            'placeholder' => '페이지에 들어갈 내용을 입력하세요.',

            'restriction_info' => [
                '_' => '이 기능을 사용하기 위해서는 :link가 되어야합니다.',
                'link' => 'osu! 서포터',
            ],
        ],
        'post_count' => [
            '_' => '게시글 수 :link',
            'count' => ':count개|:count개',
        ],
        'rank' => [
            'country' => ':mode 국가 순위',
            'country_simple' => '국가 순위',
            'global' => ':mode 세계 순위',
            'global_simple' => '세계 순위',
        ],
        'stats' => [
            'hit_accuracy' => '정확도',
            'level' => '레벨 :level',
            'level_progress' => '다음 레벨까지의 진척도',
            'maximum_combo' => '최대 콤보',
            'medals' => '메달',
            'play_count' => '플레이 횟수',
            'play_time' => '총 플레이 시간',
            'ranked_score' => '기록된 점수',
            'replays_watched_by_others' => '리플레이가 재생된 횟수',
            'score_ranks' => '점수 순위',
            'total_hits' => '총 타격 횟수',
            'total_score' => '총 점수',
            // modding stats
            'ranked_and_approved_beatmapset_count' => 'Ranked 및 Approved 상태의 비트맵',
            'loved_beatmapset_count' => 'Loved 비트맵',
            'unranked_beatmapset_count' => '대기 중인 비트맵',
            'graveyard_beatmapset_count' => '묻힌 비트맵',
        ],
    ],

    'status' => [
        'all' => '모두',
        'online' => '온라인',
        'offline' => '오프라인',
    ],
    'store' => [
        'saved' => '사용자 계정 생성됨',
    ],
    'verify' => [
        'title' => '계정 인증',
    ],

    'view_mode' => [
        'card' => '카드 형식 보기',
        'list' => '목록으로 보기',
    ],
];
