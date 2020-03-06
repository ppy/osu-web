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
    'authorizations' => [
        'update' => [
            'null_user' => 'Za urejanje morate biti prijavljeni.',
            'system_generated' => 'Sistemsko generirane objave ni mogoče urejati.',
            'wrong_user' => 'Za urejanje morate biti lastnik objave.',
        ],
    ],

    'events' => [
        'empty' => 'Nič se ni zgodilo ... zaenkrat.',
    ],

    'index' => [
        'deleted_beatmap' => 'izbrisano',
        'none_found' => '',
        'title' => 'Razprave o beatmapih',

        'form' => [
            '_' => '',
            'deleted' => 'Vključi izbrisane razprave',
            'only_unresolved' => '',
            'types' => '',
            'username' => '',

            'beatmapset_status' => [
                '_' => '',
                'all' => '',
                'disqualified' => '',
                'never_qualified' => '',
                'qualified' => '',
                'ranked' => '',
            ],

            'user' => [
                'label' => 'Uporabnik',
                'overview' => 'Pregled dejavnosti',
            ],
        ],
    ],

    'item' => [
        'created_at' => 'Datum objave',
        'deleted_at' => 'Datum izbrisa',
        'message_type' => 'Tip',
        'permalink' => 'Trajna povezava',
    ],

    'nearby_posts' => [
        'confirm' => 'Nobena objava ne obravnava mojih skrbi',
        'notice' => 'Okrog :timestamp je bilo objavljenih nekaj objav (:existing_timestamps). Prosimo, preverite jih, preden nekaj objavite sami.',
    ],

    'reply' => [
        'open' => [
            'guest' => 'Prijavite se, da odgovorite',
            'user' => 'Odgovorite',
        ],
    ],

    'review' => [
        'go_to_parent' => '',
        'go_to_child' => '',
        'validation' => [
            'invalid_block_type' => '',
            'invalid_document' => '',
            'minimum_issues' => '',
            'missing_text' => '',
            'too_many_blocks' => '',
        ],
    ],

    'system' => [
        'resolved' => [
            'true' => ':user je označil kot razrešeno',
            'false' => ':user je znova odprl',
        ],
    ],

    'timestamp_display' => [
        'general' => '',
        'general_all' => '',
    ],

    'user_filter' => [
        'everyone' => 'Vsi',
        'label' => 'Filtriraj po uporabnikih',
    ],
];
