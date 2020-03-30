<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'username_change' => [
        'only_one' => '1回の受注につき1回しか名前は変更できません。',
        'insufficient_paid' => 'ユーザーネーム変更に必要な額が支払い金額を超えています。(:expected > :actual)',
        'reverting_username_mismatch' => '現在のユーザーネーム (:current) が前回の名前と一致しません (:username)',
    ],
    'supporter_tag' => [
        'insufficient_paid' => 'osu!サポータータグのギフト額は寄付額より少ない必要があります。（:actual > :expected）',
    ],
];
