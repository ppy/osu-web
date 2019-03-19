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
        'header' => [
            // size in font-size
            'big_description' => 'osu!を楽しんでますか？<br/>
                                osu!の開発者をサポートしましょう！',
            'small_description' => '',
            'support_button' => 'osu!をサポートする！',
        ],

        'dev_quote' => 'osu!は完全に無料でプレイできるゲームです、しかし維持するのは無料ではありません。
        サーバー運用費用や高品質な国際帯域幅、システムのメンテナンスとコミュニティの維持に費やされた時間、
        大会の賞品の提供、サポート対応、プレイヤーが満足のいく環境作りなど、osu!の維持には膨大な費用がかかっています！
        そして、私達はいかなる広告も愚かなツールバーなどと提携せずに維持しているという事実を忘れないでください！
            <br/><br/>osu!の大部分は私が維持しています。あなたは「peppy」として私を知っているかもしれません。
            私はosu!を維持する為に仕事を辞めなくてはいけませんでした。
            そして、自分に課した課題を維持する為に日々奮闘しています。
            これまでosu!を支援してくれた方々に感謝を申し上げたいと思います。
            そして、この素晴らしいゲームとコミュニティをこれからも支援し続けてくれる方々にも感謝を伝えたいです。',

        'supporter_status' => [
            'contribution' => 'osu!をサポートしてくれてありがとうございます！今までに:dollarsで:tags個のタグを購入しました！',
            'gifted' => '今までのサポータータグ購入のうち:giftedTags個がギフト（合計金額：:giftedDollars）として送られました。あなたの寛大さに拍手！',
            'not_yet' => "サポータータグをまだ持っていません :(",
            'title' => '現在のosu!サポーターのステータス',
            'valid_until' => 'あなたのosu!サポータータグは:dateまで有効です！',
            'was_valid_until' => 'あなたのosu!サポータータグは:dateに期限切れになりました。',
        ],

        'why_support' => [
            'title' => 'osu!を支援する理由とは？',
            'blocks' => [
                'dev' => 'オーストラリアのある一人の男によって開発され、維持されている',
                'time' => '維持には莫大な時間がかかる為、もはや「趣味」と呼ぶことはできません。',
                'ads' => '広告はありません。<br/><br/>
                        99.95%のウェブとは違い、見たくもないものを見せつけて利益を得ることはしません。',
                'goodies' => 'いろいろな特典を入手！',
            ],
        ],

        'perks' => [
            'title' => '特典とは？',
            'osu_direct' => [
                'title' => 'osu!direct',
                'description' => 'ゲームから離れることなくビートマップを素早くダウンロード。',
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
                'description' => '自分のユーザーページに自由に編集できる領域が追加されます。',
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
            'instructions' => 'ハートボタンをクリックでosu!storeに飛びます',
        ],
    ],
];
