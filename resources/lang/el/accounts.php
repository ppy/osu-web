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
    'edit' => [
        'title_compact' => 'ρυθμίσεις',
        'username' => 'όνομα χρήστη',

        'avatar' => [
            'title' => 'Avatar',
            'rules' => 'Παρακαλώ βεβαιωθείτε ότι το avatar σας συμφωνεί με :link. <br/>Αυτό σημαίνει ότι πρέπει να είναι <strong>κατάλληλο για όλες τις ηλικές</strong>.',
            'rules_link' => 'τους κανόνες κοινότητας',
        ],

        'email' => [
            'current' => 'τρέχον email',
            'new' => 'νέο email',
            'new_confirmation' => 'επιβεβαίωση email',
            'title' => 'Email',
        ],

        'password' => [
            'current' => 'τρέχων κωδικός',
            'new' => 'νέος κωδικός',
            'new_confirmation' => 'επιβεβαίωση κωδικού',
            'title' => 'Κωδικός',
        ],

        'profile' => [
            'title' => 'Προφίλ',

            'user' => [
                'user_discord' => '',
                'user_from' => 'τρέχουσα τοποθεσία',
                'user_interests' => 'ενδιαφέροντα',
                'user_msnm' => '',
                'user_occ' => 'ενασχόληση',
                'user_twitter' => '',
                'user_website' => 'ιστοσελίδα',
            ],
        ],

        'signature' => [
            'title' => 'Υπογραφή',
            'update' => 'ενημέρωση',
        ],
    ],

    'notifications' => [
        'title' => 'Ειδοποιήσεις',
        'topic_auto_subscribe' => 'αυτόματη ενεργοποίηση ειδοποιήσεων για τα νέα θέματα που δημιουργείτε στο φόρουμ',
        'beatmapset_discussion_qualified_problem' => '',

        'mail' => [
            '_' => '',
            'beatmapset:modding' => '',
            'forum_topic_reply' => '',
        ],
    ],

    'oauth' => [
        'authorized_clients' => 'εγκεκριμένοι clients',
        'own_clients' => 'οι δικοί σας clients',
        'title' => 'OAuth',
    ],

    'playstyles' => [
        'keyboard' => 'πληκτρολόγιο',
        'mouse' => 'ποντίκι',
        'tablet' => 'γραφίδα',
        'title' => 'Τρόπος παιχνιδιού',
        'touch' => 'οθόνη αφής',
    ],

    'privacy' => [
        'friends_only' => 'Αποκλεισμός των ιδιωτικών μηνυμάτων από άτομα που δεν βρίσκονται στη λίστα φίλων σας',
        'hide_online' => 'απόκρυψη παρουσίας',
        'title' => 'Απόρρητο',
    ],

    'security' => [
        'current_session' => 'τρέχουσα',
        'end_session' => 'Λήξη Συνεδρίας',
        'end_session_confirmation' => 'Αυτό θα λήξει τη συνεδρία σας σε αυτή την συσκευή. Είστε σίγουρος;',
        'last_active' => 'Τελευταία ενεργός:',
        'title' => 'Ασφάλεια',
        'web_sessions' => 'συνεδρίες',
    ],

    'update_email' => [
        'update' => 'ενημέρωση',
    ],

    'update_password' => [
        'update' => 'ενημέρωση
',
    ],

    'verification_completed' => [
        'text' => 'Μπορείτε πλέον να κλείσετε αυτήν την καρτέλα/παραάθυρο',
        'title' => 'Η επαλήθευση ολοκληρώθηκε',
    ],

    'verification_invalid' => [
        'title' => 'Μη έγκυρος ή ληξιπρόθεσμος σύνδεσμος',
    ],
];
