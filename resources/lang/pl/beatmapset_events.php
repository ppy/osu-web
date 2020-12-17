<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

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
        'genre_edit' => 'Zmieniono gatunek z :old na :new.',
        'issue_reopen' => 'Rozwiązany problem :discussion został otworzony ponownie.',
        'issue_resolve' => 'Problem :discussion został oznaczony jako rozwiązany.',
        'kudosu_allow' => 'Odrzucenie kudosu dla dyskusji :discussion zostało usunięte.',
        'kudosu_deny' => 'Dyskusja :discussion nie otrzyma kudosu.',
        'kudosu_gain' => 'Dyskusja :discussion otrzymała wystarczająco dużo głosów na kudosu.',
        'kudosu_lost' => 'Dyskusja :discussion straciła głosy, a przyznane kudosu zostało odebrane.',
        'kudosu_recalculate' => 'Kudosu w dyskusji :discussion zostało przekalkulowane.',
        'language_edit' => 'Zmieniono język z :old na :new.',
        'love' => ':user nadał(a) tej beatmapie status ulubionej społeczności',
        'nominate' => 'Nominowana przez :user.',
        'nomination_reset' => 'Nowy problem :discussion spowodował zresetowanie nominacji.',
        'qualify' => 'Ta beatmapa osiągnęła wystarczającą liczbę nominacji i została zakwalifikowana.',
        'rank' => 'Rankingowa.',
        'remove_from_loved' => 'Usunięta z ulubionych beatmap społeczności przez użytkownika :user (:text).',
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
        'genre_edit' => 'Zmiana gatunku',
        'issue_reopen' => 'Ponowne otworzenie dyskusji',
        'issue_resolve' => 'Zakończenie dyskusji',
        'kudosu_allow' => 'Zezwolenie na otrzymanie kudosu',
        'kudosu_deny' => 'Odrzucenie otrzymania kudosu',
        'kudosu_gain' => 'Zdobycie kudosu',
        'kudosu_lost' => 'Utrata kudosu',
        'kudosu_recalculate' => 'Przekalkulowanie kudosu',
        'language_edit' => 'Zmiana języka',
        'love' => 'Nadanie statusu ulubionej społeczności',
        'nominate' => 'Nominacja',
        'nomination_reset' => 'Zresetowanie nominacji',
        'qualify' => 'Kwalifikacja',
        'rank' => 'Nadanie statusu rankingowego',
        'remove_from_loved' => 'Usunięcie z ulubionych beatmap społeczności',
    ],
];
