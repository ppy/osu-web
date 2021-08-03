<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'event' => [
        'approve' => 'Одобрен.',
        'beatmap_owner_change' => '',
        'discussion_delete' => 'Модератор изтри дискусията :discussion.',
        'discussion_lock' => 'Дискусията за този бийтмап бе деактивирана. (:text)',
        'discussion_post_delete' => 'Модератор изтри съобщение от дискусията :discussion.',
        'discussion_post_restore' => 'Модератор възстанови съобщение от дискусията :discussion.',
        'discussion_restore' => 'Модератор възстанови дискусията :discussion.',
        'discussion_unlock' => 'Дискусията за този бийтмап бе активирана.',
        'disqualify' => 'Дисквалифициран от :user . Причина: :discussion (:text).',
        'disqualify_legacy' => 'Дисквалифициран от :user . Причина: :text.',
        'genre_edit' => 'Жанрът бе променен от :old на :new.',
        'issue_reopen' => 'Разрешеният проблем :discussion бе отворен наново.',
        'issue_resolve' => 'Проблемът :discussion бе маркиран като разрешен.',
        'kudosu_allow' => 'Забраната за получаване на kudosu за дискусията :discussion бе премахната.',
        'kudosu_deny' => 'Забрани се получаването на kudosu за дискусията :discussion.',
        'kudosu_gain' => 'Дискусията :discussion от :user получи достатъчно гласове да получава kudosu.',
        'kudosu_lost' => 'Дискусията :discussion от :user загуби гласове и полученото kudosu бе премахнато.',
        'kudosu_recalculate' => 'Дискусията :discussion претърпя преизчисление на kudosu субсидията.',
        'language_edit' => 'Езикът бе сменен от :old на :new.',
        'love' => 'Заобичан от :user',
        'nominate' => 'Номиниран от :user.',
        'nominate_modes' => '',
        'nomination_reset' => 'Нов проблем :discussion (:text) задейства нулиране на номинацията.',
        'nomination_reset_received' => '',
        'nomination_reset_received_profile' => '',
        'qualify' => 'Този бийтмап достигна максимум брой номинации и бе квалифициран за класиране.',
        'rank' => 'Класиран.',
        'remove_from_loved' => '',

        'nsfw_toggle' => [
            'to_0' => '',
            'to_1' => '',
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
        'beatmap_owner_change' => '',
        'discussion_delete' => 'Изтриване на дискусия',
        'discussion_post_delete' => 'Изтриване на отговор от дискусия',
        'discussion_post_restore' => 'Възстановяване на отговор от дискусия',
        'discussion_restore' => 'Възстановяване на дискусия',
        'disqualify' => 'Дисквалификация',
        'genre_edit' => 'Промяна на жанра',
        'issue_reopen' => 'Преотваряне на дискусия',
        'issue_resolve' => 'Разрешаване на дискусия',
        'kudosu_allow' => 'Отпуснато Kudosu',
        'kudosu_deny' => 'Отказ на Kudosu',
        'kudosu_gain' => 'Печалба на Kudosu',
        'kudosu_lost' => 'Загуба на Kudosu',
        'kudosu_recalculate' => 'Преизчисляване на Kudosu',
        'language_edit' => 'Промяна на езика',
        'love' => 'Обичан',
        'nominate' => 'Номинация',
        'nomination_reset' => 'Анулиране на номинацията',
        'nomination_reset_received' => '',
        'nsfw_toggle' => '',
        'qualify' => 'Квалификация',
        'rank' => 'Класиране',
        'remove_from_loved' => '',
    ],
];
