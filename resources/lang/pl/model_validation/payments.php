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
    'signature' => [
        'not_match' => 'Sygnatury nie są jednakowe',
    ],
    'notification_type' => 'notification_type nie jest poprawnym :type',
    'order' => [
        'invalid' => 'Zamówienie nie jest prawidłowe',
        'items' => [
            'virtual_only' => 'Płatność przez `:provider` nie jest możliwa dla materialnych przedmiotów.',
        ],
        'status' => [
            'not_checkout' => 'Próbujesz zaakceptować płatność dla zamówienia w niewłaściwym stanie `:state`.',
            'not_paid' => 'Próbujesz cofnąć płatność dla zamówienia w niewłaściwym stanie `:state`.',
        ],
    ],
    'param' => [
        'invalid' => 'Parametr `:param` nie zgadza się',
    ],
    'paypal' => [
        'not_echeck' => 'Oczekująca płatność nie jest e-czekiem. (:actual)',
    ],
    'purchase' => [
        'checkout' => [
            'amount' => 'Wartość płatności nie zgadza się: :actual != :expected',
            'currency' => 'Płatność nie jest w dolarach. (:type)',
        ],
    ],
    'order_number' => [
        'malformed' => 'Otrzymany identyfikator zamówienia jest niepoprawny',
        'user_id_mismatch' => 'external_id zawiera błędny identyfikator użytkownika',
    ],
];
