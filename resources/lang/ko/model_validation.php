<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'invalid' => ':attribute가 올바르지 않습니다.',
    'not_negative' => ':attribute 속성은 음수가 될 수 없습니다.',
    'required' => ':attribute 속성이 필요합니다.',
    'too_long' => ':attribute의 최대 길이를 초과 했습니다 - :limit자 까지만 쓸 수 있습니다.',
    'url' => '유효한 URL을 입력하세요.',
    'wrong_confirmation' => '확인란이 일치하지 않습니다.',

    'beatmapset_discussion' => [
        'beatmap_missing' => '타임스탬프가 지정되어 있지만, 비트맵이 빠져있습니다.',
        'beatmapset_no_hype' => "Hype를 할 수 없습니다.",
        'hype_requires_null_beatmap' => 'Hype는 반드시 일반 (모든 난이도) 섹션에서 이루어져야 합니다.',
        'invalid_beatmap_id' => '난이도가 올바르지 않습니다.',
        'invalid_beatmapset_id' => '비트맵이 올바르지 않습니다.',
        'locked' => '토론이 잠겨있습니다.',

        'attributes' => [
            'message_type' => '메시지 유형',
            'timestamp' => '타임스탬프',
        ],

        'hype' => [
            'discussion_locked' => "이 비트맵은 현재 토론이 잠겨 Hype 할 수 없습니다.",
            'guest' => '로그인하셔야 Hype하실 수 있습니다.',
            'hyped' => '이미 이 비트맵을 Hype했습니다.',
            'limit_exceeded' => '모든 Hype를 사용하셨습니다.',
            'not_hypeable' => '이 비트맵을 Hype 할 수 없습니다.',
            'owner' => '자신의 비트맵을 Hype 할 수 없습니다.',
        ],

        'timestamp' => [
            'exceeds_beatmapset_length' => '지정된 타임스탬프는 비트맵 길이를 벗어납니다.',
            'negative' => "타임스탬프는 음수가 될 수 없습니다.",
        ],
    ],

    'beatmapset_discussion_post' => [
        'discussion_locked' => '토론이 잠겨있습니다.',
        'first_post' => '첫 게시글은 삭제할 수 없습니다.',

        'attributes' => [
            'message' => '메시지',
        ],
    ],

    'comment' => [
        'deleted_parent' => '삭제된 댓글에 답글을 달 수 없습니다.',
        'top_only' => '댓글 답글을 고정하는 것은 허용되지 않습니다.',

        'attributes' => [
            'message' => '메시지',
        ],
    ],

    'follow' => [
        'invalid' => ':attribute가 올바르지 않습니다.',
    ],

    'forum' => [
        'feature_vote' => [
            'not_feature_topic' => '기능을 요청하는 주제에만 투표할 수 있습니다.',
            'not_enough_feature_votes' => '득표 수가 충분하지 않습니다.',
        ],

        'poll_vote' => [
            'invalid' => '항목 선택이 올바르지 않습니다.',
        ],

        'post' => [
            'beatmapset_post_no_delete' => '비트맵 메타데이터 글을 삭제할 수 없습니다.',
            'beatmapset_post_no_edit' => '비트맵 메타데이터 글을 수정할 수 없습니다.',
            'first_post_no_delete' => '시작 게시글은 삭제할 수 없습니다.',
            'missing_topic' => '게시글에 주제가 없습니다.',
            'only_quote' => '답글에 인용만 포함하고 있습니다.',

            'attributes' => [
                'post_text' => '본문 게시',
            ],
        ],

        'topic' => [
            'attributes' => [
                'topic_title' => '주제 제목',
            ],
        ],

        'topic_poll' => [
            'duplicate_options' => '지정하려는 항목이 이미 존재합니다.',
            'grace_period_expired' => ':limit시간 뒤에 투표 수정을 할 수 없습니다',
            'hiding_results_forever' => '영원히 끝나지 않는 투표의 결과를 숨길 수 없습니다.',
            'invalid_max_options' => '지정된 항목보다 많이 투표하도록 설정할 수 없습니다.',
            'minimum_one_selection' => '투표자들이 최소 한 개 이상은 선택할 수 있도록 해야합니다.',
            'minimum_two_options' => '투표 항목이 적어도 두 개는 필요합니다.',
            'too_many_options' => '허용된 것 보다 많은 항목을 선택하셨습니다.',

            'attributes' => [
                'title' => '투표 제목',
            ],
        ],

        'topic_vote' => [
            'required' => '투표할 때 항목을 선택해 주세요.',
            'too_many' => '허용된 것 보다 많은 항목을 선택하셨습니다.',
        ],
    ],

    'legacy_api_key' => [
        'exists' => '현재는 유저당 오직 한 개의 API 키만 제공됩니다.',

        'attributes' => [
            'api_key' => 'api key',
            'app_name' => '애플리케이션 이름',
            'app_url' => '애플리케이션 URL',
        ],
    ],

    'oauth' => [
        'client' => [
            'too_many' => '허용된 OAuth 애플리케이션 수를 초과했습니다.',
            'url' => '유효한 URL을 입력하세요.',

            'attributes' => [
                'name' => '애플리케이션 이름',
                'redirect' => '애플리케이션 Callback URL',
            ],
        ],
    ],

    'team' => [
        'invalid_characters' => ':attribute 에 사용할 수 없는 문자가 있어요.',
        'used' => ':attribute 는 이미 사용되고 있어요.',
        'word_not_allowed' => ':attribute 는 허용되지 않아요.',

        'attributes' => [
            'default_ruleset_id' => '기본 룰셋',
            'is_open' => '팀 참가',
            'name' => '이름',
            'short_name' => '짧은 이름',
            'url' => 'URL',
        ],
    ],

    'user' => [
        'contains_username' => '비밀번호에 아이디를 포함할 수 없습니다.',
        'email_already_used' => '이미 사용중인 이메일 주소입니다.',
        'email_not_allowed' => '허용되지 않은 이메일 주소입니다.',
        'invalid_country' => '해당하는 국가가 데이터베이스에 존재하지 않습니다.',
        'invalid_discord' => 'Discord 사용자명이 올바르지 않습니다.',
        'invalid_email' => "이메일 주소가 잘못되었습니다.",
        'invalid_twitter' => 'Twitter 아이디가 올바르지 않습니다.',
        'too_short' => '새 비밀번호가 너무 짧습니다.',
        'unknown_duplicate' => '아이디 또는 이메일 주소가 이미 사용중입니다.',
        'username_available_in' => '이 아이디는 :duration 안에 사용 가능합니다.',
        'username_available_soon' => '이 아이디는 곧 사용 가능 합니다!',
        'username_invalid_characters' => '요청한 아이디에 유효하지 않은 문자가 있습니다.',
        'username_in_use' => '이미 사용중인 아이디 입니다!',
        'username_locked' => '이미 사용 중인 아이디입니다!', // TODO: language for this should be slightly different.
        'username_no_space_userscore_mix' => '언더바나 공백을 사용해주세요, 둘 중 하나요!',
        'username_no_spaces' => "아이디는 공백으로 시작하거나 끝날 수 없습니다!",
        'username_not_allowed' => '이 아이디 선택은 허용되지 않습니다.',
        'username_too_short' => '요청하신 아이디가 너무 짧습니다.',
        'username_too_long' => '요청한 아이디가 너무 깁니다.',
        'weak' => '비밀번호에 사용할 수 없는 문자나 패턴이 포함되어 있습니다.',
        'wrong_current_password' => '현재 비밀번호가 일치하지 않습니다.',
        'wrong_email_confirmation' => '이메일과 이메일 확인란이 일치하지 않습니다.',
        'wrong_password_confirmation' => '비밀번호와 비밀번호 확인란이 일치하지 않습니다.',
        'too_long' => '최대 길이를 초과하셨습니다 - :limit자리 까지만 가능합니다.',

        'attributes' => [
            'username' => '아이디',
            'user_email' => '이메일 주소',
            'password' => '비밀번호',
        ],

        'change_username' => [
            'restricted' => '제한된 상태의 계정은 아이디를 변경할 수 없습니다.',
            'supporter_required' => [
                '_' => '무조건 :link해야만 아이디를 변경할 수 있습니다!',
                'link_text' => 'osu!를 후원',
            ],
            'username_is_same' => '이미 당신이 사용 중인 아이디입니다, 혹시.. 건망증?',
        ],
    ],

    'user_report' => [
        'no_ranked_beatmapset' => '랭크된 비트맵은 신고할 수 없습니다.',
        'not_in_channel' => '이 채널에 있지 않습니다.',
        'in_team' => '이 팀의 일원이 되었어요.',
        'reason_not_valid' => ':reason 은(는) 이 신고 형식에 맞지 않습니다.',
        'self' => "자기 자신은 신고할 수 없습니다!",
    ],

    'store' => [
        'order_item' => [
            'attributes' => [
                'quantity' => '수량',
                'cost' => '가격',
            ],
        ],
    ],
];
