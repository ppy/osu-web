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
    'event' => [
        'approve' => 'Ухвалена.',
        'discussion_delete' => 'Мадэратар выдаліў абмеркаванне «:discussion».',
        'discussion_lock' => 'Абмеркаванне для гэтай бітмапы было адключана. (:text)',
        'discussion_post_delete' => 'Мадэратар выдаліў допіс з абмеркавання «:discussion».',
        'discussion_post_restore' => 'Мадэратар аднавіў допіс у абмеркаванні «:discussion».',
        'discussion_restore' => 'Мадэратар аднавіў абмеркаванне «:discussion».',
        'discussion_unlock' => 'Абмеркаванне для гэтай бітмапы было ўключана.',
        'disqualify' => 'Дыскваліфікавана :user. Прычына: :discussion (:text).',
        'disqualify_legacy' => 'Дыскваліфікавана :user. Прычына: :text.',
        'issue_reopen' => 'Праблема ў :discussion вырашана нанова.',
        'issue_resolve' => 'Праблема ў :discussion пазначана як вырашаная.',
        'kudosu_allow' => 'Кудосы з абмеркавання «:discussion» былі выдалены.',
        'kudosu_deny' => 'Абмеркаванню «:discussion» было адмоўлена ў кудосу.',
        'kudosu_gain' => 'Абмеркаванне «:discussion» карыстальніка :user атрымала дастаткова галасоў для кудосу.',
        'kudosu_lost' => 'Абмеркаванне :discussion ад :user страціла галасы і дадзены кудосу быў выдалены.',
        'kudosu_recalculate' => 'Кудосу за абмеркаванне :discussion былі пералікчаны.',
        'love' => 'Дададзена :user да ўлюбёных',
        'nominate' => 'Вылучына :user.',
        'nomination_reset' => 'З-за новай праблемы :discussion (:text) стан намінацыі быў скінуты.',
        'qualify' => 'Гэтая бітмапа дасягнула патрабавальнай колькасці намінавання для кваліфікацыі і была кваліфікавана.',
        'rank' => 'Ранкавана.',
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
        'discussion_delete' => 'Выдаленне абмеркавання',
        'discussion_post_delete' => 'Выдаленне адказаў абмеркавання',
        'discussion_post_restore' => 'Аднаўленне адказаў абмеркавання',
        'discussion_restore' => 'Аднаўленне абмеркавання',
        'disqualify' => 'Дыскваліфікацыя',
        'issue_reopen' => 'Пераадкрыванне абмеркавання',
        'issue_resolve' => 'Абмеркаванне рашэння',
        'kudosu_allow' => 'Ліміт Kudosu',
        'kudosu_deny' => 'Адмова ў Kudosu',
        'kudosu_gain' => 'Атрыманне Kudosu',
        'kudosu_lost' => 'Згубленне Kudosu',
        'kudosu_recalculate' => 'Пералік Kudosu',
        'love' => 'Любоў',
        'nominate' => 'Намінацыя',
        'nomination_reset' => 'Скід намінацыі',
        'qualify' => 'Кваліфікацыя',
        'rank' => 'Рэйтынг',
    ],
];
