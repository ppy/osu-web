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
    'beatmapsets' => [
        'covers' => [
            'regenerate' => 'Ανανέωση',
            'regenerating' => 'Ανανεώνεται...',
            'remove' => 'Αφαίρεση',
            'removing' => 'Αφαίρεση...',
            'title' => 'Εξώφυλλα Beatmapset',
        ],
        'show' => [
            'covers' => 'Διαχείριση εξωφύλλων Beatmapset',
            'discussion' => [
                '_' => 'Modding v2',
                'activate' => 'ενεργοποίηση',
                'activate_confirm' => 'ενεργοποίηση modding v2 γι\' αυτό το beatmap;',
                'active' => 'ενεργό',
                'inactive' => 'ανενεργό',
            ],
        ],
    ],

    'forum' => [
        'forum-covers' => [
            'index' => [
                'delete' => 'Διαγραφή',

                'forum-name' => 'Φόρουμ #:id: :name',

                'no-cover' => 'Δεν ορίστηκε εξώφυλλο',

                'submit' => [
                    'save' => 'Αποθήκευση',
                    'update' => 'Ενημέρωση',
                ],

                'title' => 'Λίστα Καλυμμάτων Φόρουμ',

                'type-title' => [
                    'default-topic' => 'Προεπιλεγμένο Κάλυμμα Θέματος',
                    'main' => 'Κάλυμμα Φόρουμ',
                ],
            ],
        ],
    ],

    'logs' => [
        'index' => [
            'title' => 'Προβολή Αρχείων',
        ],
    ],

    'pages' => [
        'root' => [
            'sections' => [
                'beatmapsets' => 'Beatmapsets',
                'forum' => 'Φόρουμ',
                'general' => 'Γενικά',
                'store' => 'Κατάστημα',
            ],
        ],
    ],

    'store' => [
        'orders' => [
            'index' => [
                'title' => 'Λίστα Παραγγελιών',
            ],
        ],
    ],

    'users' => [
        'restricted_banner' => [
            'title' => 'Αυτός ο χρήστης είναι προς το παρόν περιορισμένος.',
            'message' => '(ορατό μόνο στους διαχειριστές)',
        ],
    ],

];
