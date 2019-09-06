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
    'support' => [
        'convinced' => [
            'title' => 'いいですね！',
            'support' => 'osu!をサポートする！',
            'gift' => 'もしくはギフトを送る',
            'instructions' => 'ハートボタンをクリックでosu!storeに飛びます(英語)',
        ],
        'why-support' => [
            'title' => '',

            'team' => [
                'title' => '',
                'description' => '',
            ],
            'infra' => [
                'title' => '',
                'description' => '',
            ],
            'featured-artists' => [
                'title' => '',
                'description' => '',
                'link_text' => '',
            ],
            'ads' => [
                'title' => '',
                'description' => '',
            ],
            'tournaments' => [
                'title' => '',
                'description' => '',
                'link_text' => '',
            ],
            'bounty-program' => [
                'title' => '',
                'description' => '',
                'link_text' => '',
            ],
        ],
        'perks' => [
            'title' => '特典って？',
            'osu_direct' => [
                'title' => 'osu!direct',
                'description' => 'ゲームから離れることなくビートマップを素早くダウンロード。',
            ],

            'friend_ranking' => [
                'title' => '',
                'description' => "",
            ],

            'country_ranking' => [
                'title' => '',
                'description' => '',
            ],

            'mod_filtering' => [
                'title' => '',
                'description' => '',
            ],

            'auto_downloads' => [
                'title' => '自動ダウンロード',
                'description' => '観戦やマルチプレイをする時に自動的にビートマップをダウンロードします。リンクもクリックだけで終わります。',
            ],

            'upload_more' => [
                'title' => 'アップロード上限解放',
                'description' => '保留中のビートマップをアップロードできる数が増えます。（ランクビートマップ一つあたり）上限は10個です。',
            ],

            'early_access' => [
                'title' => '早期アクセス',
                'description' => 'テスト段階の機能が使えるベータ版のクライアントが利用できる様になります。',
            ],

            'customisation' => [
                'title' => 'カスタマイズ',
                'description' => "自分のユーザーページに自由に編集できる領域が追加されます。",
            ],

            'beatmap_filters' => [
                'title' => 'ビートマップの検索フィルター',
                'description' => 'ビートマップがプレイ・未プレイや取得したランクで検索できるようになります。',
            ],

            'yellow_fellow' => [
                'title' => 'イエローフェロー',
                'description' => 'ゲーム内チャットで名前の色が明るい黄色で表示される様になります。',
            ],

            'speedy_downloads' => [
                'title' => '高速ダウンロード',
                'description' => 'ダウンロードの制限が緩くなります。',
            ],

            'change_username' => [
                'title' => 'ユーザー名の変更',
                'description' => 'ユーザー名の変更を一回だけ追加料金なしで利用できます。',
            ],

            'skinnables' => [
                'title' => 'スキンの拡張',
                'description' => 'メインメニューの背景のような追加スキンを変更できるようになります。',
            ],

            'feature_votes' => [
                'title' => '機能リクエスト',
                'description' => '機能リクエストに投票できるようになります。（月あたり２回）',
            ],

            'sort_options' => [
                'title' => '並び替えオプション',
                'description' => 'ゲーム内でビートマップの国別・フレンド・Mod別ランキングが利用できるようになります。',
            ],

            'more_favourites' => [
                'title' => '',
                'description' => '',
            ],
            'more_friends' => [
                'title' => '',
                'description' => '',
            ],
            'more_beatmaps' => [
                'title' => '',
                'description' => '',
            ],
            'friend_filtering' => [
                'title' => '',
                'description' => '',
            ],

        ],
        'supporter_status' => [
            'contribution' => 'osu!をサポートしてくれてありがとうございます！今までに:dollarsで:tags個のタグを購入しました！',
            'gifted' => "今まで購入したサポータータグのうち:giftedTags個がギフト（ギフト合計金額：:giftedDollars）として送られました。あなたの寛大さに拍手！",
            'not_yet' => "osu!サポータータグをまだ持っていません :(",
            'valid_until' => 'あなたのosu!サポータータグは:dateまで有効です！',
            'was_valid_until' => 'あなたのosu!サポータータグは:dateに期限切れになりました。',
        ],
    ],
];
