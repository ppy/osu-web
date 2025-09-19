<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'index' => [
        'batch_disable' => 'Απενεργοποίηση Επιλεγμένων',
        'batch_enable' => 'Ενεργοποίηση Επιλεγμένων',

        'batch_confirm' => [
            '_' => ':action :items;',
            'disable' => 'Απενεργοποίηση',
            'enable' => 'Ενεργοποίηση',
            'items' => ':count_delimited cover|:count_delimited covers',
        ],

        'create_form' => [
            'files' => 'Αρχεία',
            'submit' => 'Αποθήκευση',
            'title' => 'Προσθήκη Νέου',
        ],

        'item' => [
            'click_to_disable' => 'Κάντε κλικ για απενεργοποίηση',
            'click_to_enable' => 'Κάντε κλικ για ενεργοποίηση',
            'enabled' => 'Ενεργοποιημένο',
            'disabled' => 'Απενεργοποιημένο',
            'image_store' => 'Ορισμός Εικόνας',
            'image_update' => 'Αντικατάσταση Εικόνας',
        ],
    ],
    'store' => [
        'failed' => 'Παρουσιάστηκε σφάλμα κατά τη δημιουργία cover: :error',
        'ok' => 'Το cover δημιουργήθηκε',
    ],
];
