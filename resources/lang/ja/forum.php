<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'pinned_topics' => 'ピン留めされたトピック',
    'slogan' => "ひとりで遊ぶにはキケンじゃ",
    'subforums' => 'サブフォーラム',
    'title' => 'osu! フォーラム',

    'covers' => [
        'edit' => 'カバーを編集',

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

    'forums' => [
        'latest_post' => '最新の投稿',

        'index' => [
            'title' => 'フォーラム 目次',
        ],

        'topics' => [
            'empty' => 'トピックがありません！',
        ],
    ],

    'mark_as_read' => [
        'forum' => 'フォーラムを既読にする',
        'forums' => 'フォーラムを既読にする',
        'busy' => '既読にする・・・',
    ],

    'post' => [
        'confirm_destroy' => '投稿を本当に削除しますか？',
        'confirm_restore' => '投稿を本当に復元しますか？',
        'edited' => ':userが:whenに最終編集、合計:count_delimited回の編集',
        'posted_at' => '投稿日時 :when',
        'posted_by' => ':username による投稿',

        'actions' => [
            'destroy' => '投稿を削除',
            'edit' => '投稿を編集',
            'report' => '投稿を報告',
            'restore' => '投稿を復元',
        ],

        'create' => [
            'title' => [
                'reply' => '新規返信',
            ],
        ],

        'info' => [
            'post_count' => ':count_delimited 投稿|:count_delimited 投稿',
            'topic_starter' => 'トピック開始者',
        ],
    ],

    'search' => [
        'go_to_post' => '投稿に飛ぶ',
        'post_number_input' => '投稿番号を入力',
        'total_posts' => '合計:posts_count個の投稿',
    ],

    'topic' => [
        'confirm_destroy' => 'トピックを本当に削除しますか？',
        'confirm_restore' => 'トピックを本当に復元しますか？',
        'deleted' => '削除されたトピック',
        'go_to_latest' => '最新の投稿を見る',
        'has_replied' => 'このトピックに返信しました',
        'in_forum' => ':forum',
        'latest_post' => ':when by :user',
        'latest_reply_by' => '最新の投稿 by :user',
        'new_topic' => 'トピックの新規作成',
        'new_topic_login' => 'ログインして新規トピックを投稿',
        'post_reply' => '投稿',
        'reply_box_placeholder' => '返信をここに入力',
        'reply_title_prefix' => 'Re',
        'started_by' => 'by :user',
        'started_by_verbose' => '開始したユーザー: :user',

        'actions' => [
            'destroy' => 'トピックを削除',
            'restore' => 'トピックを復元',
        ],

        'create' => [
            'close' => '閉じる',
            'preview' => 'プレビュー',
            // TL note: this is used in the topic reply preview, when
            // the user goes back from previewing to editing the reply
            'preview_hide' => '編集',
            'submit' => '投稿',

            'necropost' => [
                'default' => 'このトピックはしばらくの間アクティブではありません。特別な理由がある場合のみ、ここに投稿してください。',

                'new_topic' => [
                    '_' => "このトピックはしばらくアクティブになっていません。ここに投稿しなければならない特別な理由がない場合は、代わりに:createしてください。",
                    'create' => '新規トピックを作成',
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
            'next' => '10件の投稿を飛ばす',
            'previous' => '投稿を10件戻る',
        ],

        'logs' => [
            '_' => '',
            'button' => '',

            'columns' => [
                'action' => '',
                'date' => '',
                'user' => '',
            ],

            'data' => [
                'add_tag' => '',
                'announcement' => '',
                'edit_topic' => '',
                'fork' => '',
                'pin' => '',
                'post_operation' => '',
                'remove_tag' => '',
                'source_forum_operation' => '',
                'unpin' => '',
            ],

            'no_results' => '',

            'operations' => [
                'delete_post' => '',
                'delete_topic' => '',
                'edit_topic' => '',
                'edit_poll' => '',
                'fork' => '',
                'issue_tag' => '',
                'lock' => '',
                'merge' => '',
                'move' => '',
                'pin' => '',
                'post_edited' => '',
                'restore_post' => '',
                'restore_topic' => '',
                'split_destination' => '',
                'split_source' => '',
                'topic_type' => '',
                'topic_type_changed' => '',
                'unlock' => '',
                'unpin' => '',
                'user_lock' => '',
                'user_unlock' => '',
            ],
        ],

        'post_edit' => [
            'cancel' => 'キャンセル',
            'post' => '保存',
        ],
    ],

    'topic_watches' => [
        'index' => [
            'title_compact' => 'フォーラムトピック ウォッチリスト',

            'box' => [
                'total' => 'サブスクライブ中のトピック',
                'unread' => '新しい投稿があるトピック',
            ],

            'info' => [
                'total' => ':total個のトピックをサブスクライブしています。',
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
            'create_poll' => '投票の作成',

            'preview' => '投稿のプレビュー',

            'create_poll_button' => [
                'add' => '投票を作成',
                'remove' => '投票の作成をキャンセル',
            ],

            'poll' => [
                'hide_results' => '投票結果を非表示にする。',
                'hide_results_info' => '投票が終わった後にだけ表示されます。',
                'length' => '投票期限',
                'length_days_suffix' => '日間',
                'length_info' => '投票期限を設定しない場合は空白のままにしてください',
                'max_options' => '選択数',
                'max_options_info' => '一人のユーザーが選べる選択肢の上限です',
                'options' => '選択肢',
                'options_info' => '選択肢ごとに改行してください。上限は10個までです。',
                'title' => '質問',
                'vote_change' => '投票の変更を可能にする',
                'vote_change_info' => '有効にすると投票後であっても別の選択肢に変えることができます。',
            ],
        ],

        'edit_title' => [
            'start' => 'タイトルの編集',
        ],

        'index' => [
            'feature_votes' => 'スタープライオリティ',
            'replies' => '返信数',
            'views' => '観覧数',
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
            'to_0' => 'トピックのロックを解除する',
            'to_0_confirm' => 'トピックロックを解除しますか？',
            'to_0_done' => 'ロックが解除されました',
            'to_1' => 'トピックをロックする',
            'to_1_confirm' => 'トピックをロックしますか？',
            'to_1_done' => 'ロックされました',
        ],

        'moderate_move' => [
            'title' => '別のフォーラムに移動する',
        ],

        'moderate_pin' => [
            'to_0' => 'トピックのピンを外す',
            'to_0_confirm' => 'トピックのピンを外しますか？',
            'to_0_done' => 'ピンが外されました',
            'to_1' => 'トピックをピン留めする',
            'to_1_confirm' => 'トピックをピン留めしますか？',
            'to_1_done' => 'ピン留めされました',
            'to_2' => 'トピックをピン留めしてアナウンスメントとしてマークする',
            'to_2_confirm' => 'トピックをピン留めしてお知らせとしてマークしますか？',
            'to_2_done' => 'ピン留めされてアナウンスメントになりました',
        ],

        'moderate_toggle_deleted' => [
            'show' => '削除された投稿を表示',
            'hide' => '削除された投稿を非表示',
        ],

        'show' => [
            'deleted-posts' => '削除された投稿',
            'total_posts' => '全ての投稿',

            'feature_vote' => [
                'current' => '現在の優先度： +:count',
                'do' => 'このリクエストを推進する',

                'info' => [
                    '_' => 'これは:feature_requestです。機能の提案は:supportersが投票することができます。',
                    'feature_request' => '機能の提案',
                    'supporters' => 'サポーター',
                ],

                'user' => [
                    'count' => '{0} 投票なし|{1,*} :count_delimited 票',
                    'current' => ':votes回可能です。',
                    'not_enough' => "票が足りません。",
                ],
            ],

            'poll' => [
                'edit' => '投票編集',
                'edit_warning' => '投票フォームを編集すると現在の投票結果が削除されます！',
                'vote' => '投票',

                'button' => [
                    'change_vote' => '投票を変更する',
                    'edit' => '投票を編集',
                    'view_results' => '結果にスキップ',
                    'vote' => '投票',
                ],

                'detail' => [
                    'end_time' => '投票期限は :time までです',
                    'ended' => '投票は :time に受付終了しました',
                    'results_hidden' => '投票後に結果が表示されます。',
                    'total' => '総票数: :count',
                ],
            ],
        ],

        'watch' => [
            'to_not_watching' => 'ブックマーク無し',
            'to_watching' => 'ブックマーク',
            'to_watching_mail' => 'ブックマーク（通知あり）',
            'tooltip_mail_disable' => '通知は有効です。クリックして無効化',
            'tooltip_mail_enable' => '通知は無効です。クリックして有効化',
        ],
    ],
];
