<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'event' => [
        'approve' => 'Одобрена.',
        'beatmap_owner_change' => 'Власника складності :beatmap змінено на :new_user.',
        'discussion_delete' => 'Модератор видалив відгук в :discussion.',
        'discussion_lock' => 'Обговорення цієї карти було відключено. (:text)',
        'discussion_post_delete' => 'Модератор вилучив публікацію з відгуку :discussion.',
        'discussion_post_restore' => 'Модератор відновив публікацію з відгуку :discussion.',
        'discussion_restore' => 'Модератор відновив відгук в :discussion.',
        'discussion_unlock' => 'Обговорення цієї карти відключено.',
        'disqualify' => 'Дискваліфіковано :user. Причина: :discussion (:text).',
        'disqualify_legacy' => 'Дискваліфіковано :user. Причина: :text.',
        'genre_edit' => 'Жанр змінено з :old на :new.',
        'issue_reopen' => 'Проблема в :discussion знову вирішена.',
        'issue_resolve' => 'Проблема :discussion відмічена як вирішена.',
        'kudosu_allow' => 'Кудосу з відгуку :discussion були вилучені.',
        'kudosu_deny' => 'Відгуку :discussion відмовлено в отриманні кудосу.',
        'kudosu_gain' => 'Відгук в :discussion від :user отримав достатньо голосів для отримання кудосу.',
        'kudosu_lost' => 'Відгук в :discussion від :user втратило голоси і присуджені кудосу були вилучені.',
        'kudosu_recalculate' => 'Кудосу за відгук в :discussion були перераховані.',
        'language_edit' => 'Мова змінена з :old на :new.',
        'love' => 'Додано :user в улюблене',
        'nominate' => 'Номіновано :user.',
        'nominate_modes' => 'Номінована від :user (:modes)',
        'nomination_reset' => 'Через нову проблему в :discussion (:text) статус номінації був скинутий.',
        'nomination_reset_received' => 'Число :user було скинуто на :source_user (:text)',
        'nomination_reset_received_profile' => 'Номінація була скинута :user (:text) ',
        'qualify' => 'Ця карта була номінована достатню кількість разів для кваліфікації.',
        'rank' => 'Рейтинговий.',
        'remove_from_loved' => 'Вилучено з категорії Loved користувачем :user. (:text)',

        'nsfw_toggle' => [
            'to_0' => 'Видалена позначка непристойного вмісту',
            'to_1' => 'Має непристойний вміст',
        ],
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
        'beatmap_owner_change' => 'Змінення власника складності',
        'discussion_delete' => 'Видалення дискусії',
        'discussion_post_delete' => 'Видалення відповідей в дискусії',
        'discussion_post_restore' => 'Відновлення відповідей в дискусії',
        'discussion_restore' => 'Відновлення дискусії',
        'disqualify' => 'Дискваліфікація',
        'genre_edit' => 'Зміна жанру',
        'issue_reopen' => 'Відновлення обговорення',
        'issue_resolve' => 'Обговорення вирішення',
        'kudosu_allow' => 'Ліміт кудосу',
        'kudosu_deny' => 'Відмова в кудосу',
        'kudosu_gain' => 'Отримання кудосу',
        'kudosu_lost' => 'Втрата кудосу',
        'kudosu_recalculate' => 'Перерахунок кудосу',
        'language_edit' => 'Зміна мови',
        'love' => 'Любов',
        'nominate' => 'Номінація',
        'nomination_reset' => 'Скинути номінацію',
        'nomination_reset_received' => 'Запрос на обнулення номінації був відправлений',
        'nsfw_toggle' => 'Непристойний вміст',
        'qualify' => 'Кваліфікація',
        'rank' => 'Рейтинг',
        'remove_from_loved' => 'Улюблене видалення',
    ],
];
