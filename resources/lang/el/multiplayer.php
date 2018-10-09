<?php

/**
 *    Copyright 2015-2018 ppy Pty. Ltd.
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
    'match' => [
        'beatmap-deleted' => 'διαγραμμένο beatmap',
        'difference' => 'με :difference',
        'failed' => 'ΑΠΈΤΥΧΕ',
        'header' => 'Παιχνίδια πολλών παικτών',
        'in-progress' => '(ματς σε εξέλιξη)',
        'in_progress_spinner_label' => 'ματς σε εξέλιξη',
        'loading-events' => 'Φόρτωση events...',
        'winner' => 'Η :team νίκησε',

        'events' => [
            'player-left' => 'Ο :user έφυγε από το ματς',
            'player-joined' => 'Ο :user μπήκε στο ματς',
            'player-kicked' => 'Ο :user εκδιώχθηκε από το ματς',
            'match-created' => ':user δημιούργησε το ματς',
            'match-disbanded' => 'το ματς εγκαταλείφθηκε',
            'host-changed' => 'Ο :user έγινε ο host',

            'player-left-no-user' => 'ένας παίχτης άφησε το ματς',
            'player-joined-no-user' => 'ένας παίχτης μπήκε στο ματς',
            'player-kicked-no-user' => 'ένας παίχτης εκδιώχθηκε από το ματς',
            'match-created-no-user' => 'το ματς δημιουργήθηκε',
            'match-disbanded-no-user' => 'το ματς εγκαταλείφθηκε',
            'host-changed-no-user' => 'ο host άλλαξε',
        ],

        'score' => [
            'stats' => [
                'accuracy' => 'Ακρίβεια',
                'combo' => 'Combo',
                'score' => 'Σκορ',
            ],
        ],

        'team-types' => [
            'head-to-head' => 'Head-to-head',
            'tag-coop' => 'Tag Co-op',
            'team-vs' => 'Team VS',
            'tag-team-vs' => 'Tag Team VS',
        ],

        'teams' => [
            'blue' => 'Μπλε Ομάδα',
            'red' => 'Κόκκινη Ομάδα',
        ],
    ],
    'game' => [
        'scoring-type' => [
            'score' => 'Yψηλότερο Σκορ',
            'accuracy' => 'Υψηλότερη Ακρίβεια',
            'combo' => 'Υψηλότερο Combo',
            'scorev2' => 'Σκορ V2',
        ],
    ],
];
