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
