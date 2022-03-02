<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'event' => [
        'approve' => 'Одобрен.',
        'beatmap_owner_change' => 'Собственикът на трудност за :beatmap вече е :new_user.',
        'discussion_delete' => 'Модератор изтри дискусията :discussion.',
        'discussion_lock' => 'Дискусията за този бийтмап е деактивирана. (:text)',
        'discussion_post_delete' => 'Модератор изтри съобщение от дискусията :discussion.',
        'discussion_post_restore' => 'Модератор възстанови съобщение от дискусията :discussion.',
        'discussion_restore' => 'Модератор възстанови дискусията :discussion.',
        'discussion_unlock' => 'Дискусията за този бийтмап е активирана.',
        'disqualify' => 'Дисквалифициран от :user . Причина: :discussion (:text).',
        'disqualify_legacy' => 'Дисквалифициран от :user . Причина: :text.',
        'genre_edit' => 'Жанрът е променен от :old на :new.',
        'issue_reopen' => 'Разрешеният проблем :discussion от :discussion_user е отново отворен от :user.',
        'issue_resolve' => 'Проблемът :discussion от :discussion_user е отбелязан като разрешен от :user.',
        'kudosu_allow' => 'Забраната за получаване на kudosu от дискусията :discussion е премахната.',
        'kudosu_deny' => 'Забранено е получаване на kudosu от дискусията :discussion.',
        'kudosu_gain' => 'Дискусията :discussion от :user получи достатъчно гласове за получаване на kudosu.',
        'kudosu_lost' => 'Дискусията :discussion от :user загуби гласове и полученото kudosu е премахнато.',
        'kudosu_recalculate' => 'Дискусията :discussion претърпя преизчисление на kudosu субсидията.',
        'language_edit' => 'Езикът е променен от :old на :new.',
        'love' => 'Обичан от :user.',
        'nominate' => 'Номиниран от :user.',
        'nominate_modes' => 'Номиниран от :user (:modes).',
        'nomination_reset' => 'Нов проблем :discussion (:text) задейства анулиране на номинацията.',
        'nomination_reset_received' => 'Номинацията на :user беше анулирана от :source_user (:text)',
        'nomination_reset_received_profile' => 'Номинацията беше анулирана от :user (:text)',
        'qualify' => 'Този бийтмап достигна нужния брой номинации и е квалифициран за класиране.',
        'rank' => 'Класиран.',
        'remove_from_loved' => 'Премахнат от обичани от :user. (:text)',

        'nsfw_toggle' => [
            'to_0' => 'Премахнат explicit етикет',
            'to_1' => 'Означен като explicit',
        ],
    ],

    'index' => [
        'title' => 'Бийтмап сет събития',

        'form' => [
            'period' => 'Период',
            'types' => 'Видове',
        ],
    ],

    'item' => [
        'content' => 'Съдържание',
        'discussion_deleted' => '[изтрито]',
        'type' => 'Тип',
    ],

    'type' => [
        'approve' => 'Одобрение',
        'beatmap_owner_change' => 'Променен собственик на трудност',
        'discussion_delete' => 'Изтрита дискусия',
        'discussion_post_delete' => 'Изтрит отговор от дискусия',
        'discussion_post_restore' => 'Възстановен отговор от дискусия',
        'discussion_restore' => 'Възстановена дискусия',
        'disqualify' => 'Дисквалификация',
        'genre_edit' => 'Променен жанр',
        'issue_reopen' => 'Преотваряне на дискусия',
        'issue_resolve' => 'Разрешена дискусия',
        'kudosu_allow' => 'Позволяване на kudosu',
        'kudosu_deny' => 'Забрана на kudosu',
        'kudosu_gain' => 'Печалба на kudosu',
        'kudosu_lost' => 'Загуба на kudosu',
        'kudosu_recalculate' => 'Преизчисляване на kudosu',
        'language_edit' => 'Променен език',
        'love' => 'Обич',
        'nominate' => 'Номинация',
        'nomination_reset' => 'Анулирана номинация',
        'nomination_reset_received' => 'Приета номинация за анулиране',
        'nsfw_toggle' => 'Explicit съдържание',
        'qualify' => 'Квалификация',
        'rank' => 'Класиране',
        'remove_from_loved' => 'Премахнат от Обичани',
    ],
];
