<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'header' => [
        'small' => 'Tekmuj v več načinih, ne samo v klikanju krogov.',
        'large' => 'Skupnostna tekmovanja',
    ],

    'index' => [
        'nav_title' => 'seznam',
    ],

    'voting' => [
        'login_required' => 'Prosimo vpiši se za glasovanje.',
        'over' => 'Glasovanje za to tekmovanje se je zaključilo',
        'show_voted_only' => 'Prikaži glasovane',

        'best_of' => [
            'none_played' => "Videti je, da nisi igral še nobene beatmape, ki so kvalificirane za to tekmovanje!",
        ],

        'button' => [
            'add' => 'Glasuj',
            'remove' => 'Odstrani glas',
            'used_up' => 'Uporabil si vse svoje glasove',
        ],

        'progress' => [
            '_' => ':used / :max uporabljenih glasov',
        ],

        'requirement' => [
            'playlist_beatmapsets' => [
                'incomplete_play' => 'Igrati moraš vse beatmape iz določenih seznamov pred glasovanjem ',
            ],
        ],
    ],
    'entry' => [
        '_' => '',
        'login_required' => 'Prosimo vpiši se, da se lahko pridružiš tekmovanju.',
        'silenced_or_restricted' => 'Ne moreš se udeležiti tekmovanj, ko si utišan ali imaš omejitev na računu.',
        'preparation' => 'Trenutno pripravljamo to tekmovanje. Prosimo počakaj strpno!',
        'drop_here' => '',
        'download' => 'Prenesi .osz',
        'wrong_type' => [
            'art' => 'Za to tekmovanje so sprejemljive samo .jpg in .png datoteke.',
            'beatmap' => 'Za to tekmovanje so sprejemljive samo .osu datoteke.',
            'music' => 'Za to tekmovanje so sprejemljive samo .mp3 datoteke.',
        ],
        'wrong_dimensions' => '',
        'too_big' => 'Dostopov v to tekmovanje je samo do :limit.',
    ],
    'beatmaps' => [
        'download' => 'Prenos vpisa',
    ],
    'vote' => [
        'list' => 'glasovi',
        'count' => ':count_delimited glas|:count_delimited glasov',
        'points' => ':count_delimited točka|:count_delimited točk',
    ],
    'dates' => [
        'ended' => 'Zaključeno :date',
        'ended_no_date' => 'Zaključeno',

        'starts' => [
            '_' => 'Začetek :date',
            'soon' => 'soon™',
        ],
    ],
    'states' => [
        'entry' => 'Vpisi odprti',
        'voting' => 'Začetek glasovanja',
        'results' => 'Rezultati objavljeni',
    ],
];
