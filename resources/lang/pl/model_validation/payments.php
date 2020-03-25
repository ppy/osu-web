<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

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
