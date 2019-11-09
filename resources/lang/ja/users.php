<?php

/**
 *    Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
 *    See the LICENCE file in the repository root for full licence text.
 */

return [
    'deleted' => '[削除されたユーザー]',

    'beatmapset_activities' => [
        'title' => ":userのModding履歴",
        'title_compact' => 'Modding',

        'discussions' => [
            'title_recent' => '最近開始されたディスカッション',
        ],

        'events' => [
            'title_recent' => '最近のイベント',
        ],

        'posts' => [
            'title_recent' => '最近の投稿',
        ],

        'votes_received' => [
            'title_most' => '最も評価の高い（3ヶ月以内）',
        ],

        'votes_made' => [
            'title_most' => '最も評価した（3ヶ月以内）',
        ],
    ],

    'blocks' => [
        'banner_text' => 'このユーザーにブロックされています。',
        'blocked_count' => 'ブロックしたユーザー(:count)',
        'hide_profile' => 'プロフィールを隠す',
        'not_blocked' => 'このユーザーにはブロックされていません。',
        'show_profile' => 'プロフィールを表示',
        'too_many' => 'ブロックできる上限に達しました。',
        'button' => [
            'block' => 'ブロック',
            'unblock' => 'ブロック解除',
        ],
    ],

    'card' => [
        'loading' => '読み込み中・・・',
        'send_message' => 'メッセージの送信',
    ],

    'login' => [
        '_' => 'ログイン',
        'locked_ip' => 'あなたのIPアドレスは規制されています。数分後もう一度お試しください。',
        'username' => 'ユーザー名',
        'password' => 'パスワード',
        'button' => 'ログイン',
        'button_posting' => 'ログイン中・・・',
        'remember' => 'ログイン状態を保持する',
        'title' => '続行するにはログインが必要です',
        'failed' => 'ログインに失敗しました',
        'register' => "osu!アカウントを持っていませんか？新しいアカウントを作るにはこちらから",
        'forgot' => 'パスワードを忘れましたか？',
        'beta' => [
            'main' => 'ベータアクセスは権限があるユーザーのみに付与されます',
            'small' => '(osu!サポーターはすぐ手に入ります)',
        ],

        'here' => 'こちら', // this is substituted in when generating a link above. change it to suit the language.
    ],

    'posts' => [
        'title' => ':usernameの投稿',
    ],

    'anonymous' => [
        'login_link' => 'クリックしてログイン',
        'login_text' => 'ログイン',
        'username' => 'ゲスト',
        'error' => 'ログインが必要です。',
    ],
    'logout_confirm' => 'ログアウトしてもよろしいですか？',
    'report' => [
        'button_text' => '報告',
        'comments' => '追加のコメント',
        'placeholder' => 'あなたが役に立つと思う情報を書いて下さい。',
        'reason' => '理由',
        'thanks' => 'ご報告ありがとうございます！',
        'title' => ':usernameを報告しますか？',

        'actions' => [
            'send' => 'レポートの送信',
            'cancel' => 'キャンセル',
        ],

        'options' => [
            'cheating' => '不正行為/チート',
            'insults' => 'あなた/他の人への侮辱',
            'spam' => 'スパム',
            'unwanted_content' => '不適切なコンテンツへのリンク',
            'nonsense' => 'ナンセンスな行為',
            'other' => 'その他（下記に入力）',
        ],
    ],
    'restricted_banner' => [
        'title' => 'アカウントが制限されました！',
        'message' => '制限中は他のプレイヤーと交流ができなくなり、スコアが他人には表示されなくなります。ほとんどの場合、自動的に行われた処理で通常２４時間以内に解除されます。この制限に異議を申し立てたい場合は<a href="mailto:accounts@ppy.sh">サポート</a>に問い合わせて下さい。',
    ],
    'show' => [
        'age' => ':age歳',
        'change_avatar' => 'アバター画像の変更',
        'first_members' => '創設時からのメンバー',
        'is_developer' => 'osu!開発者',
        'is_supporter' => 'osu!サポーター',
        'joined_at' => '登録日 :date',
        'lastvisit' => '最終ログイン :date',
        'lastvisit_online' => '現在オンライン',
        'missingtext' => '打ち間違いがないか確認してください！（ユーザーが削除されている可能性もあります）',
        'origin_country' => '所在国 :country',
        'page_description' => 'osu! - :usernameについていろいろ！',
        'previous_usernames' => '以前の名前',
        'plays_with' => '使用デバイス :devices',
        'title' => ":usernameのプロフィール",

        'edit' => [
            'cover' => [
                'button' => 'カバー画像の変更',
                'defaults_info' => 'カバー画像の選択肢は増える予定です',
                'upload' => [
                    'broken_file' => '画像の処理に失敗しました。アップロードした画像を確認してもう一度やり直して下さい。',
                    'button' => '画像のアップロード',
                    'dropzone' => 'ここにドロップしてアップロード',
                    'dropzone_info' => 'ここにドラッグ＆ドロップでアップロードが可能です。',
                    'size_info' => '推奨の画像サイズは2800x620です',
                    'too_large' => 'アップロードファイルが大きすぎます。',
                    'unsupported_format' => 'サポートされていないフォーマットです。',

                    'restriction_info' => [
                        '_' => 'アップロードは :link でのみ可能です',
                        'link' => 'osu!サポーター',
                    ],
                ],
            ],

            'default_playmode' => [
                'is_default_tooltip' => 'メインのゲームモード',
                'set' => ':modeをメインのゲームモードに設定しました',
            ],
        ],

        'extra' => [
            'none' => 'なし',
            'unranked' => '最近のプレイはありません',

            'achievements' => [
                'achieved-on' => '取得日時 :date',
                'locked' => 'ロック',
                'title' => '実績',
            ],
            'beatmaps' => [
                'by_artist' => 'by :artist',
                'none' => 'まだ、空っぽ。',
                'title' => 'ビートマップ',

                'favourite' => [
                    'title' => 'お気に入りのビートマップ',
                ],
                'graveyard' => [
                    'title' => 'Graveyardのビートマップ',
                ],
                'loved' => [
                    'title' => 'Lovedされたビートマップ',
                ],
                'ranked_and_approved' => [
                    'title' => 'Ranked & Approvedのビートマップ',
                ],
                'unranked' => [
                    'title' => '保留中のビートマップ',
                ],
            ],
            'discussions' => [
                'title' => 'ディスカッション',
                'title_longer' => '最近のディスカッション',
                'show_more' => '他のディスカッションを見る',
            ],
            'events' => [
                'title' => 'イベント',
                'title_longer' => '最近のイベント',
                'show_more' => '他のイベントを見る',
            ],
            'historical' => [
                'empty' => 'パフォーマンスの記録がありません。',
                'title' => '履歴',

                'monthly_playcounts' => [
                    'title' => 'プレイ回数の履歴',
                    'count_label' => 'プレイ数',
                ],
                'most_played' => [
                    'count' => 'プレイ回数',
                    'title' => 'プレイ回数の多いビートマップ',
                ],
                'recent_plays' => [
                    'accuracy' => '精度: :percentage',
                    'title' => '最近のプレイ（24時間以内）',
                ],
                'replays_watched_counts' => [
                    'title' => 'リプレイの再生回数',
                    'count_label' => 'リプレイ再生回数',
                ],
            ],
            'kudosu' => [
                'available' => '使用可能なKudosu',
                'available_info' => "KudosuはKudosuスターと交換ができ、ビートマップに注目を集めるのに役立ちます。これは交換されていないKudosuの数です。",
                'recent_entries' => '最近のKudosu履歴',
                'title' => 'Kudosu!',
                'total' => 'Kudosuの累計獲得数',

                'entry' => [
                    'amount' => ':amount kudosu',
                    'empty' => "このユーザーはまだkudosu!を獲得していません！",

                    'beatmap_discussion' => [
                        'allow_kudosu' => [
                            'give' => 'Modding投稿:post のkudosu獲得拒否の取り消しにより :amount 獲得',
                        ],

                        'deny_kudosu' => [
                            'reset' => ':postの :amount 獲得を拒否',
                        ],

                        'delete' => [
                            'reset' => ':post の削除により :amount 取り消し',
                        ],

                        'restore' => [
                            'give' => ':post の復元により :amount 獲得',
                        ],

                        'vote' => [
                            'give' => ':post での投票により :amount 獲得',
                            'reset' => ':post の投票損失により :amount 取り消し',
                        ],

                        'recalculate' => [
                            'give' => ':post の投票再計算により :amount 獲得',
                            'reset' => ':post の投票再計算により :amount 取り消し',
                        ],
                    ],

                    'forum_post' => [
                        'give' => ':post の投稿で:giverから :amount 獲得',
                        'reset' => ':postの:giverによるkudosuリセット',
                        'revoke' => ':postの:giverによるkudosu拒否',
                    ],
                ],

                'total_info' => [
                    '_' => 'ユーザーのビートマップモデレーションへの貢献度に基いています。詳細は :link を確認して下さい。',
                    'link' => 'このページ',
                ],
            ],
            'me' => [
                'title' => 'me!',
            ],
            'medals' => [
                'empty' => "このユーザーはまだメダルを取得していません。",
                'recent' => '最新',
                'title' => 'メダル',
            ],
            'posts' => [
                'title' => '投稿',
                'title_longer' => '最近の投稿',
                'show_more' => '他の投稿を見る',
            ],
            'recent_activity' => [
                'title' => '最近のアクティビティ',
            ],
            'top_ranks' => [
                'download_replay' => 'リプレイをダウンロード',
                'empty' => 'まだ記録がありません！',
                'not_ranked' => 'Rankedビートマップのみがppを与えます。',
                'pp_weight' => '割合 :percentage',
                'title' => 'ランク',

                'best' => [
                    'title' => 'ベストパフォーマンス',
                ],
                'first' => [
                    'title' => '1位の記録',
                ],
            ],
            'votes' => [
                'given' => '与えた投票（３ヶ月）',
                'received' => '受け取った投票（３ヶ月）',
                'title' => '投票',
                'title_longer' => '最近の投票',
                'vote_count' => ':count_delimited 投票',
            ],
            'account_standing' => [
                'title' => 'アカウントの状態',
                'bad_standing' => "<strong>:username</strong>のアカウントはルール違反の記録があります。",
                'remaining_silence' => '<strong>:username</strong>は:durationで再び発言ができるようになります。',

                'recent_infringements' => [
                    'title' => '最近の違反',
                    'date' => '日付',
                    'action' => 'アクション',
                    'length' => '期間',
                    'length_permanent' => '永久',
                    'description' => '詳細',
                    'actor' => 'by :username',

                    'actions' => [
                        'restriction' => 'BAN',
                        'silence' => 'サイレンス',
                        'note' => 'メモ',
                    ],
                ],
            ],
        ],

        'header_title' => [
            '_' => 'プレイヤー :info',
            'info' => '情報',
        ],

        'info' => [
            'discord' => 'Discord',
            'interests' => '趣味',
            'lastfm' => 'Last.fm',
            'location' => '現在地',
            'occupation' => '職業',
            'skype' => 'Skype',
            'twitter' => 'Twitter',
            'website' => 'ウェブサイト',
        ],
        'not_found' => [
            'reason_1' => 'ユーザー名を変更した可能性があります。',
            'reason_2' => 'セキュリティの問題や不正利用の可能性によりアカウントが一時的に利用できなくなる可能性があります。',
            'reason_3' => '打ち間違いがないか確認してください！',
            'reason_header' => '考えられる理由：',
            'title' => 'ユーザーが見つかりませんでした。 ｡･ﾟ･(ﾉД` )･ﾟ･｡',
        ],
        'page' => [
            'button' => 'プロフィールページを編集する',
            'description' => '<strong>me!</strong>はプロフィール上で自由に編集できる領域です。',
            'edit_big' => 'me!を編集',
            'placeholder' => 'ここにページの内容を入力',

            'restriction_info' => [
                '_' => 'この機能を解除するには:linkする必要があります。',
                'link' => 'osu!サポーター',
            ],
        ],
        'post_count' => [
            '_' => 'フォーラム投稿数 :link',
            'count' => ':count個',
        ],
        'rank' => [
            'country' => ':modeの国内ランク',
            'country_simple' => '国別ランキング',
            'global' => ':modeの世界ランク',
            'global_simple' => '世界ランキング',
        ],
        'stats' => [
            'hit_accuracy' => '精度',
            'level' => 'レベル :level',
            'level_progress' => '次のレベルまで',
            'maximum_combo' => '最大コンボ',
            'medals' => 'メダル',
            'play_count' => 'プレイ回数',
            'play_time' => 'プレイ時間',
            'ranked_score' => '合計Rankedスコア',
            'replays_watched_by_others' => 'リプレイが再生された回数',
            'score_ranks' => 'スコアランク',
            'total_hits' => '合計ヒット数',
            'total_score' => '合計スコア',
            // modding stats
            'ranked_and_approved_beatmapset_count' => 'Ranked & Approvedのビートマップ',
            'loved_beatmapset_count' => 'Lovedされたビートマップ',
            'unranked_beatmapset_count' => '保留中のビートマップ',
            'graveyard_beatmapset_count' => 'Graveyardのビートマップ',
        ],
    ],

    'status' => [
        'all' => '全て',
        'online' => 'オンライン',
        'offline' => 'オフライン',
    ],
    'store' => [
        'saved' => 'ユーザー作成',
    ],
    'verify' => [
        'title' => 'アカウントの認証',
    ],

    'view_mode' => [
        'card' => 'カードビュー',
        'list' => '一覧表示',
    ],
];
