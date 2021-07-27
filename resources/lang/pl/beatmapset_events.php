<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'event' => [
        'approve' => 'Zatwierdzona.',
        'beatmap_owner_change' => 'Zmieniono twórcę poziomu trudności „:beatmap” na użytkownika :new_user.',
        'discussion_delete' => 'Moderator usunął dyskusję :discussion.',
        'discussion_lock' => 'Tworzenie dyskusji dla tej beatmapy zostało wyłączone (:text).',
        'discussion_post_delete' => 'Moderator usunął post z dyskusji :discussion.',
        'discussion_post_restore' => 'Moderator przywrócił post z dyskusji :discussion.',
        'discussion_restore' => 'Moderator przywrócił dyskusję :discussion.',
        'discussion_unlock' => 'Tworzenie dyskusji dla tej beatmapy zostało włączone.',
        'disqualify' => ':user zdyskwalifikował(a) tę beatmapę. Powód: :discussion (:text).',
        'disqualify_legacy' => ':user zdyskwalifikował(a) tę beatmapę. Powód: :text.',
        'genre_edit' => 'Zmieniono gatunek z :old na :new.',
        'issue_reopen' => 'Rozwiązany problem :discussion zgłoszony przez użytkownika :discussion_user został otworzony ponownie przez użytkownika :user.',
        'issue_resolve' => 'Problem :discussion zgłoszony przez użytkownika :discussion_user został oznaczony jako rozwiązany przez użytkownika :user.',
        'kudosu_allow' => 'Odrzucenie kudosu dla dyskusji :discussion zostało usunięte.',
        'kudosu_deny' => 'Dyskusja :discussion nie otrzyma kudosu.',
        'kudosu_gain' => 'Dyskusja :discussion otrzymała wystarczająco dużo głosów na kudosu.',
        'kudosu_lost' => 'Dyskusja :discussion straciła głosy, a przyznane kudosu zostało odebrane.',
        'kudosu_recalculate' => 'Kudosu w dyskusji :discussion zostało przekalkulowane.',
        'language_edit' => 'Zmieniono język z :old na :new.',
        'love' => ':user nadał(a) tej beatmapie status ulubionej społeczności',
        'nominate' => 'Nominowana przez :user.',
        'nominate_modes' => 'Nominowana przez użytkownika :user (:modes).',
        'nomination_reset' => 'Nowy problem :discussion spowodował zresetowanie nominacji.',
        'nomination_reset_received' => '',
        'nomination_reset_received_profile' => '',
        'qualify' => 'Ta beatmapa osiągnęła wystarczającą liczbę nominacji i została zakwalifikowana.',
        'rank' => 'Rankingowa.',
        'remove_from_loved' => 'Usunięta z ulubionych beatmap społeczności przez użytkownika :user (:text).',

        'nsfw_toggle' => [
            'to_0' => 'Usunięto oznaczenie jako treść dla pełnoletnich',
            'to_1' => 'Oznaczono jako treść dla pełnoletnich',
        ],
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
        'beatmap_owner_change' => 'Zmiana twórcy poziomu trudności',
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
        'nomination_reset_received' => '',
        'nsfw_toggle' => 'Oznaczenie jako treść dla pełnoletnich',
        'qualify' => 'Kwalifikacja',
        'rank' => 'Nadanie statusu rankingowego',
        'remove_from_loved' => 'Usunięcie z ulubionych beatmap społeczności',
    ],
];
