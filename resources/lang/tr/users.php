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
        'warning' => "",

        'if_mistake' => [
            '_' => '',
            'email' => 'e-posta',
        ],

        'reasons' => [
            'compromised' => '',
            'opening' => 'Hesabını dondurmaya sebebiyet verebilecek birtakım sebepler var:',

            'tos' => [
                '_' => 'Siz, :community_rules ya da :tos kurallarından bir veya daha fazlasını ihlal ettiniz.',
                'community_rules' => 'topluluk kuralları',
                'tos' => 'hizmet kullanım şartları',
            ],
        ],
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
                    'size_info' => 'Kapak boyutu 2800x620 olmalı',
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
                'none' => 'Hiç yok... şimdilik.',
                'title' => 'Beatmapler',

                'favourite' => [
                    'title' => 'Favori Beatmapler',
                ],
                'graveyard' => [
                    'title' => 'Terk Edilmiş Beatmapler',
                ],
                'loved' => [
                    'title' => 'Sevilen Beatmapler',
                ],
                'ranked_and_approved' => [
                    'title' => 'Dereceli & Onaylanmış Beatmapler',
                ],
                'unranked' => [
                    'title' => 'Onay Beklenen Beatmapler',
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
                'empty' => 'Performans kaydı yok. :(',
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
                'available' => 'Mevcut Kudosu',
                'available_info' => "Kudosu'larınızı yaptığınız beatmapler'in daha çok dikkat çekmesi için kullanabilirsiniz. Bu sayı, henüz kullanmadığınız kudosu'ların sayısını gösterir.",
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
                    '_' => 'Beatmap yönetiminine kullanıcının ne kadar çok katkı yapmış olmuşluğuna dayanarak. Daha fazla bilgi için :link\'e bakınız.',
                    'link' => 'bu sayfa',
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
                'empty' => 'Henüz kayda değer bir performans kaydı yok. :(',
                'not_ranked' => 'Sadece dereceli beatmapler pp verir.',
                'pp_weight' => 'ağırlıklı: yüzde',
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
            'count' => ':count forum gönderisi|:count forum gönderisi',
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
            'ranked_and_approved_beatmapset_count' => 'Dereceli ve Onaylanmış Beatmapler',
            'loved_beatmapset_count' => 'Sevilen Beatmapler',
            'unranked_beatmapset_count' => 'Onay Bekleyen Beatmapler',
            'graveyard_beatmapset_count' => 'Terk Edilmiş Beatmapler',
        ],
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
        'card' => 'Kart Görünümü',
        'list' => 'Liste Görünümü',
    ],
];
