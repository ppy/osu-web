<?php

/**
 *    Copyright 2015-2017 ppy Pty. Ltd.
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
    'deleted' => '[deleted user]',

    'login' => [
        '_' => 'ログイン',
        'locked_ip' => 'あなたのIPアドレスは規制されています。数分後もう一度お試しください。',
        'username' => 'ユーザー名',
        'password' => 'パスワード',
        'button' => 'ログイン',
        'button_posting' => 'ログイン中・・・',
        'remember' => 'ログイン状態を保存する',
        'title' => '続行するにはログインしてください。',
        'failed' => '認証に失敗しました',
        'register' => "osu!アカウントをお持ちでない方はこちらから",
        'forgot' => 'パスワードを紛失しましたか？',
        'beta' => [
            'main' => 'Beta access is currently restricted to privileged users.',
            'small' => '(supporters will get in soon)',
        ],

        'here' => 'ここ', // this is substituted in when generating a link above. change it to suit the language.
    ],
    'signup' => [
        '_' => '新規登録',
    ],
    'anonymous' => [
        'login_link' => 'クリックしてログイン',
        'username' => 'ゲスト',
        'error' => 'ログインが必要です。',
    ],
    'logout_confirm' => 'ログアウトしてもよろしいですか？',
    'restricted_banner' => [
        'title' => 'あなたのアカウントは規制されました。',
        'message' => '規制中は他のプレイヤーと干渉ができなくなり、自分のスコアも自分以外に表示されなくなります。ほとんどは自動的な処理で、２４時間以内に解決します。規制が不正な物だと感じた場合、<a href="mailto:accounts@ppy.sh">サポートにお問い合わせください</a>。',
    ],
    'show' => [
        '404' => 'ユーザーが見つかりませんでした。',
        'age' => ':age歳',
        'current_location' => '現在地 :location',
        'first_members' => '創設時からメンバー',
        'is_developer' => 'osu!デベロッパー',
        'is_supporter' => 'osu!サポーター',
        'joined_at' => '登録日時 :date',
        'lastvisit' => '最終ログイン :date',
        'missingtext' => '打ち間違いなどを確認してください！（ユーザーが既に削除されている可能性もあります）',
        'origin_age' => ':age',
        'origin_country' => '出身地 :country',
        'origin_country_age' => ':countryの:age歳',
        'page_description' => 'osu! - :usernameについて知りたかった事すべて！',
        'plays_with' => '使用デバイス :devices',
        'title' => ":usernameのプロフィール",

        'edit' => [
            'cover' => [
                'button' => 'カバー画像の変更',
                'defaults_info' => 'カバーオプションは追加で実装予定です',
                'upload' => [
                    'broken_file' => '画像の処理に失敗しました。ファイルの形式や破損を再度確認してください。',
                    'button' => '画像のアップロード',
                    'dropzone' => 'ここにドロップでアップロード',
                    'dropzone_info' => 'ここにドラッグ＆ドロップでアップロードが可能です。',
                    'restriction_info' => "<a href='".osu_url('support-the-game')."' target='_blank'>osu!サポーター</a>のみアップロードできます",
                    'size_info' => '推奨の画像サイズは2000x700です',
                    'too_large' => '画像ファイルの容量が大きすぎます。',
                    'unsupported_format' => '対応している画像形式ではありません。',
                ],
            ],
        ],
        'extra' => [
            'followers' => '1 フォロワー|:count フォロワー',
            'unranked' => '最近のスコアはありません',

            'achievements' => [
                'title' => '実績',
                'achieved-on' => '取得日時 :date',
            ],
            'beatmaps' => [
                'title' => '譜面',
            ],
            'historical' => [
                'empty' => 'パフォーマンス測定可能の記録がまだありません。',
                'most_played' => [
                    'count' => 'プレイ',
                    'title' => '最も多くプレイした譜面',
                ],
                'recent_plays' => [
                    'accuracy' => '精度： :percentage',
                    'title' => '最近のプレイ（24時間以内）',
                ],
                'title' => 'Historical',
            ],
            'kudosu' => [
                'available' => '使用可能のKudosu',
                'available_info' => "Kudosuは譜面の優先順位に関わるKudosu starと交換できます。これは未交換のKudosuの数です。",
                'recent_entries' => '最近のKudosu履歴',
                'title' => 'Kudosu!',
                'total' => '累計Kudosu取得数',
                'total_info' => '譜面制作の手直しなどの貢献度を表す数値です。詳細は<a href="'.osu_url('user.kudosu').'">Kudosu!</a> wikiを参照。',

                'entry' => [
                    'amount' => ':amount kudosu',
                    'empty' => "このユーザーはまだkudosu!を取得していません。",

                    'beatmap_discussion' => [
                        'allow_kudosu' => [
                            'give' => ':postのkudosu取得拒否の取り消しにより:amount取得',
                        ],

                        'deny_kudosu' => [
                            'reset' => ':postの:amount取を拒否',
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
                    ],

                    'forum_post' => [
                        'give' => ':postの投稿で:amount取得',
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
                'title' => 'メダル',
            ],
            'recent_activities' => [
                'title' => '最近の活動',
            ],
            'top_ranks' => [
                'best' => [
                    'title' => 'ベストパフォーマンス',
                ],
                'empty' => 'まだ記録を作ってません！',
                'first' => [
                    'title' => '1位の記録',
                ],
                'pp' => ':amountpp',
                'title' => 'ランク',
                'weighted_pp' => 'weighted: :pp (:percentage)',
            ],
            'beatmaps' => [
                'title' => '譜面',
                'favourite' => [
                    'title' => 'お気に入りの譜面 (:count)',
                ],
                'ranked_and_approved' => [
                    'title' => 'ランクド譜面 (:count)',
                ],
                'none' => '無し',
            ],
        ],
        'page' => [
            'description' => '<strong>me!</strong>はプロフィール上で自由に編集できる領域です。',
            'edit_big' => 'me!を編集',
            'placeholder' => '内容はここ',
            'restriction_info' => "<a href='".osu_url('support-the-game')."' target='_blank'>osu!サポーター</a>限定の機能です。",
        ],
        'rank' => [
            'country' => ':modeの国内ランク',
            'global' => ':modeの世界ランク',
        ],
        'stats' => [
            'hit_accuracy' => '精度',
            'level' => 'レベル :level',
            'maximum_combo' => '最大コンボ',
            'play_count' => 'プレイ回数',
            'ranked_score' => '合計ランクドスコア',
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
