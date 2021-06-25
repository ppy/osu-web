<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'event' => [
        'approve' => 'Одобрена.',
        'beatmap_owner_change' => 'Владелец сложности :beatmap изменен на :new_user.',
        'discussion_delete' => 'Модератор удалил отзыв :discussion.',
        'discussion_lock' => 'Обсуждение для этой карты было отключено. (:text)',
        'discussion_post_delete' => 'Модератор удалил публикацию из отзыва :discussion.',
        'discussion_post_restore' => 'Модератор восстановил публикацию в отзыве :discussion.',
        'discussion_restore' => 'Модератор восстановил отзыв :discussion.',
        'discussion_unlock' => 'Обсуждение для этой карты было включено.',
        'disqualify' => 'Дисквалифицирована :user. Причина: :text.',
        'disqualify_legacy' => 'Дисквалифицирована :user. Причина: :text.',
        'genre_edit' => 'Жанр изменен с :old на :new.',
        'issue_reopen' => 'Проблема в :discussion вновь решена.',
        'issue_resolve' => 'Проблема :discussion отмечена как решенная.',
        'kudosu_allow' => 'Кудосу из отзыва :discussion были удалены.',
        'kudosu_deny' => 'Отзыву :discussion отказано в кудосу.',
        'kudosu_gain' => 'Отзыв :discussion от :user получил достаточно голосов для получения кудосу.',
        'kudosu_lost' => 'Отзыв :discussion от :user потерял голоса и присуждённые кудосу были удалены.',
        'kudosu_recalculate' => 'Кудосу за отзыв :discussion были пересчитаны.',
        'language_edit' => 'Язык изменен с :old на :new.',
        'love' => 'Добавлено :user в любимое',
        'nominate' => 'Номинирована :user.',
        'nominate_modes' => 'Номинатор: :user (:modes).',
        'nomination_reset' => 'Из-за новой проблемы в :discussion статус номинации был сброшен.',
        'qualify' => 'Эта карта была номинирована достаточное количество раз для квалификации.',
        'rank' => 'Рейтинговая.',
        'remove_from_loved' => ':user удалил карту из Любимых (:text)',

        'nsfw_toggle' => [
            'to_0' => 'Удалить отметку 18+',
            'to_1' => 'Помечено как откровенное',
        ],
    ],

    'index' => [
        'title' => 'События карты',

        'form' => [
            'period' => 'Период',
            'types' => 'Типы',
        ],
    ],

    'item' => [
        'content' => 'Контент',
        'discussion_deleted' => '[удалено]',
        'type' => 'Тип',
    ],

    'type' => [
        'approve' => 'Одобрено',
        'beatmap_owner_change' => 'Сменить владельца сложности',
        'discussion_delete' => 'Удаление обсуждения',
        'discussion_post_delete' => 'Удаление ответов в обсуждении',
        'discussion_post_restore' => 'Восстановление ответов в обсуждении',
        'discussion_restore' => 'Восстановление обсуждения',
        'disqualify' => 'Дисквалификация',
        'genre_edit' => 'Изменение жанра',
        'issue_reopen' => 'Возобновление обсуждения',
        'issue_resolve' => 'Обсуждение решения',
        'kudosu_allow' => 'Квота Kudosu',
        'kudosu_deny' => 'Отказ в Kudosu',
        'kudosu_gain' => 'Получение Kudosu',
        'kudosu_lost' => 'Потеря Kudosu',
        'kudosu_recalculate' => 'Перерасчет Kudosu',
        'language_edit' => 'Изменение языка',
        'love' => 'Любовь',
        'nominate' => 'Номинация',
        'nomination_reset' => 'Сброс номинации',
        'nsfw_toggle' => 'Контент 18+',
        'qualify' => 'Квалификация',
        'rank' => 'Рейтинг',
        'remove_from_loved' => 'Удаление из Любимых',
    ],
];
