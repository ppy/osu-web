<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'applications' => [
        'accept' => [
            'ok' => 'Added user to team.',
        ],
        'destroy' => [
            'ok' => 'Cancelled join request.',
        ],
        'reject' => [
            'ok' => 'Rejected join request.',
        ],
        'store' => [
            'ok' => 'Requested to join team.',
        ],
    ],

    'create' => [
        'submit' => 'Create Team',

        'form' => [
            'name_help' => 'Your team name. The name is permanent at the moment.',
            'short_name_help' => 'Maximum 4 characters.',
            'title' => "Let's set up a new team",
        ],

        'intro' => [
            'description' => "Play together with friends; existing or new. You're not currently in a team. Join an existing team by visiting their team page or create your own team from this page.",
            'title' => 'Team!',
        ],
    ],

    'destroy' => [
        'ok' => 'Team removed.',
    ],

    'edit' => [
        'ok' => 'Settings saved successfully.',
        'title' => 'Team Settings',

        'description' => [
            'label' => 'Description',
            'title' => 'Team Description',
        ],

        'flag' => [
            'label' => 'Team Flag',
            'title' => 'Set Team Flag',
        ],

        'header' => [
            'label' => 'Header Image',
            'title' => 'Set Header Image',
        ],

        'settings' => [
            'application_help' => 'Whether to allow people to apply for the team',
            'default_ruleset_help' => 'The ruleset to be selected by default when visiting the team page',
            'flag_help' => 'Maximum size of :width×:height',
            'header_help' => 'Maximum size of :width×:height',
            'title' => 'Team Settings',

            'application_state' => [
                'state_0' => 'Closed',
                'state_1' => 'Open',
            ],
        ],
    ],

    'header_links' => [
        'edit' => 'settings',
        'leaderboard' => 'leaderboard',
        'show' => 'info',

        'members' => [
            'index' => 'manage members',
        ],
    ],

    'leaderboard' => [
        'global_rank' => 'Global Rank',
    ],

    'members' => [
        'destroy' => [
            'success' => 'Team member removed',
        ],

        'index' => [
            'title' => 'Manage Members',

            'applications' => [
                'accept_confirm' => 'Add user :user to team?',
                'created_at' => 'Requested At',
                'empty' => 'No join requests at the moment.',
                'empty_slots' => 'Available slots',
                'empty_slots_overflow' => ':count_delimited user overflow|:count_delimited users overflow',
                'reject_confirm' => 'Deny join request from user :user?',
                'title' => 'Join Requests',
            ],

            'table' => [
                'joined_at' => 'Join Date',
                'remove' => 'Remove',
                'remove_confirm' => 'Remove user :user from team?',
                'set_leader' => 'Transfer team leadership',
                'set_leader_confirm' => 'Transfer team leadership to user :user?',
                'status' => 'Status',
                'title' => 'Current Members',
            ],

            'status' => [
                'status_0' => 'Inactive',
                'status_1' => 'Active',
            ],
        ],

        'set_leader' => [
            'success' => 'User :user is now the team leader.',
        ],
    ],

    'part' => [
        'ok' => 'Left the team ;_;',
    ],

    'show' => [
        'bar' => [
            'chat' => 'Team Chat',
            'destroy' => 'Disband Team',
            'join' => 'Request Join',
            'join_cancel' => 'Cancel Join',
            'part' => 'Leave Team',
        ],

        'info' => [
            'created' => 'Formed',
        ],

        'members' => [
            'members' => 'Team Members',
            'owner' => 'Team Leader',
        ],

        'sections' => [
            'about' => 'About Us!',
            'info' => 'Info',
            'members' => 'Members',
        ],

        'statistics' => [
            'rank' => 'Rank',
            'leader' => 'Team Leader',
        ],
    ],

    'store' => [
        'ok' => 'Team created.',
    ],
];
