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
    'deleted' => '[削除されたユーザーです]',

    'beatmapset_activities' => [
        'title' => ":userのModding履歴",
        'title_compact' => 'Modding',

        'discussions' => [
            'title_recent' => '最近のディスカッション',
        ],

        'events' => [
            'title_recent' => '最近の出来事',
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
        'remember' => 'ログイン状態を保存する',
        'title' => '続行するにはログインが必要です',
        'failed' => 'サインインに失敗しました',
        'register' => "osu!アカウントがない方はこちらから",
        'forgot' => 'パスワードを紛失した場合',
        'beta' => [
            'main' => 'ベータアクセスは権限があるユーザーのみに付与されます',
            'small' => '(osu!サポーターは間もなくもらえます)',
        ],

        'here' => 'こちら', // this is substituted in when generating a link above. change it to suit the language.
    ],

    'posts' => [
        'title' => ':username\の投稿',
    ],

    'signup' => [
        '_' => '新規登録',
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
            'cheating' => '不正行為・チート',
            'insults' => 'あなた、もしくは第三者への罵倒',
            'spam' => 'スパム行為',
            'unwanted_content' => '不適切なコンテンツ',
            'nonsense' => 'ナンセンスな行為',
            'other' => 'その他 (下に入力してください)',
        ],
    ],
    'restricted_banner' => [
        'title' => 'あなたのアカウントは制限されました。',
        'message' => '制限中は他のプレイヤーとの交流ができなくなり、自分のスコアも他人には表示されなくなります。制限のほとんどは自動的な処理で、通常２４時間以内に解除されます。制限が不当な物だと感じた場合、<a href="mailto:accounts@ppy.sh">サポートにお問い合わせください</a>。',
    ],
    'show' => [
        'age' => ':age歳',
        'change_avatar' => 'アバター画像の変更',
        'first_members' => '創設時からのメンバー',
        'is_developer' => 'osu!開発者',
        'is_supporter' => 'osu!サポーター',
        'joined_at' => '登録日 :date',
        'lastvisit' => '最終ログイン :date',
        'missingtext' => '打ち間違いがないか確認してください！（ユーザーが削除されている可能性もあります）',
        'origin_country' => '所在国 :country',
        'page_description' => 'osu! - :usernameについていろいろ！',
        'previous_usernames' => '以前の名前',
        'plays_with' => '使用デバイス :devices',
        'title' => ":usernameのプロフィール",

        'edit' => [
            'cover' => [
                'button' => 'カバー画像の変更',
                'defaults_info' => 'カバーの選択肢は増える予定です',
                'upload' => [
                    'broken_file' => '画像の処理に失敗しました。ファイルの破損か形式が合っているかを確認してください。',
                    'button' => '画像のアップロード',
                    'dropzone' => 'ここにドロップしてアップロード',
                    'dropzone_info' => 'ここにドラッグ＆ドロップでアップロードが可能です。',
                    'restriction_info' => "<a href='".route('store.products.show', 'supporter-tag')."' target='_blank'>osu!サポーター</a>のみアップロードできます",
                    'size_info' => '推奨の画像サイズは2800x620です',
                    'too_large' => '画像ファイルの容量が大きすぎます。',
                    'unsupported_format' => '対応している画像形式ではありません。',
                ],
            ],

            'default_playmode' => [
                'is_default_tooltip' => 'メインのゲームモード',
                'set' => ':modeをメインのゲームモードに設定しました',
            ],
        ],

        'extra' => [
            'followers' => ':count フォロワー',
            'unranked' => '最近のスコアはありません',

            'achievements' => [
                'achieved-on' => '取得日時 :date',
                'locked' => 'ロック',
                'title' => '実績',
            ],
            'beatmaps' => [
                'by_artist' => 'by :artist',
                'none' => 'まだ、空っぽ。',
                'title' => '譜面',

                'favourite' => [
                    'title' => 'お気に入りの譜面',
                ],
                'graveyard' => [
                    'title' => 'Graveyardの譜面',
                ],
                'loved' => [
                    'title' => 'Lovedされた譜面',
                ],
                'ranked_and_approved' => [
                    'title' => 'RankedかApprovedの譜面',
                ],
                'unranked' => [
                    'title' => 'Pendingの譜面',
                ],
            ],
            'historical' => [
                'empty' => 'パフォーマンス測定可能な記録がまだありません。',
                'title' => 'プレイの記録',

                'monthly_playcounts' => [
                    'title' => 'プレイ回数の履歴',
                    'count_label' => 'プレイ数',
                ],
                'most_played' => [
                    'count' => 'プレイ回数',
                    'title' => 'プレイ回数の多い譜面順',
                ],
                'recent_plays' => [
                    'accuracy' => '精度: :percentage',
                    'title' => '最近のプレイ（24時間以内）',
                ],
                'replays_watched_counts' => [
                    'title' => 'リプレイの再生回数',
                    'count_label' => 'リプレイ視聴',
                ],
            ],
            'kudosu' => [
                'available' => '使用可能なKudosu',
                'available_info' => "Kudosuは譜面の優先順位に関わるKudosu starと交換できます。これは未交換のKudosuの数です。",
                'recent_entries' => '最近のKudosu履歴',
                'title' => 'Kudosu!',
                'total' => '累計Kudosu取得数',
                'total_info' => '譜面制作のModdingなどの貢献度を表す数値です。詳細は<a href="'.osu_url('user.kudosu').'詳細は">this page</a>を参照。',

                'entry' => [
                    'amount' => ':amount kudosu',
                    'empty' => "このユーザーはまだkudosu!を取得していません。",

                    'beatmap_discussion' => [
                        'allow_kudosu' => [
                            'give' => ':postのkudosu取得拒否の取り消しにより:amount取得',
                        ],

                        'deny_kudosu' => [
                            'reset' => ':postの:amount取得を拒否',
                        ],

                        'delete' => [
                            'reset' => ':postの削除により:amount取り消し',
                        ],

                        'restore' => [
                            'give' => ':postの復元により:amount取得',
                        ],

                        'vote' => [
                            'give' => ':postのvoteにより:amount取得',
                            'reset' => ':postのvote減少により:amount取り消し',
                        ],

                        'recalculate' => [
                            'give' => ':postのvotes再計算により:amount取得',
                            'reset' => ':postのvotes再計算により:amount取り消し',
                        ],
                    ],

                    'forum_post' => [
                        'give' => ':postの投稿で :giverから:amount取得',
                        'reset' => ':postの:giverによるkudosuリセット',
                        'revoke' => ':postの:giverによるkudosu拒否',
                    ],
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
            'recent_activity' => [
                'title' => '最近のアクティビティ',
            ],
            'top_ranks' => [
                'download_replay' => 'リプレイをダウンロード',
                'empty' => 'まだ記録がありません！',
                'not_ranked' => 'ランクビートマップのみがppを与えます。',
                'pp_weight' => '割合 :percentage',
                'title' => 'ランク',

                'best' => [
                    'title' => 'ベストパフォーマンス',
                ],
                'first' => [
                    'title' => '1位の記録',
                ],
            ],
            'account_standing' => [
                'title' => 'アカウントの状態',
                'bad_standing' => "<strong>:username</strong>のアカウントはルール違反の記録があります。",
                'remaining_silence' => '<strong>:username</strong>は後:duration日で再び発言ができるようになります。',

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
            'reason_2' => 'セキュリティの問題や不正利用の可能性によりアカウントが一時的に利用不可能になっている場合があります。',
            'reason_3' => '打ち間違いがないか確認してください！',
            'reason_header' => '考えられる主な理由：',
            'title' => 'ユーザーが見つかりませんでした。 ｡･ﾟ･(ﾉД` )･ﾟ･｡',
        ],
        'page' => [
            'button' => 'プロフィールページを編集する',
            'description' => '<strong>me!</strong>はプロフィール上で自由に編集できる領域です。',
            'edit_big' => 'me!を編集',
            'placeholder' => '内容はここ',
            'restriction_info' => "<a href='".route('store.products.show', 'supporter-tag')."' target='_blank'>osu!サポーター</a>限定の機能です。",
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
            'ranked_score' => '合計ランクスコア',
            'replays_watched_by_others' => 'リプレイの再生回数',
            'score_ranks' => 'スコアランク',
            'total_hits' => '合計ヒット数',
            'total_score' => '合計スコア',
        ],
    ],
    'status' => [
        'online' => 'オンライン',
        'offline' => 'オフライン',
    ],
    'store' => [
        'saved' => 'ユーザー作成',
    ],
    'verify' => [
        'title' => 'アカウントの認証',
    ],
];
