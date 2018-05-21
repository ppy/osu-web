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
        'header' => 'Παιχνίδια πολλών παικτών',
        'team-types' => [
            'head-to-head' => 'Head-to-head',
            'tag-coop' => 'Tag Co-op',
            'team-vs' => 'Team VS',
            'tag-team-vs' => 'Tag Team VS',
        ],
        'events' => [
            'player-left' => ':user έφυγε από το ματς',
            'player-joined' => ':user μπήκε στο ματς',
            'player-kicked' => ':user εκδιώχθηκε από το ματς',
            'match-created' => ':user δημιούργησε το ματς',
            'match-disbanded' => 'το ματς εγκαταλείφθηκε',
            'host-changed' => ':user έγινε ο host',

            'player-left-no-user' => 'ένας παίχτης άφησε το ματς',
            'player-joined-no-user' => 'ένας παίχτης μπήκε στο ματς',
            'player-kicked-no-user' => 'ένας παίχτης εκδιώχθηκε από το ματς',
            'match-created-no-user' => 'το ματς δημιουργήθηκε',
            'match-disbanded-no-user' => 'το ματς εγκαταλείφθηκε',
            'host-changed-no-user' => 'ο host άλλαξε',
        ],
        'in-progress' => '(ματς σε εξέλιξη)',
        'score' => [
            'stats' => [
                'accuracy' => 'Ακρίβεια',
                'combo' => 'Combo',
                'score' => 'Σκορ',
            ],
        ],
        'failed' => 'ΑΠΈΤΥΧΕ',
        'teams' => [
            'blue' => 'Μπλε ομάδα',
            'red' => 'Κόκκινη ομάδα',
        ],
        'winner' => ':team νίκησε',
        'difference' => 'με :difference',
        'loading-events' => 'Φόρτωση events...',
        'more-events' => 'Προβολή όλων...',
        'beatmap-deleted' => 'διαγραμμένο beatmap',
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
