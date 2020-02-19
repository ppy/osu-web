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
        'approve' => 'Одобрена.',
        'discussion_delete' => 'Модератор видалив відгук в :discussion.',
        'discussion_lock' => 'Обговорення цієї карти було відключено. (:text)',
        'discussion_post_delete' => 'Модератор вилучив публікацію з відгуку :discussion.',
        'discussion_post_restore' => 'Модератор відновив публікацію з відгуку :discussion.',
        'discussion_restore' => 'Модератор відновив відгук в :discussion.',
        'discussion_unlock' => 'Обговорення цієї карти відключено.',
        'disqualify' => 'Дискваліфіковано :user. Причина: :discussion (:text).',
        'disqualify_legacy' => 'Дискваліфіковано :user. Причина: :text.',
        'issue_reopen' => 'Проблема в :discussion знову вирішена.',
        'issue_resolve' => 'Проблема :discussion відмічена як вирішена.',
        'kudosu_allow' => 'Кудосу з відгуку :discussion були вилучені.',
        'kudosu_deny' => 'Відгуку :discussion відмовлено в отриманні кудосу.',
        'kudosu_gain' => 'Відгук в :discussion від :user отримав достатньо голосів для отримання кудосу.',
        'kudosu_lost' => 'Відгук в :discussion від :user втратило голоси і присуджені кудосу були вилучені.',
        'kudosu_recalculate' => 'Кудосу за відгук в :discussion були перераховані.',
        'love' => 'Додано :user в улюблене',
        'nominate' => 'Номіновано :user.',
        'nomination_reset' => 'Через нову проблему в :discussion (:text) статус номінації був скинутий.',
        'qualify' => 'Ця карта була номінована достатню кількість разів для кваліфікації.',
        'rank' => 'Рейтинговий.',
    ],

    'index' => [
        'title' => 'Події карти',

        'form' => [
            'period' => 'Період',
            'types' => 'Типи',
        ],
    ],

    'item' => [
        'content' => 'Контент',
        'discussion_deleted' => '[deleted]',
        'type' => 'Тип',
    ],

    'type' => [
        'approve' => 'Одобрено',
        'discussion_delete' => 'Видалення дискусії',
        'discussion_post_delete' => 'Видалення відповідей в дискусії',
        'discussion_post_restore' => 'Відновлення відповідей в дискусії',
        'discussion_restore' => 'Відновлення дискусії',
        'disqualify' => 'Дискваліфікація',
        'issue_reopen' => 'Відновлення обговорення',
        'issue_resolve' => 'Обговорення вирішення',
        'kudosu_allow' => 'Ліміт кудосу',
        'kudosu_deny' => 'Відмова в кудосу',
        'kudosu_gain' => 'Отримання кудосу',
        'kudosu_lost' => 'Втрата кудосу',
        'kudosu_recalculate' => 'Перерахунок кудосу',
        'love' => 'Любов',
        'nominate' => 'Номінація',
        'nomination_reset' => 'Скинути номінацію',
        'qualify' => 'Кваліфікація',
        'rank' => 'Рейтинг',
    ],
];
