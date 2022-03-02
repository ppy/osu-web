<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

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
        'banner_text' => '해당 유저를 차단했습니다.',
        'blocked_count' => '차단된 유저 (:count)',
        'hide_profile' => '프로필 숨기기',
        'not_blocked' => '해당 유저는 차단되어있지 않습니다.',
        'show_profile' => '프로필 표시',
        'too_many' => '차단 한계치에 도달했습니다.',
        'button' => [
            'block' => '차단',
            'unblock' => '차단 해제',
        ],
    ],

    'card' => [
        'loading' => '로딩 중...',
        'send_message' => '메시지 보내기',
    ],

    'disabled' => [
        'title' => '이런! 계정이 비활성화 된 것 같네요.',
        'warning' => "규칙을 어긴 경우, 일반적으로 한 달 동안 어떠한 사면 요청도 받고 있지 않습니다. 해당 기간이 끝난 후, 사면이 필요하다고 판단될 경우 언제든지 저희에게 연락하실 수 있습니다. 하나의 계정이 비활성화된 이후 새로운 계정을 만들면 <strong>한 달의 기간이 연장될 수 있음</strong>을 명심해주세요. 또한, <strong>계정을 새로 만들 때마다 더욱 규칙 위반으로 간주</strong>한다는 것을 잊지 마세요. 이 길은 절대로 건너지 말아 주시기 바랍니다!",

        'if_mistake' => [
            '_' => '만약 실수라고 생각된다면, 저희에게 연락할 수 있습니다 (:email 이나 이 페이지의 오른쪽 하단 버튼 "?"을 클릭).',
            'email' => '이메일',
        ],

        'reasons' => [
            'compromised' => '계정 도용이 의심됩니다. 신원이 확인될 때까지 계정이 비활성화될 수 있습니다.',
            'opening' => '계정 비활성화가 될 수 있는 이유는 다음과 같습니다:',

            'tos' => [
                '_' => '해당 계정은 :community_rules 또는 :tos 를 위반했습니다.',
                'community_rules' => '커뮤니티 규칙',
                'tos' => '이용 약관',
            ],
        ],
    ],

    'filtering' => [
        'by_game_mode' => '게임 모드 별 멤버',
    ],

    'force_reactivation' => [
        'reason' => [
            'inactive_different_country' => "당신의 계정은 오랫동안 사용되지 않았네요.",
        ],
    ],

    'login' => [
        '_' => '로그인',
        'button' => '로그인',
        'button_posting' => '로그인 중...',
        'email_login_disabled' => '현재 이메일로 로그인할 수 없습니다. 대신 유저 이름을 사용해 주세요.',
        'failed' => '계정 정보가 올바르지 않습니다',
        'forgot' => '비밀번호를 잊어버리셨나요?',
        'info' => '계속 하시려면 로그인 해주세요',
        'invalid_captcha' => 'Captcha가 올바르지 않습니다. 페이지를 새로 고친 후 다시 시도해주세요.',
        'locked_ip' => '당신의 IP 주소가 잠겨있습니다. 잠시만 기다려주세요.',
        'password' => 'Password',
        'register' => "osu!계정이 없으신가요? 새로 하나 만들어보세요",
        'remember' => '이 컴퓨터에서 계정 정보 기억하기',
        'title' => '계속하려면 로그인해 주세요',
        'username' => 'Username',

        'beta' => [
            'main' => '베타 권한은 현재 일부 특수 사용자만 가지고 있습니다.',
            'small' => '(osu! 서포터들도 곧 받게 될 거에요)',
        ],
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
            'multiple_accounts' => '다중 계정 사용',
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
        'previous_usernames' => '이전 사용자명',
        'plays_with' => '플레이 장비: :devices',
        'title' => ":username님의 프로필",

        'comments_count' => [
            '_' => ':link 작성됨',
            'count' => '댓글 :count_delimited개',
        ],
        'edit' => [
            'cover' => [
                'button' => '프로필 표지 변경',
                'defaults_info' => '이후에 더 많은 표지 설정이 추가됩니다',
                'upload' => [
                    'broken_file' => '이미지 처리 실패. 업로드하려는 이미지를 확인하시고 다시 시도해주세요.',
                    'button' => '이미지 업로드',
                    'dropzone' => '업로드하려면 여기에 끌어놓으세요',
                    'dropzone_info' => '여기에 이미지를 끌어놓아 업로드할 수도 있습니다.',
                    'size_info' => '표지 크기는 2400x640 이여야 합니다.',
                    'too_large' => '업로드된 파일이 너무 큽니다.',
                    'unsupported_format' => '지원되지 않는 확장자입니다.',

                    'restriction_info' => [
                        '_' => '업로드는 :link만 가능합니다.',
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
                'pending' => [
                    'title' => '대기 중인 비트맵',
                ],
                'ranked' => [
                    'title' => '새로 랭크된 비트맵',
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
            'playlists' => [
                'title' => '플레이리스트 게임',
            ],
            'posts' => [
                'title' => '게시글',
                'title_longer' => '최근 게시글',
                'show_more' => '글 더 보기',
            ],
            'recent_activity' => [
                'title' => '최근 활동',
            ],
            'realtime' => [
                'title' => '멀티플레이어 게임',
            ],
            'top_ranks' => [
                'download_replay' => '리플레이 다운로드',
                'not_ranked' => '랭크된 비트맵만 pp를 줍니다.',
                'pp_weight' => '가중치 :percentage',
                'view_details' => '자세히 보기',
                'title' => '랭크',

                'best' => [
                    'title' => '최고 성과',
                ],
                'first' => [
                    'title' => '1위 달성 맵',
                ],
                'pin' => [
                    'to_0' => '고정 해제',
                    'to_0_done' => '고정되지 않은 점수',
                    'to_1' => '고정',
                    'to_1_done' => '고정 점수',
                ],
                'pinned' => [
                    'title' => '고정 점수',
                ],
            ],
            'votes' => [
                'given' => '투표 참여 수 (지난 3개월 간)',
                'received' => '받은 투표수 (지난 3개월 간)',
                'title' => '투표',
                'title_longer' => '최근 투표',
                'vote_count' => ':count_delimited개의 투표',
            ],
            'account_standing' => [
                'title' => '계정 상태',
                'bad_standing' => "<strong>:username</strong> 님이 규칙을 위반하셨습니다. :(",
                'remaining_silence' => '<strong>:username</strong> 님은 :duration 후에 말할 수 있습니다.',

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
                        'silence' => '침묵',
                        'note' => '알림',
                    ],
                ],
            ],
        ],

        'info' => [
            'discord' => '',
            'interests' => '관심 분야',
            'location' => '거주지',
            'occupation' => '직업',
            'twitter' => '',
            'website' => '웹사이트',
        ],
        'not_found' => [
            'reason_1' => '사용자명이 변경되었을 가능성이 있습니다.',
            'reason_2' => '보안 혹은 남용 문제 때문에 일시적으로 이 계정을 사용할 수 없습니다.',
            'reason_3' => '오타가 있나봐요!',
            'reason_header' => '아래 이유로 인해 발생했을 가능성이 있어요:',
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
            'graveyard_beatmapset_count' => '묻힌 비트맵',
            'loved_beatmapset_count' => 'Loved 비트맵',
            'pending_beatmapset_count' => '대기 중인 비트맵',
            'ranked_beatmapset_count' => '랭크된 비트맵',
        ],
    ],

    'silenced_banner' => [
        'title' => '당신은 현재 침묵 상태입니다.',
        'message' => '몇몇 동작이 수행 불가능할 수 있습니다.',
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
        'brick' => '벽돌 형식 보기',
        'card' => '카드 형식 보기',
        'list' => '목록으로 보기',
    ],
];
