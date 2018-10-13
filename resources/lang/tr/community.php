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
            'big_description' => 'osu!\'yu seviyor musunuz?<br/>
                                osu!\'nun gelişimine destek olun :D',
            'small_description' => '',
            'support_button' => 'osu!\'yu desteklemek istiyorum!',
        ],

        'dev_quote' => 'osu! oynaması tamamen bedava bir oyun, ancak onu ayakta tutmak kesinlikle değil.        Sunucuların tutulması ve uluslararası yüksek kalite bant genişliğinin sağlanması, sistemin ve topluluğun ayakta durması için harcanan zaman,         yarışmalar için ödüller sağlamak, desteğe gelen soruları yanıtlamak ve genel olarak insanları mutlu etmek derken, osu! oldukça yüklü bir miktar para tüketiyor!        Ah, aynı zamanda bütün bunları herhangi bir reklam göstermeden ya da şapşal araç çubukları gibileri olmadan yaptığımızı unutmayın!            <br/><br/>Günün sonunda, osu! çoğunlukla benim tarafımdan yürütülüyor, ki bazılarınız beni "peppy" olarak tanıyor olabilir.            osu!\'ya ayak uydurabilmek için günlük işimden istifa etmek zorunda kaldım,            ve zaman zaman ulaşmak için gayret gösterdiğim standartlarımı korumakta zorlanıyorum.            osu!\'yu şimdiye kadar desteklemiş olan herkese şahsi teşekkürlerimi sunmak istiyor,            ve bir o kadarını da bu harika oyunu ve topluluğunu destekleyenlere sunuyorum :).',

        'supporter_status' => [
            'contribution' => 'Desteğiniz için teşekkürler! Toplamda :tags farklı alımla :dollars yardımda bulundunuz!',
            'gifted' => ':giftedTags defa hediye olarak aldınız (toplam :giftedDollars hediye verdiniz), bu ne bonkörlük!',
            'not_yet' => "Şimdilik supporter'ınız yok :(",
            'title' => 'Şu anki supporter durumu',
            'valid_until' => 'Şu anki osu!supporter etiketiniz :date tarihine kadar geçerli!',
            'was_valid_until' => 'osu!supporter etiketiniz :date tarihine kadar geçerliydi.',
        ],

        'why_support' => [
            'title' => 'Neden osu!\'yu desteklemeliyim?',
            'blocks' => [
                'dev' => 'Çoğunlukla Avustralya\'da adamın biri tarafından geliştirilip idame ettiriliyor',
                'time' => 'Sürdürmesi çok zaman aldığından artık "hobi" olmaktan çıktı.',
                'ads' => 'Hiçbir yerde reklam yok.<br/><br/>                        İnternetin %99.95\'inin aksine, suratınıza bir şeyler dayayarak kâr sağlamıyoruz.',
                'goodies' => 'Ekstra şeyler de alacaksınız!',
            ],
        ],

        'perks' => [
            'title' => 'Öyle mi? Neler alacağım?!',
            'osu_direct' => [
                'title' => 'osu!direct',
                'description' => 'oyundan çıkmaya gerek kalmadan beatmaplere kolay ve hızlı ulaşım.',
            ],

            'auto_downloads' => [
                'title' => 'Otomatik İndirme',
                'description' => 'Multiplayer oynarken, başkalarını izlerken veya chatteki linklere tıkladığınızda mapleri otomatik indirir!',
            ],

            'upload_more' => [
                'title' => 'Daha Fazla Yükle',
                'description' => 'Maksimum 10 olmak üzere fazladan (dereceli beatmap başına) beklemede beatmap yuvası.',
            ],

            'early_access' => [
                'title' => 'Erken Erişim',
                'description' => 'Herkese sunulmadan önce, yeni özellikleri deneyebileceğiniz güncellemelere sahip olma fırsatı!',
            ],

            'customisation' => [
                'title' => 'Özelleştirme',
                'description' => 'Tamamen özelleştirilebilir bir kullanıcı sayfası ile profilinizi özelleştirin.',
            ],

            'beatmap_filters' => [
                'title' => 'Beatmap Filtreleri',
                'description' => 'Beatmap aramalarınızı oynanmış, oynanmamış ya da (eğer varsa) elde edilmiş dereceye göre filtreleme.',
            ],

            'yellow_fellow' => [
                'title' => 'Sarı Dost',
                'description' => 'Oyun içinde yeni parlak sarı kullanıcı adı renginizle farkınız gözüksün.',
            ],

            'speedy_downloads' => [
                'title' => 'Hızlı İndirme',
                'description' => 'Daha yumuşak indirme kısıtlamaları, özellikle osu!direct kullanırken.',
            ],

            'change_username' => [
                'title' => 'Kullanıcı Adı Değiştirme',
                'description' => 'Ekstra ücret alınmadan kullanıcı adını değiştirebilme yetisi. (maksimum bir kere)',
            ],

            'skinnables' => [
                'title' => 'Kişiselleştirilebilir Ögeler',
                'description' => 'Kişiselleştirilebilir ek oyun-içi ögeler, ana menü arka planı gibi.',
            ],

            'feature_votes' => [
                'title' => 'Özellik Oyları',
                'description' => 'Özellik istekleri için oylar. (Ayda 2 adet)',
            ],

            'sort_options' => [
                'title' => 'Sıralama Seçenekleri',
                'description' => 'Oyun içinde beatmaplerin ülke/arkadaş/moda göre sıralamalarını görme yeteneği.',
            ],

            'feel_special' => [
                'title' => 'Özel Hisset',
                'description' => 'osu!\'yu sıkıntısızca çalıştırmak için yaptığın katkının verdiği o sıcacık his!',
            ],

            'more_to_come' => [
                'title' => 'Dahası gelecek',
                'description' => '',
            ],
        ],

        'convinced' => [
            'title' => 'İkna oldum! :D',
            'support' => 'osu!\'yu destekle!',
            'gift' => 'veya diğer oyunculara hediye et',
            'instructions' => 'kalbe tıklayıp osu!store\'a ilerle',
        ],
    ],
];
