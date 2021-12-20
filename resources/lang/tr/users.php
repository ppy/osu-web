<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'deleted' => '[silinmiş kullanıcı]',

    'beatmapset_activities' => [
        'title' => ":user'in Modlama Geçmişi",
        'title_compact' => 'Modlama',

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

    'disabled' => [
        'title' => 'Olamaz! Görünüşe bakılırsa hesabın kilitlenmiş.',
        'warning' => "Bir kuralı ihlal etmeniz durumunda, genellikle herhangi bir af(veya itiraz) talebini dikkate almayacağımız bir aylık bekleme süresinin olduğunu unutmayın.  Bu süreden sonra, gerekli olması halinde bizimle iletişime geçmekte özgürsünüz. Bir hesabı devre dışı bıraktıktan sonra yeni hesap oluşturmanın <strong>bu bir aylık bekleme süresinin uzatılmasına</strong> neden olacağını lütfen unutmayın. Ayrıca <strong> oluşturduğunuz her hesap için kuralları daha fazla ihlal ettiğinizi </strong> unutmayın. Bu yolda gitmemenizi önemle tavsiye ederiz!",

        'if_mistake' => [
            '_' => 'Eğer bir yanlışlık olduğunu düşünüyorsanız, bizimle (:email adresi üzerinden veya bu sayfanın sağ-alt köşesinde bulunan "?" ikonuna tıklayarak) iletişime geçebilirsiniz. Çok sağlam verilere dayandığından, eylemlerimize her daim tamamen güvendiğimizi lütfen unutmayın. Bilerek bizimle dürüst olmadığınızı fark ettiğimizde talebinizi göz ardı etme hakkını saklı tutarız.',
            'email' => 'e-posta',
        ],

        'reasons' => [
            'compromised' => 'Hesabınızın güvenliği ihlal edilmiş sayıldı.  Kimliği doğrulanırken geçici olarak devre dışı bırakılabilir.',
            'opening' => 'Hesabını dondurmaya sebebiyet verebilecek birtakım sebepler var:',

            'tos' => [
                '_' => 'Siz, :community_rules ya da :tos kurallarından bir veya daha fazlasını ihlal ettiniz.',
                'community_rules' => 'topluluk kuralları',
                'tos' => 'hizmet kullanım şartları',
            ],
        ],
    ],

    'filtering' => [
        'by_game_mode' => 'Oyun moduna göre üyeler',
    ],

    'force_reactivation' => [
        'reason' => [
            'inactive_different_country' => "Hesabın uzun bir zamandır kullanılmamıştır.",
        ],
    ],

    'login' => [
        '_' => 'Giriş Yap',
        'button' => 'Giriş Yap',
        'button_posting' => 'Giriş yapılıyor...',
        'email_login_disabled' => 'E-posta ile giriş yapmak şu anlık mümkün değildir. Lütfen kullanıcı adınızı kullanınız.',
        'failed' => 'Hatalı giriş',
        'forgot' => 'Şifrenizi mi unuttunuz?',
        'info' => 'Devam etmek için lütfen giriş yapınız',
        'invalid_captcha' => 'Captcha geçersiz, sayfayı yenileyip tekrar deneyin.',
        'locked_ip' => 'IP adresiniz kilitli. Lütfen birkaç dakika bekleyin.',
        'password' => 'Şifre',
        'register' => "osu! hesabınız yok mu? Yeni bir tane oluşturun",
        'remember' => 'Bu bilgisayarı hatırla',
        'title' => 'Devam etmek için lütfen giriş yapın',
        'username' => 'Kullanıcı adı',

        'beta' => [
            'main' => 'Beta erişimi ayrıcalıklı üyelere kısıtlandırılmıştır.',
            'small' => '(osu!supporterlar yakında erişebilecekler)',
        ],
    ],

    'posts' => [
        'title' => ':username\'in gönderileri',
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
            'multiple_accounts' => 'Birden fazla hesap kullanımı',
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
        'lastvisit_online' => 'Şu an çevrimiçi',
        'missingtext' => 'Yazım hatası yapmış olabilirsin! (veya bu kullanıcı banlanmış olabilir)',
        'origin_country' => 'Ülke: :country',
        'previous_usernames' => 'nâm-ı diğer',
        'plays_with' => ':devices ile oynuyor',
        'title' => ":username kullanıcısının profili",

        'comments_count' => [
            '_' => ':link gönderdi',
            'count' => ':count_delimited yorum|:count_delimited yorum',
        ],
        'edit' => [
            'cover' => [
                'button' => 'Kapak Fotoğrafını Değiştir',
                'defaults_info' => 'Diğer kapak seçenekleri gelecekte mevcut olacak',
                'upload' => [
                    'broken_file' => 'Resmin işlenmesi başarısız oldu. Yüklediğiniz resmi doğrulayıp tekrar deneyin.',
                    'button' => 'Resim yükle',
                    'dropzone' => 'Yüklemek için dosyayı bırak',
                    'dropzone_info' => 'Yüklemek için resmi buraya da bırakabilirsiniz',
                    'size_info' => 'Kapak boyutu 2400x620 olmalı',
                    'too_large' => 'Yüklenen dosya boyutu çok büyük.',
                    'unsupported_format' => 'Desteklenmeyen biçim.',

                    'restriction_info' => [
                        '_' => 'Yükleme sadece :link için mevcut',
                        'link' => 'osu!supporterlar',
                    ],
                ],
            ],

            'default_playmode' => [
                'is_default_tooltip' => 'varsayılan oyun modu',
                'set' => ':mode \'ı varsayılan oyun modu olarak ayarla',
            ],
        ],

        'extra' => [
            'none' => 'hiçbiri',
            'unranked' => 'Son zamanlarda oynamamış',

            'achievements' => [
                'achieved-on' => ':date tarihinde başarıldı',
                'locked' => 'Kilitli',
                'title' => 'Başarımlar',
            ],
            'beatmaps' => [
                'by_artist' => ':artist tarafından',
                'title' => 'Beatmapler',

                'favourite' => [
                    'title' => 'Favori Beatmapler',
                ],
                'graveyard' => [
                    'title' => 'Mezarlıktaki Beatmapler',
                ],
                'loved' => [
                    'title' => 'Sevilen Beatmapler',
                ],
                'pending' => [
                    'title' => 'Beklemedeki Beatmapler',
                ],
                'ranked' => [
                    'title' => 'Dereceli & Onaylı Beatmapler',
                ],
            ],
            'discussions' => [
                'title' => 'Tartışmalar',
                'title_longer' => 'Son Tartışmalar',
                'show_more' => 'daha fazla tartışma gör',
            ],
            'events' => [
                'title' => 'Etkinlikler',
                'title_longer' => 'Son Etkinlikler',
                'show_more' => 'daha fazla etkinlik gör',
            ],
            'historical' => [
                'title' => 'Geçmiş',

                'monthly_playcounts' => [
                    'title' => 'Oyun Geçmişi',
                    'count_label' => 'Oynamalar',
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
                    'count_label' => 'Tekrar İzlendi',
                ],
            ],
            'kudosu' => [
                'recent_entries' => 'Son Kudosu Geçmişi',
                'title' => 'Kudosu!',
                'total' => 'Kazanılan Toplam Kudosu',

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

                'total_info' => [
                    '_' => 'Kullanıcının beatmap modlamaya yaptığı katkının miktarına bağlıdır. Daha fazla bilgi için :link bakınız.',
                    'link' => 'bu sayfaya',
                ],
            ],
            'me' => [
                'title' => 'ben!',
            ],
            'medals' => [
                'empty' => "Bu kullanıcı daha hiç almamış. ;_;",
                'recent' => 'En Son',
                'title' => 'Madalyalar',
            ],
            'multiplayer' => [
                'title' => 'Çok Oyunculu Oyunlar',
            ],
            'posts' => [
                'title' => 'Gönderiler',
                'title_longer' => 'Son Gönderiler',
                'show_more' => 'daha fazla gönderi gör',
            ],
            'recent_activity' => [
                'title' => 'Son',
            ],
            'top_ranks' => [
                'download_replay' => 'Tekrarı İndir',
                'not_ranked' => 'Sadece dereceli beatmapler pp verir.',
                'pp_weight' => ':percentage ağırlıklı',
                'view_details' => 'Ayrıntıları Göster',
                'title' => 'Dereceler',

                'best' => [
                    'title' => 'En İyi Performans',
                ],
                'first' => [
                    'title' => 'Birincilikler',
                ],
            ],
            'votes' => [
                'given' => 'Verilen Oylar (son 3 ayda)',
                'received' => 'Alınan Oylar (son 3 ayda)',
                'title' => 'Oylar',
                'title_longer' => 'Son Oylar',
                'vote_count' => ':count_delimited oy|:count_delimited oy',
            ],
            'account_standing' => [
                'title' => 'Hesap Durumu',
                'bad_standing' => "<strong>:username</strong> kullanıcısının hesabı iyi durumda değil :(",
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
            'location' => 'Mevcut Konum',
            'occupation' => 'Meslek',
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
            'button' => 'Profili düzenle',
            'description' => '<strong>ben!</strong>, profil sayfanızdaki kişiselleştirilebilir bir alandır.',
            'edit_big' => 'Beni düzenle!',
            'placeholder' => 'Sayfanın içeriğini buraya yaz',

            'restriction_info' => [
                '_' => 'Bu özelliğin kilidini açmak için bir :link olman lazım.',
                'link' => 'osu!supporter',
            ],
        ],
        'post_count' => [
            '_' => ':link kadar katkı',
            'count' => ':count_delimited forum gönderisi|:count_delimited forum gönderisi',
        ],
        'rank' => [
            'country' => ':mode için Ülke sıralaması',
            'country_simple' => 'Ülkesel Sıralama',
            'global' => ':mode için Dünya sıralaması',
            'global_simple' => 'Küresel Sıralama',
        ],
        'stats' => [
            'hit_accuracy' => 'Vuruş İsabeti',
            'level' => ':level Seviye',
            'level_progress' => 'Sonraki seviyeye ilerle',
            'maximum_combo' => 'Maksimum Kombo',
            'medals' => 'Madalyalar',
            'play_count' => 'Toplam Oynama Sayısı',
            'play_time' => 'Toplam Oynama Süresi',
            'ranked_score' => 'Dereceli Skor',
            'replays_watched_by_others' => 'Başkaları Tarafından İzlenen Tekrarlar',
            'score_ranks' => 'Skor Dereceleri',
            'total_hits' => 'Toplam Vuruş',
            'total_score' => 'Toplam Skor',
            // modding stats
            'graveyard_beatmapset_count' => 'Mezarlıktaki Beatmapler',
            'loved_beatmapset_count' => 'Sevilen Beatmapler',
            'pending_beatmapset_count' => 'Onay Bekleyen Beatmapler',
            'ranked_beatmapset_count' => 'Dereceli ve Onaylanmış Beatmapler',
        ],
    ],

    'silenced_banner' => [
        'title' => 'Şu anda susturulmuş durumdasınız.',
        'message' => 'Bazı eylemler kullanım dışı olabilir.',
    ],

    'status' => [
        'all' => 'Tümü',
        'online' => 'Çevrimiçi',
        'offline' => 'Çevrimdışı',
    ],
    'store' => [
        'saved' => 'Kullanıcı oluşturuldu',
    ],
    'verify' => [
        'title' => 'Hesap Doğrulama',
    ],

    'view_mode' => [
        'brick' => 'Tuğla görünümü',
        'card' => 'Kart Görünümü',
        'list' => 'Liste Görünümü',
    ],
];
