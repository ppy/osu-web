<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'header' => [
        'small' => 'Tävla i andra sätt än att bara klicka cirklar.',
        'large' => 'Gemenskapstävlingar',
    ],

    'index' => [
        'nav_title' => 'listning',
    ],

    'judge' => [
        'comments' => 'kommentarer',
        'hide_judged' => 'dölj bedömda bidrag',
        'nav_title' => 'bedöm',
        'no_current_vote' => 'du har inte röstat ännu.',
        'update' => 'uppdatera',
        'validation' => [
            'missing_score' => 'saknar resultat',
            'contest_vote_judged' => 'kan inte rösta i bedömda tävlingar',
        ],
        'voted' => 'Du har redan röstat på detta bidrag.',
    ],

    'judge_results' => [
        '_' => 'Bedömningsresultat',
        'creator' => 'skapare',
        'score' => 'Poäng',
        'score_std' => 'Standardiserad poäng',
        'total_score' => 'total poäng',
        'total_score_std' => 'total standardiserad poäng',
    ],

    'voting' => [
        'judge_link' => 'Du är domare i denna tävling. Bedöm bidragen här!',
        'judged_notice' => 'Denna tävling använder bedömningssystemet, bedömarna bearbetar för närvarande bidragen.',
        'login_required' => 'Var vänlig logga in för att rösta.',
        'over' => 'Möjligheten att rösta i denna tävling har avslutats',
        'show_voted_only' => 'Visa röstade',

        'best_of' => [
            'none_played' => "Det ser inte ut som att du har spelat någon av beatmapsen som kvalificerar för denna tävling!",
        ],

        'button' => [
            'add' => 'Rösta',
            'remove' => 'Ta bort röstning',
            'used_up' => 'Du har använt alla dina röster',
        ],

        'progress' => [
            '_' => ':used / :max röster använda',
        ],

        'requirement' => [
            'playlist_beatmapsets' => [
                'incomplete_play' => 'Du måste spela alla beatmaps i de specificerade spellistorna innan du röstar',
            ],
        ],
    ],

    'entry' => [
        '_' => 'bidrag',
        'login_required' => 'Var vänlig logga in för att gå med i tävlingen.',
        'silenced_or_restricted' => 'Du kan inte gå med i en tävling när du är begränsad eller tystad.',
        'preparation' => 'Vi håller på att förbereda denna tävling. Ha tålamod!',
        'drop_here' => 'Släpp ditt bidrag här',
        'download' => 'Ladda ner .osz',

        'wrong_type' => [
            'art' => 'Endast .jpg- och .png-filer är tillåtna i denna tävling.',
            'beatmap' => 'Endast .osu-filer är tillåtna i denna tävling.',
            'music' => 'Endast .mp3-filer är tillåtna i denna tävling.',
        ],

        'wrong_dimensions' => 'Bidrag för denna tävling måste vara :widthx:height',
        'too_big' => 'Bidrag till denna tävling får vara högst :limit.',
    ],

    'beatmaps' => [
        'download' => 'Ladda ner bidrag',
    ],

    'vote' => [
        'list' => 'röster',
        'count' => ':count_delimited rösta|:count_delimited röster ',
        'points' => ':count_delimited poäng|:count_delimited poäng',
        'points_float' => ':points poäng',
    ],

    'dates' => [
        'ended' => 'Avslutad :date',
        'ended_no_date' => 'Avslutad',

        'starts' => [
            '_' => 'Startar :date',
            'soon' => 'snart™',
        ],
    ],

    'states' => [
        'entry' => 'Öppen för bidrag',
        'voting' => 'Röstning startad',
        'results' => 'Resultat ute',
    ],

    'show' => [
        'admin' => [
            'page' => 'Visa information och poster',
        ],
    ],
];
