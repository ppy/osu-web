<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'error' => [
        'chat' => [
            'empty' => 'Δεν μπορείτε να στείλετε κενό μήνυμα.',
            'limit_exceeded' => 'Στέλνετε μηνύματα πολύ γρήγορα, παρακαλώ περιμένετε λίγο πριν να προσπαθήσετε ξανά.',
            'too_long' => 'Το μήνυμα που προσπαθήσατε να στείλετε είναι πάρα πολύ μεγάλο.',
        ],
    ],

    'scopes' => [
        'bot' => 'Λειτουργεί ως chat bot.',
        'identify' => 'Να σας αναγνωρίσει και να διαβάσει το δημόσιο προφίλ σας.',

        'chat' => [
            'read' => 'Διάβασε τα μηνύματα για λογαριασμό σου.',
            'write' => 'Στείλτε μηνύματα για λογαριασμό σας.',
            'write_manage' => 'Μπες και αφήσε τα κανάλια για λογαριασμό σου.',
        ],

        'forum' => [
            'write' => 'Δημιουργήστε και επεξεργαστείτε θέματα και δημοσιεύσεις φόρουμ για λογαριασμό σας.',
            'write_manage' => '',
        ],

        'friends' => [
            'read' => 'Δείτε ποιους ακολουθείτε.',
        ],

        'multiplayer' => [
            'write_manage' => '',
        ],

        'public' => 'Διαβάστε τα δημόσια δεδομένα για λογαριασμό σας.',
    ],
];
