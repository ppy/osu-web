<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'event' => [
        'approve' => 'Карта получила категорию Одобрена.',
        'beatmap_owner_change' => 'Владелец сложности :beatmap изменен на :new_user.',
        'discussion_delete' => 'Модератор удалил отзыв :discussion.',
        'discussion_lock' => 'Обсуждение для этой карты было отключено. (:text)',
        'discussion_post_delete' => 'Модератор удалил пост к отзыву :discussion.',
        'discussion_post_restore' => 'Модератор восстановил пост в обсуждении :discussion.',
        'discussion_restore' => 'Модератор восстановил отзыв :discussion.',
        'discussion_unlock' => 'Обсуждение для этой карты было включено.',
        'disqualify' => 'Дисквалифицирована :user. Причина: :discussion (:text).',
        'disqualify_legacy' => 'Дисквалифицирована :user. Причина: :text.',
        'genre_edit' => 'Жанр изменен с :old на :new.',
        'issue_reopen' => 'Проблема :discussion, которая была решена пользователем :discussion_user, вновь открыта :user.',
        'issue_resolve' => 'Проблема :discussion, открытая :discussion_user, решена :user.',
        'kudosu_allow' => 'Отказ в кудосу :discussion был удален.',
        'kudosu_deny' => 'Отзыву :discussion отказано в кудосу.',
        'kudosu_gain' => 'Отзыв :discussion от :user получил достаточно голосов для получения кудосу.',
        'kudosu_lost' => 'Отзыв :discussion от :user потерял голоса и присуждённые кудосу были удалены.',
        'kudosu_recalculate' => 'Кудосу за отзыв :discussion были пересчитаны.',
        'language_edit' => 'Язык изменен с :old на :new.',
        'love' => 'Карта получила категорию Любимая. (:user)',
        'nominate' => 'Номинирована :user.',
        'nominate_modes' => 'Карта получила номинацию от :user (:modes).',
        'nomination_reset' => 'Из-за новой проблемы в :discussion (:text) статус номинации был сброшен.',
        'nomination_reset_received' => 'Номинация пользователя :user была сброшена :source_user (:text)',
        'nomination_reset_received_profile' => 'Номинация была сброшена :user (:text)',
        'offset_edit' => 'Значение сдвига карты изменёно с :old на :new.',
        'qualify' => 'Эта карта была номинирована достаточное количество раз для квалификации.',
        'rank' => 'Карта получила категорию Рейтинговая.',
        'remove_from_loved' => ':user удалил карту из категории Любимая. (:text)',

        'nsfw_toggle' => [
            'to_0' => 'Снята отметка 18+',
            'to_1' => ':user поставил отметку 18+',
        ],
    ],

    'index' => [
        'title' => 'События карты',

        'form' => [
            'period' => 'Период',
            'types' => 'Типы событий',
        ],
    ],

    'item' => [
        'content' => 'Контент',
        'discussion_deleted' => '[удалено]',
        'type' => 'Тип',
    ],

    'type' => [
        'approve' => 'Одобрено',
        'beatmap_owner_change' => 'Смена владельца сложности',
        'discussion_delete' => 'Удаление обсуждения',
        'discussion_post_delete' => 'Удаление ответов в обсуждении',
        'discussion_post_restore' => 'Восстановление ответов в обсуждении',
        'discussion_restore' => 'Восстановление обсуждения',
        'disqualify' => 'Дисквалификация',
        'genre_edit' => 'Изменение жанра',
        'issue_reopen' => 'Возобновление обсуждения',
        'issue_resolve' => 'Решение проблем',
        'kudosu_allow' => 'Квота кудосу',
        'kudosu_deny' => 'Отказ в кудосу',
        'kudosu_gain' => 'Получение кудосу',
        'kudosu_lost' => 'Потеря кудосу',
        'kudosu_recalculate' => 'Перерасчет кудосу',
        'language_edit' => 'Изменение языка',
        'love' => 'Квалификация в Любимые',
        'nominate' => 'Номинация',
        'nomination_reset' => 'Сброс номинации',
        'nomination_reset_received' => 'Получен сброс номинации',
        'nsfw_toggle' => 'Поставлена отметка 18+',
        'offset_edit' => 'Изменение сдвига трека относительно карты',
        'qualify' => 'Квалификация',
        'rank' => 'Рейтинг',
        'remove_from_loved' => 'Удаление из Любимых',
    ],
];
