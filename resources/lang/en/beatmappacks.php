<?php

/**
 *    Copyright 2015-2017 ppy Pty. Ltd.
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
    'index' => [
        'blurb' => [
            'important' => 'READ THIS BEFORE DOWNLOADING',
            'instruction' => [
                '_' => "Installation: Once a pack has been downloaded, extract the .rar into your osu! Songs directory.
                    All songs are still .zip'd and/or .osz'd inside the pack, so osu! will need to extract the beatmaps itself the next time you go into Play mode.
                    :scary extract the zip's/osz's yourself,
                    or the beatmaps will display incorrectly in osu and will not function properly.",
                'scary' => 'Do NOT',
            ],
            'note' => [
                '_' => 'Also note that it is highly recommended to :scary, since the oldest maps are of much lower quality than most recent maps.',
                'scary' => 'download the packs from latest to earliest',
            ],
        ],
        'title' => 'Beatmap Packs',
        'description' => 'Pre-packaged collections of beatmaps based around a common theme.',
    ],

    'show' => [
        'download' => 'Download',
        'item' => [
            'cleared' => 'cleared',
            'not_cleared' => 'not cleared',
        ],
    ],

    'mode' => [
        'artist' => 'Artist/Album',
        'chart' => 'Chart',
        'standard' => 'Standard',
        'theme' => 'Theme',
    ],

    'require_login' => [
        '_' => 'You need to be :link to download',
        'link_text' => 'logged in',
    ],
];
