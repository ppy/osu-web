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
    'support' => [
        'header' => [
            // size in font-size
            'big_description' => 'Osu!を楽しんでますか?<br/>
                                開発者を支援しよう！',
            'small_description' => '',
            'support_button' => 'osu!の支援をする！',
        ],

        'dev_quote' => 'osu!は利用するには完全に無料ですが、維持するのには確実に費用がかかります。 サーバーの確保や広帯域の国際ネットワーク接続、システムの整備、コミュニティの管理、大会の賞品の提供、サポートの対応、プレイヤーが満足のいく環境づくりなど、osu!の稼働には膨大な費用がかかっています。 広告やアフィリエイトなども導入していません。
            <br/><br/>osu!はほぼ私（peppy）の手だけで稼働しています。
            私はosu!の為に仕事を辞め、
            自分に課した基準を維持する為に日々奮闘しています。
            osu!をこれまで支援してくれた方々には大変感謝していて、
            この素晴らしいゲームとコミュニティをこれからも支援し続けてくれる方々には感謝の気持ちでいっぱいです。',

        'supporter_status' => [
            'contribution' => 'osu!を支えてくれてありがとうございます！今までに:dollarsで:tags個のタグを購入しました！',
            'gifted' => '今までのサポータータグ購入のうち:giftedTags個がギフト（合計金額：:giftedDollars）として送られました。あなたの寛大さに拍手！',
            'not_yet' => "サポータータグをまだ持っていません :(",
            'title' => '現在のサポーターの状態',
            'valid_until' => 'あなたのサポータータグは:dateまで有効です！',
            'was_valid_until' => 'あなたのサポータータグは:dateに期限切れになりました。',
        ],

        'why_support' => [
            'title' => 'osu!を支援する理由とは？',
            'blocks' => [
                'dev' => 'オーストラリアのある男一人によってほぼ稼働している',
                'time' => '維持する為にかかる手間が「趣味」の範疇を超える',
                'ads' => '広告ゼロ。<br/><br/>
                        見たくもない物を見せつけて利益を得る事はしない',
                'goodies' => 'いろいろ特典をゲット！',
            ],
        ],

        'perks' => [
            'title' => '特典とは？',
            'osu_direct' => [
                'title' => 'osu!direct',
                'description' => 'ゲーム内でブラウザを開くことなく譜面を素早くダウンロード。',
            ],

            'auto_downloads' => [
                'title' => '自動ダウンロード',
                'description' => 'スペクト中やマルチ部屋で自動的にダウンロードが完了します。譜面リンクもクリックひとつで導入が終わります。',
            ],

            'upload_more' => [
                'title' => 'アップロード上限解放',
                'description' => 'Pending譜面をアップロードできる数が増えます。（Ranked譜面ひとつにつき）上限は10個です。',
            ],

            'early_access' => [
                'title' => '早期アクセス',
                'description' => 'テスト段階の機能が使えるベータ版のクライアントが利用できる様になります。',
            ],

            'customisation' => [
                'title' => 'カスタマイズ',
                'description' => '自分のユーザーページに自由に編集できる領域が追加されます。',
            ],

            'beatmap_filters' => [
                'title' => '譜面の検索フィルター',
                'description' => '譜面がプレイ・未プレイや取得ランクで検索できるようになります。',
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
                'title' => 'ユーザーネームの変更',
                'description' => 'ユーザーネームの変更を一回だけ追加料金なしで利用できます。',
            ],

            'skinnables' => [
                'title' => 'スキンの拡張',
                'description' => 'メインメニューの背景などが追加でスキンで変更できるようになります。',
            ],

            'feature_votes' => [
                'title' => '機能リクエスト',
                'description' => '機能リクエストに投票できるようになります。（月2回、投票権を取得）',
            ],

            'sort_options' => [
                'title' => 'ランキングオプション',
                'description' => '国別・フレンド・Mod別ランキングが利用できるようになります。',
            ],

            'feel_special' => [
                'title' => '特別な気持ち',
                'description' => 'osu!の支援をしているというポカポカの暖かい気持ちを満喫しましょう。',
            ],

            'more_to_come' => [
                'title' => '追加予定',
                'description' => '',
            ],
        ],

        'convinced' => [
            'title' => 'いいですね！',
            'support' => 'osu!を支援する！',
            'gift' => 'もしくはギフトを送る',
            'instructions' => 'ハートボタンをクリックでosu!ストアに飛びます',
        ],
    ],
];
