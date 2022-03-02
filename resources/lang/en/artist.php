<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'page_description' => 'Featured artists on osu!',
    'title' => 'Featured Artists',

    'admin' => [
        'hidden' => 'ARTIST IS CURRENTLY HIDDEN',
    ],

    'beatmaps' => [
        '_' => 'Beatmaps',
        'download' => 'Download Beatmap Template',
        'download-na' => 'Beatmap Template not yet available',
    ],

    'index' => [
        'description' => 'Featured artists are artists that we are working in collaboration with in order to bring new and original music to osu!. These artists and a selection of their tracks have been hand-picked by the osu! team as being awesomesauce and suitable for mapping. Some of these featured artists have also created exclusive new tracks for use in osu!.<br><br>All tracks in this section are provided as pre-timed .osz files and have been officially licensed for use in osu! and osu!-related content.',
    ],

    'links' => [
        'beatmaps' => 'osu! Beatmaps',
        'osu' => 'osu! Profile',
        'site' => 'Official Website',
    ],

    'songs' => [
        '_' => 'Songs',
        'count' => ':count_delimited song|:count_delimited songs',
        'original' => 'osu! original',
        'original_badge' => 'ORIGINAL',
    ],

    'tracklist' => [
        'title' => 'title',
        'length' => 'length',
        'bpm' => 'bpm',
        'genre' => 'genre',
    ],

    'tracks' => [
        'index' => [
            '_' => 'tracks search',

            'form' => [
                'advanced' => 'Advanced Search',
                'album' => 'Album',
                'artist' => 'Artist',
                'bpm_gte' => 'BPM Minimum',
                'bpm_lte' => 'BPM Maximum',
                'empty' => 'No tracks matching search criteria were found.',
                'genre' => 'Genre',
                'genre_all' => 'All',
                'length_gte' => 'Length Minimum',
                'length_lte' => 'Length Maximum',
            ],
        ],
    ],
];
