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
    'pinned_topics' => 'ピン付けされたトピック',
    'slogan' => "ひとりで遊ぶにはキケンじゃ",
    'subforums' => 'サブフォーラム',
    'title' => 'osu! フォーラム',

    'covers' => [
        'create' => [
            '_' => 'カバー画像の設定',
            'button' => '画像をアップロード',
            'info' => 'カバー画像の大きさは:dimensionsにしてください。画像をここにドロップすることでアップロードもできます。',
        ],

        'destroy' => [
            '_' => 'カバー画像を削除',
            'confirm' => 'カバー画像を本当に削除しますか？',
        ],
    ],

    'email' => [
        'new_reply' => '[osu!] ":title"に新しい投稿があります',
    ],

    'forums' => [
        'topics' => [
            'empty' => 'トピックがありません！',
        ],
    ],

    'post' => [
        'confirm_destroy' => '投稿を本当に削除しますか？',
        'confirm_restore' => '投稿を本当に復元しますか？',
        'edited' => ':userが:whenに最後に編集、合計:count回の編集',
        'posted_at' => '投稿時 :when',

        'actions' => [
            'destroy' => '投稿を削除',
            'restore' => '投稿を復元',
            'edit' => '投稿を編集',
        ],
    ],

    'search' => [
        'go_to_post' => '投稿に飛ぶ',
        'post_number_input' => '投稿番号を入力',
        'total_posts' => '合計:posts_count個の投稿',
    ],

    'topic' => [
        'deleted' => '削除されたトピック',
        'go_to_latest' => '最新の投稿を見る',
        'latest_post' => ':when by :user',
        'latest_reply_by' => '最新の投稿 by :user',
        'new_topic' => 'トピックを新規で作成する',
        'new_topic_login' => 'ログインして新規トピックを投稿',
        'post_reply' => '投稿',
        'reply_box_placeholder' => '返信をここに入力',
        'reply_title_prefix' => 'Re',
        'started_by' => 'by :user',
        'started_by_verbose' => '開始したユーザー: :user',

        'create' => [
            'preview' => 'プレビュー',
            // TL note: this is used in the topic reply preview, when
            // the user goes back from previewing to editing the reply
            'preview_hide' => '編集',
            'submit' => '投稿',

            'necropost' => [
                'default' => '',

                'new_topic' => [
                    '_' => "",
                    'create' => '',
                ],
            ],

            'placeholder' => [
                'body' => '内容をここに入力',
                'title' => 'ここにタイトルを記入',
            ],
        ],

        'jump' => [
            'enter' => '投稿番号をクリックして入力',
            'first' => '最初の投稿に飛ぶ',
            'last' => '最後の投稿に飛ぶ',
            'next' => '投稿10個を飛ばす',
            'previous' => '投稿10個を遡る',
        ],

        'post_edit' => [
            'cancel' => 'キャンセル',
            'post' => '保存',
        ],
    ],

    'topic_watches' => [
        'index' => [
            'title' => 'フォーラムサブスクリプション',
            'title_compact' => 'フォーラムサブスクリプション',
            'title_main' => 'フォーラム<strong>サブスクリプション</strong>',

            'box' => [
                'total' => 'サブスクライブしているトピック',
                'unread' => '新しい投稿があるトピック',
            ],

            'info' => [
                'total' => ':total個のトピックにサブスクライブしています。',
                'unread' => ':unread個の未読の返信があります。',
            ],
        ],

        'topic_buttons' => [
            'remove' => [
                'confirmation' => 'トピックのサブスクライブを外しますか？',
                'title' => 'サブスクライブを外す',
            ],
        ],
    ],

    'topics' => [
        '_' => 'トピック',

        'actions' => [
            'login_reply' => 'ログインして返信する',
            'reply' => '返信',
            'reply_with_quote' => '引用して返信',
            'search' => '検索',
        ],

        'create' => [
            'create_poll' => 'ポールの作成',

            'create_poll_button' => [
                'add' => 'ポールを作成',
                'remove' => 'ポールの作成をキャンセル',
            ],

            'poll' => [
                'length' => 'ポールの期限を設定する',
                'length_days_suffix' => '日間',
                'length_info' => '空白で無期限に設定されます',
                'max_options' => '選択数',
                'max_options_info' => '一人のユーザーが選べる選択肢の数の上限です',
                'options' => '選択肢',
                'options_info' => '選択肢ごとに改行してください。上限は10個までです。',
                'title' => '質問',
                'vote_change' => '投票の変更を可能にする',
                'vote_change_info' => '有効にすると投票した後でも違う選択肢に変える事ができます。',
            ],
        ],

        'edit_title' => [
            'start' => 'タイトルの編集',
        ],

        'index' => [
            'views' => '観覧数',
            'replies' => '返信数',
        ],

        'issue_tag_added' => [
            'to_0' => '"added" タグを外す',
            'to_0_done' => '"added" タグを外しました',
            'to_1' => '"added" タグを追加する',
            'to_1_done' => '"added" タグを追加しました',
        ],

        'issue_tag_assigned' => [
            'to_0' => '"assigned" タグを外す',
            'to_0_done' => '"assigned" タグを外しました',
            'to_1' => '"assigned" タグを追加する',
            'to_1_done' => '"assigned" タグを追加しました',
        ],

        'issue_tag_confirmed' => [
            'to_0' => '"confirmed" タグを外す',
            'to_0_done' => '"confirmed" タグを外しました',
            'to_1' => '"confirmed" タグを追加する',
            'to_1_done' => '"confirmed" タグを追加しました',
        ],

        'issue_tag_duplicate' => [
            'to_0' => '"duplicate" タグを外す',
            'to_0_done' => '"duplicate" タグを外しました',
            'to_1' => '"duplicate" タグを追加する',
            'to_1_done' => '"duplicate" タグを追加しました',
        ],

        'issue_tag_invalid' => [
            'to_0' => '"invalid" タグを外す',
            'to_0_done' => '"invalid" タグを外しました',
            'to_1' => '"invalid" タグを追加する',
            'to_1_done' => '"invalid" タグを追加しました',
        ],

        'issue_tag_resolved' => [
            'to_0' => '"resolved" タグを外す',
            'to_0_done' => '"resolved" タグを外しました',
            'to_1' => '"resolved" タグを追加する',
            'to_1_done' => '"resolved" タグを追加しました',
        ],

        'lock' => [
            'is_locked' => 'このトピックはロックされていて投稿が制限されています。',
            'to_0' => 'トピックのロックを外す',
            'to_0_done' => 'ロックが外されました',
            'to_1' => 'トピックをロックする',
            'to_1_done' => 'ロックされました',
        ],

        'moderate_move' => [
            'title' => '別のフォーラムに移動する',
        ],

        'moderate_pin' => [
            'to_0' => 'トピックのピンを外す',
            'to_0_done' => 'ピンが外されました',
            'to_1' => 'トピックをピン付けする',
            'to_1_done' => 'ピン付けされました',
            'to_2' => 'トピックをピン付けしてアナウンスメントとしてマークする',
            'to_2_done' => 'ピン付けされてアナウンスメントになりました',
        ],

        'show' => [
            'deleted-posts' => '削除された投稿',
            'total_posts' => '全ての投稿',

            'feature_vote' => [
                'current' => '現在の優先度： +:count',
                'do' => 'このリクエストを推進する',

                'user' => [
                    'count' => '{0} 投票なし|[1,*] :count票',
                    'current' => '自分の持ち票数は:votes回です。',
                    'not_enough' => "票が足りません。",
                ],
            ],

            'poll' => [
                'vote' => '投票',

                'detail' => [
                    'end_time' => 'ポールの期限終了は :time です',
                    'ended' => 'ポールの期限は :time に終了しました',
                    'total' => '総票数: :count',
                ],
            ],
        ],

        'watch' => [
            'to_not_watching' => 'ブックマーク無し',
            'to_watching' => 'ブックマーク',
            'to_watching_mail' => 'ブックマーク（通知あり）',
            'mail_disable' => '通知を無効にする',
        ],
    ],
];
