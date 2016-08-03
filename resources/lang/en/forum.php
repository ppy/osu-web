<?php

/**
 *    Copyright 2015 ppy Pty. Ltd.
 *
 *    This file is part of osu!web. osu!web is distributed in the hopes of
 *    attracting more community contributions to the core ecosystem of osu!
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

    'covers' => [
        'create' => [
            '_' => 'Set cover image',
            'button' => 'Upload image',
            'info' => 'Cover size should be at :dimensions. You can also drop your image here to upload.',
        ],

        'destroy' => [
            '_' => 'Remove cover image',
            'confirm' => 'Are you sure you want to remove the cover image?',
        ],
    ],
    'pinned_topics' => 'Pinned Topics',
    'post' => [
        'confirm_delete' => 'Really delete post?',
        'edited' => 'Last edited by :user on :when, edited :count times in total.',
        'posted_at' => 'posted :when',
        'actions' => [
            'delete' => 'Delete post',
            'edit' => 'Edit post',
        ],
    ],
    'search' => [
        'go_to_post' => 'Go to post',
        'post_number_input' => 'enter post number',
        'total_posts' => ':posts_count posts total',
    ],
    'subforums' => 'Subforums',
    'title' => 'osu!community',
    'topic' => [
        'create' => [
            'placeholder' => [
                'body' => 'Type post content here',
                'title' => 'Click here to set title',
            ],
            'preview' => 'Preview',
            'submit' => 'Post',
        ],
        'go_to_latest' => 'view latest post',
        'jump' => [
            'enter' => 'click to enter specific post number',
            'first' => 'go to first post',
            'last' => 'go to last post',
            'next' => 'skip next 10 posts',
            'previous' => 'go back 10 posts',
        ],
        'latest_post' => ':when by :user',
        'latest_reply_by' => 'latest reply by :user',
        'new_topic' => 'Post new topic',
        'post_edit' => [
            'cancel' => 'Cancel',
            'post' => 'Save',
            'zoom' => [
                'start' => 'Full Screen',
                'end' => 'Exit Full Screen',
            ],
        ],
        'post_reply' => 'Post',
        'reply_box_placeholder' => 'Type here to reply',
        'started_by' => 'by :user',
    ],
    'topics' => [
        '_' => 'Topics',

        'actions' => [
            'reply' => 'Show reply box',
            'reply_with_quote' => 'Quote post for reply',
        ],

        'index' => [
            'views' => 'views',
            'replies' => 'replies',
        ],

        'lock' => [
            'locked-0' => 'Topic has been unlocked',
            'locked-1' => 'Topic has been locked',
            'is_locked' => 'This topic is locked and can not be replied to',
        ],

        'moderate_move' => [
            'title' => 'Move to another forum',
        ],

        'pin' => [
            'pin-0' => 'Unpin topic',
            'pin-1' => 'Pin topic',
            'pinned-0' => 'Topic has been unpinned',
            'pinned-1' => 'Topic has been pinned',
        ],

        'show' => [
            'feature_vote' => [
                'current' => 'Current Priority: +:count',
                'do' => 'Promote this request',

                'user' => [
                    'current' => 'You have :votes remaining.',
                    'count' => '{0} no vote|{1} :count vote|[2,Inf] :count votes',
                    'not_enough' => "You don't have any more votes remaining",
                ],
            ],

            'poll' => [
                'vote' => 'Vote',

                'detail' => [
                    'total' => 'Total votes: :count',
                    'ended' => 'Polling ended :time',
                    'end_time' => 'Polling will end at :time',
                ],
            ],
        ],
    ],

];
