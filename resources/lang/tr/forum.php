<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'pinned_topics' => 'Sabitlenmiş Konular',
    'slogan' => "yalnız başına oynamak tehlikeli.",
    'subforums' => 'Alt forumlar',
    'title' => 'osu! forumları',

    'covers' => [
        'edit' => 'Kapak resmini düzenle',

        'create' => [
            '_' => 'Kapak resmi ekle',
            'button' => 'Kapak resmi yükle',
            'info' => 'Kapak boyutları :dimensions olmalıdır. Görselleri yüklemek için buraya da sürükleyebilirsin.',
        ],

        'destroy' => [
            '_' => 'Kapak resmini kaldır',
            'confirm' => 'Kapak resmini kaldırmak istediğinden emin misin?',
        ],
    ],

    'forums' => [
        'latest_post' => 'Son Gönderi',

        'index' => [
            'title' => 'Forum Ana Sayfası',
        ],

        'topics' => [
            'empty' => 'Konu yok!',
        ],
    ],

    'mark_as_read' => [
        'forum' => 'Forumu okundu olarak işaretle',
        'forums' => 'Forumları okundu olarak işaretle',
        'busy' => 'Okundu olarak işaretleniyor...',
    ],

    'post' => [
        'confirm_destroy' => 'Gerçekten gönderiyi silmek istiyor musun?',
        'confirm_restore' => 'Gönderiyi geri yükle?',
        'edited' => 'En son :user tarafından :when, toplamda :count_delimited defa düzenlendi.|En son :user tarafından :when, toplamda :count_delimited defa düzenlendi.',
        'posted_at' => ':when gönderildi',
        'posted_by' => ':username tarafından gönderildi',

        'actions' => [
            'destroy' => 'Gönderiyi sil',
            'edit' => 'Gönderiyi düzenle',
            'report' => 'Gönderiyi bildir',
            'restore' => 'Gönderiyi geri getir',
        ],

        'create' => [
            'title' => [
                'reply' => 'Yeni yanıt',
            ],
        ],

        'info' => [
            'post_count' => ':count_delimited gönderi|:count_delimited gönderi',
            'topic_starter' => 'Konuyu Başlatan',
        ],
    ],

    'search' => [
        'go_to_post' => 'Gönderiye git',
        'post_number_input' => 'gönderi numarasını girin',
        'total_posts' => 'toplamda :posts_count gönderi',
    ],

    'topic' => [
        'confirm_destroy' => 'Konu gerçekten silinsin mi?',
        'confirm_restore' => 'Konu gerçekten geri yüklensin mi?',
        'deleted' => 'silinmiş konu',
        'go_to_latest' => 'son gönderiyi görüntüle',
        'has_replied' => 'Bu konuyu yanıtladınız',
        'in_forum' => ':forum forumunda',
        'latest_post' => ':user tarafından :when',
        'latest_reply_by' => 'son yanıt :user tarafından',
        'new_topic' => 'Yeni konu aç',
        'new_topic_login' => 'Yeni konu başlatmak için giriş yapın',
        'post_reply' => 'Gönder',
        'reply_box_placeholder' => 'Yanıtlamak için buraya yazın',
        'reply_title_prefix' => 'Ynt',
        'started_by' => ':user tarafından',
        'started_by_verbose' => ':user tarafından başlatıldı',

        'actions' => [
            'destroy' => 'Konuyu sil',
            'restore' => 'Konuyu geri yükle',
        ],

        'create' => [
            'close' => 'Kapat',
            'preview' => 'Önizleme ',
            // TL note: this is used in the topic reply preview, when
            // the user goes back from previewing to editing the reply
            'preview_hide' => 'Yaz',
            'submit' => 'Gönder',

            'necropost' => [
                'default' => 'Bu konu uzun bir süredir inaktif. Yalnızca geçerli bir nedeniniz varsa bir gönderi oluşturun.',

                'new_topic' => [
                    '_' => "Bu konu uzun bir süredir inaktif. Eğer burada gönderi oluşturmak için mantıklı bir nedeniniz yoksa, bunun yerine lütfen :create.",
                    'create' => 'yeni bir konu açın',
                ],
            ],

            'placeholder' => [
                'body' => 'Gönderi içeriğini buraya yaz',
                'title' => 'Başlık eklemek için buraya tıkla',
            ],
        ],

        'jump' => [
            'enter' => 'spesifik bir gönderi numarası girmek için tıklayınız',
            'first' => 'ilk gönderiye git',
            'last' => 'son gönderiye git',
            'next' => 'sonraki 10 gönderiyi es geç',
            'previous' => '10 gönderi geriye git',
        ],

        'post_edit' => [
            'cancel' => 'İptal',
            'post' => 'Kaydet',
        ],
    ],

    'topic_watches' => [
        'index' => [
            'title_compact' => 'forum abonelikleri',

            'box' => [
                'total' => 'Abone olunan konular',
                'unread' => 'Yeni yorumlar içeren konular',
            ],

            'info' => [
                'total' => ':total konularına abone oldunuz.',
                'unread' => 'Abone olduğunuz konulara :unread tane okunmamış yanıt bulunmaktadır.',
            ],
        ],

        'topic_buttons' => [
            'remove' => [
                'confirmation' => 'Konuyu aboneliklerinden çıkar?',
                'title' => 'Abonelikten çık',
            ],
        ],
    ],

    'topics' => [
        '_' => 'Konular',

        'actions' => [
            'login_reply' => 'Yanıtlamak için giriş yap',
            'reply' => 'Yanıtla',
            'reply_with_quote' => 'Yanıtlamak için alıntıla',
            'search' => 'Ara',
        ],

        'create' => [
            'create_poll' => 'Anket Oluşturma',

            'preview' => 'Gönderi Önizleme',

            'create_poll_button' => [
                'add' => 'Anket oluştur',
                'remove' => 'Anket oluşturmayı iptal et',
            ],

            'poll' => [
                'hide_results' => 'Anket sonuçlarını gizle.',
                'hide_results_info' => 'Sadece anket sonuçlandıktan sonra gösterilecekler.',
                'length' => 'Şu süreyle anketi sürdür',
                'length_days_suffix' => 'gün',
                'length_info' => 'Hiç bitmeyen bir anket için boş bırakın',
                'max_options' => 'Kullanıcı başına seçim',
                'max_options_info' => 'Her kullanıcının oylama sırasında seçebileceği seçenek sayısıdır.',
                'options' => 'Seçenekler',
                'options_info' => 'Her bir seçeneği yeni bir satıra yazın. 10 taneye kadar seçenek yazabilirsiniz.',
                'title' => 'Soru',
                'vote_change' => 'Yeniden oylamaya izin ver.',
                'vote_change_info' => 'Etkinleştirilirse, kullanıcılar oylarını değiştirebilme yetisine sahip olurlar.',
            ],
        ],

        'edit_title' => [
            'start' => 'Başlığı düzenle',
        ],

        'index' => [
            'feature_votes' => 'yıldız öncelik',
            'replies' => 'yanıt',
            'views' => 'görülme',
        ],

        'issue_tag_added' => [
            'to_0' => '"eklendi" etiketini kaldır',
            'to_0_done' => '"eklendi" etiketi kaldırıldı',
            'to_1' => '"eklendi" etiketini ekle',
            'to_1_done' => '"eklendi" etiketi eklendi',
        ],

        'issue_tag_assigned' => [
            'to_0' => '"atandı" etiketini kaldır',
            'to_0_done' => '"atandı" etiketi kaldırıldı',
            'to_1' => '"atandı" etiketini ekle',
            'to_1_done' => '"atandı" etiketi eklendi',
        ],

        'issue_tag_confirmed' => [
            'to_0' => '"Onaylandı" etiketini kaldır',
            'to_0_done' => '"Onaylandı" etiketi kaldırıldı',
            'to_1' => '"Onaylandı" etiketi koy',
            'to_1_done' => '"Onaylandı" etiketi koyuldu',
        ],

        'issue_tag_duplicate' => [
            'to_0' => '"kopya" etiketini kaldır',
            'to_0_done' => '"kopya" etiketi kaldırıldı',
            'to_1' => '"kopya" etiketi ekle',
            'to_1_done' => '"kopya" etiketi eklendi',
        ],

        'issue_tag_invalid' => [
            'to_0' => '"geçersiz" etiketini kaldır',
            'to_0_done' => '"geçersiz" etiketi kaldırıldı',
            'to_1' => '"geçersiz" etiketi ekle',
            'to_1_done' => '"geçersiz" etiketi eklendi',
        ],

        'issue_tag_resolved' => [
            'to_0' => '"çözüldü" etiketini kaldır',
            'to_0_done' => '"çözüldü" etiketi kaldırıldı',
            'to_1' => '"çözüldü" etiketi ekle',
            'to_1_done' => '"çözüldü" etiketi eklendi',
        ],

        'lock' => [
            'is_locked' => 'Bu konu kilitli ve yanıtlanamaz',
            'to_0' => 'Konu kilidini aç',
            'to_0_confirm' => 'Konunun kilidini aç?',
            'to_0_done' => 'Konu kilidi açıldı',
            'to_1' => 'Konuyu kilitle',
            'to_1_confirm' => 'Konuyu kilitle?',
            'to_1_done' => 'Konu kilitlendi',
        ],

        'moderate_move' => [
            'title' => 'Başka bir foruma taşı',
        ],

        'moderate_pin' => [
            'to_0' => 'Başlığı sabitleme',
            'to_0_confirm' => 'Konuyu sabitlemeden kaldır?',
            'to_0_done' => 'Başlık artık sabitli değil',
            'to_1' => 'Başlığı sabitle',
            'to_1_confirm' => 'Konuyu sabitle?',
            'to_1_done' => 'Başlık sabitlendi',
            'to_2' => 'Başlığı sabitle ve duyuru olarak işaretle',
            'to_2_confirm' => 'Konuyu sabitle ve duyuru olarak işaretle?',
            'to_2_done' => 'Başlık sabitlendi ve duyuru olarak işaretlendi',
        ],

        'moderate_toggle_deleted' => [
            'show' => 'Silinmiş gönderileri göster',
            'hide' => 'Silinmiş gönderileri gizle',
        ],

        'show' => [
            'deleted-posts' => 'Silinmiş mesajlar',
            'total_posts' => 'Toplam Mesaj',

            'feature_vote' => [
                'current' => 'Mevcut Öncelik: +:count',
                'do' => 'Bu talebi destekle',

                'info' => [
                    '_' => 'Bu bir :feature_request. Özellik talepleri :supporters tarafından oylanabilir.',
                    'feature_request' => 'özellik talebidir',
                    'supporters' => 'supporter\'lar',
                ],

                'user' => [
                    'count' => '{0} oy yok|{1} :count_delimited oy|[2,*] :count_delimited oy',
                    'current' => ':votes oyunuz var.',
                    'not_enough' => "Başka oyunuz kalmadı",
                ],
            ],

            'poll' => [
                'edit' => 'Anket Düzenleme',
                'edit_warning' => 'Bir anketi düzenlemek mevcut sonuçlarını siler!',
                'vote' => 'Oyla',

                'button' => [
                    'change_vote' => 'Oyu değiştir',
                    'edit' => 'Anketi düzenle',
                    'view_results' => 'Sonuçlara geç',
                    'vote' => 'Oy ver',
                ],

                'detail' => [
                    'end_time' => 'Anket :time tarihinde bitecek',
                    'ended' => 'Anket :time tarihinde bitti',
                    'results_hidden' => 'Sonuçlar anket bittikten sonra gösterilecek.',
                    'total' => 'Toplam oy: :count',
                ],
            ],
        ],

        'watch' => [
            'to_not_watching' => 'Kayıtlı değil',
            'to_watching' => 'Kaydet',
            'to_watching_mail' => 'Bildirimlerle beraber kaydet',
            'tooltip_mail_disable' => 'Bildirim etkin. Devre dışı bırakmak için tıklayın',
            'tooltip_mail_enable' => 'Bildirim devre dışı. Etkinleştirmek için tıklayın',
        ],
    ],
];
