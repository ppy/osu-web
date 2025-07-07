<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'event' => [
        'approve' => 'Карта получила категорию Одобрена.',
        'beatmap_owner_change' => 'Владелец сложности :beatmap изменён на :new_user.',
        'discussion_delete' => 'Модератор удалил отзыв :discussion.',
        'discussion_lock' => 'Возможность обсуждения этой карты закрыта. (:text)',
        'discussion_post_delete' => 'Модератор удалил пост к отзыву :discussion.',
        'discussion_post_restore' => 'Модератор восстановил пост к отзыву :discussion.',
        'discussion_restore' => 'Модератор восстановил отзыв :discussion.',
        'discussion_unlock' => 'Возможность обсуждения этой карты снова открыта.',
        'disqualify' => 'Получена дисквалификация от :user. Причина: :discussion (:text).',
        'disqualify_legacy' => 'Получена дисквалификация от :user. Причина: :text.',
        'genre_edit' => 'Жанр изменён с :old на :new.',
        'issue_reopen' => 'Проблема :discussion, которая была решена :discussion_user, вновь открыта :user.',
        'issue_resolve' => 'Проблема :discussion, открытая :discussion_user, решена :user.',
        'kudosu_allow' => 'Снято вето на начисление кудосу за отзыв :discussion.',
        'kudosu_deny' => ' Наложено вето на начисление кудосу за отзыв :discussion.',
        'kudosu_gain' => 'Отзыв :discussion от :user получил достаточно голосов для начисления кудосу.',
        'kudosu_lost' => 'Отзыв :discussion от :user потерял голоса, и начисленные кудосу были отозваны.',
        'kudosu_recalculate' => 'Кудосу за отзыв :discussion были пересчитаны.',
        'language_edit' => 'Язык изменён с :old на :new.',
        'love' => 'Карта получила категорию Любимая. (:user)',
        'nominate' => 'Карта получила номинацию от :user.',
        'nominate_modes' => 'Карта получила номинацию от :user (:modes).',
        'nomination_reset' => 'Из-за новой проблемы в :discussion (:text) статус номинации был сброшен.',
        'nomination_reset_received' => 'Номинация пользователя :user была сброшена :source_user (:text)',
        'nomination_reset_received_profile' => 'Номинация была сброшена :user (:text)',
        'offset_edit' => 'Значение оффсета изменено с :old на :new.',
        'qualify' => 'Карта получила достаточное количество номинаций и стала квалифицированной.',
        'rank' => 'Карта получила категорию Рейтинговая.',
        'remove_from_loved' => 'Получена дисквалификация из категории Любимая от :user. (:text)',
        'tags_edit' => 'Теги изменены с ":old" на ":new".',

        'nsfw_toggle' => [
            'to_0' => 'Снята отметка 18+',
            'to_1' => 'Поставлена отметка 18+',
        ],
    ],

    'index' => [
        'title' => 'События карты',

        'form' => [
            'period' => 'Период',
            'types' => 'Виды событий',
        ],
    ],

    'item' => [
        'content' => 'Контент',
        'discussion_deleted' => '[удалено]',
        'type' => 'Тип',
    ],

    'type' => [
        'approve' => 'Квалификация в Одобренные',
        'beatmap_owner_change' => 'Смена владельца сложности',
        'discussion_delete' => 'Удаление отзыва',
        'discussion_post_delete' => 'Удаление ответов к отзыву',
        'discussion_post_restore' => 'Восстановление ответов в обсуждении',
        'discussion_restore' => 'Восстановление отзыва',
        'disqualify' => 'Дисквалификация',
        'genre_edit' => 'Изменение жанра',
        'issue_reopen' => 'Возобновление обсуждения проблемы',
        'issue_resolve' => 'Решение проблем',
        'kudosu_allow' => 'Одобрение кудосу',
        'kudosu_deny' => 'Отказ в кудосу',
        'kudosu_gain' => 'Получение кудосу',
        'kudosu_lost' => 'Потеря кудосу',
        'kudosu_recalculate' => 'Перерасчёт кудосу',
        'language_edit' => 'Изменение языка',
        'love' => 'Квалификация в Любимые',
        'nominate' => 'Номинация',
        'nomination_reset' => 'Сброс номинации',
        'nomination_reset_received' => 'Получен сброс номинации',
        'nsfw_toggle' => 'Поставлена отметка 18+',
        'offset_edit' => 'Изменение оффсета',
        'qualify' => 'Квалификация',
        'rank' => 'Квалификация в Рейтинговые',
        'remove_from_loved' => 'Дисквалификация из Любимых',
    ],
];
