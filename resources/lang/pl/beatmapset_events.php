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
        'approve' => 'Zatwierdzona.',
        'discussion_delete' => 'Moderator usunął dyskusję :discussion.',
        'discussion_lock' => 'Tworzenie dyskusji dla tej beatmapy zostało wyłączone (:text).',
        'discussion_post_delete' => 'Moderator usunął post z dyskusji :discussion.',
        'discussion_post_restore' => 'Moderator przywrócił post z dyskusji :discussion.',
        'discussion_restore' => 'Moderator przywrócił dyskusję :discussion.',
        'discussion_unlock' => 'Tworzenie dyskusji dla tej beatmapy zostało włączone.',
        'disqualify' => ':user zdyskwalifikował(a) tę beatmapę. Powód: :discussion (:text).',
        'disqualify_legacy' => ':user zdyskwalifikował(a) tę beatmapę. Powód: :text.',
        'issue_reopen' => 'Rozwiązany problem :discussion został otworzony ponownie.',
        'issue_resolve' => 'Problem :discussion został oznaczony jako rozwiązany.',
        'kudosu_allow' => 'Odrzucenie kudosu dla dyskusji :discussion zostało usunięte.',
        'kudosu_deny' => 'Dyskusja :discussion nie otrzyma kudosu.',
        'kudosu_gain' => 'Dyskusja :discussion otrzymała wystarczająco dużo głosów na kudosu.',
        'kudosu_lost' => 'Dyskusja :discussion straciła głosy, a przyznane kudosu zostało odebrane.',
        'kudosu_recalculate' => 'Kudosu w dyskusji :discussion zostało przekalkulowane.',
        'love' => ':user nadał(a) tej beatmapie status ulubionej społeczności',
        'nominate' => 'Nominowana przez :user.',
        'nomination_reset' => 'Nowy problem :discussion spowodował zresetowanie nominacji.',
        'qualify' => 'Ta beatmapa osiągnęła wystarczającą liczbę nominacji i została zakwalifikowana.',
        'rank' => 'Rankingowa.',
    ],

    'index' => [
        'title' => 'Historia zdarzeń zestawów beatmap',

        'form' => [
            'period' => 'Okres',
            'types' => 'Rodzaje',
        ],
    ],

    'item' => [
        'content' => 'Zawartość',
        'discussion_deleted' => '[usunięte]',
        'type' => 'Typ',
    ],

    'type' => [
        'approve' => 'Zatwierdzenie',
        'discussion_delete' => 'Usunięcie dyskusji',
        'discussion_post_delete' => 'Usunięcie odpowiedzi w dyskusji',
        'discussion_post_restore' => 'Przywrócenie odpowiedzi w dyskusji',
        'discussion_restore' => 'Przywrócenie dyskusji',
        'disqualify' => 'Dyskwalifikacja',
        'issue_reopen' => 'Ponowne otworzenie dyskusji',
        'issue_resolve' => 'Zakończenie dyskusji',
        'kudosu_allow' => 'Zezwolenie na otrzymanie kudosu',
        'kudosu_deny' => 'Odrzucenie otrzymania kudosu',
        'kudosu_gain' => 'Zdobycie kudosu',
        'kudosu_lost' => 'Utrata kudosu',
        'kudosu_recalculate' => 'Przekalkulowanie kudosu',
        'love' => 'Nadanie statusu ulubionej społeczności',
        'nominate' => 'Nominacja',
        'nomination_reset' => 'Zresetowanie nominacji',
        'qualify' => 'Kwalifikacja',
        'rank' => 'Nadanie statusu rankingowego',
    ],
];
