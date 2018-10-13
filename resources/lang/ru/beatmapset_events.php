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
    'event' => [
        'approve' => 'Одобрена.',
        'discussion_delete' => 'Модератор удалил отзыв :discussion.',
        'discussion_post_delete' => 'Модератор удалил публикацию из отзыва :discussion.',
        'discussion_post_restore' => 'Модератор восстановил публикацию в отзыве :discussion.',
        'discussion_restore' => 'Модератор восстановил отзыв :discussion.',
        'disqualify' => 'Дисквалифицирована :user. Причина: :text.',
        'disqualify_legacy' => 'Дисквалифицирована :user. Причина: :text.',
        'issue_reopen' => 'Проблема в :discussion вновь решена.',
        'issue_resolve' => 'Проблема :discussion отмечена как решенная.',
        'kudosu_allow' => 'Кудосу из отзыва :discussion были удалены.',
        'kudosu_deny' => 'Отзыву :discussion отказано в кудосу.',
        'kudosu_gain' => 'Отзыву :discussion от :user получило достаточно голосов для получения кудосу.',
        'kudosu_lost' => 'Отзыву :discussion от :user потеряло голоса и присуждённые кудосу были удалены.',
        'kudosu_recalculate' => 'Кудосу за отзыв :discussion были пересчитаны.',
        'love' => 'Добавлено :user в любимое',
        'nominate' => 'Номинирована :user.',
        'nomination_reset' => 'Из-за новой проблемы в :discussion статус номинации был сброшен.',
        'qualify' => 'Эта карта была номинирована достаточное количество раз для квалификации.',
        'rank' => 'Ранкнута.',
    ],

    'index' => [
        'title' => 'События карты',
    ],

    'item' => [
        'content' => 'Контент',
        'discussion_deleted' => '[удалено]',
        'type' => 'Тип',
    ],
];
