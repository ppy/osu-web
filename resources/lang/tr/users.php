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
    'deleted' => '[silinmiş kullanıcı]',

    'beatmapset_activities' => [
        'title' => ":user'in Modlama Geçmişi",

        'discussions' => [
            'title_recent' => 'Yakın zamanda başlatılan tartışmalar',
        ],

        'events' => [
            'title_recent' => 'Yakın zamandaki etkinlikler',
        ],

        'posts' => [
            'title_recent' => 'Yakın zamandaki gönderiler',
        ],

        'votes_received' => [
            'title_most' => 'Tarafından en çok oylanan (son 3 ay)',
        ],

        'votes_made' => [
            'title_most' => 'En çok oylanan (son 3 ay)',
        ],
    ],

    'blocks' => [
        'banner_text' => 'Bu kullanıcıyı engelledin.',
        'blocked_count' => 'engellenen kullanıcılar (:count)',
        'hide_profile' => 'profili gizle',
        'not_blocked' => 'Bu kullanıcı engellenmemiş.',
        'show_profile' => 'profili göster',
        'too_many' => 'Engelleme sınırına ulaşıldı.',
        'button' => [
            'block' => 'engelle',
            'unblock' => 'engellemeyi kaldır',
        ],
    ],

    'card' => [
        'loading' => 'Yükleniyor...',
        'send_message' => 'mesaj gönder',
    ],

    'login' => [
        '_' => 'Giriş Yap',
        'locked_ip' => 'IP adresiniz kilitli. Lütfen birkaç dakika bekleyin.',
        'username' => 'Kullanıcı adı',
        'password' => 'Şifre',
        'button' => 'Giriş Yap',
        'button_posting' => 'Giriş yapılıyor...',
        'remember' => 'Bu bilgisayarı hatırla',
        'title' => 'Devam etmek için lütfen giriş yapın',
        'failed' => 'Hatalı giriş',
        'register' => "osu! hesabınız yok mu? Yeni bir tane oluşturun",
        'forgot' => 'Şifrenizi mi unuttunuz?',
        'beta' => [
            'main' => 'Beta erişimi ayrıcalıklı üyelere kısıtlandırılmıştır.',
            'small' => '(osu!supporterlar yakında erişebilecekler)',
        ],

        'here' => 'buraya', // this is substituted in when generating a link above. change it to suit the language.
    ],

    'posts' => [
        'title' => ':username\'in gönderileri',
    ],

    'signup' => [
        '_' => 'Kayıt Ol',
    ],
    'anonymous' => [
        'login_link' => 'giriş yapmak için tıklayın',
        'login_text' => 'giriş yap',
        'username' => 'Misafir',
        'error' => 'Bunu yapmak için giriş yapmalısınız.',
    ],
    'logout_confirm' => 'Çıkış yapmak istediğinize emin misiniz? :(',
    'report' => [
        'button_text' => 'şikayet et',
        'comments' => 'Ek yorumlar',
        'placeholder' => 'Lütfen kullanışlı olabileceğini düşündüğünüz her türlü bilgiyi iletin.',
        'reason' => 'Gerekçe',
        'thanks' => 'Bildirdiğiniz için teşekkürler!',
        'title' => ':username şikayet edilsin mi?',

        'actions' => [
            'send' => 'Rapor Et',
            'cancel' => 'İptal',
        ],

        'options' => [
            'cheating' => 'Kuraldışı oyun / Hile',
            'insults' => 'Bana / başkalarına hakaret',
            'spam' => 'Spam yapmak',
            'unwanted_content' => 'Uygunsuz içerik paylaşma',
            'nonsense' => 'Saçmalık',
            'other' => 'Diğer (aşağıda belirtin)',
        ],
    ],
    'restricted_banner' => [
        'title' => 'Hesabınız kısıtlandı!',
        'message' => 'Kısıtlanmışken, diğer oyuncularla etkileşime geçemeyecek ve skorlarınızı sadece siz görebileceksiniz. Bu genellikle otomatik olan bir işlemin sonucudur ve 24 saat içerisinde kalkabilir. Kısıtlamanızın açılması için başvurmak istiyorsanız, lütfen <a href="mailto:accounts@ppy.sh">destek hattıyla</a> iletişime geçin.',
    ],
    'show' => [
        'age' => ':age yaşında',
        'change_avatar' => 'avatarını değiştir!',
        'first_members' => 'Başlangıçtan beri burada',
        'is_developer' => 'osu!geliştiricisi',
        'is_supporter' => 'osu!supporter',
        'joined_at' => ':date tarihinde katıldı',
        'lastvisit' => 'Son görülme :date',
        'missingtext' => 'Yazım hatası yapmış olabilirsin! (veya bu kullanıcı banlanmış olabilir)',
        'origin_country' => 'Ülke: :country',
        'page_description' => 'osu! - :username hakkında bilmek istediğiniz her şey!',
        'previous_usernames' => 'nâm-ı diğer',
        'plays_with' => ':devices ile oynuyor',
        'title' => ":username kullanıcısının profili",

        'edit' => [
            'cover' => [
                'button' => 'Kapak Fotoğrafını Değiştir',
                'defaults_info' => 'Diğer kapak seçenekleri gelecekte mevcut olacak',
                'upload' => [
                    'broken_file' => 'Resmin işlenmesi başarısız oldu. Yüklediğiniz resmi doğrulayıp tekrar deneyin.',
                    'button' => 'Resim yükle',
                    'dropzone' => 'Yüklemek için dosyayı bırak',
                    'dropzone_info' => 'Yüklemek için resmi buraya da bırakabilirsiniz',
                    'restriction_info' => "Yükleme <a href=' için uygun".route('store.products.show', 'supporter-tag')."' target='_blank'>osu!supporter'lara</a> özel",
                    'size_info' => 'Kapak boyutu 2000x700 olmalı',
                    'too_large' => 'Yüklenen dosya boyutu çok büyük.',
                    'unsupported_format' => 'Desteklenmeyen biçim.',
                ],
            ],

            'default_playmode' => [
                'is_default_tooltip' => 'varsayılan oyun modu',
                'set' => ':mode \'ı varsayılan oyun modu olarak ayarla',
            ],
        ],

        'extra' => [
            'followers' => '1 takipçi|:count takipçi',
            'unranked' => 'Son zamanlarda oynamamış',

            'achievements' => [
                'title' => 'Başarımlar',
                'achieved-on' => ':date tarihinde başarıldı',
            ],
            'beatmaps' => [
                'none' => 'Hiç yok... şimdilik.',
                'title' => 'Beatmapler',

                'favourite' => [
                    'title' => 'Favori Beatmapler (:count)',
                ],
                'graveyard' => [
                    'title' => 'Terk Edilmiş Beatmapler (:count)',
                ],
                'loved' => [
                    'title' => 'Sevilen Beatmapler (:count)',
                ],
                'ranked_and_approved' => [
                    'title' => 'Dereceli & Onaylanmış Beatmapler (:count)',
                ],
                'unranked' => [
                    'title' => 'Onay Beklenen Beatmapler (:count)',
                ],
            ],
            'historical' => [
                'empty' => 'Performans kaydı yok. :(',
                'title' => 'Geçmiş',

                'monthly_playcounts' => [
                    'title' => 'Oyun Geçmişi',
                ],
                'most_played' => [
                    'count' => 'oynama sayısı',
                    'title' => 'En Çok Oynanan Beatmapler',
                ],
                'recent_plays' => [
                    'accuracy' => 'isabet oranı: :percentage',
                    'title' => 'Son Oynamalar (24s)',
                ],
                'replays_watched_counts' => [
                    'title' => 'Tekrar İzlenme Geçmişi',
                ],
            ],
            'kudosu' => [
                'available' => 'Mevcut Kudosu',
                'available_info' => "Kudosu'larınızı yaptığınız beatmapler'in daha çok dikkat çekmesi için kullanabilirsiniz. Bu sayı, henüz kullanmadığınız kudosu'ların sayısını gösterir.",
                'recent_entries' => 'Son Kudosu Geçmişi',
                'title' => 'Kudosu!',
                'total' => 'Kazanılan Toplam Kudosu',
                'total_info' => 'Kullanıcının beatmap\'lere ne kadar katkıda bulunduğuna bağlıdır. Daha fazla bilgi için <a href="'.osu_url('user.kudosu').'daha fazla bilgi için ">bu sayfaya</a> bakınız.',

                'entry' => [
                    'amount' => ':amount kudosu',
                    'empty' => "Bu kullanıcı henüz kudosu almamış!",

                    'beatmap_discussion' => [
                        'allow_kudosu' => [
                            'give' => ':post mod gönderisinde kudosu red iptalinden dolayı :amount kazanıldı',
                        ],

                        'deny_kudosu' => [
                            'reset' => ':post mod gönderisinden :amount reddedildi',
                        ],

                        'delete' => [
                            'reset' => ':post mod gönderisi silindiğinden dolayı :amount kaybedildi',
                        ],

                        'restore' => [
                            'give' => ':post mod gönderisinin iyileştirilmesinden dolayı :amount kazanıldı',
                        ],

                        'vote' => [
                            'give' => ':post mod gönderisinde alınan oylardan :amount kazanıldı',
                            'reset' => ':post mod gönderisinde kaybedilen oylardan :amount kaybedildi',
                        ],

                        'recalculate' => [
                            'give' => ':post mod gönderisinde oyların yeniden hesaplanmasından dolayı :amount kazanıldı',
                            'reset' => ':post mod gönderisinde oyların yeniden hesaplanmasından dolayı :amount kaybedildi',
                        ],
                    ],

                    'forum_post' => [
                        'give' => ':post gönderisinde :giver tarafından :amount kazanıldı',
                        'reset' => ':post gönderisinde :giver tarafından kudosu sıfırlandı',
                        'revoke' => ':post gönderisinde :giver tarafından kudosu reddedildi',
                    ],
                ],
            ],
            'me' => [
                'title' => 'ben!',
            ],
            'medals' => [
                'empty' => "Bu kullanıcı daha hiç almamış. ;_;",
                'title' => 'Madalyalar',
            ],
            'recent_activity' => [
                'title' => 'Son',
            ],
            'top_ranks' => [
                'empty' => 'Henüz kayda değer bir performans kaydı yok. :(',
                'not_ranked' => 'Sadece dereceli beatmapler pp verir.',
                'pp' => '',
                'title' => 'Dereceler',
                'weighted_pp' => 'ağırlıklı: :pp (:percentage)',

                'best' => [
                    'title' => 'En İyi Performans',
                ],
                'first' => [
                    'title' => 'Birincilikler',
                ],
            ],
            'account_standing' => [
                'title' => 'Hesap Durumu',
                'bad_standing' => "<strong>:username'in</strong> hesabı iyi durumda değil :(",
                'remaining_silence' => '<strong>:username</strong> :duration sonra konuşabilecek.',

                'recent_infringements' => [
                    'title' => 'Son İhlaller',
                    'date' => 'tarih',
                    'action' => 'eylem',
                    'length' => 'uzunluk',
                    'length_permanent' => 'Kalıcı',
                    'description' => 'açıklama',
                    'actor' => ':username tarafından',

                    'actions' => [
                        'restriction' => 'Ban',
                        'silence' => 'Susturma',
                        'note' => 'Not',
                    ],
                ],
            ],
        ],
        'info' => [
            'discord' => '',
            'interests' => 'İlgi Alanları',
            'lastfm' => 'Last.fm',
            'location' => 'Mevcut Konum',
            'occupation' => 'Meslek',
            'skype' => '',
            'twitter' => '',
            'website' => 'Web sitesi',
        ],
        'not_found' => [
            'reason_1' => 'Kullanıcı adını değiştirmiş olabilir.',
            'reason_2' => 'Bu hesap kötüye kullanım veya güvenlik sebepleriyle geçici olarak kullanım dışı olabilir.',
            'reason_3' => 'Yazım hatası yapmış olabilirsin!',
            'reason_header' => 'Buna sebep olan birkaç şey şunlar olabilir:',
            'title' => 'Kullanıcı bulunamadı! ;_;',
        ],
        'page' => [
            'description' => '<strong>ben!</strong>, profil sayfanızdaki kişiselleştirilebilir bir alandır.',
            'edit_big' => 'Beni düzenle!',
            'placeholder' => 'Sayfanın içeriğini buraya yaz',
            'restriction_info' => "<a href=' olmanız gerekiyor".route('store.products.show', 'supporter-tag')."' target='_blank'>osu!supporter</a> olmanız gerekir.",
        ],
        'post_count' => [
            '_' => ':link kadar katkı',
            'count' => ':count forum gönderisi|:count forum gönderisi',
        ],
        'rank' => [
            'country' => ':mode için Ülke sıralaması',
            'global' => ':mode için Dünya sıralaması',
        ],
        'stats' => [
            'hit_accuracy' => 'Vuruş İsabeti',
            'level' => ':level Seviye',
            'maximum_combo' => 'Maksimum Kombo',
            'play_count' => 'Toplam Oynama Sayısı',
            'play_time' => 'Toplam Oynama Süresi',
            'ranked_score' => 'Dereceli Skor',
            'replays_watched_by_others' => 'Başkaları Tarafından İzlenen Tekrarlar',
            'score_ranks' => 'Skor Dereceleri',
            'total_hits' => 'Toplam Vuruş',
            'total_score' => 'Toplam Skor',
        ],
    ],
    'status' => [
        'online' => 'Çevrimiçi',
        'offline' => 'Çevrimdışı',
    ],
    'store' => [
        'saved' => 'Kullanıcı oluşturuldu',
    ],
    'verify' => [
        'title' => 'Hesap Doğrulama',
    ],
];
