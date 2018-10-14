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
    'discussion-posts' => [
        'store' => [
            'error' => '投稿の保存に失敗しました',
        ],
    ],

    'discussion-votes' => [
        'update' => [
            'error' => '評価の更新に失敗しました',
        ],
    ],

    'discussions' => [
        'allow_kudosu' => 'kudosuを許可',
        'delete' => '削除',
        'deleted' => ':editorが:delete_timeに削除',
        'deny_kudosu' => 'kudosuを拒否',
        'edit' => '編集',
        'edited' => ':editorが:update_timeに編集',
        'kudosu_denied' => 'kudosuの入手を拒否されました。',
        'message_placeholder_deleted_beatmap' => 'この難易度は削除されたのでディスカッションはできません。',
        'message_type_select' => 'コメントタイプを選択',
        'reply_notice' => 'Enter キーを押して送信',
        'reply_placeholder' => 'ここに入力してください',
        'require-login' => '返信するにはログインが必要です。',
        'resolved' => '解決済',
        'restore' => '復元',
        'title' => 'ディスカッション',

        'collapse' => [
            'all-collapse' => '全て収納する',
            'all-expand' => '全て展開する',
        ],

        'empty' => [
            'empty' => 'まだディスカッションはありません！',
            'hidden' => '該当するディスカッションは見つかりませんでした。',
        ],

        'message_hint' => [
            'in_general' => 'これは一般のディスカッションに投稿されます。 この譜面をmodするにはタイムスタンプ（例:　00:12:345）で始まるメッセージを入力してください。',
            'in_timeline' => '複数のタイムスタンプをmodするには複数の投稿に分けてください。',
        ],

        'message_placeholder' => [
            'general' => '一般(:version)への投稿をここに入力',
            'generalAll' => '一般 (全難易度) への投稿をここに入力',
            'timeline' => '一般(:version)への投稿をここに入力',
        ],

        'message_type' => [
            'disqualify' => '失格',
            'hype' => 'Hype!',
            'mapper_note' => 'メモ',
            'nomination_reset' => 'ノミネーションをリセット',
            'praise' => '称賛',
            'problem' => '問題',
            'suggestion' => '提案',
        ],

        'mode' => [
            'events' => '履歴',
            'general' => '一般:scope',
            'timeline' => 'タイムライン',
            'scopes' => [
                'general' => '選択中の難易度',
                'generalAll' => '全難易度',
            ],
        ],

        'new' => [
            'timestamp' => 'タイムスタンプ',
            'timestamp_missing' => 'ゲーム内のEdit画面でCtrl+Cを押してメッセージに張り付けるとタイムスタンプになります',
            'title' => '新しいディスカッション',
        ],

        'show' => [
            'title' => ':title mapped by :mapper',
        ],

        'sort' => [
            '_' => '並び替え順:',
            'created_at' => '投稿日時',
            'timeline' => 'タイムライン',
            'updated_at' => '更新日時',
        ],

        'stats' => [
            'deleted' => '削除済',
            'mapper_notes' => 'メモ',
            'mine' => '自分',
            'pending' => '未解決',
            'praises' => '称賛',
            'resolved' => '解決済',
            'total' => '全て',
        ],

        'status-messages' => [
            'approved' => 'この譜面は:dateにApprovedになりました！',
            'graveyard' => "この譜面は:dateから更新が止まっています・・・",
            'loved' => 'この譜面は:dateにLovedになりました！',
            'ranked' => 'この譜面は:dateにRankedになりました！',
            'wip' => '注：この譜面は作者に未完成だとマークされています',
        ],

    ],

    'hype' => [
        'button' => '譜面をHype！',
        'button_done' => 'Hype済みです！',
        'confirm' => "あなたの残りHype数は:n回です。Hypeは取り消しできません。Hypeしますか？",
        'explanation' => 'Hypeすることで譜面に注目が集まりやすくなります。Rankedして欲しい譜面はHypeしましょう！',
        'explanation_guest' => 'Hypeすることで譜面に注目が集まりやすくなります。ログインして譜面をHypeしましょう！',
        'new_time' => ":new_timeで残りhype数が回復します。",
        'remaining' => 'あなたの残りHype数は:remaining回です',
        'required_text' => 'Hype: :current/:required',
        'section_title' => 'Hype進行',
        'title' => 'Hype',
    ],

    'feedback' => [
        'button' => 'コメントを残す',
    ],

    'nominations' => [
        'disqualification_prompt' => 'Disqualification（Qualifyの取り消し）の理由',
        'disqualified_at' => ':time_agoにDisqualifyされました(:reason).',
        'disqualified_no_reason' => '理由が明示されていません',
        'disqualify' => 'Disqualify',
        'incorrect_state' => 'エラーが発生しました。ページの更新をすると直る可能性があります。',
        'love' => 'Lovedに追加',
        'love_confirm' => 'Lovedに追加しますか？',
        'nominate' => 'ノミネート',
        'nominate_confirm' => 'この譜面をノミネートしますか？',
        'nominated_by' => ':usersがノミネート',
        'qualified' => '問題が発覚しなければ:dateにRanked予定',
        'qualified_soon' => '問題が発覚しなければ間もなくRanked',
        'required_text' => 'ノミネート数: :current/:required',
        'reset_message_deleted' => '削除済み',
        'title' => 'ノミネートのステータス',
        'unresolved_issues' => 'まだ未解決の問題があります。',

        'reset_at' => [
            'nomination_reset' => ':userが:time_agoに新しい問題:discussion (:message)によりノミネーションをリセットしました。',
            'disqualify' => ':userが:time_agoに新しい問題:discussion (:message)によりDisqualifyしました。',
        ],

        'reset_confirm' => [
            'nomination_reset' => 'よろしいですか？新しい問題点を投稿すると審査中ではなくなります。',
        ],
    ],

    'listing' => [
        'search' => [
            'prompt' => 'キーワードを入力・・・',
            'login_required' => '検索にはサインインをする必要があります。',
            'options' => '検索の詳細設定',
            'supporter_filter' => ':filters による絞り込みにはサポーター タグが必要です',
            'not-found' => '該当結果なし',
            'not-found-quote' => '・・・なにも見つからなかったようだ。',
            'filters' => [
                'general' => '一般',
                'mode' => 'モード',
                'status' => 'カテゴリー',
                'genre' => 'ジャンル',
                'language' => '言語',
                'extra' => 'エキストラ',
                'rank' => '取得ランク',
                'played' => 'プレイ済み',
            ],
            'sorting' => [
                'title' => '曲名',
                'artist' => 'アーティスト',
                'difficulty' => '難易度',
                'updated' => '更新日時',
                'ranked' => 'ranked日時',
                'rating' => '評価',
                'plays' => 'プレイ数',
                'relevance' => '関連性',
                'nominations' => 'ノミネーション',
            ],
            'supporter_filter_quote' => [
                '_' => ':filters による絞り込みには有効な:link が必要です',
                'link_text' => 'サポーター タグ',
            ],
        ],
    ],
    'general' => [
        'recommended' => '推奨難易度',
        'converts' => 'コンバート譜面を含む',
    ],
    'mode' => [
        'any' => '全て',
        'osu' => 'osu!',
        'taiko' => 'osu!taiko',
        'fruits' => 'osu!catch',
        'mania' => 'osu!mania',
    ],
    'status' => [
        'any' => '全て',
        'ranked-approved' => 'Ranked & Approved',
        'approved' => 'Approved',
        'qualified' => 'Qualified',
        'loved' => 'Loved',
        'faves' => 'お気に入り',
        'pending' => '保留中・製作中',
        'graveyard' => 'Graveyard',
        'my-maps' => 'My Maps',
    ],
    'genre' => [
        'any' => '全て',
        'unspecified' => '未指定',
        'video-game' => 'ゲーム',
        'anime' => 'アニメ',
        'rock' => 'ロック',
        'pop' => 'ポップ',
        'other' => 'その他',
        'novelty' => 'ノベルティ',
        'hip-hop' => 'ヒップホップ',
        'electronic' => 'エレクトロニック',
    ],
    'mods' => [
        '4K' => '4K',
        '5K' => '5K',
        '6K' => '6K',
        '7K' => '7K',
        '8K' => '8K',
        '9K' => '9K',
        'AP' => 'Auto Pilot',
        'DT' => 'Double Time',
        'EZ' => 'Easy Mode',
        'FI' => 'Fade In',
        'FL' => 'Flashlight',
        'HD' => 'Hidden',
        'HR' => 'Hard Rock',
        'HT' => 'Half Time',
        'NC' => 'Nightcore',
        'NF' => 'No Fail',
        'NM' => 'No mods',
        'PF' => 'Perfect',
        'Relax' => 'Relax',
        'SD' => 'Sudden Death',
        'SO' => 'Spun Out',
        'TD' => '液晶タブレット',
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
        'instrumental' => 'Instrumental',
        'other' => 'その他',
    ],
    'played' => [
        'any' => '全て',
        'played' => 'プレイ済み',
        'unplayed' => '未プレイ',
    ],
    'extra' => [
        'video' => '動画あり',
        'storyboard' => 'Storyboardあり',
    ],
    'rank' => [
        'any' => '全て',
        'XH' => '銀SS',
        'X' => 'SS',
        'SH' => '銀S',
        'S' => 'S',
        'A' => 'A',
        'B' => 'B',
        'C' => 'C',
        'D' => 'D',
    ],
];
