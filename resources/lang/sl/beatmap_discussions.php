<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

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
        'none_found' => 'Nobena razprava ni bila najdena kljub željenim iskalnim kriterijem.',
        'title' => 'Razprave o beatmapih',

        'form' => [
            '_' => 'Išči',
            'deleted' => 'Vključi izbrisane razprave',
            'mode' => 'Igralni način beatmape',
            'only_unresolved' => 'Prikaži le nerešene razprave',
            'types' => 'Vrste sporočil',
            'username' => 'Uporabniško ime',

            'beatmapset_status' => [
                '_' => 'Stanje beatmape',
                'all' => 'Vse',
                'disqualified' => 'Diskvalificirano',
                'never_qualified' => 'Nikoli kvalificirano',
                'qualified' => 'Kvalificirano',
                'ranked' => 'Ranked',
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
        'unsaved' => ':count v tem pregledu',
    ],

    'owner_editor' => [
        'button' => 'Lastnik težavnosti',
        'reset_confirm' => 'Ponastavitev lastnika trenutne težavnosti?',
        'user' => 'Lastnik',
        'version' => 'Težavnost',
    ],

    'reply' => [
        'open' => [
            'guest' => 'Prijavite se, da odgovorite',
            'user' => 'Odgovorite',
        ],
    ],

    'review' => [
        'block_count' => ':used / :max uporabljenih blokov',
        'go_to_parent' => 'Ogled Pregledne objave',
        'go_to_child' => 'Ogled razprave',
        'validation' => [
            'block_too_large' => 'vsak blok lahko vsebuje do :limit znakov',
            'external_references' => 'pregled vsebuje reference k težavam, ki ne spadajo v ta pregled',
            'invalid_block_type' => 'napačna lokacija bloka',
            'invalid_document' => 'napačen pregled',
            'invalid_discussion_type' => 'napačen tip razprave',
            'minimum_issues' => 'pregled mora vsebovati minimalno :count težavo|pregled mora vsebovati minimalno :count težav',
            'missing_text' => 'v bloku manjka besedilo',
            'too_many_blocks' => 'pregledi lahko vsebujejo le :count odstavek/težavo|pregledi lahko vsebujejo do :count odstavkov/težav',
        ],
    ],

    'system' => [
        'resolved' => [
            'true' => ':user je označil kot razrešeno',
            'false' => ':user je znova odprl',
        ],
    ],

    'timestamp_display' => [
        'general' => 'splošno',
        'general_all' => 'splošno (vse)',
    ],

    'user_filter' => [
        'everyone' => 'Vsi',
        'label' => 'Filtriraj po uporabnikih',
    ],
];
