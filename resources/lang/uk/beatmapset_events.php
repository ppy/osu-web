<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'event' => [
        'approve' => 'Схвалена.',
        'beatmap_owner_change' => 'Власника складності :beatmap змінено на :new_user.',
        'discussion_delete' => 'Модератор видалив відгук в :discussion.',
        'discussion_lock' => 'Обговорення цієї мапи було відключено. (:text)',
        'discussion_post_delete' => 'Модератор видалив публікацію з дискусії :discussion.',
        'discussion_post_restore' => 'Модератор відновив публікацію з дискусії :discussion.',
        'discussion_restore' => 'Модератор відновив дискусію :discussion.',
        'discussion_unlock' => 'Обговорення цієї мапи було увімкнено.',
        'disqualify' => 'Дискваліфіковано :user. Причина: :discussion (:text).',
        'disqualify_legacy' => 'Дискваліфіковано :user. Причина: :text.',
        'genre_edit' => 'Жанр змінено з :old на :new.',
        'issue_reopen' => 'Вирішена проблема :discussion від :discussion_user знову відкрита :user.',
        'issue_resolve' => 'Проблема :discussion від :discussion_user була помічена як вирішена :user.',
        'kudosu_allow' => 'Кудосу з відгуку :discussion було вилучено.',
        'kudosu_deny' => 'Відгуку :discussion відмовлено в отриманні кудосу.',
        'kudosu_gain' => 'Відгук в :discussion від :user отримав достатньо голосів для отримання кудосу.',
        'kudosu_lost' => 'Відгук в :discussion від :user втратило голоси і присуджені кудосу були вилучені.',
        'kudosu_recalculate' => 'Кудосу за відгук в :discussion були перераховані.',
        'language_edit' => 'Мова змінена з :old на :new.',
        'love' => 'Номіновано в улюблене :user.',
        'nominate' => 'Номіновано :user.',
        'nominate_modes' => 'Номіновано :user (:modes).',
        'nomination_reset' => 'Через нову проблему в :discussion (:text) статус номінації було скинуто.',
        'nomination_reset_received' => 'Номінація від :user була скинута :source_user (:text)',
        'nomination_reset_received_profile' => 'Номінація була скинута :user (:text) ',
        'offset_edit' => 'Онлайн офсет змінився з :old на :new',
        'qualify' => 'Ця мапа отримала достатню кількість номінацій й була кваліфікована.',
        'rank' => 'Мапа отримала статус Рейтингової.',
        'remove_from_loved' => 'Вилучено з категорії Улюблених користувачем :user. (:text)',

        'nsfw_toggle' => [
            'to_0' => 'Видалена позначка непристойного вмісту',
            'to_1' => 'Має непристойний вміст',
        ],
    ],

    'index' => [
        'title' => 'Події бітмапи',

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
        'issue_reopen' => 'Відновлення дискусії',
        'issue_resolve' => 'Вирішення дискусії',
        'kudosu_allow' => 'Ліміт кудосу',
        'kudosu_deny' => 'Відмова в кудосу',
        'kudosu_gain' => 'Отримання кудосу',
        'kudosu_lost' => 'Втрата кудосу',
        'kudosu_recalculate' => 'Перерахунок кудосу',
        'language_edit' => 'Зміна мови',
        'love' => 'Номінування в улюблені',
        'nominate' => 'Номінація',
        'nomination_reset' => 'Скидання номінації',
        'nomination_reset_received' => 'Отримано скасування номінації',
        'nsfw_toggle' => 'Непристойний вміст',
        'offset_edit' => 'Редагування офсету',
        'qualify' => 'Кваліфікація',
        'rank' => 'Рейтинг',
        'remove_from_loved' => 'Вилучення з улюблених',
    ],
];
