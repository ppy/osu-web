<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'event' => [
        'approve' => 'Қабылданған.',
        'beatmap_owner_change' => 'Деңгейдің иесі :beatmap пайдаланушыдан :new_user пайдаланушыға болып өзгерілді.',
        'discussion_delete' => 'Модератор :discussion пікірталасты жойды.',
        'discussion_lock' => 'Бұл карта үшін пікірталас өшірілген. (:text)',
        'discussion_post_delete' => 'Модератор :discussion пікірталаста жазбаны жойды.',
        'discussion_post_restore' => 'Модератор :discussion пікірталаста жазбаны қалпына келтірді.',
        'discussion_restore' => 'Модератор :discussion пікірталасты қалпына келтірді.',
        'discussion_unlock' => 'Бұл карта үшін пікірталас қосылған болыпты.',
        'disqualify' => ':user дисквалификация жасады. Себебі: :discussion (:text).',
        'disqualify_legacy' => ':user дисквалификация жасады. Себебі: :text.',
        'genre_edit' => 'Жанр :old-тен :new-ке өзгертілді.',
        'issue_reopen' => ':discussion_user жазған :discussion шешілген мәселені :user қайта ашты.',
        'issue_resolve' => ':discussion_user жазған :discussion мәселесі :user шешілген деп белгіледі.',
        'kudosu_allow' => ':discussion пікірталас үшін кудосу беру қабылдамауы жойылды.',
        'kudosu_deny' => ':discussion пікірталаста кудосу беруге қабылданбады.',
        'kudosu_gain' => ':user-ның :discussion пікірталасы кудосу алу үшін жеткілікті дауыс жинады.',
        'kudosu_lost' => ':user-ның :discussion пікірталаста дауыстары жоғалтылды және берілген құдосу жойылды.',
        'kudosu_recalculate' => ':discussion пікірталасың кудосу қайта есептелді.',
        'language_edit' => 'Тілі :old-тен :new-ке өзгертілді.',
        'love' => ':user пайдаланушыдан Ұнамды статусы берілді.',
        'nominate' => ':user пайдаланушыдан номинация берілді.',
        'nominate_modes' => ':user пайдаланушыдан номинация берілді (:modes).',
        'nomination_reset' => 'Жаңа мәселе :discussion (:text) номинацияны қалпына келтіруді іске қосты.',
        'nomination_reset_received' => ':user-ның номинацияны :source_user (:text) қалпына келтірді',
        'nomination_reset_received_profile' => ':user (:text) номинацияны қалпына келтірді ',
        'offset_edit' => 'Онлайн оффсет :old-тен :new-ке өзгертілді.',
        'qualify' => 'Бұл карта номинацияларының қажетті санына жетті және квалификацияға ие болды.',
        'rank' => 'Рейтингілік.',
        'remove_from_loved' => ':user Ұнамдын ішінен жойды. (:text)',
        'tags_edit' => 'Тегтер ":old"-тен ":new"-ке өзгертілді.',

        'nsfw_toggle' => [
            'to_0' => 'Былапыт тегі жойылды',
            'to_1' => 'Былапыт тегі қойылған',
        ],
    ],

    'index' => [
        'title' => 'Карты жинақтың оқиғалары',

        'form' => [
            'period' => 'Мерзім',
            'types' => 'Түрлері',
        ],
    ],

    'item' => [
        'content' => 'Мазмұны',
        'discussion_deleted' => '[deleted]',
        'type' => 'Түрі',
    ],

    'type' => [
        'approve' => 'Қабылдауы',
        'beatmap_owner_change' => 'Нәтиже иесінің өзгертуі',
        'discussion_delete' => 'Пікірталастың жоюы',
        'discussion_post_delete' => 'Пікірталас жауаптың жоюы',
        'discussion_post_restore' => 'Пікірталас жауаптың қалпына келтіруі',
        'discussion_restore' => 'Пікірталас қалпына келтіруі',
        'disqualify' => 'Дисквалификация',
        'genre_edit' => 'Жанр өзгертуі',
        'issue_reopen' => 'Пікірталас қайтадан ашылуы',
        'issue_resolve' => 'Пікірталас шешуі',
        'kudosu_allow' => 'Кудосу рұқсат беруі',
        'kudosu_deny' => 'Кудосу жою',
        'kudosu_gain' => 'Кудосу алу',
        'kudosu_lost' => 'Кудосу айырылу',
        'kudosu_recalculate' => 'Кудосу қайта есептеуі',
        'language_edit' => 'Тіл өзгертуі',
        'love' => 'Ұнамды статусын беру',
        'nominate' => 'Номинация',
        'nomination_reset' => 'Номинация арылтуы',
        'nomination_reset_received' => 'Номинация арылтуы алынды',
        'nsfw_toggle' => 'Былапыт тегі',
        'offset_edit' => 'Оффсет өзгертуі',
        'qualify' => 'Квалификация',
        'rank' => 'Рейтинг беру',
        'remove_from_loved' => 'Ұнамды статусын жоюы',
    ],
];
