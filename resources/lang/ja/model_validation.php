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
    'not_negative' => ':attributeに負の数は使用できません',
    'required' => ':attributeが必須です',
    'too_long' => ':attributeの長さの上限を超えました。:limit文字が上限です',
    'wrong_confirmation' => '認証が一致しません。',

    'beatmap_discussion_post' => [
        'discussion_locked' => 'ディスカッションはロックされています。',
        'first_post' => '最初の投稿は削除できません。',
    ],

    'beatmapset_discussion' => [
        'beatmap_missing' => 'タイムスタンプは存在しますが譜面が見つかりませんでした',
        'beatmapset_no_hype' => "この譜面はHypeできません。",
        'hype_requires_null_beatmap' => 'Hypeは一般（全ての難易度）セクションで行ってください。',
        'invalid_beatmap_id' => '指定の難易度が無効です。',
        'invalid_beatmapset_id' => '指定の譜面が無効です。',
        'locked' => 'ディスカッションはロックされています。',

        'hype' => [
            'guest' => 'Hypeするにはログインが必要です。',
            'hyped' => '既にこの譜面をHypeしています。',
            'limit_exceeded' => 'Hype回数が残っていません。',
            'not_hypeable' => 'この譜面はHypeできません。',
            'owner' => '自分の譜面はHypeできません。',
        ],

        'timestamp' => [
            'exceeds_beatmapset_length' => '指定されたタイムスタンプは譜面の長さの範囲に存在しません。',
            'negative' => "タイムスタンプは負の数が使えません。",
        ],
    ],

    'forum' => [
        'feature_vote' => [
            'not_feature_topic' => '機能リクエスト以外は投票できません。',
            'not_enough_feature_votes' => '残りの投票回数が足りません',
        ],

        'poll_vote' => [
            'invalid' => '無効の選択肢が指定されています。',
        ],

        'post' => [
            'beatmapset_post_no_delete' => '譜面のmetadata投稿を削除するのは許可されていません。',
            'beatmapset_post_no_edit' => '譜面のmetadata投稿を編集するのは許可されていません。',
        ],

        'topic_poll' => [
            'duplicate_options' => '選択肢の重複があります。',
            'invalid_max_options' => '選択数の上限に選択肢の数以上の数値は使用不可能です。',
            'minimum_one_selection' => '選択数は１が最低の数値です。',
            'minimum_two_options' => '選択肢は最低2つ必要です。',
            'too_many_options' => '選択肢の数が多すぎます。',
        ],

        'topic_vote' => [
            'required' => '投票する選択肢を選んでください。',
            'too_many' => '許可されている選択肢の選択数を超えました。',
        ],
    ],

    'user' => [
        'contains_username' => 'ユーザーネームを含んだパスワードは使用できません。',
        'email_already_used' => '既に使用されているEメールアドレスです。',
        'invalid_country' => 'データベースに存在しない国です。',
        'invalid_discord' => 'Discordのユーザー名が無効です。',
        'invalid_email' => "無効のメールアドレスです。",
        'too_short' => '新しいパスワードが短すぎます。',
        'unknown_duplicate' => 'ユーザーネームかEメールアドレスが既に使用されています。',
        'username_available_in' => 'このユーザーネームは :duration で使用可能になります。',
        'username_available_soon' => 'このユーザーネームはまもなく使用可能になります。',
        'username_invalid_characters' => '指定のユーザーネームに無効の文字が含まれています。',
        'username_in_use' => '既に使用されているユーザーネームです！',
        'username_no_space_userscore_mix' => 'アンダーバーかスペースのどちらかに統一してください。',
        'username_no_spaces' => "ユーザーネームの端にスペースは使用できません。",
        'username_not_allowed' => 'このユーザーネームに使用は許可されていません。',
        'username_too_short' => 'ユーザーネームが短すぎます。',
        'username_too_long' => 'ユーザーネームが長すぎます。',
        'weak' => 'ブラックリストに含まれているパスワードです。',
        'wrong_current_password' => '誤ったパスワードです。',
        'wrong_email_confirmation' => 'Eメールの確認が一致しません。',
        'wrong_password_confirmation' => 'パスワードの確認が一致しません。',
        'too_long' => '使用文字数の制限を超えています。上限は:limit文字です。',

        'change_username' => [
            'supporter_required' => [
                '_' => ':linkになったことがないと名前を変更できません！',
                'link_text' => 'サポーター',
            ],
            'username_is_same' => '既に使用しているユーザーネームです！',
        ],
    ],
];
