<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'none' => 'Keine Gruppenhistorie gefunden!',
    'view' => 'Gruppenhistorie anzeigen',

    'event' => [
        'actor' => 'von :user',

        'message' => [
            'group_add' => ':group wurde erstellt.',
            'group_remove' => ':group wurde gelöscht.',
            'group_rename' => ':previous_group wurde zu :group umbenannt.',
            'user_add' => ':user wurde zur Gruppe :group hinzugefügt.',
            'user_add_with_playmodes' => ':user wurde zur Gruppe :group für :rulesets hinzugefügt.',
            'user_add_playmodes' => ':rulesets wurden zu :User :Group Mitgliedschaft hinzugefügt.',
            'user_remove' => ':user wurde aus der Gruppe :group entfernt.',
            'user_remove_playmodes' => ':rulesets wurde von :user :group Mitgliedschaft entfernt.',
            'user_set_default' => 'Die Standardgruppe von :user wurde auf die Gruppe :group gesetzt.',
        ],
    ],

    'form' => [
        'group' => 'Gruppe',
        'group_all' => 'Alle Gruppen',
        'max_date' => 'Bis',
        'min_date' => 'Von',
        'user' => 'Benutzer',
        'user_prompt' => 'Benutzer oder ID',
    ],

    'staff_log' => [
        '_' => 'Ältere Einträge aus der Gruppenhistorie können in :wiki_articles gefunden werden.',
        'wiki_articles' => 'den Artikeln zu Änderungen in der Belegschaft',
    ],
];
