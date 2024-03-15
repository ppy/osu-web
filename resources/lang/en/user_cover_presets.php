<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'index' => [
        'batch_disable' => 'Disable Selected',
        'batch_enable' => 'Enable Selected',

        'batch_confirm' => [
            '_' => ':action :items?',
            'disable' => 'Disable',
            'enable' => 'Enable',
            'items' => ':count_delimited cover|:count_delimited covers',
        ],

        'create_form' => [
            'files' => 'Files',
            'submit' => 'Save',
            'title' => 'Add New',
        ],

        'item' => [
            'click_to_disable' => 'Click to disable',
            'click_to_enable' => 'Click to enable',
            'enabled' => 'Enabled',
            'disabled' => 'Disabled',
            'image_store' => 'Set Image',
            'image_update' => 'Replace Image',
        ],
    ],
    'store' => [
        'failed' => 'Error occurred when creating cover: :error',
        'ok' => 'Covers created',
    ],
];
