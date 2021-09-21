<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'event' => [
        'approve' => 'Одобрен.',
        'beatmap_owner_change' => 'Собственикът на трудност за :beatmap вече е :new_user.',
        'discussion_delete' => 'Модератор изтри дискусията :discussion.',
        'discussion_lock' => 'Дискусията за този бийтмап бе деактивирана. (:text)',
        'discussion_post_delete' => 'Модератор изтри съобщение от дискусията :discussion.',
        'discussion_post_restore' => 'Модератор възстанови съобщение от дискусията :discussion.',
        'discussion_restore' => 'Модератор възстанови дискусията :discussion.',
        'discussion_unlock' => 'Дискусията за този бийтмап бе активирана.',
        'disqualify' => 'Дисквалифициран от :user . Причина: :discussion (:text).',
        'disqualify_legacy' => 'Дисквалифициран от :user . Причина: :text.',
        'genre_edit' => 'Жанрът бе променен от :old на :new.',
        'issue_reopen' => 'Разрешеният проблем :discussion от :discussion_user бе отново отворен от :user.',
        'issue_resolve' => 'Проблемът :discussion от :discussion_user е отбелязан като разрешен от :user.',
        'kudosu_allow' => 'Забраната за получаване на kudosu от дискусията :discussion е премахната.',
        'kudosu_deny' => 'Забранено е получаване на kudosu от дискусията :discussion.',
        'kudosu_gain' => 'Дискусията :discussion от :user получи достатъчно гласове да получава kudosu.',
        'kudosu_lost' => 'Дискусията :discussion от :user загуби гласове и полученото kudosu бе премахнато.',
        'kudosu_recalculate' => 'Дискусията :discussion претърпя преизчисление на kudosu субсидията.',
        'language_edit' => 'Езикът е променен от :old на :new.',
        'love' => 'Заобичан от :user',
        'nominate' => 'Номиниран от :user.',
        'nominate_modes' => 'Номиниран от :user (:modes).',
        'nomination_reset' => 'Нов проблем :discussion (:text) задейства зануляване на номинацията.',
        'nomination_reset_received' => 'Номинацията на :user беше занулена от :source_user (:text)',
        'nomination_reset_received_profile' => 'Номинацията беше занулена от :user (:text)',
        'qualify' => 'Този бийтмап достигна нужния брой номинации и е квалифициран за класиране.',
        'rank' => 'Класиран.',
        'remove_from_loved' => 'Премахнат от Обичани от :user. (:text)',

        'nsfw_toggle' => [
            'to_0' => 'Не е означен като explicit',
            'to_1' => 'Означен като explicit',
        ],
    ],

    'index' => [
        'title' => 'Бийтмап сет събития',

        'form' => [
            'period' => 'Период',
            'types' => 'Типове',
        ],
    ],

    'item' => [
        'content' => 'Съдържание',
        'discussion_deleted' => '[изтрито]',
        'type' => 'Тип',
    ],

    'type' => [
        'approve' => 'Одобрение',
        'beatmap_owner_change' => 'Промени собственика на трудност',
        'discussion_delete' => 'Изтриване на дискусия',
        'discussion_post_delete' => 'Изтриване на отговор от дискусия',
        'discussion_post_restore' => 'Възстановяване на отговор от дискусия',
        'discussion_restore' => 'Възстановяване на дискусия',
        'disqualify' => 'Дисквалификация',
        'genre_edit' => 'Промяна на жанр',
        'issue_reopen' => 'Отвори отново дискусия',
        'issue_resolve' => 'Приключване на дискусия',
        'kudosu_allow' => 'Позволяване на kudosu',
        'kudosu_deny' => 'Отказ на Kudosu',
        'kudosu_gain' => 'Печалба на Kudosu',
        'kudosu_lost' => 'Загуба на Kudosu',
        'kudosu_recalculate' => 'Преизчисляване на Kudosu',
        'language_edit' => 'Промяна на език',
        'love' => 'Обичан',
        'nominate' => 'Номинация',
        'nomination_reset' => 'Анулиране на номинация',
        'nomination_reset_received' => 'Номинация за зануляване е приета',
        'nsfw_toggle' => 'Explicit етикет',
        'qualify' => 'Квалификация',
        'rank' => 'Класиране',
        'remove_from_loved' => 'Премахни от Обичани',
    ],
];
