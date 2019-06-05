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
        'approve' => 'Одобрен.',
        'discussion_delete' => 'Модератор изтри дискусията :discussion.',
        'discussion_lock' => '',
        'discussion_post_delete' => 'Модератор изтри съобщение от дискусията :discussion.',
        'discussion_post_restore' => 'Модератор възстанови съобщение от дискусията :discussion.',
        'discussion_restore' => 'Модератор възстанови дискусията :discussion.',
        'discussion_unlock' => '',
        'disqualify' => 'Дисквалифициран от :user . Причина: :discussion (:text).',
        'disqualify_legacy' => 'Дисквалифициран от :user . Причина: :text.',
        'issue_reopen' => 'Разрешеният проблем :discussion бе отворен наново.',
        'issue_resolve' => 'Проблемът :discussion бе маркиран като разрешен.',
        'kudosu_allow' => 'Забраната за получаване на kudosu за дискусията :discussion бе премахната.',
        'kudosu_deny' => 'Забрани се получаването на kudosu за дискусията :discussion.',
        'kudosu_gain' => 'Дискусията :discussion от :user получи достатъчно гласове да получава kudosu.',
        'kudosu_lost' => 'Дискусията :discussion от :user загуби гласове и полученото kudosu бе премахнато.',
        'kudosu_recalculate' => 'Дискусията :discussion претърпя преизчисление на kudosu субсидията.',
        'love' => 'Заобичан от :user',
        'nominate' => 'Номиниран от :user.',
        'nomination_reset' => 'Нов проблем :discussion (:text) задейства нулиране на номинацията.',
        'qualify' => 'Този бийтмап достигна максимум брой номинации и бе квалифициран за класиране.',
        'rank' => 'Класиран.',
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
        'approve' => 'Одобрен',
        'discussion_delete' => 'Изтриване на дискусия',
        'discussion_post_delete' => 'Изтриване на отговор от дискусия',
        'discussion_post_restore' => 'Възстановяване на отговор от дискусия',
        'discussion_restore' => 'Възстановяване на дискусия',
        'disqualify' => 'Дисквалификация',
        'issue_reopen' => 'Преотваряне на дискусия',
        'issue_resolve' => 'Разрешаване на дискусия',
        'kudosu_allow' => 'Отпуснато Kudosu',
        'kudosu_deny' => 'Отказ на Kudosu',
        'kudosu_gain' => 'Печалба на Kudosu',
        'kudosu_lost' => 'Загуба на Kudosu',
        'kudosu_recalculate' => 'Преизчисляване на Kudosu',
        'love' => 'Обичан',
        'nominate' => 'Номинация',
        'nomination_reset' => 'Анулиране на номинацията',
        'qualify' => 'Квалификация',
        'rank' => 'Класиране',
    ],
];
