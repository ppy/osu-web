<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'none' => '그룹 기록을 찾을 수 없습니다!',
    'view' => '그룹 기록 보기',

    'event' => [
        'actor' => ':user 님에 의함',

        'message' => [
            'group_add' => ':group 생성됨.',
            'group_remove' => ':group 삭제됨.',
            'group_rename' => ':previous_group에서 :group(으)로 명칭 변경.',
            'user_add' => ':user 님이 :group에 추가됨.',
            'user_add_with_playmodes' => ':user 님이 :rulesets의 :group에 추가됨.',
            'user_add_playmodes' => ':rulesets(이)가 :user 님의 :group 멤버십에 추가됨.',
            'user_remove' => ':user 님이 :group에서 제거됨.',
            'user_remove_playmodes' => ':rulesets이(가) :user 님의 :group 멤버십에서 제거됨.',
            'user_set_default' => ':user 님의 기본 그룹이 :group(으)로 설정됨.',
        ],
    ],

    'form' => [
        'group' => '그룹',
        'group_all' => '모든 그룹',
        'max_date' => '종료일',
        'min_date' => '시작일',
        'user' => '유저',
        'user_prompt' => '닉네임 또는 ID',
    ],

    'staff_log' => [
        '_' => '오래된 그룹 기록은 :wiki_articles에서 확인할 수 있습니다.',
        'wiki_articles' => '스태프 로그 위키 문서',
    ],
];
