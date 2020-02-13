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
    'require_login' => 'Devam etmek için lütfen giriş yapın.',
    'require_verification' => 'Devam etmek için lütfen hesabınızı doğrulatınız.',
    'restricted' => "Kısıtlanmışken bunu yapamazsınız.",
    'silenced' => "Susturulmuşken bunu yapamazsınız.",
    'unauthorized' => 'Erişim engellendi.',

    'beatmap_discussion' => [
        'destroy' => [
            'is_hype' => 'Verilen gaz geri alınamaz.',
            'has_reply' => 'Cevaplara sahip tartışmalar silinemez',
        ],
        'nominate' => [
            'exhausted' => 'Bugünkü aday gösterme sınırınıza ulaştınız, lütfen yarın tekrar deneyin.',
            'full_bn_required' => 'Bu niteleme oylamasını yapmak için tam bir nominatör olmanız gerekmektedir.',
            'full_bn_required_hybrid' => 'Birden fazla oyun modu olan beatmap setlerini oylamak için tam bir nominatör olmanız gerekmektedir.',
            'incorrect_state' => 'Bu işlemi gerçekleştirirken hata oluştu, sayfayı yenilemeyi deneyin.',
            'owner' => "Kendi beatmapinizi aday gösteremezsiniz.",
        ],
        'resolve' => [
            'not_owner' => 'Yalnızca başlık sahibi ile beatmap sahibi bir tartışmayı sonlandırabilir.',
        ],

        'store' => [
            'mapper_note_wrong_user' => 'Sadece beatmap sahibi ya da nominatör/QAT grup üyesi mapper notu gönderebilir.',
        ],

        'vote' => [
            'limit_exceeded' => 'Lütfen daha fazla oy vermeden önce bir süre bekleyin',
            'owner' => "Kendi tartışmanıza oy veremezsiniz.",
            'wrong_beatmapset_state' => 'Yalnızca beklemede olan beatmaplerin tartışmalarında oy kullanabilirsiniz.',
        ],
    ],

    'beatmap_discussion_post' => [
        'destroy' => [
            'not_owner' => 'Sadece kendi paylaşımlarını silebilirsin.',
            'resolved' => 'Çözümlenmiş bir tartışmanın paylaşımını silinemez.',
            'system_generated' => 'Otomatikman oluşan paylaşımlar silinemez.',
        ],

        'edit' => [
            'not_owner' => 'Gönderileri yalnızca gönderen düzenleyebilir.',
            'resolved' => 'Çözümlenmiş bir tartışmanın paylaşımını değiştirilemez.',
            'system_generated' => 'Otomatik olarak oluşturulmuş gönderiler düzenlenemez.',
        ],

        'store' => [
            'beatmapset_locked' => 'Bu beatmap tartışma için kilitlenmiş.',
        ],
    ],

    'chat' => [
        'blocked' => 'Sizi engelleyen ya da sizin engellediğiniz bir kullanıcıya mesaj gönderemezsiniz.',
        'friends_only' => 'Kullanıcı kendi arkadaş listede bulunmayan kişilerden gelen mesajları engelliyor.',
        'moderated' => 'Kanal şu anda denetleniyor.',
        'no_access' => 'Bu kanala erişiminiz yok.',
        'restricted' => 'Susturulmuş, kısıtlanmış ya da banlanmış iken mesaj gönderemezsiniz.',
    ],

    'comment' => [
        'update' => [
            'deleted' => "Silinmiş gönderi düzenlenemez.",
        ],
    ],

    'contest' => [
        'voting_over' => 'Yarışma için oylama süresi bittikten sonra oyunuzu değiştiremezsiniz.',
    ],

    'forum' => [
        'moderate' => [
            'no_permission' => 'Bu forumu yönetme izniniz yok.',
        ],

        'post' => [
            'delete' => [
                'only_last_post' => 'Yalnızca son gönderi silinebilir.',
                'locked' => 'Kilitli bir konunun gönderisini silemezsiniz.',
                'no_forum_access' => 'İstenilen foruma erişim gereklidir.',
                'not_owner' => 'Gönderi yalnızca gönderen tarafından silinebilir.',
            ],

            'edit' => [
                'deleted' => 'Silinmiş gönderi düzenlenemez.',
                'locked' => 'Bu gönderi için düzenleme yasaklanmıştır.',
                'no_forum_access' => 'İstenilen foruma erişim gereklidir.',
                'not_owner' => 'Gönderi yalnızca gönderen tarafından düzenlenebilir.',
                'topic_locked' => 'Kilitli bir konunun gönderisini düzenleyemezsiniz.',
            ],

            'store' => [
                'play_more' => 'Lütfen forumlara başlık açmadan önce oyunu oynamayı deneyin! Eğer oynamakla ilgili bir sorununuz varsa, Help and Support forumuna başlık açın.',
                'too_many_help_posts' => "Başka başlıklar açmadan önce oyunu daha fazla oynamalısınız. Eğer hala oyunu oynamakta sorun yaşıyorsanız, support@ppy.sh adresine e-posta atın", // FIXME: unhardcode email address.
            ],
        ],

        'topic' => [
            'reply' => [
                'double_post' => 'Lütfen yeni gönderi yerine son gönderinizi düzenleyin.',
                'locked' => 'Kilitli bir başlığa cevap yazamazsınız.',
                'no_forum_access' => 'İstenilen foruma erişim gereklidir.',
                'no_permission' => 'Cevaplama izni yok.',

                'user' => [
                    'require_login' => 'Cevaplamak için lütfen giriş yapın.',
                    'restricted' => "Kısıtlanmışken cevap yazamazsınız.",
                    'silenced' => "Susturulmuşken cevap yazamazsınız.",
                ],
            ],

            'store' => [
                'no_forum_access' => 'İstenilen foruma erişim gereklidir.',
                'no_permission' => 'Yeni başlık açmak için izniniz yok.',
                'forum_closed' => 'Forum kapalıdır ve gönderi yapılamaz.',
            ],

            'vote' => [
                'no_forum_access' => 'İstenilen foruma erişim gereklidir.',
                'over' => 'Oylama bitti ve artık oy verilemez.',
                'play_more' => 'Forumda oylama yapmadan önce daha çok oynamanız gerekmektedir.',
                'voted' => 'Oy değiştirmek yasaktır.',

                'user' => [
                    'require_login' => 'Oy vermek için lütfen giriş yapın.',
                    'restricted' => "Kısıtlanmışken oy veremezsiniz.",
                    'silenced' => "Susturulmuşken oy veremezsiniz.",
                ],
            ],

            'watch' => [
                'no_forum_access' => 'İstenilen foruma erişim gereklidir.',
            ],
        ],

        'topic_cover' => [
            'edit' => [
                'uneditable' => 'Geçersiz kapak belirtildi.',
                'not_owner' => 'Yalnızca başlık sahibi kapağı değiştirebilir.',
            ],
            'store' => [
                'forum_not_allowed' => 'Bu forum konu kapak fotoğrafları kabul etmemektedir.',
            ],
        ],

        'view' => [
            'admin_only' => 'Yalnızca yönetici bu forumu görüntüleyebilir.',
        ],
    ],

    'user' => [
        'page' => [
            'edit' => [
                'locked' => 'Kullanıcı sayfası kilitli.',
                'not_owner' => 'Yalnızca kendi kullanıcı sayfanızı düzenleyebilirsiniz.',
                'require_supporter_tag' => 'osu!supporter etiketi gereklidir.',
            ],
        ],
    ],
];
