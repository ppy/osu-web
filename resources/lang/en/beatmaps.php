<?php

/**
 *    Copyright 2015 ppy Pty. Ltd.
 *
 *    This file is part of osu!web. osu!web is distributed in the hopes of
 *    attracting more community contributions to the core ecosystem of osu!
 *
 *    osu!web is free software: you can redistribute it and/or modify
 *    it under the terms of the Affero GNU General Public License as published by
 *    the Free Software Foundation, either version 3 of the License, or
 *    (at your option) any later version.
 *
 *    osu!web is distributed WITHOUT ANY WARRANTY; without even the implied
 *    warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
 *    See the GNU Affero General Public License for more details.
 *
 *    You should have received a copy of the GNU Affero General Public License
 *    along with osu!web.  If not, see <http://www.gnu.org/licenses/>.
 */

return [
    'moddingreact' => 'modding',
    'listing' => [
        'search' => [
            'prompt' => 'type in keywords...',
            'options' => 'More search options',
        ],
        'mode' => 'Mode',
        'status' => 'Rank Status',
        'all' => 'All',
        'ranked-approved' => 'Ranked & Approved',
        'faves' => 'Favourites',
        'modreqs' => 'Mod Requests',
        'pending' => 'Pending',
        'mapped-by' => 'mapped by :mapper',
        'source' => 'from :source',
        'load-more' => 'Load more...',
    ],
    'modding' => [
        'portal' => 'Modding Portal',
        'discussion' => 'Beatmap Discussion',
        'metadata' => [
            'title' => 'Title',
            'artist' => 'Artist',
            'tags' => 'Tags',
            'source' => 'Source',
            'unicode' => [
                'artist' => 'Unicode Artist',
                'title' => 'Unicode Title',
            ],
        ],
        'comments' => [
            'comment' => 'Enter a comment...',
            'time' => 'Enter a time (Optional)',
            'reply' => 'Type here to reply...',
            'missing' => 'There doesnt seem to be anything here. Sorry about that.',
        ],
        'feedback' => [
            // the pipe character is for pluralizing
            'feedback' => 'General Feedback',
            'difficulty' => 'Difficulty Specific',
            'praise' => 'Praise|Praise',
            'suggestion' => 'Suggestion|Suggestions',
            'problem' => 'Problem|Problems',
            'nominate' => 'Nominate|Nominations',
            'resolved' => 'Resolved',
        ],
        'helptext' => [
            'time' => 'Copy-paste a time into here from the editor (CTRL+C, CTRL+V)',
            'nominate' => 'See the :ranking for a list of criteria that beatmaps must meet to pass into qualification.',
            'ranking' => 'ranking criteria', // this is linkified
            'warning' => "Don't just nominate because you like the mapper; nominate because a map is ready to be ranked.",
            'comment' => 'Leave a comment with your mod or praise, and if possible, attach the mod to your post!',
            'confirm' => 'I acknowledge that nominating maps with objective issues will lead to losing mod score, or having my ability to nominate removed.',
        ],
        'errors' => [
            'type' => "You didn't specify a comment type!",
            'access-denied' => "You aren't allowed to do that.",
            'invalid' => 'Your mod was automatically rejected. Mods should be between 15 and 800 characters long.',
            'silenced' => 'You cannot post mods while silenced. Please try again later.',
            'missing' => 'Beatmap not found. It may have been deleted after you loaded the page!',
            'beatmap' => 'You tried to comment on a beatmap that is not part of this set.',
            'unknown' => "An unknown error occurred. We've been notified!",
            'no-comment' => 'You need to add a comment.',
        ],
        'success' => [
            'comment' => 'Comment Posted!',
            'reply' => 'Reply Posted!',
            'nomination' => 'Nomination Posted!',
            'edit' => 'Post Edited!',
        ],
    ],
    'bat-tools' => [
        'buttons' => [
            'delete-map' => 'Delete Beatmap',
            'unrank-map' => 'Unrank Beatmap',
            'delete-scores' => 'Delete Scores',
            'graveyard-map' => 'Graveyard Map',
        ],
    ],
    'bss' => [
        'errors' => [
            'missing' => "Sorry, that beatmap doesn't exist.",
            'access-denied' => "That beatmap doesn't belong to you.",
            'ranked' => 'That beatmap is already ranked',
            'graveyarded' => 'That beatmap is in the graveyard. Go to your beatmaps on the osu! website and revive it',

        ],
    ],
];
