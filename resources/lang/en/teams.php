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

    'destroy' => [
        'ok' => 'Team removed',
    ],

    'edit' => [
        'saved' => 'Settings saved successfully',
        'title' => 'Team Settings',

        'description' => [
            'label' => 'Description',
            'title' => 'Team Description',
        ],

        'header' => [
            'label' => 'Header Image',
            'title' => 'Set Header Image',
        ],

        'logo' => [
            'label' => 'Team Flag',
            'title' => 'Set Team Flag',
        ],

        'settings' => [
            'application' => 'Team Application',
            'application_help' => 'Whether to allow people to apply for the team',
            'default_ruleset' => 'Default Ruleset',
            'default_ruleset_help' => 'The ruleset to be selected by default when visiting the team page',
            'title' => 'Team Settings',
            'url' => 'URL',

            'application_state' => [
                'state_0' => 'Closed',
                'state_1' => 'Open',
            ],
        ],
    ],

    'members' => [
        'destroy' => [
            'success' => 'Team member removed',
        ],

        'index' => [
            'title' => 'Manage Members',

            'applications' => [
                'empty' => 'No join requests at the moment.',
                'empty_slots' => 'Available slots',
                'title' => 'Join Requests',
                'created_at' => 'Requested At',
            ],

            'table' => [
                'status' => 'Status',
                'joined_at' => 'Join Date',
                'remove' => 'Remove',
                'title' => 'Current Members',
            ],

            'status' => [
                'status_0' => 'Inactive',
                'status_1' => 'Active',
            ],
        ],
    ],

    'part' => [
        'ok' => 'Left the team ;_;',
    ],

    'show' => [
        'bar' => [
            'destroy' => 'Disband Team',
            'join' => 'Request Join',
            'join_cancel' => 'Cancel Join',
            'part' => 'Leave Team',
        ],

        'info' => [
            'created' => 'Formed',
            'website' => 'Website',
        ],

        'members' => [
            'members' => 'Team Members',
            'owner' => 'Team Leader',
        ],

        'sections' => [
            'members' => 'Members',
            'info' => 'Info',
        ],
    ],
];
