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
    'username_change' => [
        'only_one' => 'μόνο μία αλλαγή ονόματος χρήστη επιτρέπεται ανα παραγγελία.',
        'insufficient_paid' => 'Το κόστος αλλαγής του ονόματος χρήστη είναι μεγαλύτερο από το ποσό που δόθηκε (:expected>:actual)',
        'reverting_username_mismatch' => 'Το τρέχον όνομα χρήστη (:current) δεν είναι ίδιο με το (:username)',
    ],
    'supporter_tag' => [
        'insufficient_paid' => 'Η δωρεά είναι μικρότερη από την απαιτούμενη για το δώρο osu!supporter tag (:actual > :expected)',
    ],
];
