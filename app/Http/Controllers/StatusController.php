<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Http\Controllers;

class StatusController extends Controller
{
    public function getMain()
    {
        $data = [
            'status' => [
                'incidents' => [
                    [
                        'description' => 'tried to swap a hdd, instructions unclear, got eggplant stuck in server.',
                        'status' => 'resolved', // green
                        'date' => '23-2-2016 10:40:18',
                        'active' => true, // non-active incidents automatically inserts line-through
                        'by' => 'peppy',
                    ],
                    [
                        'description' => 'aliens are back, they took my cow.',
                        'status' => 'resolved', // yellow
                        'date' => '19-2-2016 20:40:18',
                        'active' => true,
                        'by' => 'peppy',
                    ],
                    [
                        'description' => 'there are flying monkeys in the server room, already throw bananas through the window.',
                        'status' => 'resolving', // yellow
                        'date' => '15-2-2016 20:40:18',
                        'by' => 'peppy',
                    ],
                    [
                        'description' => 'downloaded too much hentai, server\'s bandwidth is gone.',
                        'status' => 'unknown', // red
                        'date' => '10-2-2016 14:40:18',
                        'by' => 'peppy',
                    ],
                    [
                        'description' => 'it\'s raining aliens, oh Jesus y u do dis to me, aliens everywhere.',
                        'status' => 'unknown', // red
                        'date' => '5-2-2016 2:40:18',
                        // no by == automaTed
                    ],
                ],

                'servers' => [
                    [
                        'name' => 'Europe',
                        'players' => 69,
                        'y' => 200,
                        'x' => 450,
                        'state' => 'up', // green
                    ],

                    [
                        'name' => 'North America',
                        'players' => '',
                        'y' => 350,
                        'x' => 150,
                        'state' => 'down', // red
                    ],

                    [
                        'name' => 'Asia',
                        'players' => 1337,
                        'y' => 250,
                        'x' => 1200,
                        'state' => 'up',
                    ],

                    [
                        'name' => 'Africa',
                        'players' => 420,
                        'y' => 550,
                        'x' => 800,
                        'state' => 'up',
                    ],

                    [
                        'name' => 'South America',
                        'players' => 71,
                        'y' => 520,
                        'x' => 150,
                        'state' => 'up',
                    ],
                ],

                'online' => [
                    'graphs' => [
                        'online' => [
                            0,
                            863,
                            11122,
                            13432,
                            10210,
                            25,
                            12476,
                            18634,
                            1246,
                            23115,
                            3456,
                            11110,
                            15953,
                        ],
                        'score' => [
                            64,
                            55,
                            20,
                            23,
                            89,
                            25,
                            20,
                            48,
                            32,
                            54,
                            91,
                            85,
                            92,
                        ],
                    ],
                    'current' => 15.953,
                    'score' => 92,
                ],

                'uptime' => [
                    'graphs' => [
                        'server' => [
                            'today' => [
                                'up' => 55,
                                'down' => 18,
                            ],

                            'week' => [
                                'up' => 12,
                                'down' => 66,
                            ],

                            'month' => [
                                'up' => 99,
                                'down' => 1,
                            ],

                            'all_time' => [
                                'up' => 67,
                                'down' => 5,
                            ],
                        ],

                        'web' => [
                            'today' => [
                                'up' => 40,
                                'down' => 10,
                            ],

                            'week' => [
                                'up' => 58,
                                'down' => 2,
                            ],

                            'month' => [
                                'up' => 54,
                                'down' => 20,
                            ],

                            'all_time' => [
                                'up' => 90,
                                'down' => 5,
                            ],
                        ],
                    ],
                ],
            ],
        ];

        return ext_view('status.main', [
            'title' => 'Status',
            'data' => $data,
        ]);
    }
}
