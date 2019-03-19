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
    'username_change' => [
        'only_one' => '1回の受注につき1回しか名前は変更できません。',
        'insufficient_paid' => 'ユーザーネーム変更に必要な額が支払い金額を超えています。(:expected > :actual)',
        'reverting_username_mismatch' => '現在のユーザーネーム (:current) が前回の名前と一致しません (:username)',
    ],
    'supporter_tag' => [
        'insufficient_paid' => 'osu!サポータータグのギフト額は寄付額より少ない必要があります。（:actual > :expected）',
    ],
];
