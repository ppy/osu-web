<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'signature' => [
        'not_match' => 'Οι υπογραφές δεν ταιριάζουν',
    ],
    'notification_type' => 'notification_type δεν είναι έγκυρος/η :type',
    'order' => [
        'invalid' => 'Η παραγγελία δεν είναι έγκυρη',
        'items' => [
            'virtual_only' => '`:provider` η πληρωμή δεν είναι έγκυρη για φυσικά αντικείμενα.',
        ],
        'status' => [
            'not_checkout' => 'Προσπάθεια αποδοχής πληρωμής για μια παραγγελία σε εσφαλμένη κατάσταση `:state`.',
            'not_paid' => 'Προσπαθεία επιστροφής χρημάτων για μια παραγγελία σε εσφαλμένη κατάσταση `:state`.',
        ],
    ],
    'param' => [
        'invalid' => 'η `:param` παράμετρος δεν ταιριάζει',
    ],
    'paypal' => [
        'not_echeck' => 'Η εκκρεμής πληρωμή δεν έχει ελεγχθεί. (:actual)',
    ],
    'purchase' => [
        'checkout' => [
            'amount' => 'Το ποσό πληρωμής δεν ταιριάζει: :actual != :expected',
            'currency' => 'Η πληρωμή δεν είναι σε δολάρια ΗΠΑ. (:type)',
        ],
    ],
    'order_number' => [
        'malformed' => 'Το αναγνωριστικό της συναλλαγής παραγγελίας δεν έχει σωστή μορφή',
        'user_id_mismatch' => 'external_id περίεχει λάθος αναγνωριστικό χρήστη',
    ],
];
