<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'error' => [
        'chat' => [
            'empty' => '빈 메시지는 보낼 수 없습니다.',
            'limit_exceeded' => '메시지를 너무 빠르게 보내고 있습니다, 다시 보내기 전에 잠시 기다려주세요.',
            'too_long' => '전송하려는 메시지가 너무 깁니다.',
        ],
    ],

    'scopes' => [
        'bot' => '챗봇으로 활동합니다.',
        'identify' => '당신을 식별하고 공개 프로필을 읽습니다.',

        'chat' => [
            'write' => '당신을 대신하여 메시지를 전송합니다.',
        ],

        'forum' => [
            'write' => '당신을 대신하여 포럼 주제와 게시글을 만들고 수정합니다.',
        ],

        'friends' => [
            'read' => '당신이 팔로우하는 사람들의 목록을 봅니다.',
        ],

        'public' => '당신을 대신하여 공개 데이터를 읽습니다.',
    ],
];
