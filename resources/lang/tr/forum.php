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
    'pinned_topics' => 'Sabitlenmiş Konular',
    'slogan' => "yalnız başına oynamak tehlikeli.",
    'subforums' => 'Alt Başlıklar',
    'title' => 'osu! forumları',

    'covers' => [
        'create' => [
            '_' => 'Kapak fotoğrafı ekle',
            'button' => 'Resim yükle',
            'info' => 'Kapak boyutları :dimensions olmalıdır. Görselleri yüklemek için buraya da sürükleyebilirsin.',
        ],

        'destroy' => [
            '_' => 'Kapak resmini kaldır',
            'confirm' => 'Kapak resmini kaldırmak istediğinden emin misin?',
        ],
    ],

    'email' => [
        'new_reply' => '[osu!] ":title" başlığına yeni cevap',
    ],

    'forums' => [
        'topics' => [
            'empty' => 'Başlık yok!',
        ],
    ],

    'post' => [
        'confirm_destroy' => 'Gerçekten gönderiyi silmek istiyor musun?',
        'confirm_restore' => 'Gönderiyi geri yükle?',
        'edited' => 'En son :user tarafından :when, toplamda :count defa düzenlendi.',
        'posted_at' => ':when gönderildi',

        'actions' => [
            'destroy' => 'Gönderiyi sil',
            'restore' => 'Gönderiyi geri getir',
            'edit' => 'Gönderiyi düzenle',
        ],
    ],

    'search' => [
        'go_to_post' => 'Gönderiye git',
        'post_number_input' => 'gönderi numarasını girin',
        'total_posts' => 'toplamda :posts_count gönderi',
    ],

    'topic' => [
        'deleted' => 'silinmiş konu',
        'go_to_latest' => 'son yazılan mesajı göster',
        'latest_post' => ':user tarafından :when',
        'latest_reply_by' => 'son cevap :user tarafından',
        'new_topic' => 'Yeni konu aç',
        'new_topic_login' => 'Yeni konu başlatmak için giriş yapın',
        'post_reply' => 'Gönder',
        'reply_box_placeholder' => 'Yanıtlamak için buraya yazın',
        'reply_title_prefix' => 'Ynt',
        'started_by' => ':user tarafından',
        'started_by_verbose' => ':user tarafından başlatıldı',

        'create' => [
            'preview' => 'Ön izleme ',
            // TL note: this is used in the topic reply preview, when
            // the user goes back from previewing to editing the reply
            'preview_hide' => 'Yaz',
            'submit' => 'Gönder',

            'necropost' => [
                'default' => 'Bu konu bir süredir inaktif. Sadece mantıklı bir nedeniniz varsa buraya gönderi yapın.',

                'new_topic' => [
                    '_' => "Bu konu bir süredir inaktif. Eğer buraya gönderi yapmak için mantıklı bir nedeniniz yoksa, :create lütfen.",
                    'create' => 'yeni bir konu aç',
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
            'title' => 'Forum Abonelikleri',
            'title_compact' => 'forum abonelikleri',
            'title_main' => 'Forum <strong>Abonelikleri</strong>',

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
            'login_reply' => 'Cevaplamak için giriş yap',
            'reply' => 'Yanıtla',
            'reply_with_quote' => 'Alıntı yaparak cevap ver',
            'search' => 'Ara',
        ],

        'create' => [
            'create_poll' => 'Anket oluşturma',

            'create_poll_button' => [
                'add' => 'Anket oluştur',
                'remove' => 'Anket oluşturmayı iptal et',
            ],

            'poll' => [
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
            'views' => 'görülme',
            'replies' => 'yanıt',
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
            'to_0_done' => 'Konu kilidi açıldı',
            'to_1' => 'Konuyu kilitle',
            'to_1_done' => 'Konu kilitlendi',
        ],

        'moderate_move' => [
            'title' => 'Başka bir foruma taşı',
        ],

        'moderate_pin' => [
            'to_0' => 'Başlığı sabitleme',
            'to_0_done' => 'Başlık artık sabitli değil',
            'to_1' => 'Başlığı sabitle',
            'to_1_done' => 'Başlık sabitlendi',
            'to_2' => 'Başlığı sabitle ve duyuru olarak işaretle',
            'to_2_done' => 'Başlık sabitlendi ve duyuru olarak işaretlendi',
        ],

        'show' => [
            'deleted-posts' => 'Silinmiş mesajlar',
            'total_posts' => 'Toplam Mesaj',

            'feature_vote' => [
                'current' => 'Mevcut Öncelik: +:count',
                'do' => 'Bu isteği destekle',

                'user' => [
                    'count' => '{0} oy yok|{1} :count oy|[2,*] :count oy',
                    'current' => ':votes oyunuz var.',
                    'not_enough' => "Başka oyunuz kalmadı",
                ],
            ],

            'poll' => [
                'vote' => 'Oyla',

                'detail' => [
                    'end_time' => 'Anket :time tarihinde bitecek',
                    'ended' => 'Anket :time tarihinde bitti',
                    'total' => 'Toplam oy: :count',
                ],
            ],
        ],

        'watch' => [
            'to_not_watching' => 'Kayıtlı değil',
            'to_watching' => 'Kaydet',
            'to_watching_mail' => 'Bildirimlerle beraber kaydet',
            'mail_disable' => 'Bildirimleri devre dışı bırak',
        ],
    ],
];
