<?php

/**
 *    Copyright 2015-2017 ppy Pty. Ltd.
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
    'required' => ':attribute jest wymagany.',
    'wrong_confirmation' => 'Potwierdzenie się nie zgadza.',

    'beatmap_discussion_post' => [
        'first_post' => 'Nie można usunąć wątku rozpoczynającego.',
    ],

    'forum' => [
        'feature_vote' => [
            'not_feature_topic' => 'Można głosować tylko na prośby o funkcję.',
            'not_enough_feature_votes' => 'Niewystarczająco dużo głosów.',
        ],

        'poll_vote' => [
            'invalid' => 'Wybrano nieprawidłową opcję.',
        ],

        'topic_poll' => [
            'duplicate_options' => 'Duplikaty nie są dozwolone.',
            'invalid_max_options' => 'Ilość możliwości wyboru na użytkownika nie może przekroczyć ich całościowej liczby.',
            'minimum_one_selection' => 'Potrzeba minimalnie jedną opcję.',
            'minimum_two_options' => 'Potrzeba minimalnie dwóch opcji.',
            'too_many_options' => 'Przekroczono maksymalną ilość możliwości wyboru.',
        ],

        'topic_vote' => [
            'too_many' => 'Wybrano więcej opcji, niż jest dozwolone.',
        ],
    ],

    'user_email' => [
        'invalid' => "To nie wygląda na adres email.",
        'already_used' => 'Ten adres email jest już w użyciu.',
        'wrong_confirmation' => 'Email potwierdzający się nie zgadza.',
        'wrong_current_password' => 'Obecne hasło jest niepoprawne.',
    ],

    'user_password' => [
        'contains_username' => 'Hasło nie może zawierać pseudonimu.',
        'too_short' => 'Nowe hasło jest za krótkie.',
        'weak' => 'Hasło jest za słabe.',
        'wrong_confirmation' => 'Hasło potwierdzające się nie zgadza.',
        'wrong_current_password' => 'Obecne hasło jest niepoprawne.',
    ],
];
