<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'discussion-votes' => [
        'update' => [
            'error' => '評価の更新に失敗しました',
        ],
    ],

    'discussions' => [
        'allow_kudosu' => 'kudosuを許可',
        'beatmap_information' => 'ビートマップページ',
        'delete' => '削除',
        'deleted' => ':editorが:delete_timeに削除',
        'deny_kudosu' => 'kudosuを拒否',
        'edit' => '編集',
        'edited' => ':editorが:update_timeに編集',
        'guest' => 'ゲスト難易度 by :user',
        'kudosu_denied' => 'kudosuの入手を拒否されました。',
        'message_placeholder_deleted_beatmap' => 'この難易度は削除された為これ以上ディスカッションに投稿できません。',
        'message_placeholder_locked' => 'このビートマップに関するディスカッションは無効になっています。',
        'message_placeholder_silenced' => "サイレンス中はディスカッションへ投稿できません。",
        'message_type_select' => 'コメントタイプを選択',
        'reply_notice' => 'Enterキーを押して送信',
        'reply_placeholder' => 'ここに入力してください',
        'require-login' => '返信するにはログインが必要です。',
        'resolved' => '解決済み',
        'restore' => '復元',
        'show_deleted' => '削除済みを表示',
        'title' => 'ディスカッション',

        'collapse' => [
            'all-collapse' => '全てを折りたたむ',
            'all-expand' => '全て展開',
        ],

        'empty' => [
            'empty' => 'まだディスカッションはありません！',
            'hidden' => '該当するディスカッションは見つかりませんでした。',
        ],

        'lock' => [
            'button' => [
                'lock' => 'ディスカッションのロック',
                'unlock' => 'ディスカッションのロック解除',
            ],

            'prompt' => [
                'lock' => 'ロックの理由',
                'unlock' => '本当にロックを解除しますか？',
            ],
        ],

        'message_hint' => [
            'in_general' => 'この投稿はビートマップディスカッションの一般に投稿されます。この難易度の問題を修正するには、タイムスタンプ（例：00:12:345）でメッセージを開始してください。',
            'in_timeline' => '複数のタイムスタンプをmodするには、投稿を複数回に分けてください。',
        ],

        'message_placeholder' => [
            'general' => '一般（:version）への投稿をここに入力',
            'generalAll' => '一般 （全ての難易度）への投稿をここに入力',
            'review' => 'レビューを投稿するにはここに入力してください',
            'timeline' => 'タイムライン（:version）へ投稿するにはここに入力',
        ],

        'message_type' => [
            'disqualify' => 'Disqualify',
            'hype' => 'Hype!',
            'mapper_note' => '注意',
            'nomination_reset' => 'ノミネーションをリセット',
            'praise' => '称賛',
            'problem' => '問題',
            'review' => 'レビュー',
            'suggestion' => '提案',
        ],

        'mode' => [
            'events' => '履歴',
            'general' => '一般:scope',
            'reviews' => 'レビュー',
            'timeline' => 'タイムライン',
            'scopes' => [
                'general' => 'この難易度',
                'generalAll' => '全ての難易度',
            ],
        ],

        'new' => [
            'pin' => 'ピン',
            'timestamp' => 'タイムスタンプ',
            'timestamp_missing' => 'ゲーム内のEdit画面でCtrl+Cを押してメッセージに張り付けるとタイムスタンプになります！',
            'title' => '新しいディスカッション',
            'unpin' => 'ピン解除',
        ],

        'review' => [
            'new' => '新しいレビュー',
            'embed' => [
                'delete' => '削除',
                'missing' => '[削除されたディスカッション]',
                'unlink' => 'リンク解除',
                'unsaved' => '未保存',
                'timestamp' => [
                    'all-diff' => '「全ての難易度」に関する投稿はタイムスタンプできません。',
                    'diff' => 'この:typeがタイムスタンプで始まる場合、タイムラインの下に表示されます。',
                ],
            ],
            'insert-block' => [
                'paragraph' => '段落の挿入',
                'praise' => '称賛を挿入',
                'problem' => '問題の挿入',
                'suggestion' => '提案を挿入',
            ],
        ],

        'show' => [
            'title' => ':title 作成 :mapper',
        ],

        'sort' => [
            'created_at' => '作成日時',
            'timeline' => 'タイムライン',
            'updated_at' => '最終更新',
        ],

        'stats' => [
            'deleted' => '削除済み',
            'mapper_notes' => '注意',
            'mine' => '自分',
            'pending' => 'Pending',
            'praises' => '称賛',
            'resolved' => '解決済み',
            'total' => '全て',
        ],

        'status-messages' => [
            'approved' => 'このビートマップは:dateにApprovedになりました！',
            'graveyard' => "このビートマップは:dateから更新が止まっているため放棄された可能性があります・・・",
            'loved' => 'このビートマップは:dateにLovedに追加しました！',
            'ranked' => 'このビートマップは:dateにRankedになりました！',
            'wip' => '注意：このビートマップは作者によって作成途中とされています。',
        ],

        'votes' => [
            'none' => [
                'down' => '反対票はまだありません',
                'up' => '賛成票はまだありません',
            ],
            'latest' => [
                'down' => '最近の反対票',
                'up' => '最近の賛成票',
            ],
        ],
    ],

    'hype' => [
        'button' => 'ビートマップにHypeする！',
        'button_done' => 'Hype済みです！',
        'confirm' => "あなたの残りHype数は:n回です。Hypeは取り消しできません。Hypeしますか？",
        'explanation' => 'このビートマップにHypeすることで注目が集まり、ノミネーションやRankedがされやすくなります！',
        'explanation_guest' => 'ログインしてHypeすることでこのビートマップに注目が集まり、ノミネーションやRankedがされやすくなります！',
        'new_time' => ":new_timeでhype数が回復します。",
        'remaining' => 'あなたの残りHype数は:remaining回です',
        'required_text' => 'Hype: :current/:required',
        'section_title' => 'Hype Train',
        'title' => 'Hype',
    ],

    'feedback' => [
        'button' => 'フィードバックを残す',
    ],

    'nominations' => [
        'delete' => '削除',
        'delete_own_confirm' => '本当によろしいですか？ビートマップは削除され、プロフィール画面にリダイレクトされます。',
        'delete_other_confirm' => '本当によろしいですか？ビートマップは削除され、ユーザーのプロフィール画面にリダイレクトされます。',
        'disqualification_prompt' => 'Disqualification（Qualifyの取り消し）の理由',
        'disqualified_at' => ':time_agoにDisqualifyされました(:reason).',
        'disqualified_no_reason' => '理由が設定されていません',
        'disqualify' => 'Disqualify',
        'incorrect_state' => 'エラーが発生しました。ページの再読み込みを試してください。',
        'love' => 'Lovedに追加',
        'love_confirm' => 'Lovedに追加しますか？',
        'nominate' => 'ノミネート',
        'nominate_confirm' => 'このビートマップをノミネートしますか？',
        'nominated_by' => ':usersがノミネート',
        'not_enough_hype' => "Hypeが足りません",
        'remove_from_loved' => 'Lovedから削除',
        'remove_from_loved_prompt' => 'Lovedから削除した理由：',
        'required_text' => 'ノミネート数: :current/:required',
        'reset_message_deleted' => '削除済み',
        'title' => 'ノミネートのステータス',
        'unresolved_issues' => 'まだ未解決の問題があります。',

        'rank_estimate' => [
            '_' => 'このマップは、問題が見つからなければ :date にrankedされると推定されます。:queue 内の #:position ',
            'queue' => 'ランキングキュー',
            'soon' => '間もなく',
        ],

        'reset_at' => [
            'nomination_reset' => 'ノミネーション審査が:userによる新しい問題:discussion （:message）により、:time_agoにリセットされました。',
            'disqualify' => ':userの新しい問題:discussion（:message）により、:time_agoにDisqualifyしました。',
        ],

        'reset_confirm' => [
            'nomination_reset' => '本当によろしいですか？新しい問題を投稿するとノミネーション審査中ではなくなります。',
            'disqualify' => '本当によろしいですか？これによりビートマップがQualifiedから外され、ノミネーション審査がリセットされます。',
        ],
    ],

    'listing' => [
        'search' => [
            'prompt' => 'キーワードを入力・・・',
            'login_required' => 'ログインして検索する。',
            'options' => '検索の詳細設定',
            'supporter_filter' => ':filters による絞り込みにはosu!サポータータグが必要です',
            'not-found' => '該当結果なし',
            'not-found-quote' => '・・・なにも見つからなかったようだ。',
            'filters' => [
                'extra' => '追加情報',
                'general' => '全般',
                'genre' => 'ジャンル',
                'language' => '言語',
                'mode' => 'モード',
                'nsfw' => '露骨なコンテンツ',
                'played' => 'プレイ済み',
                'rank' => 'Rank取得日',
                'status' => 'カテゴリー',
            ],
            'sorting' => [
                'title' => 'タイトル',
                'artist' => 'アーティスト',
                'difficulty' => '難易度',
                'favourites' => 'お気に入り',
                'updated' => '更新',
                'ranked' => 'Ranked',
                'rating' => '評価',
                'plays' => 'プレイ数',
                'relevance' => '関連性',
                'nominations' => 'ノミネーション',
            ],
            'supporter_filter_quote' => [
                '_' => ':filters による絞り込みには有効な:link が必要です',
                'link_text' => 'osu!サポータータグ',
            ],
        ],
    ],
    'general' => [
        'converts' => 'コンバートビートマップを含める',
        'follows' => 'サブスクライブ中のマッパー',
        'recommended' => '推奨難易度',
    ],
    'mode' => [
        'all' => '全て',
        'any' => '全て',
        'osu' => '',
        'taiko' => '',
        'fruits' => '',
        'mania' => '',
    ],
    'status' => [
        'any' => '全て',
        'approved' => 'Approved',
        'favourites' => 'お気に入り',
        'graveyard' => 'Graveyard',
        'leaderboard' => 'リーダーボード',
        'loved' => 'Loved',
        'mine' => 'マイマップ',
        'pending' => 'Pending & WIP',
        'qualified' => 'Qualified',
        'ranked' => 'Ranked',
    ],
    'genre' => [
        'any' => '全て',
        'unspecified' => '未分類',
        'video-game' => 'ゲーム',
        'anime' => 'アニメ',
        'rock' => 'ロック',
        'pop' => 'ポップ',
        'other' => 'その他',
        'novelty' => 'ノベルティ',
        'hip-hop' => 'ヒップホップ',
        'electronic' => 'エレクトロニック',
        'metal' => 'メタル',
        'classical' => 'クラシカル',
        'folk' => 'フォーク',
        'jazz' => 'ジャズ',
    ],
    'mods' => [
        '4K' => '',
        '5K' => '',
        '6K' => '',
        '7K' => '',
        '8K' => '',
        '9K' => '',
        'AP' => '',
        'DT' => '',
        'EZ' => '',
        'FI' => '',
        'FL' => '',
        'HD' => '',
        'HR' => '',
        'HT' => '',
        'MR' => '',
        'NC' => '',
        'NF' => '',
        'NM' => '',
        'PF' => '',
        'RX' => 'Relax',
        'SD' => '',
        'SO' => '',
        'TD' => '',
        'V2' => 'Score V2',
    ],
    'language' => [
        'any' => '全て',
        'english' => '英語',
        'chinese' => '中国語',
        'french' => 'フランス語',
        'german' => 'ドイツ語',
        'italian' => 'イタリア語',
        'japanese' => '日本語',
        'korean' => '韓国語',
        'spanish' => 'スペイン語',
        'swedish' => 'スウェーデン語',
        'russian' => 'ロシア語',
        'polish' => 'ポーランド語',
        'instrumental' => '楽器',
        'other' => 'その他',
        'unspecified' => '未分類',
    ],

    'nsfw' => [
        'exclude' => '非表示',
        'include' => '表示',
    ],

    'played' => [
        'any' => '全て',
        'played' => 'プレイ済み',
        'unplayed' => '未プレイ',
    ],
    'extra' => [
        'video' => '動画あり',
        'storyboard' => 'ストーリーボードあり',
    ],
    'rank' => [
        'any' => '全て',
        'XH' => 'Silver SS',
        'X' => '',
        'SH' => 'Silver S',
        'S' => '',
        'A' => '',
        'B' => '',
        'C' => '',
        'D' => '',
    ],
    'panel' => [
        'playcount' => 'プレイ回数：:count',
        'favourites' => 'お気に入り：:count',
    ],
    'variant' => [
        'mania' => [
            '4k' => '4K',
            '7k' => '7K',
            'all' => '全て',
        ],
    ],
];
