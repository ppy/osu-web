<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'event' => [
        'approve' => 'Ухвалена.',
        'beatmap_owner_change' => 'Уладальнік цяжкасці :beatmap змяніўся на :new_user.',
        'discussion_delete' => 'Мадэратар выдаліў абмеркаванне «:discussion».',
        'discussion_lock' => 'Абмеркаванне для гэтай бітмапы было адключана. (:text)',
        'discussion_post_delete' => 'Мадэратар выдаліў допіс з абмеркавання «:discussion».',
        'discussion_post_restore' => 'Мадэратар аднавіў допіс у абмеркаванні «:discussion».',
        'discussion_restore' => 'Мадэратар аднавіў абмеркаванне «:discussion».',
        'discussion_unlock' => 'Абмеркаванне для гэтай бітмапы было ўключана.',
        'disqualify' => 'Дыскваліфікавана :user. Прычына: :discussion (:text).',
        'disqualify_legacy' => 'Дыскваліфікавана :user. Прычына: :text.',
        'genre_edit' => 'Жанр быў зменены з :old на :new.',
        'issue_reopen' => 'Праблема ў :discussion вырашана нанова.',
        'issue_resolve' => 'Праблема ў :discussion пазначана як вырашаная.',
        'kudosu_allow' => 'Кудосы з абмеркавання «:discussion» былі выдалены.',
        'kudosu_deny' => 'Абмеркаванню «:discussion» было адмоўлена ў кудосу.',
        'kudosu_gain' => 'Абмеркаванне «:discussion» карыстальніка :user атрымала дастаткова галасоў для кудосу.',
        'kudosu_lost' => 'Абмеркаванне :discussion ад :user страціла галасы і дадзены кудосу быў выдалены.',
        'kudosu_recalculate' => 'Кудосу за абмеркаванне :discussion былі пералікчаны.',
        'language_edit' => 'Мова была зменена з :old на :new.',
        'love' => 'Дададзена :user да ўлюбёных',
        'nominate' => 'Вылучына :user.',
        'nominate_modes' => 'Намiнавана :user (:modes).',
        'nomination_reset' => 'З-за новай праблемы :discussion (:text) стан намінацыі быў скінуты.',
        'nomination_reset_received' => 'Намінацыя ад :user была скідана карыстальнікам :source_user (:text)',
        'nomination_reset_received_profile' => 'Намінацыя была скінута :user (:text)',
        'qualify' => 'Гэтая бітмапа дасягнула патрабавальнай колькасці намінавання для кваліфікацыі і была кваліфікавана.',
        'rank' => 'Ранкавана.',
        'remove_from_loved' => 'Выдаленая з любімых :user. (:text)',

        'nsfw_toggle' => [
            'to_0' => 'Выдален тэг непрыстойнага зместу',
            'to_1' => 'Ёсць непрыстойный змест',
        ],
    ],

    'index' => [
        'title' => 'Падзеі бітмап',

        'form' => [
            'period' => 'Перыяд',
            'types' => 'Тыпы',
        ],
    ],

    'item' => [
        'content' => 'Змесціва',
        'discussion_deleted' => '[выдалена]',
        'type' => 'Тып',
    ],

    'type' => [
        'approve' => 'Ухвалена',
        'beatmap_owner_change' => 'Змена ўладальніка цяжкасці',
        'discussion_delete' => 'Выдаленне абмеркавання',
        'discussion_post_delete' => 'Выдаленне адказаў абмеркавання',
        'discussion_post_restore' => 'Аднаўленне адказаў абмеркавання',
        'discussion_restore' => 'Аднаўленне абмеркавання',
        'disqualify' => 'Дыскваліфікацыя',
        'genre_edit' => 'Змяніць жанр',
        'issue_reopen' => 'Пераадкрыванне абмеркавання',
        'issue_resolve' => 'Абмеркаванне рашэння',
        'kudosu_allow' => 'Ліміт Kudosu',
        'kudosu_deny' => 'Адмова ў Kudosu',
        'kudosu_gain' => 'Атрыманне Kudosu',
        'kudosu_lost' => 'Згубленне Kudosu',
        'kudosu_recalculate' => 'Пералік Kudosu',
        'language_edit' => 'Змяніць мову',
        'love' => 'Любоў',
        'nominate' => 'Намінацыя',
        'nomination_reset' => 'Скід намінацыі',
        'nomination_reset_received' => 'Скід намінацыі атрыманы',
        'nsfw_toggle' => 'Пазнака непрыстойнага зместу',
        'qualify' => 'Кваліфікацыя',
        'rank' => 'Рэйтынг',
        'remove_from_loved' => 'Выдаленне з Любімых',
    ],
];
